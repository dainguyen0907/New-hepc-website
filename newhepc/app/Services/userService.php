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
        $this->userModel->protect(false);
    }

    //CHức năng: Đăng nhập bằng form ->method=post
//Vị trí: Trang đăng nhập
    public function login($req)
    {
        $validation = $this->validateUserLogin($req, 'login');
        if ($validation->getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validation->getErrors()
            ];
        }
        $param = $req->getPost();
        $res = $this->userModel->where('email', $param['email'])->first();
        if ($res != null) {
            if (!password_verify($param['password'], $res['password'])) {
                return [
                    'status' => ResultUtils::STATUS_CODE_ERR,
                    'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                    'message' => ["err" => "Mật khẩu không đúng"]
                ];
            }
            if ($res['status_user'] == 0) {
                return [
                    'status' => ResultUtils::STATUS_CODE_ERR,
                    'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                    'message' => ["err" => "Tài khoản đã bị khóa! Vui lòng liên hệ quản trị viên."]
                ];
            }
            if (!session('userLogin')) {
                session()->set('userLogin', $res);
            }

            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success' => 'Đăng nhập thành công']
            ];
        } else {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ["err" => "Tài khoản không tồn tại"]
            ];
        }
    }
    //CHức năng: Kiểm tra lỗi nhập liệu
//Vị trí: 
    function validateUserLogin($req, $method)
    {
        $rule["email"] = 'required';
        $message["email"] = ["required" => 'Hãy nhập email'];
        if ($method == 'login') {
            $rule['password'] = 'required';
            $message['password'] = 'Hãy nhập mật khẩu';
        }

        $this->validation->setRules($rule, $message);
        $this->validation->withRequest($req)->run();

        return $this->validation;
    }
    //CHức năng: Reset password
//Vị trí: Quên mật khẩu
    public function resetPassword($req)
    {
        $validation = $this->validateUserLogin($req, 'resetPassword');
        if ($validation->getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validation->getErrors()
            ];
        }
        $param = $req->getPost();
        $data = $this->userModel->where('email', $param['email'])->first();
        if ($data == null) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['err' => 'Không tìm thấy email. Hãy kiểm tra lại email của bạn.']
            ];
        }
        $newpass = rand(100000, 999999);
        if ($this->userModel->update($data['id_user'], ['password' => password_hash($newpass, PASSWORD_DEFAULT)])) {
            $message = 
            'Mật khẩu tạm của bạn là: "' . $newpass . '".
            Hãy đăng nhập vào hệ thống và đổi mật khẩu mới.';
            $email = \Config\Services::email();
            $email->clear();
            $email->setFrom('website.hepc@gmail.com', 'Cập nhật mật khẩu mới');
            $email->setReplyTo('noreply@example.com','No-reply');
            $email->setTo($data['email']);
            $email->setSubject('Cập nhật mật khẩu mới cho tài khoản HEPC của bạn | hepc.edu.vn');
            $email->setMessage($message);
            if ($email->send()) {
                return [
                    'status' => ResultUtils::STATUS_CODE_OK,
                    'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                    'message' => ['success' => 'Vui lòng kiểm tra hộp thư của bạn để nhận mật khẩu mới.']
                ];
            } else {
                return [
                    'status' => ResultUtils::STATUS_CODE_ERR,
                    'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                    'message' => ['err' => $email->printDebugger(['headers'])]
                ];
            }
        } else {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['err' => 'Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau.']
            ];
        }


    }

}