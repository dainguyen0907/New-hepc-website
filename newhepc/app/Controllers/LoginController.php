<?php

namespace App\Controllers;
use App\Common\ResultUtils;
use App\Services\baivietService;
use App\Services\userService;


class LoginController extends BaseController
{

    private $baivietService;
    private $userService;
    public function __construct() {
        $this->baivietService=new baivietService();
        $this->userService=new userService();
    }
    public function index()
    {
        $masterPage=[];
        $title="HEPC";
        $page='subMasterPage';
        $dataLayout['Banner']="Đăng nhập";
        $dataLayout['content']=view('pages/login');
        $dataLayout['Pager']=null;
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $NewPaperPage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('masterPage',$NewPaperPage);
    }

    public function login()
    {
        $res=$this->userService->login($this->request);
        if($res['status']===ResultUtils::STATUS_CODE_OK)
        {
            return redirect('/');
        }
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }
    public function logout()
    {
        if(session('userLogin'))
        {
            session_destroy();
        }
        return redirect('/');
    }
}
