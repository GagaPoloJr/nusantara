<?php

namespace Modules\DictionaryData\Http\Controllers;

use App\Models\Dictionary;
use App\Models\DictionaryData;
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

class DictionaryDataController extends Controller
{
    public function all()
    {
        return DataTables::of( DictionaryData::getData() )->addIndexColumn()->make(true);
    }
    public function index()
    {
        if (Gate::allows('read dictionarydata')) {
            $version = Option::find('version_app')->value;
            $user=User::find(Auth::user()->user_id);
            $notifications= Notification::whereIn((new Notification())->getTable().'.type',['web'])
                ->where((new Notification())->getTable().'.status','=',null)
                ->where((new Notification())->getTable().'.send_to','=',Auth::user()->user_id)
                ->get();
            $dictionarys=DictionaryData::all()->whereNotIn('deleted',true);
            return view('dictionarydata::index',[
                'user'=>$user,
                'notifications'=>$notifications,
                'dictionarys'=>$dictionarys,
                'version'=>$version,
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }

    public function create()
    {
        if (Gate::allows('read dictionarydata')) {
            $dictionarys=Dictionary::all()->whereNotIn('deleted',true);
            return view('dictionarydata::create',[
                'dictionarys'=>$dictionarys,
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('create dictionarydata')) {
            DB::beginTransaction();
            try {
                DictionaryData::create([
                    'dictionary_data_id'=>DictionaryData::max('dictionary_data_id')+1,
                    'dictionary_id'=> $request->dictionary_id,
                    'value'=> $request->value,
                    'view'=> $request->view,
                    'default'=> $request->default,
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
        return view('dictionarydata::show');
    }

    public function edit($id)
    {
        if (Gate::allows('update dictionarydata')) {
            $dictionary=DictionaryData::find($id)->dictionary;
            $dictionarydata = DictionaryData::find($id);
            return view('dictionarydata::edit',[
                'dictionary'=>$dictionary,
                'dictionarydata'=>$dictionarydata
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }

    public function update(Request $request,$id)
    {
        $dictionarydata= DictionaryData::find($id);
        try {
            $dictionarydata->update([
                'view'=>$request->view,
                /*'default'=>($request->default=="true"?true:false),*/
                'create_by'=>Auth::user()->user_name,
            ]);
            DB::commit();
            return 'data berhasil disimpan';
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy(Request $request,$id)
    {
        $dictionarydata= DictionaryData::find($id);
        try {
            $dictionarydata->update([
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
