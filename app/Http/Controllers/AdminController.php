<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Author;
use App\Admin;

class AdminController extends Controller {
    
    public function getLogin() {
        return view('auth.login');
    }
    
        
   public function postLogin(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
       

        if (Auth::attempt([
            'username' => $request['username'],                    
            'password' => $request['password'] ])) { 
            return redirect()->route('index');            
        }
        return redirect()->back()->with(['fail' => 'invalid username or password']);

    }
    
   public function getLogout() {
    if (Auth::check()) {
        Auth::logout();
    }
       return redirect()->route('index');
   }
         
    
    public function getRegister() {  
        return view('auth.register');
    }
    
    public function postRegister(Request $request) {
        
        $admin = new Admin();
    
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:admins|max:30|min:3',
            'password' => 'required|min:5',
            'password_confirm' => 'required'           
        ]);
  
        $password = $request['password'];
        $passwordConfirm = $request['password_confirm'];
        
        if ($password !== $passwordConfirm) {
            return redirect()->back()->with(['fail' => 'password fields do not match!']);
        }     
        
        $hashedPassword = Hash::make($password);
         
        $admin->name = $request['name'];
        $admin->username = $request['username'];
        $admin->password = $hashedPassword;
        $admin->save();
        
        return redirect()->route('index')->with(['success' => 'Successfully created account!']);       
  
    }
 
    
    public function getDashboard() {
        
        if (!Auth::check()) {
            return redirect()->route('login')->with
                (['fail' => 'Please login or signup to view this page']);
        }
    
        $user = Auth::user();
        $quotes = $user->quotes()->get();  
        
        return view('auth.dashboard', ['quotes' => $quotes]);       
    }
    
}