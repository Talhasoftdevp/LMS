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
                        <h4 class="panel-title">Write Message</h4>
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
                                <label class="control-label">Select Student <span class="required">*</span></label>
                                <select name="student_id" class="form-control" data-plugin-selecttwo="" id="students" data-width="100%" data-minimum-results-for-search="Infinity" tabindex="-1" aria-hidden="true">
                                    <option value="" selected="selected">Select Student</option>
                                    <?php if (!empty($students)) { ?>
                                        <?php foreach ($students as $student) { ?>
                                            <option value="<?php echo $student['student_id']; ?>" data-student_name="<?php echo $student['name']; ?>" data-student_class="<?php echo $student['class']; ?>"><?php echo $student['name']; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Select Teacher <span class="required">*</span></label>
                                <select name="teacher" class="form-control select2-hidden-accessible" data-plugin-selecttwo="" id="teachers" data-width="100%" data-minimum-results-for-search="Infinity" tabindex="-1" aria-hidden="true">
                                    <option value="" selected="selected">Select Teacher</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Subject <span class="required">*</span></label>
                                <input maxlength="50" id="subject" name="subject" type="text" class="form-control" value="">
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