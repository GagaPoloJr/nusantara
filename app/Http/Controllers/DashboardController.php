<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Notification;
use App\Models\Option;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function index()
    {
        $request_month = '';
        $request_year = '';
        $company_id = '';
        $month = $request_month ?: 'ALL';
        $year = $request_year ?: date('Y');
        $company = $company_id ?: "ALL";
        $params = array(
            "company" => "TRUE",
            "month" => "TRUE",
            "year" => "TRUE"
        );
        $user = User::find(Auth::user()->user_id);
        $notifications = Notification::whereIn((new Notification())->getTable() . '.type', ['web'])
            ->where((new Notification())->getTable() . '.status', '=', null)
            ->where((new Notification())->getTable() . '.send_to', '=', Auth::user()->user_id)
            ->get();
        $companys = DB::table((new Company())->getTable())->orderBy('company_id')->get([
            'company_id',
            'company_name'
        ]);
        $version = Option::find('version_app')->value;
        if (User::find(Auth::user()->user_id)->hasRole(['Admin']) == true) {
            $companyUser = Company::all();
            $is_admin = true;
        } else {
            $companyUser = Company::whereIn('company_id', CompanyUser::where('user_id', '=', Auth::user()->user_id)->pluck('company_id'))->get();
            $is_admin = false;
        }
        return view('template.pages.dashboard.read', [
            'user' => $user,
            'notifications' => $notifications,
            'companys' => $companys,
            'companyUser' => $companyUser,
            'is_admin' => $is_admin,
            'version' => $version,
        ]);
    }

    public function updateNotification($id)
    {
        $notification = Notification::find($id);
        $notification->update([
            'status' => 'read',
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find($request->user_id_profile);
        $email = $user->email;
        $response = [];

        if (substr($user->no_hp, 0, 2) === '08') {
            $no_hp = '628' . substr($user->no_hp, 2, strlen($user->no_hp));
        } else {
            $no_hp = $user->no_hp;
        }

        if (substr($request->no_hp_profile, 0, 2) === '08') {
            $outbox_for = '628' . substr($request->no_hp_profile, 2, strlen($request->no_hp_profile));
        } else {
            $outbox_for = $request->no_hp_profile;
        }

        $user = [
            'user_name' => $request->user_name_profile,
            'update_by' => Auth::user()->user_name,
            'gender' => $request->gender_profile,
        ];

        if ($request->email_profile <> $email) {
            if (User::where('email', '=', $request->email_profile)->count() > 0) {
                array_push($response, [
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'message' => 'Email telah digunakan',
                    'status' => false,
                ]);
                return $response;
            } else {
                $user['email'] = $request->email_profile;

                if ($outbox_for <> $no_hp) {
                    if (User::where('no_hp', '=', $outbox_for)->count() > 0) {
                        array_push($response, [
                            'icon' => 'error',
                            'title' => 'Gagal!',
                            'message' => 'Nomor telah digunakan',
                            'status' => false,
                        ]);
                        return $response;
                    }
                } else {
                    $user['no_hp'] = $outbox_for;

                    if ($request->file('image_profile')) {
                        $imageName = strtolower(str_replace(' ', '_', $request->user_id_profile)) . '.' . $request->image_profile->extension();
                        $filepath = public_path('images\\') . strtolower(str_replace(' ', '_', $request->user_id_profile)) . '.' . $request->image_profile->extension();
                        File::delete($filepath);
                        $request->image_profile->move(public_path('images'), $imageName);
                        $user['image'] = 'images/' . $imageName;
                    }

                    if ($request->password_profile) {
                        $user['password'] = bcrypt($request->password_profile);
                    }

                    DB::beginTransaction();
                    try {
                        DB::table((new User())->getTable())->whereIn((new User())->getKeyName(), [$request->user_id_profile])->update($user);

                        DB::commit();
                        array_push($response, [
                            'icon' => 'success',
                            'title' => 'Berhasil',
                            'message' => 'data berhasil disimpan',
                            'status' => true,
                        ]);
                        return $response;
                    } catch (\Exception $e) {
                        DB::rollback();
                        throw $e;
                    }
                }
            }
        } else {
            if ($outbox_for <> $no_hp) {
                if (User::where('no_hp', '=', $outbox_for)->count() > 0) {
                    array_push($response, [
                        'icon' => 'error',
                        'title' => 'Gagal!',
                        'message' => 'Nomor telah digunakan',
                        'status' => false,
                    ]);
                    return $response;
                } else {
                    $user['no_hp'] = $outbox_for;
                    if ($request->file('image_profile')) {
                        $imageName = strtolower(str_replace(' ', '_', $request->user_id_profile)) . '.' . $request->image_profile->extension();
                        $filepath = public_path('images\\') . strtolower(str_replace(' ', '_', $request->user_id_profile)) . '.' . $request->image_profile->extension();
                        File::delete($filepath);
                        $request->image->move(public_path('images'), $imageName);
                        $user['image'] = 'images/' . $imageName;
                    }

                    if ($request->password) {
                        $user['password'] = bcrypt($request->password_profile);
                    }

                    DB::beginTransaction();
                    try {
                        DB::table((new User())->getTable())->whereIn((new User())->getKeyName(), [$request->user_id_profile])->update($user);
                        DB::commit();
                        array_push($response, [
                            'icon' => 'success',
                            'title' => 'Berhasil',
                            'message' => 'data berhasil disimpan',
                            'status' => true,
                        ]);
                        return $response;
                    } catch (\Exception $e) {
                        DB::rollback();
                        throw $e;
                    }
                }
            } else {
                if ($request->file('image_profile')) {
                    $imageName = strtolower(str_replace(' ', '_', $request->user_id_profile)) . '.' . $request->image_profile->extension();
                    $filepath = public_path('images\\') . strtolower(str_replace(' ', '_', $request->user_id_profile)) . '.' . $request->image_profile->extension();
                    File::delete($filepath);
                    $request->image_profile->move(public_path('images'), $imageName);
                    $user['image'] = 'images/' . $imageName;
                }

                if ($request->password_profile) {
                    $user['password'] = bcrypt($request->password_profile);
                }

                DB::beginTransaction();
                try {
                    DB::table((new User())->getTable())->whereIn((new User())->getKeyName(), [$request->user_id_profile])->update($user);
                    DB::commit();
                    array_push($response, [
                        'icon' => 'success',
                        'title' => 'Berhasil',
                        'message' => 'data berhasil disimpan',
                        'status' => true,
                    ]);
                    return $response;
                } catch (\Exception $e) {
                    DB::rollback();
                    throw $e;
                }
            }
        }
    }
    public function manualBook()
    {
        return response()->download(public_path() . '\\storage/MANUAL BOOK TICKETING MANAGEMENT SYSTEM.pdf');
    }
}
