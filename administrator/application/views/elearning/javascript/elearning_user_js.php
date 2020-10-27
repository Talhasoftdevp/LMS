<script src="<?php echo base_url(); ?>assets/js/ajax.submit/ajaximage/scripts/jquery.form.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ajax.submit/jquery.form.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.min.css" />
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-data-table/data-table.css" />
<script src="<?php echo base_url(); ?>assets/jquery-data-table/data-table.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        var index = 1;
        var indexToRemove;
        var counter = 1;
        var maxField = 6;
        var div = '<div class="container"></div>'
        var button = '<button data-id="1" type="button" class="btn btn-danger btn-xs remove_button" id="removeRow" style="left:1%;height:29px;">Remove</i></button>'

        $('.alert').hide();

        $('.datepicker').datepicker({
            format: 'yyyy-m-d',
        });

        $('.right_view').click(function() {
            if (this.checked == true) {
                $(this).attr('value', '1');
            } else if (this.checked == false) {
                $(this).val('0');
            }
        });
        $('.right_add').click(function() {

            if (this.checked == true) {
                $(this).attr('value', '1');
            } else if (this.checked == false) {
                $(this).val('0');
            }
        });

        $('.right_update').click(function() {

            if (this.checked == true) {
                $(this).attr('value', '1');
            } else if (this.checked == false) {
                $(this).val('0');
            }
        });

        $('.right_delete').click(function() {

            if (this.checked == true) {
                $(this).attr('value', '1');
            } else if (this.checked == false) {
                $(this).val('0');
            }
        });
        $('#simple-table').DataTable({
            "language": {
                "search": "_INPUT_", // Removes the 'Search' field label
                "searchPlaceholder": "Search" // Placeholder for the search box
            },
            "pagingType": "full_numbers"
        });

        $('#submit_action').click(function() {
            $('#submit_action').attr("disabled", "");
            $form = $('#<?php echo $this->uri->segment(2); ?>_form');
            $alert = $form.find('.alert');
            $action = $form.prop('action');
            $form.find('input,textarea,select');
            $serializeData = $form.find('input,textarea,select').serialize();

            $.ajax({
                type: 'POST',
                url: $action,
                dataType: 'json',
                data: $serializeData,
                beforeSend: function() {
                    $('#ajaxspinner').show();
                },
                complete: function() {
                    $('#ajaxspinner').hide();
                },
            }).success(function(data) {
                $('#submit_action').removeAttr("disabled");
                if (data.success == 'yes') {
                    $alert.html(data.msg);
                    $alert.addClass('alert-success');
                    $alert.show('fast');
                    setTimeout(function() {
                        if (data.send == 'no') {
                            window.location.reload(true);
                        } else {
                            window.location.replace(data.send);
                        }
                    }, 500);
                } else if (data.success == 'no') {
                    $alert.html(data.msg);
                    $alert.show('fast');
                }
            });
            return false;
        });

        $("#addAnother").click(function() {
            var id = $('#count').val();
            var studentName = $('#student_name').val();
            var classEnrolled = $('#class option:selected').text();
            $('#childs').append('<tr id="row_' + id + '"> <td valign="middle">' + studentName + '<input type="hidden" class="col-xs-10 col-sm-10" name="student_name[]" value="' + studentName + '"/></td> <td valign="middle">' + classEnrolled + '<input type="hidden" class="col-xs-10 col-sm-10" name="class[]" value="' + classEnrolled + '"/></td> <td><button data-id="' + id + '" type="button" class="btn btn-danger btn-xs remove"><i class="fa fa-trash"></i></button></td> </tr>');
        });

        $("#container").on('click', '.remove_button', function(event) {
            var idToRemove = $(this).closest('div.DDL').attr('id');
            $("#" + idToRemove).remove();
            counter--; //Decrement field counter
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

        $('.add').click(function() {
            var id = $('#count').val();
            var presentation_id = parseInt($('#press_id').val());
            var text = $('#press_id option:selected').text();
            var expiry = $('#exp_date').val();
            id++;
            $('#count').val(id);
            $('#press').append('<tr id="row_' + id + '"> <td valign="middle">' + text + '<input type="hidden" class="col-xs-10 col-sm-10" name="presentation_id[]" value="' + presentation_id + '"/></td> <td valign="middle">' + expiry + '<input type="hidden" class="col-xs-10 col-sm-10" name="expiry[]" value="' + expiry + '"/></td> <td valign="middle"><span class="label label-success label-xs">New</span></td> <td><button data-id="' + id + '" type="button" class="btn btn-danger btn-xs remove"><i class="fa fa-trash"></i></button></td> </tr>');

            $('.remove').click(function() {
                $('#row_' + $(this).attr('data-id')).remove();
            });
        });

        $('.remove').click(function() {
            $('#row_' + $(this).attr('data-id')).remove();
        });


        $('#id-input-file-3').ace_file_input({
            style: 'well',
            btn_choose: 'Drop files here or click to choose',
            btn_change: null,
            no_icon: 'ace-icon fa fa-cloud-upload',
            droppable: true,
            thumbnail: 'small' //large | fit
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
            preview_error: function(filename, error_code) {
                //name of the file that failed
                //error_code values
                //1 = 'FILE_LOAD_FAILED',
                //2 = 'IMAGE_LOAD_FAILED',
                //3 = 'THUMBNAIL_FAILED'
                //alert(error_code);
            }

        }).on('change', function() {
            //console.log($(this).data('ace_input_files'));
            //console.log($(this).data('ace_input_method'));
        });


    });
</script>