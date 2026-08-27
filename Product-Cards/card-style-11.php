<?php
/**
 * Plugin Name: Custom WooCommerce Product Card - Fully Responsive Version
 * Description: Optimized product card structure with outline SVG stars, repositioned rating, and border/shadow removed.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// ১. উকমার্স ডিফল্ট এলিমেন্টগুলো রিমুভ করা
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

// ২. কাস্টম স্ট্রাকচার হুক
add_action( 'woocommerce_before_shop_loop_item', 'kamal_card_wrapper_start', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'kamal_image_wrap_start', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'kamal_custom_hover_buttons', 20 );
add_action( 'woocommerce_before_shop_loop_item_title', 'kamal_image_wrap_end', 25 );
add_action( 'woocommerce_shop_loop_item_title', 'kamal_custom_product_title', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'kamal_custom_product_rating', 5 ); 
add_action( 'woocommerce_after_shop_loop_item_title', 'kamal_custom_product_price', 10 );   
add_action( 'woocommerce_after_shop_loop_item', 'kamal_card_wrapper_end', 20 );

// ফাংশনসমূহ
function kamal_card_wrapper_start() { echo '<div class="custom-product-card-box">'; }

function kamal_image_wrap_start() {
    global $product;
    echo '<div class="custom-image-hover-container">';
    echo '<a href="' . esc_url( get_permalink( $product->get_id() ) ) . '" class="custom-main-thumb-link">';
    echo woocommerce_get_product_thumbnail();
    echo '</a>'; 
}

function kamal_custom_hover_buttons() {
    global $product;
    echo '<div class="custom-hover-buttons-overlay">';
    echo '<a href="' . esc_url( get_permalink( $product->get_id() ) ) . '" class="button custom-btn-details">Product Details</a>';
    echo '<a href="' . esc_url( $product->add_to_cart_url() ) . '" class="button custom-btn-buynow ajax_add_to_cart add_to_cart_button" data-product_id="' . esc_attr( $product->get_id() ) . '">Order Now</a>';
    echo '</div>';
}

function kamal_image_wrap_end() { echo '</div>'; }

function kamal_custom_product_title() {
    global $product;
    echo '<h2 class="woocommerce-loop-product__title"><a href="' . esc_url( get_permalink( $product->get_id() ) ) . '">' . get_the_title() . '</a></h2>';
}

function kamal_custom_product_rating() {
    $svg_star = '<svg class="custom-svg-star" viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>';
    
    echo '<div class="custom-star-rating">';
    echo str_repeat( $svg_star, 5 );
    echo '</div>';
}

function kamal_custom_product_price() {
    global $product;
    echo '<div class="custom-product-price">' . $product->get_price_html() . '</div>';
}

function kamal_card_wrapper_end() { echo '</div>'; }

// ৩. স্টাইল এবং স্ক্রিপ্ট
add_action( 'wp_head', 'kamal_custom_product_card_css_js' );
function kamal_custom_product_card_css_js() {
    $cart_url = esc_url( wc_get_cart_url() );
    ?>
    <!-- Google Font for Buttons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    
    <style>
        ul.products li.product, .woocommerce ul.products li.product {
            margin-bottom: 15px !important; 
        }

        .custom-product-card-box { 
            position: relative; 
            background: #fff; 
            margin-bottom: 0 !important; 
            text-align: center !important; 
            padding: 0 !important; 
            border: none !important; 
            box-shadow: none !important; 
            overflow: hidden;
        }
        
        .custom-image-hover-container { position: relative; overflow: hidden; width: 100%; height: 260px; display: block; margin-bottom: 0 !important; }
        .custom-main-thumb-link { display: block; width: 100%; height: 100%; }
        .custom-image-hover-container img { width: 100%; height: 100% !important; object-fit: cover; display: block; }
        
        .custom-hover-buttons-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4); display: flex; flex-direction: column; justify-content: center; align-items: center; opacity: 0; visibility: hidden; transition: all 0.3s ease-in-out; z-index: 9; }
        
        @media (min-width: 769px) {
            .custom-image-hover-container:hover .custom-hover-buttons-overlay { opacity: 1; visibility: visible; }
        }
        
        .custom-image-hover-container.touch-active .custom-hover-buttons-overlay { opacity: 1; visibility: visible; }
        
        /* বাটন ডিজাইন এবং গ্যাপ আরও বৃদ্ধি */
        .custom-hover-buttons-overlay a { 
            width: 70% !important; 
            text-align: center !important; 
            padding: 10px 12px !important; 
            border-radius: 4px !important; 
            font-size: 13px !important; 
            text-decoration: none !important; 
            font-family: 'Poppins', sans-serif !important;
            font-weight: 500 !important; 
            box-shadow: none !important; 
            outline: none !important; 
            border: none !important; 
            transition: opacity 0.2s ease;
        }

        /* দুটি বাটনের মাঝখানের দূরত্ব (Gap) আরও বাড়ানো হলো */
        .custom-btn-details { 
            background-color: #ffffff !important; 
            color: #222222 !important; 
            margin-bottom: 22px !important; /* গ্যাপ বাড়িয়ে ২২ পিক্সেল করা হলো */
            margin-top: 0 !important;
        }
        
        .custom-btn-buynow { 
            background-color: #a3155b !important; 
            color: #ffffff !important; 
            margin-top: 0 !important; 
            margin-bottom: 0 !important;
        }
        
        .custom-hover-buttons-overlay a:hover {
            opacity: 0.9;
        }
        
        .custom-btn-buynow:before, .custom-btn-buynow:after { content: none !important; display: none !important; }
        
        .custom-product-card-box .woocommerce-loop-product__title { margin-top: 10px !important; margin-bottom: 4px !important; font-size: 15px !important; padding: 0 10px !important; }
        .custom-product-card-box .woocommerce-loop-product__title a { color: #000000 !important; }
        .custom-product-card-box .woocommerce-loop-product__title a:hover { color: #8b0040 !important; }
        
        .custom-star-rating { color: #ffb800 !important; margin: 4px 0 8px 0 !important; padding: 0 10px !important; display: flex; justify-content: center; gap: 3px; }
        .custom-svg-star { display: inline-block; fill: none; stroke: #ffb800; stroke-width: 2px; }

        .custom-product-price { padding: 0 10px 12px 10px !important; }
        .custom-product-price, .custom-product-price span, .custom-product-price bdi, .custom-product-price ins { color: #8b0040 !important; font-weight: 600 !important; }
        
        .woocommerce-notices-wrapper, .added_to_cart.wc-forward { display: none !important; }

        @media only screen and (min-width: 769px) and (max-width: 1024px) {
            .custom-image-hover-container { height: 240px !important; }
        }

        @media only screen and (max-width: 768px) {
            ul.products li.product, .woocommerce ul.products li.product {
                margin-bottom: 12px !important; 
            }
            .custom-image-hover-container { 
                height: 210px !important; 
            }
            .custom-hover-buttons-overlay a {
                width: 80% !important; 
                padding: 10px 10px !important; 
                font-size: 12px !important;
            }
            .custom-btn-details {
                margin-bottom: 18px !important; /* মোবাইলের জন্যও গ্যাপ বাড়িয়ে দেওয়া হলো */
            }
        }
    </style>

    <script>
        jQuery(document).ready(function($) {
            $(document).on('click', '.custom-image-hover-container', function(e) {
                if (window.innerWidth <= 768) {
                    var $container = $(this);
                    if (!$container.hasClass('touch-active')) {
                        e.preventDefault();
                        $('.custom-image-hover-container').removeClass('touch-active');
                        $container.addClass('touch-active');
                    }
                }
            });

            $(document, document.body).on('click', function(e) {
                if (!$(e.target).closest('.custom-image-hover-container').length) {
                    $('.custom-image-hover-container').removeClass('touch-active');
                }
            });

            $(document.body).on('added_to_cart', function(frag, fragments, cart_hash, $button) {
                if ($button && $button.hasClass('custom-btn-buynow')) {
                    $button.html('View Cart'); 
                    $button.attr('href', '<?php echo $cart_url; ?>');
                    $button.removeClass('ajax_add_to_cart add_to_cart_button');
                }
            });
        });
    </script>
    <?php
}

