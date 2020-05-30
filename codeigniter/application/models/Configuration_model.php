<?php
class Configuration_model extends CI_Model {
    
    public function __construct()
    {
        $this->load->database();
    }
    
    private $table = 'configuration';
    
    public function get_configuration()
    {
        $query = $this->db->get($table);
        return $query->row_array();
    }
}
?>