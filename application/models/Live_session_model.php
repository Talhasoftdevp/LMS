<?php


class Live_session_model extends MY_Model
{
    //put your code here

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'live_sessions';
    }

    public function live_session_records_list_view()
    {
        $date = date('yy-m-d');
        $this->db->from($this->table_name);
        $this->db->where("date >=", $date);
        $this->db->order_by("date", 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function live_session_records_calendar_view()
    {
        $this->db->from($this->table_name);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function live_session_record($record_id)
    {
        $this->db->from($this->table_name);
        $this->db->where('record_id', $record_id);
        $query = $this->db->get();
        return $query->row_array();
    }
}
