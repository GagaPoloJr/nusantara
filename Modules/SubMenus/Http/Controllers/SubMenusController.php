<?php

namespace Modules\SubMenus\Http\Controllers;

use App\Models\Menu;
use App\Models\SubMenu;
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

class SubMenusController extends Controller
{

    public function all()
    {
        if (Gate::allows('read access')) {
            
            $subMenus = SubMenu::with('menus')->get()->whereNotIn('deleted',true);
            return DataTables::of($subMenus)
            ->addIndexColumn()
            ->make(true);
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
            return view('submenus::index', [
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
        if (Gate::allows('read dictionarydata')) {
            $menus = Menu::all()->whereNotIn('deleted', true);
            return view('submenus::create', [
                'menus' => $menus,
            ]);
        } else {
            abort(403, 'TIDAK PUNYA AKSES');
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if (Gate::allows('create access')) {
            DB::beginTransaction();
            try {
                SubMenu::create([
                    'sub_menu_id' => SubMenu::max('sub_menu_id') + 1,
                    'sub_menu_name' => $request->sub_menu_name,
                    'sort' => $request->sort,
                    'url' => $request->url,
                    'menu_id' => $request->menu_id,
                    'create_by' => Auth::user()->user_name,
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
        return view('submenus::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        if (Gate::allows('update dictionary')) {
            $submenu = Submenu::with('menus')->find($id);
            // dd($submenu);
            $menus = Menu::all()->whereNotIn('deleted', true);
            return view('submenus::edit',[
                'submenu'=>$submenu,
                'menus'=> $menus
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
    public function update(Request $request,SubMenu $submenu)
    {
        try {
            $submenu->update([
                'sub_menu_name'=>$request->sub_menu_name,
                'url'=>$request->url,
                'menu_id'=>$request->menu_id,
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
    public function destroy(Request $request,SubMenu $submenu)
    {
        try {
            $submenu->update([
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
