<?php
namespace App\Services;

use App\Common\encryptLibary;
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
//CHức năng: Lấy tất cả video clip
//Vị trí: Trang Admin->quản trị->video clip
    public function getAllvideo()
    {
        return $this->videoModel->join('user','video.id_user=user.id_user')->findAll();
    }

    //CHức năng: Lấy thông tin video bằng id_video
//Vị trí: Trang Admin->quản trị->video clip
    public function getVideoById($id)
    {
        return $this->videoModel->where('id_vd',$id)->first();
    }
    //CHức năng: Thêm video mới
//Vị trí: Trang Admin->quản trị->video clip
    public function addVideo($req){
        $validateRes=$this->validateVideo('add',$req);
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
            "video"=>$param['videoname'],
            "file_vd"=>$param['videolink'],
            "id_user"=>session('userLogin')['id_user'],
            "status_vd"=>'0'
        ];
        $res=$this->videoModel->insert($data);
        if($res)
        {
            $this->writeHistory('add','Video',session('userLogin')['id_user'],$res);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success'=>"Thêm video thành công"]
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err'=>"Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau."]
        ];
    }
    //CHức năng: Kiểm tra thông tin nhập liệu video, dùng cho thêm/sửa video
//Vị trí: 
    private function validateVideo($method,$req){
        if($method=="add")
        {
            $rules=[
                "videoname"=>"required|max_length[100]|is_unique[video.video]",
                "videolink"=>"required"
            ];
            $message=[
                "videoname"=>[
                    "required"=>"Tên video không được để trống",
                    "max_length"=>"Tên video tối đa 100 ký tự",
                    "is_unique"=>"Tên video đã tồn tại"
                ],
                "videolink"=>[
                    "required"=>"Đường dẫn video không được để trống"
                ]
            ];
        }
        else{
            $rules=[
                "videoname"=>"required|max_length[100]",
                "videolink"=>"required"
            ];
            $message=[
                "videoname"=>[
                    "required"=>"Tên video không được để trống",
                    "max_length"=>"Tên video tối đa 100 ký tự"
                ],
                "videolink"=>[
                    "required"=>"Đường dẫn video không được để trống"
                ]
            ];
        }
        $this->validation->setRules($rules,$message);
        $this->validation->withRequest($req)->run();
        return $this->validation;
    }
//CHức năng: Xóa video
//Vị trí: Trang Admin->quản trị->video clip
    public function deleteVideo($req){
        $param=$req->getPost();
        $decryptid=$this->decryptString($param['id']);
        if($this->videoModel->delete($decryptid))
        {
            $this->writeHistory('delete','Video',session('userLogin')['id_user'],$decryptid);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success'=>"Xóa video thành công"]
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err'=>"Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau."]
        ];
    }
//CHức năng: Kiểm tra tên video đã tồn tại không ?
//Vị trí:
    public function checkVideoName($id,$name)
    {
        $data=$this->videoModel->where(["video"=>$name,"id_vd!="=>$id])->first();
        if($data!=null)
        {
            return true;
        }
        return false;
    }
    //CHức năng: Cập nhật thông tin video clip
//Vị trí: Trang Admin->quản trị->video clip
    public function updateVideo($req){
        $validateRes=$this->validateVideo('update',$req);
        if($validateRes->getErrors())
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validateRes->getErrors()
            ];
        }
        $param=$req->getPost();
        $decryptid=$this->decryptString($param['videoid']);
        $data=[
            "video"=>$param['videoname'],
            "file_vd"=>$param['videolink'],
            "status_vd"=>$param['videostatus']
        ];
        if($this->checkVideoName($decryptid,$data['video']))
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['err'=>"Tên video đã có"]
            ];
        }
        if($this->videoModel->update($decryptid,$data))
        {
            $this->writeHistory('update','Video',session('userLogin')['id_user'],$decryptid);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success'=>"Cập nhật video thành công"]
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err'=>"Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau."]
        ];
    }
}