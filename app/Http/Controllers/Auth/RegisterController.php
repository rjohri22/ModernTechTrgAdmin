<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'loginverification';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            'occupation' => ['required', 'string', 'max:255'],
            'curruntly_employeed' => ['required', 'string', 'max:255'],
            'total_work_experience' => ['required', 'string', 'max:255'],
            'last_job_title' => ['required', 'string', 'max:255'],
            'last_job_company' => ['required', 'string', 'max:255'],
            'last_job_company_duration' => ['required', 'string', 'max:255'],
            'annual_inhand_salary' => ['required', 'string', 'max:255'],
            'available_to_join' => ['required', 'string', 'max:255'],
            'education' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'phone' => ['required', 'numeric'],
            // 'address' => ['required', 'string','max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'name' => $data['first_name'],
            'email' => $data['email'],
            'country' => $data['country'],
            'phone' => $data['mobile'],
            // 'mobile' => $data['mobile'],
            'occupation' => $data['occupation'],
            'curruntly_employeed' => $data['curruntly_employeed'],
            'total_work_experience' => $data['total_work_experience'],
            'last_job_title' => $data['last_job_title'],
            'last_job_company' => $data['last_job_company'],
            'last_job_company_duration' => $data['last_job_company_duration'],
            'annual_inhand_salary' => $data['annual_inhand_salary'],
            'available_to_join' => $data['available_to_join'],
            'education' => $data['education'],
            'group_id' => 2,
            // 'address' => $data['address'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
