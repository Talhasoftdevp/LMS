<script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ajax.submit/jquery.form.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/mine/datepicker/css/datepicker.css" />
<script src="<?php echo base_url(); ?>assets/mine/datepicker/js/bootstrap-datepicker.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/full_calender.js"></script> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.8.1/dist/sweetalert2.all.min.js"></script> -->
<script src="<?php echo base_url(); ?>assets/sweet-alert/sweet-alert-2.js"></script>
<!--<script type="text/javascript" src="jquery-2.0.3.js"></script>-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/countdowntimer/CSS/jquery.countdownTimer.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/countdowntimer/jquery.countdownTimer.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-data-table/data-table.css" />
<script src="<?php echo base_url(); ?>assets/jquery-data-table/data-table.js"></script>
<script type="text/javascript">
    /* 
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    $(document).ready(function() {
        // alert("TESTxdsacmdsc")
        var button_value = '';
        $('#calendar_2').hide();
        //$('#calendar_1').show();
        //$('#calendar_2').hide();
        $(".modal").on('shown', function() {
            alert("I want this to appear after the modal has opened!");
        });
        $('#month_view').click(function(event) {
            $('#calendar_2').hide();
            $('#calendar_1').show();
            $('#calendar_1').fullCalendar({
                defaultView: 'month',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                viewRender: function(view) {
                    return view.name
                },
                events: "<?php echo base_url(); ?>live_session/fetch_live_sessions/month",
            });

        });

        $('#list_view').click(function(event) {
            $('#calendar_1').hide();
            $('#calendar_2').show();
        });

        $('#calendar_1').fullCalendar({
            defaultView: 'month',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            viewRender: function(view) {
                return view.name
            },
            events: "<?php echo base_url(); ?>live_session/fetch_live_sessions/month",
        });

        $('#send_mail').click(function(e) {
            e.preventDefault();
            $('#send_mail').attr("disabled", "");
            $form = $('#mail_form');
            $action = $form.prop('action');
            $student_name = $('#students option:selected').data('student_name');
            $student_class = $('#students option:selected').data('student_class');
            $form.append('<input type="hidden" name="student_name" value="' + $student_name + '">');
            $form.append('<input type="hidden" name="student_class" value="' + $student_class + '">');
            $serializeData = $form.find('input,textarea,select,button');
            $form.ajaxForm({
                type: $form.prop('method'),
                url: $form.prop('action'),
                data: $serializeData,
                dataType: 'json',
                target: false,
                beforeSend: function() {
                    $('#ajaxspinner').show();
                },
                complete: function() {
                    $('#ajaxspinner').hide();
                },
                success: function(data) {
                    $('#send_mail').removeAttr("disabled");
                    Swal.fire(
                        'Success!',
                        'Mail sent successfully..!',
                        'success'
                    );
                    if (data.success == 'yes') {
                        setTimeout(function() {
                            if (data.send == 'no') {
                                window.location.reload(true);
                            } else {
                                window.location.replace(data.send);
                            }
                        }, 500);
                    }
                }
            }).submit();
        });


        $('#simple-table').DataTable({
            responsive: true,
            "language": {
                "search": "_INPUT_", // Removes the 'Search' field label
                "searchPlaceholder": "Search" // Placeholder for the search box
            },
            // "aaSorting": [
            // 	// [0, "desc"],
            // 	[2, "desc"]
            // ],
            "aaSorting": [],
            "pagingType": "full_numbers"
        });

        $('#list-view-live-sessions').DataTable({
            "language": {
                "search": "_INPUT_", // Removes the 'Search' field label
                "searchPlaceholder": "Search" // Placeholder for the search box
            },
            "searching": false,
            "aaSorting": [],
            "pagingType": "full_numbers"
        });
        $('.upload_button').click(function(e) {
            button_value = $(this).attr("data-id");
            $('.Upload').attr("disabled", "");
        })
        // if ($('#files').val() == '') {
        //     $('#Upload').attr("disabled", "");
        // }

        $('input:file').change(function() {
            $('.Upload').removeAttr('disabled');

        })
        $(document).on('submit', '#submit', function(e) {
            e.preventDefault();
            $form = $('#submit')
            $.ajax({
                type: $form.prop('method'),
                // url: $form.prop('action'),
                url: $form.prop('action') + '/' + button_value,
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('.Upload').attr("disabled", "");
                    $('#ajaxspinner').show();
                },
                complete: function() {
                    $('#ajaxspinner').hide();
                },
                success: function(data) {
                    //$('#modal').modal('hide');

                    alert("Upload Image Successful.");
                    $('.modal').modal('hide');

                }
            });

        });

        $('#save').click(function(e) {
            e.preventDefault();
            $form = $('#<?php echo $this->uri->segment(1); ?>_form');
            //alert('<?php echo $this->uri->segment(1); ?>_form');
            $alert = $form.find('.alert');
            $action = $form.prop('action');
            $form.find('input,textarea');
            $serializeData = $form.find('input,textarea').serialize();
            //alert('das');
            $.ajax({
                type: $form.prop('method'),
                url: $form.prop('action'),
                data: $serializeData,
                dataType: 'json',
                success: function(data) {
                    //var data = JSON.parse(data);
                    // alert(data.m);
                    if (data.success == 'yes') {
                        $alert.html(data.msg);
                        $alert.removeClass('alert-danger');
                        $alert.addClass('alert-success');
                        $alert.show();
                        setTimeout(function() {
                            window.location.reload();
                        }, 500)
                    } else if (data.success == 'no') {
                        $alert.html(data.msg);
                        $alert.removeClass('alert-success');
                        $alert.addClass('alert-danger');
                        $alert.show();
                    }
                }

            });
        });

        $("#Lectures").click(function() {
            //window.location = $(this).find("a").attr("href");
            window.location.href = "<?php echo base_url(); ?>lectures";
            return false;
        });
        $("#Quiz").click(function() {
            // window.location = $(this).find("a").attr("href");
            // return false;
            alert("Part Of Phase 2 Development.....")
        });
        $("#UploadAssignment").click(function() {
            // window.location = $(this).find("a").attr("href");
            // return false;
            // alert("Part Of Phase 2 Development.....")
            window.location.href = "<?php echo base_url(); ?>live_session";
        });
        $("#Mail").click(function() {
            // window.location = $(this).find("a").attr("href");
            // return false;
            window.location.href = "<?php echo base_url(); ?>mail";
        });



        $('.delete').click(function() {
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url() . $this->uri->segment(1); ?>/delete/' + $(this).attr('id'),
                dataType: 'json',
            }).success(function(data) {
                if (data.success == 'yes') {
                    $('.alert').html(data.msg);
                    $('.alert').addClass('alert alert-success');
                    $('.alert').show();
                    setTimeout(function() {
                        window.location.reload();
                    }, 500)
                } else if (data.success == 'no') {
                    $('.alert').html(data.msg);
                    $('.alert').removeClass('alert alert-success');
                    $('.alert').show();
                }
            });
        });

        $('.status').click(function() {
            //  alert($(this).attr('id'));
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url($segment_1n2); ?>/change_status',
                data: {
                    id: $(this).attr('id')
                },
                dataType: 'json',
                success: function(data) {
                    //  var data =JSON.parse(data);
                    if (data.success == 'yes') {

                        $('.alert').html(data.msg);
                        $('.alert').addClass('alert alert-success');
                        $('.alert').show();
                        setTimeout(function() {
                            window.location.reload();
                        }, 500)
                    } else if (data.success == 'no') {
                        $('.alert').html(data.msg);
                        $('.alert').removeClass('alert alert-success');
                        $('.alert').show();
                    }
                }

            });

        });


        $('#check_all').click(function() {
            if (this.checked == true) {
                $('.case').each(function() {
                    this.checked = true;
                });
            } else {
                $('.case').each(function() {
                    this.checked = false;
                });
            }
        });

        $("#students").on("change", function() {
            var value = $(this).val();
            var fetch_teachers = '<?php echo base_url(); ?>mail/fetch_teachers';
            $.ajax({
                url: fetch_teachers,
                type: "post",
                data: {
                    "value": value
                },
                dataType: "json",
                success: function(data) {
                    console.log("DATA", data)
                    $('#teachers').empty();
                    for (i = 0; i < data.length; i++) {
                        $('#teachers').append(`<option value="${data[i]}">   ${data[i]} </option>`);
                    }
                },
            })

        });
        $('.message_preview').click(function() {
            $record_id = $(this).attr('data-id');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>mail/update_view_status/' + $record_id,
            }).success(function(data) {
                console.log("SUCCESS")
            });
        });
    });
</script>