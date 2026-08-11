/**
 * WooCommerce Custom Horizontal Product Card Layout
 * Terracotta Color Scheme Applied (#e07a5f / #d06245)
 */

// 0. Disable WooCommerce "Has been added to your cart" notice
add_filter( 'wc_add_to_cart_message_html', '__return_false' );

// 1. Open Details Wrapper (Right side container)
add_action('woocommerce_before_shop_loop_item_title', 'custom_wc_details_wrapper_open', 15);
function custom_wc_details_wrapper_open() {
    echo '<div class="custom-wc-card-details">';
}

// 2. Open Button Row Container
add_action('woocommerce_after_shop_loop_item', 'custom_wc_button_group_open', 9);
function custom_wc_button_group_open() {
    echo '<div class="custom-card-buttons">';
}

// 3. Add Buy Now Button
add_action('woocommerce_after_shop_loop_item', 'custom_wc_add_buy_now_button', 11);
function custom_wc_add_buy_now_button() {
    global $product;
    if ( ! $product ) return;

    $product_id = $product->get_id();
    $checkout_url = site_url('/checkout/?add-to-cart=' . $product_id);

    echo '<a href="' . esc_url($checkout_url) . '" class="button custom-buy-now-btn">Buy now</a>';
}

// 4. Close Containers
add_action('woocommerce_after_shop_loop_item', 'custom_wc_details_wrapper_close', 12);
function custom_wc_details_wrapper_close() {
    echo '</div>'; // Close .custom-card-buttons
    echo '</div>'; // Close .custom-wc-card-details
}

// 5. CSS Styles & Scripts
add_action('wp_head', 'custom_wc_card_horizontal_styles');
function custom_wc_card_horizontal_styles() {
    if ( is_admin() ) return;
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style id="custom-wc-card-desktop-adjust-style">
        /* Hide All WooCommerce Added to Cart Messages Completely */
        .woocommerce-message, 
        .woocommerce-notice, 
        .woocommerce-error, 
        .woocommerce-info {
            display: none !important;
        }

        /* Card Outer Container */
        .woocommerce ul.products li.product {
            background: #ffffff !important;
            border: 1px solid #f1f5f9 !important;
            border-radius: 16px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04) !important;
            padding: 40px 32px !important;
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            justify-content: flex-start !important;
            gap: 32px !important;
            box-sizing: border-box !important;
            font-family: 'Inter', sans-serif !important;
            margin: 0 auto 24px auto !important;
            max-width: 720px !important;
            width: 100% !important;
            float: none !important;
            min-height: 260px !important;
        }

        /* Image Container */
        .woocommerce ul.products li.product > a.woocommerce-LoopProduct-link,
        .woocommerce ul.products li.product > a:first-child {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 38% !important;
            max-width: 220px !important;
            flex-shrink: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .woocommerce ul.products li.product img {
            width: 100% !important;
            height: auto !important;
            max-height: 220px !important;
            object-fit: contain !important;
            border-radius: 8px !important;
            margin: 0 !important;
        }

        /* Right Side Content Container */
        .woocommerce ul.products li.product .custom-wc-card-details {
            display: flex !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            justify-content: center !important;
            flex-grow: 1 !important;
            width: 62% !important;
        }

        /* Product Title */
        .woocommerce ul.products li.product .custom-wc-card-details .woocommerce-loop-product__title,
        .woocommerce ul.products li.product .custom-wc-card-details h2 {
            font-family: 'Inter', sans-serif !important;
            font-size: 1.6rem !important;
            font-weight: 700 !important;
            color: #0f172a !important;
            margin: 0 0 16px 0 !important;
            padding: 0 !important;
            line-height: 1.3 !important;
        }

        /* Price Color Updated to #e07a5f */
        .woocommerce ul.products li.product .custom-wc-card-details .price {
            font-family: 'Inter', sans-serif !important;
            font-size: 1.5rem !important;
            font-weight: 700 !important;
            color: #e07a5f !important;
            margin: 0 0 28px 0 !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
        }

        .woocommerce ul.products li.product .custom-wc-card-details .price del {
            color: #94a3b8 !important;
            font-size: 1.1rem !important;
            font-weight: 500 !important;
        }

        .woocommerce ul.products li.product .custom-wc-card-details .price ins {
            text-decoration: none !important;
            color: #e07a5f !important;
        }

        /* Buttons Wrapper (Single Row) */
        .woocommerce ul.products li.product .custom-wc-card-details .custom-card-buttons {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            justify-content: flex-start !important;
            gap: 12px !important;
            width: 100% !important;
            flex-wrap: nowrap !important;
            margin-top: 4px !important;
            padding: 0 !important;
        }

        /* Desktop Adjustment */
        @media (min-width: 641px) {
            .woocommerce ul.products li.product .custom-wc-card-details .custom-card-buttons {
                margin-left: -12px !important;
            }
        }

        /* Common Button Styling */
        .woocommerce ul.products li.product .custom-card-buttons .button {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            height: 46px !important;
            padding: 0 20px !important;
            font-family: 'Inter', sans-serif !important;
            font-size: 0.95rem !important;
            font-weight: 600 !important;
            border-radius: 8px !important;
            text-decoration: none !important;
            box-sizing: border-box !important;
            transition: all 0.2s ease-in-out !important;
            margin: 0 !important;
            cursor: pointer !important;
            line-height: 1 !important;
            white-space: nowrap !important;
        }

        /* Add to Cart Button (Outlined - Primary: #e07a5f, Hover: #d06245) */
        .woocommerce ul.products li.product .custom-card-buttons .add_to_cart_button {
            background-color: #ffffff !important;
            color: #e07a5f !important;
            border: 1.5px solid #e07a5f !important;
        }

        .woocommerce ul.products li.product .custom-card-buttons .add_to_cart_button:hover {
            background-color: #fdf5f3 !important;
            color: #d06245 !important;
            border-color: #d06245 !important;
        }

        /* SVG icon stroke */
        .woocommerce ul.products li.product .custom-card-buttons .add_to_cart_button::before {
            content: '' !important;
            display: inline-block !important;
            width: 18px !important;
            height: 18px !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23e07a5f' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='9' cy='21' r='1'%3E%3C/circle%3E%3Ccircle cx='20' cy='21' r='1'%3E%3C/circle%3E%3Cpath d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'%3E%3C/path%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: center !important;
            background-size: contain !important;
        }

        .woocommerce ul.products li.product .custom-card-buttons .add_to_cart_button:hover::before {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23d06245' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='9' cy='21' r='1'%3E%3C/circle%3E%3Ccircle cx='20' cy='21' r='1'%3E%3C/circle%3E%3Cpath d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'%3E%3C/path%3E%3C/svg%3E") !important;
        }

        /* Buy Now Button (Solid - Primary: #e07a5f, Hover: #d06245) */
        .woocommerce ul.products li.product .custom-card-buttons .custom-buy-now-btn {
            background-color: #e07a5f !important;
            color: #ffffff !important;
            border: 1.5px solid #e07a5f !important;
        }

        .woocommerce ul.products li.product .custom-card-buttons .custom-buy-now-btn:hover {
            background-color: #d06245 !important;
            border-color: #d06245 !important;
            color: #ffffff !important;
        }

        .woocommerce ul.products li.product .custom-card-buttons .custom-buy-now-btn::before {
            content: '' !important;
            display: inline-block !important;
            width: 18px !important;
            height: 18px !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23ffffff' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='9' cy='21' r='1'%3E%3C/circle%3E%3Ccircle cx='20' cy='21' r='1'%3E%3C/circle%3E%3Cpath d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'%3E%3C/path%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: center !important;
            background-size: contain !important;
        }

        /* Hide extra default WooCommerce cart text links */
        .woocommerce ul.products li.product a.added_to_cart {
            display: none !important;
        }

        /* MOBILE RESPONSIVENESS & CENTERING */
        @media (max-width: 640px) {
            .woocommerce ul.products li.product {
                flex-direction: column !important;
                align-items: center !important;
                text-align: center !important;
                padding: 24px 16px !important;
                gap: 20px !important;
                max-width: 100% !important;
            }

            .woocommerce ul.products li.product > a.woocommerce-LoopProduct-link,
            .woocommerce ul.products li.product > a:first-child {
                width: 100% !important;
                max-width: 100% !important;
                justify-content: center !important;
            }

            .woocommerce ul.products li.product .custom-wc-card-details {
                width: 100% !important;
                max-width: 100% !important;
                align-items: center !important;
                text-align: center !important;
            }

            .woocommerce ul.products li.product .custom-wc-card-details .woocommerce-loop-product__title,
            .woocommerce ul.products li.product .custom-wc-card-details h2 {
                text-align: center !important;
                margin-bottom: 10px !important;
            }

            .woocommerce ul.products li.product .custom-wc-card-details .price {
                justify-content: center !important;
                margin-bottom: 20px !important;
            }

            .woocommerce ul.products li.product .custom-wc-card-details .custom-card-buttons {
                justify-content: center !important;
                width: 100% !important;
                margin-left: 0 !important;
            }

            .woocommerce ul.products li.product .custom-card-buttons .button {
                padding: 0 16px !important;
                font-size: 0.88rem !important;
                height: 42px !important;
            }
        }
    </style>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(document.body).on('added_to_cart', function(event, fragments, cart_hash, $button) {
                var cart_url = (typeof wc_add_to_cart_params !== 'undefined') ? wc_add_to_cart_params.cart_url : '/cart/';
                $button.text('View Cart').attr('href', cart_url).removeClass('add_to_cart_button ajax_add_to_cart');
            });
        });
    </script>
    <?php
}

