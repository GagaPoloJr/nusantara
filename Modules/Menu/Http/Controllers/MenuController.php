<?php

namespace Modules\Menu\Http\Controllers;

use App\Models\Menu;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
use App\Models\Option;

class MenuController extends Controller
{

    public function all()
    {
        if (Gate::allows('read access')) {
            return DataTables::of(Menu::all()->whereNotIn('deleted', true))->addIndexColumn()->make(true);
        } else {
            abort(403, 'TIDAK PUNYA AKSES');
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (Gate::allows('read access')) {
            $version = Option::find('version_app')->value;
            $user = User::find(Auth::user()->user_id);
            $notifications = Notification::whereIn((new Notification())->getTable() . '.type', ['web'])
                ->where((new Notification())->getTable() . '.status', '=', null)
                ->where((new Notification())->getTable() . '.send_to', '=', Auth::user()->user_id)
                ->get();
            return view('menu::index', [
                'user' => $user,
                'notifications' => $notifications,
                'version' => $version,
            ]);
        } else {
            abort(403, 'TIDAK PUNYA AKSES');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('menu::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
        if (Gate::allows('create access')) {
            DB::beginTransaction();
            try {
                Menu::create([
                    'menu_id'     => Menu::max('menu_id') + 1,
                    'menu_name'     => $request->menu_name,
                    'url'           => $request->url,
                    'icon'          => $request->icon,
                    'main_menu'     => $request->main_menu,
                    'sort'          => $request->sort,
                    'description'   => $request->description,
                    'create_by'     => Auth::user()->user_name,
                ]);
                DB::commit();
                return 'data berhasil disimpan';
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        } else {
            abort(403, 'TIDAK PUNYA AKSES');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('menu::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        if (Gate::allows('update dictionary')) {
            $menu = Menu::find($id);
            // dd($submenu);
            return view('menu::edit',[
                'menu'=> $menu
            ]);
        } else {
            abort(403,'TIDAK PUNYA AKSES');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Menu $menu)
    {
        try {
            $menu->update([
                'menu_name'=>$request->sub_menu_name,
                'url'=>$request->url,
                'main_menu'=>$request->main_menu,
                'icon'=>$request->icon,
                'sort'=>$request->sort,
                'description'=>$request->description,
                'update_by'=>Auth::user()->user_name,
            ]);
            DB::commit();
            return 'data berhasil diupdate';
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request,Menu $menu)
    {
        try {
            $menu->update([
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
