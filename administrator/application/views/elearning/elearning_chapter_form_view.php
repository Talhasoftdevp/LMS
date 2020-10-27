<style>
    .input-disabled {
        background-color: #848484;
    }
</style>
<div class="main-content">
    <div class="main-content-inner">

        <div class="page-content">

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="widget-box">
                        <div class="widget-header widget-header-blue widget-header-flat">
                            <ul class="breadcrumb" style="margin: 6px 22px 0 0 !important;">
                                <li>
                                    <i class="ace-icon fa fa-home home-icon"></i>
                                    <a href="#">Home</a>
                                </li>

                                <li>
                                    <a href="#"><?php echo ucfirst($this->uri->segment(1)); ?></a>
                                </li>
                                <li class="active"><?php echo $title; ?></li>
                            </ul><!-- /.breadcrumb -->

                            <h4 class="widget-title lighter"></h4>
                            <div style="display:inline-block;float:right;margin:4px 6px 0px 0px ;">
                                <a href="<?php echo base_url($segment_1n2); ?>" class="btn btn-xs btn-success">
                                    Back
                                </a>
                            </div>
                            <div style="display:inline-block;float:right;margin:4px 6px 0px 0px ;">
                                <a href="#" id="submit_action" class="btn btn-xs btn-info">
                                    <?php echo ($edit == TRUE) ? 'Update' : 'Save'; ?> Record
                                </a>
                            </div>
                        </div>
                        <?php
                        if ($edit == TRUE) {
                            $action = base_url($segment_1n2) . '/update_action';
                        } else {
                            $action = base_url($segment_1n2) . '/create_action';
                        }
                        ?>
                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="row">
                                    <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo $action; ?>" id="<?php echo $this->uri->segment(2) . '_form'; ?>" method="post" role="form">
                                        <div class="alert"></div>
                                        <div class="col-sm-11">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Presentation </label>
                                                <div class="col-sm-9">
                                                    <select name="presentation_id" id="presentation_id" class="col-xs-10 col-sm-6">
                                                        <?php if (!empty($presentations)) { ?>
                                                            <?php foreach ($presentations as $presentation) { ?>
                                                                <option value="<?php echo $presentation['presentation_id']; ?>" <?php echo ($edit == TRUE && $record_info['presentation_id'] == $presentation['presentation_id']) ? 'selected=selected' : ''; ?>><?php echo $presentation['name']; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Chapter </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="col-xs-10 col-sm-6" name="chapter" id="chapter" placeholder="Name" value="<?php echo ($edit == TRUE) ? $record_info['name'] : ''; ?>" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-2">Slides</label>

                                                <div class="col-sm-10">
                                                    <table class="table table-striped table-bordered table-hover" id="simple-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Type</th>
                                                                <th>Name</th>
                                                                <th>sort</th>
                                                                <th>Slides</th>
                                                                <th width="5%">Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="slides">
                                                            <?php $count = 1; ?>
                                                            <?php if ($edit == TRUE) { ?>
                                                                <?php foreach ($record_info['slides'] as $slide) { ?>
                                                                    <?php $count = $slide['slide_id']; ?>
                                                                    <tr id="row_<?php echo $count; ?>">
                                                                        <td>
                                                                            <select class="slide_type" name="slide_type[]" rel="0" data-id="<?php echo $slide['slide_id'] ?>" id="slide_type_<?php echo $slide['slide_type'] ?>">
                                                                                <option value="1" <?php echo ($slide['slide_type'] == '1') ? 'selected=selected' : '' ?>>file</option>
                                                                                <option value="2" <?php echo ($slide['slide_type'] == '2') ? 'selected=selected' : '' ?>>url</option>
                                                                            </select>
                                                                        </td>
                                                                        <td><input type="text" class="col-xs-10 col-sm-10" name="name1[]" value="<?php echo $slide['name']; ?>" /></td>
                                                                        <td><input type="number" class="col-xs-10 col-sm-10" name="sort1[]" value="<?php echo $slide['sort']; ?>" /></td>
                                                                        <td>
                                                                            <?php if ($slide['slide_type'] == 1) { ?>
                                                                                <img width="50" height="50" src="<?php echo base_url() ?>upload/elearning/chapter/<?php echo $slide['path']; ?>" />
                                                                            <?php } else {
                                                                                $link = $slide['path'];
                                                                                $video_id = explode("/embed/", $link);
                                                                                $video_id = $video_id[1];
                                                                            ?>
                                                                                <img width="50" height="50" src="//img.youtube.com/vi/<?php echo $video_id; ?>/0.jpg" />
                                                                            <?php } ?>
                                                                        </td>
                                                                        <td><input type="hidden" name="slide_id[]" value="<?php echo $slide['slide_id']; ?>" /><button type="button" class="btn btn-danger btn-sm remove_edt" data-id="<?php echo $count; ?>">X</button></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <tr id="row_<?php echo $count; ?>">
                                                                    <td>
                                                                        <select class="slide_type" rel="0" data-id="<?php echo $count; ?>" name="slide_type[]" id="slide_type_<?php echo $count; ?>">
                                                                            <option value="1">file</option>
                                                                            <option value="2">url</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input type="text" class="col-xs-10 col-sm-10" name="name[]" id="name_<?php echo $count; ?>" /></td>
                                                                    <td><input type="number" class="col-xs-10 col-sm-10" name="sort[]" id="sort_<?php echo $count; ?>" /></td>
                                                                    <td id="photo_<?php echo $count; ?>"><input type="file" class="col-xs-10 col-sm-12" name="photo[]" /></td>
                                                                    <td><button type="button" class="btn btn-danger btn-sm remove" data-id="<?php echo $count; ?>">X</button></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                    <button type="button" class="btn btn-sm add_more" data-id="<?php echo $count; ?>">Add more</button>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-2">Questions</label>

                                                <div class="col-sm-10">
                                                    <table width="100%" class="table table-striped table-bordered table-hover" id="simple-table">
                                                        <thead>
                                                            <tr>
                                                                <th width="24%">Question</th>
                                                                <th width="5%">Type</th>
                                                                <th width="14%">Ans A</th>
                                                                <th width="14%">Ans B</th>
                                                                <th width="14%">Ans C</th>
                                                                <th width="14%">Ans D</th>
                                                                <th width="5%">Correct</th>
                                                                <th width="5%">M/P</th>
                                                                <th width="5%">Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="questions">
                                                            <?php $count = 1 ?>
                                                            <?php if ($edit == TRUE) { ?>

                                                                <?php foreach ($record_info['questions'] as $question) { ?>
                                                                    <tr id="row_q_<?php echo $question['question_id'] ?>">
                                                                        <td style="vertical-align:middle"><textarea cols="20" name="question[]"><?php echo $question['question'] ?></textarea></td>
                                                                        <td style="vertical-align:middle"><select class="type" rel="0" data-id="<?php echo $question['question_id'] ?>" name="type[]" id="type_<?php echo $question['question_id'] ?>">
                                                                                <option value="1" <?php echo ($question['type'] == 1) ? 'selected=selected' : ''; ?>>Radio</option>
                                                                                <option value="2" <?php echo ($question['type'] == 2) ? 'selected=selected' : ''; ?>>Multiple</option>
                                                                                <option value="3" <?php echo ($question['type'] == 3) ? 'selected=selected' : ''; ?>>T/F</option>
                                                                            </select></td>
                                                                        <td style="vertical-align:middle"><input type="text" class="col-xs-10 col-sm-12" name="ans_a[]" value="<?php echo $question['ansa'] ?>" /></td>
                                                                        <td style="vertical-align:middle"><input type="text" class="col-xs-10 col-sm-12" name="ans_b[]" value="<?php echo $question['ansb'] ?>" /></td>
                                                                        <td style="vertical-align:middle"><input type="text" id="c_<?php echo $question['question_id'] ?>" class="col-xs-10 col-sm-12 <?php echo ($question['type'] == 3) ? 'input-disabled' : '' ?>" name="ans_c[]" <?php echo ($question['type'] == 3) ? 'readonly="readonly"' : '' ?> value="<?php echo ($question['type'] != 3) ? $question['ansc'] : '' ?>" /></td>
                                                                        <td style="vertical-align:middle"><input type="text" id="d_<?php echo $question['question_id'] ?>" class="col-xs-10 col-sm-12 <?php echo ($question['type'] == 3) ? 'input-disabled' : '' ?>" name="ans_d[]" <?php echo ($question['type'] == 3) ? 'readonly="readonly"' : '' ?> value="<?php echo ($question['type'] != 3) ? $question['ansd'] : '' ?>" /></td>
                                                                        <td id="cans_<?php echo $question['question_id'] ?>" style="vertical-align:middle">
                                                                            <?php if ($question['type'] == 1) { ?>
                                                                                <select name="correct_ans[]">
                                                                                    <option value="A" <?php echo ($question['correct_ans'] == 'A') ? 'selected=selected' : '' ?>>A</option>
                                                                                    <option value="B" <?php echo ($question['correct_ans'] == 'B') ? 'selected=selected' : '' ?>>B</option>
                                                                                    <option value="C" <?php echo ($question['correct_ans'] == 'C') ? 'selected=selected' : '' ?>>C</option>
                                                                                    <option value="D" <?php echo ($question['correct_ans'] == 'D') ? 'selected=selected' : '' ?>>D</option>
                                                                                </select>
                                                                            <?php } ?>
                                                                            <?php if ($question['type'] == 2) { ?>
                                                                                <input type="hidden" id="multihidden_<?php echo $question['question_id'] ?>" name="correct_ans[]" value="<?php echo $question['correct_ans']; ?>" />
                                                                                <select multiple="" class="multiselect" data-id="<?php echo $question['question_id'] ?>">
                                                                                    <option value="A" <?php echo (in_array('A', explode(',', $question['correct_ans']))) ? 'selected=selected' : '' ?>>A</option>
                                                                                    <option value="B" <?php echo (in_array('B', explode(',', $question['correct_ans']))) ? 'selected=selected' : '' ?>>B</option>
                                                                                    <option value="C" <?php echo (in_array('C', explode(',', $question['correct_ans']))) ? 'selected=selected' : '' ?>>C</option>
                                                                                    <option value="D" <?php echo (in_array('D', explode(',', $question['correct_ans']))) ? 'selected=selected' : '' ?>>D</option>
                                                                                </select>
                                                                            <?php } ?>
                                                                            <?php if ($question['type'] == 3) { ?>
                                                                                <select name="correct_ans[]">
                                                                                    <option value="A" <?php echo ($question['correct_ans'] == 'A') ? 'selected=selected' : '' ?>>A</option>
                                                                                    <option value="B" <?php echo ($question['correct_ans'] == 'B') ? 'selected=selected' : '' ?>>B</option>
                                                                                </select>
                                                                            <?php } ?>
                                                                        </td>
                                                                        <td style="vertical-align:middle">
                                                                            <select name="master_practice[]">
                                                                                <option value="0" <?php echo ($question['master_practice'] == '0') ? 'selected=selected' : '' ?>>Practice</option>
                                                                                <option value="1" <?php echo ($question['master_practice'] == '1') ? 'selected=selected' : '' ?>>Master</option>
                                                                            </select>
                                                                        </td>
                                                                        <td style="vertical-align:middle"><button data-id="<?php echo $question['question_id']; ?>" type="button" class="btn btn-danger btn-sm remove_q">X</button></td>
                                                                    </tr>
                                                                    <?php $count = $question['question_id']; ?>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <tr id="row_q_<?php echo $count; ?>">
                                                                    <td style="vertical-align:middle"><textarea cols="20" name="question[]"></textarea></td>
                                                                    <td style="vertical-align:middle"><select class="type" rel="0" data-id="<?php echo $count; ?>" name="type[]" id="type_<?php echo $count; ?>">
                                                                            <option value="1">Radio</option>
                                                                            <option value="2">Multiple</option>
                                                                            <option value="3">T/F</option>
                                                                        </select></td>
                                                                    <td style="vertical-align:middle"><input type="text" class="col-xs-10 col-sm-12" name="ans_a[]" /></td>
                                                                    <td style="vertical-align:middle"><input type="text" class="col-xs-10 col-sm-12" name="ans_b[]" /></td>
                                                                    <td style="vertical-align:middle"><input type="text" id="c_<?php echo $count; ?>" class="col-xs-10 col-sm-12" name="ans_c[]" /></td>
                                                                    <td style="vertical-align:middle"><input type="text" id="d_<?php echo $count; ?>" class="col-xs-10 col-sm-12" name="ans_d[]" /></td>
                                                                    <td id="cans_<?php echo $count; ?>" style="vertical-align:middle"><select name="correct_ans[]">
                                                                            <option value="A">A</option>
                                                                            <option value="B">B</option>
                                                                            <option value="C">C</option>
                                                                            <option value="D">D</option>
                                                                        </select></td>
                                                                    <td style="vertical-align:middle"><select name="master_practice[]">
                                                                            <option value="0">Practice</option>
                                                                            <option value="1">Master</option>
                                                                        </select></td>
                                                                    <td style="vertical-align:middle"><button data-id="<?php echo $count; ?>" type="button" class="btn btn-danger btn-sm remove_q">X</button></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                    <button type="button" class="btn btn-sm add_more_q" data-id="<?php echo $count; ?>">Add more</button>
                                                </div>
                                            </div>
                                            <?php /*?><!--<div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-4"> Type </label>

                                                <div class="col-sm-9">
                                                    <select name="roles_id" id="roles_id" class="col-xs-10 col-sm-10" >
                                                    	<option value="1" <?php echo($edit == TRUE && $record_info['roles_id'] == 1) ? 'selected=selected' : ''; ?>>Administrator</option>
                                                        <option value="2" <?php echo($edit == TRUE && $record_info['roles_id'] == 2) ? 'selected=selected' : ''; ?>>Analyzer</option>
                                                    </select>                                    
                                                </div>
                                            </div>--><?php */ ?>
                                            <?php /*?><!--<div class="form-group">
                                                 <label class="col-sm-3 control-label no-padding-right" for="form-field-4">Image</label>
                                                            <div class="col-sm-8">
                                                                <input  type="file" class="col-xs-10 col-sm-10" name="photo"  id="id-input-file-3" />
                                                            </div>
                                                        </div>--><?php */ ?>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                        <?php /*?><!--<div class="form-group">
                                                                <div class="col-xs-5">
                                                                    <span class="profile-picture">
                                                                        <img src="<?php echo base_url() . 'upload/customer/'.((!empty($record_info['avatar']))? $record_info['avatar'] :'profile-pic.jpg'); ?>" id="avatar" class="editable img-responsive" />
                                                                    </span>           
                                                                </div>
                                                            </div>--><?php */ ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <?php if ($edit == TRUE) { ?>
                                                <input type="hidden" name="<?php echo $row_id; ?>" value="<?php echo $record_info[$row_id]; ?>" />
                                            <?php } ?>
                                        </div>
                                    </form>

                                </div><!-- /.widget-main -->
                            </div><!-- /.widget-body -->
                        </div>

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->