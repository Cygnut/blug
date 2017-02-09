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
	
	private function is_post()
	{
		return isset($_POST) && !empty($_POST);
	}
	
	public function edit($id = null)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$category = null;
		if (isset($id))
		{
			$category = $this->entry_category_model->get($id);
			if (empty($category)) show_404();
		}
		
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		
		// If the user got here by POSTing the form, and form validation was good, update the model.
		if ($this->is_post() && $this->form_validation->run())
		{
			$input = [
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description')
			];
			
			if (isset($category))
			{
				// It's an edit.
				$this->entry_category_model->update($id, $input);
			}
			else
			{
				// It's a create.
				$id = $this->entry_category_model->insert($input);
			}
			redirect('category/'.$id, 'refresh');
		}
		else
		{
			// Otherwise - the user has either accessed this endpoint with a GET (wanting
			// the form to be rendered), or have submitted an invalid form.
			//   In either case, render the form.
			
			$data['title']					= isset($category) ? 'Edit' : 'Create';
			$data['id']						= isset($category) ? $category['id'] : null;
			$data['category_name']			= isset($category) ? $category['name'] : '';
			$data['category_description']	= isset($category) ? $category['description'] : '';
			
			$this->load->view('templates/header');
			$this->load->view('category/edit', $data);
			$this->load->view('templates/footer');
		}
	}
	
	public function delete($id)
	{
		$this->entry_category_model->delete($id);
		redirect('category');
	}
}
?>