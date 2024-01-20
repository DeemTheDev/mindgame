<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<p>Dear Seeker of Mystery,<br><br>It was wonderful having you over to solve our mystery, we hope you had a fantastic time!<br><br>We will be posting your picture up on social media shortly. Please feel free to share far and wide, and challenge your friends to beat your escape time!<br><br>If you could take 2 minutes to write a review for us, it would be hugely appreciated. As we have a rather unique business, we depend on your reviews to grow! We are listed on <a href="https://search.google.com/local/writereview?placeid=ChIJx5Q39FkP9x4RZkJpxBXmdQw">Google</a>, <a href="https://www.facebook.com/pg/MindgameEscape/reviews/">Facebook</a> as well as <a href="https://www.tripadvisor.co.za/Attraction_Review-g10679656-d12827635-Reviews-Mindgame_Escape-Umhlanga_KwaZulu_Natal.html">Tripadvisor</a>.<br><br>To make it easy to find your image of suspense and adventure which will be uploaded soon, we have included some handy links to our social media image pages;<br><br><a href="https://www.tripadvisor.co.za/Attraction_Review-g10679656-d12827635-Reviews-Mindgame_Escape-Umhlanga_KwaZulu_Natal.html">Tripadvisor</a>, <a href="https://www.facebook.com/MindgameEscape/">Facebook</a>, <a href="https://twitter.com/MindgameEscape">Twitter</a>, <a href="https://www.linkedin.com/company/18214668/">LinkedIn</a>, <a href="https://plus.google.com/116195037511663654261">Google+</a> and <a href="https://www.instagram.com/mindgameescape/">Instagram</a><br><br>Our mission is happy customers who have had fun! If this for some reason did not happen, please email the owner directly on nick@mindgame.co.za and we will do our absolute best to make things right!<br><br>Till next time we meet,<br><br>Your friends at Mindgame Escape Room</p>

<?php

/**
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */

//do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
//do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
//do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::email_footer() Output the email footer
 */
//do_action( 'woocommerce_email_footer', $email );
