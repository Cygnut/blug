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
		
		if (empty($entry)) 
		{
			show_404();
			return;
		}
		
		$this->load->view('templates/header');
		$this->load->view('entry/view', $entry);
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
		
		$entry = null;
		if (isset($id))
		{
			$entry = $this->entry_model->get($id);
			if (empty($entry)) show_404();
		}
		
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');
		
		// If the user got here by POSTing the form, and form validation was good, update the model.
		if ($this->is_post() && $this->form_validation->run())
		{
			$input = [
				'title' => $this->input->post('title'),
				'category_id' => $this->input->post('category'),
				'content' => $this->input->post('content')
			];
			
			if (isset($entry))
			{
				// It's an edit.
				$this->entry_model->update($id, $input);
			}
			else
			{
				// It's a create.
				$id = $this->entry_model->insert($input);
			}
			redirect('entry/'.$id, 'refresh');
		}
		else
		{
			// Otherwise - the user has either accessed this endpoint with a GET (wanting
			// the form to be rendered), or have submitted an invalid form.
			//   In either case, render the form.
			
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
	}
	
	public function delete($id)
	{
		$this->entry_model->delete($id);
		redirect('entry');
	}
}
?>