<script src="<?php echo base_url(); ?>assets/js/ajax.submit/ajaximage/scripts/jquery.form.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ajax.submit/jquery.form.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.min.css" />
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/table2excel/table2excel.min.js"></script> -->
<script src="https://rawgit.com/unconditional/jquery-table2excel/master/src/jquery.table2excel.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-data-table/data-table.css" />
<script src="<?php echo base_url(); ?>assets/jquery-data-table/data-table.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-data-table/data-table-buttons.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-data-table/html-5-buttons.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		// alert("TEST");
		$('.alert').hide();


		// $('#simple-table').DataTable({
		// 	"language": {
		// 		"search": "_INPUT_", // Removes the 'Search' field label
		// 		"searchPlaceholder": "Search" // Placeholder for the search box
		// 	},
		// 	"aaSorting": [],
		// 	"pagingType": "full_numbers"
		// });


		$('#submit_action').click(function() {
			$('#submit_action').attr("disabled", "");
			$form = $('#<?php echo $this->uri->segment(2); ?>_form');
			$alert = $form.find('.alert');
			$action = $form.prop('action');
			$form.find('input,textarea,select,button');
			$serializeData = $form.find('input,textarea,select,button');
			$form.ajaxForm({
				type: $form.prop('method'),
				url: $form.prop('action'),
				dataType: 'json',
				target: false,
				beforeSend: function() {
					$('#ajaxspinner').show();
				},
				complete: function() {
					$('#ajaxspinner').hide();
				},
				success: function(data) {
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
					// alert("Course Created");
				}
			}).submit();
		});

		$("#classID").on("change", function() {
			var value = $(this).val();
			var fetchStudents = '<?php echo base_url(); ?>attendance/student_attendance/';
			$.ajax({
				url: fetchStudents,
				type: "post",
				dataType: "html",
				data: {
					"selected_class": value
				},
				dataType: "json",
				success: function(data) {
					$("body").html(response);
				},
			})

		});
		$("#content_type").change(function() {
			if ($(this).children("option:selected").val() == 2) {
				$('#choice').attr('type', 'text');
				$('#choice').attr('name', 'youtube_link');
			}

			if ($(this).children("option:selected").val() != 2) {
				$('#choice').attr('type', 'file');
			}
		})
		$('#search').click(function() {
			$form = $('#record_logs');
			$serializeData = $form.find('input,textarea,select').serialize();
			$my_data = $serializeData.split('&');
			$key_value = {};
			$my_data.map(item => {
				let keyValue = item.split('=')
				return $key_value[keyValue[0]] = keyValue[1];
			})
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() . 'attendance/student_attendance/'; ?>",
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
					$('#simple-table').DataTable({
						"language": {
							"search": "_INPUT_", // Removes the 'Search' field label
							"searchPlaceholder": "Search" // Placeholder for the search box
						},
						dom: 'lBfrtip',
						buttons: [{
								text: 'Print In Excel',
								extend: 'csvHtml5',
								title: 'Student_Attendance',
								className: "print"
							},
							// 'copyHtml5',
							// 'excelHtml5',
							// 'csvHtml5',
							// 'pdfHtml5'
						],
						"aaSorting": [],
						"pagingType": "full_numbers"
					});
				},
				error: function(error_) {
					alert(error_);
				}
			});
			window.localStorage.setItem("CLASS", $key_value['class']);
			window.localStorage.setItem("MONTH", $key_value['month_selection']);
			window.localStorage.setItem("YEAR", $key_value['year_selection']);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() . 'attendance/student_attendance/print_attendance/'; ?>",
				data: {
					CLASS: localStorage.getItem('CLASS'),
					MONTH: localStorage.getItem('MONTH'),
					YEAR: localStorage.getItem('YEAR')
				},
				beforeSend: function() {
					$('#ajaxspinner').show();
				},
				complete: function() {
					$('#ajaxspinner').hide();
				},
				success: function(response) {
					// $("body").html(response);
					console.log("DATA FORWARDED...")
				},
				error: function(error_) {
					alert(error_);
				}
			});

		});
		$(".dataTables_length select").addClass("customization");
		$("#print-to-excel").click(function() {
			$class = $('#classID').val();
			$month = $('#month_selection').val();
			$year = $('#year_selection').val();
			console.log("CLASS", $class)
			searc_parameters = [];
			searc_parameters[0] = $class;
			searc_parameters[1] = $month;
			searc_parameters[2] = $year;
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: "<?php echo base_url() . 'attendance/student_attendance/print_attendance'; ?>",
				data: {
					searc_parameters: searc_parameters
				},
				beforeSend: function() {
					$('#ajaxspinner').show();
				},
				complete: function() {
					$('#ajaxspinner').hide();
				},

			});
		});
		$('.remove').click(function() {
			$('#row_' + $(this).attr('data-id')).remove();
		});

		$('.remove_edt').click(function() {
			var id = $(this).attr('data-id');

			$.ajax({
				type: 'POST',
				url: '<?php echo base_url($segment_1n2); ?>/remove/' + id,
				dataType: 'json',
			}).success(function(data) {
				if (data.success == 'yes') {
					$('#row_' + id).remove();
				} else if (data.success == 'no') {
					alert('can not delete , some thing wrong');
				}
			});
		});


		var index = 0;
		$('.add_more_q').click(function() {
			var id = $(this).attr('data-id');
			id++;
			index++;
			$(this).attr('data-id', id);
			$('#questions').append('<tr id="row_q_' + id + '"> <td style="vertical-align:middle"><textarea cols="20" name="question[]" ></textarea></td> <td style="vertical-align:middle"><select class="type" rel="' + index + '" data-id="' + id + '" name="type[]" id="type_' + id + '"><option value="1">Radio</option><option value="2">Multiple</option><option value="3">T/F</option></select></td> <td style="vertical-align:middle"><input type="text" class="col-xs-10 col-sm-12" name="ans_a[]" /></td> <td style="vertical-align:middle"><input type="text" class="col-xs-10 col-sm-12" name="ans_b[]" /></td> <td style="vertical-align:middle"><input type="text" class="col-xs-10 col-sm-12" id="c_' + id + '" name="ans_c[]" /></td> <td style="vertical-align:middle"><input type="text" id="d_' + id + '" class="col-xs-10 col-sm-12" name="ans_d[]" /></td> <td id="cans_' + id + '" style="vertical-align:middle"><select name="correct_ans[]" ><option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option></select></td> <td style="vertical-align:middle"><select name="master_practice[]" ><option value="0">Practice</option><option value="1">Master</option></select></td> <td style="vertical-align:middle"><button data-id="' + id + '" type="button" class="btn btn-danger btn-sm remove_q">X</button></td> </tr>');

			$('.remove_q').click(function() {
				$('#row_q_' + $(this).attr('data-id')).remove();
			});

			$('.type').unbind('change');
			$('.type').change(function() {
				var i = $(this).attr('rel');
				var val = $(this).val();
				var cnt_id = $(this).attr('data-id');
				if (val == 1) {
					$('#c_' + cnt_id).removeAttr('readonly');
					$('#d_' + cnt_id).removeAttr('readonly');
					$('#c_' + cnt_id).removeClass('input-disabled');
					$('#d_' + cnt_id).removeClass('input-disabled');
					$('#cans_' + cnt_id).html('<select name="correct_ans[]" ><option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option></select>');
				}
				if (val == 2) {
					$('#c_' + cnt_id).removeAttr('readonly');
					$('#d_' + cnt_id).removeAttr('readonly');
					$('#cans_' + cnt_id).html('<input type="hidden" id="multihidden_' + cnt_id + '" name="correct_ans[]"/><select multiple="" class="multiselect" data-id="' + cnt_id + '"><option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option></select>');
					$('#c_' + cnt_id).removeClass('input-disabled');
					$('#d_' + cnt_id).removeClass('input-disabled');
				}
				if (val == 3) {
					$('#c_' + cnt_id).val('');
					$('#d_' + cnt_id).val('');
					$('#c_' + cnt_id).attr("readonly", true);
					$('#d_' + cnt_id).attr("readonly", true);
					$('#c_' + cnt_id).addClass('input-disabled');
					$('#d_' + cnt_id).addClass('input-disabled');

					$('#cans_' + cnt_id).html('<select name="correct_ans[]" ><option value="A">A</option><option value="B">B</option></select>');
				}
				$('.multiselect').click(function() {
					$('#multihidden_' + $(this).attr('data-id')).val($(this).val().join(','));
				});
			});



		});

		$('.type').change(function() {
			var i = $(this).attr('rel');
			var val = $(this).val();
			var cnt_id = $(this).attr('data-id');
			if (val == 1) {
				$('#c_' + cnt_id).removeAttr('readonly');
				$('#d_' + cnt_id).removeAttr('readonly');
				$('#c_' + cnt_id).removeClass('input-disabled');
				$('#d_' + cnt_id).removeClass('input-disabled');
				$('#cans_' + cnt_id).html('<select name="correct_ans[]" ><option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option></select>');
			}
			if (val == 2) {
				$('#c_' + cnt_id).removeAttr('readonly');
				$('#d_' + cnt_id).removeAttr('readonly');
				$('#cans_' + cnt_id).html('<input type="hidden" id="multihidden_' + cnt_id + '" name="correct_ans[]"/><select multiple="" class="multiselect" data-id="' + cnt_id + '"><option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option></select>');
				$('#c_' + cnt_id).removeClass('input-disabled');
				$('#d_' + cnt_id).removeClass('input-disabled');
			}
			if (val == 3) {
				$('#c_' + cnt_id).val('');
				$('#d_' + cnt_id).val('');
				$('#c_' + cnt_id).attr("readonly", true);
				$('#d_' + cnt_id).attr("readonly", true);
				$('#c_' + cnt_id).addClass('input-disabled');
				$('#d_' + cnt_id).addClass('input-disabled');

				$('#cans_' + cnt_id).html('<select name="correct_ans[]" ><option value="A">A</option><option value="B">B</option></select>');
			}
			$('.multiselect').click(function() {
				$('#multihidden_' + $(this).attr('data-id')).val($(this).val().join(','));
			});
		});

		$('.remove_q').click(function() {
			$('#row_q_' + $(this).attr('data-id')).remove();
		});

		$('.multiselect').click(function() {
			$('#multihidden_' + $(this).attr('data-id')).val($(this).val().join(','));
		});



	});
</script>