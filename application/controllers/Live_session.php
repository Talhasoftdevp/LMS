<?php
class live_session extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Live_session_model');
        // $this->load->model('Elearning_model');
        // $this->load->model(__CLASS__ . '_model');
        // $this->table_name = humanize(lcfirst(__CLASS__));
        // $this->row_id = singular(lcfirst(__CLASS__ . '_id'));
        // $this->data['title'] = __CLASS__;
    }

    public function index()
    {
        $this->data['records'] =  $this->Live_session_model->live_session_records_list_view();
        $this->load_views($this->data);
    }

    function fetch_live_sessions($calenderViewName)
    {
        //print_r($calenderViewName);
        $event_data =  $this->Live_session_model->live_session_records_calendar_view();

        $data = array();

        if ($calenderViewName == 'listMonth') {
            foreach ($event_data as $row) {
                $data[] = array(
                    'id' => $row['record_id'],
                    'description' =>   "DESCRIPTION",
                    'title' =>  "Class:" . "  " . $row['class'] . "
                                 Subject:" . "  " . $row['subject'] . "
                                 Date:" . " " . $row['date'] . "
                                 Start Time : " . date('g:ia', strtotime($row['start_time'])) . "  
                                 End Time : " . date('g:ia', strtotime($row['end_time'])) . "
                                 Teacher Name:" . $row['teacher_name'],
                    'url' => $row['session_id'],
                    'start' => $row['date'],
                    'end' => $row['date'],
                    'allDay' => FALSE
                );
            }
        } else {
            foreach ($event_data as $row) {
                // print_die($row);
                // echo '<pre>';
                // print_r($row);
                // $start_time = $row['start_time'] - ($row['start_time'] % 60);
                $data[] = array(
                    'id' => $row['record_id'],
                    // 'title' =>   "TALHA",
                    'description' =>   "DESCRIPTION",
                    'title' =>   date('g:ia', strtotime($row['start_time'])) . "   " . $row['subject'],
                    'url' => $row['session_id'],
                    'start' => $row['date'],
                    'end' => $row['date'],
                    'allDay' => TRUE
                    // 'start' => $row['start_time'],
                    // 'end' => $row['end_time']
                );
            }
        }



        echo json_encode($data);
        // print_die(json_encode($data));
    }
}
