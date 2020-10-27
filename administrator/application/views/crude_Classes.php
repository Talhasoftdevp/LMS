<div class="btn-group">
    <button class="btn btn-primary btn-white dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="ace-icon fa fa-wrench bigger-110 icon-only"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">

        <li>
            <a href="<?php echo base_url($segment_1n2) . '/edit/' . $record[$row_id]; ?>"><i class="menu-icon fa fa-pencil-square-o"></i> Edit</a>
        </li>

        <?php if ($Rights_check['delete'] == TRUE) { ?>
            <?php if ($this->uri->segment(3) == 'deleted' && $this->session->userdata('user_id') === 1) { ?>
                <li>
                    <a href="#" id="<?php echo $record[$row_id]; ?>" class="delete"><i class="ace-icon fa fa-undo smaller-200"></i> Restore</a>
                </li>

            <?php } else { ?>
                <li>
                    <a href="#" id="<?php echo $record[$row_id]; ?>" class="delete"><i class="ace-icon fa fa-trash-o fa-x icon-only"></i> Delete</a>
                </li>

            <?php } ?>
        <?php } ?>
    </ul>
</div>