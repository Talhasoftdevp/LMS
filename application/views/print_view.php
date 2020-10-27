<html>
    <title>Fee Challan</title>
    <link rel="icon" href="<?php echo base_url(); ?>assets/mine/myicons/favicon.ico" type="image/x-icon" />
    <link href="<?php echo base_url(); ?>assets/mine/my_screen_report_styles.css" media="screen" rel="stylesheet" type="text/css" />
    <body>
        <?php if ($print == 'first_challan') { ?>
            <table width="100%" border="1" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" valign="top">
                    <td align="center" valign="top">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                            <tr>
                                <td align="center">
                                    <?php echo "daaaaaaaaaaaaa"; ?><br>
                                    <?php echo "dasssadsddsds"; ?>
                                    <?php echo "dasssadsddsds"; ?> 
                                </td>
                            </tr>
                        </table>
                        <div class="border-2">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">

                                <tbody><tr>
                                        <td width="60%" height="25" class="align-left"><span class="slip-left">Slip ID: <?php //echo $slip_id; ?></span></td>
                                        <td height="25" align="right" class="align-right"><?php // echo $copy; ?></td>
                                    </tr>
                                </tbody></table>
                        </div>
                    </td>
                    <td align="center" valign="top">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                            <tr>
                                <td align="center">
                                    <?php echo "daaaaaaaaaaaaa"; ?><br>
                                    <?php echo "dasssadsddsds"; ?>
                                    <?php echo "dasssadsddsds"; ?> 

                                </td>
                            </tr>
                        </table>
                        <div class="border-2">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tbody><tr>
                                        <td width="60%" height="25" class="align-left"><span class="slip-left">Slip ID: <?php //echo $slip_id;  ?></span></td>
                                        <td height="25" align="right" class="align-right"><?php // echo $copy;  ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>

                </tr>
            </table>
        <?php } ?>

    </body>
</html>
<?php
$contents = ob_get_contents();
ob_end_clean();
$this->dompdf->load_html($contents);
ob_end_clean();
$this->dompdf->set_paper('a4', 'landscape');
$this->dompdf->render();
$this->dompdf->stream(date('d-m-Y') . '_' . ".pdf", array('Attachment' => 0));
$this->dompdf->clear();
exit(0);
?>
