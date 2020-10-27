<div class="main-content">
    <div class="main-content-inner">

        <div class="page-content">

            <div class="row">
                <div class="col-xs-12">
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

                            <h4 class="widget-title lighter"></h4>

                            <div style="display:inline-block;float:right;margin:4px 6px 0px 0px ;">
                                <a href="<?php echo base_url($segment_1n2); ?>/create" class="btn btn-xs btn-success">
                                    Create Record
                                </a>
                            </div>
                        </div>
                        <!-- <div class="col-md-12" style="text-align:center;margin-top:20px">
                            <h2 style="color:#26466D;">E-Portal Users</h2>
                            <div class="orange_line2" style="margin-left:490px;width: 15%; margin-top:2px"></div>
                        </div> -->

                        <div class="widget-body">
                            <div class="widget-main">
                                <?php if (!empty($records)) { ?>
                                    <div class="alert alert-danger"></div>
                                    <table class="table table-striped table-bordered table-hover" id="simple-table">
                                        <thead>
                                            <tr>
                                                <!-- <th class="center" width="5%">
                                                    <label class="pos-rel">
                                                        <input type="checkbox" id="check_all" name="check_all" class="ace">
                                                        <span class="lbl"></span>
                                                    </label>
                                                </th> -->
                                                <th >Name</th>
                                                <th>Family Code</th>
                                                <th>Status</th>
                                                <th width="8%">Action</th>
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
                                                    <td><?php echo $record['user_name']; ?></td>
                                                    <td><?php echo $record['email']; ?></td>
                                                    <td><?php if ($record['status'] == 1) {
                                                            echo $isActive = 'Active';
                                                        } else {
                                                            echo $isActive = 'Not Active';
                                                        }   ?></td>
                                                    <td>
                                                        <?php include(APPPATH . 'views/crude.php'); ?>
                                                    </td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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