<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('items_model');
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
        
        $data['item_info'] = $this->items_model->get_item_info($slug);
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
        }elseif ($post['action'] == 'add') {
            echo "adding item";
            $this->items_model->add_item($post);
        }
        $this->load->view('parts/header',$data);
        $this->load->view('pages/items/process',$data);
        $this->load->view('parts/footer');
    }
}

/* End of file items.php */
/* Location: ./application/controllers/items.php */