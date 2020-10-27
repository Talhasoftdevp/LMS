<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dynamic Gym</title>
<style>
 .slip-bg {
	width:700px;
	height:375px;
	margin-left:auto;
	margin-right:auto;
	background-repeat: no-repeat;
	background-position: center top;
	border: solid 1px #CCCCCC;
	margin-bottom:40px;
}
.logo {
	width:100%;
	height:76px;
	float:left;
	margin-left:40px;
	margin-top:20px;
}
.slip-left {
	width:350px;
	height:auto;
	float:left;
	margin-top:100px;

}
.slip-right {
	width:150px !important;
	height:100px !important;
	margin-left:70px;
	margin-top:40px;
	float:left;
}

.month-title {
	font-family:Georgia, "Times New Roman", Times, serif;
	font-size:18px;
	font-style: italic;
	line-height: 30px;
	color:#2e3192;
}
.signature {
	font-family:Georgia, "Times New Roman", Times, serif;
	font-size:18px;
	font-style: italic;
	line-height: normal;
	color:#2e3192;
	text-align:center;
    border-top:1px solid #afa7ce;
	height: auto;
	width: 100%;
	margin-top:60px;
}
.day {
	width:60px;
	height:auto;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: normal;
	color: #000000;
	text-decoration: none;
	padding: 5px;
	border: 1px solid #afa7ce;
	text-align: center;
	margin: 5px;
}

table {
	font-family:Georgia, "Times New Roman", Times, serif;
	font-size:18px;
	font-style: italic;
	color:#2e3192;
}
table input {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: normal;
	color: #333333;
	text-decoration: none;
	padding: 5px;
	width: 100%;
	border: 1px solid #afa7ce;
}

.border-bottom{
    border-bottom:1px solid afa7ce;
}
    
</style>
</head>
<body>
<div class="slip-bg">
    <table  border="0" width="100%"  align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
        	<div class="logo"><img src="<?php echo base_url();?>upload/profile/logo.png" /></div>
      
    </td>
    <td valign="top">
    <div class="slip-right">
        	<div class="month-title">For The Month of</div>
        	<div class="day">Jan</div>
<!--                <div class="day">Feb</div>
                <div class="day">Mar</div>
                <div class="day">April</div>
                <div class="day">May</div>
                <div class="day">Jun</div>
                <div class="day">July</div>
                <div class="day">Aug</div>
                <div class="day">Sep</div>
                <div class="day">Oct</div>
                <div class="day">Nov</div>
                <div class="day">Dec</div>-->
                
        	
            <div class="signature">Signature</div>
        </div>
    </td>
  </tr>
  
  <tr>
    <td valign="top">
       
      <div class="slip-left">
       	  <table  border="0" width="100%"  cellspacing="0" cellpadding="0">
            <tr>
              <td  height="10">S. No.</td>
            <td height="10">
                  00786 
            </td>
            </tr>
            <tr>
              <td  height="40" >Date</td>
              <td height="10" width="60%" >
               <div align="center" style="border-bottom:1px solid #afa7ce;"></div>
              </td>
            </tr>
              <tr>
                <td  height="40">Membership No.</td>
                <td height="10" width="60%">
                  <div align="center" style="border-bottom:1px solid #afa7ce;"></div>
                </td>
            </tr>
              <tr>
                <td  height="40">Addmission Fee</td>
                <td height="10" width="60%" >
                  <div align="center" style="border-bottom:1px solid #afa7ce;"></div>
                </td>
            </tr>
              <tr >
                <td  height="40">Amount in Words</td>
                <td height="10" width="60%" >
                    <div align="center" style="border-bottom:1px solid #afa7ce;"></div>
                </td>
            </tr>
        </table>

      </div>
    </td>
    <td valign="top">
    <div class="slip-right">
        	<div class="month-title">For The Month of</div>
        	<div class="day">Jan</div>
<!--                <div class="day">Feb</div>
                <div class="day">Mar</div>
                <div class="day">April</div>
                <div class="day">May</div>
                <div class="day">Jun</div>
                <div class="day">July</div>
                <div class="day">Aug</div>
                <div class="day">Sep</div>
                <div class="day">Oct</div>
                <div class="day">Nov</div>
                <div class="day">Dec</div>-->
                
        	
            <div class="signature">Signature</div>
        </div>
    </td>
  </tr>
</table>
</div>
</body>
</html>

<?php  
$contents = ob_get_contents();
ob_end_clean();
$this->dompdf->load_html($contents);
ob_end_clean();
$this->dompdf->set_paper('landscape','a4');
$this->dompdf->render();
$this->dompdf->stream(date('d-m-Y') . '_' . ".pdf", array('Attachment' => 0));
$this->dompdf->clear();
exit(0);
?>
