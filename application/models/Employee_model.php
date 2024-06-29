<?php
class Employee_model extends CI_Model {

    public function get_all_employees() {
        $query = $this->db->get('employees');
        return $query->result();
    }
}
