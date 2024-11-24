<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;
use App\Models\Kategori_sparepart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class SparepartController extends Controller
{
    //
    public function index(){

        $spareparts = Sparepart::all();

        return Inertia::render('Admin/sparepart/index', [
            'spareparts' => $spareparts,
            'auth' => [
                'user' => Auth::guard('admin')->user(),
            ]
        ]);
    }

    public function create(){
        $kategori = Kategori_sparepart::all();
        return Inertia::render('Admin/sparepart/create',[
            'kategori' => $kategori
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'nama_sparepart' => 'required|string|max: 25',
            'harga' => 'required|number',
            'stok' => 'required|number',
            'image' => 'required|image',
            'kategori_id' => 'required',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/spareparts', $image->hashname());

        $sparepart = Sparepart::create([
            'nama_sparepart' => $request->nama_sparepart,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'image' => $image->hashName(),
            'kategori_id' => $request->kategori_id,
        ]);

        if($sparepart){
            return Redirect::route('sparepart.index')->with('message', 'success');
        }
    }
    public function edit(Sparepart $sparepart){
        return Inertia::render('Admin/sparepart/edit', 
            ['sparepart' => $sparepart,]);
    }

    public function update(Request $request, Sparepart $sparepart){
        $request->validate([
            'nama_sparepart' => 'required|string|max: 25',
            'harga' => 'required|number',
            'stok' => 'required|number',
            'kategori_id' => 'required',
        ]);

        if($request->hasFile('image')){

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/sparepart', $image->hashName());

            //delete old image
            Storage::delete('public/sparepart/'.$sparepart->image);

            //update product with new image
            $sparepart->update([
                'nama_sparepart' => $request->nama_sparepart,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'image' => $image->hashName(),
                'kategori_id' => $request->kategori_id,
            ]);
        }
        //edit tanpa image
        else{
            $sparepart->update([
               'nama_sparepart' => $request->nama_sparepart,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'kategori_id' => $request->kategori_id,
            ]); 
        }
        if($sparepart){
            return Redirect::route('sparepart.index')->with('message', 'success');
        } 
    }

    public function delete($id){

        $sparepart = Sparepart::findOrFail($id);
        Storage::delete('public/sparepart'.$sparepart->image);
        $sparepart->delete;
        if($sparepart){
            return Redirect::route('sparepart.index')->with('message', 'success');
        }
    }
}
