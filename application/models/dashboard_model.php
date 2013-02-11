<?php
class Dashboard_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_richest_users($num){
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->order_by('credits','desc');
        if($num != 0){
            $DB_Main->limit($num);
        }
        $query = $DB_Main->get('users');
        if($query->num_rows() != 0){
            return $query->result_array();
        }else{
            return FALSE;
        }
    }
    
    function get_top_items($num){
        $DB_Main = $this->load->database('default', TRUE);
        $query_users_items = $DB_Main->get('users_items');
        
        $amount = array();
        $i = 0;
        
        foreach($query_users_items->result() as $user_item){
            if(!isset($amount[$user_item->item_id])){
                $amount[$user_item->item_id] = 1;
            }else{
                $amount[$user_item->item_id] += 1;
            }
        }
        
        arsort($amount);
        $i = 0;
        $result = array();
        
        foreach($amount as $key => $value){
            if($i <= $num){
                $DB_Main->where('id', $key);
                $query_items = $DB_Main->get('items');
                
                foreach($query_items->result() as $item){
                    $result[$i]['key'] = $key;
                    $result[$i]['item_id'] = $item->id;
                    $result[$i]['name'] = $item->name;
                    $result[$i]['display_name'] = $item->display_name;
                    $result[$i]['num'] = $value;
                }
            }      
            $i++;
        }
        
        return $result;
    }
    
}
?>
