<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Services\admin_userService;
class controlFilter implements FilterInterface
{
    protected $user;
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session('userLogin')) {
            $this->user=new admin_userService();
            $id=session('userLogin')['id_user'];
            $id_role=$this->user->getUserRole($id);
            if ($id_role>2&&$id_role!=-1) {
                return redirect('admin');
            }
        }else{
            return redirect('dang-nhap');
        }
        

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}