<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
// use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\Travel;
use App\Models\User;
// use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TravelController extends Controller
{
    public function edittravel(Request $request)
    {
        $user_id = auth('api')->user()->nim;

        $travel = Travel::where('nim',[$user_id])
        ->where('id',[$request->id])
        ->first();

        if($travel){
            // $travel->id = generateRandomString();
            $travel->current_loc = $request->current_loc ? $request->current_loc : $travel->current_loc;
            $travel->destination = $request->destination ? $request->destination : $travel->destination;
            $travel->jumlah_passanger = $request->jumlah_passanger ? $request->jumlah_passanger : $travel->jumlah_passanger;
            $travel->total = $request->total ? $request->total : $travel->total;
            // $travel->nim = $user_id;
            // $travel->id_mobil = $request->id_mobil;
            // $travel->id_travel = $request->id_travel;
            // $travel->id_travel_agent = $request->id_travel_agent;
            // $travel->status = 1;
            $travel->departure = $request->departure ? $request->departure : $travel->departure;
            $travel->arrive = $request->arrive ? $request->arrive : $travel->arrive;
            $travel->jam_departure = $request->jam_departure ? $request->jam_departure : $travel->jam_departure;
            $travel->jam_arrive = $request->jam_arrive ? $request->jam_arrive : $travel->jam_arrive ;
            // $travel->jenis = 1;
            $travel->current_lat = $request->current_lat ? $request->current_lat : $travel->current_lat;
            $travel->current_long = $request->current_long ? $request->current_long : $travel->current_long;
            $travel->destination_lat = $request->destination_lat ?  $request->destination_lat :  $travel->destination_lat;
            $travel->destination_long = $request->destination_long ? $request->destination_long : $travel->destination_long;

            $travel->save();
            return response()->json($travel);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Di Reschdule!',
            ], 404);
        }
    }

    public function editdelivery(Request $request)
    {
        $user_id = auth('api')->user()->nim;

        $travel = Travel::where('nim',[$user_id])
        ->where('id',[$request->id])
        ->first();

        if($travel){
            // $travel->id = generateRandomString();
            $travel->current_loc = $request->current_loc ? $request->current_loc : $travel->current_loc;
            $travel->destination = $request->destination ? $request->destination : $travel->destination;
            $travel->jumlah_passanger = $request->jumlah_passanger ? $request->jumlah_passanger : $travel->jumlah_passanger;
            $travel->total = $request->total ? $request->total : $travel->total;
            // $travel->nim = $user_id;
            // $travel->id_mobil = $request->id_mobil;
            // $travel->id_travel = $request->id_travel;
            // $travel->id_travel_agent = $request->id_travel_agent;
            $travel->nama_sender = $request->nama_sender ? $request->nama_sender : $travel->nama_sender;
            $travel->no_sender = $request->no_sender ? $request->no_sender : $travel->no_sender;
            $travel->nama_receiver = $request->nama_receiver ? $request->nama_receiver : $travel->nama_receiver;
            $travel->no_receiver = $request->no_receiver ? $request->no_receiver : $travel->no_receiver;
            $travel->berat_paket = $request->berat_paket ? $request->berat_paket : $travel->berat_paket;
            // $travel->status = 1;
            $travel->departure = $request->departure ? $request->departure : $travel->departure;
            $travel->arrive = $request->arrive ? $request->arrive : $travel->arrive;
            $travel->jam_departure = $request->jam_departure ? $request->jam_departure : $travel->jam_departure;
            $travel->jam_arrive = $request->jam_arrive ? $request->jam_arrive : $travel->jam_arrive ;
            // $travel->jenis = 1;
            $travel->current_lat = $request->current_lat ? $request->current_lat : $travel->current_lat;
            $travel->current_long = $request->current_long ? $request->current_long : $travel->current_long;
            $travel->destination_lat = $request->destination_lat ?  $request->destination_lat :  $travel->destination_lat;
            $travel->destination_long = $request->destination_long ? $request->destination_long : $travel->destination_long;

            $travel->save();
            return response()->json($travel);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Di Reschdule!',
            ], 404);
        }
    }


    public function tambahtravel(Request $request){

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

        $user_id = auth('api')->user()->nim;

        $user = User::where('nim',[$user_id])->first();


        $travel = new Travel;

        $travel->id = generateRandomString();
        $travel->current_loc = $request->current_loc;
        $travel->destination = $request->destination;
        $travel->jumlah_passanger = $request->jumlah_passanger;
        $travel->total = $request->total;
        $travel->nim = $user_id;
        $travel->id_mobil = $request->id_mobil;
        // $travel->id_travel = $request->id_travel;
        $travel->id_travel_agent = $request->id_travel_agent;
        $travel->status = 1;
        $travel->departure = $request->departure;
        $travel->arrive = $request->arrive;
        $travel->jam_departure = $request->jam_departure;
        $travel->jam_arrive = $request->jam_arrive;
        $travel->jenis = 1;
        $travel->current_lat = $request->current_lat;
        $travel->current_long = $request->current_long;
        $travel->destination_lat = $request->destination_lat;
        $travel->destination_long = $request->destination_long;
        
        $travel->save();

        if ($travel) {
            return response()->json($travel);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Menambahkan Transaksi Travel!',
            ], 404);
        }
    }


    public function tambahdelivery(Request $request){

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

        $user_id = auth('api')->user()->nim;

        $user = User::where('nim',[$user_id])->first();


        $travel = new Travel;

        $travel->id = generateRandomString();
        $travel->current_loc = $request->current_loc;
        $travel->destination = $request->destination;
        // $travel->jumlah_passanger = $request->jumlah_passanger;
        $travel->total = $request->total;
        $travel->nim = $user_id;
        $travel->id_mobil = $request->id_mobil;
        // $travel->id_travel = $request->id_travel;
        $travel->id_travel_agent = $request->id_travel_agent;
        $travel->nama_sender = $request->nama_sender;
        $travel->no_sender = $request->no_sender;
        $travel->nama_receiver = $request->nama_receiver;
        $travel->no_receiver = $request->no_receiver;
        $travel->berat_paket = $request->berat_paket;
        $travel->status = 1;
        $travel->departure = $request->departure;
        $travel->arrive = $request->arrive;
        $travel->jam_departure = $request->jam_departure;
        $travel->jam_arrive = $request->jam_arrive;
        $travel->jenis = 2;
        $travel->current_lat = $request->current_lat;
        $travel->current_long = $request->current_long;
        $travel->destination_lat = $request->destination_lat;
        $travel->destination_long = $request->destination_long;
        
        $travel->save();

        if ($travel) {
            return response()->json($travel);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Menambahkan Transaksi Delivery!',
            ], 404);
        }
    }
}

?>