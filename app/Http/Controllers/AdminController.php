<?php

namespace App\Http\Controllers;

use App\Services\Lecloud;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Liveinfo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        view()->share('title','管理员后台');
    }

    public function getIndex()
    {
        $user_count = User::count();
        $act_count = Liveinfo::count();

        return view('admin.config.index',[
            'user_number' => $user_count,
            'act_number' => $act_count,
        ]);
    }

    public function getActivity(){
        $act_count = Liveinfo::count();
        $livingUser = Liveinfo::select('id','uid','title','activityId')->get();

        $livingInfo = [];

        foreach ($livingUser as $user){
            $act_count--;
            $livingInfo[$act_count]['id'] = $user['id'];
            $livingInfo[$act_count]['uid'] = $user['uid'];
            $livingInfo[$act_count]['title'] = $user['title'];
            $livingInfo[$act_count]['activityId'] = $user['activityId'];
        }

        return view('admin.config.activity',[
            'livingInfo' => $livingInfo,
        ]);
    }

    public function getActivityInfo($id){
        $live_info = Liveinfo::select('uid','title','description','activityId','ctime')->where('uid',$id)->first();
        $user_info = User::find($id);

        if($live_info) {
            $live_status = true;
            $act_info['uid'] = $live_info['uid'];
            $act_info['title'] = $live_info['title'];
            $act_info['description'] = $live_info['description'];
            $act_info['activityId'] = $live_info['activityId'];
            $act_info['ctime'] = date('Y-m-d H:i:s', $live_info['ctime']);
            $act_info['name'] = $user_info['name'];
            $act_info['email'] = $user_info['email'];
        }else{
            $live_status = false;
            $act_info = null;
        }

        return view('admin.config.activityinfo',[
            'live_status' => $live_status,
            'act_info' => $act_info,
        ]);
    }

    public function postStopActivity($id){
        $liveinfo = Liveinfo::select('activityId')->where('uid',$id)->first();
        $activityId = $liveinfo->activityId;
        Lecloud::stopActivity($activityId);
        if(Liveinfo::where('uid',Auth::user()->id)->delete()){
            return redirect()->to('admin/actinfo');
        }else{
            return redirect()->to("admin/actinfo/$id");
        }
    }

    public function getUsers(){
        $users = User::select('id','name','email')->where('status','1')->get();

        $all_user_info = [];
        foreach ($users as $user){
            $user_info['id'] = $user['id'];
            $user_info['name'] = $user['name'];
            $user_info['email'] = $user['email'];
            array_push($all_user_info,$user_info);
        }

        return view('admin.config.users',[
            'users_info' => $all_user_info,
        ]);
    }

    public function postBlockUser($id){
        User::where('id',$id)->update(['status'=>0]);
        return redirect()->to('admin/users');
    }

    public function getBlockedUsers(){
        $users = User::select('id','name','email')->where('status','0')->get();

        $all_user_info = [];
        foreach ($users as $user){
            $user_info['id'] = $user['id'];
            $user_info['name'] = $user['name'];
            $user_info['email'] = $user['email'];
            array_push($all_user_info,$user_info);
        }

        return view('admin.config.blocked',[
            'users_info' => $all_user_info,
        ]);
    }

    public function postUnblockUser($id){
        User::where('id',$id)->update(['status'=>1]);
        return redirect()->to('admin/blocked');
    }
}