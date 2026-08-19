/**
 * WooCommerce Custom Clean Grid & Universal Layout Engine
 */

// ১. "Add to Cart" টেক্সট পরিবর্তন করে "BUY NOW" করা
add_filter( 'woocommerce_product_add_to_cart_text', 'responsive_buy_now_button_text' );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'responsive_buy_now_button_text' );

function responsive_buy_now_button_text() {
    return __( 'BUY NOW', 'woocommerce' );
}

// ২. থিমের পুরোনো সব শপ লুপ হুক পুরোপুরি রিমুভ করা (রিসেট)
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

// ৩. আমাদের নিজস্ব ক্লিন এইচটিএমএল স্ট্রাকচার তৈরি
add_action( 'woocommerce_before_shop_loop_item', 'custom_clean_card_wrapper_start', 5 );
function custom_clean_card_wrapper_start() {
    global $product;
    $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
    
    echo '<a href="' . esc_url( $link ) . '" class="custom-card-top">';
    echo woocommerce_get_product_thumbnail( 'woocommerce_thumbnail' );
    echo '<h2 class="custom-product-title">' . get_the_title() . '</h2>';
    echo '</a>';
    
    echo '<div class="custom-card-bottom">';
    woocommerce_template_loop_price();
    woocommerce_template_loop_add_to_cart();
    echo '</div>';
}

// ৪. বুলেটপ্রুফ CSS স্টাইলিং (Theme Overriding CSS)
add_action( 'wp_head', 'custom_clean_card_styling', 999 );

function custom_clean_card_styling() {
    ?>
    <style>
        /* ==========================================================
           ১. মূল শপ গ্রিড রিসেট (GRID ENGINE)
           ========================================================== */
        ul.products {
            display: grid !important;
            grid-template-columns: repeat(4, 1fr) !important; /* ডেক্সটপে ৪ কলাম */
            gap: 16px !important;
            margin: 0 0 30px 0 !important;
            padding: 0 !important;
            list-style: none !important;
            clear: both !important;
        }

        /* থিমের হিডেন ক্লিয়ারফিক্স রিমুভ */
        ul.products::before, ul.products::after,
        ul.products li.product::before, ul.products li.product::after {
            display: none !important;
            content: "" !important;
        }

        /* ==========================================================
           ২. পণ্য কার্ড কন্টেইনার (Equal Height Box)
           ========================================================== */
        ul.products li.product {
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 !important;
            padding: 12px !important;
            float: none !important;
            box-sizing: border-box !important;

            background: #ffffff !important;
            border-radius: 8px !important;
            border: 1px solid #e5e7eb !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04) !important;
            transition: all 0.2s ease-in-out !important;

            /* কার্ড সমান রাখার জন্য Flexbox */
            display: flex !important;
            flex-direction: column !important;
            justify-content: space-between !important;
            height: 100% !important;
        }

        ul.products li.product:hover {
            border-color: #cbd5e1 !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08) !important;
        }

        /* ==========================================================
           ৩. কার্ডের ওপরের অংশ (ইমেজ + টাইটেল)
           ========================================================== */
        ul.products li.product a.custom-card-top {
            display: block !important;
            text-decoration: none !important;
            width: 100% !important;
            color: inherit !important;
        }

        /* ইমেজ স্টাইল */
        ul.products li.product a.custom-card-top img {
            width: 100% !important;
            height: auto !important;
            aspect-ratio: 1 / 1 !important; /* ১:১ স্কয়ার ইমেজ */
            object-fit: cover !important;
            border-radius: 6px !important;
            margin: 0 0 10px 0 !important;
            display: block !important;
        }

        /* প্রোডাক্ট নাম (১০০% দৃশ্যমান ফিক্স) */
        ul.products li.product .custom-product-title {
            font-size: 14px !important;
            font-weight: 600 !important;
            color: #1e293b !important;
            margin: 0 0 10px 0 !important;
            line-height: 1.4 !important;
            text-align: left !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            
            /* সর্বোচ্চ ২ লাইন থাকবে, তার বেশি হলে ... দেখাবে */
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
            min-height: 2.8em !important; /* সমান স্পেস ধরে রাখার জন্য */
        }

        /* ==========================================================
           ৪. কার্ডের নিচের অংশ (প্রাইস + বাটন)
           ========================================================== */
        ul.products li.product .custom-card-bottom {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            width: 100% !important;
            margin-top: auto !important; /* নিচে লক করা */
            padding-top: 10px !important;
            border-top: 1px solid #f1f5f9 !important;
            gap: 6px !important;
            box-sizing: border-box !important;
        }

        /* প্রাইস স্টাইল */
        ul.products li.product .custom-card-bottom .price {
            font-size: 14px !important;
            font-weight: 700 !important;
            color: #0f172a !important;
            margin: 0 !important;
            text-align: left !important;
            line-height: 1.2 !important;
            white-space: nowrap !important;
        }

        ul.products li.product .custom-card-bottom .price del {
            color: #94a3b8 !important;
            font-size: 11px !important;
            font-weight: 400 !important;
            display: inline-block !important;
            margin-right: 2px !important;
        }

        ul.products li.product .custom-card-bottom .price ins {
            text-decoration: none !important;
            display: inline-block !important;
        }

        /* বাটন স্টাইল */
        ul.products li.product .custom-card-bottom .button,
        ul.products li.product .custom-card-bottom .added_to_cart {
            background-color: #334155 !important;
            color: #ffffff !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            letter-spacing: 0.5px !important;
            padding: 8px 10px !important;
            border-radius: 6px !important;
            text-transform: uppercase !important;
            border: 1px solid #334155 !important;
            transition: background-color 0.2s ease !important;
            white-space: nowrap !important;
            margin: 0 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            flex-shrink: 0 !important;
            line-height: 1 !important;
            text-decoration: none !important;
        }

        ul.products li.product .custom-card-bottom .button:hover,
        ul.products li.product .custom-card-bottom .added_to_cart:hover {
            background-color: #0f172a !important;
            border-color: #0f172a !important;
            color: #ffffff !important;
        }

        ul.products li.product .custom-card-bottom .button.added {
            display: none !important;
        }

        /* ==========================================================
           ৫. রেসপন্সিভ লেআউট (Mobile & Tablet)
           ========================================================== */
        @media (max-width: 992px) {
            ul.products {
                grid-template-columns: repeat(3, 1fr) !important;
                gap: 12px !important;
            }
        }

        @media (max-width: 576px) {
            ul.products {
                grid-template-columns: repeat(2, 1fr) !important; /* মোবাইলে ২ কলাম */
                gap: 10px !important;
            }

            ul.products li.product {
                padding: 8px !important;
            }

            ul.products li.product .custom-product-title {
                font-size: 12px !important;
                min-height: 2.6em !important;
            }

            ul.products li.product .custom-card-bottom .price {
                font-size: 12px !important;
            }

            ul.products li.product .custom-card-bottom .button,
            ul.products li.product .custom-card-bottom .added_to_cart {
                padding: 6px 8px !important;
                font-size: 9px !important;
            }
        }
    </style>
    <?php
}


