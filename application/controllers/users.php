<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('items_model');
        
        if (!$this->ion_auth->logged_in() && $this->config->item('storewebpanel_enable_loginsystem') == 1)
        {
                redirect('auth/login');
        }
    }
    
    public function index(){
        $data['page'] = 'users';
        $search = $this->input->get('s');
        
        $data['users'] = $this->users_model->get_users($search);
        $data['search'] = $search;
        
        $this->load->view('parts/header',$data);
        $this->load->view('pages/users/manage',$data);
        $this->load->view('parts/footer');
    }
    
    public function edit($slug){
        $data['page'] = 'users';
        
        $data['user'] = $this->users_model->get_user($slug);
        $data['user_items'] = $this->users_model->get_user_items($slug);
        $data['items'] = $this->items_model->get_items();
        $this->load->view('parts/header',$data);
        $this->load->view('pages/users/edit',$data);
        $this->load->view('parts/footer');
    }
    
    public function process(){
        $data['page'] = 'users';
        $post = $this->input->post();
        $data['post'] = $post;
        
        if($post['action'] == 'edit'){
            $this->users_model->edit_user($post);
            
        }elseif($post['action'] == 'remove_item'){
            $this->items_model->remove_useritem(NULL,NULL,$post['useritem_id']);
            
        }elseif($post['action'] == 'remove_refund_item'){
            $this->items_model->remove_refund_useritem($post["user_id"], $post["item_id"], $post["item_price"], $post['useritem_id']);
            
        }elseif ($post['action'] == 'remove_user') {
            $this->users_model->remove_user($post);
            
        }elseif ($post['action'] == 'add_item') {
            $this->items_model->add_useritem($post["user_id"], $post["item_id"]);
            
        }
        redirect('/users/', 'refresh');
    }
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */