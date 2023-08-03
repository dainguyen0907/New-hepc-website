<?php
namespace App\Services;

use App\Common\ResultUtils;
use App\Models\fileAnhModel;


class admin_anhService extends BaseService
{
    private $anhModel;
    public function __construct()
    {
        parent::__construct();
        $this->anhModel = new fileAnhModel();
        $this->anhModel->protect(false);
    }

    public function getAllPicture()
    {
        return $this->anhModel->join('user','fileanh.id_user=user.id_user')->join('phongban','fileanh.id_p=phongban.id_pb')->findAll();
    }
    public function deletePicture($req)
    {
        $param=$req->getPost();
        if($this->anhModel->delete($param['id']))
        {
            $this->writeHistory('delete','Ảnh hoạt động',session('userLogin')['id_user'],$param['id']);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success'=>"Xóa ảnh thành công"]
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err'=>"Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau."]
        ];
        
    }

    public function updatePicture($req)
    {
        $validateRes=$this->validatePicture($req);
        if($validateRes->getErrors())
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validateRes->getErrors()
            ];
        }
        $param=$req->getPost();
        $data=[
            "anh"=>$param['picturelink'],
            "id_p"=>$param['picturegroup'],
            "status_anh"=>$param['status_picture'],
            "censor_anh"=>$param['censor_picture']
        ];
        if($this->anhModel->update($param['pictureid'],$data))
        {
            $this->writeHistory('update','Ảnh hoạt động',session('userLogin')['id_user'],$param['pictureid']);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success'=>"Cập nhật ảnh thành công"]
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err'=>"Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau."]
        ];
        
    }

    public function validatePicture($req)
    {
        $rules=[
            "picturelink"=>"required"
        ];
        $message=[
            "videoname"=>[
                "required"=>"Đường dẫn ảnh không được để trống",
            ]
        ];
        $this->validation->setRules($rules,$message);
        $this->validation->withRequest($req)->run();
        return $this->validation;
    }
}