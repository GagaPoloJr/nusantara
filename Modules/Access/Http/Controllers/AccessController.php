<?php

namespace Modules\Access\Http\Controllers;

use App\Models\Access;
use App\Models\Notification;
use App\Models\Option;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class AccessController extends Controller
{
    public function all()
    {
        if (Gate::allows('read access')) {
            return DataTables::of( Access::all()->whereNotIn('deleted',true))->addIndexColumn()->make(true);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }

    public function index()
    {
        if (Gate::allows('read access')) {
            $version = Option::find('version_app')->value;
            $user=User::find(Auth::user()->user_id);
            $notifications= Notification::whereIn((new Notification())->getTable().'.type',['web'])
                ->where((new Notification())->getTable().'.status','=',null)
                ->where((new Notification())->getTable().'.send_to','=',Auth::user()->user_id)
                ->get();
            return view('access::index',[
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
        if (Gate::allows('read access')) {
            $access=Access::all()->whereNotIn('deleted',true);
            return view('access::create',[
                'access'=>$access,
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }
    public function store(Request $request)
    {
        if (Gate::allows('create access')) {
            DB::beginTransaction();
            try {
                Access::create([
                    'access_id'=>Access::max('access_id')+1,
                    'name'=> $request->access_name,
                    'create_by'=>Auth::user()->user_name,
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
        return view('access::show');
    }

    public function edit($id)
    {
        if (Gate::allows('update access')) {
            $access = Access::findById($id);
            return view('access::edit',[
                'access'=>$access
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }

    public function update(Request $request,Access $access)
    {
        try {
            $access->update([
                'name'=>$request->access_name,
                'update_by'=>Auth::user()->user_name,
            ]);
            DB::commit();
            return 'data berhasil disimpan';
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy(Request $request,Access $access)
    {
        try {
            $access->update([
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
}
