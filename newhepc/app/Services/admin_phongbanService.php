<?php
namespace App\Services;

use App\Common\ResultUtils;
use App\Models\phongbanModel;


class admin_phongbanService extends BaseService
{
    private $phongbanModel;
    public function __construct()
    {
        parent::__construct();
        $this->phongbanModel = new phongbanModel();
        $this->phongbanModel->protect(false);
    }

    public function getAllPhongBan()
    {
        return $this->phongbanModel->findAll();
    }
    

}
