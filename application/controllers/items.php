<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller {
    
    public function index()
    {
        $this->load->view('parts/header');
        $this->load->view('pages/items/manage');
        $this->load->view('parts/footer');
    }
    
    public function add()
    {
        $this->load->view('parts/header');
        $this->load->view('pages/items/add');
        $this->load->view('parts/footer');
    }
    
    public function edit($slug)
    {
        $this->load->view('parts/header');
        $this->load->view('pages/items/edit');
        $this->load->view('parts/footer');
    }
}

/* End of file items.php */
/* Location: ./application/controllers/items.php */