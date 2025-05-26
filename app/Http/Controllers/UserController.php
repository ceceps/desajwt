<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\UserRole;
use Webpatser\Uuid\Uuid;
use Auth;
use App\Artikel;
use App\DesaWisata;
use App\ProfilDesa;
use App\UserProfil;
use Illuminate\Contracts\Validation\Rule;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public static function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:150',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $credentials = $request->only('email', 'password');

        try {
            $token = JWTAuth::attempt($credentials);
            if (!$token) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        if(!empty($credentials)){
            $user = User::where('email',$credentials['email'])->join('user_role','user_role.user_id','users.id')->join('roles','roles.id','user_role.role_id')->select('users.*','roles.*')->get();
            foreach($user as $rsp){
                $user = $rsp->fullname;
                $apikey = $rsp->api_key;
            }

            //dd($user);
            return response()->json(compact('token','apikey'));
        }
        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:200',
            'email' => 'required|string|email|max:200|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'telp' => 'required|string|min:6'
        ]);

        $target = $request->post('target');
        $source = $request->post('source');

        if ($validator->fails()) {
            if ($target == 'backend/register' || $target == '/register') {
                return redirect($target)
                    ->withErrors($validator)
                    ->withInput();
            } else {
                //Via API
                return response()->json($validator->errors()->toJson(), 400);
            }
        }
        try {
            $rember_token = str_replace('-','',Str::uuid());
            $apikey = Str::uuid();

            $user = new User;
            $user->api_key = $apikey;
            $user->remember_token = $rember_token;
            $user->fullname = $request->post('fullname');
            $user->email = $request->post('email');
            $user->telp = $request->post('telp');
            $user->password = Hash::make($request->get('password'));
            $user->confirm_code = str_random(36);
            $user->created_by = 0;
            $user->created_at = date('Y-m-d h:i:s');
            $user->updated_by = 0;
            $user->updated_at = date('Y-m-d h:i:s');
            if ($user->save()) {
                $token = JWTAuth::fromUser($user);

                $userRole = [
                    'user_id' => $user['id'],
                    'role_id' => ($request->post('source') == 'admin_register') ? 2 : 3, //2 = Admin Kab/Kota, 3=user biasa
                ];

                $role = UserRole::create($userRole);
                //proses kirim email


                if ($source == 'admin_register') {
                    self::sendEmail($user, $user['email'], "Notifikasi", "Konfirmasi Member Desa Wisata Jawa Barat", "confirm/" . $user['confirm_code']);
                    return redirect('/backend/verify');
                } else if ($source == 'user_register') {
                    return redirect(' /verify ');
                } else {
                    //via API
                    return response()->json(compact(' user ', ' token '), 201);
                }
            } else {
                $pesan = "Gagal Simpan";
                if ($target == 'backend/register' || $target == '/register') {
                    return redirect($target)
                        ->withErrors($pesan)
                        ->withInput();
                } else {
                    //Via API
                    return response()->json(array(' message ' => ' Gagal Register Tidak bisa Simpan'), 500);
                }
            }
        } catch (UnsatisfiedDependencyException $e) {
            $pesan = ' Caught exception : ' . $e->getMessage() . "\n";
            return response()->json(array(' message ' => ' Gagal Register ' . $pesan), 500);
        }
    }

    public function getAuthenticatedUser()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json([' user_not_found '], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json([' token_expired '], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([' token_invalid '], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json([' token_absent '], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }

    public static function sendEmail($data, $tujuan, $subjek = "NOTIFICATION", $title = "konfirm member Desa Wisata Jabar", $page_url = '', $cc = '')
    {
        // Configuration
       # ------------------
        # Create a campaign\
        # ------------------

        # Include the SendinBlue library\
            ///require_once(__DIR__ . "/APIv3-php-library/autoload.php");

        # Instantiate the client\
                // SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey("api-key", "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");

                // $api_instance = new SendinBlue\Client\Api\EmailCampaignsApi();
                // $emailCampaigns = new \SendinBlue\Client\Model\CreateEmailCampaign();

    # Define the campaign settings\
            $emailCampaigns = array(
                "name" => "Konfirm Desa Wisata Jawa Barat",
                "subject" => "Konfirmasi Daftar Email",
                "sender" => array("name" => "Desa Wisata Jabar", "email" => "konsultanblog@gmail.com"),
                "type" => "classic",

        # Content that will be sent\
                "htmlContent" => "Selemat Anda telah terdaftar di Desa Wisata Jawa Barat. Anda Akan dihubungi langsung via Telp untuk pengecekan keabsahan Data",

        # Select the recipients\
                "recipients" => array("listIds" => [2, 7]),

        # Schedule the sending in one hour\
                "scheduledAt" => "2018-01-01 00:00:01"
            );

        # Make the call to the client\
        try {
            //$result = $api_instance->createEmailCampaign($emailCampaigns);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling EmailCampaignsApi->createEmailCampaign: ', $e->getMessage(), PHP_EOL;
        }
        //$message;
    }

    public function listUserBackend(){
        $title_page = 'Manajemen Pengguna';
        // $users = User::with('roles')->get();
        //$users = User::all();

        $users = User::with('roles')->where('status',1)->get();
        $userstdkaktif = User::with('roles')->where('status',0)->get();
        $userblokir = User::with('roles')->where('status',2)->get();

        return view('admin.pages.user.index_user',compact('title_page','users','userstdkaktif','userblokir'));
    }

    public function getCurrentUser(){
        $title_page = 'Profil '.Auth::user()->name;
        $profil = User::with('userProfil')->findOrFail(Auth::user()->id);

        return view('admin.pages.user.profil_user',compact('profil','title_page'));
    }

    public function getUserById($id){
        $title_page = 'Edit Profil';
        $user = User::with('userProfil.kelurahan.kecamatan.kabupaten','roles')->findOrFail($id);

        $roles = count($user->roles)>0? $user->roles[0]['name']:'';
        if($user->lastlogin !=null)
            $lastlogin = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$user->lastlogin)->format('d-m-Y H:i:s');
        else
            $lastlogin ='';
        $urlApiKelurahan = route('api.kelterm', 32);

        $artikel = Artikel::with('user')->where('author_id',$id)->get();
        $jumArtikel = $artikel->count();
        $lastArtikel = $artikel->last();

        $desawisata = DesaWisata::with('user')->where('author_id',$id)->get();
        $jumDesaWisata = $desawisata->count();
        $lastDesaWisata = $desawisata->last();
        //dd();
        if($user->kelurahan !=null){
            $desa = ProfilDesa::with('user')->where('author_id',$id)->get();
            $jumDesa = $desa->count();
            $postDesaTerakhir = $jumDesa>0 ? $desa[$jumDesa-1]->created_at:$desa[0]->created_at;
            $postDesaTerakhir = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',  $postDesaTerakhir)->format('d-m-Y H:i:s');
        }else{
            $desa = '';
            $jumDesa =0;
            $postDesaTerakhir ='';
        }

        if(count($artikel)){
            $postArtikelTerakhir = $lastArtikel->created_at!=null?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',  $lastArtikel->created_at)->format('d-m-Y H:i:s'):'';

        }else {
            $postArtikelTerakhir ='';
        }

        if(count($desawisata)){
            $postDesaWisataTerakhir = $jumDesaWisata>0 ? $lastDesaWisata->tgl_terdata:'';
            $postDesaWisataTerakhir = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',  $postDesaWisataTerakhir)->format('d-m-Y H:i:s');
        }else{
            $postDesaWisataTerakhir='';
        }

        $hakroles = Role::pluck('name','id')->all();
        return view('admin.pages.user.profil_user',compact('title_page','roles','hakroles','urlApiKelurahan','lastlogin','jumArtikel','jumDesaWisata','postArtikelTerakhir','postDesaWisataTerakhir','postDesaTerakhir'))->with('profil',$user);
    }

    public function create(){
        $title_page = 'Tambah Pengguna';
        $hakroles = Role::pluck('name','id')->all();
        $urlApiKelurahan = route('api.kelterm', 32);

        return view('admin.pages.user.create_user',compact('title_page','hakroles','urlApiKelurahan'));
    }
    public function store(Request $request){

        $rules = [
            'name'    => 'required|string|max:191',
            'email'  => 'required|email|max:191|unique:users',
            'telp'  => 'required|string|max:15',
            'alamat'  => 'required|string|max:191',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|int',
            'status'  => 'required',
         ];


        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            return redirect()->route('backend.user.create')->withErrors($validator)->withInput();
        } else {
            $success = false;

            DB::beginTransaction();
            try {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->status = $request->status;
                $user->password = Hash::make($request->password);
                $updateuser = $user->save();

                $userprofil  = new UserProfil();
                if($request->hasFile('avatar') && $request->file('avatar')->isValid() ){
                    $file = $request->file('avatar');
                    $name = time().str_slug($request->name).'.'.$file->getClientOriginalExtension();
                    $userprofil->avatar = $name;
                    $file->move(config('desawisata.PATH_IMAGE_AVATAR'), $name);
                }

                $userprofil->alamat = $request->alamat;
                $userprofil->bio = $request->bio;
                $userprofil->user_id = $user->id;
                $userprofil->kel_id = $request->kel_id;
                $userprofil->kec_id = $request->kec_id;
                $userprofil->kab_id = $request->kab_id;
                $userprofil->prov_id = 32;

                //set Role
                $user->assignRole($request->role_id);

                if($updateuser && $proil = $userprofil->save()){
                    $success = true;
                }else
                    $success = false;

            }catch(\Exception $e){

                return redirect('backend/user/edit/'.$request->id)->withErrors($e)->withInput();
            }

            if ($success) {
                DB::commit();
                // return Redirect::back()->withSuccessMessage('Artikel Berhasil Disimpan');
                return redirect('backend/users')->with('success', 'User  berhasil diupdate ');
            } else {
                DB::rollback();
                return redirect()->back()->with('error', 'User Gagal diupdate');
            }

        }
    }
    public function postUpdates(Request $request){

        if(isset($request->password)){
            $rules = [
                'name'    => 'required|string|max:191',
                'email'  => 'required|email|max:191|unique:users,email,'.$request->id,
                'password'  => 'required|string|min:6',
                'alamat'  => 'required|max:191',
                'role_id' => 'required|string',
                'status'  => 'required|int',
             ];
        }else{
            $rules = [
                'name'    => 'required|string|max:191',
                'email'  => 'required|email|max:191|unique:users,email,'.$request->id,
                'alamat'  => 'required|max:191',
                'role_id' => 'required|string',
                'status'  => 'required|int',
             ];

        }


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->with('error',$validator->errors()->all())->withInput();
        } else {
            $success = false;

            DB::beginTransaction();
            try {
                $user = User::findOrFail($request->id);

                $user->name = $request->name;
                $user->telp = $request->telp;
                $user->email = $request->email;
                $user->status = $request->status;
                if (isset($request->password)) {
                    $user->password = Hash::make($request->password);
                }
                $updateuser = $user->save();
                //update roles
                $user->assignRole($request->role_id);

                $profil = UserProfil::where('user_id', $request->id)->first();
                if($profil)
                    $userprofil  = UserProfil::findOrFail($profil->id);
                else
                    $userprofil  = new UserProfil();

                if($request->hasFile('avatar') && $request->file('avatar')->isValid() ){
                    $file = $request->file('avatar');
                    $name = time().str_slug($request->name).'.'.$file->getClientOriginalExtension();

                    //hapus file sebelumnya
                    if(isset($profil->avatar))
                        unlink(config('desawisata.PATH_IMAGE_AVATAR').$profil->avatar);
                    $file->move(config('desawisata.PATH_IMAGE_AVATAR'), $name);
                    $userprofil->avatar = $name;
                }
                $userprofil->alamat = $request->alamat;
                $userprofil->user_id = $user->id;
                $userprofil->bio = $request->bio;
                $userprofil->kel_id = $request->kel_id;
                $userprofil->kec_id = $request->kec_id;
                $userprofil->kab_id = $request->kab_id;
                $prof = $userprofil->save();


                if($updateuser && $prof){
                    $success = true;
                }else
                    $success = false;

            }catch(\Exception $e){
                dd($e->getMessage());
                return redirect('backend/user/edit/'.$request->id)->withErrors($e)->withInput();
            }

            if ($success) {
                DB::commit();
                // return Redirect::back()->withSuccessMessage('Artikel Berhasil Disimpan');
                return redirect('backend/users')->with('success', 'User  berhasil diupdate ');
            } else {
                DB::rollback();
                return redirect()->back()->with('error', 'User Gagal diupdate');
            }

        }
    }

    public function softdelete($id){
        $profil = User::findOrFail($id);
        $profil->status = 0;
        $profil->save();

        return redirect()->back()->with('success','User Berhasil dipindahkan ke tidak Aktif');
    }


    public function countUser($status='userbiasa'){
        if($status != ''){
            $sql = "select extract(year from created_at) as yr, extract(month from created_at) as mon,
                                count(*) jum
                        from users
                        where tipe_user!='".$status."' and tipe_user!='konsultan'
                        group by extract(year from created_at), extract(month from created_at)
                        order by yr, mon";
            $query = DB::select($sql);
            return $query;
        }else{
            $jumUser = User::count();
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with(['success' => 'User: <strong>' . $user->name . '</strong> Dihapus']);
    }

    //frontend user profile
    public function showProfil($id){
       $title_page = "Profil Pengguna";
       if($id>0){
           $profil = User::with('userProfil')->findOrFail($id);
           if($profil->lastlogin !=null)
                $lastlogin = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$profil->lastlogin)->format('d-m-Y H:i:s');
            else
                $lastlogin ='';
           return view('frontend.pages.user.profil',compact('title_page','profil','lastlogin'));
       }else{
           return error(404);
       }
    }

    public function updateProfil(Request $request){
        if($request->password!=null){
            $rules = [
                'name'    => 'required|string|max:191',
                'email'  => 'required|email|max:191|unique:users,email,'.$request->id,
                'password'  => 'required|string|confirmed|min:6',
                'alamat'  => 'required|max:191',
                'telp'  => 'nullable|string|max:15',
                'bio'  => 'nullable|string|max:255',
             ];
        }else{
            $rules = [
                'name'    => 'required|string|max:191',
                'email'  => 'required|email|max:191|unique:users,email,'.$request->id,
                'alamat'  => 'required|max:191',
                'telp'  => 'nullable|string|max:15',
                'bio'  => 'nullable|string|max:255',
             ];

        }

        $this->validate($request,$rules);
        $success = false;
        $error = '';
        DB::beginTransaction();
        try {
            $user = User::findOrFail($request->id);

            $user->name = $request->name;
            $user->telp = $request->telp;
            $user->email = $request->email;
            if (isset($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $updateuser = $user->save();
            $userprofil = UserProfil::findOrFail($request->id);
            if($request->hasFile('avatar') && $request->file('avatar')->isValid() ){
                $file = $request->file('avatar');
                $name = time().str_slug($request->name).'.'.$file->getClientOriginalExtension();

                //hapus file sebelumnya
                if(isset($profil->avatar)) unlink(config('desawisata.PATH_IMAGE_AVATAR').$profil->avatar);
                $file->move(config('desawisata.PATH_IMAGE_AVATAR'), $name);
                $userprofil->avatar = $name;
            }
            $userprofil->alamat = $request->alamat;
            $userprofil->user_id = $user->id;
            $userprofil->bio = $request->bio;
            $prof = $userprofil->save();

            if($updateuser && $prof){
                $success = true;
            }else
                $success = false;
        }catch(\Exception $e){
            $error .= $e->getMessage();
        }

        if($success){
            DB::commit();
            return redirect()->back()->with('success','Profil Berhasil diupdate');
        }else{
            DB::rollback();
            dd($error);
            return redirect()->back()->with('errors','Profil Gagal diupdate '.$error)->withInput();
        }

    }
}
