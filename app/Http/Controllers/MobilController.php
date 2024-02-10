<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
// use Laravel\Lumen\Routing\Controller as BaseController;

use Illuminate\Http\Response;
use App\Models\Mobil;


class MobilController extends Controller
{
    public function index()
    {
        $mobil = Mobil::all();

        return response()->json([
            'success' => true,
            'message' =>'List Semua Post',
            'data'    => $mobil
        ], 200);
    }
    
    public function show($id_travel_agent)
    {
    $get = Mobil::where('id_travel_agent',$id_travel_agent)->get();

    if ($get) {
        return response()->json([
            'success'   => true,
            'message'   => 'Detail Post!',
            'data'      => $get
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
     
    //     $savedaddress = SavedAddress::create([
    //         'nama_address' => $nama_address,
    //         'address' => $address,
    //         'nim' => $nim
           
    
    //     ]);
    // }

    public function tambahmobil(Request $request){

        function generateRandomString($length = 5)
        {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
        }

        // $user_id = auth('api')->user()->nim;

        // $user = User::where('nim',[$user_id])->first();

        $mobil= new Mobil;

        $mobil ->id = generateRandomString();
        $mobil->nama_mobil= $request->nama_mobil;
        $mobil ->kapasitas= $request->kapasitas;
        $mobil ->status= $request->status;
        $mobil ->jam_departure= $request->jam_departure;
        $mobil ->delivery_fee= $request->delivery_fee;
        
        $mobil ->travel_fee= $request->travel_fee;
        $mobil ->id_travel_agent= $request->id_travel_agent;
       
        
        $mobil->save();

        if ($mobil) {
              //berhasil login, kirim notifikasi
              $this->sendNotification();

            return response()->json($mobil);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Menambahkan Mobil!',
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
                "title" : "Tok Tok", 
                "body" : "Ada Mobil Baru Maniez <3"
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
