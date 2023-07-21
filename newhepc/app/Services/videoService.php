<?php 
namespace App\Services;
use App\Models\videoModel;

class videoService extends BaseService{

    private $videoModel;
    public function __construct() {
        parent::__construct();
        $this->videoModel= new videoModel();
    }

    public function getVideosForHomePage()
    {
        return $this->videoModel->where(['Status!='=>'0', 'censor'=>'0'])->findAll(6,0);
    }
}