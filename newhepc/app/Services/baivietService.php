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
    }

    public function getPager()
    {
        return $this->baivietModel->pager;
    }

    //    ****
//     **Function for homePage
//     ***
    public function getNewsForHomePage()
    {
        return $this->baivietModel->where(['id_CMPB' => '131', 'status!=' => '0', 'censor!=' => '0'])->orderBy('id_bv', 'desc')->findAll(8, 0);
    }

    public function getAnouncementsForHomePage()
    {
        return $this->baivietModel->where(['id_CMPB' => '96', 'status!=' => '0', 'censor!=' => '0'])->orderBy('id_bv', 'desc')->findAll(8, 0);
    }
    public function getAdmissionsForHomePage()
    {
        return $this->baivietModel->where(['id_CMPB' => '133', 'status!=' => '0', 'censor!=' => '0'])->orderBy('id_bv', 'desc')->findAll(4, 0);
    }

    public function getRecruitmentForHomePage()
    {
        return $this->baivietModel->where(['id_CMPB' => '137', 'status!=' => '0', 'censor!=' => '0'])->orderBy('id_bv', 'desc')->findAll(8, 0);
    }
    // *************
// ***Function for introduce Page
// *****
    public function getIntroduceDetail($link)
    {
        return $this->baivietModel->where(['id_CMPB' => '92', 'link_description' => $link, 'status!=' => '0', 'censor!=' => '0'])->first();
    }
    public function getAllIntroduce()
    {
        return $this->baivietModel->where(['id_CMPB' => '92', 'status!=' => '0', 'censor!=' => '0'])->findAll();
    }
    // *************
// ***Function for News Page
// *****
    public function getNewsForNewPaperPage()
    {
        return $this->baivietModel->where(['id_CMPB' => '131', 'status!=' => '0', 'censor!=' => '0'])->orderBy('id_bv', 'desc')->paginate(9);
    }

    public function getAnouncementForRightMenu()
    {
        return $this->baivietModel->where(['id_CMPB' => '96', 'status!=' => '0', 'censor!=' => '0'])->orderBy('id_bv', 'desc')->findAll(5, 0);
    }
    public function getNewPaperDetail($link)
    {
        return $this->baivietModel->where(['id_CMPB' => '131', 'link_description' => $link, 'status!=' => '0', 'censor!=' => '0'])->first();
    }
    public function getMoreNewPaper($link)
    {
        return $this->baivietModel->where(['id_CMPB' => '131', 'link_description!=' => $link, 'status!=' => '0', 'censor!=' => '0'])->orderBy('id_bv', 'desc')->findAll(5, 0);
    }
    // *************
// ***Function for Anouncements Page
// *****
    public function getAnouncementForAnouncementPage()
    {
        return $this->baivietModel->where(['id_CMPB' => '96', 'status!=' => '0', 'censor!=' => '0'])->orderBy('id_bv', 'desc')->paginate(9);
    }
    public function getAnouncementDetail($link)
    {
        return $this->baivietModel->where(['id_CMPB' => '96', 'link_description' => $link, 'status!=' => '0', 'censor!=' => '0'])->first();
    }
    public function getMoreAnouncement($link)
    {
        return $this->baivietModel->where(['id_CMPB' => '96', 'link_description!=' => $link, 'status!=' => '0', 'censor!=' => '0'])->orderBy('id_bv', 'desc')->findAll(5, 0);
    }
    // *************
    // ***Function for Time Tables Page
    // *****
    public function getTimeTableForTBPage()
    {
        return $this->baivietModel->where(['id_CMPB' => '132', 'status!=' => '0', 'censor!=' => '0'])->orderBy('id_bv', 'desc')->paginate(9);
    }
    public function getTimeTableDetail($link)
    {
        return $this->baivietModel->where(['id_CMPB' => '132', 'link_description' => $link, 'status!=' => '0', 'censor!=' => '0'])->first();
    }
    public function getMoreTimeTable($link)
    {
        return $this->baivietModel->where(['id_CMPB' => '132', 'link_description!=' => $link, 'status!=' => '0', 'censor!=' => '0'])->orderBy('id_bv', 'desc')->findAll(5, 0);
    }
    // *************
    // ***Function for Schedule Page
    // *****
    public function getScheduleForSchedulePage()
    {
        return $this->baivietModel->where(['id_CMPB' => '134', 'status!=' => '0', 'censor!=' => '0'])->orderBy('id_bv', 'desc')->paginate(9);
    }
    public function getScheduleDetail($link)
    {
        return $this->baivietModel->where(['id_CMPB' => '134', 'link_description' => $link, 'status!=' => '0', 'censor!=' => '0'])->first();
    }
    public function getMoreSchedule($link)
    {
        return $this->baivietModel->where(['id_CMPB' => '134', 'link_description!=' => $link, 'status!=' => '0', 'censor!=' => '0'])->orderBy('id_bv', 'desc')->findAll(5, 0);
    }
    // *************
    // ***Function for Form Page
    // *****
    public function getFormForFormPage()
    {
        return $this->baivietModel->where(['id_CMPB' => '138', 'status!=' => '0', 'censor!=' => '0'])->orderBy('id_bv', 'desc')->paginate(9);
    }
    public function getFormDetail($link)
    {
        return $this->baivietModel->where(['id_CMPB' => '138', 'link_description' => $link, 'status!=' => '0', 'censor!=' => '0'])->first();
    }
    public function getMoreForm($link)
    {
        return $this->baivietModel->where(['id_CMPB' => '138', 'link_description!=' => $link, 'status!=' => '0', 'censor!=' => '0'])->orderBy('id_bv', 'desc')->findAll(5, 0);
    }
    // *************
    // ***Function for Commitment Page
    // *****
    public function getCommitmentForCommitmentPage()
    {
        return $this->baivietModel->where(['id_CMPB' => '136', 'status!=' => '0', 'censor!=' => '0'])->orderBy('id_bv', 'desc')->paginate(9);
    }
    public function getCommitmentDetail($link)
    {
        return $this->baivietModel->where(['id_CMPB' => '136', 'link_description' => $link, 'status!=' => '0', 'censor!=' => '0'])->first();
    }
    public function getMoreCommitment($link)
    {
        return $this->baivietModel->where(['id_CMPB' => '136', 'link_description!=' => $link, 'status!=' => '0', 'censor!=' => '0'])->orderBy('id_bv', 'desc')->findAll(5, 0);
    }


}