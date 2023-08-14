<?php

namespace App\Controllers;
use App\Common\encryptLibary;
use App\Common\libary;
use App\Services\admin_lienheService;



class Admin_ContactController extends BaseController
{
    private $lienheService;
    private $encrypt;
    public function __construct()
    {
        $this->lienheService= new admin_lienheService();
        $this->encrypt=new encryptLibary();
    }
    public function index()
    {
        $masterPage = [];
        $title = "Liên hệ";
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables,"assets/js/modal.js"];
        $page = 'adminPage/pages/contactPage';
        $dataLayout['contact']=$this->lienheService->getAllContactById_pb(session('userLogin')['id_pb']);
        $dataLayout['encrypt']=$this->encrypt->getEncryptLibary();
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }

    public function loadContactDetailPage($id_lh)
    {
        $data=$this->lienheService->getContactDetailById_lh($id_lh);
        if($data==null)
        {
            return $this->load404page();
        }
        $masterPage = [];
        $title = "Liên hệ";
        $page = 'adminPage/pages/contactDetail';
        $dataLayout['contactDetail']=$data;
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout,[], []);
        return view('adminPage/masterPage', $AdmissionPage);
    }

    public function changeStatusContact($id_lh)
    {
        $res=$this->lienheService->changeToTrueStatusContact($id_lh,session('userLogin')['id_pb']);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }
    public function deleteContact()
    {
        $res=$this->lienheService->deleteContact($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }
    
}