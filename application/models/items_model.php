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
        $item_array = $query->result_array();
        
        $i=0;
        foreach( $item_array as $item){
            $DB_Main->where('item_id',$item['id']);
            $query_item = $DB_Main->get('users_items');
            $item_array[$i]['amount'] = $query_item->num_rows();
            
            $i++;
        }
        
        return $item_array;
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
        if(PHP_MAJOR_VERSION == 5 && PHP_MINOR_VERSION >= 4){ // Check if PHP 5.4
            $data=array(
                'name'=>$post['name'],
                'display_name'=>$post['display_name'],
                'description'=>$post['description'],
                'web_description'=>$post['web_description'],
                'type'=>$post['type'],
                'loadout_slot'=>$post['loadout_slot'],
                'price'=>$post['price'],
                'attrs'=>json_encode(json_decode($post['attrs']), JSON_UNESCAPED_SLASHES),
                'is_buyable'=>$post['is_buyable'],
                'is_tradeable'=>$post['is_tradeable'],
                'is_refundable'=>$post['is_refundable'],
                'category_id'=>$post['category_id'],
                'expiry_time'=>$post['expiry_time']
            );
        }else{
            $data=array(
                'name'=>$post['name'],
                'display_name'=>$post['display_name'],
                'description'=>$post['description'],
                'web_description'=>$post['web_description'],
                'type'=>$post['type'],
                'loadout_slot'=>$post['loadout_slot'],
                'price'=>$post['price'],
                'attrs'=>json_encode(json_decode($post['attrs'])),
                'is_buyable'=>$post['is_buyable'],
                'is_tradeable'=>$post['is_tradeable'],
                'is_refundable'=>$post['is_refundable'],
                'category_id'=>$post['category_id'],
                'expiry_time'=>$post['expiry_time']
            );
        }

        $DB_Main->update('items',$data);
    }
    
    function add_item($name, $display_name, $description, $web_description, $type, $loadout_slot, $price, $attrs, $is_buyable, $is_tradeable, $is_refundable, $category_id, $expiry_time){
        $DB_Main = $this->load->database('default', TRUE);
        $data=array(
            'name'=>$name,
            'display_name'=>$display_name,
            'description'=>$description,
            'web_description'=>$web_description,
            'type'=>$type,
            'loadout_slot'=>$loadout_slot,
            'price'=>$price,
            'attrs'=>$attrs,
            'is_buyable'=>$is_buyable,
            'is_tradeable'=>$is_tradeable,
            'is_refundable'=>$is_refundable,
            'category_id'=>$category_id,
            'expiry_time'=>$expiry_time
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
                'item_id' => $item_id,
				'aquire_method' => 'web'
            );
			$DB_Main->set('aquire_date', 'NOW()', FALSE);
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
        
        if($query->num_rows() >= 1){
			$DB_Main->where('useritem_id', $query->id);
			$DB_Main->delete('users_items_loadouts');
			
            $DB_Main->where('user_id',$store_userid);
            $DB_Main->where('item_id',$item_id);
            $DB_Main->delete('users_items');
        }else{
            log_message('error', 'store-remove_useritem, User/Item Combo does not exists');
        }
    }
	
	function delete_items_by_type($type)
	{
		$DB_Main = $this->load->database('default',TRUE);
        $DB_Main->where('type',$type);
        $DB_Main->delete('items');		
	}
}
?>