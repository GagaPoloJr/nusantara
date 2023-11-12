<?php

namespace Modules\User\Http\Controllers;

use App\Models\Access;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Group;
use App\Models\Notification;
use App\Models\Option;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function all()
    {
        return DataTables::of( User::all()->whereNotIn('deleted',true))->addIndexColumn()->make(true);
    }
    public function memberGroup($id)
    {
        return DataTables::of(Group::whereIn('name', User::find($id)->getRoleNames()->whereNotIn('deleted',true))->get())->addIndexColumn()->make(true);
    }
    public function memberCompany($id)
    {
        return DataTables::of(Company::whereIn('company_id',User::find($id)->companyuser->pluck('company_id'))->get()->whereNotIn('deleted',true))->addIndexColumn()->make(true);
    }
    public function notMemberGroup($id)
    {
        $company=[];
        foreach (CompanyUser::where('user_id','=',$id)->get() as $row) {
            array_push($company,$row->company_id);
        }

        $parent_group = Group::whereIn('group_id',UserGroup::where('model_id','=',$id)->pluck('group_id'))->where('company_id','=',null)->pluck('group_id');
        $parent_group_not_join=Group::where('company_id','=',null)->whereNotIn('group_id',$parent_group);

        $groups = Group::WhereNotIn('group_id',UserGroup::whereIn('group_id',Group::whereIn('company_id',$company)->pluck('group_id'))->where('model_id','=',$id)->pluck('group_id'))->whereIn('company_id', $company)
            ->union($parent_group_not_join)
            ->get();
        return DataTables::of($groups->whereNotIn('deleted',true))->addIndexColumn()->make(true);
    }
    public function notMemberCompany($id)
    {
        return DataTables::of(Company::whereNotIn('company_id',User::find($id)->companyuser->pluck('company_id'))->get()->whereNotIn('deleted',true))->addIndexColumn()->make(true);
    }
    public function access($id)
    {
        $user = User::find($id);
        return DataTables::of(Access::whereIn('name',$user->getAllPermissions()->pluck('name')->whereNotIn('deleted',true))->get())->addIndexColumn()->make(true);
    }
    public function notAccess($id)
    {
        $user = User::find($id);
        return DataTables::of(Access::whereNotIn('name',$user->getAllPermissions()->pluck('name')->whereNotIn('deleted',true))->get())->addIndexColumn()->make(true);
    }
    public function index()
    {
        if (Gate::allows('read user')) {
            $version = Option::find('version_app')->value;
            $user=User::find(Auth::user()->user_id);
            $notifications= Notification::whereIn((new Notification())->getTable().'.type',['web'])
                ->where((new Notification())->getTable().'.status','=',null)
                ->where((new Notification())->getTable().'.send_to','=',Auth::user()->user_id)
                ->get();
            return view('user::index',[
                'user'=>$user,
                'notifications'=>$notifications,
                'version'=>$version,
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }

    }

    public function create()
    {
        if (Gate::allows('read group')) {
            $companys=Company::all()->whereNotIn('deleted',true);
            return view('user::create',[
                'companys'=>$companys
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }

    public function store(Request $request)
    {
        $response=[];
        if (substr( $request->no_hp, 0, 2 ) === '08') {
            $outbox_for = '628'.substr( $request->no_hp, 2, strlen($request->no_hp) );
        } else {
            $outbox_for = $request->no_hp;
        }

        switch ($request->type) {
            case 'create':
                if (User::where('email','=',$request->email)->count() > 0 ) {
                    array_push($response,[
                        'icon' => 'error',
                        'title' => 'Gagal!',
                        'message' => 'Email telah digunakan',
                        'status' => false,
                    ]);
                    return $response;
                } else {
                    if (User::where('no_hp','=',$outbox_for)->count() > 0 ) {
                        array_push($response,[
                            'icon' => 'error',
                            'title' => 'Gagal!',
                            'message' => 'Nomor telah digunakan',
                            'status' => false,
                        ]);
                        return $response;
                    } else {

                        DB::beginTransaction();
                        try {
                            $user = [
                                'user_id'=>User::max('user_id')+1,
                                'user_name'=> $request->user_name,
                                'email'=> $request->email,
                                'create_by'=>null,
                                'email_verified_at'=>now(),
                                'password'=>bcrypt($request->password),
                                'remember_token'=> Str::random(10),
                                'no_hp'=> $outbox_for,
                                'gender'=> $request->gender,
                            ];
                            if ($request->file('image')) {
                                $imageName = strtolower(str_replace(' ', '_', $user['user_id'])).'.'.$request->image->extension();
                                $filepath= public_path('images\\').strtolower(str_replace(' ', '_', $user['user_id'])).'.'.$request->image->extension();
                                File::delete($filepath);
                                $request->image->move(public_path('images'), $imageName);
                                $user['image']='images/'.$imageName;
                            } else {
                                if ($request->gender == 'L') {
                                    $user['image']='images/300-1.jpg';
                                } else {
                                    $user['image']='images/300-2.png';
                                }
                            }
                            $save = User::create($user);
                            if ($save) {
                                CompanyUser::create([
                                    'company_user_id'=> CompanyUser::max('company_user_id')+1,
                                    'user_id'=> $save['user_id'],
                                    'company_id'=> $request->company,
                                    'as_owner'=> false,
                                ]);
                                $save->assignRole('User');

                            }
                            DB::commit();
                            array_push($response,[
                                'icon' => 'success',
                                'title' => 'Berhasil',
                                'message' => 'data berhasil disimpan',
                                'status' => true,
                            ]);
                            return $response;
                        } catch (\Exception $e) {
                            DB::rollback();
                            throw $e;
                        }
                    }
                }
                break;
            case 'update':
                $user = User::find($request->user_id);

                $email=$user->email;

                if (substr( $user->no_hp, 0, 2 ) === '08') {
                    $no_hp = '628'.substr( $user->no_hp, 2, strlen($user->no_hp) );
                } else {
                    $no_hp = $user->no_hp;
                }

                $user = [
                    'update_by'=>Auth::user()->user_name,
                    'gender'=> $request->gender,
                ];

                if ($request->email <> $email) {
                    if (User::where('email','=',$request->email)->count() > 0 ) {
                        array_push($response, [
                            'icon' => 'error',
                            'title' => 'Gagal!',
                            'message' => 'Email telah digunakan',
                            'status' => false,
                        ]);
                        return $response;
                    } else {
                        $user['email']=$request->email;

                        if ($outbox_for <> $no_hp) {
                            if (User::where('no_hp','=',$outbox_for)->count() > 0 ) {
                                array_push($response, [
                                    'icon' => 'error',
                                    'title' => 'Gagal!',
                                    'message' => 'Nomor telah digunakan',
                                    'status' => false,
                                ]);
                                return $response;
                            }
                        } else {
                            $user['no_hp']=$outbox_for;

                            if ($request->file('image')) {
                                $imageName = strtolower(str_replace(' ', '_', $request->user_id)).'.'.$request->image->extension();
                                $filepath= public_path('images\\').strtolower(str_replace(' ', '_', $request->user_id)).'.'.$request->image->extension();
                                File::delete($filepath);
                                $request->image->move(public_path('images'), $imageName);
                                $user['image']='images/'.$imageName;
                            }

                            if ($request->password) {
                                $user['password']=bcrypt($request->password);
                            }

                            DB::beginTransaction();
                            try {
                                DB::table((new User())->getTable())->whereIn((new User())->getKeyName(), [$request->user_id])->update($user);
                                DB::commit();
                                array_push($response, [
                                    'icon' => 'success',
                                    'title' => 'Berhasil',
                                    'message' => 'data berhasil disimpan',
                                    'status' => true,
                                ]);
                                return $response;
                            } catch (\Exception $e) {
                                DB::rollback();
                                throw $e;
                            }
                        }
                    }
                } else {
                    if ($outbox_for <> $no_hp) {
                        if (User::where('no_hp','=',$outbox_for)->count() > 0 ) {
                            array_push($response, [
                                'icon' => 'error',
                                'title' => 'Gagal!',
                                'message' => 'Nomor telah digunakan',
                                'status' => false,
                            ]);
                            return $response;
                        } else {
                            $user['no_hp']=$outbox_for;
                            if ($request->file('image')) {
                                $imageName = strtolower(str_replace(' ', '_', $request->user_id)).'.'.$request->image->extension();
                                $filepath= public_path('images\\').strtolower(str_replace(' ', '_', $request->user_id)).'.'.$request->image->extension();
                                File::delete($filepath);
                                $request->image->move(public_path('images'), $imageName);
                                $user['image']='images/'.$imageName;
                            }

                            if ($request->password) {
                                $user['password']=bcrypt($request->password);
                            }

                            DB::beginTransaction();
                            try {
                                DB::table((new User())->getTable())->whereIn((new User())->getKeyName(), [$request->user_id])->update($user);
                                DB::commit();
                                array_push($response, [
                                    'icon' => 'success',
                                    'title' => 'Berhasil',
                                    'message' => 'data berhasil disimpan',
                                    'status' => true,
                                ]);
                                return $response;
                            } catch (\Exception $e) {
                                DB::rollback();
                                throw $e;
                            }
                        }
                    } else {
                        if ($request->file('image')) {
                            $imageName = strtolower(str_replace(' ', '_', $request->user_id)).'.'.$request->image->extension();
                            $filepath= public_path('images\\').strtolower(str_replace(' ', '_', $request->user_id)).'.'.$request->image->extension();
                            File::delete($filepath);
                            $request->image->move(public_path('images'), $imageName);
                            $user['image']='images/'.$imageName;
                        }

                        if ($request->password) {
                            $user['password']=bcrypt($request->password);
                        }

                        DB::beginTransaction();
                        try {
                            DB::table((new User())->getTable())->whereIn((new User())->getKeyName(), [$request->user_id])->update($user);
                            DB::commit();
                            array_push($response, [
                                'icon' => 'success',
                                'title' => 'Berhasil',
                                'message' => 'data berhasil disimpan',
                                'status' => true,
                            ]);
                            return $response;
                        } catch (\Exception $e) {
                            DB::rollback();
                            throw $e;
                        }
                    }
                }
                break;
            default:
        }

    }

    public function show($id)
    {
        return view('user::show');
    }

    public function edit($id)
    {
        if (Gate::allows('update user')) {
            $user = User::find($id);
            return view('user::edit',[
                'user'=>$user
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }

    public function update(Request $request,User $user)
    {
        $response=[];
        dd($request);
        $email=$user->email;
        $no_hp=$user->no_hp;

        if (trim($email) <> trim($request->email)) {

        } else {
            dd('sama');
        }

        if (substr( $request->no_hp, 0, 2 ) === '08') {
            $outbox_for = '628'.substr( $request->no_hp, 2, strlen($request->no_hp) );
        } else {
            $outbox_for = $request->no_hp;
        }

        if (User::where('email','=',$request->email)->count() > 0 ) {
            array_push($response,[
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => 'Email telah digunakan',
                'status' => false,
            ]);
            return $response;
        } else {
            if (User::where('no_hp','=',$outbox_for)->count() > 0 ) {
                array_push($response,[
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'message' => 'Nomor telah digunakan',
                    'status' => false,
                ]);
                return $response;
            } else {
                //NOTIFICATION
                /* $args = [
                     'message' =>'Haii',
                     'outbox_for' => $outbox_for
                 ];
                 ProcessNotificationRegister::dispatch($args);*/

                /*DB::beginTransaction();
                try {
                    if ($request->password == null || $request->password == '') {
                        $user->update([
                            'user_name'=> $request->user_name,
                            'email'=> $request->email,
                            'update_by'=>Auth::user()->user_name,
                            'no_hp'=> $request->no_hp,
                            'gender'=> $request->gender,
                        ]);
                    } else {
                        $user->update([
                            'user_name'=> $request->user_name,
                            'email'=> $request->email,
                            'update_by'=>Auth::user()->user_name,
                            'password'=>bcrypt($request->password),
                            'no_hp'=> $request->no_hp,
                            'gender'=> $request->gender,
                        ]);
                    }
                    DB::commit();
                    array_push($response,[
                        'icon' => 'success',
                        'title' => 'Berhasil',
                        'message' => 'Silahkan login',
                        'status' => true,
                    ]);
                    return $response;
                } catch (\Exception $e) {
                    DB::rollback();
                    throw $e;
                }*/

            }
        }
    }

    public function destroy(Request $request,User $user)
    {
        try {
            $user->update([
                'deleted'=>true,
                'delete_at'=>now(),
                'delete_by'=>Auth::user()->user_name,
                'delete_reason'=>$request->reason
            ]);
            DB::commit();
            return 'data berhasil disimpan';
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function userConfigCrossCompany(Request $request)
    {
        $user=User::find($request->user_id);
        try {
            $user->update([
                'cross_company'=> ($request->value=='off'?'t':'f'),
            ]);
            DB::commit();
            return 'data berhasil disimpan';
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function userCompanyCreate(Request $request)
    {
        if (Gate::allows('update user')) {
            $user = User::find($request->user_id);
            return view('user::company.create',[
                'user' => $user,
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }
    public function userGroupCreate(Request $request)
    {
        if (Gate::allows('update user')) {
            $user = User::find($request->user_id);
            return view('user::group.create',[
                'user' => $user,
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }
    public function userGroupStore(Request $request)
    {
        if (Gate::allows('update user')) {
            $user   = User::find($request->user_id);
            $group  = Group::find($request->group_id);
            $user->assignRole($group);
            return 'data berhasil disimpan';
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }
    public function userCompanyStore(Request $request)
    {
        if (Gate::allows('update user')) {
            CompanyUser::create([
                'company_user_id'=> CompanyUser::max('company_user_id')+1,
                'user_id'=> $request->user_id,
                'company_id'=> $request->company_id,
                'as_owner'=> false,
            ]);
            return 'data berhasil disimpan';
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }
    public function userGroupDestroy(Request $request)
    {
        if (Gate::allows('delete user')) {
            $user   = User::find($request->user_id);
            $group  = Group::find($request->group_id);
            $user->removeRole($group);
            return 'data berhasil disimpan';
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }
    public function userCompanyDestroy(Request $request)
    {
        if (Gate::allows('delete user')) {
            CompanyUser::where('company_id',$request->company_id)->where('user_id',$request->user_id)->delete();
            return 'data berhasil disimpan';
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }
    public function userAccessCreate(Request $request)
    {
        if (Gate::allows('update user')) {
            $user = User::find($request->user_id);
            return view('user::access.create',[
                'user' => $user,
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }
    public function userAccessStore(Request $request)
    {
        if (Gate::allows('update user')) {
            try {
                $user = User::find($request->input('user_id'));
                $access_array = $request->input('access_id');

                for ($i=0; $i < count( $access_array) ; $i++) {
                    $access = Access::find($access_array[$i]);
                    $user->givePermissionTo($access);
                }
                DB::commit();
                return 'data berhasil disimpan';
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }
    public function userAccessDestroy(Request $request){
        if (Gate::allows('update user')) {
            try {
                $user = User::find($request->input('user_id'));
                $access_array = $request->input('access_id');

                for ($i=0; $i < count( $access_array) ; $i++) {
                    $access = Access::find($access_array[$i]);
                    $user->revokePermissionTo($access);
                }
                DB::commit();
                return 'data berhasil disimpan';
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }
}
