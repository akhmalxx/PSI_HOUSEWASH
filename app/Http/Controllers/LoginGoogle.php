<?php

namespace App\Http\Controllers;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LoginGoogle extends Controller
{
    //
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback()
    {
        // Google user object dari google
        try {
            $user = Socialite::driver('google')->stateless()->user();
          //  $userFromDatabase = User::where('google_id', $user->getId())->first();
           $finduser = User::where('email', $user->email)->first();


            if($finduser){

                Auth::login($finduser);

                $finduser->google_id = $user->getId();
                $finduser->save();

                return redirect()->intended('dashboard');

            }
            else{

                return redirect('/')->withErrors(['error' => 'Email Belum Terdaftar']);

             }

        } catch (Exception $e) {

           return redirect('/')->withErrors(['error' => 'Terjadi kesalahan Saat Terhubung Google']);

        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function login_action(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
             'password' => 'required',
           ],[
             'email.required' => 'Username  Wajib Diisi.',
             'password.required' => 'Passsword Wajib Diisi.',

        ]);
         if ($validator->fails()) {

            return back()->withErrors($validator);

         }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard-general-dashboard');
        }

        return back()->withErrors("User/Password Tidak tepat");
    }

 //return response()->json(['status' => false, 'error' => $validator->errors()]);

     // return back()->withErrors([
        //     'error' => 'Wrong username or password',
        // ]);

        //echo $validator->errors();
            //print_r($validator);
           // echo $validator['email'];

    public function dashboard(){
         $form="dashboard-general-dashboard";
        return view('dashboard-general-dashboard',compact('form'));
    }



    public function register_action(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email,'. $request->id,
             'angkatan' => 'required',
             'name' => 'required',
             'nim' => 'required',
             'jurusan' => 'required',
             'prodi' => 'required'
           ],[
             'email.required' => 'email Wajib Diisi.',
             'email.unique' => 'email Sudah Digunakan.',
             'angkatan.required' => 'Angkatan Wajib Diisi.',
             'name.required' => 'Nama Wajib Diisi.',
             'nim.required' => 'Nim Wajib Diisi.',
             'prodi.required' => 'Prodi Wajib Diisi',
             'jurusan.required' => 'jurusan.required',

        ]);


         if ($validator->fails()) {

             return response()->json(['status' => false, 'errors' => $validator->errors()]);
         }
         $user=new User;
         $user->email=$request->email;
         $user->name=$request->name;
         $user->nim=$request->nim;
         $user->password=Hash::make($request->password);
         $user->angkatan=$request->angkatan;
         $user->jurusan=$request->jurusan;
         $user->prodi=$request->prodi;

         $user->save();
         return response()->json(['status' => true]);

    }


}

              // $newUser = User::create([
                //     'name' => $user->name,
                //     'email' => $user->email,
                //     'google_id'=> $user->id,
                //     'password' =>Hash::make("12345678"),
                // ]);

                // Auth::login($newUser);
                 //return redirect()->intended('dashboard');
