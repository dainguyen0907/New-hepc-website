<?php
namespace App\Services;

use App\Common\ResultUtils;
use App\Models\userModel;


class admin_userService extends BaseService
{
    private $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new userModel();
        $this->userModel->protect(false);
    }
    //CHức năng: Lấy tất cả user
//Vị trí: Trang Admin->quản trị->user
    public function getAllUser()
    {
        return $this->userModel->join('phanquyen', 'phanquyen.id_q=user.id_q', 'left')->findAll();
    }
//CHức năng: Reset password cho user bất kỳ
//Vị trí: Trang Admin->quản trị->user
    public function resetPassword($req)
    {
        $param = $req->getPost();
        $validationRes = $this->validatePassword($req);
        if ($validationRes->getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validationRes->getErrors()
            ];
        }
        $updatePass = [
            'password' => password_hash($param['password'], PASSWORD_DEFAULT)
        ];
        $res = $this->userModel->update($param['id_user'], $updatePass);
        if ($res) {
            $this->writeHistory('reset','Người dùng',session('userLogin')['id_user'],$param['id_user']);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success' => 'Đổi mật khẩu thành công']
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['error' => 'Lỗi hệ thống! Vui lòng thử lại sau.']
        ];

    }
//CHức năng: Kiểm tra thông tin password đã nhập, dùng cho reset password
//Vị trí: 
    private function validatePassword($req)
    {
        $rules = [
            "password" => 'required|min_length[6]|max_length[20]|alpha_numeric_punct',
            "repassword" => 'required|matches[password]'
        ];
        $message = [
            "password" => [
                'required' => 'Mật khẩu không được để trống',
                'min_length' => 'Mật khẩu phải lớn hơn 6 ký tự',
                'max_length' => 'Mật khẩu không vượt quá 20 ký tự',
                'alpha_numeric_punct' => `Mật khẩu phải chứa ký tự là chữ, là số hoặc các ký tự ~!#$%&'-_+=|:.`,
            ],
            "repassword" => [
                'required' => 'Xác nhận mật khẩu không được để trống',
                'matches' => 'Xác nhận mật khẩu không trùng khớp'
            ]
        ];

        $this->validation->setRules($rules, $message);
        $this->validation->withRequest($req)->run();
        return $this->validation;

    }
//CHức năng: Lấy thông tin user bằng id_user
//Vị trí: Trang Admin->quản trị->user
    public function getUserInfo($id)
    {
        return $this->userModel->where('id_user', $id)->first();
    }
//CHức năng: Tạo user mới
//Vị trí: Trang Admin->quản trị->user
    public function createUser($req)
    {
        $validationRes = $this->validateUser('add', $req);
        if ($validationRes->getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validationRes->getErrors()
            ];
        }
        $param = $req->getPost();
        $data = [
            'id_q' => $param['roles_user'],
            'id_pb' => $param['group_user'],
            'password' => password_hash($param['password'], PASSWORD_DEFAULT),
            'user' => $param['name_user'],
            'gender' => $param['gender_user'],
            'birthday' => $param['birthday_user'],
            'address' => $param['address_user'],
            'email' => $param['email_user'],
            'd_regis' => date("d/m/Y"),
            'status_user' => $param['status_user']
        ];
        $res = $this->userModel->insert($data);
        if ($res) {
            $this->writeHistory('add','Người dùng',session('userLogin')['id_user'],$res);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success' => 'Thêm tài khoản thành công']
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err' => 'Xảy ra lỗi hệ thống. Vui lòng thử lại sau']
        ];

    }
//CHức năng: Kiểm tra thông tin user đã nhập, dùng cho thêm/sửa user
//Vị trí:
    private function validateUser($method, $req)
    {
        $rules = [
            "name_user" => 'required|max_length[50]',
            "address_user" => 'max_length[100]'
        ];
        if ($method == 'add') {
            $rules = [
                "password" => 'required|min_length[6]|max_length[20]|alpha_numeric_punct',
                "email_user" => 'required|valid_email|is_unique[user.email]'
            ];
        }
        $message = [
            "name_user" => [
                'required' => 'Tên người dùng không được để trống',
                'max_length' => 'Tên người dùng không quá 50 ký tự'
            ],
            "address" => ['max_length' => 'Địa chỉ không lớn hơn 100 ký tự']
        ];
        if ($method == 'add') {
            $message = [
                'password' => [
                    'required' => 'Mật khẩu không được để trống',
                    'min_length' => 'Mật khẩu phải lớn hơn 6 ký tự',
                    'max_length' => 'Mật khẩu không vượt quá 20 ký tự',
                    'alpha_numeric_punct' => `Mật khẩu phải chứa ký tự là chữ, là số hoặc các ký tự ~!#$%&'-_+=|:.`
                ],
                "email_user" => [
                    'required' => 'Email không được để trống',
                    'valid_email' => 'Email chưa đúng định dạng',
                    'is_unique' => 'Email đã tồn tại'
                ],
            ];
        }

        $this->validation->setRules($rules, $message);
        $this->validation->withRequest($req)->run();

        return $this->validation;
    }
//CHức năng: Cập nhật thông tin user
//Vị trí: Trang Admin->quản trị->user
    public function updateUser($req)
    {
        $validationRes = $this->validateUser('update', $req);
        if ($validationRes->getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validationRes->getErrors()
            ];
        }
        $param = $req->getPost();
        $data = [
            'id_q' => $param['roles_user'],
            'id_pb' => $param['group_user'],
            'user' => $param['name_user'],
            'gender' => $param['gender_user'],
            'birthday' => $param['birthday_user'],
            'address' => $param['address_user'],
            'status_user' => $param['status_user']
        ];
        $res = $this->userModel->update($param['id_user'], $data);
        if ($res) {
            $this->writeHistory('update','Người dùng',session('userLogin')['id_user'],$param['id_user']);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success' => 'Cập nhật tài khoản thành công']
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err' => 'Xảy ra lỗi hệ thống. Vui lòng thử lại sau']
        ];

    }
    //CHức năng: Xóa user
//Vị trí: Trang Admin->quản trị->user
    public function deleteUser($req)
    {
        $param = $req->getPost();
        $res=$this->userModel->delete($param['id']);
        if ($res) {
            $this->writeHistory('delete','Người dùng',session('userLogin')['id_user'],$param['id']);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success' => 'Xóa tài khoản thành công']
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err' => 'Xảy ra lỗi hệ thống. Vui lòng thử lại sau']
        ];

    }




}