<?php
namespace App\Services;

use App\Common\ResultUtils;
use App\Models\lienheModel;


class admin_lienheService extends BaseService
{
    private $lienheModel;

    public function __construct()
    {
        parent::__construct();
        $this->lienheModel=new lienheModel();
        $this->lienheModel->protect(false);
    }


    public function getCountContactUnseen($id_p)
    {
        return count($this->lienheModel->where(['id_p'=>$id_p,'trangthai'=>'0'])->findAll());
    }

    public function getAllContactById_pb($id_p)
    {
        return $this->lienheModel->where(['id_p'=>$id_p])->findAll();
    }

    public function getContactDetailById_lh($id_lh)
    {
        return $this->lienheModel->where(['id_lh'=>$id_lh])->first();
    }

    public function changeToTrueStatusContact($id_lh,$id_pb)
    {
        $data=$this->lienheModel->where(['id_lh'=>$id_lh,'id_p'=>$id_pb])->first();
        if($data==null)
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['err'=>'Tài khoản này không có quyền thay đổi trạng thái liên hệ này']
            ];
        }
        if($this->lienheModel->update($id_lh,['trangthai'=>1]))
        {
            $this->writeHistory('update','Liên hệ',session('userLogin')['id_user'],$id_lh);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['err'=>'Cập nhật thành công']
            ];
        }else{
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['err'=>'Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau.']
            ];
        }
    }
    public function deleteContact($req)
    {
        $param=$req->getPost();
        if($this->lienheModel->delete($param['id']))
        {
            $this->writeHistory('delete','Liên hệ',session('userLogin')['id_user'],$param['id']);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['err'=>'Xóa thành công']
            ];
        }else{
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['err'=>'Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau.']
            ];
        }
    }

}