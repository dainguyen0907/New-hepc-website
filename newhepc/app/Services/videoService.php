<?php 
namespace App\Services;
use App\Models\videoModel;

class videoService extends BaseService{

    private $videoModel;
    public function __construct() {
        parent::__construct();
        $this->videoModel= new videoModel();
    }
    //CHức năng: Lấy 6 video mới nhất cho trang chủ
//Vị trí: Trang chủ
    public function getVideosForHomePage()
    {
        return $this->videoModel->where(['Status_vd!='=>'0'])->findAll(6,0);
    }
}