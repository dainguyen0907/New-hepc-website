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
        if (!$this->checkPasswordStrength($param['password'])) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['err' => 'Mật khẩu chưa đủ mạnh.']
            ];
        }
        $updatePass = [
            'password' => password_hash($param['password'], PASSWORD_DEFAULT)
        ];
        $decryptid = $this->decryptString($param['id_user']);
        $res = $this->userModel->update($decryptid, $updatePass);
        if ($res) {
            $this->writeHistory('reset', 'Người dùng', session('userLogin')['id_user'], $decryptid);
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
            "password" => 'required|min_length[8]|max_length[50]',
            "repassword" => 'required|matches[password]'
        ];
        $message = [
            "password" => [
                'required' => 'Mật khẩu không được để trống',
                'min_length' => 'Mật khẩu phải lớn hơn 8 ký tự',
                'max_length' => 'Mật khẩu không vượt quá 50 ký tự',
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
        if (!$this->checkPasswordStrength($param['password'])) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['err' => 'Mật khẩu chưa đủ mạnh.']
            ];
        }
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
            $this->writeHistory('add', 'Người dùng', session('userLogin')['id_user'], $res);
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
                "password" => 'required|min_length[8]|max_length[50]',
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
                    'min_length' => 'Mật khẩu phải lớn hơn 8 ký tự',
                    'max_length' => 'Mật khẩu không vượt quá 50 ký tự',
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
        $decryptid = $this->decryptString($param['id_user']);
        $data = [
            'id_q' => $param['roles_user'],
            'id_pb' => $param['group_user'],
            'user' => $param['name_user'],
            'gender' => $param['gender_user'],
            'birthday' => $param['birthday_user'],
            'address' => $param['address_user'],
            'status_user' => $param['status_user']
        ];
        $res = $this->userModel->update($decryptid, $data);
        if ($res) {
            $this->writeHistory('update', 'Người dùng', session('userLogin')['id_user'], $decryptid);
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
        $decryptid = $this->decryptString($param['id']);
        $res = $this->userModel->delete($decryptid);
        if ($res) {
            $this->writeHistory('delete', 'Người dùng', session('userLogin')['id_user'], $decryptid);
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
    //CHức năng: Đổi mật khẩu
//Vị trí: Trang Admin->Đổi mật khẩu

    public function checkPasswordStrength($password)
    {
        $pattern = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
        if (preg_match($pattern, $password) == 1) {
            return true;
        }
        return false;
    }
    public function checkUserPassword($id, $password)
    {
        $user = $this->userModel->where('id_user', $id)->first();
        if (empty($user)) {
            return false;
        }
        if (password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    }
    public function changePassword($req)
    {
        $validateRes = $this->validateChangePassword($req);
        if ($validateRes->getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validateRes->getErrors()
            ];
        }
        $param = $req->getPost();
        if (!$this->checkUserPassword(session('userLogin')['id_user'], $param['old_password'])) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['err' => 'Mật khẩu cũ chưa chính xác.']
            ];
        }
        if (!$this->checkPasswordStrength($param['new_password'])) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['err' => 'Mật khẩu chưa đủ mạnh.']
            ];
        }
        if ($this->userModel->update(session('userLogin')['id_user'], ['password' => password_hash($param['new_password'], PASSWORD_DEFAULT)])) {
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success' => 'Cập nhật mật khẩu thành công']
            ];
        } else {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['err' => 'Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau.']
            ];
        }
    }
    private function validateChangePassword($req)
    {
        $rules = [
            "old_password" => 'required|min_length[9]|max_length[50]',
            "new_password" => 'required|min_length[9]|max_length[50]|differs[old_password]',
            "re_password" => 'matches[new_password]'
        ];
        $message = [
            'old_password' => [
                'required' => 'Mật khẩu không được để trống',
                'min_length' => 'Mật khẩu phải lớn hơn 8 ký tự',
                'max_length' => 'Mật khẩu không vượt quá 50 ký tự',
            ],
            'new_password' => [
                'required' => 'Mật khẩu không được để trống',
                'min_length' => 'Mật khẩu phải lớn hơn 8 ký tự',
                'max_length' => 'Mật khẩu không vượt quá 50 ký tự',
                'differs'=>'Mật khẩu mới không trùng với mật khẩu cũ'
            ],
            're_password' => [
                'matches' => 'Xác nhận mật khẩu chưa trùng khớp.'
            ]

        ];
        $this->validation->setRules($rules, $message);
        $this->validation->withRequest($req)->run();
        return $this->validation;
    }

    //CHức năng: Kiểm tra tính hợp lệ của tài khoản
//Vị trí: 
    public function checkUserStatus($userId)
    {
        $user=$this->userModel->find($userId);
        if(is_null($user)){
            return false;
        }
        if($user['status_user']==1)
        {
            return true;
        }
        return false;
    }
//CHức năng: Lấy phân quyền của tài khoản
//Vị trí: 
    public function getUserRole($userId)
    {
        $user=$this->userModel->find($userId);
        if(is_null($user)){
            return -1;
        }
        return $user['id_q'];
    }
}