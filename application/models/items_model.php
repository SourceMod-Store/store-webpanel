<?php

class Items_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_search_categories()
    {
        $DB_Main = $this->load->database('default', TRUE);
        $query = $DB_Main->get('store_categories');
        return $query->result_array();
    }

    function get_items()
    {
        $DB_Main = $this->load->database('default', TRUE);

        $query = $DB_Main->get('store_items');
        $item_array = $query->result_array();

        foreach ($item_array as $key => $item)
        {
            $DB_Main->where('item_id', $item['id']);
            $query_item = $DB_Main->get('store_users_items');
            $item_array[$key]['amount'] = $query_item->num_rows();
        }
        return $item_array;
    }

    function get_item_info($item_id)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('id', $item_id);
        $query = $DB_Main->get('store_items');
        return $query->row_array();
    }

    function get_item_users($item_id)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $this->load->model("users_model");

        $DB_Main->where('item_id', $item_id);
        $query = $DB_Main->get('store_users_items');
        $result = $query->result_array();
        $i = 0;
        foreach ($result as $useritem)
        {
            $user_array = $this->users_model->get_user($useritem["user_id"]);
            $result[$i]['user_name'] = $user_array['name'];
            $i++;
        }
        return $result;
    }

    function get_top_items($num = 5)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $query = $DB_Main->query('SELECT 
                si.display_name,
                sui.item_id, 
                COUNT(sui.item_id) anzahl
            FROM 
                store_users_items sui
            LEFT JOIN
                store_items si ON (sui.item_id = si.id)
            GROUP BY 
                item_id
            ORDER BY 
                anzahl DESC
            LIMIT '.$DB_Main->escape($num));
        $result = $query->result_array();
        return $result;
    }

    function get_item_count_by_type($type)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('type', $type);
        $query = $DB_Main->get('store_items');
        return $query->num_rows();
    }

    function update_item($post)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('id', $post['id']);

        if (PHP_MAJOR_VERSION == 5 && PHP_MINOR_VERSION >= 4)
        { // Check if PHP 5.4
            if ($post['attrs'] != "")
            {
                $attrs = json_encode(json_decode($post['attrs']), JSON_UNESCAPED_SLASHES);
                //echo "attrs :" . $attrs . ": ";
            }
            else
            {
                $attrs = NULL;
            }
        }
        $data = array(
            'priority' => $post['priority'],
            'name' => $post['name'],
            'display_name' => $post['display_name'],
            'description' => $post['description'],
            'web_description' => $post['web_description'],
            'type' => $post['type'],
            'loadout_slot' => $post['loadout_slot'],
            'price' => $post['price'],
            'attrs' => $post['attrs'],
            'is_buyable' => $post['is_buyable'],
            'is_tradeable' => $post['is_tradeable'],
            'is_refundable' => $post['is_refundable'],
            'category_id' => $post['category_id'],
            'expiry_time' => $post['expiry_time'],
            'flags' => $post['flags']
        );

        foreach ($data as $key => $value)
        {
            if ($data[$key] == "")
                $data[$key] = NULL;
        }

        $DB_Main->update('store_items', $data);
    }

    function add_useritem($store_userid, $item_id)
    {
        $DB_Main = $this->load->database('default', TRUE);

        //Check for Duplicates
        $DB_Main->where('user_id', $store_userid);
        $DB_Main->where('item_id', $item_id);
        $query = $DB_Main->get('store_users_items');

        if ($query->num_rows() == 0)
        {
            $data = array(
                'user_id' => $store_userid,
                'item_id' => $item_id,
                'acquire_method' => 'web'
            );
            $DB_Main->set('acquire_date', 'NOW()', FALSE);
            $DB_Main->insert('store_users_items', $data);
        }
        else
        {
            log_message('error', 'store-add_useritem, User/Item Combo already exists');
        }
    }

    function add_item($name, $display_name, $description, $web_description, $type, $loadout_slot, $price, $attrs, $is_buyable = 1, $is_tradeable = 1, $is_refundable = 1, $category_id, $expiry_time = NULL, $flags = NULL, $priority = 0)
    {

        if ($expiry_time == 0)
            $expiry_time = NULL;

        $DB_Main = $this->load->database('default', TRUE);
        $data = array(
            'name' => $name,
            'display_name' => $display_name,
            'description' => $description,
            'web_description' => $web_description,
            'type' => $type,
            'loadout_slot' => $loadout_slot,
            'price' => $price,
            'attrs' => $attrs,
            'is_buyable' => $is_buyable,
            'is_tradeable' => $is_tradeable,
            'is_refundable' => $is_refundable,
            'category_id' => $category_id,
            'expiry_time' => $expiry_time,
            'flags' => $flags,
            'priority' => $priority,
        );

        foreach ($data as $key => $value)
        {
            if ($data[$key] == "") $data[$key] = NULL;
        }

        if($data['priority'] == NULL) $data['priority'] = 0;

        $DB_Main->insert('store_items', $data);
    }

    function add_json_items($items,$category_id)
    {
        $DB_Main = $this->load->database('default', TRUE);

        foreach ($items as $key => $item)
        {
            $items[$key]['category_id']= $category_id;
            if (PHP_MAJOR_VERSION >= 5 && PHP_MINOR_VERSION >= 4)
            {
                $items[$key]['attrs'] = json_encode($items[$key]['attrs'], JSON_UNESCAPED_SLASHES);
            }
            else
            {
                $items[$key]['attrs'] = json_encode($items[$key]['attrs']);
            }

            if(!isset($items[$key]['priority'])) $items[$key]['priority'] = 0;

            if($items[$key]['priority'] == NULL) $items[$key]['priority'] = 0;

        }

        $DB_Main->insert_batch('store_items', $items);
    }

    function remove_item($item_id)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('id', $item_id);
        $DB_Main->delete('store_items');
        $DB_Main->where('item_id', $item_id);
        $DB_Main->delete('store_users_items');
    }

    function remove_refund_item($item_id)
    {
        $this->load->model('users_model');
        $DB_Main = $this->load->database('default', TRUE);

        //Query item data
        $DB_Main->where('id', $item_id);
        $query_item = $DB_Main->get('store_items');
        $row_item = $query_item->row_array();

        //Refund the item to the users who are using the item
        $item_users = $this->get_item_users($item_id);
        foreach ($item_users as $row)
        {
            $this->users_model->add_credits($row['user_id'], $row_item['price']);
        }

        //remove the item
        $this->remove_item($item_id);
    }

    function remove_useritem($store_userid, $item_id, $useritem_id = NULL)
    {
        $DB_Main = $this->load->database('default', TRUE);

        //Check for Duplicates
        $DB_Main->where('user_id', $store_userid);
        $DB_Main->where('item_id', $item_id);
        $query = $DB_Main->get('store_users_items');

        if ($useritem_id == NULL)
        {
            if ($query->num_rows() >= 1)
            {
                $DB_Main->where('useritem_id', $query->id);
                $DB_Main->delete('store_users_items_loadouts');

                $DB_Main->where('user_id', $store_userid);
                $DB_Main->where('item_id', $item_id);
                $DB_Main->delete('store_users_items');
            }
            else
            {
                log_message('error', 'store-remove_useritem, User/Item Combo does not exists');
            }
        }
        elseif (isset($useritem_id))
        {
            $DB_Main->where('id', $useritem_id);
            $DB_Main->delete('store_users_items');
            $DB_Main->where('useritem_id', $useritem_id);
            $DB_Main->delete('store_users_items_loadouts');
        }
    }

    function remove_refund_useritem($user_id, $item_id, $item_price, $useritem_id)
    {

        $this->load->model('users_model');
        $this->users_model->add_credits($user_id, $item_price);
        $this->items_model->remove_useritem(NULL, NULL, $useritem_id);
    }

    function delete_items_by_type($type)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('type', $type);
        $DB_Main->delete('store_items');
    }

}

?>