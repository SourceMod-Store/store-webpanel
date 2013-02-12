<?php
class Users_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_users($search){
        $DB_Main = $this->load->database('default', TRUE);
        
        if(isset($search)){
            $DB_Main->like('name', $search);
        }
        
        $query_users = $DB_Main->get('users');
        if($query_users->num_rows() > 0){
            $array_users = $query_users->result_array();
            
            $i = 0;
            foreach($array_users as $user){
                $DB_Main->where('user_id',$user['id']);
                $query_users_items = $DB_Main->get('users_items');
                $array_users[$i]['num_items'] = $query_users_items->num_rows();
                $i++;
            }
            
            return $array_users;
        }else
            return array();
    }
    
    function get_user($user_id){
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('id',$user_id);
        $query_users = $DB_Main->get('users');
        return $query_users->row_array();
    }
    
    function get_user_items($user_id){
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('user_id',$user_id);
        $query_users_items = $DB_Main->get('users_items');
        $array_users_items = $query_users_items->result_array();
        
        $i=0;
        foreach($array_users_items as $user_item){
            $DB_Main->where('id',$user_item['item_id']);
            $query_item = $DB_Main->get('items');
            $row_item = $query_item->row_array();
            $array_users_items[$i]['display_name'] = $row_item['display_name'];
            
            $DB_Main->where('require_plugin',$row_item['type']);
            $query_category = $DB_Main->get('categories');
            $row_category = $query_category->row_array();
            $array_users_items[$i]['category_displayname'] = $row_category['display_name'];
            $i++;
        }
        
        return $array_users_items;
    }
    
    
    function edit_user($post){
        $DB_Main = $this->load->database('default',TRUE);
        $DB_Main->where('id',$post['id']);
        $data = array(
            'auth' => $post['auth'],
            'name' => $post['name'],
            'credits' => $post['credits']
        );
        $DB_Main->update('users', $data);
    }
    
    
    function remove_useritem($post){
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('id',$post['useritem_id']);
        $DB_Main->delete('users_items');
    }
}
?>
