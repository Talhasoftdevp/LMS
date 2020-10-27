<section role="main" class="content-body">
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class=" col-md-4 col-sm-4 col-xs-12">
                <div class="panel panel-warning mailbox">
                    <div class="panel-heading">
                        <h3 class="panel-title">Mailbox</h3>
                    </div>
                    <div class="panel-body">
                        <!-- <a href="<?php echo base_url() . 'mail_box/mail_box/' ?>" class="btn btn-default btn-block mb-md"><i class="fa fa-envelope"></i> Compose</a> -->

                        <ul class="nav nav-pills nav-stacked">
                            <li class="">
                                <a href="<?php echo base_url() . 'mail_box/mail_box/inbox' ?>">
                                    <i class="fa fa-envelope"></i>
                                    Inbox
                                </a>
                            </li>
                            <li class="">
                                <a href="<?php echo base_url() . 'mail_box/mail_box/sent' ?>"> <i class="fa fa-share-square"></i>
                                    Sent
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h4 class="panel-title">Write Message</h4>
                        <div class="pull-right">
                            <button id="send_mail" type="button" name="send_mail" value="" class="btn btn-default btn-sm" style="background-color:#26466D !important; color:white;" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing">
                                <i class="fa fa-paper-plane"></i><span> Send</span>
                            </button>
                        </div>
                    </div>
                    <form id="mail_form" action="<?php echo base_url() . 'mail_box/mail_box/send_mail' ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        <input type="hidden" name="sender_role" value="Teacher">
                        <input type="hidden" name="reciever_role" value="Student">
                        <input type="hidden" name="sender_id" value="<?php echo $this->session->userdata('user_id') ?>">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label">Student Name <span class="required">*</span></label>
                                <input type="hidden" name="parent_id" value="<?php echo $parent_id ?>">
                                <input type="hidden" name="student_id" value="<?php echo $student_id ?>">
                                <input id="student_name_" name="student_name" type="text" class="form-control" readonly value="<?php echo urldecode($student_name) ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Student Class <span class="required">*</span></label>
                                <input id="student_class_" name="student_class" type="text" class="form-control" readonly value="<?php echo $student_class ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Subject <span class="required">*</span></label>
                                <input maxlength="50" id="subject" name="subject" type="text" class="form-control" readonly value="<?php echo $subject ?>">
                                <span class="error"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Message <span class="required">*</span></label>
                                <textarea maxlength="1000" id="message" name="message" type="text" class="form-control" rows="7"></textarea>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="ajaxspinner" class="modal">
        <i class="fas fa-spinner fa-spin fa-3x fa-fw" style="display:none" "></i>
    </div>
</section>