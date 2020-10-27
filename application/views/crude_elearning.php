<div class="btn-group">
    <button class="btn btn-primary btn-white dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="ace-icon fa fa-wrench bigger-110 icon-only"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">


        <li>
            <a href="<?php echo base_url() . $this->uri->segment(1) . '/start_lecture/' . $record['chapter_id']; ?>" target="_blank"><i class="menu-icon fa fa-play"></i> &nbsp;Start training course</a>
        </li>


        <!-- <li>
            <a href="<?php echo base_url() . $this->uri->segment(1) . '/result/' . $record['assignment_id']; ?>"><i class="menu-icon fa fa-eye"></i> &nbsp;view result</a>
        </li> -->

    </ul>
</div>