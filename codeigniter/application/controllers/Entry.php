<?php
class Entry extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('entry_model');
		$this->load->model('entry_category_model');
		$this->load->helper('url_helper');
	}
	
	public function index()
	{
		$data['title'] = 'Blog Entries';
		$data['entries'] = $this->entry_model->get();
		
		$this->load->view('templates/header');
		$this->load->view('entry/index', $data);
		$this->load->view('templates/footer');
	}
	
	public function view($id = null)
	{
		$entry = $this->entry_model->get($id);
		
		if (empty($entry)) show_404();
		
		$this->load->view('templates/header');
		$this->load->view('entry/view', $entry);
		$this->load->view('templates/footer');
	}
	
	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = 'Create an entry';
		$data['categories'] = $this->entry_category_model->get();
		
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header');
			$this->load->view('entry/create', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			$id = $this->entry_model->insert([
				'title' => $this->input->post('title'),
				'category_id' => $this->input->post('category'),
				'content' => $this->input->post('content')
			]);
			redirect('entry/'.$id, 'refresh');
		}
	}

	public function delete($id)
	{
		$this->entry_model->delete($id);
		redirect('entry');
	}
}
?>