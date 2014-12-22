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
        $data['codes'] = $this->redeem_model->get_codes();

        $this->load->view('parts/header', $data);
        $this->load->view('pages/redeem/add_code', $data);
        $this->load->view('parts/footer');
    }

    public function logs()
    {
        $data['page'] = 'redeem';
        $data['version'] = $this->tools_model->get_installed_version();
        $data['codes'] = $this->redeem_model->get_codes();

        $this->load->view('parts/header', $data);
        $this->load->view('pages/redeem/show_logs', $data);
        $this->load->view('parts/footer');
    }

    public function process()
    {
        
    }

}

/* End of file categories.php */
/* Location: ./application/controllers/categories.php */