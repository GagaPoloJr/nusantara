<?php

namespace Modules\Group\Http\Controllers;

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
use Yajra\DataTables\DataTables;

class GroupController extends Controller
{
    public function all()
    {

        return DataTables::of( Group::Leftjoin((new Company())->getTable().' as a', 'a.company_id', '=', (new Group())->getTable().'.company_id')->get()->whereNotIn('deleted',true))->addIndexColumn()->make(true);
    }

    public function member($id)
    {
        $user = User::role(Group::find($id)->name)
            ->join('authenticate.user_group', 'authenticate.user_group.model_id', '=', 'authenticate.users.user_id')
            ->where('authenticate.user_group.group_id','=',$id)
            ->get([
                'authenticate.users.*',
                'authenticate.user_group.is_admin',
            ]);
        return DataTables::of($user)->addIndexColumn()->make(true);
    }

    public function notMember($id)
    {
        if (Group::where('group_id','=',$id)->first()->company_id == null) {
            return DataTables::of(User::whereNotIn('user_id', User::role(Group::find($id)->name)->pluck('user_id')->whereNotIn('deleted',true))->get())->addIndexColumn()->make(true);
        } else {
            if (Group::where('group_id','=',$id)->first()->company_id == null) {
                return DataTables::of(User::whereNotIn('user_id', User::role(Group::find($id)->name)->pluck('user_id')->whereNotIn('deleted',true))->get())->addIndexColumn()->make(true);
            } else {
                $company_id = Group::where('group_id','=',$id)->first()->company_id;
                $cek=UserGroup::where('group_id','=',$id);

                $cek2 = CompanyUser::where('company_id','=',$company_id);
                $arr2 = [];
                foreach ($cek2->get() as $row) {
                    array_push($arr2,$row->user_id);
                }

                $arr = [];
                foreach ($cek->pluck('model_id') as $key) {
                    array_push($arr,$key);
                }
                return DataTables::of(User::whereIn('user_id',array_diff($arr2,$arr))->get())->addIndexColumn()->make(true);
            }
        }
    }

    public function haveAccess($id)
    {
        $group=Group::find($id);
        return DataTables::of($group->getAllPermissions()->whereNotIn('deleted',true))->addIndexColumn()->make(true);
    }

    public function nothaveAccess($id)
    {
        $group=Group::find($id);
        return DataTables::of(Access::whereNotIn('access_id', $group->getAllPermissions()->whereNotIn('deleted',true)->pluck('access_id'))->get())->addIndexColumn()->make(true);
    }

    public function index()
    {
        if (Gate::allows('read group')) {
            $version = Option::find('version_app')->value;
            $user=User::find(Auth::user()->user_id);
            $notifications= Notification::whereIn((new Notification())->getTable().'.type',['web'])
                ->where((new Notification())->getTable().'.status','=',null)
                ->where((new Notification())->getTable().'.send_to','=',Auth::user()->user_id)
                ->get();
            return view('group::index',[
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
            return view('group::create',[
                'companys'=>$companys
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('create company')) {
            DB::beginTransaction();
            try {
                Group::create([
                    'group_id'=>Group::max('group_id')+1,
                    'name'=> $request->group_name,
                    'create_by'=>Auth::user()->user_name,
                    'company_id'=>$request->company
                ]);
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

    public function show($id)
    {
        return view('group::show');
    }


    public function edit($id)
    {
        if (Gate::allows('update group')) {
            $group = Group::findById($id);
            return view('group::edit',[
                'group'=>$group
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }

    public function update(Request $request,Group $group)
    {
        try {
            $group->update([
                'name'=>$request->group_name,
                'company_id'=>$request->company,
                'update_by'=>Auth::user()->user_name,
            ]);
            DB::commit();
            return 'data berhasil disimpan';
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy(Request $request,Group $group)
    {
        try {
            $group->update([
                'deleted'=>true,
                'delete_date'=>now(),
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

    public function groupUserCreate(Request $request)
    {
        if (Gate::allows('update group')) {
            $group = Group::find($request->group_id);
            return view('group::user.create',[
                'group' => $group,
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }

    public function groupUserStore(Request $request)
    {
        if (Gate::allows('update group')) {
            try {
                $group = Group::findById($request->input('group_id'));
                $user_array = $request->input('user_id');

                for ($i=0; $i < count( $user_array) ; $i++) {
                    $user = User::find($user_array[$i]);
                    $user->assignRole($group->name);
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

    public function groupUserDestroy(Request $request){
        if (Gate::allows('update group')) {
            try {
                $group = Group::findById($request->input('group_id'));
                $user_array = $request->input('user_id');

                for ($i=0; $i < count( $user_array) ; $i++) {
                    $user = User::find($user_array[$i]);
                    $user->removeRole($group->name);
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

    public function groupAccessCreate(Request $request)
    {
        if (Gate::allows('update group')) {
            $group = Group::find($request->group_id);
            return view('group::access.create',[
                'group' => $group,
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }

    public function groupAccessStore(Request $request)
    {
        if (Gate::allows('update group')) {
            try {
                $group = Group::findById($request->input('group_id'));
                $access_array = $request->input('access_id');

                for ($i=0; $i < count( $access_array) ; $i++) {
                    $access = Access::find($access_array[$i]);
                    $access->assignRole($group->name);
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

    public function groupAccessDestroy(Request $request)
    {
        if (Gate::allows('update group')) {
            try {
                $group = Group::findById($request->input('group_id'));
                $access_array = $request->input('access_id');

                for ($i=0; $i < count( $access_array) ; $i++) {
                    $access = Access::find($access_array[$i]);
                    $access->removeRole($group->name);
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

    public function groupConfigVisible(Request $request)
    {
        if (Gate::allows('update group')) {
            $group=Group::find($request->group_id);
            try {
                $group->update([
                    'visible'=> ($request->value=='on'?true:false),
                ]);
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
    public function groupConfigIsadmin(Request $request)
    {
        $response=[];
        switch ($request->value) {
            case 'off':
                try {
                    $user = User::find($request->id);
                    $group = Group::find($request->group_id);
                    DB::table('authenticate.user_group')
                        ->where('group_id', $group->group_id)
                        ->where('model_id', $user->user_id)
                        ->update(['is_admin' => true]);
                    /*->update(['is_admin' => ($request->value=='off'?true:false)]);*/
                    DB::commit();
                    array_push($response,[
                        'icon' => 'success',
                        'title' => 'Berhasil!',
                        'message' => 'data berhasil disimpan',
                        'status' => true,
                    ]);
                    return $response;
                } catch (\Exception $e) {
                    DB::rollback();
                    throw $e;
                }
                break;
            case 'on':
                $cek = UserGroup::whereIn('is_admin',[true])->where('group_id','=',$request->group_id)->count();
                if ($cek > 1) {
                    try {
                        $user = User::find($request->id);
                        $group = Group::find($request->group_id);
                        DB::table('authenticate.user_group')
                            ->where('group_id', $group->group_id)
                            ->where('model_id', $user->user_id)
                            ->update(['is_admin' => false]);
                        /*->update(['is_admin' => ($request->value=='off'?true:false)]);*/
                        DB::commit();
                        array_push($response,[
                            'icon' => 'success',
                            'title' => 'Berhasil!',
                            'message' => 'data berhasil disimpan',
                            'status' => true,
                        ]);
                        return $response;
                    } catch (\Exception $e) {
                        DB::rollback();
                        throw $e;
                    }
                } else {
                    array_push($response,[
                        'icon' => 'error',
                        'title' => 'Gagal!',
                        'message' => 'Admin group tidak boleh kosong',
                        'status' => false,
                    ]);
                    return $response;
                }
                break;
                default;
        }

    }
}
