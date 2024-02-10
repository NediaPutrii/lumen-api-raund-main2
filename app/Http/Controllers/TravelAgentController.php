<?php

namespace App\Http\Controllers;

use App\Models\TravelAgent;
// use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use DB;
use Carbon\Carbon;

class TravelAgentController extends Controller
{

    public function index()
    {
        $travellist = DB::select("SELECT mobils.id as id_mobil , * from mobils join travel_agents on mobils.id_travel_agent=travel_agents.id_travel_agent");
        $response = new \stdClass();
        $response->tanggal = Carbon::now()->toDateString();
        $response->jumlah_data = 0;
        $response->travellist = $travellist;
        return response()->json($response);
    }

    public function store(Request $request){
        $this->validate($request, [
            'id_travel_agent' => 'required|unique:travel_agents',
            'nama_travel' => 'required',
            'gambar' => 'required'
        ]);
        $id_travel_agent = $request->input('id_travel_agent');
        $nama_travel = $request->input('nama_travel');
        $gambar = $request->input('gambar'); 

        $travel_agent = TravelAgent::create([
            '$id_travel_agent' => $id_travel_agent,
            'nama_travel' => $nama_travel,
            'gambar' => $gambar

        ]);

        return response()->json(['message' => 'Pendaftaran pengguna berhasil dilaksanakan']);
    }

    public function tambahtravelagent(Request $request){

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

        // $user = User::where('nim',[$user_id]->first();


        $travel_agent = new TravelAgent;

        $travel_agent ->id = generateRandomString();
        $travel_agent ->id_travel_agent = generateRandomString();
        $travel_agent ->nama_travel = $request->nama_travel;
        $travel_agent ->gambar= $request->gambar;
        
        $travel_agent->save();

        if ($travel_agent) {
              //berhasil login, kirim notifikasi
              $this->sendNotification();

            return response()->json($travel_agent);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Menambahkan Transaksi Travel!',
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
                "title" : "TBL TBL TBL!!!", 
                "body" : "Travel Baru Lhoooh!!!"
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
