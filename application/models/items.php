<?php
class Store extends CI_Model{
    
    //This is a Copy and Paste from the SourceDoantes Project
    //It is not finished atm
    
    
    function __construct() {
        parent::__construct();
    }
    
    function get_storeuserid($store_auth){
        $config_server['hostname'] = $this->config->item('database_server_host');
        $config_server['username'] = $this->config->item('database_server_user');
        $config_server['password'] = $this->config->item('database_server_password');
        $config_server['database'] = $this->config->item('database_server_db');
        $config_server['dbdriver'] = "mysql";
        $config_server['dbprefix'] = $this->config->item('database_server_prefix');
        $config_server['pconnect'] = FALSE;
        $config_server['db_debug'] = TRUE;
        $config_server['cache_on'] = FALSE;
        $config_server['cachedir'] = "";
        $config_server['char_set'] = "utf8";
        $config_server['dbcollat'] = "utf8_general_ci";

        $DB_Server = $this->load->database($config_server,TRUE);
        
        $DB_Server->where('auth',$store_auth);
        $query = $DB_Server->get('store_users');
        
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
        //Load the DB
        $config_server['hostname'] = $this->config->item('database_server_host');
        $config_server['username'] = $this->config->item('database_server_user');
        $config_server['password'] = $this->config->item('database_server_password');
        $config_server['database'] = $this->config->item('database_server_db');
        $config_server['dbdriver'] = "mysql";
        $config_server['dbprefix'] = $this->config->item('database_server_prefix');
        $config_server['pconnect'] = FALSE;
        $config_server['db_debug'] = TRUE;
        $config_server['cache_on'] = FALSE;
        $config_server['cachedir'] = "";
        $config_server['char_set'] = "utf8";
        $config_server['dbcollat'] = "utf8_general_ci";
        
        $DB_Server = $this->load->database($config_server,TRUE);
        
        //Check for Duplicates
        $DB_Server->where('user_id',$store_userid);
        $DB_Server->where('item_id',$item_id);
        $query = $DB_Server->get('store_users_items');
        
        if($query->num_rows() == 0){
            $data = array(
                'user_id' => $store_userid,
                'item_id' => $item_id
            );
            $DB_Server->insert('store_users_items',$data);
        }else{
            log_message('error', 'store-add_useritem, User/Item Combo already exists');
        }
    }
    
    function remove_useritem($store_userid,$item_id){
        //Load the DB
        $config_server['hostname'] = $this->config->item('database_server_host');
        $config_server['username'] = $this->config->item('database_server_user');
        $config_server['password'] = $this->config->item('database_server_password');
        $config_server['database'] = $this->config->item('database_server_db');
        $config_server['dbdriver'] = "mysql";
        $config_server['dbprefix'] = $this->config->item('database_server_prefix');
        $config_server['pconnect'] = FALSE;
        $config_server['db_debug'] = TRUE;
        $config_server['cache_on'] = FALSE;
        $config_server['cachedir'] = "";
        $config_server['char_set'] = "utf8";
        $config_server['dbcollat'] = "utf8_general_ci";
        
        $DB_Server = $this->load->database($config_server,TRUE);
        
        //Check for Duplicates
        $DB_Server->where('user_id',$store_userid);
        $DB_Server->where('item_id',$item_id);
        $query = $DB_Server->get('store_users_items');
        
        if($query->num_rows() == 1){
            $DB_Server->where('user_id',$store_userid);
            $DB_Server->where('item_id',$item_id);
            $DB_Server->delete('store_users_items');
        }else{
            log_message('error', 'store-remove_useritem, User/Item Combo does not exists');
        }
    }
}
?>