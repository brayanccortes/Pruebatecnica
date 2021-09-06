<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class formcontroller extends Controller
{
    public function index(){
        return view('formulario');
    }

    public function register(Request $request){
        $credentials = $request->validate([
            'name' => ['required'],
            'last_name' => ['required'],
            'document_number' => ['required'],
            'cellphone_number' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = new User();
        $user->name = $request->get('name');

        $user->last_name = $request->get('last_name');

        $user->document_number = $request->get('document_number');

        $user->cellphone_number = $request->get('cellphone_number');

        $user->email = $request->get('email');
        $password = $request->get('password');
        $hash = Hash::make($password);
        $user->password= $hash;
        
        //var_dump($user->toArray());
        
        $user->save();
        return view('index');
    }

    public function login(Request $request){

        $user = User::where('email', $request->get('email'))->first();
        if(!empty($user)){
            //var_dump($user->toArray());
            if(Hash::check($request->get('password') ,$user->password)){
                echo 'exito';
            }
        }else{
            echo 'No encontramos resultados';
        }


    }



}
