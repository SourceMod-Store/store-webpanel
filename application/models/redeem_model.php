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
        $query_code = $DB_Main->where('code', $code)->get('store_redeem_codes');

        if ($query_code->num_rows() == 1)
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

    public function get_code_by_id($codeid)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('id', $codeid);
        $code_query = $DB_Main->get('store_redeem_codes');
        return $code_query->row();
    }

    public function get_redeemed_times_total($code)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('code', $code);
        $query_times = $DB_Main->get('store_redeem_log');

        return $query_times->num_rows();
    }

    public function get_redeemed_times_user($code, $auth)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('code', $code);
        $DB_Main->where('auth', $auth);
        $query_times = $DB_Main->get('store_redeem_log');

        return $query_times->num_rows();
    }

    public function get_logs()
    {
        $DB_Main = $this->load->database('default', TRUE);
        $query_logs = $DB_Main->get('store_redeem_log');
        return $query_logs->result();
    }

    public function add_log($code, $auth, $timestamp = NULL)
    {
        $DB_Main = $this->load->database('default', TRUE);

        $data = array("code" => $code, "auth" => $auth);

        $DB_Main->insert('store_redeem_log', $data);
    }

    public function add_code($code, $itemids = NULL, $credits = NULL, $times_total = NULL, $times_user = NULL, $expire_time = NULL)
    {
        $DB_Main = $this->load->database('default', TRUE);

        $data = array("code" => $code);

        if ($itemids != NULL && $itemids != "")
        {
            $data["itemids"] = $itemids;
        }

        if ($credits != NULL && $credits != "")
        {
            $data["credits"] = $credits;
        }

        if ($times_total != NULL && $times_total != "")
        {
            $data["redeem_times_total"] = $times_total;
        }

        if ($times_user != NULL && $times_user != "")
        {
            $data["redeem_times_user"] = $times_user;
        }

        if ($expire_time != NULL && $expire_time != "")
        {
            $data["expire_time"] = $expire_time;
        }

        $DB_Main->insert('store_redeem_codes', $data);
    }

    public function edit_code($id, $code, $itemids = NULL, $credits = NULL, $times_total = NULL, $times_user = NULL, $expire_time = NULL)
    {
        $DB_Main = $this->load->database('default', TRUE);

        $data = array("code" => $code);

        if ($itemids != NULL && $itemids != "")
        {
            $data["itemids"] = $itemids;
        }
        else
        {
            $data["itemids"] = NULL;
        }

        if ($credits != NULL && $credits != "")
        {
            $data["credits"] = $credits;
        }
        else
        {
            $data["credits"] = NULL;
        }

        if ($times_total != NULL && $times_total != "")
        {
            $data["redeem_times_total"] = $times_total;
        }
        else
        {
            $data["redeem_times_total"] = NULL;
        }

        if ($times_user != NULL && $times_user != "")
        {
            $data["redeem_times_user"] = $times_user;
        }
        else
        {
            $data["redeem_times_user"] = NULL;
        }

        if ($expire_time != NULL && $expire_time != "")
        {
            $data["expire_time"] = $expire_time;
        }
        else
        {
            $data["expire_time"] = NULL;
        }
        
        $DB_Main->where('id', $id);
        $DB_Main->update('store_redeem_codes',$data);
    }

    public function remove_code($codeid)
    {
        $DB_Main = $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('id', $codeid);
        $DB_Main->delete('store_redeem_codes');
    }

}

?>