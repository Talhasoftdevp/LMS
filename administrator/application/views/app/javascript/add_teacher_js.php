<script src="<?php echo base_url(); ?>assets/js/ajax.submit/ajaximage/scripts/jquery.form.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ajax.submit/jquery.form.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.min.css" />
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        var index = 1;
        var indexToRemove;
        var counter = 1;
        var maxField = 6;
        var div = '<div class="container"></div>'
        var button = '<button data-id="1" type="button" class="btn btn-danger btn-sm remove_button" id="removeRow" style="right:-45.5%;height:29.5px;">Remove</i></button>'


        $('.alert').hide();

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
        // FOR SUBJECT
        $("#class").on("change", function() {

            var value = $(this).val();
            var fetchSubjects = '<?php echo base_url(); ?>app/add_teacher/fetchSubjects';
            $.ajax({
                url: fetchSubjects,
                type: "post",
                data: {
                    "value": value
                },
                dataType: "json",
                success: function(data) {
                    for (i = 0; i < data.length; i++) {
                        $('#subjectId').append(`<option value="${data[i]}">${data[i]}</option>`);
                    }
                },
            })

        });
        // FOR SECTION
        $("#class").change(function(event) {
            var value = $(this).val();
            console.log("**************************************************")
            var fetchSubjects = '<?php echo base_url(); ?>app/Add_teacher/fetchSections';
            $.ajax({
                url: fetchSubjects,
                type: "post",
                data: {
                    "value": value
                },
                dataType: "json",
                success: function(data) {
                    $("#sectionID").empty();
                    for (i = 0; i < data.length; i++) {
                        $("#sectionID").append(`<option value="${data[i]}">${data[i]}</option>`);
                    }
                },
            })

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

        var dataArray = [];
        $("#addAnother").click(function() {
            var classAssigned = $('#class option:selected').text();
            var sectionAssigned = $('#sectionID option:selected').text();
            var subjectAssigned = $('#subjectId option:selected').text();
            $("#class")[0].selectedIndex = 0;
            $("#sectionID")[0].selectedIndex = 0;
            $("#subjectId")[0].selectedIndex = 0;
            $('.subjectTest').empty().append('<option hidden>Please Select Subject</option>')
            if (dataArray.length === 0) {
                dataArray.push({
                    class: classAssigned,
                    section: sectionAssigned,
                    subject: subjectAssigned
                });
            } else {
                var found = dataArray.find(function(element) {
                    console.log('element', element);
                    if (element.class === classAssigned && element.section === sectionAssigned && element.subject === subjectAssigned) {
                        return true;
                    }
                });

                if (found === undefined) {
                    dataArray.push({
                        class: classAssigned,
                        section: sectionAssigned,
                        subject: subjectAssigned
                    });
                } else {
                    alert('Can Not Assign Same Class, Section & Subject');
                }
            }

            $('#childs').empty();
            dataArray.forEach((element, id) => {
                $('#childs').append('<tr id="' + id + '"> <td valign="middle">' + element.class + '<input type="hidden" class="col-xs-10 col-sm-10" name="classes_assigned[]" value="' + element.class + '"/></td> <td valign="middle">' + element.section + '<input type="hidden" class="col-xs-10 col-sm-10" name="section_assigned[]" value="' + element.section + '"/></td> <td valign="middle">' + element.subject + '<input type="hidden" class="col-xs-10 col-sm-10" name="subject_assigned[]" value="' + element.subject + '"/></td> <td><button data-id="' + id + '" type="button" class="btn btn-danger btn-xs remove"><i class="fa fa-trash"></i></button></td> </tr>');
            });

            console.log('array', dataArray);
        });
        $("#simple-table").on('click', '.remove', function() {
            $table_row = $(this).closest('tr').attr('id');
            console.log('remove', $(this).closest('tr'));
            console.log("TABLE ID:", $table_row)
            dataArray.splice($table_row, 1);
            $('#childs').empty();
            dataArray.forEach((element, id) => {
                $('#childs').append('<tr id="' + id + '"> <td valign="middle">' + element.class + '<input type="hidden" class="col-xs-10 col-sm-10" name="classes_assigned[]" value="' + element.class + '"/></td> <td valign="middle">' + element.section + '<input type="hidden" class="col-xs-10 col-sm-10" name="section_assigned[]" value="' + element.section + '"/></td> <td valign="middle">' + element.subject + '<input type="hidden" class="col-xs-10 col-sm-10" name="subject_assigned[]" value="' + element.subject + '"/></td> <td><button data-id="' + id + '" type="button" class="btn btn-danger btn-xs remove"><i class="fa fa-trash"></i></button></td> </tr>');
            });
            console.log("ARRAY:", dataArray)
            $(this).closest('tr').remove();
        });

        $("#container").on('click', '.remove_button', function(event) {
            var idToRemove = $(this).closest('div.DDL').attr('id');
            $("#" + idToRemove).remove();
            counter--; //Decrement field counter
        });







    });
</script>