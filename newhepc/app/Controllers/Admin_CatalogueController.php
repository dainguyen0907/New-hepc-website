<?php

namespace App\Controllers;
use App\Common\encryptLibary;
use App\Common\libary;
use App\Services\admin_cmphongbanService;
use App\Services\admin_phongbanService;



class Admin_CatalogueController extends BaseController
{
    private $cmphongbanService;
    private $phongbanService;
    private $encrypt;
    public function __construct()
    {
        $this->cmphongbanService= new admin_cmphongbanService();
        $this->phongbanService=new admin_phongbanService();
        $this->encrypt=new encryptLibary();
    }
    public function index()
    {
        $masterPage = [];
        $title = "Chuyên mục";
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables,"assets/js/modal.js"];
        $page = 'adminPage/pages/cataloguePage';
        $dataLayout['Catalogues']=$this->cmphongbanService->getAllCatalogue();
        $dataLayout['Groups']=$this->phongbanService->getAllPhongBan();
        $dataLayout['encrypt']=$this->encrypt->getEncryptLibary();
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }
    public function addCatalogue()
    {
        $res=$this->cmphongbanService->addCatalogue($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }
    public function deleteCatalogue()
    {
        $res=$this->cmphongbanService->deleteCatalogue($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }

    public function updateCatalogue()
    {
        $res=$this->cmphongbanService->updateCatalogue($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }
}