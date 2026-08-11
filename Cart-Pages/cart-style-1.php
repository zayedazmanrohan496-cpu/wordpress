/**
 * WooCommerce Cart Page Layout - Centered Narrow Desktop & Theme Colors Fixed
 * Primary Terracotta (#e07a5f) & Accent Teal (#2a9d8f)
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ০. কার্ট পেজের ওপরের টাইটেল (Cart/কার্ট) হাইড করা
add_filter( 'woocommerce_show_page_title', 'custom_hide_cart_page_title' );
function custom_hide_cart_page_title( $show_title ) {
    if ( is_cart() ) {
        return false;
    }
    return $show_title;
}

// ১. কুপন সেকশন ডিসেবল করা
add_filter( 'woocommerce_coupons_enabled', 'custom_disable_coupons_on_cart' );
function custom_disable_coupons_on_cart( $enabled ) {
    if ( is_cart() ) {
        return false;
    }
    return $enabled;
}

// ২. বাংলা ট্রান্সলেশন
add_filter( 'gettext', 'custom_wc_cart_bangla_translation', 20, 3 );
function custom_wc_cart_bangla_translation( $translated_text, $text, $domain ) {
    if ( is_cart() ) {
        switch ( $translated_text ) {
            case 'Product':
                $translated_text = 'প্রোডাক্ট';
                break;
            case 'Price':
                $translated_text = 'মূল্য';
                break;
            case 'Quantity':
                $translated_text = 'পরিমাণ';
                break;
            case 'Subtotal':
                $translated_text = 'মোট';
                break;
            case 'Total':
                $translated_text = 'সর্বমোট';
                break;
            case 'Cart totals':
                $translated_text = 'অর্ডার সামারি';
                break;
            case 'Update cart':
                $translated_text = 'কার্ট আপডেট করুন';
                break;
            case 'Proceed to checkout':
                $translated_text = 'অর্ডার সম্পন্ন করুন (Checkout)';
                break;
        }
    }
    return $translated_text;
}

// ৩. শিপিং টেক্সট থেকে "Shipping to Dhaka" এবং "Change address" রিমুভ করা
add_filter( 'woocommerce_shipping_estimate_html', '__return_empty_string' );

// ৪. ব্র্যান্ড থিম (Terracotta & Teal), কম উইডথ এবং স্টাইলিং এর CSS
add_action( 'wp_head', 'custom_wc_theme_cart_styles' );
function custom_wc_theme_cart_styles() {
    if ( ! is_cart() ) return;
    ?>
    <style id="custom-wc-theme-cart-css">
        /* Hide Top Cart Page Title */
        .woocommerce-cart .entry-title,
        .woocommerce-cart .page-title,
        .woocommerce-cart h1.entry-title {
            display: none !important;
        }

        /* Desktop Width Limitation & Centering */
        .woocommerce-cart .woocommerce {
            display: flex !important;
            flex-direction: column !important;
            gap: 25px !important;
            align-items: stretch !important;
            margin: 30px auto !important;
            max-width: 800px !important;
            width: 100% !important;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
        }

        /* Notice bar */
        .woocommerce-cart .woocommerce-notices-wrapper {
            width: 100% !important;
        }

        /* Top Section: Cart Form Table */
        .woocommerce-cart .woocommerce-cart-form {
            width: 100% !important;
            float: none !important;
            background: #ffffff !important;
            padding: 20px !important;
            border-radius: 12px !important;
            border: 1px solid rgba(224, 122, 95, 0.3) !important; /* Primary Border */
            box-shadow: 0 4px 15px rgba(224, 122, 95, 0.08) !important;
            box-sizing: border-box !important;
        }

        /* Bottom Section: Cart Totals */
        .woocommerce-cart .cart-collaterals {
            width: 100% !important;
            float: none !important;
            margin-top: 0 !important;
            background: #ffffff !important;
            padding: 24px !important;
            border-radius: 12px !important;
            border: 1px solid rgba(224, 122, 95, 0.3) !important; /* Primary Border */
            box-shadow: 0 4px 15px rgba(224, 122, 95, 0.08) !important;
            box-sizing: border-box !important;
        }

        .woocommerce-cart .cart-collaterals .cart_totals {
            width: 100% !important;
            float: none !important;
            text-align: left !important;
        }

        .woocommerce-cart .cart_totals h2 {
            font-size: 20px !important;
            font-weight: 700 !important;
            color: #2b2d42 !important; /* Dark Text */
            margin-top: 0 !important;
            margin-bottom: 15px !important;
            border-bottom: 2px solid #e07a5f !important; /* Primary Accent Underline */
            padding-bottom: 8px !important;
            display: inline-block !important;
        }

        /* Table Styling */
        .woocommerce-cart table.shop_table.cart {
            width: 100% !important;
            border-collapse: collapse !important;
            border: 1px solid #f1f5f9 !important;
            border-radius: 8px !important;
            overflow: hidden !important;
            margin-bottom: 0 !important;
        }

        .woocommerce-cart table.shop_table.cart th {
            background-color: #fff1ee !important; /* Soft Primary BG */
            color: #2b2d42 !important;
            font-weight: 700 !important;
            padding: 14px !important;
            border-bottom: 2px solid #fbdcd5 !important;
        }

        .woocommerce-cart table.shop_table.cart td {
            padding: 14px !important;
            border-bottom: 1px solid #f8fafc !important;
            vertical-align: middle !important;
        }

        /* Pixel-Perfect Centered Cross Icon via CSS Pseudo-elements */
        .woocommerce-cart table.shop_table.cart td.product-remove a.remove {
            position: relative !important;
            display: inline-block !important;
            width: 28px !important;
            height: 28px !important;
            border-radius: 50% !important;
            background-color: #fff1ee !important; /* Soft Primary BG */
            border: 1px solid #fbdcd5 !important;
            text-indent: -9999px !important; /* Hide default HTML text cross */
            overflow: hidden !important;
            cursor: pointer !important;
            box-sizing: border-box !important;
            transition: all 0.2s ease-in-out !important;
        }

        /* Cross Line 1 */
        .woocommerce-cart table.shop_table.cart td.product-remove a.remove::before,
        .woocommerce-cart table.shop_table.cart td.product-remove a.remove::after {
            content: '' !important;
            position: absolute !important;
            top: 50% !important;
            left: 50% !important;
            width: 12px !important;
            height: 2px !important;
            background-color: #e07a5f !important; /* Primary Terracotta */
            border-radius: 1px !important;
            transition: background-color 0.2s ease-in-out !important;
        }

        .woocommerce-cart table.shop_table.cart td.product-remove a.remove::before {
            transform: translate(-50%, -50%) rotate(45deg) !important;
        }

        .woocommerce-cart table.shop_table.cart td.product-remove a.remove::after {
            transform: translate(-50%, -50%) rotate(-45deg) !important;
        }

        /* Hover State */
        .woocommerce-cart table.shop_table.cart td.product-remove a.remove:hover {
            background-color: #e07a5f !important;
            border-color: #e07a5f !important;
            transform: scale(1.1) rotate(90deg) !important;
        }

        .woocommerce-cart table.shop_table.cart td.product-remove a.remove:hover::before,
        .woocommerce-cart table.shop_table.cart td.product-remove a.remove:hover::after {
            background-color: #ffffff !important;
        }

        .woocommerce-cart table.shop_table.cart td.product-thumbnail img {
            width: 60px !important;
            height: 60px !important;
            object-fit: cover !important;
            border-radius: 6px !important;
            border: 1px solid #fbdcd5 !important;
        }

        .woocommerce-cart table.shop_table.cart td.product-name a {
            color: #2b2d42 !important;
            font-weight: 600 !important;
            text-decoration: none !important;
        }

        .woocommerce-cart table.shop_table.cart td.product-name a:hover {
            color: #e07a5f !important;
        }

        /* Custom Quantity Buttons (+/-) */
        .woocommerce-cart .quantity {
            display: inline-flex !important;
            align-items: center !important;
            border: 1px solid #e07a5f !important;
            border-radius: 6px !important;
            overflow: hidden !important;
            background: #ffffff !important;
        }

        .woocommerce-cart .quantity input.qty {
            width: 45px !important;
            height: 36px !important;
            text-align: center !important;
            border: none !important;
            outline: none !important;
            font-weight: 600 !important;
            color: #e07a5f !important;
            -moz-appearance: textfield !important;
        }

        .woocommerce-cart .quantity input.qty::-webkit-outer-spin-button,
        .woocommerce-cart .quantity input.qty::-webkit-inner-spin-button {
            -webkit-appearance: none !important;
            margin: 0 !important;
        }

        .woocommerce-cart .custom-qty-btn {
            width: 32px !important;
            height: 36px !important;
            background: #fff1ee !important;
            color: #e07a5f !important;
            border: none !important;
            font-size: 18px !important;
            font-weight: bold !important;
            cursor: pointer !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: background 0.2s ease !important;
            user-select: none !important;
        }

        .woocommerce-cart .custom-qty-btn:hover {
            background: #fbdcd5 !important;
            color: #d06245 !important;
        }

        /* Hide Coupon Field */
        .woocommerce-cart .coupon,
        .woocommerce-cart td.actions .coupon {
            display: none !important;
        }

        /* Update Cart Button Styling */
        .woocommerce-cart table.cart td.actions {
            padding-top: 20px !important;
            background: transparent !important;
            text-align: right !important;
        }

        .woocommerce-cart button[name="update_cart"] {
            background-color: transparent !important;
            color: #e07a5f !important;
            border: 1.5px solid #e07a5f !important;
            height: 42px !important;
            border-radius: 6px !important;
            padding: 0 20px !important;
            font-weight: 600 !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
            float: right !important;
        }

        .woocommerce-cart button[name="update_cart"]:hover {
            background-color: #e07a5f !important;
            color: #ffffff !important;
        }

        /* Checkout Button (Accent Teal / Terracotta Hover) */
        .woocommerce-cart .wc-proceed-to-checkout a.checkout-button {
            display: block !important;
            text-align: center !important;
            background-color: #e07a5f !important;
            color: #ffffff !important;
            padding: 14px 20px !important;
            font-size: 16px !important;
            font-weight: 700 !important;
            border-radius: 8px !important;
            margin-top: 15px !important;
            transition: background 0.2s ease !important;
        }

        .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover {
            background-color: #d06245 !important;
        }

        /* Hide "Shipping to Dhaka" and "Change Address" elements */
        .woocommerce-cart .woocommerce-shipping-destination,
        .woocommerce-cart .shipping-calculator-button,
        .woocommerce-cart .shipping-calculator-form {
            display: none !important;
        }
    </style>
    <?php
}

// ৫. Quantity-এর দুইপাশে + এবং - বাটন এড করার JS Script
add_action( 'wp_footer', 'custom_wc_cart_qty_script' );
function custom_wc_cart_qty_script() {
    if ( ! is_cart() ) return;
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        function addQtyButtons() {
            $('.woocommerce-cart .quantity').each(function() {
                var $qtyContainer = $(this);
                if (!$qtyContainer.find('.custom-qty-btn').length) {
                    var $input = $qtyContainer.find('input.qty');
                    
                    $('<button type="button" class="custom-qty-btn minus">-</button>').insertBefore($input);
                    $('<button type="button" class="custom-qty-btn plus">+</button>').insertAfter($input);
                }
            });
        }

        addQtyButtons();
        $(document).ajaxComplete(function() {
            addQtyButtons();
        });

        $(document).on('click', '.custom-qty-btn', function() {
            var $button = $(this);
            var $input = $button.siblings('input.qty');
            var val = parseFloat($input.val()) || 0;
            var step = parseFloat($input.attr('step')) || 1;
            var min = parseFloat($input.attr('min')) || 1;
            var max = parseFloat($input.attr('max')) || 999;

            if ($button.hasClass('plus')) {
                if (val < max) {
                    $input.val(val + step).change();
                }
            } else if ($button.hasClass('minus')) {
                if (val > min) {
                    $input.val(val - step).change();
                }
            }
        });
    });
    </script>
    <?php
}

