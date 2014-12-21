<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bot extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');

        if (!$this->ion_auth->logged_in() && $this->config->item('storewebpanel_enable_loginsystem') == 1)
        {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['page'] = 'bot';
        $data['version'] = $this->tools_model->get_installed_version();
        $this->load->view('parts/header', $data);
        $this->load->view('pages/bot/manage', $data);
        $this->load->view('parts/footer');
    }

    public function show_itemvalue()
    {
        $data['page'] = 'bot';
        $data['version'] = $this->tools_model->get_installed_version();
    }

    public function process_itemvalue()
    {
        $data['page'] = 'bot';
        $data['version'] = $this->tools_model->get_installed_version();
    }

}

/* End of file categories.php */
/* Location: ./application/controllers/categories.php */