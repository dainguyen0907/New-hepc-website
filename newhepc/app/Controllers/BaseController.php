<?php

namespace App\Controllers;

use App\Services\admin_anhService;
use App\Services\admin_baivietService;
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
        
        $this->pictureService=new admin_anhService();
        $this->postService=new admin_baivietService();
        // E.g.: $this->session = \Config\Services::session();
    }
    public function loadLayout($masterPage, $title, $page, $dataLayout, $css, $js)
    {
        $masterPage['title'] = $title;
        $masterPage['header'] = view('publicPage/layouts/header');
        $masterPage['page'] = view($page, $dataLayout);
        $masterPage['footer'] = view('publicPage/layouts/footer');
        $masterPage['css'] = $css;
        $masterPage['js'] = $js;
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
            'censor_post'=>$this->postService->getCountCensorPost(session('userLogin')['id_pb'])]);
        $masterPage['header'] = view('adminPage/layouts/header');
        $masterPage['content'] = view($page,$dataLayout);
        $masterPage['cssLib'] = $css;
        $masterPage['jsLib'] = $js;
        return $masterPage;
    }


}