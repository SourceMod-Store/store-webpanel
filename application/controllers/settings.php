<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {
    
    public function index(){
        $data['page'] = 'settings';
        
        $this->load->view('parts/header',$data);
        $this->load->view('pages/settings/manage',$data);
        $this->load->view('parts/footer');
    }
}

/* End of file settings.php */
/* Location: ./application/controllers/settings.php */