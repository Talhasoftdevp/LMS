<link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap-custom.css') ?>" />
<!-- <link rel="stylesheet" href="<?php echo site_url('assets/font-awesome/4.2.0/font-awesome.min.css') ?>" /> -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" />

<?php
if ($this->session->userdata('user_role') == 'Admin') {
    $this->load->view('adminDashboard.php');
} else {
    $this->load->view('teacherDashboard.php');
}
