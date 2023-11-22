<?php

namespace App\Controllers;

class TTCNNLController extends BaseController
{
    public function index(){
        return $this->loadDepartmentPage(13,80,84,"Trung tâm Công nghệ Năng lượng",'phong-tt-nangluong/');
    }

    public function getNewsOfCatalogueTTCNNL($link)
    {
        return $this->loadNewDetailPage($link,13,"Trung tâm Công nghệ Năng lượng",'phong-tt-nangluong');
    }
}