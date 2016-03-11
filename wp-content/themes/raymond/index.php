<?php 
get_header(); ?>

<div class="testMenu">
	<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
</div>

<div>
	Main Content
</div>

<div class="testWidgetArea">
	<?php if ( is_active_sidebar( 'raymond_side_bar' ) ) : ?>
		<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
			<?php dynamic_sidebar( 'raymond_side_bar' ); ?>
		</div><!-- #primary-sidebar -->
	<?php endif; ?>
</div>

<?php get_footer(); ?>