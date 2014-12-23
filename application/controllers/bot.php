<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bot extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('tools_model');
        $this->load->model('bot_model');

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
        $this->load->view('pages/bot/dashboard', $data);
        $this->load->view('parts/footer');
    }

    public function show_itemvalues()
    {
        $data['page'] = 'bot';
        $data['version'] = $this->tools_model->get_installed_version();
        $data['itemvalues'] = $this->bot_model->get_itemvalues();
        
        $this->load->view('parts/header', $data);
        $this->load->view('pages/bot/show_itemvalues', $data);
        $this->load->view('parts/footer');
    }

    public function add_itemvalue()
    {
        $data['page'] = 'bot';
        $data['version'] = $this->tools_model->get_installed_version();

        $this->load->view('parts/header', $data);
        $this->load->view('pages/bot/add_itemvalue', $data);
        $this->load->view('parts/footer');
    }

    public function edit_itemvalue($slug)
    {
        $data['page'] = 'bot';
        $data['version'] = $this->tools_model->get_installed_version();
        $data['itemvalue'] = $this->bot_model->get_itemvalue($slug);

        $this->load->view('parts/header', $data);
        $this->load->view('pages/bot/edit_itemvalue', $data);
        $this->load->view('parts/footer');
    }

    public function process_itemvalue()
    {
        if($this->input->post('action') == 'remove')
        {
            $itemvalue = $this->input->post('itemvalue_id');
            $this->bot_model->remove_itemvalue($itemvalue);
        }
    }

    public function show_itemdonations()
    {
        $data['page'] = 'bot';
        $data['version'] = $this->tools_model->get_installed_version();

        $this->load->view('parts/header', $data);
        $this->load->view('pages/bot/show_itemdonations', $data);
        $this->load->view('parts/footer');
    }    
}
/* End of file categories.php */
/* Location: ./application/controllers/categories.php */