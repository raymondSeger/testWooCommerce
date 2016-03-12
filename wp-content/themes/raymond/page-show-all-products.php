<?php 
/*
 Template Name: Page Show all Products
 */

// - Shows all products with LIMIT and OFFSET
get_header(); 
?>


<div>
	<h1>Show all Products</h1>
</div>

<?php 

// get only 2 posts per page, get the content for page 2 (which means OFFSET 2)
$query = new WP_Query(
            array(
            'post_type'         => 'product',
            'posts_per_page'    => 2,
            'paged'				=> 2
            )
        ); 
?>

<?php while ( $query->have_posts() ) : $query->the_post(); global $product; ?>

<?php
	echo "<hr />";
    if ($product->get_image_id() != null || $product->get_image_id() != '' ) {
        $image 				= wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_post_data()->ID ), 'full' );
        $image 				= $image[0];
        $image_thumbnail 	= wp_get_attachment_image_src( get_post_thumbnail_id($product->get_post_data()->ID), 'thumbnail');
        $image_thumbnail 	= $image_thumbnail[0];
    } else {
        $image = 'no_image';
    }

    // Docs: https://docs.woothemes.com/wc-apidocs/class-WC_Product.html

    echo $image_thumbnail; // get the thumbnail
    echo "<br />";
    echo $product->get_post_data()->post_title; // get the title
    echo "<br />";
    echo $product->get_price(); // get price
	echo "<br />";
    echo $product->get_weight(); // get weight
    echo "<br />";
    echo $product->get_post_data()->ID; // get the id
    echo "<hr />";
?>

<?php endwhile; ?>
<?php wp_reset_query(); ?>

<?php get_footer(); ?>