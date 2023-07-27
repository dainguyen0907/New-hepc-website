<?php

namespace Config;

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
$routes->set404Override();
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
$routes->get('/tuyen-sinh/(:any)', 'AdmissionController::getAdmissiontDetail/$1');
$routes->get('/tuyen-dung', 'RecruitmentController::index');
$routes->get('/tuyen-dung/(:any)', 'RecruitmentController::getRecruitmentDetail/$1');
$routes->get('/cong-doan', 'UnionController::index');
$routes->get('/cong-doan/(:any)', 'UnionController::getNewsOfCatalogueUnion/$1');
$routes->get('/hoat-dong-doan', 'GroupController::index');
$routes->get('/hoat-dong-doan/(:any)', 'GroupController::getNewsOfCatalogueGroup/$1');
//Login
$routes->get('/dang-nhap', 'LoginController::index');
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
$routes->get('/phong-quan-tri/(:any)', 'QTController::getNewsOfCataloguepQT/$1');
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