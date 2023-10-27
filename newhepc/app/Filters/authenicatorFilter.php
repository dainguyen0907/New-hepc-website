<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Services\admin_userService;

class authenicatorFilter implements FilterInterface
{
    protected $user;
    public function before(RequestInterface $request, $arguments = null)
    {
        if(!session('userLogin'))
        {
            return redirect('dang-nhap');
        }
        $this->user=new admin_userService();
        if(!$this->user->checkUserStatus(session('userLogin')['id_user']))
        {
            unset($_SESSION['userLogin']);
            session()->setFlashdata('errorsMsg',['Tài khoản đã bị vô hiệu hoá']);
            return redirect('dang-nhap');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}