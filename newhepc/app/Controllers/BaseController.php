<?php

namespace App\Controllers;

use App\Services\admin_anhService;
use App\Services\admin_baivietService;
use App\Services\admin_lienheService;
use App\Services\baivietService;
use App\Services\cmphongbanService;
use App\Services\fileAnhService;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    private $pictureService;
    private $postService;
    private $contactService;
    private $cmpbService;
    private $baivietService;
    private $anhService;
    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->baivietService = new baivietService();
        $this->pictureService=new admin_anhService();
        $this->postService=new admin_baivietService();
        $this->contactService=new admin_lienheService();
        $this->cmpbService = new cmphongbanService();
        $this->anhService=new fileAnhService();
        // E.g.: $this->session = \Config\Services::session();
    }
    public function loadLayout($masterPage, $title, $page, $dataLayout, $css, $js)
    {
        $masterPage['title'] = $title;
        $masterPage['header'] = view('publicPage/layouts/header');
        $masterPage['page'] = view($page, $dataLayout);
        $masterPage['footer'] = view('publicPage/layouts/footer');
        $masterPage['css'] = $css;
        $masterPage['jsLib'] = $js;
        return $masterPage;
    }

    public function checkPageExits($res, $page, $dataLayout)
    {
        $masterPage = [];
        if ($res == null) {
            return $this->load404page();
        }
        $title = $res['heading'];
        $dataPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('publicPage/masterPage', $dataPage);
    }
    public function load404page()
    {
        $masterPage = [];
        $title = "HEPC";
        $page = 'publicPage/pages/404';
        $dataPage = $this->loadLayout($masterPage, $title, $page, [], [], []);
        return view('publicPage/masterPage', $dataPage);
    }

    public function loadAdminLayout($masterPage, $title, $page, $dataLayout, $css, $js)
    {
        $masterPage['title'] = $title;
        $masterPage['leftMenu'] = view('adminPage/layouts/leftMenu',[
            'cencor_pic'=>$this->pictureService->getCensorPicture(session('userLogin')['id_pb']),
            'censor_post'=>$this->postService->getCountCensorPost(session('userLogin')['id_pb']),
            'unseen_contact'=>$this->contactService->getCountContactUnseen(session('userLogin')['id_pb'])]);
        $masterPage['header'] = view('adminPage/layouts/header');
        $masterPage['content'] = view($page,$dataLayout);
        $masterPage['cssLib'] = $css;
        $masterPage['jsLib'] = $js;
        return $masterPage;
    }

    public function convertStringToLink($str){
		$str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
		$str = preg_replace("/( )/", '-', $str);
        $str = preg_replace("/(\/)/", '-', $str);
		return $str;
    }

    public function convertLinkToString($str){
        $str = preg_replace("/(-)/", ' ', $str);
		return $str;
    }

    protected function verifyCaptcha($keySecret)
    {
        $captcha_respone = trim($this->request->getPost('g-recaptcha-response'));
        if ($captcha_respone != '') {
            $check = array(
                'secret' => $keySecret,
                'response' => $this->request->getPost('g-recaptcha-response')
            );
            $startProcess = curl_init();
            curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($startProcess, CURLOPT_POST, true);
            curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));
            curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);
            $receiveData = curl_exec($startProcess);
            $finalResponse = json_decode($receiveData, true);
            return $finalResponse;
        }
        return false;
    }

    protected function loadDepartmentPage($id_department,$id_catalouge_1,$id_catalouge_2,$title,$link_department)
    {
        $gioithieu = $this->cmpbService->getCatalogueByID($id_catalouge_1);
        $tintuc = $this->cmpbService->getCatalogueByID($id_catalouge_2);
        if(!isset($gioithieu)){
            $gioithieu=["cmphongban"=>"","link"=>"/#"];
        }
        if(!isset($tintuc)){
            $tintuc=["cmphongban"=>"","link"=>"/#"];
        }
        $masterPage = [];
        $page = 'publicPage/pages/officePage';
        $dataLayout['Banner'] = $title;
        $dataLayout['f_name_catalogue'] = $gioithieu['cmphongban'];
        $dataLayout['s_name_catalogue'] = $tintuc['cmphongban'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage($id_catalouge_1);
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage($id_catalouge_2);
        $dataLayout['image'] = null;
        $dataLayout['album']=$this->anhService->getPicturesById_PB($id_department);
        $dataLayout['link'] = $link_department;
        $Page = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('publicPage/masterPage', $Page);
    }

    protected function loadNewDetailPage($link,$id_department,$title,$link_department)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink($id_department, $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB($id_department, $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif (isset($catalogue)) {
            $masterPage = [];
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = $title ;
            $dataLayout['content'] = view('publicPage/pages/newsPage', ['News' => $this->baivietService->getNewForPage($catalogue['id_cmpb']), 'link' => $link_department]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForNew', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues($id_department), 'link' => $link_department]);
            $Page = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('publicPage/masterPage', $Page);
        } else {
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = $title;
            $dataLayout['content'] = view('publicPage/pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew($newdetail['id_cmpb'], $link), 'link' => $link_department]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForNew', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues($id_department), 'link' => $link_department]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }
    }
}