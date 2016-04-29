<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;

use App\Services\Lecloud;
use App\Models\Liveinfo;
use App\Models\Cover;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    protected $livestatus;

    //Account控制器,需验证通过
    public function __construct()
    {
        $this->middleware('auth');
        view()->share('title','直播管理');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(){
        view()->share('livestatus',$this->getLivestatus());
        if(!$this->isBlocked()){
            return view('account.config.blocked');
        }

        return view('account.config.index');
    }

    public function getCreate(){
        if(!$this->isBlocked()){
            return redirect()->to('account');
        }
        view()->share('livestatus',$this->getLivestatus());
        if($this->getLivestatus()){
            return redirect()->to('account');
        }
        return view('account.config.create');
    }

    public function postCreate(Request $request){
        if(!$this->isBlocked()){
            return redirect()->to('account');
        }
        if($this->getLivestatus()){
            return redirect()->to('account');
        }

        $config['livename'] = $request->input('livename') ? $request->input('livename') : $request->user()->name.'的直播';
        $config['record'] = $request->input('record') ? 1 : 0;
        $config['codeRateTypes'] = '99';
        if($request->input('rate4'))
            $config['codeRateTypes'] .= ',25';
        if($request->input('rate3'))
            $config['codeRateTypes'] .= ',19';
        if($request->input('rate2'))
            $config['codeRateTypes'] .= ',16';
        if($request->input('rate1'))
            $config['codeRateTypes'] .= ',13';

        $result = Lecloud::creatActivity($config);
        $res_arr  = json_decode($result,true);
        $activityId = array_key_exists('activityId', $res_arr) ? $res_arr['activityId'] : false;
        if($activityId){
            $Liveinfo = new Liveinfo();
            $Liveinfo->uid = Auth::user()->id;
            $Liveinfo->ctime = time();
            $Liveinfo->title = $config['livename'];
            $Liveinfo->description = $request->input('livedes') ? $request->input('livedes') : '暂无简介';
            $Liveinfo->activityId = $activityId;
            if($Liveinfo->save()){
                return redirect()->to('/account/info');
            }else{
                return redirect()->to('/account/create');
            }
        }else
            return redirect()->to('/account/create');
    }

    public function getStop(){
        if(!$this->isBlocked()){
            return redirect()->to('account');
        }
        view()->share('livestatus',$this->getLivestatus());
        if(!$this->getLivestatus()){
            return redirect()->to('account/create');
        }
        return view('account.config.stop');
    }

    public function postStop(){
        if(!$this->isBlocked()){
            return redirect()->to('account');
        }
        if(!$this->getLivestatus()){
            return redirect()->to('account/create');
        }

        $liveinfo = Liveinfo::select('activityId')->where('uid',Auth::user()->id)->first();
        $activityId = $liveinfo->activityId;
        Lecloud::stopActivity($activityId);
        if(Liveinfo::where('uid',Auth::user()->id)->delete()){
            return redirect()->to('account/create');
        }else{
            return redirect()->to('account/stop');
        }
    }

    public function getInfo(){
        if(!$this->isBlocked()){
            return redirect()->to('account');
        }
        view()->share('livestatus',$this->getLivestatus());
        if(!$this->getLivestatus()){
            return redirect()->to('account/create');
        }

        $liveinfo = Liveinfo::select('activityId')->where('uid',Auth::user()->id)->first();
        $activityId = $liveinfo->activityId;
        $json = Lecloud::getPushUrl($activityId);
        $arr = json_decode($json,true);
        $pushAll = array_key_exists('lives',$arr) ? $arr['lives'][0]['pushUrl'] : null;
        $pushUrl = 'rtmp://w.gslb.lecloud.com/live';
        $pushKey = str_replace('rtmp://w.gslb.lecloud.com/live/','',$pushAll);

        return view('account.config.info',[
            'pushUrl' => $pushUrl,
            'pushKey' => $pushKey,
            'pushAll' => $pushAll,
        ]);
    }

    public function getCover(){
        view()->share('livestatus',$this->getLivestatus());
        if(!$this->isBlocked()){
            return redirect()->to('account');
        }
        $uid = Auth::user()->id;

        if(Cover::where('uid',$uid)->count()){
            $coverinfo = Cover::select('cover')->where('uid',$uid)->first();
            $cover = $coverinfo['cover'];
        }else{
            $cover = '';
        }

        return view('account.config.cover',[
            'cover' => $cover,
        ]);
    }

    public function postCover(Request $request){
        if(!$this->isBlocked()){
            return redirect()->to('account');
        }
        $uid = Auth::user()->id;

        if(!$request->hasFile('cover')){
            return redirect()->to('/account/cover');
        }
        $file = $request->file('cover');
        //判断文件上传过程中是否出错
        if(!$file->isValid()){
            return redirect()->to('/account/cover');
        }

        $destPath = realpath(public_path('cover'));
        if(!file_exists($destPath))
            mkdir($destPath,0755,true);

        $fileMimeType = $file->getClientMimeType();
        $fileType = str_replace('image/','.',$fileMimeType);
        $filename = md5($file->getClientOriginalName()).$fileType;

        if(!$file->move($destPath,$filename)){
            return redirect()->to('/account/cover');
        }else{
            if(Cover::where('uid',$uid)->count()){
                Cover::where('uid',$uid)->update(['cover'=>$filename]);
            }else{
                $cover = new Cover();
                $cover->uid = $uid;
                $cover->cover = $filename;
                $cover->save();
            }
            return redirect()->to('/account/cover');
        }
    }

    public function getLivestatus()
    {
        $this->livestatus = DB::table('liveinfo')->where('uid',Auth::user()->id)->count();
        return $this->livestatus;
    }

    public function getUsername(){
        if(!$this->isBlocked()){
            return redirect()->to('account');
        }
        view()->share('livestatus',$this->getLivestatus());
        return view('account.config.username');
    }

    public function postUsername(Request $request){
        if(!$this->isBlocked()){
            return redirect()->to('account');
        }
        $uid = Auth::user()->id;
        $username = $request->input('newUsername');
        if(strlen($username)>4){
            $user = User::find($uid);
            $user->name = $username;
            $user->save();
            return redirect()->to('account');
        }else{
            return redirect()->to('account/username');
        }
    }

    public function getEmail(){
        if(!$this->isBlocked()){
            return redirect()->to('account');
        }
        view()->share('livestatus',$this->getLivestatus());
        return view('account.config.email');
    }

    public function postEmail(Request $request){
        if(!$this->isBlocked()){
            return redirect()->to('account');
        }
        $uid = Auth::user()->id;
        $newEmail = $request->input('newEmail');
        $pattern="/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
        if(preg_match($pattern,$newEmail)){
            $user = User::find($uid);
            $user->email = $newEmail;
            $user->save();
            return redirect()->to('account');
        } else{
            return redirect()->to('account/email');
        }
    }

    public function isBlocked(){
        $result = \App\Models\User::select('status')->where('id',Auth::user()->id)->first();
        $blockStatus = $result->status;
        return $blockStatus;
    }
}
