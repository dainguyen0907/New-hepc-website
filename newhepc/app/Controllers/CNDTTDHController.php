<?php

namespace App\Controllers;
class CNDTTDHController extends BaseController
{
    public function index()
    {
        return $this->loadDepartmentPage(5,31,34,"Khoa Công nghệ điện tử - tự động hoá",'khoa-cndt-tdh/');
    }

    public function getNewsOfCatalogueCNDTTDH($link)
    {
        return $this->loadNewDetailPage($link,5,"Khoa Công nghệ điện tử - tự động hoá",'khoa-cndt-tdh');
    }
}