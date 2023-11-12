<?php

namespace Modules\Dictionary\Http\Controllers;

use App\Models\Dictionary;
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

class DictionaryController extends Controller
{
    public function all()
    {
        return DataTables::of( Dictionary::all()->whereNotIn('deleted',true))->addIndexColumn()->make(true);
    }
    public function index()
    {
        if (Gate::allows('read dictionary')) {
            $version = Option::find('version_app')->value;
            $user=User::find(Auth::user()->user_id);
            $notifications= Notification::whereIn((new Notification())->getTable().'.type',['web'])
                ->where((new Notification())->getTable().'.status','=',null)
                ->where((new Notification())->getTable().'.send_to','=',Auth::user()->user_id)
                ->get();
            return view('dictionary::index',[
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
        if (Gate::allows('read dictionary')) {
            return view('dictionary::create');
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('create dictionary')) {
            DB::beginTransaction();
            try {
                Dictionary::create([
                    'dictionary_id'=> $request->dictionary_id,
                    'name'=> $request->dictionary_name,
                    'key'=> $request->key,
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
        return view('dictionary::show');
    }

    public function edit($id)
    {
        if (Gate::allows('update dictionary')) {
            $dictionary = Dictionary::find($id);
            return view('dictionary::edit',[
                'dictionary'=>$dictionary
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }

    public function update(Request $request,Dictionary $dictionary)
    {
        try {
            $dictionary->update([
                'name'=>$request->dictionary_name,
                'update_by'=>Auth::user()->user_name,
            ]);
            DB::commit();
            return 'data berhasil disimpan';
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy(Request $request,Dictionary $dictionary)
    {
        try {
            $dictionary->update([
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
