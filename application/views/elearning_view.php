<section class="div-height">
    <div class="body">
        <?php if ($this->session->userdata('is_elearn_logged_in') == FALSE) { ?>
            <?php if ($this->session->flashdata('msg')) { ?>
                <div class="alert show <?php echo ($this->input->get('msg') == 'logout') ? 'alert-success' : 'alert-danger'; ?>">
                    <a class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </a>
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
            <?php } ?>
            <div class="form">
                <?php echo form_open(base_url() . 'elearning/in', array('id' => 'user_login')); ?>
                <h2>Login</h2>
                <input value="" name="email" type="text" placeholder="Family Code" />
                <input value="" name="password" type="password" placeholder="Password" />
                <button type="submit" name="button">Login</button>
                <?php echo form_close(); ?>
            </div>
        <?php } else { ?>
            <!-- <h4>welcome!</h4>
            <div class="orange_line2"></div>
            <h6>Hi, &nbsp;&nbsp;<?php //echo $this->session->userdata('e_portal_user_name'); 
                                ?></h6> -->
            <br />
            <?php redirect('/student_dashboard/');  ?>


        <?php } ?>


    </div>
</section>