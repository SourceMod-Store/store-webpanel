<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
    
    public function index(){
        $data['page'] = 'account';
        
        $this->load->view('parts/header',$data);
        $this->load->view('pages/account/manage',$data);
        $this->load->view('parts/footer');
    }
}

/* End of file account.php */
/* Location: ./application/account/settings.php */