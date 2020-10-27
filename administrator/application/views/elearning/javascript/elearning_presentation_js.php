<script src="<?php echo base_url(); ?>assets/js/ajax.submit/ajaximage/scripts/jquery.form.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ajax.submit/jquery.form.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.min.css" />
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $('.alert').hide();
    
$('.right_view').click(function(){
    
        if(this.checked == true){
        $(this).attr('value','1');
    }else if(this.checked == false){
        $(this).val('0');
    }
});
$('.right_add').click(function(){
    
        if(this.checked == true){
        $(this).attr('value','1');
    }else if(this.checked == false){
        $(this).val('0');
    }
});

$('.right_update').click(function(){
    
        if(this.checked == true){
        $(this).attr('value','1');
    }else if(this.checked == false){
        $(this).val('0');
    }
});

$('.right_delete').click(function(){
    
        if(this.checked == true){
        $(this).attr('value','1');
    }else if(this.checked == false){
        $(this).val('0');
    }
});


$('#submit_action').click(function(){
     $form = $('#<?php echo $this->uri->segment(2); ?>_form');
     $alert = $form.find('.alert');
     $action = $form.prop('action');
     $form.find('input,textarea,select');
     $serializeData = $form.find('input,textarea,select').serialize();
     
    $.ajax({
        type:'POST',
        url:$action,
        dataType:'json',
        data:$serializeData,
    }).success(function(data){
        if(data.success=='yes'){
            $alert.html(data.msg);
            $alert.addClass('alert-success');
            $alert.show('fast');
           setTimeout(function(){
			   if(data.send == 'no'){
               		window.location.reload(true);
			   }else{
				   window.location.replace(data.send);
			   }
           },500);
        }else if(data.success=='no'){
            $alert.html(data.msg);
            $alert.show('fast');
        }
    });
    return false;
});




        $('#id-input-file-1 , #id-input-file-2').ace_file_input({
            no_file: 'No File ...',
            btn_choose: 'Choose',
            btn_change: 'Change',
            droppable: false,
            onchange: null,
            thumbnail: false //| true | large
                    //whitelist:'gif|png|jpg|jpeg'
                    //blacklist:'exe|php'
                    //onchange:''
                    //
        });

        
        $('#id-input-file-3').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});


});

</script>
