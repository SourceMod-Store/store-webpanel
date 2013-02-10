<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function index()
    {
        $this->load->view('parts/header');
        $this->load->view('pages/dashboard/dashboard');
        $this->load->view('parts/footer');
    }
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */