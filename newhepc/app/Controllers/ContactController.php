<?php

namespace App\Controllers;

use App\Common\ResultUtils;
use App\Services\admin_phongbanService;
use App\Services\baivietService;
use App\Services\lienheService;


class ContactController extends BaseController
{

    private $baivietService;
    private $phongbanService;
    private $lienheService;
    public function __construct()
    {
        $this->baivietService = new baivietService();
        $this->phongbanService = new admin_phongbanService();
        $this->lienheService = new lienheService();
    }
    public function index()
    {
        $masterPage = [];
        $title = "Liên hệ";
        $page = 'publicPage/subMasterPage';
        $dataLayout['Banner'] = "Liên hệ";
        $dataLayout['content'] = view('publicPage/pages/contact', ['phongban' => $this->phongbanService->getAllPhongBan()]);
        $dataLayout['Pager'] = null;
        $dataLayout['rightBanner'] = view(
            'publicPage/layouts/rightMenuForNew',
            ['Newest' => $this->baivietService->getAnouncementForRightMenu(),]
        );
        $js = ['https://www.google.com/recaptcha/api.js'];
        $NewPaperPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], $js);
        return view('publicPage/masterPage', $NewPaperPage);
    }

    public function addContact()
    {
        $response = $this->verifyCaptcha('6LcMld4oAAAAALlNCfMNobzW30kEemrZ_bZQcDuS');
        if ($response != false) {
            if ($response['success']) {
                $res = $this->lienheService->addContact($this->request);
                return redirect()->back()->withInput()->with($res['messageCode'], $res['message']);
            }
            return redirect()->back()->withInput()->with('errorsMsg', ['Xác minh không thành công! Vui lòng thử lại.']);
        }
        return redirect()->back()->withInput()->with('errorsMsg', ['Vui lòng thực hiện xác minh để đăng nhập']);

    }
}
