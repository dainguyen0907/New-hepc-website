<?php

namespace App\Services;

use App\Services\BaseService;
use App\Models\baivietModel;

class baivietService extends BaseService
{

    private $baivietModel;
    public function __construct()
    {
        parent::__construct();
        $this->baivietModel = new baivietModel();
        $this->baivietModel->protect(false);
    }

    public function getPager()
    {
        return $this->baivietModel->pager;
    }
    //    ****
//     **Public function
//     ***


    //Chức năng: Lấy bài viết hợp lệ theo id phòng ban và link bài viết
//Vị trí: Các trang chuyên mục bài viết
    public function getNewDetailByID_PB($id_pb, $link_description)
    {
        $detail = $this->baivietModel->join('cmphongban', 'baiviet.id_cmpb=cmphongban.id_cmpb')->where(['id_pb' => $id_pb, 'link_description' => $link_description, 'baiviet.status_bv!=' => '0', 'cmphongban.status_cmpb!=' => '0', 'censor_bv!=' => '0'])->first();
        if ($detail != null) {
            $this->baivietModel->update($detail['id_bv'], ['view' => $detail['view'] + 1]);
        }
        return $detail;
    }
    //CHức năng: Lấy Bài viết hợp lệ theo chuyên mục - có phân trang -9
//Vị trí: Trang tìm kiếm
    public function getNewForPage($id_cmpb)
    {

        return $this->baivietModel->where(['id_cmpb' => $id_cmpb, 'status_bv!=' => '0', 'censor_bv!=' => '0'])->orderBy('id_bv', 'desc')->paginate(9);
    }
    //CHức năng: Lấy Bài viết hợp lệ bằng link bài viết 
//Vị trí: Trang tìm kiếm
    public function getNewDetailByLink($link)
    {
        $detail = $this->baivietModel->where(['link_description' => $link, 'status_bv!=' => '0', 'censor_bv!=' => '0'])->first();
        if ($detail != null) {
            $this->baivietModel->update($detail['id_bv'], ['view' => $detail['view'] + 1]);
        }
        return $this->baivietModel->where(['link_description' => $link, 'status_bv!=' => '0', 'censor_bv!=' => '0'])->first();
    }
    //CHức năng: Lấy thêm Bài viết hợp lệ ngoại trừ bai viết có link hiện tại 
//Vị trí: Trang tìm kiếm
    public function getMoreNewByLink($link)
    {
        return $this->baivietModel->where(['link_description!=' => $link, 'status_bv!=' => '0', 'censor_bv!=' => '0'])->orderBy('id_bv', 'desc')->findAll(5, 0);
    }
    //CHức năng: Lấy chi tiết bài viết hợp lệ theo chuyên mục và link bài viết
//Vị trí: Các trang chuyên mục bài viết
    public function getNewDetail($id_cmpb, $link)
    {
        $detail = $this->baivietModel->where(['id_cmpb' => $id_cmpb, 'link_description' => $link, 'status_bv!=' => '0', 'censor_bv!=' => '0'])->first();
        if ($detail != null) {
            $view = $detail['view'] + 1;
            $this->baivietModel->update($detail['id_bv'], ['view' => $view,]);
        }
        return $this->baivietModel->where(['id_cmpb' => $id_cmpb, 'link_description' => $link, 'status_bv!=' => '0', 'censor_bv!=' => '0'])->first();
    }
//CHức năng: Lấy thêm Bài viết hợp lệ trong cùng chuyên mục ngoại trừ bai viết có link hiện tại
//Vị trí: Các trang chuyên mục bài viết
    public function getMoreNew($id_cmpb, $link)
    {
        return $this->baivietModel->where(['id_cmpb' => $id_cmpb, 'link_description!=' => $link, 'status_bv!=' => '0', 'censor_bv!=' => '0'])->orderBy('id_bv', 'desc')->findAll(5, 0);
    }
//CHức năng: Lấy các bài viết hợp lệ theo chuyên mục - có phân trang -8
//Vị trí: Các trang chuyên mục bài viết của phòng ban và khoa, trang chủ
    public function getNewsforOfficePage($id_cmpb)
    {
        return $this->baivietModel->where(['id_cmpb' => $id_cmpb, 'status_bv!=' => '0', 'censor_bv!=' => '0'])->orderBy('id_bv', 'desc')->findAll(8, 0);
    }
//CHức năng: Lấy các các bài viết TUYỂN SINH mới nhất cho trang chủ
//Vị trí: Trang chủ
    public function getAdmissionsForHomePage()
    {
        return $this->baivietModel->where(['id_cmpb' => '133', 'status_bv!=' => '0', 'censor_bv!=' => '0'])->orderBy('id_bv', 'desc')->findAll(4, 0);
    }
    // *************
// ***Function for introduce Page
// *****
    public function getAllIntroduce()
    {
        return $this->baivietModel->where(['id_cmpb' => '92', 'status_bv!=' => '0', 'censor_bv!=' => '0'])->findAll();
    }
//CHức năng: Lấy các các thông báo mới nhất cho right menu
//Vị trí: Right menu
    public function getAnouncementForRightMenu()
    {
        return $this->baivietModel->where(['id_cmpb' => '96', 'status_bv!=' => '0', 'censor_bv!=' => '0'])->orderBy('id_bv', 'desc')->findAll(5, 0);
    }
//CHức năng: Tìm kiếm bằng từ khóa
//Vị trí: Trang tìm kiêm
    public function searchNewByKeyWord($key_word)
    {
        return $this->baivietModel->like(['censor_bv' => '1', 'status_bv' => '1', 'content' => $key_word])->orderBy('id_bv', 'desc')->paginate(9);
    }




}