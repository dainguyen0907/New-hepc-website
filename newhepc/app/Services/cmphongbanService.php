<?php 
namespace App\Services;
use App\Models\cmPhongBanModel;

class cmphongbanService extends BaseService{
    private $cmpbModel;

    public function __construct() {
        parent::__construct();
        $this->cmpbModel=new cmPhongBanModel();
    }

    public function getCatalogues($id_pb)
    {
        return $this->cmpbModel->where(['id_pb'=>$id_pb,'status!='=>'0'])->findAll();
    }
}