<?php 
namespace App\Services;
 
use App\Models\bannerModel;

class bannerService extends BaseService{

    private $bannerModel;
    public function __construct() {
        parent::__construct();
        $this->bannerModel=new bannerModel();
    }

    public function getBannersForHomePage()
    {
        return $this->bannerModel->where(['Status!='=>'0','censor!='=>'0'])->findAll();
    }
}