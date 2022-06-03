<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Profile;
class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $id = Auth::id();  
        if($user->profile == null)
        {
            $profile = Profile::create([

                'user_id'=>$id,
                'gender' =>'gender',
                'bio' =>'',
                'facebook' =>''

            ]);

        }


        return view("users.profile")->with('user',$user);

    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
           
            'gender' =>'required',
            'bio' =>'required',
            'facebook' =>'required'

        ]);
        $user = Auth::user();
        $user->name = $request->name;
        $user->profile->gender = $request->gender;
        $user->profile->bio = $request->bio;
        $user->profile->facebook = $request->facebook;
        $user->profile->save();
     
        if($request->has('password')){
            $user->password = Hash::make($request->password); 
        }
        $user->save();
       // return redirect()->back()->withErrors($validator)->withInput();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
