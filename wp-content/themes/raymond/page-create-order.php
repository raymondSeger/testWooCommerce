<?php 
/*
 Template Name: Page Create Orders
 */
get_header(); 

// create new order object with some products inside it,
?>



<div>
	<h1>Page Create Orders</h1>
</div>

<?php 

// current logged in user
$user_id = get_current_user_id();
if($user_id == 0){ 
    echo "error";
}

// The coupon
// https://docs.woothemes.com/wc-apidocs/class-WC_Coupon.html
$the_coupon = new WC_Coupon('reduceprice');
echo $the_coupon->enable_free_shipping( );
echo $the_coupon->is_valid_for_cart( );
echo $the_coupon->coupon_amount;

// DOCS: https://docs.woothemes.com/wc-apidocs/class-WC_Abstract_Order.html
// and 
// https://docs.woothemes.com/wc-apidocs/class-WC_Order.html

// create the order Item
$order = wc_create_order(array(
    'customer_id'   => $user_id,
    'customer_note' => "No note!",
));


foreach( WC()->cart->get_cart() as $cart_item ) {
    $product    = new WC_Product($cart_item['product_id']);
    $quantity   = $cart_item['quantity'];
    $order->add_product( $product, $quantity );
}

// set address
$address = [
    'first_name' => 'this is fast order',
    'phone'      => $phone,
    'address_1'  => 'без адреса',
    'country'    => 'RU'
];
$order->set_address( $address, 'billing' );
$order->set_address( $address, 'shipping' );


// calculate total, shipping, taxes
$order->calculate_totals();
$order->calculate_shipping();
$order->calculate_taxes( );

// if we use stock
// $order->reduce_order_stock();

// set the status to completed instead of the default "pending payment"
$order->update_status('completed');

$total      = $order->get_total();
$order_id   = $order->id;
$order_user = $order->get_user();

$order_time = $order->order_date;

echo $total;
echo "<br />";
echo $order_id;
echo "<br />";
print_r( $order_user );
echo "<br />";
echo $order_time;
echo "<br />";

// delete the cart
WC()->cart->empty_cart();
?>

<?php get_footer(); ?>