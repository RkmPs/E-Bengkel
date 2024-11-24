<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //


    public function index()
    {
        return Inertia::render('Admin/login', [
            'status' => session('status'),
        ]);
    }
    public function login(Request $request)
    {

        $check = $request->all();

        if (Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return redirect()->route('admin.dashboard');
        } else {
            return back()->with('Error', 'salah password atau email');
        }
    }
    public function dashboard()
    {
        return Inertia::render('Admin/dashboard', [
            'auth' => [
                'user' => Auth::guard('admin')->user(),
            ],
            'status' => session('status'),
        ]);
    }

    public function showAdmin()
    {
        $datas = Admin::latest()->get();
        return Inertia::render('Admin/adminControl', [
            'datas' => $datas,
            'auth' => [
                'user' => Auth::guard('admin')->user(),
            ]
        ]);
    }

    public function addAdmin()
    {
        return Inertia::render('Admin/create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => ['required', 'confirmed'],
            'nama_admin' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . Admin::class,
            'no_telp' => 'required|string|max:64',
        ]);

        $admin = Admin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama_admin' => $request->nama_admin,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
        ]);
        return redirect()->route('admin.show');
    }

    public function edit(Admin $admin){
        return Inertia::render('Admin/edit', [
            'admin' => $admin
        ]);
    }

    public function update(Request $request, Admin $admin){
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => ['required', 'confirmed'],
            'nama_admin' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . Admin::class,
            'no_telp' => 'required|string|max:64',
        ]);

        $admin = Admin::update([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama_admin' => $request->nama_admin,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
        ]);
        return redirect()->route('admin.show');

    }

    public function destroy($id)
    {
        //find post by ID
        $admin = Admin::findOrfail($id);

        //delete post
        $admin->delete();

        if($admin) {
            return Redirect::route('admin.show')->with('message', 'Data Berhasil Dihapus!');
        }

    }

}