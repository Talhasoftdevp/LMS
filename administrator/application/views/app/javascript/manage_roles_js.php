<script type="text/javascript">
$(document).ready(function(){
alert('dadas');

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


$('.submit_action').click(function(e){

       e.preventDefault();
          $form=$('#<?php echo $this->uri->segment(2);?>_form');
          $alert=$form.find('.alert');
          $action=$form.prop('action');
		  alert($action);
          $form.find('input,textarea');
          $serializeData=$form.find('input,textarea').serialize();
         //alert('das');
           $.ajax({
              type:'POST',
              url:$action,
              data:$serializeData,
              datatype:'json',
              success:function(data){
                 //console.log(data);
                 //alert(data);
                var data= JSON.parse(data);
                if(data.success == 'yes'){
                    
                    $alert.html(data.msg);
                    $alert.addClass('alert-success');
                    $alert.show();
                    
                   setTimeout(function(){
                    $('#myModal').modal('toggle');   
                    window.location.reload();
                   },1000) 
                }else if(data.success == 'no'){
                    $alert.html(data.msg);
                    $alert.removeClass('alert-success');
                    $alert.show();
                } 
              }
              
          });
   });


$('.edit_roles').click(function(){
    var record_id=$(this).attr('data-id');
    $('#<?php echo $this->uri->segment(2);?>_form').attr('action','<?php echo base_url($segment_1n2);?>/update');
    
    $.ajax({
       type:'POST', 
       url:'<?php echo base_url($segment_1n2);?>/edit',
       data:{record_id:record_id},
       success:function(data){
          var obj=JSON.parse(data);
          $('input[name=roles]').val(obj.role_name);
          $('#record_id').val(obj.record_id);
          $('#description').val(obj.description);
          $('#myModalLabel').html('Edit Roles');
          $('#tbody').html(obj.rights);
          
          
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

          
       }        
    });
});

});

</script>
