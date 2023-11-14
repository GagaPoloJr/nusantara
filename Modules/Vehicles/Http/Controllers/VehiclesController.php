<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Models\FormCheck;
use App\Models\Vehicle;
use App\Models\VehicleCategory;
use App\Models\VehicleChecklist;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
        return view('vehicles::vehicles.show');
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
    public function destroy(Request $request, Vehicle $vehicle)
    {
        try {
            $vehicle->update([
                'deleted' => true,
                'delete_date' => now(),
                'delete_by' => Auth::user()->user_name,
                'delete_reason' => $request->reason
            ]);
            DB::commit();
            return 'data berhasil disimpan';
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    public function formAll()
    {
        if (Gate::allows('create vehicles')) {
            $form = FormCheck::all()->whereNotIn('deleted', true);
            return DataTables::of($form)
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
    public function formIndex()
    {
        if (Gate::allows('read vehicles')) {
            $version = Option::find('version_app')->value;
            $user = User::find(Auth::user()->user_id);
            $notifications = Notification::whereIn((new Notification())->getTable() . '.type', ['web'])
                ->where((new Notification())->getTable() . '.status', '=', null)
                ->where((new Notification())->getTable() . '.send_to', '=', Auth::user()->user_id)
                ->get();

            return view('vehicles::form.index', [
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
    public function formCreate()
    {
        return view('vehicles::form.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function formStore(Request $request)
    {
        if (Gate::allows('create vehicles')) {
            DB::beginTransaction();
            try {
                FormCheck::create([
                    'form_id' => FormCheck::max('form_id') + 1,
                    'form_name' => $request->form_name,
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
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function formEdit($id)
    {
        if (Gate::allows('update vehicles')) {
            $form = FormCheck::find($id);
            return view('vehicles::form.edit', [
                'form' => $form,
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
    public function formUpdate(Request $request, FormCheck $formCheck, $id)
    {
        try {
            $formCheck = FormCheck::findOrFail($id);
            $formCheck->update([
                'form_name' => $request->form_name,
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
    public function formDestroy(Request $request, FormCheck $formCheck, $id)
    {
        try {
            $formCheck = FormCheck::findOrFail($id);

            $formCheck->update([
                'deleted' => true,
                'delete_date' => now(),
                'delete_by' => Auth::user()->user_name,
                'delete_reason' => $request->reason,
            ]);

            DB::commit();

            return 'data berhasil disimpan';
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }



    // controller untuk checklist

    public function searchVehicles(Request $request)
    {
        $query = $request->input('query');
        $results = Vehicle::where('deleted', null)->where('vehicle_code', 'ILIKE', '%' . $query . '%')->get();
        return response()->json($results);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function checklistIndex()
    {
        if (Gate::allows('read vehicles')) {
            $version = Option::find('version_app')->value;
            $user = User::find(Auth::user()->user_id);
            $notifications = Notification::whereIn((new Notification())->getTable() . '.type', ['web'])
                ->where((new Notification())->getTable() . '.status', '=', null)
                ->where((new Notification())->getTable() . '.send_to', '=', Auth::user()->user_id)
                ->get();
            $vehicles = Vehicle::all()->whereNotIn('deleted', true);
            $forms = FormCheck::all()->whereNotIn('deleted', true);

            // $code = $request->input('code');
            // $vehicles_checklist = VehicleChecklist::where('vehicle_code', $code)->get();

            return view('vehicles::checklist.index', [
                'user' => $user,
                'notifications' => $notifications,
                'version' => $version,
                'vehicles' => $vehicles,
                'forms' => $forms
                // 'vehicles_checklist' => $vehicles_checklist
            ]);
        } else {
            abort(403, 'TIDAK PUNYA AKSES');
        }
    }

    public function getFormChecklist($code)
    {
        if (Gate::allows('create vehicles')) {

            $vehicles_checklist = VehicleChecklist::with('forms')->get()->where('vehicle_code', $code);
            return DataTables::of($vehicles_checklist)
                ->addIndexColumn()
                ->make(true);
        } else {
            abort(403, 'TIDAK PUNYA AKSES');
        }
    }

    public function checklistCreate(Request $request)
    {
        if (Gate::allows('read vehicles')) {
            $forms = FormCheck::all()->whereNotIn('deleted', true);

            return view('vehicles::checklist.create', [
                'forms' => $forms,
            ]);
        } else {
            abort(403, 'TIDAK PUNYA AKSES');
        }
    }

    public function checklistStore(Request $request)
    {
        if (Gate::allows('create vehicles')) {
            DB::beginTransaction();
            try {

                $payload = [
                    'checklist_id' => VehicleChecklist::max('checklist_id') + 1,
                    'vehicle_code' => $request->vehicle_code,
                    'form_id' => $request->form_id,
                    'create_by' => Auth::user()->user_name,

                ];
                VehicleChecklist::create(
                    $payload
                );

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

    public function checklistUpdate(Request $request, VehicleChecklist $vehicleChecklist)
    {
        try {
           
            $dataToUpdate = $request->input('initialData', []);
            $filterData =array_filter($dataToUpdate);

            // dd($filterData);
            if (!empty($filterData)) {
                $ids = array_column($filterData, 'checklist_id');
    
                foreach ($filterData as $record) {
                    $updateData = [
                        'is_good' => $record['is_good'],
                        'status' => $record['status'],
                        'update_by' => Auth::user()->user_name,
                    ];
    
                    // Update each record individually
                    VehicleChecklist::where('checklist_id', $record['checklist_id'])->update($updateData);
                }
    
              
            }
    
            DB::commit();
    

            return 'data berhasil diupdate';
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }



}
