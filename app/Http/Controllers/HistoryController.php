<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
// use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\Travel;
use App\Models\User;
// use Auth;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $ongoing = Travel::all();

        return response()->json([
            'success' => true,
            'message' =>'List Semua Travel Ongoing',
            'data'    => $ongoing
        ], 200);
    }
    
    public function show()
    {
        // $credentials = $request->only(['username', 'password']);
        // $token = auth()->guard('api')->attempt($credentials);
        // $user_id = auth()->user()->nim; 
        // $user_id = Auth::user()->id();
            // $user_id = Auth::user()->id;

        // var_dump ($user_id);
        $user_id = auth('api')->user()->nim;

        // $user_id = auth()->guard('api')->user()->nim;  
        // $user_id = auth()->guard('api')
        $post = DB::select("SELECT travel.id as travel_id,nim, * from travel join travel_agents on travel.id_travel_agent=travel_agents.id_travel_agent where travel.status=2 and travel.nim=?", [$user_id]);
        
        // $post = DB::select("SELECT travel.id as travel_id, * from travel 
        // join travel_agents on travel.id_travel_agent=travel_agents.id_travel_agent where travel.nim='$user_id'");

    // $post = Travel::where('nim','=',$nim)->get();

    if ($post) {
        return response()->json([
            'success'   => true,
            'message'   => 'Detail Ongoing Travel!',
            'history'      => $post
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Post Tidak Ditemukan!',
        ], 404);
    }
    }

    // public function store(Request $request){
    //     $this->validate($request, [
    //         'nama_address' => 'required',
    //         'address' => 'required',
    //         'nim' => 'required'
            
        
    //     ]);
    //     $nama_address = $request->input('nama_address');
    //     $address = $request->input('address');
    //     $nim = $request->input('nim');
    //     // $nim = $request->input('nim');

    //     // $nim = '1811521017' ;
    //     $savedaddress = SavedAddress::create([
    //         'nama_address' => $nama_address,
    //         'address' => $address,
    //         'nim' => $nim
    //         // 'nim' => $nim
    
    //     ]);
    // }
}
