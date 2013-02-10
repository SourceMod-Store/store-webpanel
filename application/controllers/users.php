<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
    
    public function index()
    {
        $this->load->view('parts/header');
        $this->load->view('pages/users/manage');
        $this->load->view('parts/footer');
    }
    
    public function edit($slug)
    {
        $this->load->view('parts/header');
        $this->load->view('pages/users/edit');
        $this->load->view('parts/footer');
    }
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */