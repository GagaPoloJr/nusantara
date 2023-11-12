<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Notification;
use App\Models\Option;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (Gate::allows('create vehicles')) {
            $version = Option::find('version_app')->value;
            $user = User::find(Auth::user()->user_id);
            $notifications = Notification::whereIn((new Notification())->getTable() . '.type', ['web'])
                ->where((new Notification())->getTable() . '.status', '=', null)
                ->where((new Notification())->getTable() . '.send_to', '=', Auth::user()->user_id)
                ->get();
            $vehicles = Vehicle::all()->whereNotIn('deleted', true);
            return view('vehicles::vehicles.index', [
                'user' => $user,
                'notifications' => $notifications,
                'version' => $version,
                'vehicles' => $vehicles
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
        return view('vehicles::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('vehicles::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('vehicles::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
