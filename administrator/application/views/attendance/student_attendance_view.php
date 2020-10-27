<div style="height: 100vh">
    <section class="sec search">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="text-align:center;margin-top:20px">
                    <h2 style="color:#26466D;">Student Attendance</h2>
                    <div class="orange_line2" style="margin-left:490px;width: 15%; margin-top:2px"></div>
                </div>
            </div>
            <div class="row" style="margin-top:30px; ">
                <form id="record_logs" class="form-inline" style="margin-left:70px">
                    <div class="col-md-3 col-sm-3">
                        <select name="class" id="classID" class="drop-down" style="width:100%">
                            <option hidden>Please Select Class</option>
                            <?php if (!empty($classes)) { ?>
                                <?php foreach ($classes as $class) { ?>
                                    <option value="<?php echo $class['class']; ?>" <?php echo ($edit == TRUE && $record_info['class'] == $class['class']) ? 'selected=selected' : ''; ?>><?php echo $class['class']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <select id="month_selection" name="month_selection" class="drop-down" style="width:100%">
                            <option hidden value="0">Please Select Month</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <?php
                    $yearArray = range(2020, 2040);
                    ?>
                    <div class="col-md-3 col-sm-3">
                        <select id="year_selection" name="year_selection" class="drop-down" style="width:100%">
                            <option value="$year">Select year</option>
                            <?php
                            foreach ($yearArray as $year) {
                                $selected = ($year == date("Y")) ? "selected" : " ";
                                echo "<option " . $selected . " value=$year>" . $year . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <button id="search" class="searchUserInput" type="button">SEARCH</button>
                        <!-- <button id="print-to-excel" class="print" type="button">Print</button> -->
                    </div>
                </form>




            </div>
            <br />
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-body">
                        <div class="alert"></div>
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
                                        <th style="background-color:#26466D; color:white ;width:25%;text-align:center">Student Name</th>
                                        <th style="background-color:#26466D; color:white ;width:12.5%;text-align:center">Class</th>
                                        <th style="background-color:#26466D; color:white ;width:12.5%;text-align:center">Month</th>
                                        <th style="background-color:#26466D; color:white ;width:12.5%;text-align:center">Year</th>
                                        <th style="background-color:#26466D; color:white ;width:12.5%;text-align:center">Lectures Uploaded</th>
                                        <th style="background-color:#26466D; color:white ;width:12.5%;text-align:center">View</th>
                                        <th style="background-color:#26466D; color:white ;width:12.5%;text-align:center">%</th>
                                        <!-- <th style="background-color:#26466D; color:white ;width:5%;text-align:center">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($records)) { ?>
                                        <?php foreach ($records as $record) { ?>
                                            <tr>
                                                <td><?php echo $record['student_name']; ?></td>
                                                <td style="text-align:center"><?php echo $record['class']; ?></td>
                                                <td style="text-align:center"><?php echo $record['month']; ?></td>
                                                <td style="text-align:center"><?php echo $record['year']; ?></td>
                                                <td style="text-align:center"><?php echo $record['total_lectures']; ?></td>
                                                <td style="text-align:center"><?php echo $record['viewed_lectures']; ?></td>
                                                <td style="text-align:center"><?php echo $record['percentage']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="7" style="text-align:center">Records Not Found.</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>


                    </div>
                    <!--panel-body-->

                    <!--panel-->
                </div>
            </div>
            <!--col9-->
            <div class="clearfix"></div>
        </div>
        <!--row-->
</div>
<!--container-->
</section>
</div>
<div class="clearfix"></div>
<div id="ajaxspinner" class="modal">
    <i class="fas fa-spinner fa-spin fa-3x fa-fw" style="display:none" "></i>
</div>
<!-- <i id=" ajaxspinner" class="fas fa-spinner "></i> -->