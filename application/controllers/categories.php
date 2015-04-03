<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categories extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('categories_model');
        $this->load->model('tools_model');
        
        if (!$this->ion_auth->logged_in() && $this->config->item('storewebpanel_enable_loginsystem') == 1)
        {
            redirect('auth/login');
        }
        
    }

    public function index()
    {
        $data['page'] = 'categories';
        $data['version'] = $this->tools_model->get_installed_version();

        $data['query_categories'] = $this->categories_model->get_categories();
        $this->load->view('parts/header', $data);
        $this->load->view('pages/categories/manage', $data);
        $this->load->view('parts/footer');
    }

    public function add()
    {
        $data['page'] = 'categories';
        $data['version'] = $this->tools_model->get_installed_version();

        $this->load->view('parts/header', $data);
        $this->load->view('pages/categories/add', $data);
        $this->load->view('parts/footer');
    }

    public function edit($slug)
    {
        $data['page'] = 'categories';
        $data['version'] = $this->tools_model->get_installed_version();

        $data['category'] = $this->categories_model->get_category($slug);
        $this->load->view('parts/header', $data);
        $this->load->view('pages/categories/edit', $data);
        $this->load->view('parts/footer');
    }

    public function process()
    {
        $data['page'] = 'categories';
        $data['version'] = $this->tools_model->get_installed_version();
        
        $post = $this->input->post();
        $data['post'] = $post;

        if ($post['action'] == 'edit')
        {
            $this->categories_model->update_category($post);
        }
        elseif ($post['action'] == 'add')
        {
            if (strpos($post['web_color'], "%23") !== false)
            {
                str_replace("%23", "#", $post['web_color']);
            }
            $this->categories_model->add_category($post['display_name'], $post['description'], $post['require_plugin'], $post['web_description'], $post['web_color'], $post['priority']);
        }
        elseif ($post['action'] == 'remove')
        {
            $this->categories_model->remove_category($post['category_id']);
        }
        redirect('/categories', 'refresh');
    }

}

/* End of file categories.php */
/* Location: ./application/controllers/categories.php */