<style>
.box1{
	display:none;
}

</style>

<section class="news">
<div class="container-fluid">
<div class="row">
	<div class="news1">
	    <h4>News</h4>
		<p>home / news</p>
    </div>
</div><!--row-->
</div><!--container-->
</section>
<div class="clearfix"></div>
<section class="news-block sec">
	<div class="container">
		<div class="row">     
        	<?php foreach($news as $nw){ ?>
			<div class="box1"><!--News1 start-->
				<div class="col-md-3 ">
					<div class="img_holder">
						<img src="<?php echo base_url(); ?>administrator/upload/news/<?php echo $nw['image'] ?>" alt="">
					</div>
				</div>
				<div class="col-md-9">
					<div class="news3">
						<h5><?php echo $nw['title']; ?></h5>
						<p class="minimize"><?php echo $nw['content']; ?></p>
						<a href="<?php echo base_url(); ?>news/details/<?php echo $nw['news_id'] ?>">learn more</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div><!-- News1 End-->
			<div class="clearfix"></div>
			<?php } ?>
			
			<!-- News3 End-->
			
			<div class="col-md-12"><!--Load More button Start-->
				<div class="load">
					<a href="" id="loadMore">load more</a>
				</div>
			</div><!--Load More button End-->
		</div>
	</div>
</section>