<?php
namespace App\Services;

use App\Models\nhatkyModel;


class admin_nhatkyService extends BaseService
{
    private $nhakyModel;
    public function __construct()
    {
        parent::__construct();
        $this->nhatkyModel = new nhatkyModel();
    }
//CHức năng: Lấy tất cả nhật ký
//Vị trí: Trang Admin->quản trị->Nhật ký
    public function getAllHistory()
    {
        return $this->nhatkyModel->orderBy('id_nk','desc')->findAll();
    }
    

}
