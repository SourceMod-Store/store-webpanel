<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends CI_Controller {

	public function impex(){
		$data['page'] = 'tools';
		
		$this->load->view('parts/header',$data);
		$this->load->view('pages/tools/impex',$data);
		$this->load->view('parts/footer');
	}

	public function update(){
		$data['page'] = 'tools';
		
		$this->load->view('parts/header',$data);
		$this->load->view('pages/tools/update',$data);
		$this->load->view('parts/footer');
	}

	public function import()
	{
		$config['upload_path'] = './uploads/';      
		$config['allowed_types'] = 'json';
		$config['max_size'] = '5000';
		$config['remove_spaces']= 'true';
		
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload())
		{
			$json = json_decode(file_get_contents($this->upload->data()['file_path']));
			
			for ($json as $category)
			{
				$category['display_name']
			}
		}
	}
}

/* End of file tools.php */
/* Location: ./application/controllers/tools.php */