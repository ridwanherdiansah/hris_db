<?php
class Leave_model extends CI_Model {

    public function insert_leave($data) {
        return $this->db->insert('leaves', $data);
    }

    public function get_all_cuti() {
        $query = $this->db->get('leaves');
        return $query->result();
    }

    public function update_used_days($employee_id, $used_days) {
        $leave_quotas = $this->db->select('used_days')->from('leavequotas')->where('employee_id', $employee_id)->get();
        $employee = (count($leave_quotas->result_object()) > 0 ? $leave_quotas->result_object()[0] : null );
        if(!$employee){
            return;
        }

        $dbUseDays = $employee->used_days;
        // exit;
        $this->db->set('used_days', $dbUseDays + $used_days);
        $this->db->where('employee_id', $employee_id);
        return $this->db->update('leavequotas');
    }
}
