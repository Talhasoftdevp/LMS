<section role="main" class="content-body">
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class=" col-md-4 col-sm-4 col-xs-12">
                <div class="panel panel-warning mailbox">
                    <div class="panel-heading">
                        <h3 class="panel-title">Mailbox</h3>
                    </div>
                    <div class="panel-body">
                        <a href="<?php echo base_url() . 'mail/' ?>" class="btn btn-default btn-block mb-md"><i class="fa fa-envelope"></i> Compose</a>

                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <a href="<?php echo base_url() . 'mail/inbox' ?>">
                                    <i class="fa fa-envelope"></i>
                                    Inbox <span class="label text-weight-normal pull-right">0</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() . 'mail/sent' ?>"> <i class="fa fa-share-square"></i>
                                    Sent <span class="label text-weight-normal pull-right">0</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h4 class="panel-title"> Write Message</h4>
                        <div class="pull-right">
                            <button id="send_mail" type="submit" name="send_mail" value="" class="btn btn-default btn-sm" style="background-color:#26466D !important; color:white;" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing">
                                <i class="fa fa-paper-plane"></i> Send
                            </button>
                        </div>
                    </div>
                    <form id="mail_form" action="<?php echo base_url() . 'mail/send_mail' ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        <input type="hidden" name="sender_role" value="Student">
                        <input type="hidden" name="reciever_role" value="Teacher">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label">Student Name <span class="required">*</span></label>
                                <input type="hidden" name="student_id" value="<?php echo $student_id ?>">
                                <input type="hidden" name="student_class_" value="<?php echo $student_class ?>">
                                <input type="hidden" name="message_nature" value="REPLY">
                                <input id="student_name_" name="student_name_" type="text" class="form-control" readonly value="<?php echo urldecode($reciever_name) ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Teacher Name <span class="required">*</span></label>
                                <input id="teacher_name" name="teacher" type="text" class="form-control" readonly value="<?php echo urldecode($sender_name) ?>">
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