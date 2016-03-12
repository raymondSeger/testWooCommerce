<?php 
/*
 Template Name: Page Show 10 products from 1 Category
 */
get_header(); 
?>


<div>
	<h1>Page Show 10 products from 1 Category</h1>
</div>

<?php 
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

// get only 2 posts per page, get the content for page 2 (which means OFFSET 2)
$query = new WP_Query(
    array(
    'post_type'         => 'product',
    'posts_per_page'    => 10,
    'paged'				=> $paged,
    'product_cat'       => 'category_product2' // category slug
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

<?php 
// NEXT and PREVIOUS links
// next_posts_link() usage with max_num_pages
echo next_posts_link( 'Older Entries', $query->max_num_pages );
echo previous_posts_link( 'Newer Entries' );
?>

<?php
// 1 2 3 4
echo "<br />";
$big = 999999999; // need an unlikely integer

echo paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
	'total' => $query->max_num_pages
) );
?>

<?php wp_reset_query(); ?>

<?php get_footer(); ?>