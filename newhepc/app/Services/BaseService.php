<?php
namespace App\Services;
use App\Common\encryptLibary;
use App\Models\nhatkyModel;
use App\Models\userModel;

class BaseService{

    public $validation;
    private $nhatkyModel;
    private $encrypt;
    private $userModel;
    private $encryptLib;

    function __construct()
    {
        $this->validation=\config\Services::validation();
        $this->nhatkyModel=new nhatkyModel();
        $this->userModel=new userModel();
        $this->nhatkyModel->protect(false);
        $this->encrypt=new encryptLibary();
        $this->encryptLib=$this->encrypt->getEncryptLibary();
    }
//CHức năng: Cập nhật lịch sử chỉnh sửa các bảng trong database
//Vị trí: Trang Admin
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
//CHức năng: Chuyển đổi chữ và ký tự đặc biệt thành mẫu chuẩn
//Vị trí: Trang Admin- thêm/cập nhật chuyên mục, bài viết,....
    public function convert_name($str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		$str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
		$str = preg_replace("/( )/", '-', $str);
        $str = preg_replace("/(\/)/", '-', $str);
		return $str;
	}

    public function decryptString($string_encrypt)
    {
        return openssl_decrypt($string_encrypt,$this->encryptLib['cipher_algo'],$this->encryptLib["passphrase"],$this->encryptLib['options'],$this->encryptLib['iv']);
    }

    public function encryptString($string_encrypt)
    {
        return  openssl_encrypt($string_encrypt,$this->encryptLib['cipher_algo'],$this->encryptLib["passphrase"],$this->encryptLib['options'],$this->encryptLib['iv']);
    }

    
}