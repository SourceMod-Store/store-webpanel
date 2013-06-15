<?php

class Redeem_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function add_code($code, $itemids = NULL, $credits = NULL, $redeem_times_user = 0, $redeem_times_total = 0, $expire_time = NULL, $sm_groupid = NULL)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $data = array(
            'code' => $code,
            'itemids' => $itemids,
            'credits' => $credits,
            'redeem_times_total' => $redeem_times_total,
            'redeem_times_user' => $redeem_times_user,
            'expire_time' => $expire_time,
            'sm_groupid' => $sm_groupid
        );
        $DB_Main->insert('store_redeem_codes', $data);
    }

    function get_code($code)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('code', $code);
        $query = $DB_Main->get('store_redeem_codes');
        if ($query->num_rows() > 0)
        {
            return $query->row_array();
        }
        else
        {
            return 0;
        }
    }

    function get_codes()
    {
        $DB_Main = $this->load->database('default', TRUE);
        return $DB_Main->get('store_redeem_codes');
    }

    function get_log()
    {
        $DB_Main = $this->load->database('default', TRUE);
        return $DB_Main->get('store_redeem_log');
    }

    function add_log($code, $auth, $time = 0)
    {
        $DB_Main = $this->load->database('default', TRUE);
        if ($time = 0)
        {
            $time = time();
        }
        $data = array(
            "code"=>$code,
            "auth"=>$auth,
            "time"=>$time
        );
        $DB_Main->insert('store_redeem_log', $data);
    }

    function get_redeemed_times_total($code)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('code', $code);
        $query = $DB_Main->get('store_redeem_log');
        return $query->num_rows();
    }

    function get_redeemed_times_user($code, $auth)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('code', $code);
        $DB_Main->where('auth', $auth);
        $query = $DB_Main->get('store_redeem_log');
        return $query->num_rows();
    }

}

?>