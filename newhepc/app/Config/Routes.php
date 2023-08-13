<?php

namespace Config;
use App\Filters\controlFilter;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
// $routes->set404Override(
//     static function(){
//     $masterPage['title'] ='HEPC';
//     $masterPage['header'] = view('publicPage/layouts/header');
//     $masterPage['page'] = view('publicPage/pages/404');
//     $masterPage['footer'] = view('publicPage/layouts/footer');
//     echo view('publicPage/masterPage',$masterPage);
// });
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');
$routes->get('/gioi-thieu/(:any)', 'IntroduceController::showIntroduce/$1');
$routes->get('/tin-tuc', 'NewPaperController::index');
$routes->get('/tin-tuc/(:any)', 'NewPaperController::getNewPaperDetail/$1');
$routes->get('/thong-bao', 'AnouncementController::index');
$routes->get('/thong-bao/(:any)', 'AnouncementController::getAnouncementDetail/$1');
$routes->get('/thoi-khoa-bieu', 'TimeTableController::index');
$routes->get('/thoi-khoa-bieu/(:any)', 'TimeTableController::getTimeTableDetail/$1');
$routes->get('/lich-thi', 'ScheduleController::index');
$routes->get('/lich-thi/(:any)', 'ScheduleController::getScheduleDetail/$1');
$routes->get('/bieu-mau', 'FormController::index');
$routes->get('/bieu-mau/(:any)', 'FormController::getFormDetail/$1');
$routes->get('/ba-cong-khai', 'CommitmentController::index');
$routes->get('/ba-cong-khai/(:any)', 'CommitmentController::getCommitmentDetail/$1');
$routes->get('/tuyen-sinh', 'AdmissionController::index');
$routes->get('/tuyen-sinh/(:any)', 'AdmissionController::getAdmissionDetail/$1');
$routes->get('/tuyen-dung', 'RecruitmentController::index');
$routes->get('/tuyen-dung/(:any)', 'RecruitmentController::getRecruitmentDetail/$1');
$routes->get('/cong-doan', 'UnionController::index');
$routes->get('/cong-doan/(:any)', 'UnionController::getNewsOfCatalogueUnion/$1');
$routes->get('/hoat-dong-doan', 'GroupController::index');
$routes->get('/hoat-dong-doan/(:any)', 'GroupController::getNewsOfCatalogueGroup/$1');
//Login
$routes->get('/dang-nhap', 'LoginController::index',['filter'=>'loginFilter']);
$routes->get('/thoat', 'LoginController::logout');
$routes->post('/dang-nhap', 'LoginController::login');
$routes->get('/phong-to-chuc', 'TCHCController::index');
$routes->get('/phong-to-chuc/(:any)', 'TCHCController::getNewsOfCatalogueTCHC/$1');
$routes->get('/phong-tai-chinh', 'TCKTController::index');
$routes->get('/phong-tai-chinh/(:any)', 'TCKTController::getNewsOfCatalogueTCKT/$1');
$routes->get('/phong-dao-tao', 'DTController::index');
$routes->get('/phong-dao-tao/(:any)', 'DTController::getNewsOfCatalogueDT/$1');
$routes->get('/phong-qlkh', 'QLKHController::index');
$routes->get('/phong-qlkh/(:any)', 'QLKHController::getNewsOfCatalogueQLKH/$1');
$routes->get('/phong-qlhssv', 'QLHSSVController::index');
$routes->get('/phong-qlhssv/(:any)', 'QLHSSVController::getNewsOfCatalogueQLHSSV/$1');
$routes->get('/phong-quan-tri', 'QTController::index');
$routes->get('/phong-quan-tri/(:any)', 'QTController::getNewsOfCatalogueQT/$1');
$routes->get('/phong-tt-nangluong', 'TTCNNLController::index');
$routes->get('/phong-tt-nangluong/(:any)', 'TTCNNLController::getNewsOfCatalogueTTCNNL/$1');
$routes->get('/phong-nn-tt', 'NNTTController::index');
$routes->get('/phong-nn-tt/(:any)', 'NNTTController::getNewsOfCatalogueNNTT/$1');
$routes->get('/khoa-htd', 'HTDController::index');
$routes->get('/khoa-htd/(:any)', 'HTDController::getNewsOfCatalogueHTD/$1');
$routes->get('/khoa-ktcs', 'KTCSController::index');
$routes->get('/khoa-ktcs/(:any)', 'KTCSController::getNewsOfCatalogueKTCS/$1');
$routes->get('/khoa-dcn', 'DCNController::index');
$routes->get('/khoa-dcn/(:any)', 'DCNController::getNewsOfCatalogueDCN/$1');
$routes->get('/khoa-khcb-kt', 'KHCBKTController::index');
$routes->get('/khoa-khcb-kt/(:any)', 'KHCBKTController::getNewsOfCatalogueKHCBKT/$1');
$routes->get('/khoa-cndt-tdh', 'CNDTTDHController::index');
$routes->get('/khoa-cndt-tdh/(:any)', 'CNDTTDHController::getNewsOfCatalogueCNDTTDH/$1');
$routes->get('/khoa-dtnc', 'DTNCController::index');
$routes->get('/khoa-dtnc/(:any)', 'DTNCController::getNewsOfCatalogueDTNC/$1');

$routes->get('/lien-he', 'ContactController::index');
$routes->post('/lien-he/add', 'ContactController::addContact');

$routes->get('/tim-kiem', 'SearchController::index');
$routes->get('/tim-kiem/(:any)', 'SearchController::loadSearchPage/$1');
$routes->get('/ket-qua/(:any)', 'SearchController::loadDetailSearchPage/$1');
$routes->group('admin',['filter'=>'authenicatorFilter'],function($routes){
    $routes->get('/', 'Admin_HomeController::index');
    $routes->group('management',['filter'=>'managementFilter'],function($routes){
        $routes->get('user', 'Admin_UserController::index');
        $routes->get('user/add', 'Admin_UserController::addPage');
        $routes->post('user/add', 'Admin_UserController::createUser');
        $routes->post('user/delete', 'Admin_UserController::deleteUser');
        $routes->post('user/change', 'Admin_UserController::updateUser');
        $routes->get('user/(:num)', 'Admin_UserController::changePage/$1');
        $routes->post('user/resetPassword', 'Admin_UserController::resetPassword');

        $routes->get('history', 'Admin_HistoryController::index');

        $routes->get('group','Admin_GroupController::index');
        $routes->get('group/change/(:num)','Admin_GroupController::change_status/$1');
        $routes->post('group/delete','Admin_GroupController::deleteGroup');
        $routes->post('group/add','Admin_GroupController::addGroup');

        $routes->get('catalogue','Admin_CatalogueController::index');
        $routes->post('catalogue/add','Admin_CatalogueController::addCatalogue');
        $routes->post('catalogue/delete','Admin_CatalogueController::deleteCatalogue');
        $routes->post('catalogue/update','Admin_CatalogueController::updateCatalogue');

        $routes->get('banner','Admin_BannerController::index');
        $routes->post('banner/add','Admin_BannerController::addBanner');
        $routes->post('banner/update','Admin_BannerController::updateBanner');
        $routes->post('banner/delete','Admin_BannerController::deleteBanner');

        $routes->get('video','Admin_VideoController::index');
        $routes->post('video/add','Admin_VideoController::addVideo');
        $routes->get('video/(:num)','Admin_VideoController::updateVideoPage/$1');
        $routes->post('video/delete','Admin_VideoController::deleteVideo');
        $routes->post('video/update','Admin_VideoController::updateVideo');

        $routes->get('picture','Admin_PictureController::index');

        $routes->get('post/update','Admin_NewController::loadEditPageAdmin');
        $routes->get('post','Admin_NewController::index');
        
    });

    $routes->post('ajax/getnew', 'Admin_NewController::loadDataTableById_pb');
    $routes->post('ajax/getcensorpost', 'Admin_NewController::loadCensorDataTableById_pb');
    $routes->post('ajax/getcatalogueforgroup', 'Admin_NewController::loadCatalogueById_pb');

    $routes->get('Mypicture', 'Admin_PictureController::loadMyPicturePage');
    $routes->post('picture/delete','Admin_PictureController::deletePicture');
    $routes->post('picture/add','Admin_PictureController::addPicture');

    $routes->group('control',['filter'=>'controlFilter'],function($routes){
        $routes->get('Grouppicture', 'Admin_PictureController::loadGroupPicturePage');
        $routes->get('Censorpicture', 'Admin_PictureController::loadCensorPicturePage');
        $routes->post('picture/update','Admin_PictureController::updatePicture');
        $routes->get('Mygrouppost', 'Admin_NewController::loadMyGroupPostPage');
        $routes->get('Censorpost', 'Admin_NewController::loadCensorPostPage');

        $routes->get('pass/(:num)', 'Admin_NewController::pass_censor/$1');
        $routes->get('failed/(:num)', 'Admin_NewController::failed_censor/$1');

    });

    $routes->get('mypost', 'Admin_NewController::loadMyPostPage');
    $routes->get('newpost', 'Admin_NewController::loadCreatePostPage');
    $routes->get('post/(:num)', 'Admin_NewController::loadUpdatePostPage/$1');
    $routes->post('post/add', 'Admin_NewController::add_post');
    $routes->post('post/update', 'Admin_NewController::change_post');

    $routes->get('contact', 'Admin_ContactController::index');
    $routes->get('contact/(:num)', 'Admin_ContactController::loadContactDetailPage/$1');
    $routes->get('contact/change/(:num)', 'Admin_ContactController::changeStatusContact/$1');
    $routes->post('contact/delete', 'Admin_ContactController::deleteContact');
    

    
    
});
/*
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}