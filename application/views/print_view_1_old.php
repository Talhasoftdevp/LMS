<html>
    <head>
        <title>Fee Challan</title>
        <link rel="icon" href="<?php echo base_url(); ?>assets/mine/myicons/favicon.ico" type="image/x-icon" />
        <link href="<?php echo base_url(); ?>assets/mine/my_screen_report_styles.css" media="screen" rel="stylesheet" type="text/css" />
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                font-weight:normal !important;
                font-size:12px !important;
                color: #000000;
                text-decoration: none;
            }
            .border-2 {
                border-top-width: 1px;
                border-bottom-width: 1px;
                border-top-style: solid;
                border-bottom-style: solid;
                border-top-color: #000000;
                border-bottom-color: #000000;
                margin-bottom: 0px;
            }
            .border-3 {
                border-bottom-width: 2px;
                border-bottom-style: solid;
                border-bottom-color: #000000;
                margin-top: 0px;
                margin-bottom: 0px;
                width:100%;

            }
            .border-4 {
                border-top-width: 1px;
                border-top-style: solid;
                border-top-color: #000000;
                margin-top: 0px;
                margin-bottom: 4px;
                width:100%;
            }
            .border-left {
                margin-top: 0px;
                margin-left: 10px;
                width:100%;
                padding-right:10px;
                border-right-width: 1px;
                border-right-style: dashed;
                border-right-color: #000000;
                min-height:800px !important;
                height:auto;
            }
            .border-right{
                border-left-width: 1px;
                border-left-style: solid;
                border-left-color: #CCC;
                border-top-width: 1px;
                border-top-style: solid;
                border-top-color: #CCC;
               
            }
            .border-right-2{
                border-right-width: 1px;
                border-right-style: solid;
                border-right-color: #CCC;
               border-top-width: 1px;
                border-top-style: solid;
                border-top-color: #CCC;
               
            }
            .border-top1{
                margin-top: 0px;
                margin-left: 10px;
                width:50%;
                border-top-width: 1px;
                border-top-style: solid;
                border-top-color: #000000;
                text-align:left;
                margin-bottom: 5px;
                line-height : 50px !important;	
            }
            .space{
                padding-top:50px !important;	
            }
            .detail-new{
                //min-height:500px !important;
                height:10%;
            }	

        </style>
    </head>
    <body>
        
        <?php if ($print == 'first_challan') { ?>
            <table width="100%" border="0"  cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" valign="top"></td>
                    <td align="center" valign="top">
                        <div class="border-left border-right">

                            <?php echo td_frist_challan($record_info, 'Student Copy'); ?>
                        </div>
                    </td>   

                    <td  align="center" valign="top"></td>

                    <td align="center" valign="top">
                        <div class="border-right-2">
                            <?php echo td_frist_challan($record_info, 'School Copy'); ?>
                        </div>
                    </td>
                    <td  align="center" valign="top"></td>       
                </tr>
            </table>
        <?php } ?>

        <?php

        function td_frist_challan($record, $copy) { ?>


            <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                <tbody><tr>
          <!--        <td width="30%" align="center"><img width="75px" height="75px" src="<?php echo base_url($segment_1n2); ?>/uploads/students/<?php echo $all['logo']; ?>"></td>-->
                        <td align="center">
                            <?php echo 'Dynamic Gym' ?><br>
                            <?php echo "dasssadsddsds"; ?><br>
                            <?php echo "dasssadsddsds"; ?> 
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="center">&nbsp;</td>
                    </tr>
                </tbody>
            </table>
            <div class="border-2">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">

                    <tbody><tr>
                            <td width="60%" height="25" class="align-left"><span class="slip-left">Slip ID: <?php echo $record['registration_id']; ?></span></td>
                            <td height="25" align="right" class="align-right"><?php  echo $copy;   ?></td>
                        </tr>
                    </tbody></table>
            </div>
            <table width="100%" cellspacing="0" cellpadding="4" border="0">
                <tbody><tr>
                        <td width="60%" class="align-left">Issue Date</td>
                        <td align="right" class="align-right"><?php echo date('d-M-Y'); ?></td>
                    </tr>
                    <tr>
                        <td width="60%" class="align-left">Class</td>
                        <td align="right" class="align-right"><?php //// echo $all['student_detail']['class_name'];   ?></td>
                    </tr>
                    <tr>
                        <td width="60%" class="align-left">Reg.No</td>
                        <td align="right" class="align-right"><?php echo $record['grn'];?></td>
                    </tr>
                    <tr>
                        <td width="60%" class="align-left">Name</td>
                        <td align="right" class="align-right"><?php echo $record['name']; ?></td>
                    </tr>
                    <tr>
                        <td width="60%" class="align-left">Father Name</td>
                        <td align="right" class="align-right"><?php echo $record['father_name'];   ?></td>
                    </tr>
                </tbody></table>
            <div class="border-3">&nbsp;</div>
            <table width="100%" cellspacing="0" cellpadding="5" border="0">
                <tbody><tr>
                        <td class="align-left">Details</td>
                        <td width="20%" align="center" class="align-right"></td>
                        <td width="25%" align="right" class="align-right">Amount</td>
                    </tr>
                </tbody></table>
            <div class="border-4">&nbsp;</div>
            <div class="detail-new">
                <div class="">
                    <table width="100%" cellspacing="0" cellpadding="5" border="0">
                        <tbody><tr>
                                <td class="align-left"><?php echo ucfirst($record['type']);    ?></td>
                                <td width="20%" align="center" class="align-right"></td>
                                <td width="25%" align="right" class="align-right"><?php echo $record['fee_amount'];   ?></td>
                            </tr>
                        </tbody></table>
                </div></div>
            <div class="border-3">&nbsp;</div>
            <div class="border-4">
                <table width="100%" cellspacing="0" cellpadding="5" border="0">
                    <tbody><tr>
                            <td><b>Total</b></td>
                            <td width="2%">&nbsp;</td>
                            <td align="right"> <b><?php echo $record['fee_amount'];?></b></td>
                        </tr>
                    </tbody></table>
            </div>
            <div class="border-4">
                <table width="100%" cellspacing="0" cellpadding="5" border="0">
                    <tbody><tr>
                            <td width="25%">Due Date</td>
                            <td width="25%"><?php echo date('Y-m-d', strtotime('+5days')); ?></td>
                            <td width="25%">Before Due</td>
                            <td width="25%" style="text-align:right;"><?php echo date('Y-m-d'); ?></td>
                        </tr>
                    </tbody></table>
            </div>

            <div class="space">
                <table width="100%" cellspacing="0" cellpadding=20" border="0">
                    <tbody><tr>
                      <td width="40%" style="border-top:1px solid #000;"><!--<p class="border-top1">--->Cashier<!--</p>--></td>
                            <td width="10%">&nbsp;</td>
                            <td width="40%" style="text-align:right;border-top:1px solid #000;"><!--<p class="border-top1">-->Officer<!--</p>--></td>
                        </tr>
                    </tbody></table>
            </div>


        <?php }
        ?>
    </body>
</html>
<?php
$contents = ob_get_contents();
ob_end_clean();
$this->dompdf->load_html($contents);
ob_end_clean();
$this->dompdf->set_paper('a4');
$this->dompdf->render();
$this->dompdf->stream(date('d-m-Y') . '_' . ".pdf", array('Attachment' => 0));
$this->dompdf->clear();
exit(0);
?>
