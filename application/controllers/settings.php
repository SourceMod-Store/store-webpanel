<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('tools_model');

        if (!$this->ion_auth->logged_in() && $this->config->item('storewebpanel_enable_loginsystem') == 1)
        {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['page'] = 'settings';
        $data['version'] = $this->tools_model->get_installed_version();

        $this->load->view('parts/header', $data);
        $this->load->view('pages/settings/manage', $data);
        $this->load->view('parts/footer');
    }

}

/* End of file settings.php */
/* Location: ./application/controllers/settings.php */