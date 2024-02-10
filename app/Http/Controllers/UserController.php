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

class UserController extends Controller
{
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
        $post = DB::select("SELECT * from users where nim=?", [$user_id]);
        
        // $post = DB::select("SELECT travel.id as travel_id, * from travel 
        // join travel_agents on travel.id_travel_agent=travel_agents.id_travel_agent where travel.nim='$user_id'");

    // $post = Travel::where('nim','=',$nim)->get();

    if ($post) {
        return response()->json([
            'success'   => true,
            'message'   => 'Data My Setting!',
            'setting'      => $post
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Post Tidak Ditemukan!',
        ], 404);
    }
    }

    public function shows()
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
        
        $post = User::where('nim',$user_id)->first();
        // $post = DB::select("SELECT * from users where nim=?", [$user_id]);
        
        // $post = DB::select("SELECT travel.id as travel_id, * from travel 
        // join travel_agents on travel.id_travel_agent=travel_agents.id_travel_agent where travel.nim='$user_id'");

    // $post = Travel::where('nim','=',$nim)->get();

    if ($post) {
        return response()->json($post);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Post Tidak Ditemukan!',
        ], 404);
    }
    }

    public function changepassword(Request $request)
    {
  
            $user_id = auth('api')->user()->nim;

            $user = User::where('nim',[$user_id])->first();

            if ($user) {
                // $user->nim = $request->nim ? $request->nim : $user->nim  ;
                // $user->nama = $request->nama ? $request->nama: $user->nama  ;
                // $user->email = $request->email ? $request->email: $user->email  ;
            $isValidPassword = Hash::check($request->passwordlama, $user->password);
                if (!$isValidPassword) {
                    return response()->json(['message' => 'Passwor Lama Salah'], 401);
                }else{
                    if($request->passwordbaru1==$request->passwordbaru2){
                        $user->password = Hash::make($request->passwordbaru1) ;
                    }else{
                        return response()->json(['message' => 'Password Tidak Sama'], 401);

                    }
                    
                }

                $user->save();
        
                return response()->json($user);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Tidak Ditemukan!',
                ], 404);
            }
    
    }

    public function edits(Request $request)
    {
        //tampilkan data / get data duls
        
            // $input= $request->all();
            $user_id = auth('api')->user()->nim;

            $user = User::where('nim',[$user_id])->first();


            if ($user) {
                $user->nim = $request->nim ? $request->nim : $user->nim  ;
                $user->nama = $request->nama ? $request->nama: $user->nama  ;
                $user->email = $request->email ? $request->email: $user->email  ;
                $user->no_telepon = $request->no_telepon ? $request->no_telepon : $user->no_telepon  ;

                $user->save();
        
                return response()->json($user);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Tidak Ditemukan!',
                ], 404);
            }
    
    }

    

    public function edit(Request $request)
    {
        //tampilkan data / get data duls
        
            // $input= $request->all();
            $user_id = auth('api')->user()->nim;

            $user = User::where('nim',[$user_id])->first();

            // $this->validate($request, [
            //     'nim' => 'string',
            //     'nama' => 'string',
            //     'email' => 'email',
            //     'no_telepon' => 'string'
            // ]);
            // $nim = $request->input('nim');
            // $nama = $request->input('nama');
            // $email = $request->input('email');
            // $no_telepon = $request->input('no_telepon');
   

            // $post = DB::select("UPDATE users set nama='$nama',nim='$nim', email='$email', no_telepon='$no_telepon' where nim=?", 
            // [$user_id]);
        
            
            // $user = User::update([
            //     'nim' => $nim,
            //     'nama' => $nama,
            //     'email' => $email,
            //     'no_telepon' => $no_telepon
          
    
            // ]);
    
            // return response()->json(['message' => 'Data Berhasil Diubah',
            // 'data' => $user]);


            // return response()->json(['data' => $user]);

            //batas copy
    
            // $post = DB::select("SELECT * from users where nim=?", [$user_id]);
            
        //    ["nama"->$input["nama"], ["nim"->$input["nim"], ["no_telepon"->$input["no_telepon"], ["email"->$input["email"]]
            // DB::select("SELECT * from users where nim=?", [$user_id])->update($request->all());
            // $post= DB::table("users")->where('nim',[$user_id])->update(
            //     [
            //     'nama'=>$input['nama'],
            //     'nim'=>$input['nim'],
            //     'no_telepon'=>$input['no_telepon'],
            //     'email'=>$input['email']
            // ]);
            // ["nama"->$input["nama"], ["nim"->$input["nim"], ["no_telepon"->$input["no_telepon"], ["email"->$input["email"]]]
            // return response()->json("data sudah di update");

            if ($user) {
                $user->nim = $request->nim ? $request->nim : $user->nim  ;
                $user->nama = $request->nama ? $request->nama: $user->nama  ;
                $user->email = $request->email ? $request->email: $user->email  ;
                $user->no_telepon = $request->no_telepon ? $request->no_telepon : $user->no_telepon  ;

                $user->save();
        
                return response()->json([
                    'success'   => true,
                    'message'   => 'Data Sudah di Update',
                    'editprofile'      => $user
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Tidak Ditemukan!',
                ], 404);
            }
        
            
            // if($_SERVER['REQUEST_METHOD']=='POST'){
            //     //MEndapatkan Nilai Dari Variable
            //     $id = $_POST['id'];
            //     $nama = $_POST['nama'];
            //     $nim = $_POST['nim'];
            //     $no_telepon = $_POST['no_telepon'];
            //     $email = $_POST['email'];
                
            //     //import file koneksi database
            //     require_once('koneksi.php');
                
            //     //Membuat SQL Query
            //     $sql = "UPDATE tb_pegawai SET nama = '$name', posisi = '$desg', gajih = '$sal' WHERE id = $id;";
            
            //     //Meng-update Database
            //     if(mysqli_query($con,$sql)){
            //     echo 'Berhasil Update Data Pegawai';
            //     }else{
            //     echo 'Gagal Update Data Pegawai';
            //     }
            //     mysqli_close($con);
            // }
    }


    public function register(Request $request){
        $this->validate($request, [
            'nim' => 'required|unique:users',
            'nama' => 'required',
            'email' => 'required|unique:users|email',
            'no_telepon' => 'required',
            'password' => 'required|min:6'
        ]);
        $nim = $request->input('nim');
        $nama = $request->input('nama');
        $email = $request->input('email');
        $no_telepon = $request->input('no_telepon');
        $password = Hash::make($request->input('password'));

        $user = User::create([
            'nim' => $nim,
            'nama' => $nama,
            'email' => $email,
            'no_telepon' => $no_telepon,
            'password' => $password
            
        ]);

        return response()->json(['message' => 'Pendaftaran pengguna berhasil dilaksanakan',
        'data' => $user]);
        // return response()->json(['data' => $user]);

    }
}
