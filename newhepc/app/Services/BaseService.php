<?php
namespace App\Services;
use App\Models\nhatkyModel;

class BaseService{

    public $validation;
    private $nhatkyModel;

    function __construct()
    {
        $this->validation=\config\Services::validation();
        $this->nhatkyModel=new nhatkyModel();
        $this->nhatkyModel->protect(false);
    }

    public function writeHistory($method,$table,$id_user,$id_row)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $his="Người dùng có id= ".$id_user." đã cập nhật dữ liệu có id="."$id_row"." tại bảng ".$table.".";
        if($method=="add"){
            $his="Người dùng có id= ".$id_user." đã thêm dữ liệu có id="."$id_row"." tại bảng ".$table.".";
        }elseif($method=="delete")
        {
            $his="Người dùng có id= ".$id_user." đã xóa dữ liệu có id="."$id_row"." tại bảng ".$table.".";
        }elseif($method=="reset"){
            $his="Người dùng có id= ".$id_user." đã reset mật khẩu cho tài khoản có id="."$id_row".".";
        }
        $data=[
            "id_user"=>$id_user,
            "d_edit"=>date("d/m/Y H:i:s"),
            'content_edit'=>$his,
        ];
        return $this->nhatkyModel->insert($data,false);
    }

    
}