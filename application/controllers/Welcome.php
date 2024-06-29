<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Employee_model');
        $this->load->helper(array('form', 'url'));
        $this->load->model('Holiday_model');
        $this->load->model('Leave_model');
        $this->load->model('LeaveQuota_model');
        $this->load->library('form_validation', 'session');
    }
	
    public function index() {
        $data['employees'] = $this->Employee_model->get_all_employees();
        $this->load->view('leave_form', $data);
    }

    private function holiday(){

    }

    public function submit_leave_request()
    {
        
        
        $this->form_validation->set_rules('employee_id', 'Employee', 'required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'End Date', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $employee_id = $this->input->post('employee_id');
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $location = $this->input->post('location');
            
            $start = new DateTime($start_date);
            $end = new DateTime($end_date);
            $interval = $start->diff($end);
            $total_leave_days = $interval->days + 1;
            $quota = $this->LeaveQuota_model->get_leave_quota($employee_id, date('Y'));
            
            if(($quota->total_days - $quota->used_days) <= 0){

                $this->session->set_flashdata('message', 'Kuota cuti tidak mencukupi.');
                redirect('/');
                return;
            }

            list($tahunStartDate, $bulanStartDate, $tanggalStartDate) = explode('-', $start_date);
            list($tahunEndDate, $bulanEndDate, $tanggalEndDate) = explode('-', $end_date);

            $totalLibur = 0;
            for($i = 1; $i<= $total_leave_days; $i++){

                // Memisahkan tahun, bulan, dan tanggal
                $year = $start->format('Y');
                $month = $start->format('m');
                $date = $start->format('d');
                
                $count = $this->Holiday_model->getTotalHolidays($year, $month, $date);
                if($count >= 1){
                    $totalLibur++;
                }
                $start = $start->modify("+1 day");

            }

            $totalLamaCuti = $total_leave_days - $totalLibur;
                $data = array(
                    'employee_id' => $employee_id,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'location' => $location,
                    'status' => 'Pending'
                );

                if ($this->Leave_model->insert_leave($data)) {
                    $this->LeaveQuota_model->update_used_days($employee_id, date('Y'), $total_leave_days);
                    $this->Leave_model->update_used_days($employee_id, $totalLamaCuti);
                    $this->session->set_flashdata('message', 'Permintaan cuti berhasil dikirim.');
                } else {
                    $this->session->set_flashdata('message', 'Terjadi kesalahan saat mengirim permintaan cuti.');
                }

            redirect('/welcome/listCuti');

        }
    }

    public function listCuti() {
        $data['cuti'] = $this->Leave_model->get_all_cuti();
        $this->load->view('listCuti', $data);
    }
}
