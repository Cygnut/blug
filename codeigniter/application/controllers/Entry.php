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
	
	private function get_entry_or_404($id = null)
	{
		$entry = null;
		if (isset($id))
		{
			$entry = $this->entry_model->get($id);
			if (empty($entry)) show_404();
			return $entry;
		}
		else return null;
	}
	
	public function edit_form($id = null)
	{
		$this->load->helper('form');
		
		$entry = $this->get_entry_or_404($id);
		
		// Generate form page, with either empty data in the case of a create, or existing data for an edit.
		$data['categories'] = $this->entry_category_model->get();
		$data['title']			= isset($entry) ? 'Edit' : 'Create';
		$data['id']				= isset($entry) ? $entry['id'] : null;
		$data['entry_title']	= isset($entry) ? $entry['title'] : '';
		$data['entry_content']	= isset($entry) ? $entry['content'] : '';
		$data['entry_category']	= isset($entry) ? $entry['category_id'] : '';
		
		$this->load->view('templates/header');
		$this->load->view('entry/edit', $data);
		$this->load->view('templates/footer');
	}
	
	public function edit($id = null)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$entry = $this->get_entry_or_404($id);
		
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');
		
		// Check that form rules are valid. If so, commit, else rollback.
		if ($this->form_validation->run() === TRUE)
		{
			$input = [
				'title' => $this->input->post('title'),
				'category_id' => $this->input->post('category'),
				'content' => $this->input->post('content')
			];
			
			// If we have an entry to update, do so, else create.
			if (isset($entry))
				$this->entry_model->update($id, $input);
			else
				$id = $this->entry_model->insert($input);
			
			redirect('entry/'.$id, 'refresh');
		}
		else 
		{
			// TODO: Handle error in form validation by re-showing form with existing data by redirecting.
		}
	}
	
	public function delete($id)
	{
		$this->entry_model->delete($id);
		redirect('entry');
	}
}
?>