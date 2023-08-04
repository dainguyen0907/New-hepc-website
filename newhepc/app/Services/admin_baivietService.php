<?php
namespace App\Services;

use App\Common\ResultUtils;
use App\Models\baivietModel;


class admin_baivietService extends BaseService
{
    private $baivietModel;
    public function __construct()
    {
        parent::__construct();
        $this->baivietModel = new baivietModel();
        $this->baivietModel->protect(false);
    }

    public function getAllNews()
    {
        return $this->baivietModel->join('user','baiviet.id_user=user.id_user')->join('cmphongban','baiviet.id_cmpb=cmphongban.id_cmpb')->findAll();
    }
    public function getNewsById_pb($id_pb)
    {
        return $this->baivietModel->join('user','baiviet.id_user=user.id_user')->join('cmphongban','baiviet.id_cmpb=cmphongban.id_cmpb')
        ->where('cmphongban.id_pb',$id_pb)->findAll();
    }

    public function loadHTMLTableById_pb($id_pb)
    {
        $array=[];
        if($id_pb==-1)
        {
            $array=$this->getAllNews();
        }
        else{
            $array=$this->getNewsById_pb($id_pb);
        }
        $stringHTML='<thead><tr><th scope="col">ID</th><th scope="col">Tiêu đề</th><th scope="col">Người viết</th>
        <th scope="col">Chuyên mục</th><th scope="col">Ngày viết</th><th scope="col">Lượt xem</th>
        <th scope="col">Trạng thái</th><th scope="col">Kiểm duyệt</th><th scope="col">Chức năng</th></tr></thead>';
        foreach($array as $n){
            $stringHTML=$stringHTML.'<tr><td>'.$n['id_bv'].
            '</td><td>'.$n['heading'].'</td><td>'.$n['user'].
            '</td><td>'.$n['cmphongban'].'</td><td>'.$n['d_poss'].
            '</td><td>'.$n['view'].'</td>';
            if($n['status_bv']==1)
            {
                $stringHTML.='<td class="text-success">Hoạt động</td>';
            }
            else
            {
                $stringHTML.='<td class="text-danger">Vô hiệu hóa</td>';
            }
            if($n['censor_bv']==1)
            {
                $stringHTML.='<td class="text-success">Đã duyệt</td>';
            }
            else
            {
                $stringHTML.='<td class="text-danger">Chưa duyệt</td>';
            }
            $stringHTML.='<td class="text-center"><a href="" class="btn btn-primary mb-3" title="Cập nhật thông tin"><i class="fas fa-edit"></i></a>
            <a class="btn btn-danger btn-del-confirm mb-3" title="Xóa bài viết"><i class="far fa-trash-alt"></i></a></td></tr>';
        }
        return $stringHTML;
    }

}