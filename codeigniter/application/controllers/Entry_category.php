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
		$data['title'] = 'Blog Categories';
		$data['categories'] = $this->entry_category_model->get();
		
		$this->load->view('templates/header');
		$this->load->view('category/index', $data);
		$this->load->view('templates/footer');
	}
	
	public function view($id = null)
	{
		$category = $this->entry_category_model->get($id);
		
		if (empty($category)) show_404();
		
		$this->load->view('templates/header');
		$this->load->view('category/view', $category);
		$this->load->view('templates/footer');
	}
	
	private function get_category_or_404($id = null)
	{
		$category = null;
		if (isset($id))
		{
			$category = $this->entry_category_model->get($id);
			if (empty($category)) show_404();
			return $category;
		}
		else return null;
	}
	
	public function edit_form($id = null)
	{
		$this->load->helper('form');
		
		$category = $this->get_category_or_404($id);
		
		// Generate form page, with either empty data in the case of a create, or existing data for an edit.
		$data['title']					= isset($category) ? 'Edit' : 'Create';
		$data['id']						= isset($category) ? $category['id'] : null;
		$data['category_name']			= isset($category) ? $category['name'] : '';
		$data['category_description']	= isset($category) ? $category['description'] : '';
		
		$this->load->view('templates/header');
		$this->load->view('category/edit', $data);
		$this->load->view('templates/footer');
	}
	
	public function edit($id = null)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$category = $this->get_category_or_404($id);
		
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		
		// Check that form rules are valid. If so, commit, else rollback.
		if ($this->form_validation->run() === TRUE)
		{
			$input = [
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description')
			];
			
			// If we have an entry to update, do so, else create.
			if (isset($category))
				$this->entry_category_model->update($id, $input);
			else
				$id = $this->entry_category_model->insert($input);
			
			redirect('category/'.$id, 'refresh');
		}
		else
		{
			// TODO: Handle error in form validation by re-showing form with existing data by redirecting.			
		}
	}
	
	public function delete($id)
	{
		$this->entry_category_model->delete($id);
		redirect('category');
	}
}
?>