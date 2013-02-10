<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {
    
    public function index()
    {
        $this->load->view('parts/header');
        $this->load->view('pages/settings/manage');
        $this->load->view('parts/footer');
    }
}

/* End of file settings.php */
/* Location: ./application/controllers/settings.php */