<?php
class Entry_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	private $table = 'entry';
	
	public function get($id = null)
	{
		return 
			$id === NULL
			?
			$this->db->get($this->table)->result_array()
			:
			$this->db->get_where($this->table, [ 'id' => $id ])->row_array();
	}
	
	/*
		$entry = 
		[
			'title' => 'bmo',
			'content' => 'finn',
			'category_id' => 12
		]
	*/
	public function insert($entry)
	{
		$this->db
			->set('when_updated', 'NOW()', FALSE)
			->insert($this->table, $entry);
		
		return $this->db->insert_id();
	}
	
	public function update($id, $entry)
	{
		$this->db
			->where('id', $id)
			->set('when_updated', 'NOW()', FALSE)
			->update($this->table, $entry);
	}
	
	public function delete($id)
	{
		$this->db->delete($this->table, [
			'id' => $id
		]);
	}
}
?>