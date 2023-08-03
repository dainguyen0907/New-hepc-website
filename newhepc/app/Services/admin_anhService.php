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
            "picturelink"=>[
                "required"=>"Đường dẫn ảnh không được để trống",
            ]
        ];
        $this->validation->setRules($rules,$message);
        $this->validation->withRequest($req)->run();
        return $this->validation;
    }

    public function addPicture($req)
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
            "id_p"=>session('userLogin')['id_pb'],
            "id_user"=>session('userLogin')['id_user'],
            "status_anh"=>0,
            "censor_anh"=>0
        ];
        $res=$this->anhModel->insert($data);
        if($res)
        {
            $this->writeHistory('add','Ảnh hoạt động',session('userLogin')['id_user'],$res);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success'=>"Thêm ảnh thành công"]
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err'=>"Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau."]
        ];
        
    }

    public function getPictureById_user($id_user)
    {
        return $this->anhModel->join('user','fileanh.id_user=user.id_user','left')->join('phongban','fileanh.id_p=phongban.id_pb')->where('fileanh.id_user',$id_user)->findAll();
    }
    public function getPictureById_pb($id_pb)
    {
        return $this->anhModel->join('user','fileanh.id_user=user.id_user','left')->join('phongban','fileanh.id_p=phongban.id_pb')->where('fileanh.id_p',$id_pb)->findAll();
    }

    public function getCountCensorPicture($id_pb)
    {
        return $this->anhModel->join('user','fileanh.id_user=user.id_user','left')->join('phongban','fileanh.id_p=phongban.id_pb')->where(["id_p"=>$id_pb,"censor_anh"=>0])->findAll();
    }
}