<?php 
/*
 Template Name: Page add 1 product to cart
 */
get_header(); 
?>


<div>
	<h1>Page add 1 product to cart</h1>
</div>

<?php 
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

// get only 2 posts per page, get the content for page 2 (which means OFFSET 2)
$query = new WP_Query(
    array(
    'post_type'         => 'product',
    'posts_per_page'    => 10,
    'paged'				=> $paged
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
// 1 2 3 4 Paginations
echo "<br />";
$big = 999999999; // need an unlikely integer

echo paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
	'total' => $query->max_num_pages
) );
?>


<?php 
// https://docs.woothemes.com/wc-apidocs/class-WC_Cart.html

echo "<hr />";
// Set the cart
$cart = new WC_Cart();

$product_id_to_add = 26;
$quantity_of_product_to_add = 1;
// add 1 item to cart
$cart->add_to_cart($product_id_to_add, $quantity_of_product_to_add);

print_r($cart);

echo "<br />";
echo $cart->get_cart_contents_count();
echo "<br />";
echo $cart->get_cart_contents_weight();

echo "<hr />";
?>

<?php wp_reset_query(); ?>

<?php get_footer(); ?>