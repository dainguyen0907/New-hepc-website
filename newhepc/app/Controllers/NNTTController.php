<?php

namespace App\Controllers;

class NNTTController extends BaseController
{
    public function index()
    {
        return $this->loadDepartmentPage(14,90,87,"Trung tâm Ngoại ngữ - Tin học",'phong-nn-tt/');
    }

    public function getNewsOfCatalogueNNTT($link)
    {
        return $this->loadNewDetailPage($link,14,"Trung tâm Ngoại ngữ - Tin học",'phong-nn-tt');
    }
}