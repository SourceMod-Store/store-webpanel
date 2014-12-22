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
  
}
/* End of file categories.php */
/* Location: ./application/controllers/categories.php */