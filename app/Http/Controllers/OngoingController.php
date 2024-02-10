<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
// use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\Travel;
use App\Models\User;
// use Auth;
use Illuminate\Support\Facades\Auth;

class OngoingController extends Controller
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
        $post = DB::select("SELECT travel.id as travel_id,nim, * from travel join travel_agents on travel.id_travel_agent=travel_agents.id_travel_agent where travel.status=1 and travel.nim=?", [$user_id]);
        
        // $post = DB::select("SELECT travel.id as travel_id, * from travel 
        // join travel_agents on travel.id_travel_agent=travel_agents.id_travel_agent where travel.nim='$user_id'");

    // $post = Travel::where('nim','=',$nim)->get();

    if ($post) {
        return response()->json([
            'success'   => true,
            'message'   => 'Detail Ongoing Travel!',
            'data'      => $post
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
    public function edits(Request $request)
    {
        //tampilkan data / get data duls
        
            // $input= $request->all();
            // $user_id = auth('api')->user()->nim;
           $id = $request->id;

            $user = Travel::where('id',[$id])   
            ->first();


            if ($user) {
                //berhasil login, kirim notifikasi
            // $this->sendNotification();

                $user->status = 2;
             
                $user->save();
        
                return response()->json($user);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Tidak Ditemukan!',
                ], 404);
            }
    
    }

    public function sendNotification(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "to" : "/topics/pengumuman",
            "notification" :{
                "title" : "Hai Maniez", 
                "body" : "Perjalanan Kamu Sudah Berakhir Ya"
            }
        }',
          CURLOPT_HTTPHEADER => array(
            'Authorization: key=AAAAiAVppSo:APA91bGc9cz6NXrZpotwqwSCMDf6n-yk4wrZmJFfQCwMZI83vMUzQji4sXFANniuEmfLxZlb--uAXQ6mKocICs3BColCOGkbvZ2g6sJU_G-9JtdXITXuEyGpnlvIs0HWcEpFLD7nYRZo',
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
      
        
    }

}
