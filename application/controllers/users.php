<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }
    
    public function index(){
        $data['page'] = 'users';
        $search = $this->input->get('s');
        
        $data['users'] = $this->users_model->get_uesrs($search);
        $data['search'] = $search;
        
        $this->load->view('parts/header',$data);
        $this->load->view('pages/users/manage',$data);
        $this->load->view('parts/footer');
    }
    
    public function edit($slug){
        $data['page'] = 'users';
        
        $data['user'] = $this->users_model->get_user($slug);
        $data['user_items'] = $this->users_model->get_user_items($slug);
        $this->load->view('parts/header',$data);
        $this->load->view('pages/users/edit',$data);
        $this->load->view('parts/footer');
    }
    
    public function process(){
        
    }
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */