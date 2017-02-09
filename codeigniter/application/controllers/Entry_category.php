<?php
class Entry_category extends CI_Controller {
	
	public function __construct()
	{
			parent::__construct();
			$this->load->model('entry_category_model');
			$this->load->helper('url_helper');
	}
	
	public function index()
	{
		$data['categories'] = $this->entry_category_model->get();
		
		$this->load->view('templates/header', $data);
		$this->load->view('news/index', $data);
		$this->load->view('templates/footer');
		
		// TODO: Finish this!
	}
	
	public function view($id = null)
	{
		$data['category'] = $this->entry_category_model->get($id);
		
		if (empty($data['category'])) show_404();
		
		// TODO: Finish this!
	}
	
	public function delete($id)
	{
		$this->entry_category_model->delete($id);
		
		// TODO: Finish this! Validate params
	}
}
?>