<?php

class Redeem_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_code($code)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $query_code = $DB_Main->where('code',$code)->get('store_redeem_codes');
        
        if($query_code->num_rows() == 1)
        {
            return $query_code->row_array();
        }
        else
        {
            return NULL;
        }
    }
    
    public function get_codes()
    {
        $DB_Main = $this->load->database('default', TRUE);
        $query_codes = $DB_Main->get('store_redeem_codes');
        return $query_codes->result();
    }
    
    public function get_redeemed_times_total($code)
    {
        $DB_Main = $this->load->database('default',TRUE);
        $DB_Main->where('code',$code);
        $query_times = $DB_Main->get('store_redeem_log');
        
        return $query_times->num_rows();
    }
    
    public function get_redeemed_times_user($code, $auth)
    {
        $DB_Main = $this->load->database('default',TRUE);
        $DB_Main->where('code',$code);
        $DB_Main->where('auth',$auth);
        $query_times = $DB_Main->get('store_redeem_log');
        
        return $query_times->num_rows();
    }
    
    public function add_log($code,$auth,$timestamp=NULL)
    {
        $DB_Main = $this->load->database('default', TRUE);
        
        $data=array("code"=>$code,"auth"=>$auth);
        
        $DB_Main->insert('store_redeem_log',$data);
    }
    
}

?>