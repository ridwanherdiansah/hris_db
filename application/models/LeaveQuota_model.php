<?php
class LeaveQuota_model extends CI_Model {

    public function get_leave_quota($employee_id, $year) {
        $this->db->where('employee_id', $employee_id);
        $this->db->where('year', $year);
        $query = $this->db->get('leavequotas');
        return $query->row();
    }

    public function update_used_days($employee_id, $year, $days) {
        $this->db->set('used_days', 'used_days + ' . (int)$days, FALSE);
        $this->db->where('employee_id', $employee_id);
        $this->db->where('year', $year);
        return $this->db->update('leavequotas');
    }
}
