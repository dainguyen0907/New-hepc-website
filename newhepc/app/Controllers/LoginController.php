<?php

namespace App\Controllers;

use App\Common\ResultUtils;
use App\Services\baivietService;
use App\Services\userService;



class LoginController extends BaseController
{
    private $baivietService;
    private $userService;
    public function __construct()
    {
        $this->baivietService = new baivietService();
        $this->userService = new userService();
    }
    public function index()
    {
        $masterPage = [];
        $title = "HEPC";
        $page = 'publicPage/subMasterPage';
        $dataLayout['Banner'] = "Đăng nhập";
        $dataLayout['content'] = view('publicPage/pages/login', ['countLogin' => session('countLogin')]);
        $dataLayout['Pager'] = null;
        $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForNew', ['Newest' => $this->baivietService->getAnouncementForRightMenu()]);
        $jsLib = ['https://www.google.com/recaptcha/api.js'];
        $NewPaperPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], $jsLib);
        return view('publicPage/masterPage', $NewPaperPage);
    }

    private function loginFunction()
    {
        if (!session('countLogin')) {
            session()->set('countLogin', 1);
        } else {
            $count = session('countLogin') + 1;
            session()->set('countLogin', $count);
        }
        $res = $this->userService->login($this->request);
        if ($res['status'] === ResultUtils::STATUS_CODE_OK) {
            unset($_SESSION['countLogin']);
            return redirect('/');
        }
        return redirect()->back()->withInput()->with($res['messageCode'], $res['message']);
    }

    public function login()
    {
        if (session('countLogin') && session('countLogin') > 3) {
            $response = $this->verifyCaptcha('6LciBMsoAAAAAOzN7Ixl30oA15KLdcd9FQKOaard');
            if ($response != false) {
                if ($response['success']) {
                    return $this->loginFunction();
                }
                return redirect()->back()->withInput()->with('errorsMsg', ['Xác minh không thành công! Vui lòng thử lại.']);
            }
            return redirect()->back()->withInput()->with('errorsMsg', ['Vui lòng thực hiện xác minh để đăng nhập']);
        }
        return $this->loginFunction();
    }
    public function logout()
    {
        if (session('userLogin')) {
            unset($_SESSION['userLogin']);
        }
        return redirect('/');
    }

    public function loadForgetPasswordPage()
    {
        $masterPage = [];
        $title = "HEPC";
        $page = 'publicPage/subMasterPage';
        $dataLayout['Banner'] = "Quên mật khẩu";
        $dataLayout['content'] = view('publicPage/pages/forgetPasswordPage');
        $dataLayout['Pager'] = null;
        $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForNew', ['Newest' => $this->baivietService->getAnouncementForRightMenu()]);
        $jsLib = ['https://www.google.com/recaptcha/api.js'];
        $NewPaperPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], $jsLib);
        return view('publicPage/masterPage', $NewPaperPage);
    }

    public function resetPassword()
    {
        $responseCaptcha = $this->verifyCaptcha('6Lf47M0oAAAAAP5lz8AhmkkUZ_shDFvyXCzRWpgO');
        if ($responseCaptcha != false) {
            if ($responseCaptcha['success']) {
                $res = $this->userService->resetPassword($this->request);
                return redirect()->back()->withInput()->with($res['messageCode'], $res['message']);
            }
            return redirect()->back()->withInput()->with('errorsMsg', ['Xác minh không thành công! Vui lòng thử lại.']);
        }
        return redirect()->back()->withInput()->with('errorsMsg', ['Vui lòng thực hiện xác minh để lấy lại mật khẩu']);
    }
}
