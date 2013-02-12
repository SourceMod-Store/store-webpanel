<?php
class Categories_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_categories(){
        //Query the Categories Table
        $DB_Main = $this->load->database('default', TRUE);
        $query_categories = $DB_Main->get('categories');
        //Check if there are categories
        if($query_categories->num_rows() >0){
            //Transform result into array
            $array_categories = $query_categories->result_array();
            $i=0;
            foreach($array_categories as $categorie){
                //add the items count to the result array
                $DB_Main->where('type',$categorie['require_plugin']);
                $query_items = $DB_Main->get('items');
                $array_categories[$i]['count'] = $query_items->num_rows();
                $i++;
            }
            return $array_categories;
        }else{
            return array();
        }
    }
    
    function get_category($id_category){
        $DB_Main = $this->load->database('default', TRUE);
        $DB_Main->where("id",$id_category);
        $query_category = $DB_Main->get('categories');
        if($query_category->num_rows == 1){
            return $query_category->row_array();
        }else{
            return array();
        }
    }
    
    function update_category($post){
        $DB_Main = $this->load->database('default', TRUE);
        $data=array(
            'display_name' => $post['display_name'],
            'description' => $post['description'],
            'require_plugin' => $post['require_plugin'],
            'web_description' => $post['web_description'],
            'web_color' => $post['web_color']
        );
        $DB_Main->where('id',$post['id']);
        $DB_Main->update('categories',$data);
    }
    
    function add_category($post){
        $DB_Main = $this->load->database('default', TRUE);
        if($post['action'] == 'add'){
            $data=array(
                'display_name' => $post['display_name'],
                'description' => $post['description'],
                'require_plugin' => $post['require_plugin'],
                'web_description' => $post['web_description'],
                'web_color' => $post['web_color']
            );
            $DB_Main->insert('categories',$data);
        }
    }
}
?>
