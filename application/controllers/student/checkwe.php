<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkwe extends CI_Controller {

    public $_sid; 

    public function __construct()
    {
        parent::__construct();
        $this->load->model("wrecord_model");
        $this->load->model("erecord_model");
        $this->config->load('pager_config',TRUE);
        $this->_sid = $this->session->userdata('sid');
    }

    public function index()
    {
        $wtimeunit = $this->input->get('wtimeunit') ? : 'week';
        $etimeunit = $this->input->get('etimeunit') ? : 'week';
        $wdata = $this->wrecord_model->get($wtimeunit, $this->_sid);
        $edata = $this->erecord_model->get($etimeunit, $this->_sid);
        //格式化数据
        $wdata_format = array('date'=>array(),'useage'=>array(),'totalprize'=>array());
        $edata_format = array('date'=>array(),'useage'=>array(),'totalprize'=>array());
        foreach ($wdata as $key => $value) {
            array_push($wdata_format['date'], date('m-d',$value['date']));
            array_push($wdata_format['useage'], (float)$value['useage']);
            array_push($wdata_format['totalprize'], (float)$value['totalprize']);
        }
        foreach ($edata as $key => $value) {
            array_push($edata_format['date'], date('m-d',$value['date']));
            array_push($edata_format['useage'], (float)$value['useage']);
            array_push($edata_format['totalprize'], (float)$value['totalprize']);
        }
        // var_dump($edata_format);exit;

        $wunit_url = array(
                    'lastweek' => array(
                                'class' => '',
                                'url'   => ''
                        ),
                    'lastmonth' => array(
                                'class' => '',
                                'url'   => ''
                        )
            );
        $unit_url = array(
                    'lastweek' => array(
                                'class' => '',
                                'url'   => ''
                        ),
                    'lastmonth' => array(
                                'class' => '',
                                'url'   => ''
                        )
            );

        if($wtimeunit == 'week') {
            $wunit_url['lastweek']['class'] = 'btn-success disabled';
            $wunit_url['lastweek']['url'] = '';
            $wunit_url['lastmonth']['class'] = 'btn-link';
            $wunit_url['lastmonth']['url'] = site_url('student/checkwe/index/').'?wtimeunit=month&etimeunit='.$etimeunit;
        } else {
            $wunit_url['lastweek']['class'] = 'btn-link';
            $wunit_url['lastweek']['url'] = site_url('student/checkwe/index/').'?wtimeunit=week&etimeunit='.$etimeunit;
            $wunit_url['lastmonth']['class'] = 'btn-success disabled';
            $wunit_url['lastmonth']['url'] = '';
        }

        if($etimeunit == 'week') {
            $eunit_url['lastweek']['class'] = 'btn-success disabled';
            $eunit_url['lastweek']['url'] = '';
            $eunit_url['lastmonth']['class'] = 'btn-link';
            $eunit_url['lastmonth']['url'] = site_url('student/checkwe/index/').'?etimeunit=month&wtimeunit='.$wtimeunit;
        } else {
            $eunit_url['lastweek']['class'] = 'btn-link';
            $eunit_url['lastweek']['url'] = site_url('student/checkwe/index/').'?etimeunit=week&wtimeunit='.$wtimeunit;
            $eunit_url['lastmonth']['class'] = 'btn-success disabled';
            $eunit_url['lastmonth']['url'] = '';
        }
    	$this->load->view('student/checkwe', array('wdata' => $wdata_format, 'edata' => $edata_format,'wunit_url'=>$wunit_url,'eunit_url'=>$eunit_url));
    }
}