<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends CI_Controller {
    
    public function impex(){
        $data['page'] = 'tools';
        
        $this->load->view('parts/header',$data);
        $this->load->view('pages/tools/impex',$data);
        $this->load->view('parts/footer');
    }
    
    public function update(){
        $data['page'] = 'tools';
        
        $this->load->view('parts/header',$data);
        $this->load->view('pages/tools/update',$data);
        $this->load->view('parts/footer');
    }
}

/* End of file tools.php */
/* Location: ./application/controllers/tools.php */