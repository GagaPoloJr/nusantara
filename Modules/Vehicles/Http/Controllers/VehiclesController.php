<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
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

    public function all()
    {
        if (Gate::allows('create vehicles')) {
            $vehicles = Vehicle::with('vehicleCategory')->get()->whereNotIn('deleted', true);
            return DataTables::of($vehicles)
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
        if (Gate::allows('read vehicles')) {
            $version = Option::find('version_app')->value;
            $user = User::find(Auth::user()->user_id);
            $notifications = Notification::whereIn((new Notification())->getTable() . '.type', ['web'])
                ->where((new Notification())->getTable() . '.status', '=', null)
                ->where((new Notification())->getTable() . '.send_to', '=', Auth::user()->user_id)
                ->get();
            $total_vehicles = Vehicle::count();
            return view('vehicles::vehicles.index', [
                'user' => $user,
                'notifications' => $notifications,
                'version' => $version,
                'total' => $total_vehicles
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
        $categories = VehicleCategory::all();
        return view('vehicles::vehicles.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $vehicle_code = Vehicle::generateCodeVehicle();
        if (Gate::allows('create vehicles')) {
            DB::beginTransaction();
            try {
                Vehicle::create([
                    'vehicle_id' => Vehicle::max('vehicle_id') + 1,
                    'vehicle_name' => $request->vehicle_name,
                    'vehicle_number' => $request->vehicle_number,
                    'vehicle_code' => $vehicle_code,
                    'category_id' => $request->vehicle_category,
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
        return view('vehicles::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        if (Gate::allows('update vehicles')) {
            $vehicle = Vehicle::with('vehicleCategory')->find($id);
            $vehicle_category = VehicleCategory::all()->whereNotIn('deleted', true);
            return view('vehicles::vehicles.edit', [
                'vehicle_category' => $vehicle_category,
                'vehicle' => $vehicle
            ]);
        } else {
            abort(403, 'TIDAK PUNYA AKSES');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        try {
            $vehicle->update([
                'vehicle_name' => $request->vehicle_name,
                'vehicle_number' => $request->vehicle_number,
                'category_id' => $request->category_id,
                'update_by' => Auth::user()->user_name,
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
    public function destroy(Request $request, Vehicle  $vehicle)
    {
        try {
            $vehicle->update([
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
