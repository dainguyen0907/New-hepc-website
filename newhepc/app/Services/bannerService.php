<?php 
namespace App\Services;
 
use App\Models\bannerModel;

class bannerService extends BaseService{

    private $bannerModel;
    public function __construct() {
        parent::__construct();
        $this->bannerModel=new bannerModel();
    }
    //CHức năng: Lấy tất cả banner cho trang chủ
//Vị trí: Trang chủ
    public function getBannersForHomePage()
    {
        return $this->bannerModel->where(['Status_banner!='=>'0'])->findAll();
    }
}