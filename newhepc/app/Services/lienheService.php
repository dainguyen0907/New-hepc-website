<?php 
namespace App\Services;
use App\Common\ResultUtils;
use App\Models\lienheModel;

class lienheService extends BaseService{

    private $lienheModel;
    public function __construct() {
        parent::__construct();
        $this->lienheModel= new lienheModel;
        $this->lienheModel->protect(false);
    }
//CHức năng: Thêm liên hệ mới
//Vị trí: Trang liên hệ
    public function addContact($req)
    {
        if(session('contactTime'))
        {
            if (session('contactTime') > time() - 900) {
                return [
                    'status' => ResultUtils::STATUS_CODE_ERR,
                    'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                    'message' => ['err' => 'Bạn vừa gửi thông tin liên hệ! Vui lòng thử lại sau 15 phút.']
                ];
            }
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $validateRes=$this->validateContact($req);
        if($validateRes->getErrors())
        {
            return [
                'status'=>ResultUtils::STATUS_CODE_ERR,
                'messageCode'=>ResultUtils::MESSAGE_CODE_ERR,
                'message'=>$validateRes->getErrors()
            ];
        }
        $param=$req->getPost();
        $data=[
            'ten'=>$param['name_contact'],
            'sdt'=>$param['number_contact'],
            'mail'=>$param['email_contact'],
            'id_p'=>$param['group_contact'],
            'tieude'=>$param['heading_contact'],
            'noidung'=>$param['content_contact'],
            'ngay_lh'=>date("d/m/Y H:i:s"),
            'trangthai'=>'0'
        ];
        if($this->lienheModel->insert($data))
        {
            session()->set('contactTime',time());
            return [
                'status'=>ResultUtils::STATUS_CODE_OK,
                'messageCode'=>ResultUtils::MESSAGE_CODE_OK,
                'message'=>['success'=>'Xin cám ơn về góp ý của bạn. Thông tin của bạn đã được ghi nhận.']
            ];
        }
        return [
            'status'=>ResultUtils::STATUS_CODE_ERR,
            'messageCode'=>ResultUtils::MESSAGE_CODE_ERR,
            'message'=>['err'=>'Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau.']
        ];

    }

    private function validateContact($req)
    {
        $rules=[
            "group_contact"=>'required',
            "name_contact"=>'required|max_length[100]',
            "number_contact"=>'required|max_length[12]',
            "email_contact"=>'required|valid_email',
            "heading_contact"=>'max_length[500]',
            "content_contact"=>'required|max_length[1000]'
        ];
        $message=[
            "group_contact"=>[
                'required'=>'Chưa chọn nơi cần liên hệ! Vui lòng thử lại sau.'
            ],
            "name_contact"=>[
                'required'=>'Tên liên hệ không được để trống.',
                'max_length'=>'Tên liên hệ không quá 100 ký tự'
            ],
            "number_contact"=>[
                'required'=>'Số điện thoại không được để trống.',
                'max_length'=>'Số điện thoại không quá 12 ký tự'
            ],
            "email_contact"=>[
                'required'=>'Email không được để trống.',
                'valid_email'=>'Email chưa đúng định dạng'
            ],
            "heading_contact"=>[
                'max_length'=>'Tiêu đề không quá 500 ký tự'
            ],
            "content_contact"=>[
                'required'=>'Nội dung không được để trống.',
                'max_length'=>'Nội dung không quá 1000 ký tự'
            ],
        ];
        $this->validation->setRules($rules,$message);
        $this->validation->withRequest($req)->run();
        return $this->validation;
    }
}