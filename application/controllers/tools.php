<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tools extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('categories_model');
        $this->load->model('items_model');
        $this->load->model('tools_model');

        if (!$this->ion_auth->logged_in() && $this->config->item('storewebpanel_enable_loginsystem') == 1)
        {
            redirect('auth/login');
        }
    }

    public function impex()
    {
        $data['page'] = 'tools';
        $data['version'] = $this->tools_model->get_installed_version();

        $this->load->view('parts/header', $data);
        $this->load->view('pages/tools/impex', $data);
        $this->load->view('parts/footer');
    }

    public function json_check()
    {
        $data['page'] = 'tools';
        $data['version'] = $this->tools_model->get_installed_version();

        $this->load->view('parts/header', $data);
        $this->load->view('pages/tools/json_check', $data);
        $this->load->view('parts/footer');
    }

    public function check_process()
    {
        $this->tools_model->check_json();
    }

    public function update()
    {
        $data['page'] = 'tools';
        $data['version'] = $this->tools_model->get_installed_version();

        $this->load->view('parts/header', $data);
        $this->load->view('pages/tools/update', $data);
        $this->load->view('parts/footer');
    }

    public function confirm_import()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'json';
        $data['page'] = 'tools';
        $data['version'] = $this->tools_model->get_installed_version();

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('importFile'))
        {
            $uploadData = $this->upload->data();
            $json_string = file_get_contents($uploadData['file_path'] . $uploadData['file_name']);
            $json = json_decode($json_string);

            $json_categories = "";

            foreach ($json->categories as $category)
            {
                $json_categories .= $category->display_name;
                $json_categories .= ";";
            }

            $effected_item_count = $this->items_model->get_item_count_by_type($json->type);

            $data['json_type'] = $json->type;
            $data['json_categories'] = $json_categories;
            $data['json_string'] = $this->tools_model->shrink_json($json_string);
            $data['effected_item_count'] = $effected_item_count;

            $this->load->view('parts/header', $data);
            $this->load->view('pages/tools/confirm_import', $data);
            $this->load->view('parts/footer');
        }
        else
        {
            $data['errors'] = $this->upload->display_errors();
            $this->load->view('parts/header', $data);
            $this->load->view('pages/tools/confirm_import', $data);
            $this->load->view('parts/footer');
        }
    }

    public function import()
    {
        $json = json_decode(urldecode($this->input->post('json')));
		
        $this->items_model->delete_items_by_type($json->type);

        foreach ($json->categories as $category)
        {
            $items_array = array();

            foreach ($category->items as $item)
            {
                $items_array[] = (array) $item;
            }
			
            $category_id = $this->categories_model->add_category($category->display_name, $category->description, $category->require_plugin, $category->web_description, $category->web_color);
            
			if(count($items_array) > 0)
			{
				$this->items_model->add_json_items($items_array,$category_id);
			}
        }
        redirect('items');
    }

    public function export()
    {
        $post = $this->input->post();

        if ($post['itemType'] != "" && isset($post['itemType']))
        {
            $categories = $this->categories_model->get_categories($post['itemType']);
            foreach ($categories as $category)
            {
                unset($category['id']);
                foreach ($category['items'] as $item)
                {
                    unset($item['id']);
                    unset($item['category_id']);
                    $item['attrs'] = json_decode($item['attrs']);
                }
            }
            if (PHP_MAJOR_VERSION == 5 && PHP_MINOR_VERSION >= 4)
            {
                $this->output
                        ->set_content_type('application/octet-stream')
                        ->set_header("Content-Disposition: attachment; filename=" . $post['itemType'] . ".json")
                        ->set_output(json_encode(array('type' => $post['itemType'], 'categories' => $categories), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
            }
            else
            {
                $this->output
                        ->set_content_type('application/octet-stream')
                        ->set_header("Content-Disposition: attachment; filename=" . $post['itemType'] . ".json")
                        ->set_output(json_encode(array('type' => $post['itemType'], 'categories' => $categories)));
            }
        }
        else
        {
            echo "You have not entered a category to export";
        }
    }

    public function json_shrink()
    {
        $data['page'] = 'tools';
        $data['version'] = $this->tools_model->get_installed_version();

        $this->load->view('parts/header', $data);
        $this->load->view('pages/tools/shrink_json', $data);
        $this->load->view('parts/footer');
    }

    public function json_shrink_process()
    {
        $items = $this->items_model->get_items();

        foreach ($items as $key => $item)
        {
            $item['attrs'] = $this->tools_model->shrink_json($items[$key]['attrs']);
            $this->items_model->update_item($item);
            echo "updated Item: " . $item['id'] . "<hr>";
        }
    }

}

/* End of file tools.php */
/* Location: ./application/controllers/tools.php */