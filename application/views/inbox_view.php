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
                            <li class="">
                                <a href="<?php echo base_url() . 'mail/inbox' ?>">
                                    <i class="fa fa-envelope"></i>
                                    Inbox <span class="label text-weight-normal pull-right">0</span>
                                </a>
                            </li>
                            <li class="">
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
                        <h4 class="panel-title">Inbox</h4>
                    </div>
                    <div class="table-responsive" style="padding: 10px;">
                        <table class="table table-striped table-bordered table-hover" id="simple-table">
                            <thead>
                                <tr>
                                    <!-- <th class="center" width="5%">
                                            <label class="pos-rel">
                                                <input type="checkbox" id="check_all" name="check_all" class="ace">
                                                <span class="lbl"></span>
                                            </label>
                                        </th> -->
                                    <th style="background-color:#26466D; color:white ;width:25%;text-align:center">Sender</th>
                                    <th style="background-color:#26466D; color:white ;width:20%;text-align:center">Class</th>
                                    <th style="background-color:#26466D; color:white ;width:25%;text-align:center">Subject</th>
                                    <th style="background-color:#26466D; color:white ;width:15%;text-align:center">Date</th>
                                    <th style="background-color:#26466D; color:white ;width:15%;text-align:center">Action</th>
                                    <!-- <th style="background-color:#26466D; color:white ;width:5%;text-align:center">Action</th> -->
                                </tr>
                            </thead>
                            <tbody id="logs">
                                <?php foreach ($inbox as $inbox_data) { ?>
                                    <tr>
                                        <!-- <td class="center">
                                                <label class="pos-rel">
                                                    <input type="checkbox" class="ace case" name="case" value="1">
                                                    <span class="lbl"></span>
                                                </label>
                                            </td> -->
                                        <td><?php echo $inbox_data['sender_name']; ?></td>
                                        <td><?php echo $inbox_data['reciever_class']; ?></td>
                                        <td><?php echo $inbox_data['subject']; ?></td>
                                        <td style="text-align:center">
                                            <?php
                                            if ($inbox_data['inserted_on'] != '0000-00-00 00:00:00') {
                                                $dt = new DateTime($inbox_data['inserted_on']);
                                                $date = $dt->format('d-m-y');
                                                echo $date;
                                            } else {
                                                echo '00-00-0000';
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align:center">
                                            <button type="button" data-id="<?php echo $inbox_data['id'] ?>" class="btn btn-info btn-sm active message_preview" data-toggle="modal" data-target="#view_message_<?php echo $inbox_data['id'] ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm active"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <div class="modal" id="view_message_<?php echo $inbox_data['id'] ?>" data-backdrop="false" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Message Preview</h5>

                                                </div>
                                                <form class="form-horizontal" enctype="multipart/form-data" id="submit" action="" method="post" role="form">
                                                    <div style="padding: 10px;">
                                                        <label class="control-label">Message <span class="required">*</span></label>
                                                        <textarea readonly id="message" name="message_preview" type="text" class="form-control" rows="7"><?php echo $inbox_data['message']; ?></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success active" onclick='window.location.href="<?php echo base_url() . "mail/reply/" . $inbox_data["reciever_name"] . "/" . $inbox_data["sender_name"] . "/" . $inbox_data["subject"] . "/" . $inbox_data["sender_id"]  . "/" . $inbox_data["sender_class"] ?>"'>Reply</button>
                                                        <button type="button" class="btn btn-dark " data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>