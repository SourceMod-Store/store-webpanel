<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('items_model');
		$this->load->helper('url');
    }
    
    public function index(){
        $this->load->model('categories_model');
        
        $data['page'] = 'items';
        $category = $this->input->get('c');
        $search = $this->input->get('s');
        
        $data['items'] = $this->items_model->get_items($search, $category);
        $data['categories'] = $this->items_model->get_search_categories();
        $data['search'] = $search;
        
        
        $this->load->view('parts/header',$data);
        $this->load->view('pages/items/manage',$data);
        $this->load->view('parts/footer');
    }
    
    public function add(){
        $data['page'] = 'items';
        
        $data['categories'] = $this->items_model->get_search_categories();
        $this->load->view('parts/header',$data);
        $this->load->view('pages/items/add',$data);
        $this->load->view('parts/footer');
    }
    
    public function edit($slug){
        $data['page'] = 'items';
        $itemInfo = $this->items_model->get_item_info($slug);
        
        if(PHP_MAJOR_VERSION == 5 && PHP_MINOR_VERSION >= 4){ // Check if PHP 5.4
            $itemInfo['attrs'] = json_encode(json_decode($itemInfo['attrs']), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
        }
		
        $data['item_info'] = $itemInfo;
        $data['categories'] = $this->items_model->get_search_categories();
        $this->load->view('parts/header',$data);
        $this->load->view('pages/items/edit',$data);
        $this->load->view('parts/footer');
    }
    
    public function process(){        
        $data['page'] = 'items';
        $post = $this->input->post();
        $data['post'] = $post;
        
        if($post['action'] == 'edit'){
            $this->items_model->update_item($post);
        } elseif ($post['action'] == 'add') {
            
            if($post['expiry_time'] == 0) $post['expiry_time'] = NULL;
            
            if(PHP_MAJOR_VERSION == 5 && PHP_MINOR_VERSION >= 4){ // Check if PHP 5.4
                $itemInfo['attrs'] = json_encode(json_decode($itemInfo['attrs']), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
                $this->items_model->add_item($post['name'], $post['display_name'], $post['description'], $post['web_description'], $post['type'], $post['loadout_slot'], $post['price'], json_encode(json_decode($post['attrs']), JSON_UNESCAPED_SLASHES), $post['is_buyable'], $post['is_tradeable'], $post['is_refundable'], $post['category_id'], $post['expiry_time']);
            }else{
                $this->items_model->add_item($post['name'], $post['display_name'], $post['description'], $post['web_description'], $post['type'], $post['loadout_slot'], $post['price'], json_encode(json_decode($post['attrs'])), $post['is_buyable'], $post['is_tradeable'], $post['is_refundable'], $post['category_id'], $post['expiry_time']);
            }
            
        }
		
        redirect('/items', 'refresh');
    }
}

/* End of file items.php */
/* Location: ./application/controllers/items.php */