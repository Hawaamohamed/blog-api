<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Profile;
use Hash;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
     
    public function index()
    {
        $users = User::all();
        return view("users.index")->with('users', $users);
    }
 
    public function create()
    {
        return view("users.create");
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'confirm_password' => ['same:password', 'required', 'string', 'min:8', 'confirmed'],

 
        ]);
 
         
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
        ]);
        $profile = Profile::create([

            'user_id' => $user->id,
            'gender' => 'Male',
            'bio' => '',
            'facebook' => '',

        ]);
        return redirect()->route('users');
    }
 
    public function destroy($id)
    {
        $user = User::find($id);
        $user->profile->delete();
        $user->delete();
        return redirect()->route('users');
    } 
 
     
    public function user_posts($id)
    {
        $user_posts = Post::where('user_id', $id)->get();
        return view("users.posts")->with('user_posts', $user_posts);
    }
 
    public function active($id)
    {
        $user = User::find($id);
        $user->review = 1;
        $user->save();
        $token = "fSoLS71_Zk8:APA91bHBHLx6QyZIyd7BDt_vuhVTIhozKc_hckqEfxvlejJmewE8byUGwSEWska5UGe_pCqVvcjRDgy0Czm-76pXAAR-jvyqSy8I5LtCeRipTFeqh8oD5lWmNn61ywGpR4mU43ITleze";  
        $from = "AAAACqW2UT8:APA91bFxX1IRKMLr0vnuB52m6dvVqHfYVppPt7XpM4vxMxFcaW5NSiwhDgEKsgyv-_YUPjnMIVW3eRAe56IHVT_4MKI6cJ-gL1SY8bilUukU8_5PyrzAR3HRtcHdySPWmsvZAmtPHK_D";
        $msg = array
              (
                'body'  => "Admin has Activate your status",
                'title' => "Hi " . $user->name . ", From Blog",
                'receiver' => $user->name,
                'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                'sound' => 'mySound'/*Default sound*/
              );

        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server 
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
       // dd($result);
        curl_close( $ch );
         
        return redirect()->back();
         
    }
 
    public function disactive($id)
    {
        $user = User::find($id);
        $user->review = 0;
        $user->save();$token = "fSoLS71_Zk8:APA91bHBHLx6QyZIyd7BDt_vuhVTIhozKc_hckqEfxvlejJmewE8byUGwSEWska5UGe_pCqVvcjRDgy0Czm-76pXAAR-jvyqSy8I5LtCeRipTFeqh8oD5lWmNn61ywGpR4mU43ITleze";  
        $from = "AAAACqW2UT8:APA91bFxX1IRKMLr0vnuB52m6dvVqHfYVppPt7XpM4vxMxFcaW5NSiwhDgEKsgyv-_YUPjnMIVW3eRAe56IHVT_4MKI6cJ-gL1SY8bilUukU8_5PyrzAR3HRtcHdySPWmsvZAmtPHK_D";
        $msg = array
              (
                'body'  => "Admin has Disactivate your status",
                'title' => "Hi " . $user->name . ", From Blog",
                'receiver' => $user->name,
                'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                'sound' => 'mySound'/*Default sound*/
              );

        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server 
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
       // dd($result);
        curl_close( $ch );
         
        return redirect()->back();
         
    }
}
