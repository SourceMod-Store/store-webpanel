<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
    
    public function index(){
        $data['page'] = 'users';
        
        $this->load->view('parts/header',$data);
        $this->load->view('pages/users/manage',$data);
        $this->load->view('parts/footer');
    }
    
    public function edit($slug){
        $data['page'] = 'users';
        
        $this->load->view('parts/header',$data);
        $this->load->view('pages/users/edit',$data);
        $this->load->view('parts/footer');
    }
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */