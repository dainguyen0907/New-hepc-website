<?php

namespace App\Controllers;


class Admin_HomeController extends BaseController
{
    public function __construct()
    {
    }
    public function index()
    {
        $masterPage = [];
        $title = "Trang chủ";
        $page = 'adminPage/Pages/homePage';
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, [], [], []);
        return view('adminPage/masterPage', $AdmissionPage);
    }

}