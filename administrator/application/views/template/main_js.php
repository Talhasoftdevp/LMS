<script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>

<script type="text/javascript">
    /* 
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    $(document).ready(function() {

        $('.alert').hide('fast');
        $('#save').click(function(e) {
            e.preventDefault();
            $form = $('#<?php echo $this->uri->segment(2); ?>_form');
            $alert = $form.find('.alert');
            $action = $form.prop('action');
            $form.find('input,textarea');
            $serializeData = $form.find('input,textarea').serialize();
            //alert('das');
            $.ajax({
                type: 'POST',
                url: $action,
                data: $serializeData,
                datatype: 'json',
                success: function(data) {
                    var data = JSON.parse(data);
                    // alert(data.m);
                    if (data.success == 'yes') {

                        $alert.html(data.msg);
                        $alert.addClass('alert-success');
                        $alert.show();
                        setTimeout(function() {
                            window.location.reload();
                        }, 500)
                    } else if (data.success == 'no') {
                        $alert.html(data.msg);
                        $alert.removeClass('alert-success');
                        $alert.show();
                    }
                }

            });
        });
        // $('.message_preview').on('click', function(e) {
        //     console.log("BUTTON IS CLICKED")
        // })
        // $(".modal").on('shown', function() {
        //     alert("I want this to appear after the modal has opened!");
        // });
        $("#students").on("change", function() {
            var value = $(this).val();
            var fetch_teachers = '<?php echo base_url(); ?>mail_box/mail_box/fetch_teachers';
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
        $('.delete').click(function() {
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url($segment_1n2); ?>/delete/' + $(this).attr('id'),
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

        $('.active').click(function() {
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url($segment_1n2); ?>/active/' + $(this).attr('id'),
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

        $('.not-active').click(function() {
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url($segment_1n2); ?>/notActive/' + $(this).attr('id'),
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

        $('#createCourse').on('click', function() {
            window.location.href = '<?php echo base_url('courses/create_course/') ?>';
        })

        $('#manageCourse').on('click', function() {
            window.location.href = '<?php echo base_url('courses/manage_course/') ?>';
        })

        $('#createLiveSession').on('click', function() {
            window.location.href = '<?php echo base_url('live_session/create_live_session/') ?>';
        })

        $('#manageLiveSession').on('click', function() {
            window.location.href = '<?php echo base_url('live_session/manage_live_sessions/') ?>';
        })

        $('#assignment_insights').on('click', function() {


            window.location.href = '<?php echo base_url('assignments/assignments_logs') ?>';
        })

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






        $("#bootbox").on(ace.click_event, function() {
            var value = $('.case').map(function() {
                if (this.checked) {
                    return $(this).val();
                }
            }).get();
            bootbox.dialog({
                message: "<span class='bigger-110'>Are You Sure You Want Delete Records.</span>",
                buttons: {
                    //                            "success":
                    //                                    {
                    //                                        "label": "<i class='ace-icon fa fa-check'></i> Success!",
                    //                                        "className": "btn-sm btn-success",
                    //                                        "callback": function () {
                    //                                            //Example.show("great success");
                    //                                        }
                    //                                    },
                    "danger": {
                        "label": "Delete!",
                        "className": "btn-sm btn-danger",
                        "callback": function() {
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url($segment_1n2); ?>/purge_all',
                                data: {
                                    ids: value
                                },
                                dataType: 'json',
                                success: function(data) {
                                    if (data.success == 'yes') {
                                        $('.alert').html(data.msg);
                                        $('.alert').addClass('alert-success');
                                        $('.alert').show();
                                        setTimeout(function() {
                                            window.location.reload();
                                        }, 500)
                                    } else if (data.success == 'no') {
                                        $('.alert').html(data.msg);
                                        $('.alert').removeClass('alert-success');
                                        $('.alert').show();
                                    }
                                }

                            });
                        }
                    },
                    //                            "click":
                    //                                    {
                    //                                        "label": "Click ME!",
                    //                                        "className": "btn-sm btn-primary",
                    //                                        "callback": function () {
                    //                                            //Example.show("Primary button");
                    //                                        }
                    //                                    },
                    "button": {
                        "label": "Cancle ",
                        "className": "btn-sm"
                    }
                }
            });
        });



    });
</script>