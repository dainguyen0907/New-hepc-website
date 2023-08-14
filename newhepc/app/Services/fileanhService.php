<?php 
namespace App\Services;
use App\Models\fileAnhModel;

class fileAnhService extends BaseService{

    private $fileAnhModel;
    public function __construct() {
        parent::__construct();
        $this->fileAnhModel= new fileAnhModel;
    }
//CHức năng: Lấy tất cả các ảnh của phòng ban
//Vị trí: Chuyên mục khoa/ phòng ban
    public function getPicturesById_PB($id_pb)
    {
        return $this->fileAnhModel->where(['id_p'=>$id_pb,'status_anh'=>'1','censor_anh'=>'1'])->findAll();
    }
}