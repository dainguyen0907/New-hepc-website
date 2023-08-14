<?php
namespace App\Services;

use App\Models\cmPhongBanModel;

class cmphongbanService extends BaseService
{
    private $cmpbModel;

    public function __construct()
    {
        parent::__construct();
        $this->cmpbModel = new cmPhongBanModel();
    }
//CHức năng: Lấy thông tin chuyên mục bằng id
//Vị trí:Chuyên mục khoa/ phòng
    public function getCatalogueByID($id_cmpb)
    {
        return $this->cmpbModel->where(['id_cmpb' => $id_cmpb, 'status_cmpb!=' => '0'])->first();
    }
    //CHức năng: Lấy tất cả các chuyên mục của phòng ban bằng id_pb
//Vị trí: Chuyên mục khoa/ phòng
    public function getCatalogues($id_pb)
    {
        return $this->cmpbModel->where(['id_pb' => $id_pb, 'status_cmpb!=' => '0'])->findAll();
    }
//CHức năng: Lấy thông tin phòng ban bằng đường link
//Vị trí: Chuyên mục khoa/phòng
    public function getCatalogueByLink($id_pb, $link)
    {
        return $this->cmpbModel->where(['id_pb' => $id_pb, 'link' => $link, 'status_cmpb!=' => '0'])->first();
    }
}