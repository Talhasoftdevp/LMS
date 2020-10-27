<div class="btn-group">
    <button class="btn btn-primary btn-white dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="ace-icon fa fa-wrench bigger-110 icon-only"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">

        <li>
            <a href="<?php echo base_url($segment_1n2) . '/edit/' . $record['record_id']; ?>"><i class="menu-icon fa fa-pencil-square-o"></i> Edit</a>
        </li>
        <!------------------------------------------------- ACTIVE & INACTIVE ----------------------------------->
        <?php if ($this->session->userdata('user_role') == 'Admin') { ?>
            <?php if ($Rights_check['active'] == TRUE) { ?>
                <?php if ($record["status"] == 1) { ?>
                    <li>
                        <a href="#" id="<?php echo $record[$row_id]; ?>" class="not-active"><i class="ace-icon fa fa-trash-o fa-x icon-only"></i> Not Active</a>

                    </li>
                <?php } else { ?>
                    <li>
                        <a href="#" id="<?php echo $record[$row_id]; ?>" class="active"><i class="ace-icon fa fa-trash-o fa-x icon-only"></i> Active</a>

                    </li>
                <?php } ?>
            <?php } ?>
        <?php } ?>
        <!-------------------------------------------------  ------------------------------------------------------>

        <?php if ($this->uri->segment(3) == 'deleted' && $this->session->userdata('user_id') === 1) { ?>
            <li>
                <a href="#" id="<?php echo $record[$row_id]; ?>" class="delete"><i class="ace-icon fa fa-undo smaller-200"></i> Restore</a>
            </li>

        <?php } else { ?>
            <li>
                <a href="#" id="<?php echo $record['record_id']; ?>" class="delete"><i class="ace-icon fa fa-trash-o fa-x icon-only"></i> Delete</a>
            </li>

        <?php } ?>

        <?php if ($this->uri->segment(2) == 'registration') { ?>
            <li>
                <a href="<?php echo base_url($segment_1n2); ?>/print_view/<?php echo $record[$row_id]; ?>" target="_blank"><i class="ace-icon fa fa-file fa-x icon-only"></i> Recipt</a>
            </li>
        <?php } ?>
    </ul>
</div>