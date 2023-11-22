<?php

namespace App\Controllers;

class TCHCController extends BaseController
{

    public function index()
    {
        return $this->loadDepartmentPage(8,54,51,"Phòng Tổ chức Hành chính",'phong-to-chuc/');
    }

    public function getNewsOfCatalogueTCHC($link)
    {
       return $this->loadNewDetailPage($link,8,"Phòng Tổ chức Hành chính","phong-to-chuc");
    }
}
