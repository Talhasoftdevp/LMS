<script src="<?php echo base_url(); ?>assets/js/ajax.submit/ajaximage/scripts/jquery.form.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ajax.submit/jquery.form.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.min.css" />
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.min.js"></script>
<link rel="stylesheet" href="cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" />
<script src="cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-data-table/data-table.css" />
<script src="<?php echo base_url(); ?>assets/jquery-data-table/data-table.js"></script>
<script>
    $(document).ready(function() {
        var maxField = 12;
        var wrapper = $('.field_wrapper');
        var counter = 1;
        $('.datepicker').datepicker();
        $('.alert').css('display', 'none');
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
        $('#simple-table').DataTable({
            "language": {
                "search": "_INPUT_", // Removes the 'Search' field label
                "searchPlaceholder": "Search" // Placeholder for the search box
            },
            "aaSorting": [],
            "pagingType": "full_numbers"
        });


        $('.add').click(function() {
            var Subject = $('#subject_').val();
            $('#subject_').val("");
            var fieldHTML = '<div><input type="text" name="subject[]" value="' + Subject + '" placeholder="Please Input Value for Subject" class="col-xs-10 col-sm-10 add-subject"/>&nbsp; <button data-id="1" type="button" class="btn btn-danger btn-sm remove_button remove-button-alignmnet">Remove</button></div>';

            if (counter < maxField) {
                counter++; //Increment field counter
                $(wrapper).append(fieldHTML);
            }

        });
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            counter--; //Decrement field counter
        });
        // $('.remove').click(function() {
        //     $('#row_' + $(this).attr('data-id')).remove();
        // });
        $(document).ready(function() {
            $('#simple-table').DataTable();
        });

    });
</script>