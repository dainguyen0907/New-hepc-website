<?php
namespace App\Services;

use App\Common\ResultUtils;
use App\Models\baivietModel;
use App\Models\cmPhongBanModel;


class admin_baivietService extends BaseService
{
    private $baivietModel;
    private $cmphongbanModel;
    public function __construct()
    {
        parent::__construct();
        $this->baivietModel = new baivietModel();
        $this->cmphongbanModel=new cmPhongBanModel();
        $this->baivietModel->protect(false);
    }
//CHức năng: Lấy tất cả bản tin
//Vị trí: Trang Admin->quản trị->bài viết
    public function getAllNews()
    {
        return $this->baivietModel->join('user','baiviet.id_user=user.id_user')->join('cmphongban','baiviet.id_cmpb=cmphongban.id_cmpb')->findAll();
    }
//CHức năng: Lấy tất cả bản tin của cá nhân
//Vị trí: Trang Admin->quản trị->bài viết
    public function getNewsById_user($id_user)
    {
        return $this->baivietModel->join('user','baiviet.id_user=user.id_user')->join('cmphongban','baiviet.id_cmpb=cmphongban.id_cmpb')->
        where('baiviet.id_user',$id_user)->findAll();
    }
    //CHức năng: Lấy tất cả bản tin của phòng ban
//Vị trí: Trang Admin->quản trị->bài viết
    public function getNewsById_pb($id_pb)
    {
        return $this->baivietModel->join('user','baiviet.id_user=user.id_user')->join('cmphongban','baiviet.id_cmpb=cmphongban.id_cmpb')
        ->where('cmphongban.id_pb',$id_pb)->findAll();
    }
//CHức năng: Lấy thông tin ajax cho bảng Bài viết của phòng ban bằng id_pB
//Vị trí: Trang Admin->quản trị->bài viết
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
            $stringHTML.='<td class="text-center"><a href="./admin/post/'.$n['id_bv'].'" class="btn btn-primary mb-3" title="Cập nhật thông tin"><i class="fas fa-edit"></i></a>
            <a class="btn btn-danger btn-del-confirm mb-3" title="Xóa bài viết" data-bs-toggle="modal" data-bs-target="#deleteModal"  data-txtid="'.$n['id_bv'].'"
            data-id="'.$this->encryptString($n['id_bv']).'"><i class="far fa-trash-alt"></i></a></td></tr>';
        }
        return $stringHTML;
    }
//CHức năng: Lấy thông tin ajax cho bảng kiểm duyệt Bài viết của phòng ban bằng id_pB
//Vị trí: Trang Admin->quản trị->bài viết
    public function loadHTMLCensorTableById_pb($id_pb)
    {
        $array=$this->getCensorPostById_pb($id_pb);
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
            
            $stringHTML.='<td class="text-center"><a href="./admin/post/'.$n['id_bv'].'" class="btn btn-primary mb-3" title="Cập nhật thông tin"><i class="fas fa-edit"></i></a>
            <a class="btn btn-danger btn-del-confirm mb-3" title="Xóa bài viết" data-bs-toggle="modal" data-bs-target="#deleteModal"  data-txtid="'.$n['id_bv'].'"
            data-id="'.$this->encryptString($n['id_bv']).'"><i class="far fa-trash-alt"></i></a></td></tr>';
        }
        return $stringHTML;
    }
//CHức năng: Đếm số lượng bài viết chưa keiemr duyệt
//Vị trí: Trang Admin->quản trị->left menu
    public function getCountCensorPost($id_pb)
    {
        if($id_pb==8)
        {
            return count($this->baivietModel->join('user','baiviet.id_user=user.id_user')->join('cmphongban','baiviet.id_cmpb=cmphongban.id_cmpb')
            ->where('censor_bv','0')->whereIn('cmphongban.id_pb',['8','15','16','17'])->findAll());
        }
        return count($this->baivietModel->join('user','baiviet.id_user=user.id_user')->join('cmphongban','baiviet.id_cmpb=cmphongban.id_cmpb')
            ->where(['censor_bv'=>'0','cmphongban.id_pb'=>$id_pb])->findAll());
    }
//CHức năng: Lấy tất cả bài viết chưa kiểm duyệt của phòng ban
//Vị trí: Trang Admin->quản trị->bài viết/ left-menu
    public function getCensorPostById_pb($id_pb)
    {
        if($id_pb==-1)
        {
            return $this->baivietModel->join('user','baiviet.id_user=user.id_user')->join('cmphongban','baiviet.id_cmpb=cmphongban.id_cmpb')
            ->where('censor_bv','0')->whereIn('cmphongban.id_pb',['8','15','16','17'])->findAll();
        }
        return $this->baivietModel->join('user','baiviet.id_user=user.id_user')->join('cmphongban','baiviet.id_cmpb=cmphongban.id_cmpb')
            ->where(['censor_bv'=>'0','cmphongban.id_pb'=>$id_pb])->findAll();
    }
//CHức năng: Lấy thông tin bài viết bằng id_bv, kiểm tra quyền truy cập bằng id_q
//Vị trí: Trang Admin->quản trị->bài viết
    public function getPostDetail($id_bv,$id_q)
    {
        if($id_q==1)
        {
            return $this->baivietModel->join('user','baiviet.id_user=user.id_user')->join('cmphongban','baiviet.id_cmpb=cmphongban.id_cmpb')
            ->where('id_bv',$id_bv)->first();
        }
        elseif($id_q==2)
        {
            return $this->baivietModel->join('user','baiviet.id_user=user.id_user')->join('cmphongban','baiviet.id_cmpb=cmphongban.id_cmpb')
            ->where(['id_bv'=>$id_bv,'cmphongban.id_pb'=>session('userLogin')['id_pb']])->first();
        }
        return $this->baivietModel->join('user','baiviet.id_user=user.id_user')->join('cmphongban','baiviet.id_cmpb=cmphongban.id_cmpb')
        ->where(['id_bv'=>$id_bv,'id_user'=>session('userLogin')['id_user']])->first();
    }
//CHức năng: Thêm bài viết mới
//Vị trí: Trang Admin->quản trị->bài viết
    public function addPost($req)
    {
        $validateRes=$this->validatePost($req);
        if($validateRes->getErrors())
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validateRes->getErrors()
            ];
        }
        $param=$req->getPost();
        if($this->is_exits_post($param['heading_post']))
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['err'=>'Tiêu đề đã tồn tại. Hãy đặt tiêu đề khác']
            ];
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data=[
            "id_cmpb"=>$param['group_post'],
            "heading"=>$param['heading_post'],
            "link_description"=>$this->convert_name($param['heading_post']),
            "summarize"=>$param['summarize_post'],
            "content"=>$param['content_post'],
            "d_poss"=>date("d/m/Y H:i:s"),
            "view"=>0,
            "id_user"=>session('userLogin')['id_user'],
            "file"=>$param['file_post'],
            'img'=>$param['image_post'],
            'status_bv'=>'0',
            'censor_bv'=>'0'
        ];
        $res=$this->baivietModel->insert($data);
        if($res)
        {
            $this->writeHistory('add','Bài viết',session('userLogin')['id_user'],$res);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success'=>"Tạo bài viết thành công"]
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err'=>"Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau."]
        ];

    }
    //CHức năng: Cập nhật bài viết mới
//Vị trí: Trang Admin->quản trị->bài viết
    public function updatePost($req)
    {
        $validateRes=$this->validatePost($req);
        if($validateRes->getErrors())
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => $validateRes->getErrors()
            ];
        }
        $param=$req->getPost();
        $decryptid=$this->decryptString($param['id_bv']);
        if($this->is_exits_updatepost($decryptid,$param['heading_post']))
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'message' => ['err'=>'Tiêu đề đã tồn tại. Hãy đặt tiêu đề khác']
            ];
        }
        $data=[
            "heading"=>$param['heading_post'],
            "link_description"=>$this->convert_name($param['heading_post']),
            "summarize"=>$param['summarize_post'],
            "content"=>$param['content_post'],
            "view"=>$param['view_post'],
            "file"=>$param['file_post'],
            'img'=>$param['image_post'],
            'status_bv'=>'0',
            'censor_bv'=>'0'
        ];
        if($this->baivietModel->update($decryptid,$data))
        {
            $this->writeHistory('update','Bài viết',session('userLogin')['id_user'],$decryptid);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success'=>"Cập nhật bài viết thành công"]
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err'=>"Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau."]
        ];

    }
//CHức năng: Kiểm tra link bài viết đã tồn tại chưa? sử dụng khi thêm bài viết mới.
//Vị trí:
    private function is_exits_post($heading){
        $link_description=$this->convert_name($heading);
        $post=$this->baivietModel->where('link_description',$link_description)->first();
        $catalogue=$this->cmphongbanModel->where('link',$link_description)->first();
        if($post!=null||$catalogue!=null)
        {
            return true;
        }
        return false;
    }
//CHức năng: Kiểm tra link bài viết đã tồn tại chưa? sử dụng khi cập nhật bài viết
//Vị trí: 
    private function is_exits_updatepost($id_bv,$heading){
        $link_description=$this->convert_name($heading);
        $post=$this->baivietModel->where(['link_description'=>$link_description,"id_bv!="=>$id_bv])->first();
        $catalogue=$this->cmphongbanModel->where('link',$link_description)->first();
        if($post!=null||$catalogue!=null)
        {
            return true;
        }
        return false;
    }
//CHức năng: Kiểm tra thông tin nhập khi tạo/cập nhật bài viết
//Vị trí: Trang Admin->quản trị->bài viết
    private function validatePost($req)
    {
        $rules=["heading_post"=>"required|max_length[200]"];
        $message=[
            "groupname"=>[
                "required"=>"Tiêu đề không được để trống",
                "max_length"=>"Tiêu đề tối đa 200 ký tự"
            ]
        ];
        $this->validation->setRules($rules,$message);
        $this->validation->withRequest($req)->run();
        return $this->validation;
    }
//CHức năng: Kiểm duyệt bài viết
//Vị trí: Trang Admin->quản trị->bài viết
    public function censor_post($id_bv,$censor)
    {
        if($censor=='pass')
        {
            $data=['censor_bv'=>'1','status_bv'=>'1'];
        }else
        {
            $data=['censor_bv'=>'1','status_bv'=>'0'];
        }
        if($this->baivietModel->update($id_bv,$data))
        {
            $this->writeHistory('update','Bài viết',session('userLogin')['id_user'],$id_bv);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success'=>"Kiểm duyệt bài viết thành công"]
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err'=>"Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau."]
        ];
    }
    //CHức năng: Xóa bài viết.
//Vị trí:Trang Admin->quản trị->bài viết 
public function deletePost($req)
    {
        $param=$req->getPost();
        $decryptid=$this->decryptString($param['id']);
        if($this->baivietModel->delete($decryptid))
        {
            $this->writeHistory('delete','Bài viết',session('userLogin')['id_user'],$decryptid);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'message' => ['success'=>"Xóa bài viết thành công"]
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'message' => ['err'=>"Đã xảy ra lỗi hệ thống! Vui lòng thử lại sau."]
        ];
        
    }

}