<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
    
    public function index()
    {
        $this->load->view('parts/header');
        $this->load->view('pages/account/manage');
        $this->load->view('parts/footer');
    }
}

/* End of file account.php */
/* Location: ./application/account/settings.php */