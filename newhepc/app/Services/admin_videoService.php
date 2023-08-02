<?php
namespace App\Services;

use App\Common\ResultUtils;
use App\Models\videoModel;


class admin_videoService extends BaseService
{
    private $videoModel;
    public function __construct()
    {
        parent::__construct();
        $this->videoModel = new videoModel();
        $this->videoModel->protect(false);
    }

    public function getAllvideo()
    {
        return $this->videoModel->join('user','video.id_user=user.id_user')->findAll();
    }
}