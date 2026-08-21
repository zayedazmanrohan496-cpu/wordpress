/**
 * Plugin Name: Custom WooCommerce Product Card - Fully Responsive Version
 * Description: Optimized product card structure with fixed mobile height, CSS, and JS fixes.
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
add_action( 'woocommerce_after_shop_loop_item_title', 'kamal_custom_product_price', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'kamal_custom_product_rating', 15 );
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
    echo '<a href="' . esc_url( $product->add_to_cart_url() ) . '" class="button custom-btn-buynow ajax_add_to_cart add_to_cart_button" data-product_id="' . esc_attr( $product->get_id() ) . '">Buy Now</a>';
    echo '</div>';
}

function kamal_image_wrap_end() { echo '</div>'; }

function kamal_custom_product_title() {
    global $product;
    echo '<h2 class="woocommerce-loop-product__title"><a href="' . esc_url( get_permalink( $product->get_id() ) ) . '">' . get_the_title() . '</a></h2>';
}

function kamal_custom_product_price() {
    global $product;
    echo '<div class="custom-product-price">' . $product->get_price_html() . '</div>';
}

function kamal_custom_product_rating() {
    echo '<div class="custom-star-rating">★ ★ ★ ★ ★</div>';
}

function kamal_card_wrapper_end() { echo '</div>'; }

// ৩. স্টাইল এবং স্ক্রিপ্ট
add_action( 'wp_head', 'kamal_custom_product_card_css_js' );
function kamal_custom_product_card_css_js() {
    $cart_url = esc_url( wc_get_cart_url() );
    ?>
    <style>
        ul.products li.product, .woocommerce ul.products li.product {
            margin-bottom: 15px !important; 
        }

        .custom-product-card-box { 
            position: relative; 
            background: #fff; 
            margin-bottom: 0 !important; 
            text-align: center !important; 
            padding: 8px 8px 12px 8px !important; 
            border: 1px solid #e0e0e0; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); 
        }
        
        /* ডেস্কটপের জন্য ইমেজ কন্টেই너 হাইট (পূর্বে 270px ছিল, বাড়িয়ে 340px করা হয়েছে) */
        .custom-image-hover-container { position: relative; overflow: hidden; width: 100%; height: 340px; display: block; margin-bottom: 5px !important; }
        .custom-main-thumb-link { display: block; width: 100%; height: 100%; }
        .custom-image-hover-container img { width: 100%; height: 100% !important; object-fit: cover; display: block; }
        
        .custom-hover-buttons-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4); display: flex; flex-direction: column; justify-content: center; align-items: center; opacity: 0; visibility: hidden; transition: all 0.3s ease-in-out; z-index: 9; }
        
        /* ডেস্কটপের জন্য সাধারণ হোভার */
        @media (min-width: 769px) {
            .custom-image-hover-container:hover .custom-hover-buttons-overlay { opacity: 1; visibility: visible; }
        }
        
        /* মোবাইলের জন্য টাচ ক্লাস সক্রিয় হলে ওভারলে দেখাবে */
        .custom-image-hover-container.touch-active .custom-hover-buttons-overlay { opacity: 1; visibility: visible; }
        
        .custom-hover-buttons-overlay a { width: 70% !important; text-align: center !important; margin: 6px 0 !important; padding: 10px 12px !important; border-radius: 0 !important; font-size: 13px !important; text-decoration: none !important; color: #fff !important; font-weight: 600 !important; box-shadow: none !important; outline: none !important; border: none !important; }
        .custom-btn-details { background-color: #222 !important; }
        .custom-btn-buynow { background-color: #8b0040 !important; }
        
        /* টিক চিহ্ন রিমুভ করার জন্য */
        .custom-btn-buynow:before, .custom-btn-buynow:after { content: none !important; display: none !important; }
        
        .custom-product-card-box .woocommerce-loop-product__title { margin-top: 2px !important; margin-bottom: 4px !important; font-size: 15px !important; }
        .custom-product-card-box .woocommerce-loop-product__title a { color: #000000 !important; }
        .custom-product-card-box .woocommerce-loop-product__title a:hover { color: #8b0040 !important; }
        .custom-product-price, .custom-product-price span, .custom-product-price bdi, .custom-product-price ins { color: #8b0040 !important; font-weight: 600 !important; }
        .custom-star-rating { color: #ffc107 !important; font-size: 14px !important; margin-top: 2px !important; margin-bottom: 8px !important; }
        .woocommerce-notices-wrapper, .added_to_cart.wc-forward { display: none !important; }

        /* মোবাইলের জন্য রেসপন্সিভ মিডিয়া কুয়েরি */
        @media only screen and (max-width: 768px) {
            ul.products li.product, .woocommerce ul.products li.product {
                margin-bottom: 12px !important; 
            }
            .custom-image-hover-container { 
                /* মোবাইলের জন্য ইমেজ কন্টেইনার হাইট (পূর্বে 140px ছিল, বাড়িয়ে 210px করা হয়েছে) */
                height: 210px !important; 
            }
            .custom-hover-buttons-overlay a {
                width: 80% !important; 
                padding: 6px 8px !important;
                font-size: 11px !important;
                margin: 4px 0 !important;
            }
        }
    </style>

    <script>
        jQuery(document).ready(function($) {
            // মোবাইল বা টাচ ডিভাইসে প্রথম টাচে শুধু ওভারলে দেখাবে, পেজে রিডাইরেক্ট করবে না
            $(document).on('click', '.custom-image-hover-container', function(e) {
                if (window.innerWidth <= 768) {
                    var $container = $(this);
                    // যদি ওভারলে ইতিমধ্যে ওপেন না থাকে, তবে প্রথম ক্লিকে ওপেন করব এবং লিংক আটকাব
                    if (!$container.hasClass('touch-active')) {
                        e.preventDefault();
                        // অন্য কোনো কার্ডে টাচ করা থাকলে সেটি বন্ধ করে দেব
                        $('.custom-image-hover-container').removeClass('touch-active');
                        $container.addClass('touch-active');
                    }
                    // যদি ওভারলে ওপেন থাকে, তবে ভেতরের বাটনে ক্লিক কাজ করবে
                }
            });

            // যদি ইউজার প্রোডাক্ট কার্ডের বাইরে কোথাও টাচ করে, তবে ওভারলে বন্ধ হয়ে যাবে
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.custom-image-hover-container').length) {
                    $('.custom-image-hover-container').removeClass('touch-active');
                }
            });

            // এজাক্স অ্যাড টু কার্ট ফিক্স
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


