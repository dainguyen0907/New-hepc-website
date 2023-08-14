<?php
namespace App\Services;

use App\Common\ResultUtils;
use App\Models\baivietModel;
use App\Models\cmPhongBanModel;
use App\Models\phongbanModel;


class admin_phongbanService extends BaseService
{
    private $phongbanModel;
    private $cmpbModel;
    private $baivietModel;
    public function __construct()
    {
        parent::__construct();
        $this->phongbanModel = new phongbanModel();
        $this->cmpbModel=new cmPhongBanModel();
        $this->baivietModel=new baivietModel();
        $this->phongbanModel->protect(false);
        $this->cmpbModel->protect(false);
        $this->baivietModel->protect(false);
    }
//CHức năng: Lấy tất cả phòng ban
//Vị trí: Trang Admin->quản trị->phòng ban
    public function getAllPhongBan()
    {
        return $this->phongbanModel->findAll();
    }
//CHức năng: Cập nhật trạng thái phòng ban
//Vị trí: Trang Admin->quản trị->phòng ban
    public function updateStatusByID($id){
        $data=$this->phongbanModel->where('id_pb',$id)->first();
        if($data==null)
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['error'=>'Không tìm thấy phòng ban']
            ];
        }
        if($data['status_pb']!=1)
        {
            $this->phongbanModel->update($id,['status_pb'=>'1']);
            $this->cmpbModel->whereIn('id_pb',[$id])->set(['status_cmpb'=>'1'])->update();
            foreach($this->cmpbModel->where('id_pb',$id)->findAll() as $n){
                $this->baivietModel->whereIn('id_cmpb',[$n['id_cmpb']])->set('status_bv','1')->update();
            }
        }else
        {
            $this->phongbanModel->update($id,['status_pb'=>'0']);
            $this->cmpbModel->whereIn('id_pb',[$id])->set(['status_cmpb'=>'0'])->update();
            foreach($this->cmpbModel->where('id_pb',$id)->findAll() as $n){
                $this->baivietModel->whereIn('id_cmpb',[$n['id_cmpb']])->set('status_bv','0')->update();
            }
        }
        $this->writeHistory('update','Phòng ban',session('userLogin')['id_user'],$id);
        return [
            'status' => ResultUtils::STATUS_CODE_OK,
            'messageCode' => ResultUtils::MESSAGE_CODE_OK,
            'message' => ['success'=>'Cập nhật trạng thái thành công']
        ];
        
    }
//CHức năng: Xóa phòng ban
//Vị trí: Trang Admin->quản trị->phòng ban
    public function deletePhongBan($req)
    {
        $param = $req->getPost();
        if($param['id']<17)
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['error' => 'Không thể xóa phòng ban này.']
            ];
        }
        $res=$this->phongbanModel->delete($param['id']);
        if ($res) {
            $this->writeHistory('delete','Phòng ban',session('userLogin')['id_user'],$param['id']);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success' => 'Xóa phòng ban thành công']
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err' => 'Xảy ra lỗi hệ thống. Vui lòng thử lại sau']
        ];
    }
    //CHức năng: Thêm Phòng ban mới
//Vị trí: Trang Admin->quản trị->phòng ban
    public function addGroup($req)
    {
        $validateRes=$this->validateAddGroup($req);
        if($validateRes->getErrors())
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validateRes->getErrors()
            ];
        }
        $data=['phongban'=>$req->getPost()['groupname'],
                'status_pb'=>'1'];
        $res=$this->phongbanModel->insert($data);
        if($res)
        {
            $this->writeHistory('add','Phòng ban',session('userLogin')['id_user'],$res);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success'=>'Đã thêm phòng ban']
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err' => 'Xảy ra lỗi hệ thống. Vui lòng thử lại sau']
        ];

    }
//CHức năng: Kiểm tra thông tin phòng ban, dùng cho thêm phòng ban
//Vị trí: Trang Admin->quản trị->phòng ban
    public function validateAddGroup($req)
    {
        $rules=["groupname"=>"required|max_length[50]|is_unique[phongban.phongban]"];
        $message=[
            "groupname"=>[
                "required"=>"Tên phòng ban không được để trống",
                "max_length"=>"Tên phòng ban tối đa 50 ký tự",
                "is_unique"=>"Tên phòng ban đã tồn tại"
            ]
        ];
        $this->validation->setRules($rules,$message);
        $this->validation->withRequest($req)->run();
        return $this->validation;
    }
//CHức năng: Lấy thông tin phòng ban cho select box
//Vị trí: Trang Admin->quản trị->phòng ban
    public function getMyGroupForCensorPost($id_pb)
    {
        if($id_pb==8){
            return $this->phongbanModel->whereIn('id_pb',[8,15,16,17])->findAll();
        }
        return $this->phongbanModel->where('id_pb',$id_pb)->findAll();
    }
    

}
