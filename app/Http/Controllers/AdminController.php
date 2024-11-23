<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function dashboard(){
        return Inertia::render('Admin/dashboard', [
            'auth' => [
                'user' => Auth::guard('admin')->user(),
            ],
            'status' => session('status'),
        ]);
    }
    //
    public function index(){
        return Inertia::render('Admin/login', [
            'status' => session('status'),
        ]);
    }
    public function login(Request $request){

        $check = $request->all();

        if(Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']])){
            return Inertia::render('Admin/dashboard', [
                'status' => session('status'),
            ]);
        }
        else{
            return back()->with('Error', 'salah password atau email');
        }
    }
}
