<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Redeem extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('tools_model');
        $this->load->model('redeem_model');

        if (!$this->ion_auth->logged_in() && $this->config->item('storewebpanel_enable_loginsystem') == 1)
        {
            redirect('auth/login');
        }
    }

    public function codes()
    {
        $data['page'] = 'redeem';
        $data['version'] = $this->tools_model->get_installed_version();
        $data['codes'] = $this->redeem_model->get_codes();

        $this->load->view('parts/header', $data);
        $this->load->view('pages/redeem/show_codes', $data);
        $this->load->view('parts/footer');
    }

    public function add_code()
    {
        $data['page'] = 'redeem';
        $data['version'] = $this->tools_model->get_installed_version();
        
        $this->load->view('parts/header', $data);
        $this->load->view('pages/redeem/add_code', $data);
        $this->load->view('parts/footer');
    }
    
    public function edit_code($slug)
    {
        $data['page'] = 'redeem';
        $data['version'] = $this->tools_model->get_installed_version();
        $data['code'] = $this->redeem_model->get_code_by_id($slug);
        
        $this->load->view('parts/header', $data);
        $this->load->view('pages/redeem/edit_code', $data);
        $this->load->view('parts/footer');
    }

    public function logs()
    {
        $data['page'] = 'redeem';
        $data['version'] = $this->tools_model->get_installed_version();
        $data['logs'] = $this->redeem_model->get_logs();
        
        $this->load->view('parts/header', $data);
        $this->load->view('pages/redeem/show_logs', $data);
        $this->load->view('parts/footer');
    }

    public function process()
    {
        if ($this->input->post('action') == "createcode")
        {
            $this->redeem_model->add_code($this->input->post('code'), $this->input->post('items'), $this->input->post('credits'), $this->input->post('timesTotal'), $this->input->post('timesUser'), $this->input->post('expire'));
            redirect('/redeem/codes', 'refresh');
        }
        
        if($this->input->post('action') == "editcode")
        {
            $this->redeem_model->edit_code($this->input->post('id'), $this->input->post('code'), $this->input->post('items'), $this->input->post('credits'), $this->input->post('timesTotal'), $this->input->post('timesUser'), $this->input->post('expire'));
            redirect('/redeem/codes', 'refresh');
        }
        
        if ($this->input->post('action') == "removecode")
        {
            $this->redeem_model->remove_code($this->input->post('code_id'));
            redirect('/redeem/codes', 'refresh');
        }
    }

}

/* End of file categories.php */
/* Location: ./application/controllers/categories.php */