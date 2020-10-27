
<script src="<?php echo base_url(); ?>assets/mine/ajaximage/scripts/jquery.form.js"></script>

<script src="<?php echo base_url(); ?>assets/mine/jquery.form.min.js"></script>

<script>
   
	
		 $("#submit_action").click(function (event) {
            event.preventDefault(); // this does not work in IE 8
            event.returnValue = false;

           var $form = $("#form_<?php echo singular($this->uri->segment(2)); ?>");
            var $alert = $form.find('.alert');
            var $inputs = $form.find("input, select, button, textarea");
			
            ///var serializedData = $form.serialize();
            $alert.empty().hide('fast');
		    	
				$form.ajaxForm({
					type: $form.prop('method'),
               		url: $form.prop('action'),
					target:false,
					success:function(data){
						var obj= JSON.parse(data);
						if (obj.success === "no") {
							$alert.html(obj.msg);
							$alert.removeClass("alert-success");
						} else if (obj.success === "yes") {
							$alert.addClass("alert-success");
							$alert.html(obj.msg);
							<?php if($edit==TRUE){?>
							setTimeout(function () {
								window.location=obj.send;
							}, 1000);
							<?php }else{?>
								setTimeout(function () {
								window.location=obj.send;
							}, 1000);
							<?php 	}?>
						} else {
							$alert.html(obj);
							$alert.removeClass("alert-success");
						}
						$alert.show("fast");
            	
						}
					}).submit();
			
        });
		


	});



</script>