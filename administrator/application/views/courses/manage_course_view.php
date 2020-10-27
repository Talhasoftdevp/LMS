<div class="main-content">
    <div class="main-content-inner">

        <div class="page-content">

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="widget-box">
                        <div class="widget-header widget-header-blue widget-header-flat">
                            <ul class="breadcrumb" style="margin: 6px 22px 0 0 !important;">
                                <li>
                                    <i class="ace-icon fa fa-home home-icon"></i>
                                    <a href="#">Home</a>
                                </li>

                                <li>
                                    <a href="#"><?php echo ucfirst($this->uri->segment(1)); ?></a>
                                </li>
                                <li class="active"><?php echo $title; ?></li>
                            </ul><!-- /.breadcrumb -->
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <?php if (!empty($records)) { ?>
                                    <div class="alert alert-danger"></div>
                                    <div class="table-responsive">

                                        <table class="table table-striped table-bordered table-hover" id="simple-table">
                                            <thead>
                                                <tr>
                                                    <!-- <th class="center" width="5%">
                                                    <label class="pos-rel">
                                                        <input type="checkbox" id="check_all" name="check_all" class="ace">
                                                        <span class="lbl"></span>
                                                    </label>
                                                </th> -->
                                                    <th style="background-color:#26466D; color:white;text-align:center">Name</th>
                                                    <th style="background-color:#26466D; color:white ;text-align:center">Class</th>
                                                    <th style="background-color:#26466D; color:white ;text-align:center">Added on</th>
                                                    <th style="background-color:#26466D; color:white ;text-align:center">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($records as $record) { ?>

                                                    <tr>
                                                        <!-- <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" class="ace case" name="case" value="<?php echo $record[$row_id]; ?>">
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td> -->
                                                        <td><?php echo $record['name']; ?></td>
                                                        <td style="text-align:center"><?php echo $record['class']; ?></td>
                                                        <td style="text-align:center">
                                                            <?php
                                                            if ($record['inserted_on'] != '0000-00-00 00:00:00') {
                                                                $dt = new DateTime($record['inserted_on']);
                                                                $date = $dt->format('d-m-y');
                                                                echo $date;
                                                            } else {
                                                                echo '00-00-0000';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td style="text-align:center">
                                                            <?php include(APPPATH . 'views/crude_course.php'); ?>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } else { ?>
                                    <div class="padding_null">
                                        <b>Records Not Found.</b>
                                    </div>
                                <?php } ?>
                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->