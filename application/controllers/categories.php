<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {
    
    public function index()
    {
        $this->load->view('parts/header');
        $this->load->view('pages/categories/manage');
        $this->load->view('parts/footer');
    }
    
    public function add(){
        $this->load->view('parts/header');
        $this->load->view('pages/categories/add');
        $this->load->view('parts/footer');
    }
    
    public function edit($slug){
        $this->load->view('parts/header');
        $this->load->view('pages/categories/edit');
        $this->load->view('parts/footer');
    }
}

/* End of file categories.php */
/* Location: ./application/controllers/categories.php */