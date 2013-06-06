<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Redeem extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('redeem_model');
        $this->load->helper('url');

        if (!$this->ion_auth->logged_in() && $this->config->item('storewebpanel_enable_loginsystem') == 1)
        {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['page'] = 'redeem';
        $data['codes'] = $this->redeem_model->get_codes();

        $this->load->view('parts/header', $data);
        $this->load->view('pages/redeem/manage', $data);
        $this->load->view('parts/footer');
    }

    public function add()
    {
        $data['page'] = 'redeem';


        $this->load->view('parts/header', $data);
        $this->load->view('pages/redeem/add', $data);
        $this->load->view('parts/footer');
    }

    public function process()
    {
        $post = $this->input->post();
        $data['post'] = $post;

        if ($post['action'] == 'createcode')
        {
            $this->redeem_model->add_code($post['code'], $post['itemids'], $post['credits'], $post['redeem_times_total'], $post['redeem_times_user'], $post['expire_time=NULL']);
            echo "Created Redeem code with </br>";
            var_dump($post);
        }
    }

}

/* End of file items.php */
/* Location: ./application/controllers/items.php */