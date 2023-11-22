<?php
namespace App\Services;

use App\Common\ResultUtils;
use App\Models\bannerModel;


class admin_bannerService extends BaseService
{
    private $bannerModel;
    public function __construct()
    {
        parent::__construct();
        $this->bannerModel = new bannerModel();
        $this->bannerModel->protect(false);
    }
//CHức năng: Lấy tất cả banner quảng cáo
//Vị trí: Trang Admin->quản trị->banner quảng cáo
    public function getAllBanner()
    {
        return $this->bannerModel->join('user','banner.id_user=user.id_user')->findAll();
    }
    //CHức năng: Thêm banner quảng cáo mới
//Vị trí: Trang Admin->quản trị->banner quảng cáo
    public function addBanner($req)
    {
        $validateRes=$this->validateAddBanner($req);
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
            "file"=>$param['bannerlink'],
            "banner_link"=>$param['postlink'],
            "id_user"=>session('userLogin')['id_user'],
            "status_banner"=>'0'
        ];
        $res=$this->bannerModel->insert($data);
        if($res)
        {
            $this->writeHistory('add','Banner',session('userLogin')['id_user'],$res);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success'=>"Thêm banner thành công"]
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err'=>"Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau."]
        ];
        
    }
//CHức năng: Kiểm tra thông tin nhập của banner quảng cáo
//Vị trí: Trang Admin->quản trị->banner quảng cáo
    private function validateAddBanner($req)
    {
        $rules=["bannerlink"=>"required"];
        $message=[
            "bannerlink"=>[
                "required"=>"Đường dẫn không được để trống",
            ]
        ];
        $this->validation->setRules($rules,$message);
        $this->validation->withRequest($req)->run();
        return $this->validation;
    }
//CHức năng: Cập nhật banner quảng cáo
//Vị trí: Trang Admin->quản trị->banner quảng cáo
    public function updateBanner($req)
    {
        $validateRes=$this->validateAddBanner($req);
        if($validateRes->getErrors())
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validateRes->getErrors()
            ];
        }
        $param=$req->getPost();
        $decryptid=$this->decryptString($param['bannerid']);
        $data=[
            "file"=>$param['bannerlink'],
            "banner_link"=>$param['postlink'],
            "status_banner"=>$param['status_banner']
        ];
        $res=$this->bannerModel->update($decryptid,$data);
        if($res)
        {
            $this->writeHistory('update','Banner',session('userLogin')['id_user'],$decryptid);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success'=>"Cập nhật banner thành công"]
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err'=>"Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau."]
        ];
        
    }
    //CHức năng: Xóa banner quảng cáo
//Vị trí: Trang Admin->quản trị->banner quảng cáo
    public function deleteBanner($req)
    {
        $param=$req->getPost();
        $decryptid=$this->decryptString($param['id']);
        if($this->bannerModel->delete($decryptid))
        {
            $this->writeHistory('update','Banner',session('userLogin')['id_user'],$decryptid);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success'=>"Xóa banner thành công"]
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err'=>"Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau."]
        ];
        
    }
}