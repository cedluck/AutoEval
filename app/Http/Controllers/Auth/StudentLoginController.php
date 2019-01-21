<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class StudentLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:student', ['except' => ['logout']]);
    }
    
    public function showLoginForm()
    {
      return view('auth.student_login');
    }
    
    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'name'   => 'required',
        'password' => 'required|min:6'
      ]);
      
      // Attempt to log the user in
      if (Auth::guard('student')->attempt(['name' => $request->name, 'password' => $request->password])) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('student.dashboard'));
      } 
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('name'));
    }
    
    public function logout()
    {
        Auth::guard('student')->logout();

        return redirect('/');
    }
}
