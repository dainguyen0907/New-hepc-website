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

    public function getCatalogueByID($id_cmpb)
    {
        return $this->cmpbModel->where(['id_cmpb' => $id_cmpb, 'status!=' => '0'])->first();
    }
    public function getCatalogues($id_pb)
    {
        return $this->cmpbModel->where(['id_pb' => $id_pb, 'status!=' => '0'])->findAll();
    }

    public function getCatalogueByLink($id_pb, $link)
    {
        return $this->cmpbModel->where(['id_pb' => $id_pb, 'link' => $link, 'status!=' => '0'])->first();
    }
}