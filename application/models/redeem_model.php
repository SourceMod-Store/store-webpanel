<?php

class Redeem_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function add_code($code, $itemids=NULL, $credits=NULL, $redeem_times_user=0, $redeem_times_total=0, $expire_time=NULL, $sm_groupid=NULL)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $data=array(
            'code'=>$code,
            'itemids'=>$itemids,
            'credits'=>$credits,
            'redeem_times_total'=>$redeem_times_total,
            'redeem_times_user'=>$redeem_times_user,
            'expire_time'=>$expire_time,
            'sm_groupid'=>$sm_groupid
        );
        $DB_Main->insert('store_redeem_codes',$data);
    }
    
    function get_codes()
    {
        $DB_Main = $this->load->database('default', TRUE);
        return $DB_Main->get('store_redeem_codes');
    }
    
    function get_logs()
    {
        
        
    }
}

?>