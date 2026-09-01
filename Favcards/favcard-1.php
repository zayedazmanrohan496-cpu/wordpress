/**
 * WooCommerce Sharp Product Card Design (Responsive & Modern Font Fixed)
 * Custom Logo Theme Colors | 4px Border Radius | Outlined Button (Transparent BG)
 */

add_action('wp_head', 'custom_light_green_outlined_woocommerce_card');
function custom_light_green_outlined_woocommerce_card() {
    if ( ! is_admin() ) {
        ?>
        <!-- Google Font Import: Plus Jakarta Sans & Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

        <style id="custom-wc-card-outlined-style">
            /* Card Container */
            .woocommerce ul.products li.product {
                background: #ffffff !important;
                border: 1px solid #cbd5e1 !important;
                border-radius: 4px !important;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03) !important;
                padding: 16px !important;
                position: relative !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: space-between !important;
                box-sizing: border-box !important;
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
            }

            /* Product Image */
            .woocommerce ul.products li.product a.woocommerce-LoopProduct-link {
                display: block !important;
                border-radius: 0px !important;
                margin-bottom: 12px !important;
                position: relative !important;
                background: transparent !important;
            }

            .woocommerce ul.products li.product img {
                border-radius: 0px !important;
                border: none !important;
                box-shadow: none !important;
                width: 100% !important;
                height: auto !important;
                object-fit: cover !important;
            }

            /* Sale Badge (Top Right Logo Orange) */
            .woocommerce ul.products li.product .onsale {
                top: 0px !important;
                right: 0px !important;
                left: auto !important;
                background: #F39C12 !important; /* Logo Orange */
                color: #ffffff !important;
                border-radius: 0px !important;
                box-shadow: none !important;
                padding: 6px 10px !important;
                font-family: 'Inter', sans-serif !important;
                font-size: 0.75rem !important;
                font-weight: 700 !important;
                text-transform: uppercase !important;
                letter-spacing: 0.5px !important;
                min-height: auto !important;
                line-height: 1 !important;
                z-index: 4 !important;
            }

            /* Title (Plus Jakarta Sans - Logo Navy Blue) */
            .woocommerce ul.products li.product .woocommerce-loop-product__title,
            .woocommerce ul.products li.product h2 {
                font-family: 'Plus Jakarta Sans', sans-serif !important;
                font-size: 1.05rem !important;
                font-weight: 700 !important;
                color: #1D2D3D !important; /* Logo Dark Navy Blue */
                margin: 8px 0 8px 0 !important;
                padding: 0 !important;
                line-height: 1.35 !important;
            }

            /* Price Styling (Inter Variable Font - Logo Green) */
            .woocommerce ul.products li.product .price {
                font-family: 'Inter', sans-serif !important;
                font-size: 1.15rem !important;
                font-weight: 800 !important;
                color: #22c55e !important; /* Logo Green */
                margin-bottom: 14px !important;
                display: flex !important;
                align-items: center !important;
                gap: 8px !important;
            }

            .woocommerce ul.products li.product .price del {
                color: #94a3b8 !important;
                font-weight: 500 !important;
                font-size: 0.9rem !important;
            }

            .woocommerce ul.products li.product .price ins {
                text-decoration: none !important;
                color: #22c55e !important; /* Logo Green */
            }

            /* Outlined Logo Green Button */
            .woocommerce ul.products li.product .button {
                background-color: transparent !important;
                color: #22c55e !important; /* Logo Green */
                border-radius: 4px !important;
                border: 1.5px solid #22c55e !important; /* Logo Green */
                box-shadow: none !important;
                padding: 10px 14px !important;
                font-family: 'Inter', sans-serif !important;
                font-weight: 700 !important;
                font-size: 0.85rem !important;
                letter-spacing: 0.3px !important;
                text-align: center !important;
                text-transform: uppercase !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                gap: 8px !important;
                margin-top: auto !important;
                width: 100% !important;
                box-sizing: border-box !important;
                transition: all 0.2s ease !important;
            }

            /* Updated Unique SVG Shopping Cart Icon */
            .woocommerce ul.products li.product .button::before {
                content: '' !important;
                display: inline-block !important;
                width: 16px !important;
                height: 16px !important;
                flex-shrink: 0 !important;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2322c55e' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='9' cy='21' r='1'%3E%3C/circle%3E%3Ccircle cx='20' cy='21' r='1'%3E%3C/circle%3E%3Cpath d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'%3E%3C/path%3E%3C/svg%3E") !important;
                background-repeat: no-repeat !important;
                background-position: center !important;
                background-size: contain !important;
                transition: all 0.2s ease !important;
            }

            /* Button Hover Effect */
            .woocommerce ul.products li.product .button:hover {
                background-color: #16a34a !important; /* Logo Green Hover */
                color: #ffffff !important;
                border-color: #16a34a !important;
            }

            /* Change Unique SVG Icon Color to White on Hover */
            .woocommerce ul.products li.product .button:hover::before {
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23ffffff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='9' cy='21' r='1'%3E%3C/circle%3E%3Ccircle cx='20' cy='21' r='1'%3E%3C/circle%3E%3Cpath d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'%3E%3C/path%3E%3C/svg%3E") !important;
            }

            /* Hide Default WooCommerce 'View Cart' Text Link */
            .woocommerce ul.products li.product a.added_to_cart {
                display: none !important;
            }

            /* -------------------------------------------------- */
            /* Mobile & Tablet Responsive Typography Adjustments  */
            /* -------------------------------------------------- */
            @media (max-width: 768px) {
                .woocommerce ul.products li.product {
                    padding: 12px !important;
                }

                /* Responsive Product Name */
                .woocommerce ul.products li.product .woocommerce-loop-product__title,
                .woocommerce ul.products li.product h2 {
                    font-size: 0.88rem !important;
                    margin: 6px 0 6px 0 !important;
                }

                /* Responsive Product Price */
                .woocommerce ul.products li.product .price {
                    font-size: 0.95rem !important;
                    margin-bottom: 10px !important;
                    gap: 4px !important;
                }

                .woocommerce ul.products li.product .price del {
                    font-size: 0.8rem !important;
                }

                /* Responsive Button */
                .woocommerce ul.products li.product .button {
                    padding: 6px 8px !important;
                    font-size: 0.72rem !important;
                    gap: 4px !important;
                }

                .woocommerce ul.products li.product .button::before {
                    width: 13px !important;
                    height: 13px !important;
                }

                /* Responsive Sale Badge */
                .woocommerce ul.products li.product .onsale {
                    padding: 4px 8px !important;
                    font-size: 0.65rem !important;
                }
            }
        </style>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                // Update button text to 'VIEW CART' on AJAX Add to Cart
                $(document.body).on('added_to_cart', function(event, fragments, cart_hash, $button) {
                    var cart_url = (typeof wc_add_to_cart_params !== 'undefined') ? wc_add_to_cart_params.cart_url : '/cart/';
                    $button.text('VIEW CART').attr('href', cart_url).removeClass('add_to_cart_button ajax_add_to_cart');
                });
            });
        </script>
        <?php
    }
}

