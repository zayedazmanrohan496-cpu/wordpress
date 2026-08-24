/**
 * Ultra-Responsive & Animated WooCommerce Single Product (Vertical Gallery + Advanced Tabs)
 * WPCode / Code Snippets-এ 'PHP Snippet' সিলেক্ট করে রান করুন।
 */

// ১. রেসপন্সিভ CSS স্টাইল হেডারে ইনজেক্ট করা
add_action('wp_head', 'ultra_responsive_product_page_styles');
function ultra_responsive_product_page_styles() {
    if ( is_product() ) {
        ?>
        <style>
            /* Global Layout Base */
            html {
                scroll-behavior: smooth;
            }
            .single-product .site-content {
                background-color: #f8fafc !important;
                padding-top: 30px;
                padding-bottom: 50px;
            }

            .single-product div.product {
                background: #ffffff;
                border-radius: 24px;
                padding: 35px;
                box-shadow: 0 20px 40px -12px rgba(15, 23, 42, 0.08), 0 0 0 1px rgba(226, 232, 240, 0.8);
                margin-top: 10px;
                margin-bottom: 50px !important;
            }

            /* Universal Vertical Gallery Layout (All Screen Sizes) */
            .woocommerce-product-gallery {
                display: flex !important;
                flex-direction: row-reverse !important;
                gap: 15px !important;
                border-radius: 20px;
                align-items: flex-start !important;
            }

            .woocommerce-product-gallery .flex-viewport {
                width: 78% !important;
                float: right !important;
                border-radius: 20px;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
                overflow: hidden;
            }

            .woocommerce-product-gallery .flex-viewport img {
                transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
                width: 100% !important;
                height: auto !important;
            }
            .woocommerce-product-gallery .flex-viewport:hover img {
                transform: scale(1.04);
            }

            .woocommerce-product-gallery .flex-control-thumbs {
                width: 20% !important;
                float: left !important;
                display: flex !important;
                flex-direction: column !important;
                gap: 10px !important;
                margin: 0 !important;
                padding: 0 !important;
                list-style: none !important;
                max-height: 500px;
                overflow-y: auto !important;
                scrollbar-width: thin;
            }

            .woocommerce-product-gallery .flex-control-thumbs li {
                width: 100% !important;
                border-radius: 12px !important;
                overflow: hidden !important;
                border: 2px solid #f1f5f9;
                transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                cursor: pointer;
                background: #f8fafc;
                flex-shrink: 0 !important;
            }

            .woocommerce-product-gallery .flex-control-thumbs li:hover {
                transform: translateY(-2px);
                border-color: #2563eb;
            }

            .woocommerce-product-gallery .flex-control-thumbs li img.flex-active {
                border-color: #2563eb !important;
                box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.25);
            }

            /* Remove Breadcrumb Entirely */
            .woocommerce-breadcrumb {
                display: none !important;
            }

            /* Product Title & Price */
            .single-product h1.product_title {
                font-size: 32px !important;
                font-weight: 800 !important;
                color: #0f172a !important;
                line-height: 1.25 !important;
                margin-bottom: 15px !important;
                letter-spacing: -0.5px;
            }

            .single-product p.price, 
            .single-product span.price {
                font-size: 28px !important;
                font-weight: 800 !important;
                color: #2563eb !important;
                margin-bottom: 25px !important;
                display: flex;
                align-items: center;
                gap: 12px;
            }

            /* Add to Cart Container & Custom Quantity */
            .single-product form.cart {
                display: flex !important;
                align-items: center !important;
                justify-content: flex-start !important;
                gap: 12px !important;
                margin-top: 25px !important;
                margin-bottom: 25px !important;
                margin-left: 0 !important;
                padding-left: 0 !important;
                padding-top: 20px;
                border-top: 1px solid #f1f5f9;
                flex-wrap: wrap;
            }

            .single-product div.product form.cart .quantity {
                margin-left: 0 !important;
                padding-left: 0 !important;
                float: left !important;
            }

            .custom-qty-wrapper {
                display: inline-flex;
                align-items: center;
                background: #f1f5f9;
                border-radius: 8px;
                padding: 5px;
                box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.04);
                transition: all 0.3s ease;
                margin-left: 0 !important;
            }

            .custom-qty-btn {
                width: 38px;
                height: 38px;
                background: #ffffff;
                border: none;
                border-radius: 6px;
                color: #0f172a;
                font-size: 18px;
                font-weight: 700;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
                user-select: none;
            }

            .custom-qty-btn:hover {
                background: #2563eb;
                color: #ffffff;
                transform: scale(1.05);
            }

            .custom-qty-btn:active {
                transform: scale(0.95);
            }

            .single-product .quantity input.qty {
                width: 45px !important;
                height: 38px !important;
                border: none !important;
                background: transparent !important;
                text-align: center !important;
                font-size: 16px !important;
                font-weight: 800 !important;
                color: #0f172a !important;
                outline: none !important;
                box-shadow: none !important;
                margin: 0 !important;
                padding: 0 !important;
                transition: transform 0.15s ease;
                -moz-appearance: textfield;
            }

            .single-product .quantity input.qty.pop-anim {
                transform: scale(1.25);
            }

            .single-product .quantity input.qty::-webkit-outer-spin-button,
            .single-product .quantity input.qty::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Add to Cart Button (Blue) */
            .single-product .single_add_to_cart_button {
                background: #2563eb !important;
                color: #ffffff !important;
                font-size: 15px !important;
                font-weight: 700 !important;
                padding: 15px 30px !important;
                border-radius: 6px !important;
                border: none !important;
                box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4) !important;
                transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
                cursor: pointer !important;
                text-transform: uppercase;
                letter-spacing: 0.8px;
                flex: none !important;
                text-align: center;
                min-width: 160px;
                margin-left: 0 !important;
            }

            .single-product .single_add_to_cart_button:hover {
                background: #1d4ed8 !important;
                transform: translateY(-2px);
                box-shadow: 0 15px 30px -5px rgba(29, 78, 216, 0.5) !important;
            }

            /* Buy Now Button (Blue) */
            .single-product .buy_now_button,
            .single-product .woo-buy-now,
            .single-product button.quick-buy,
            .single-product a.buy-now-button {
                background: #2563eb !important;
                color: #ffffff !important;
                font-size: 15px !important;
                font-weight: 700 !important;
                padding: 15px 30px !important;
                border-radius: 6px !important;
                border: none !important;
                box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4) !important;
                transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
                cursor: pointer !important;
                text-transform: uppercase;
                letter-spacing: 0.8px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                margin-left: 0 !important;
            }

            .single-product .buy_now_button:hover,
            .single-product .woo-buy-now:hover,
            .single-product button.quick-buy:hover,
            .single-product a.buy-now-button:hover {
                background: #1d4ed8 !important;
                transform: translateY(-2px);
                box-shadow: 0 15px 30px -5px rgba(29, 78, 216, 0.5) !important;
            }

            /* Completely Remove Category & Tag (Meta Section) */
            .product_meta {
                display: none !important;
            }

            /* ============================================================= */
            /* 🚀 ADVANCED & MODERN TABS & REVIEWS SECTION                   */
            /* ============================================================= */
            .woocommerce-tabs {
                margin-top: 50px !important;
                border-top: none !important;
                border-bottom: none !important;
                box-shadow: none !important;
                padding-top: 0 !important;
            }

            .woocommerce-tabs ul.tabs {
                border-bottom: none !important;
                border-top: none !important;
                box-shadow: none !important;
                padding-left: 0 !important;
                margin-bottom: 30px !important;
                display: flex !important;
                gap: 12px !important;
                list-style: none !important;
                overflow-x: auto;
                white-space: nowrap;
                background: #f8fafc;
                padding: 6px !important;
                border-radius: 14px;
                width: fit-content;
                max-width: 100%;
            }

            .woocommerce-tabs ul.tabs::after,
            .woocommerce-tabs ul.tabs::before {
                display: none !important;
            }

            .woocommerce-tabs ul.tabs li {
                background: transparent !important;
                border: none !important;
                padding: 0 !important;
                margin: 0 !important;
                border-radius: 10px !important;
                transition: all 0.3s ease;
            }

            .woocommerce-tabs ul.tabs li::before,
            .woocommerce-tabs ul.tabs li::after {
                display: none !important;
            }

            .woocommerce-tabs ul.tabs li a {
                font-size: 15px !important;
                font-weight: 700 !important;
                color: #64748b !important;
                padding: 10px 22px !important;
                display: block;
                border-radius: 10px;
                text-decoration: none !important;
                transition: all 0.25s ease;
            }

            .woocommerce-tabs ul.tabs li.active {
                background: #ffffff !important;
                box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08);
            }

            .woocommerce-tabs ul.tabs li.active a {
                color: #2563eb !important;
            }

            .woocommerce-tabs ul.tabs li:hover:not(.active) a {
                color: #0f172a !important;
            }

            /* Panel Styling */
            .woocommerce-Tabs-panel {
                color: #334155 !important;
                line-height: 1.85 !important;
                font-size: 15px !important;
                background: #ffffff;
                border-radius: 16px;
                padding: 25px 20px;
                border: 1px solid #f1f5f9;
            }

            .woocommerce-Tabs-panel h2 {
                font-size: 20px !important;
                font-weight: 800 !important;
                color: #0f172a !important;
                margin-bottom: 20px !important;
                letter-spacing: -0.3px;
            }

            /* Description Formatting */
            .woocommerce-Tabs-panel--description p {
                margin-bottom: 15px;
            }

            .woocommerce-Tabs-panel--description ul {
                padding-left: 20px;
                margin-bottom: 20px;
            }

            .woocommerce-Tabs-panel--description li {
                margin-bottom: 8px;
            }

            /* Reviews Modern Styling */
            #reviews #comments {
                margin-bottom: 35px;
            }

            #reviews .woocommerce-Reviews-title {
                font-size: 20px !important;
                font-weight: 800 !important;
                color: #0f172a !important;
                margin-bottom: 25px !important;
            }

            .commentlist {
                list-style: none !important;
                padding: 0 !important;
                margin: 0 !important;
                display: flex;
                flex-direction: column;
                gap: 20px;
            }

            .commentlist li.review {
                background: #f8fafc;
                border-radius: 16px;
                padding: 20px;
                border: 1px solid #e2e8f0;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .commentlist li.review:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.04);
            }

            .commentlist li .comment_container {
                display: flex;
                gap: 16px;
                align-items: flex-start;
            }

            .commentlist li img.avatar {
                width: 48px !important;
                height: 48px !important;
                border-radius: 50% !important;
                border: 2px solid #ffffff;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                float: none !important;
                margin: 0 !important;
            }

            .commentlist li .comment-text {
                flex: 1;
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
            }

            .commentlist li .comment-text .meta {
                font-size: 14px !important;
                color: #64748b !important;
                margin-bottom: 8px !important;
            }

            .commentlist li .comment-text .meta strong {
                color: #0f172a !important;
                font-weight: 700;
                font-size: 15px;
            }

            /* Star Ratings */
            .star-rating {
                color: #f59e0b !important;
                font-size: 14px !important;
                letter-spacing: 2px;
                margin-bottom: 8px !important;
            }

            /* Review Form */
            #review_form_wrapper {
                background: #f8fafc;
                padding: 25px;
                border-radius: 16px;
                border: 1px solid #e2e8f0;
                margin-top: 30px;
            }

            #review_form #reply-title {
                font-size: 18px !important;
                font-weight: 800 !important;
                color: #0f172a !important;
                margin-bottom: 15px !important;
                display: block;
            }

            #review_form .comment-form-rating {
                margin-bottom: 15px;
            }

            #review_form label {
                font-weight: 600;
                color: #334155;
                font-size: 14px;
                display: block;
                margin-bottom: 6px;
            }

            #review_form input[type="text"],
            #review_form input[type="email"],
            #review_form textarea {
                width: 100%;
                background: #ffffff;
                border: 1px solid #cbd5e1;
                border-radius: 10px;
                padding: 12px 16px;
                font-size: 14px;
                color: #0f172a;
                outline: none;
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            #review_form input[type="text"]:focus,
            #review_form input[type="email"]:focus,
            #review_form textarea:focus {
                border-color: #2563eb;
                box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
            }

            #review_form .form-submit #submit {
                background: #0f172a !important;
                color: #ffffff !important;
                padding: 12px 28px !important;
                border-radius: 8px !important;
                font-weight: 700 !important;
                border: none !important;
                cursor: pointer;
                transition: all 0.25s ease !important;
            }

            #review_form .form-submit #submit:hover {
                background: #2563eb !important;
                transform: translateY(-2px);
            }

            /* ------------------------------------------------------------- */
            /* 📱 RESPONSIVE ADJUSTMENTS                                     */
            /* ------------------------------------------------------------- */
            @media (max-width: 991px) {
                .single-product div.product {
                    padding: 25px;
                    border-radius: 20px;
                    margin-bottom: 40px !important;
                }
                .single-product h1.product_title {
                    font-size: 26px !important;
                }
                .single-product p.price, .single-product span.price {
                    font-size: 24px !important;
                }
            }

            @media (max-width: 767px) {
                .single-product .site-content {
                    padding-top: 15px;
                    padding-bottom: 30px;
                }

                .single-product div.product {
                    padding: 18px;
                    border-radius: 16px;
                    margin-bottom: 30px !important;
                }

                .woocommerce-product-gallery {
                    gap: 10px !important;
                }

                .woocommerce-product-gallery .flex-viewport {
                    width: 76% !important;
                }

                .woocommerce-product-gallery .flex-control-thumbs {
                    width: 22% !important;
                    gap: 8px !important;
                    max-height: 350px;
                }

                .woocommerce-product-gallery .flex-control-thumbs li {
                    border-radius: 8px !important;
                }

                .single-product form.cart {
                    display: flex !important;
                    flex-direction: row !important;
                    justify-content: flex-start !important;
                    gap: 10px !important;
                    margin-left: 0 !important;
                    padding-left: 0 !important;
                }

                .custom-qty-wrapper {
                    padding: 3px;
                }

                .custom-qty-btn {
                    width: 35px;
                    height: 35px;
                    font-size: 16px;
                }

                .single-product .quantity input.qty {
                    width: 35px !important;
                    height: 35px !important;
                    font-size: 15px !important;
                }

                .single-product .single_add_to_cart_button {
                    padding: 12px 20px !important;
                    font-size: 14px !important;
                    min-width: auto;
                }

                .woocommerce-tabs {
                    margin-top: 30px !important;
                    padding-top: 0 !important;
                }

                .woocommerce-tabs ul.tabs {
                    width: 100%;
                    gap: 8px !important;
                }
                
                .woocommerce-tabs ul.tabs li a {
                    font-size: 13px !important;
                    padding: 8px 14px !important;
                }

                .woocommerce-Tabs-panel {
                    padding: 18px 14px;
                }

                #review_form_wrapper {
                    padding: 16px;
                }
            }
        </style>
        <?php
    }
}

// ২. JavaScript ইনজেক্ট করা (+ / - বাটনের কার্যকারিতার জন্য)
add_action('wp_footer', 'ultra_responsive_qty_script');
function ultra_responsive_qty_script() {
    if ( is_product() ) {
        ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                const qtyInputs = document.querySelectorAll('.single-product .quantity input.qty');

                qtyInputs.forEach(function(input) {
                    if (input.previousElementSibling && input.previousElementSibling.classList.contains('custom-qty-btn')) {
                        return;
                    }

                    // Wrap input field
                    const wrapper = document.createElement('div');
                    wrapper.className = 'custom-qty-wrapper';
                    input.parentNode.insertBefore(wrapper, input);

                    // Create Minus Button
                    const minusBtn = document.createElement('button');
                    minusBtn.type = 'button';
                    minusBtn.className = 'custom-qty-btn qty-minus';
                    minusBtn.innerHTML = '&#8722;';

                    // Create Plus Button
                    const plusBtn = document.createElement('button');
                    plusBtn.type = 'button';
                    plusBtn.className = 'custom-qty-btn qty-plus';
                    plusBtn.innerHTML = '&#43;';

                    // Insert Elements
                    wrapper.appendChild(minusBtn);
                    wrapper.appendChild(input);
                    wrapper.appendChild(plusBtn);

                    // Number Change Animation Helper
                    function triggerPopAnimation() {
                        input.classList.add('pop-anim');
                        setTimeout(function() {
                            input.classList.remove('pop-anim');
                        }, 150);
                    }

                    // Minus Button Click Handler
                    minusBtn.addEventListener('click', function() {
                        let val = parseInt(input.value) || 1;
                        let min = parseInt(input.getAttribute('min')) || 1;
                        let step = parseInt(input.getAttribute('step')) || 1;

                        if (val > min) {
                            input.value = val - step;
                            input.dispatchEvent(new Event('change', { bubbles: true }));
                            triggerPopAnimation();
                        }
                    });

                    // Plus Button Click Handler
                    plusBtn.addEventListener('click', function() {
                        let val = parseInt(input.value) || 0;
                        let max = parseInt(input.getAttribute('max')) || 9999;
                        let step = parseInt(input.getAttribute('step')) || 1;

                        if (val < max || isNaN(max)) {
                            input.value = val + step;
                            input.dispatchEvent(new Event('change', { bubbles: true }));
                            triggerPopAnimation();
                        }
                    });
                });
            });
        </script>
        <?php
    }
}

