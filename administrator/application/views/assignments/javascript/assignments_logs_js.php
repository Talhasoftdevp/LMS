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
        $body = $("body");
        $('#searchBy').change(function() {
            if ($(this).children("option:selected").val() == 5) {
                $('#inputBox').attr('type', 'date');
                $('#inputBox').removeClass('inputMenuSearch');
                $('#inputBox').addClass('inputMenuSearch_Type_Date');

            }
            if ($(this).children("option:selected").val() != 5) {
                $('#inputBox').attr('type', 'text');
                $('#inputBox').removeClass('inputMenuSearch_Type_Date');
                $('#inputBox').addClass('inputMenuSearch');

            }
        })
        $('#simple-table').DataTable({
            "language": {
                "search": "_INPUT_", // Removes the 'Search' field label
                "searchPlaceholder": "Search" // Placeholder for the search box
            },
            "aaSorting": [],
            "pagingType": "full_numbers"
        });

        $('#search').click(function() {
            $form = $('#students_submitted_assignment');
            // $action = $form.prop('action');
            // $form.find('input,textarea,select');
            $serializeData = $form.find('input,textarea,select').serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'assignments/assignments_logs/'; ?>",
                dataType: "html",
                data: $serializeData,
                beforeSend: function() {
                    $('#ajaxspinner').show();
                },
                complete: function() {
                    $('#ajaxspinner').hide();
                },
                success: function(response) {
                    $("body").html(response);
                },
                error: function(error_) {
                    alert(error_);
                }
            });
        });
        // $('#downlaod_all').on('click', function(e) {
        //     // e.preventDefault();
        //     // alert("xsncnaCN")
        //     $button_formaction = $('#downlaod_all').attr('formaction');
        //     // console.log("VALUE:", $('#downlaod_all').val())
        //     var student_ids = $('#downlaod_all').val();
        //     var jsonString = JSON.stringify(student_ids);
        //     $.ajax({
        //         type: 'POST',
        //         url: $button_formaction,
        //         // dataType: 'json',
        //         data: {
        //             data: jsonString
        //         },
        //     })

        // })
    })
</script>