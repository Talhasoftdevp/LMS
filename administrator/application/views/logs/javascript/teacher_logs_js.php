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

        $('#simple-table').DataTable({
            "language": {
                "search": "_INPUT_", // Removes the 'Search' field label
                "searchPlaceholder": "Search" // Placeholder for the search box
            },
            "aaSorting": [],
            "pagingType": "full_numbers"
        });
        // $(table.cells().nodes()).removeClass('highlight');
        // $('td', 'row').removeClass('highlight');
        // $('div.dataTables_filter input').addClass('inputMenuSearch');
    })
</script>