<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class managemnetFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(session('userLogin')['id_q']!='1')
        {
            return redirect('admin');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}