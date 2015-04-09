<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Json_Api extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('categories_model');
        $this->load->model('items_model');
        $this->load->model('users_model');
    }

    /**
     * Displays a info page
     */
    public function index() {
        $this->load->view('pages/api/info');
    }

    /**
     * Gets the users with the most money
     * 
     * @param int $slug How many users should be returned
     */
    public function get_richest_users($slug = 10) {
        $users = $this->users_model->get_richest_users($slug);
        
        
        echo json_encode($users);
    }

    /**
     * Returns the categories
     * 
     * @param string $slug what plugin should be required
     */
    public function get_categories($slug) {
        $categories = $this->categories_model->get_categories($slug);
        echo json_encode($categories);
    }

    /**
     * Returns the most bought Items
     * 
     * @param int $slug how many items should be returned
     */
    public function get_top_items($slug = 10) {
        $items = $this->items_model->get_top_items($slug);
        echo json_encode($items);
    }

}

/* End of file api.php */
/* Location: ./application/controllers/api.php */