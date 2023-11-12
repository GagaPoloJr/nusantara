<?php

namespace Modules\Company\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Notification;
use App\Models\Option;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    public function all()
    {
        if (Gate::allows('read company')) {
            return DataTables::of( Company::all()->whereNotIn('deleted',true))->addIndexColumn()->make(true);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }
    public function member($id)
    {
        $users = User::whereIn('user_id', CompanyUser::where('company_id','=',$id)->pluck('user_id'))->get();
        return DataTables::of($users->whereNotIn('deleted',true))->addIndexColumn()->make(true);
    }
    public function notMember($id)
    {
        $member = CompanyUser::where('company_id','=',$id)->pluck('user_id');
        $users = User::whereNotIn('user_id',$member)->get();
        return DataTables::of($users->whereNotIn('deleted',true))->addIndexColumn()->make(true);
    }
    public function index()
    {
        if (Gate::allows('read company')) {
            $version = Option::find('version_app')->value;
            $user=User::find(Auth::user()->user_id);
            $notifications= Notification::whereIn((new Notification())->getTable().'.type',['web'])
                ->where((new Notification())->getTable().'.status','=',null)
                ->where((new Notification())->getTable().'.send_to','=',Auth::user()->user_id)
                ->get();
            
            return view('company::index',[
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
        if (Gate::allows('read company')) {
            $companys=Company::all()->whereNotIn('deleted',true);
            return view('company::create',[
                'companys'=>$companys,
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
                Company::create([
                    'company_id'=>$request->company_id,
                    'company_name'=>$request->company_name,
                    'parent'=>($request->parent!=null?$request->parent:null),
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
        return view('company::show');
    }
    public function edit($id)
    {
        if (Gate::allows('update company')) {
            $company = Company::find($id);
            $companys=Company::all()->whereNotIn('deleted',true);
            return view('company::edit',[
                'company'=>$company,
                'companys'=>$companys
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }
    public function update(Request $request,Company $company)
    {
        try {
            $company->update([
                'company_name'=>$request->company_name,
                'parent'=>$request->parent,
                'update_by'=>Auth::user()->user_name,
            ]);
            DB::commit();
            return 'data berhasil disimpan';
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function destroy(Request $request,Company $company)
    {
        try {
            $company->update([
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
    public function companyUserCreate(Request $request)
    {
        if (Gate::allows('update company')) {
            $company = Company::find($request->company_id);
            return view('company::user.create',[
                'company' => $company,
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }
    public function companyUserDestroy(Request $request)
    {
        if (Gate::allows('update company')) {
            try {
                $user_array = $request->input('user_id');
                for ($i=0; $i < count( $user_array) ; $i++) {
                    CompanyUser::where('company_id',$request->input('company_id'))->where('user_id',$user_array[$i])->delete();
                }
                return 'data berhasil disimpan';
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }
    public function companyUserStore(Request $request)
    {
        if (Gate::allows('update company')) {
            try {
                $user_array = $request->input('user_id');
                for ($i=0; $i < count( $user_array) ; $i++) {
                    CompanyUser::create([
                        'company_user_id'=> CompanyUser::max('company_user_id')+1,
                        'user_id'=> $user_array[$i],
                        'company_id'=> $request->input('company_id'),
                        'as_owner'=> false,
                    ]);
                }
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
