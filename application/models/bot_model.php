<?php

class Bot_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_itemvalues()
    {
        $DB_Main = $this->load->database('default', TRUE);
        $query_itemvalues = $DB_Main->get('bot_itemvalues');
        if ($query_itemvalues->num_rows() > 0)
        {
            $array_itemvalues = $query_itemvalues->result_array();

            return $array_itemvalues;
        }
        else
        {
            return array();
        }
    }
    
    public function get_itemvalue($itemId)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $query_itemvalue = $DB_Main->get('bot_itemvalues')->where('itemId',$itemId);
        $row = $query_itemvalue->row();
        return $row->value;
    }

    public function get_donationstatus($donationId)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $query = $DB_Main->get('bot_donations')->where('id', $donationId);
        $row = $query->row();
        return $row->status;
    }

    public function set_donationstatus($donationId, $status)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $data = array('status'=>$status);
        $DB_Main->update('bot_donations',$data)->where('id',$donationId);
    }

}

?>