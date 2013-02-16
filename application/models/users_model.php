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
		$DB_Main->select('items.*, users_items.*, categories.display_name AS category_displayname');
		$DB_Main->from('users_items');
		$DB_Main->join('items', 'items.id = users_items.item_id');
		$DB_Main->join('categories', 'categories.id = items.category_id');
		$DB_Main->where('user_id',$user_id);
        
        return $DB_Main->get()->result_array();
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
