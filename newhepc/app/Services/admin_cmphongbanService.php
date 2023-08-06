<?php
namespace App\Services;

use App\Common\ResultUtils;
use App\Models\baivietModel;
use App\Models\cmPhongBanModel;


class admin_cmphongbanService extends BaseService
{
    private $cmphongbanModel;
    private $baivietModel;
    public function __construct()
    {
        parent::__construct();
        $this->cmphongbanModel = new cmPhongBanModel();
        $this->baivietModel=new baivietModel();
        $this->cmphongbanModel->protect(false);
        $this->baivietModel->protect(false);
    }

    public function getAllCatalogue()
    {
        return $this->cmphongbanModel->join('phongban', 'cmphongban.id_pb=phongban.id_pb')->findAll();
    }

    public function getCatalogueById_pb($id_pb)
    {
        return $this->cmphongbanModel->where('id_pb',$id_pb)->findAll();
    }

    public function checkCatalogueLink($id,$name)
    {
        if($id!=null)
        {
            $data=$this->cmphongbanModel->where(['link'=>$this->convert_name(trim($name)),'id_cmpb!='=>$id])->first();
        }
        else{
            $data=$this->cmphongbanModel->where('link',$this->convert_name(trim($name)))->first();
        }
        if($data!=null)
        {
            return true;
        }
        return false;
    }
    public function addCatalogue($req)
    {
        $validationRes=$this->validateCatalogue('add',$req);
        if($validationRes->getErrors())
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validationRes->getErrors()
            ];
        }
        $param=$req->getPost();
        if($this->checkCatalogueLink(null,$param['cataloguename']))
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['err'=>'Tên chuyên mục không được giống nhau']
            ];
        }
        $data=[
            "cmphongban"=>trim($param['cataloguename']),
            "link"=>$this->convert_name(trim($param['cataloguename'])),
            "id_pb"=>$param['cataloguegroup'],
            "status_cmpb"=>'1'
        ];
        $res=$this->cmphongbanModel->insert($data);
        if($res)
        {
            $this->writeHistory('add','Chuyên mục',session('userLogin')['id_user'],$res);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success'=>'Thêm chuyên mục mới thành công.']
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err'=>'Xảy ra lỗi hệ thống! Vui lòng thử lại sau.']
        ];
        
    }

    private function validateCatalogue($method,$req)
    {
        $rules = ['cataloguename' => 'required|max_length[50]'];
        $message = [
            "cataloguename" => [
                "required" => "Tên chuyên mục không được để trống.",
                "max_length" => "Tên chuyên mục tối đa 50 ký tự"
            ]
        ];
        if($method=="add")
        {
            $rules = ['cataloguename' => 'required|max_length[50]|is_unique[cmphongban.cmphongban]'];
            $message = [
                "cataloguename" => [
                    "required" => "Tên chuyên mục không được để trống.",
                    "max_length" => "Tên chuyên mục tối đa 50 ký tự",
                    "is_unique"=> "Tên chuyên mục đã tồn tại"
                ]
            ];
        }
        $this->validation->setRules($rules,$message);
        $this->validation->withRequest($req)->run();

        return $this->validation;
    }

    public function deleteCatalogue($req)
    {
        $param = $req->getPost();
        $res=$this->cmphongbanModel->delete($param['id']);
        if ($res) {
            $this->writeHistory('delete','Chuyên mục',session('userLogin')['id_user'],$param['id']);
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

    public function updateCatalogue($req){
        $validationRes=$this->validateCatalogue('update',$req);
        if($validationRes->getErrors()){
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validationRes->getErrors()
            ];
        }
        $param=$req->getPost();
        if($this->checkCatalogueLink($param['catalogueid'],$param['cataloguename']))
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['err'=>'Tên chuyên mục không được giống nhau']
            ];
        }
        $data=[
            "cmphongban"=>trim($param['cataloguename']),
            "link"=>$this->convert_name(trim($param['cataloguename'])),
            "id_pb"=>$param['cataloguegroup'],
            "status_cmpb"=>$param['status_catalogue']
        ];
        if($this->cmphongbanModel->update($param['catalogueid'],$data))
        {
            $this->baivietModel->whereIn('id_cmpb',[$param['catalogueid']])->set('status_bv',$data['status_cmpb'])->update();
            $this->writeHistory('update','Chuyên mục',session('userLogin')['id_user'],$param['catalogueid']);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success'=>'Cập nhật chuyên mục thành công']
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err'=>'Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau.']
        ];
    }

    public function loadAjaxForSelectorCatalogueById_pb($id_pb)
    {
        $string="";
        $datares=$this->getCatalogueById_pb($id_pb);
        foreach($datares as $n)
        {
            $string.='<option value="'.$n['id_cmpb'].'">'.$n['cmphongban'].'</option>';
        }
        return $string;
    }


}