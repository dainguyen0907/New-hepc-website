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

    public function getVideoById($id)
    {
        return $this->videoModel->where('id_vd',$id)->first();
    }
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

    private function validateVideo($method,$req){
        if($method=="add")
        {
            $rules=[
                "videoname"=>"required|max_length[50]|is_unique[video.video]",
                "videolink"=>"required"
            ];
            $message=[
                "videoname"=>[
                    "required"=>"Tên video không được để trống",
                    "max_length"=>"Tên video tối đa 50 ký tự",
                    "is_unique"=>"Tên video đã tồn tại"
                ],
                "videolink"=>[
                    "required"=>"Đường dẫn video không được để trống"
                ]
            ];
        }
        else{
            $rules=[
                "videoname"=>"required|max_length[50]",
                "videolink"=>"required"
            ];
            $message=[
                "videoname"=>[
                    "required"=>"Tên video không được để trống",
                    "max_length"=>"Tên video tối đa 50 ký tự"
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

    public function deleteVideo($req){
        $param=$req->getPost();
        if($this->videoModel->delete($param['id']))
        {
            $this->writeHistory('delete','Video',session('userLogin')['id_user'],$param['id']);
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


    public function checkVideoName($id,$name)
    {
        $data=$this->videoModel->where(["video"=>$name,"id_vd!="=>$id])->first();
        if($data!=null)
        {
            return true;
        }
        return false;
    }
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
        $data=[
            "video"=>$param['videoname'],
            "file_vd"=>$param['videolink'],
            "status_vd"=>$param['videostatus']
        ];
        if($this->checkVideoName($param['videoid'],$data['video']))
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['err'=>"Tên video đã có"]
            ];
        }
        if($this->videoModel->update($param['videoid'],$data))
        {
            $this->writeHistory('update','Video',session('userLogin')['id_user'],$param['videoid']);
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
}