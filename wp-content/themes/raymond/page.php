<?php get_header();?>

<!-- CONTENT Page =================================-->
<div class="contentWrapper container">   
	<div class="subContainer row">        

		<?php if (have_posts()) : while (have_posts()) : the_post();  ?>        
		<div class="entry">            
			<h1 <?php if( is_cart() ){ echo 'style="margin-bottom:20px;"'; } ?>>
				<?php the_title();?>
			</h1> 

	         <?php the_content(); ?>      

	         <?php edit_post_link('EDIT', '<p>', '</p>'); ?>     
        </div>        
        <?php endwhile ?>       
        <?php else : endif; ?>   
    </div>
</div>
<!-- /CONTENT ============-->

<?php get_footer();?>