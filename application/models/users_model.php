<?php

class Users_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function add_credits($user_id, $credits) {
        $row_user = $this->get_user($user_id);
        $new_credits = $row_user['credits'] + $credits;
        $data = array(
            'id' => $row_user['id'],
            'auth' => $row_user['auth'],
            'name' => $row_user['name'],
            'credits' => $new_credits,
        );
        $this->edit_user($data);
    }

    function get_users($search = 0,$order_by = 0) {
        $DB_Main = $this->load->database('default', TRUE);
        
        if ($search !== 0) {
            if (strpos($search, "STEAM_" !== false)) {
                $DB_Main->where('auth', steamid_to_auth($search));
            } else {
                $DB_Main->like('name', $search);
            }
        }
        
        if($order_by !== 0){
            $DB_Main->order_by($order_by);
        }
        
        $query_users = $DB_Main->get('users');
        if ($query_users->num_rows() > 0) {
            $array_users = $query_users->result_array();

            $i = 0;
            foreach ($array_users as $user) {
                $DB_Main->where('user_id', $user['id']);
                $query_users_items = $DB_Main->get('users_items');
                $array_users[$i]['num_items'] = $query_users_items->num_rows();
                $i++;
            }

            return $array_users;
        }else
            return array();
    }

    function get_user($user_id) {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('id', $user_id);
        $query_users = $DB_Main->get('users');
        $result = $query_users->row_array();
        $result['steam_id'] = $this->auth_to_steamid($result['auth']);
        $result['community_url'] = $this->steamid_to_community($result["steam_id"]);
        return $result;
    }

    function get_user_items($user_id) {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->select('items.*, users_items.*, categories.display_name AS category_displayname');
        $DB_Main->from('users_items');
        $DB_Main->join('items', 'items.id = users_items.item_id');
        $DB_Main->join('categories', 'categories.id = items.category_id');
        $DB_Main->where('user_id', $user_id);

        return $DB_Main->get()->result_array();
    }

    function get_storeuserid($store_auth) {
        $DB_Main = $this->load->database('default', TRUE);

        $DB_Main->where('auth', $store_auth);
        $query = $DB_Main->get('users');

        if ($query->num_rows == 1) {
            $row = $query->row();
            return $row->id;
        } else {
            echo "User does not exist in store DB";
            log_message('error', 'User does not exist in the Store DB');
            return NULL;
        }
    }

    function edit_user($post) {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('id', $post['id']);
        $data = array(
            'auth' => $post['auth'],
            'name' => $post['name'],
            'credits' => $post['credits']
        );
        $DB_Main->update('users', $data);
    }

    function remove_useritem($post) {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('id', $post['useritem_id']);
        $DB_Main->delete('users_items');
    }

    function remove_user($post) {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('id', $post['user_id']);
        $DB_Main->delete('users');
        $DB_Main->where('user_id', $post['user_id']);
        $DB_Main->delete('users_items');
    }

    function steamid_to_auth($steamid) {
        //from https://forums.alliedmods.net/showpost.php?p=1890083&postcount=234
        $toks = explode(":", $steamid);
        $odd = (int) $toks[1];
        $halfAID = (int) $toks[2];

        return ($halfAID * 2) + $odd;
    }

    function steamid_to_community($steamid) {
        $parts = explode(':', str_replace('STEAM_', '' ,$steamid)); 
        
        $result = bcadd(bcadd('76561197960265728', $parts['1']), bcmul($parts['2'], '2')); 
        $remove = strpos($result,".");
        if($remove != false){
            $result = substr($result,0,strpos($result,"."));
        }
        return $result;
    }

    function auth_to_steamid($authid) {
        $steam = array();
        $steam[0] = "STEAM_0";

        if ($authid % 2 == 0) {
            $steam[1] = 0;
        } else {
            $steam[1] = 1;
            $authid -= 1;
        }
        $steam[2] = $authid / 2;
        return $steam[0] . ":" . $steam[1] . ":" . $steam[2];
    }

}

?>
