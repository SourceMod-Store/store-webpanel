<?php
class Items_Model extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    function get_search_categories(){
        $DB_Main = $this->load->database('default', TRUE);
        $query = $DB_Main->get('categories');
        return $query->result_array();
    }
    
    function get_items($search, $category){
        $DB_Main = $this->load->database('default', TRUE);
        
        if(isset($category)){
            $DB_Main->where('type',$category);
        }
        
        if(isset($search)){
            $DB_Main->like('display_name', $search);
        }
        
        $query = $DB_Main->get('items');
        
        return $query->result_array();
    }
    
    function get_item_info($id){
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('id',$id);
        $query = $DB_Main->get('items');
        return $query->row_array();
    }
    
    function update_item($post){
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('id',$post['id']);
        $data=array(
            'name'=>$post['name'],
            'display_name'=>$post['display_name'],
            'description'=>$post['description'],
            'web_description'=>$post['web_description'],
            'type'=>$post['type'],
            'loadout_slot'=>$post['loadout_slot'],
            'price'=>$post['price'],
            'attrs'=>$post['attrs'],
            'is_buyable'=>$post['is_buyable'],
            'is_tradeable'=>$post['is_tradeable'],
        );
        $DB_Main->update('items',$data);
    }
    
    function add_item($post){
        $DB_Main = $this->load->database('default', TRUE);
        $data=array(
            'name'=>$post['name'],
            'display_name'=>$post['display_name'],
            'description'=>$post['description'],
            'web_description'=>$post['web_description'],
            'type'=>$post['type'],
            'loadout_slot'=>$post['loadout_slot'],
            'price'=>$post['price'],
            'attrs'=>$post['attrs'],
            'is_buyable'=>$post['is_buyable'],
            'is_tradeable'=>$post['is_tradeable'],
        );
        $DB_Main->insert('items',$data);
    }
    
    
    function get_storeuserid($store_auth){
        $DB_Main = $this->load->database('default',TRUE);
        
        $DB_Main->where('auth',$store_auth);
        $query = $DB_Main->get('users');
        
        if($query->num_rows == 1){
            $row = $query->row();
            return $row->id;
        }else{
            echo "User does not exist in store DB";
            log_message('error','User does not exist in the Store DB');
            return NULL;
        }
    }
    
    function add_useritem($store_userid,$item_id){
        $DB_Main = $this->load->database('default',TRUE);
        
        //Check for Duplicates
        $DB_Main->where('user_id',$store_userid);
        $DB_Main->where('item_id',$item_id);
        $query = $DB_Main->get('users_items');
        
        if($query->num_rows() == 0){
            $data = array(
                'user_id' => $store_userid,
                'item_id' => $item_id
            );
            $DB_Main->insert('users_items',$data);
        }else{
            log_message('error', 'store-add_useritem, User/Item Combo already exists');
        }
    }
    
    function remove_useritem($store_userid,$item_id){
        $DB_Main = $this->load->database('default',TRUE);
        
        //Check for Duplicates
        $DB_Main->where('user_id',$store_userid);
        $DB_Main->where('item_id',$item_id);
        $query = $DB_Main->get('users_items');
        
        if($query->num_rows() == 1){
            $DB_Main->where('user_id',$store_userid);
            $DB_Main->where('item_id',$item_id);
            $DB_Main->delete('users_items');
        }else{
            log_message('error', 'store-remove_useritem, User/Item Combo does not exists');
        }
    }
}
?>