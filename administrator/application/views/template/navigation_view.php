<div class="main-container" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {}
    </script>

    <div id="sidebar" class="sidebar h-sidebar collapse navbar-collapse">
        <script type="text/javascript">
            try {
                ace.settings.check('sidebar', 'fixed')
            } catch (e) {}
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                <button class="btn btn-success">
                    <i class="ace-icon fa fa-signal"></i>
                </button>

                <button class="btn btn-info">
                    <i class="ace-icon fa fa-pencil"></i>
                </button>

                <button class="btn btn-warning">
                    <i class="ace-icon fa fa-users"></i>
                </button>

                <button class="btn btn-danger">
                    <i class="ace-icon fa fa-cogs"></i>
                </button>
            </div>

            <div class="sidebar-shortcuts-mini" id="sidebar">
                <span class="btn btn-success"></span>

                <span class="btn btn-info"></span>

                <span class="btn btn-warning"></span>

                <span class="btn btn-danger"></span>
            </div>
        </div><!-- /.sidebar-shortcuts -->

        <ul class="nav nav-list">
            <li class="<?php echo ($this->uri->segment('1') == '') ? 'active open hover' : ''; ?>">
                <a href="<?php echo base_url(); ?>">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>

                <b class="arrow"></b>
            </li>
            <?php if ($this->session->userdata('user_role')) { ?>
                <?php foreach ($module as $value) { ?>
                    <li class="<?php echo ($this->uri->segment('1') == lcfirst($value['module_name'])) ? 'active' : ''; ?> hover" style="margin-bottom:20px">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa <?php echo ($value['icon_class']) ? $value['icon_class'] : ''; ?>"></i>
                            <span class="menu-text">
                                <?php echo $value['module_name']; ?>
                            </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>
                        <?php if ($value['have_child'] == 1) {  ?>
                            <ul class="submenu">

                                <?php foreach ($module_childs as $value_child) { ?>
                                    <?php if ($value['module_id'] === $value_child['module_parent_id']) { ?>
                                        <li class="<?php echo ($this->uri->segment(2) == $value_child['module_slug']) ? 'active' : ''; ?> hover">
                                            <a href="<?php echo base_url() . $value['module_slug'] . '/' . $value_child['module_slug']; ?>">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                <?php echo $value_child['module_name']; ?>
                                            </a>
                                            <b class="arrow"></b>
                                        </li>
                                    <?php } ?>
                                <?php } ?>

                            </ul>

                        <?php } ?>
                    </li>
                <?php } ?>

            <?php } ?>

        </ul><!-- /.nav-list -->

        <script type="text/javascript">
            try {
                ace.settings.check('sidebar', 'collapsed')
            } catch (e) {}
        </script>
    </div>


    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->