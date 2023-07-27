<?php
namespace App\Services;

use App\Common\ResultUtils;
use App\Models\userModel;

class userService extends BaseService
{
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new userModel();
    }

    public function login($req)
    {
        $validation=$this->validateUserLogin($req);
        if($validation->getErrors())
        {
            return [
                'status'=>ResultUtils::STATUS_CODE_ERR,
                'messageCode'=>ResultUtils::MESSAGE_CODE_ERR,
                'message'=>$validation->getErrors()
            ];
        }
        $param=$req->getPost();
        $res=$this->userModel->where('email',$param['email'])->first();
        if($res!=null)
        {
            if(!password_verify($param['password'],$res['password']))
            {
                return [
                    'status'=>ResultUtils::STATUS_CODE_ERR,
                    'messageCode'=>ResultUtils::MESSAGE_CODE_ERR,
                    'message'=>["err"=>"Mật khẩu không đúng"]
                ];
            }
            if(!session('userLogin'))
            {
                session()->set('userLogin',$res);
            }
            
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success' => 'Đăng nhập thành công']
            ];
        }else{
            return [
                'status'=>ResultUtils::STATUS_CODE_ERR,
                'messageCode'=>ResultUtils::MESSAGE_CODE_ERR,
                'message'=>["err"=>"Tài khoản không tồn tại"]
            ];
        }
    }

    function validateUserLogin($req)
    {
        $rule = [
            "email" => 'required',
            "password" => 'required'
        ];
        $message=[
            "email"=>[
                "required"=>'Hãy nhập email'
            ],
            "password"=>[
                "required"=>'Hãy nhập mật khẩu'
            ],
        ];
        $this->validation->setRules($rule,$message);
        $this->validation->withRequest($req)->run();

        return $this->validation;
    }



}