<?php

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;


class SignController extends BaseController {
    
    public function checkAuth(){
        if (session('id') != null){
            return redirect('dashboard')->with('csrf_token', csrf_token());;
        }
        else 
            return view('login')->with('csrf_token', csrf_token());
    } 

    public function checkLogin(){
        
        if (session('id') != null){
            return redirect('dashboard');
        } else if (request('l-password') !== null){
            //I come from login form
            $user = User::where('Email', request('Email'))->first();
            if ($user !== null){
                if(Hash::check(request('l-password'), $user->Passwd)){
                    //login success
                    Session::put('CF', $user->CF);
                    Session::put('id', ($user->subscription()->first())->Account_ID);
                    return response()->json('success');
                } return ['error' => view('error')->with('error_text', 'Wrong Username-Password combo')->render()];
            } return ['error' => view('error')->with('error_text', 'Wrong Username-Password combo')->render()];
        } return ['error' => view('error')->with('error_text', 'Wrong Username-Password combo')->render()];  
    }

    public function checkRegister(){
        if (session('id') != null){
            return redirect('dashboard')->with('csrf_token', csrf_token());;
        } else {
            //check if email is valid
            $email = request('email');
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $response = array(
                    "error" => 'true',
                    "response" => view('error')->with('error_text', 'Insert a valid email!')->render()
                );
                return $response;
            } 
            //check if email exists
            if (User::where('Email', $email)->first() !== null){
                $response = array(
                "error" => 'true',
                "response" => view('error')->with('error_text', 'Email already exists!')->render()
                );
                return $response;
            } else {
                Session::put('temp_mail', $email);
                $response = array(
                    "error" => 'false',
                    "mail" => $email
                    );
                    return $response;
            }
        }
    }

    public function checkRegister2(){
        if (session('id') != null){
            return redirect('dashboard');
        } else if (session('temp_mail') !== null){
            //add not empty fields check

            $mail = session('temp_mail');
            $cf =  strtoupper(request('cf'));
            $type = request('type');
            $CF_FILTER = '/^[a-z]{6}[0-9]{2}[a-z][0-9]{2}[a-z][0-9]{3}[a-z]$/i';
            if (!preg_match($CF_FILTER, $cf)){
                $response['cf'] = view('error')->with('error_text', 'CF is not valid')->render();
            } 
            //get password 
            $r_password =request('r-password');
            if (preg_match('/^(?=.*[!@#$%^&*.-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $r_password)){
                //get confirmation password
                $c_password =request('c-password');
            if (strcmp($r_password, $c_password) == 0) {
                    //calculate password for storing into db
                    $pass = Hash::make($r_password);
                } else $response['c-password'] = view('error')->with('error_text', 'Passwords do not match!')->render();
            } else $response['r-password'] = view('error')->with('error_text', 'Password is not strong enough!')->render();
            
            //get name and surname
            $name = ucfirst(strtolower(request('name')));
            $surname = ucfirst(strtolower(request('surname')));
            if (!ctype_alpha(str_replace(array(' ', "'", '-'), '', $name))) $response['name'] =view('error')->with('error_text', 'Only letters are allowed!')->render();
            if (!ctype_alpha(str_replace(array(' ', "'", '-'), '', $surname))) $response['surname'] =view('error')->with('error_text', 'Only letters are allowed!')->render();
    
            //get phone number
            $phone = preg_replace('/\s+/', "", request('phone'));
            if (!ctype_digit($phone)) $response['phone'] = view('error')->with('error_text', 'Insert a valid phone number!')->render();
    
            //get residence
            $residence = request('residence');
            if (!ctype_alpha(str_replace(array(' ', "'", '-'), '', $residence))) $response['residence'] =view('error')->with('error_text', 'Only letters are allowed!')->render();
    
            $dob = request('dob');
            if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/",$dob)) $response['dob'] =  view('error')->with('error_text', 'Insert a valid date!')->render();
        }

        if (empty($response)){ 
            //no errors found, so we can insert the record into db
            $today = date("Y-m-d");
            $type === 'Pro' ? $fee = 7.50 : $fee = 3.50;  
            $date = Carbon::createFromFormat('d-m-Y', $dob)->format('Y-m-d');  

            $user = User::create([
                'CF' => $cf, 
                'Email'  => $mail ,
                'Name'  => $name,
                'Surname'  => $surname,
                'Residence'  => $residence,
                'Phone'  => $phone,
                'Passwd'  => $pass,
                'Dob'  => $dob
            ]);

            $account = Account::create([
                'Fee' => $fee, 
                'Type' => $type
            ]);             
            $account_id = $account->Account_ID;

            $subscription = Subscription::create([
                'CF' => $cf,
                'Account_ID' => $account_id,
                'StartDate' => $today
            ]);
            
            return array('success' => view('registration_success')->render());
            session()->forget('temp_mail');
        }
        
        return $response;
    }

    public function logout() {
        Session::flush();
        return redirect('login')->with('csrf_token', csrf_token());;
    }

}