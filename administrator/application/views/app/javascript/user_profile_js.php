<script src="<?php echo base_url(); ?>assets/js/ajax.submit/ajaximage/scripts/jquery.form.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ajax.submit/jquery.form.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.min.css" />
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.min.js"></script>

<script>
    $(document).ready(function () {
        $('.datepicker').datepicker();
        $('.alert').css('display','none');
        $("#submit_action").click(function (event) {
            event.preventDefault(); // this does not work in IE 8
            event.returnValue = false;
            var $form = $("#<?php echo $this->uri->segment(2); ?>_form");
            var $alert = $form.find('.alert');
            var $inputs = $form.find("input, select, button, textarea");
            ///var serializedData = $form.serialize();
            $alert.empty().hide('fast');
            $form.ajaxForm({
                type: $form.prop('method'),
                url: $form.prop('action'),
                dataType: 'json',
                target: false,
                success: function (data) {
                    // var obj = JSON.parse(data);
                    if (data.success === "no") {
                        $alert.html(data.msg);
                        $alert.removeClass("alert-success");
                    } else if (data.success === "yes") {
                        $alert.addClass("alert-success");
                        $alert.html(data.msg);
<?php if ($edit == TRUE) { ?>
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
<?php } else { ?>
                            setTimeout(function () {
                                window.location = '<?php echo base_url($segment_1n2); ?>';
                            }, 1000);
<?php } ?>
                    } else {
                        $alert.html(data);
                        $alert.removeClass("alert-success");
                    }
                    $alert.show("fast");
                }
            }).submit();
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