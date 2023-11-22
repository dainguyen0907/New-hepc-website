<?php

namespace App\Controllers;

use App\Common\encryptLibary;
use App\Common\libary;
use App\Common\ResultUtils;
use App\Services\admin_baivietService;
use App\Services\admin_cmphongbanService;
use App\Services\admin_phongbanService;


class Admin_NewController extends BaseController
{
    private $baivietService;
    private $phongbanService;
    private $cmphongbanService;
    private $encrypt;
    public function __construct()
    {
        $this->baivietService = new admin_baivietService();
        $this->phongbanService = new admin_phongbanService();
        $this->cmphongbanService = new admin_cmphongbanService();
        $this->encrypt=new encryptLibary();
    }
    public function index()
    {
        $masterPage = [];
        $title = "Trang chủ";
        $page = 'adminPage/Pages/newpaperPage';
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables, 'assets/js/ajax.js','assets/js/modal.js'];
        $dataLayout['news'] = $this->baivietService->getAllNews();
        $dataLayout['groups'] = $this->phongbanService->getAllPhongBan();
        $dataLayout['role'] = "admin";
        $dataLayout['encrypt']=$this->encrypt->getEncryptLibary();
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }
    // Ajax controller
    public function loadDataTableById_pb()
    {
        return $this->baivietService->loadHTMLTableById_pb($this->request->getPost()['id_pb']);
    }

    public function loadCensorDataTableById_pb()
    {
        return $this->baivietService->loadHTMLCensorTableById_pb($this->request->getPost()['id_pb']);
    }

    public function loadCatalogueById_pb()
    {
        return $this->cmphongbanService->loadAjaxForSelectorCatalogueById_pb($this->request->getPost()['id_pb']);
    }
    // load Page
    public function loadMyPostPage()
    {
        $masterPage = [];
        $title = "Bài viết cá nhân";
        $page = 'adminPage/Pages/newpaperPage';
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables, 'assets/js/ajax.js'];
        $dataLayout['news'] = $this->baivietService->getNewsById_user(session('userLogin')['id_user']);
        $dataLayout['role'] = "user";
        $dataLayout['encrypt']=$this->encrypt->getEncryptLibary();
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }

    public function loadMyGroupPostPage()
    {
        $masterPage = [];
        $title = "Bài viết phòng ban";
        $page = 'adminPage/Pages/newpaperPage';
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables, 'assets/js/ajax.js'];
        $dataLayout['news'] = $this->baivietService->getNewsById_pb(session('userLogin')['id_pb']);
        $dataLayout['role'] = "user";
        $dataLayout['encrypt']=$this->encrypt->getEncryptLibary();
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }

    public function loadCensorPostPage()
    {
        $masterPage = [];
        $title = "Bài viết mới";
        $page = 'adminPage/Pages/newpaperPage';
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables, 'assets/js/censorPostAjax.js'];
        $dataLayout['news'] = $this->baivietService->getCensorPostById_pb(session('userLogin')['id_pb']);
        $dataLayout['groups'] = $this->phongbanService->getMyGroupForCensorPost(session('userLogin')['id_pb']);
        $dataLayout['role'] = "leader";
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }

    public function loadCreatePostPage()
    {
        $masterPage = [];
        $title = "Trang chủ";
        $page = 'adminPage/Pages/postPage-add';
        $cssLib = [libary::cssDatatables];
        // $jsLib = [
        //     libary::jsDataTables,
        //     'assets/js/ckeditor.js',
        //     'assets/js/loadckeditor.js',
        //     'assets/js/createPostAjax.js'
        // ];
        $jsLib = ['assets/js/createPostAjax.js',"assets/tinymce/tinymce.min.js", "assets/js/loadtinymce.js"];
        $dataLayout['mode'] = 'add';
        $dataLayout['catalogue'] = $this->cmphongbanService->getCatalogueById_pb(session('userLogin')['id_pb']);
        $dataLayout['groups'] = $this->phongbanService->getMyGroupForCensorPost(session('userLogin')['id_pb']);
        $dataLayout['title'] = "Tạo bài viết mới";
        $dataLayout['action'] = "admin/post/add";
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }

    public function loadUpdatePostPage($id_bv)
    {
        $post = $this->baivietService->getPostDetail($id_bv, session('userLogin')['id_q']);
        if (isset($post)) {
            $masterPage = [];
            $title = "Trang chủ";
            $page = 'adminPage/Pages/postPage-add';
            $cssLib = [libary::cssDatatables];
            // $jsLib = [
            //     libary::jsDataTables,
            //     'assets/js/ckeditor.js',
            //     'assets/js/loadckeditor.js',
            //     'assets/js/createPostAjax.js'
            // ];
            $jsLib = ['assets/js/createPostAjax.js',"assets/tinymce/tinymce.min.js", "assets/js/loadtinymce.js"];
            $dataLayout['mode'] = 'change';
            $dataLayout['new'] = $post;
            $dataLayout['encrypt']=$this->encrypt->getEncryptLibary();
            $dataLayout['title'] = "Cập nhật bài viết";
            $dataLayout['action'] = "admin/post/update";
            $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
            return view('adminPage/masterPage', $AdmissionPage);
        } else
            return $this->load404page();

    }

    public function change_post()
    {
        $res=$this->baivietService->updatePost($this->request);
        if($res['status']===ResultUtils::STATUS_CODE_OK)
        {
            return redirect()->to('./admin/mypost')->withInput()->with($res['messageCode'],$res['message']);
        }
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }

    public function add_post()
    {
        $res=$this->baivietService->addPost($this->request);
        if($res['status']===ResultUtils::STATUS_CODE_OK)
        {
            return redirect()->to('./admin/mypost')->withInput()->with($res['messageCode'],$res['message']);
        }
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }

    public function delete_post()
    {
        $res=$this->baivietService->deletePost($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }
    public function pass_censor($id_bv)
    {
        $res=$this->baivietService->censor_post($id_bv,'pass');
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }
    public function failed_censor($id_bv)
    {
        $res=$this->baivietService->censor_post($id_bv,'fail');
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }


}