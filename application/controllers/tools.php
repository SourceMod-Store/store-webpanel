<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends CI_Controller {
    
    public function impex()
    {
        $this->load->view('parts/header');
        $this->load->view('pages/tools/impex');
        $this->load->view('parts/footer');
    }
    
    public function update()
    {
        $this->load->view('parts/header');
        $this->load->view('pages/tools/update');
        $this->load->view('parts/footer');
    }
}

/* End of file tools.php */
/* Location: ./application/controllers/tools.php */