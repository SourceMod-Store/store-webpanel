<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('dashboard_model');
    }
    
    public function index(){
        $data['page'] = 'dashboard';
        
        $data['top_users'] = $this->dashboard_model->get_richest_users(5);
        $data['top_items'] = $this->dashboard_model->get_top_items(5);
        
        $this->load->view('parts/header',$data);
        $this->load->view('pages/dashboard/dashboard',$data);
        $this->load->view('parts/footer');
    }
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */