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
//CHức năng: Dếm số lượng liên hệ chưa xử lý
//Vị trí: Trang Admin->quản trị->leftmenu
    public function getCountContactUnseen($id_p)
    {
        return count($this->lienheModel->where(['id_p'=>$id_p,'trangthai'=>'0'])->findAll());
    }
//CHức năng: lấy tất cả liên hệ
//Vị trí: Trang Admin->Hộp thư
    public function getAllContactById_pb($id_p)
    {
        return $this->lienheModel->where(['id_p'=>$id_p])->findAll();
    }
//CHức năng:Lấy thông tin liên hệ bằng id_lh
//Vị trí: Trang Admin->Hộp thư
    public function getContactDetailById_lh($id_lh)
    {
        return $this->lienheModel->where(['id_lh'=>$id_lh])->first();
    }
//CHức năng: Chyển trạng thái đã xử lý cho liên hệ
//Vị trí: Trang Admin->Hộp thư
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
    //CHức năng: Xóa liên hệ
//Vị trí: Trang Admin->Hộp thư
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