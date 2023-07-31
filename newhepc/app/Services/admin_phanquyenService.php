<?php
namespace App\Services;

use App\Common\ResultUtils;
use App\Models\phanquyenModel;


class admin_phanquyenService extends BaseService
{
    private $phanquyenModel;
    public function __construct()
    {
        parent::__construct();
        $this->phanquyenModel = new phanquyenModel();
        $this->phanquyenModel->protect(false);
    }

    public function getAllphanquyen()
    {
        return $this->phanquyenModel->findAll();
    }
    

}
