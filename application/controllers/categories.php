<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {   
    
    function __construct() {
        parent::__construct();
        $this->load->model('categories_model');
    }
    
    public function index(){
        $data['page'] = 'categories';
        
        $data['query_categories'] = $this->categories_model->get_categories();
        $this->load->view('parts/header',$data);
        $this->load->view('pages/categories/manage',$data);
        $this->load->view('parts/footer');
    }
    
    public function add(){
        $data['page'] = 'categories';
        
        $this->load->view('parts/header',$data);
        $this->load->view('pages/categories/add',$data);
        $this->load->view('parts/footer');
    }
    
    public function edit($slug){
        $data['page'] = 'categories';
        
        $data['category'] = $this->categories_model->get_category($slug);
        $this->load->view('parts/header',$data);
        $this->load->view('pages/categories/edit',$data);
        $this->load->view('parts/footer');
    }
    
    public function process(){        
        $data['page'] = 'categories';
        $post = $this->input->post();
        $data['post'] = $post;
        
        if($post['from'] == 'update'){
            $this->categories_model->update_category($post);
        }elseif ($post['from'] == 'add') {
            $this->categories_model->add_category($post);
        }
        $this->load->view('parts/header',$data);
        $this->load->view('pages/categories/process',$data);
        $this->load->view('parts/footer');
    }
}

/* End of file categories.php */
/* Location: ./application/controllers/categories.php */