<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessNotificationRegister;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Notification;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $companys=Company::all()->whereNotIn('deleted',true);
        return view('auth.register',[
            'companys'=>$companys
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $response=[];

        if (substr( $request->no_hp, 0, 2 ) === '08') {
            $outbox_for = '628'.substr( $request->no_hp, 2, strlen($request->no_hp) );
        } else {
            $outbox_for = $request->no_hp;
        }

        if (User::where('email','=',$request->email)->count() > 0 ) {
            array_push($response,[
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => 'Email telah digunakan',
                'status' => false,
            ]);
            return $response;
        } else {
            if (User::where('no_hp','=',$outbox_for)->count() > 0 ) {
                array_push($response,[
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'message' => 'Nomor telah digunakan',
                    'status' => false,
                ]);
                return $response;
            } else {
                //NOTIFICATION
               /* $args = [
                    'message' =>'Haii',
                    'outbox_for' => $outbox_for
                ];
                ProcessNotificationRegister::dispatch($args);*/

                DB::beginTransaction();
                try {
                    $user = [
                        'user_id'=>User::max('user_id')+1,
                        'user_name'=> $request->user_name,
                        'email'=> $request->email,
                        'create_by'=>null,
                        'email_verified_at'=>now(),
                        'password'=>bcrypt($request->password),
                        'remember_token'=> Str::random(10),
                        'no_hp'=> $outbox_for,
                        'gender'=> $request->gender,
                    ];
                    if ($request->file('image')) {
                        $imageName = strtolower(str_replace(' ', '_', $request->user_name)).'.'.$request->image->extension();
                        $filepath= public_path('images\\').strtolower(str_replace(' ', '_', $request->user_name)).'.'.$request->image->extension();
                        File::delete($filepath);
                        $request->image->move(public_path('images'), $imageName);
                        $user['image']='images/'.$imageName;
                    } else {
                        if ($request->gender == 'L') {
                            $user['image']='images/300-1.jpg';
                        } else {
                            $user['image']='images/300-2.png';
                        }
                    }
                    $save = User::create($user);
                    if ($save) {
                        CompanyUser::create([
                            'company_user_id'=> CompanyUser::max('company_user_id')+1,
                            'user_id'=> $save['user_id'],
                            'company_id'=> $request->company,
                            'as_owner'=> false,
                        ]);
                        $save->assignRole('User');

                    }
                    DB::commit();
                    array_push($response,[
                        'icon' => 'success',
                        'title' => 'Berhasil',
                        'message' => 'Silahkan login',
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
}
