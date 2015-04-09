<?php

class Categories_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_categories($type = 0)
    {
        //Query the Categories Table
        $DB_Main = $this->load->database('default', TRUE);
        if ($type !== 0)
        {
            $DB_Main->where('require_plugin', $type);
        }
        $query_categories = $DB_Main->get('store_categories');
        //Check if there are categories
        if ($query_categories->num_rows() > 0)
        {
            //Transform result into array
            $array_categories = $query_categories->result_array();
            foreach ($array_categories as $key => $category)
            {
                //add the items count to the result array
                $DB_Main->where('category_id', $category['id']);
                $query_items = $DB_Main->get('store_items');
                $array_categories[$key]['count'] = $query_items->num_rows();
                $array_categories[$key]['items'] = $query_items->result_array();
            }
            return $array_categories;
        }
        else
        {
            return array();
        }
    }

    function get_category($id_category)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where("id", $id_category);
        $query_category = $DB_Main->get('store_categories');
        if ($query_category->num_rows == 1)
        {
            return $query_category->row_array();
        }
        else
        {
            return array();
        }
    }

    function update_category($post)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $data = array(
            'display_name' => $post['display_name'],
            'description' => $post['description'],
            'require_plugin' => $post['require_plugin'],
            'web_description' => $post['web_description'],
            'web_color' => $post['web_color'],
            'priority' => $post['priority']
        );
        $DB_Main->where('id', $post['id']);
        $DB_Main->update('store_categories', $data);
    }

    function add_category($display_name, $description, $require_plugin, $web_description, $web_color, $priority=0)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $data = array(
            'display_name' => $display_name,
            'priority' => $priority,
            'description' => $description,
            'require_plugin' => $require_plugin,
            'web_description' => $web_description,
            'web_color' => $web_color
        );
        $DB_Main->insert('store_categories', $data);
        return $DB_Main->insert_id();
    }

    function remove_category($category_id)
    {
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where('id', $category_id);
        $DB_Main->delete('store_categories');
    }

}

?>
