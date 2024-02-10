<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

// use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\SavedAddress;
use App\Models\User;

class SavedAddressController extends Controller
{
    public function index()
    {
        $saved_addres = SavedAddress::all();

        return response()->json([
            'success' => true,
            'message' =>'List Semua Post',
            'data'    => $saved_addres
        ], 200);
    }
    
    public function show($nim)
    {
    $post = SavedAddress::where('nim','=',$nim)->get();

    if ($post) {
        return response()->json([
            'success'   => true,
            'message'   => 'Detail Post!',
            'data'      => $post
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Post Tidak Ditemukan!',
        ], 404);
    }
    }

    public function store(Request $request){
        $this->validate($request, [
            'nama_address' => 'required',
            'address' => 'required',
            'nim' => 'required'
            
        
        ]);
        $nama_address = $request->input('nama_address');
        $address = $request->input('address');
        $nim = $request->input('nim');
        // $nim = $request->input('nim');

        // $nim = '1811521017' ;
        $savedaddress = SavedAddress::create([
            'nama_address' => $nama_address,
            'address' => $address,
            'nim' => $nim
            // 'nim' => $nim
    
        ]);
    }
}
