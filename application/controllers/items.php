<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Items extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('items_model');
        $this->load->helper('url');
        $this->load->model('tools_model');

        if (!$this->ion_auth->logged_in() && $this->config->item('storewebpanel_enable_loginsystem') == 1)
        {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->load->model('categories_model');

        $data['page'] = 'items';
        $data['version'] = $this->tools_model->get_installed_version();

        $data['items'] = $this->items_model->get_items();
        $data['categories'] = $this->items_model->get_search_categories();


        $this->load->view('parts/header', $data);
        $this->load->view('pages/items/manage', $data);
        $this->load->view('parts/footer');
    }

    public function add()
    {
        $data['page'] = 'items';
        $data['version'] = $this->tools_model->get_installed_version();

        $data['categories'] = $this->items_model->get_search_categories();
        $this->load->view('parts/header', $data);
        $this->load->view('pages/items/add', $data);
        $this->load->view('parts/footer');
    }

    public function edit($slug)
    {
        $data['page'] = 'items';
        $data['version'] = $this->tools_model->get_installed_version();

        $itemInfo = $this->items_model->get_item_info($slug);

        if (PHP_MAJOR_VERSION == 5 && PHP_MINOR_VERSION >= 4)
        { // Check if PHP 5.4
            $itemInfo['attrs'] = json_encode(json_decode($itemInfo['attrs']), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        }

        $data['item_info'] = $itemInfo;
        $data['categories'] = $this->items_model->get_search_categories();
        $this->load->view('parts/header', $data);
        $this->load->view('pages/items/edit', $data);
        $this->load->view('parts/footer');
    }

    public function bought_by($slug)
    {
        $data['page'] = 'items';
        $data['version'] = $this->tools_model->get_installed_version();

        $data['item_users'] = $this->items_model->get_item_users($slug);

        $this->load->view('parts/header', $data);
        $this->load->view('pages/items/bought_by', $data);
        $this->load->view('parts/footer');
    }

    public function process()
    {
        $data['page'] = 'items';
        $data['version'] = $this->tools_model->get_installed_version();

        $post = $this->input->post();
        $data['post'] = $post;

        if ($post['action'] == 'edit')
        {
            $this->items_model->update_item($post);
        }
        elseif ($post['action'] == 'add')
        {

            if (PHP_MAJOR_VERSION == 5 && PHP_MINOR_VERSION >= 4)
            { // Check if PHP 5.4
                $post['attrs'] = json_encode(json_decode($post['attrs']), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

                if ($post['attrs'] != "")
                {
                    $attrs = json_encode(json_decode($post['attrs']), JSON_UNESCAPED_SLASHES);
                    // echo "attrs :" . $attrs . ": ";
                }
                else
                {
                    $attrs = NULL;
                }


                $this->items_model->add_item($post['name'], $post['display_name'], $post['description'], $post['web_description'], $post['type'], $post['loadout_slot'], $post['price'], $attrs, $post['is_buyable'], $post['is_tradeable'], $post['is_refundable'], $post['category_id'], $post['expiry_time'], $post['flags']);
            }
            else
            {
                $this->items_model->add_item($post['name'], $post['display_name'], $post['description'], $post['web_description'], $post['type'], $post['loadout_slot'], $post['price'], $post['attrs'], $post['is_buyable'], $post['is_tradeable'], $post['is_refundable'], $post['category_id'], $post['expiry_time'], $post['flags']);
            }
        }
        elseif ($post['action'] == 'remove')
        {
            $this->items_model->remove_item($post['item_id']);
        }
        elseif ($post['action'] == 'remove_refund')
        {
            $this->items_model->remove_refund_item($post['item_id']);
        }

        redirect('/items', 'refresh');
    }

}

/* End of file items.php */
/* Location: ./application/controllers/items.php */