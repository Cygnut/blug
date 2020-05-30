<?php
class Entry_category_model extends CI_Model {
    
    public function __construct()
    {
        $this->load->database();
    }
    
    private $table = 'entry_category';
    
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
        $category = 
        [
            'name' => 'man',
            'description' => 'woman'
        ]
    */
    public function insert($category)
    {
        $this->db
            ->set('when_updated', 'NOW()', FALSE)
            ->insert($this->table, $category);
        
        return $this->db->insert_id();
    }
    
    public function update($id, $category)
    {
        $this->db
            ->where('id', $id)
            ->set('when_updated', 'NOW()', FALSE)
            ->update($this->table, $category);
    }
    
    public function delete($id)
    {
        $this->db->delete($this->table, [
            'id' => $id
        ]);
    }
}
?>