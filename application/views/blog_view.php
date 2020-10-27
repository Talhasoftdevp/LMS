<section class="news">
<div class="container-fluid">
<div class="row">
	<div class="news1">
	    <h4><?php echo $current_news['title']; ?></h4>
		<p>home / news / <?php echo $current_news['title']; ?></p>
    </div>
</div><!--row-->
</div><!--container-->
</section>
<div class="clearfix"></div>
<div class="container">
	<div class="row">
		<div class="col-md-9"><!--Left Side Start-->
			<section class="blog sec"><!--blog section start-->
				<a class="box2 img_holder" href="">
				<img src="<?php echo base_url(); ?>administrator/upload/news/<?php echo $current_news['image']; ?>" alt="image"/>
				<?php $timestamp = strtotime($current_news['inserted_at']); ?>
                <div class="date">
					<div class="day"><?php echo date("d", $timestamp); ?></div>
					<div class="month"><?php echo date("M", $timestamp); ?></div>
				</div><!--date-->
				<p><?php echo $current_news['title']; ?></p>
				</a>
				<h5><?php echo $current_news['headline']; ?></h5>
				<p><?php echo $current_news['content']; ?></p>
				<div class="social">
					<h6>share this article</h6>
					<span class="fb"><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></span>
					<span class="twitter"><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></span>
					<span class="g-plus"><a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a></span>
					<span class="pinterst"><a href=""><i class="fa fa-pinterest" aria-hidden="true"></i></a></span>
					<span class="linkdin"><a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a></span>
				</div>
			</section><!--blog section End-->
			<section class="comment sec"><!--comment area Start-->
				<div class="area">
					<div class="img_holder">
						<img src="<?php echo base_url(); ?>assets/images/dp.jpg" alt="dp">
						<h5>author: admin</h5>
						<p>Etiam scelerisque iaculis felis, eu sollicitudin arcu hendrerit vitae. Aliquam eget dapibus nulla. In nulla enim, fermentum nec placerat hendrerit, sagittis et diam. Fusce eget nibh et lacus tincidunt rhoncus</p>
					</div>
				</div>
			</section><!--comment area End-->
			<section class="reply sec"><!--Reply area Start-->
				<h6>leave a reply</h6>
				<p>Your email address will not be published. Required fields are marked *</p>
				<form>
					<textarea class="form-control message" rows="4" name="message" placeholder="Story"></textarea>
					<div class="col-md-12 no_pad">
						<div class="col-md-6 no_pad">
							<input type="name" class="form-control" placeholder="Name*">
						</div>
						<div class="col-md-6">
						<input type="email" class="form-control" placeholder="Email*">
						</div>
					</div>
					<a href="">post comment</a>
				</form>
			</section><!--Reply area End-->
		</div><!--Left Side End-->
		<div class="col-md-3"><!--Right Side Start-->
			<section class="recent sec">
				<h6>recent post</h6>
				
                <?php foreach($recent_post as $posts){ ?>
                <?php $timestamp = strtotime($posts['inserted_at']); ?>
                <div class="post">                	
					<img src="<?php echo base_url(); ?>/administrator/upload/news/<?php echo $posts['image'] ?>" alt="post-news">
					<p><?php echo $posts['title'] ?></p>
					<span><?php echo date("M d,  Y", $timestamp); ?></span>
				</div>
                <?php } ?>				
			</section>
		</div><!--Right Side End-->
	</div>
</div>