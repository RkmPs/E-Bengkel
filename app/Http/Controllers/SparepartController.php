<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class SparepartController extends Controller
{
    //
    public function index(){

        $data = Sparepart::all();

        return Inertia::render('Admin/dashboard', [
            'data' => $data,
            'auth' => [
                'user' => Auth::guard('admin')->user(),
            ]
        ]);
    }
}
