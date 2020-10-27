<nav class="navbar">
  <!-- class="navbar navbar-default" -->
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="<?php echo ($this->session->userdata('is_elearn_logged_in') == 1) ? "collapse navbar-collapse navbar-left" : "collapse navbar-collapse navbar-center" ?>" id="navigation">
      <ul class="nav navbar-nav">
        <li class="<?php echo ($this->uri->segment('1') == '') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a></li>
        <li class="<?php echo ($this->uri->segment('1') == 'elearning') ? 'active' : ''; ?>">
          <a href="<?php echo base_url(); ?>elearning">
            <font style="font-size:12px;">E</font>-Learning
          </a>
        </li>
        <li class="<?php echo ($this->uri->segment('1') == 'contact') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>contact">Contact us</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
    <?php if ($this->session->userdata('is_elearn_logged_in') == 1) { ?>

      <form class="navbar-form navbar-right">
        <div class="form-group">
          <input value="LOGOUT" name="logout" type="button" onclick="window.location = '<?php echo base_url(); ?>elearning/out'" />
        </div>
      </form>
    <?php } ?>
  </div><!-- /.container-fluid -->
</nav>
<div class="clearfix"></div>