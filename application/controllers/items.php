<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller {
    
    public function index(){
        $data['page'] = 'items';
        
        $this->load->view('parts/header',$data);
        $this->load->view('pages/items/manage',$data);
        $this->load->view('parts/footer');
    }
    
    public function add(){
        $data['page'] = 'items';
        
        $this->load->view('parts/header',$data);
        $this->load->view('pages/items/add',$data);
        $this->load->view('parts/footer');
    }
    
    public function edit($slug){
        $data['page'] = 'items';
        
        $this->load->view('parts/header',$data);
        $this->load->view('pages/items/edit',$data);
        $this->load->view('parts/footer');
    }
}

/* End of file items.php */
/* Location: ./application/controllers/items.php */