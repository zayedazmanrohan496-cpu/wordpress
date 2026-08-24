/**
 * Ultra-Responsive & Animated WooCommerce Single Product (Vertical Gallery for All Devices)
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
                margin-bottom: 20px !important;
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
                border-color: #4c0519;
            }

            .woocommerce-product-gallery .flex-control-thumbs li img.flex-active {
                border-color: #4c0519 !important;
                box-shadow: 0 0 0 3px rgba(76, 5, 25, 0.25);
            }

            /* Breadcrumb Styling with increased top margin (15px) */
            .woocommerce-breadcrumb {
                font-size: 13px !important;
                color: #64748b !important;
                margin-top: 15px !important;
                margin-bottom: 20px !important;
                font-weight: 600;
                letter-spacing: 0.3px;
                text-transform: uppercase;
            }
            .woocommerce-breadcrumb a {
                color: #94a3b8 !important;
                text-decoration: none !important;
                transition: color 0.2s ease;
            }
            .woocommerce-breadcrumb a:hover {
                color: #4c0519 !important;
            }

            /* Product Title (Medium Font) */
            .single-product h1.product_title {
                font-size: 30px !important;
                font-weight: 600 !important;
                color: #0f172a !important;
                line-height: 1.25 !important;
                margin-bottom: 15px !important;
                letter-spacing: -0.3px;
            }

            /* Product Price (Medium Font & Ultra-Dark Maroon) */
            .single-product p.price, 
            .single-product span.price {
                font-size: 26px !important;
                font-weight: 600 !important;
                color: #4c0519 !important;
                margin-bottom: 25px !important;
                display: flex;
                align-items: center;
                gap: 12px;
            }

            /* Add to Cart Container & Custom Quantity */
            .single-product form.cart {
                display: flex !important;
                align-items: center !important;
                gap: 15px !important;
                margin-top: 25px !important;
                margin-bottom: 25px !important;
                padding-top: 20px;
                border-top: 1px solid #f1f5f9;
                flex-wrap: wrap;
            }

            .custom-qty-wrapper {
                display: inline-flex;
                align-items: center;
                background: #f1f5f9;
                border-radius: 50px;
                padding: 5px;
                box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.04);
                transition: all 0.3s ease;
            }

            .custom-qty-btn {
                width: 38px;
                height: 38px;
                background: #ffffff;
                border: none;
                border-radius: 50%;
                color: #0f172a;
                font-size: 18px;
                font-weight: 600;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
                user-select: none;
            }

            .custom-qty-btn:hover {
                background: #4c0519;
                color: #ffffff;
                transform: scale(1.1);
            }

            .custom-qty-btn:active {
                transform: scale(0.92);
            }

            .single-product .quantity input.qty {
                width: 45px !important;
                height: 38px !important;
                border: none !important;
                background: transparent !important;
                text-align: center !important;
                font-size: 16px !important;
                font-weight: 600 !important;
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

            /* Buttons Container for Cart & Order Now */
            .single-product-buttons-wrap {
                display: flex;
                gap: 12px;
                flex: 1;
                flex-wrap: wrap;
            }

            /* Add to Cart Button & Order Now Button Styling */
            .single-product .single_add_to_cart_button,
            .single-product .direct-order-now-btn {
                background: linear-gradient(135deg, #4c0519 0%, #6b0f1a 100%) !important;
                color: #ffffff !important;
                font-size: 15px !important;
                font-weight: 600 !important;
                padding: 15px 25px !important;
                border-radius: 50px !important;
                border: none !important;
                box-shadow: 0 10px 25px -5px rgba(76, 5, 25, 0.4) !important;
                transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
                cursor: pointer !important;
                text-transform: uppercase;
                letter-spacing: 0.8px;
                flex: 1;
                text-align: center;
                min-width: 140px;
                text-decoration: none !important;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            /* Order Now Button Specific Style (Alternative Color for differentiation, e.g., Dark Slate/Black or matching gradient) */
            .single-product .direct-order-now-btn {
                background: linear-gradient(135deg, #0f172a 100%, #1e293b 0%) !important;
                box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.4) !important;
            }

            .single-product .single_add_to_cart_button:hover,
            .single-product .direct-order-now-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 15px 30px -5px rgba(76, 5, 25, 0.5) !important;
                color: #ffffff !important;
            }

            .single-product .direct-order-now-btn:hover {
                box-shadow: 0 15px 30px -5px rgba(15, 23, 42, 0.5) !important;
            }

            /* Tabs Section */
            .woocommerce-tabs {
                margin-top: 45px !important;
                border-top: 1px solid #f1f5f9;
                padding-top: 30px;
            }

            .woocommerce-tabs ul.tabs {
                border-bottom: 2px solid #f1f5f9 !important;
                padding-left: 0 !important;
                margin-bottom: 25px !important;
                display: flex !important;
                gap: 25px !important;
                list-style: none !important;
                overflow-x: auto;
                white-space: nowrap;
            }

            .woocommerce-tabs ul.tabs li {
                background: transparent !important;
                border: none !important;
                padding: 0 0 12px 0 !important;
                margin: 0 !important;
                position: relative;
            }

            .woocommerce-tabs ul.tabs li a {
                font-size: 16px !important;
                font-weight: 600 !important;
                color: #94a3b8 !important;
                padding: 0 !important;
            }

            .woocommerce-tabs ul.tabs li.active a {
                color: #4c0519 !important;
            }

            .woocommerce-tabs ul.tabs li.active::after {
                content: '';
                position: absolute;
                bottom: -2px;
                left: 0;
                right: 0;
                height: 3px;
                background: #4c0519;
                border-radius: 10px;
            }

            .woocommerce-Tabs-panel {
                color: #475569 !important;
                line-height: 1.8 !important;
                font-size: 15px !important;
            }

            /* ------------------------------------------------------------- */
            /* 📱 RESPONSIVE ADJUSTMENTS (Retaining Vertical Gallery)        */
            /* ------------------------------------------------------------- */

            @media (max-width: 991px) {
                .single-product div.product {
                    padding: 25px;
                    border-radius: 20px;
                }
                .single-product h1.product_title {
                    font-size: 24px !important;
                }
                .single-product p.price, .single-product span.price {
                    font-size: 22px !important;
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
                    justify-content: space-between !important;
                    gap: 10px !important;
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

                .single-product-buttons-wrap {
                    flex-direction: column;
                    width: 100%;
                }

                .single-product .single_add_to_cart_button,
                .single-product .direct-order-now-btn {
                    padding: 12px 15px !important;
                    font-size: 13px !important;
                    min-width: auto;
                    width: 100%;
                }

                .woocommerce-tabs {
                    margin-top: 30px !important;
                    padding-top: 20px;
                }

                .woocommerce-tabs ul.tabs {
                    gap: 18px !important;
                }
                
                .woocommerce-tabs ul.tabs li a {
                    font-size: 14px !important;
                }
            }
        </style>
        <?php
    }
}

// ২. প্রোডাক্ট মেটা (Category, Tags) রিমুভ করার হুক
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// ৩. 'Order Now' বাটন যোগ করার হুক (Add to Cart বাটনের পরে)
add_action( 'woocommerce_after_add_to_cart_button', 'add_direct_order_now_button' );
function add_direct_order_now_button() {
    global $product;
    // Simple এবং Variable প্রোডাক্টের জন্য চেকআউট লিঙ্ক জেনারেট করা
    $checkout_url = wc_get_checkout_url();
    echo '<a href="' . esc_url( $checkout_url ) . '" class="direct-order-now-btn">Order Now</a>';
}

// ৪. JavaScript ইনজেক্ট করা (+ / - বাটন এবং Order Now বাটনে বর্তমান কোয়ান্টিটি ও প্রোডাক্ট আইডি পাস করার জন্য)
add_action('wp_footer', 'ultra_responsive_qty_script');
function ultra_responsive_qty_script() {
    if ( is_product() ) {
        ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                const qtyInputs = document.querySelectorAll('.single-product .quantity input.qty');

                qtyInputs.forEach(function(input) {
                    if (input.previousElementSibling && input.previousElementSibling.classList.contains('custom-qty-wrapper')) {
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

                // Order Now Button Ajax / Direct Cart handling with selected quantity
                const orderNowBtn = document.querySelector('.direct-order-now-btn');
                const addToCartBtn = document.querySelector('.single_add_to_cart_button');

                if (orderNowBtn) {
                    orderNowBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const qtyInput = document.querySelector('.single-product .quantity input.qty');
                        const quantity = qtyInput ? qtyInput.value : 1;
                        
                        // Form থেকে product_id সংগ্রহ করা
                        const form = document.querySelector('form.cart');
                        let productId = '';
                        if (form) {
                            const variationInput = form.querySelector('input[name="variation_id"]');
                            if (variationInput && variationInput.value) {
                                productId = variationInput.value;
                            } else {
                                const addCartVal = form.querySelector('button[name="add-to-cart"]');
                                productId = addCartVal ? addCartVal.value : '';
                            }
                        }

                        if (!productId) {
                            // যদি আইডি না পাওয়া যায় তবে ডিফল্ট WooCommerce চেকআউটে রিডাইরেক্ট করবে
                            window.location.href = orderNowBtn.href;
                            return;
                        }

                        // Ajax-এর মাধ্যমে কার্টে প্রোডাক্ট যুক্ত করে চেকআউটে পাঠানো
                        const data = new URLSearchParams();
                        data.append('action', 'woocommerce_add_to_cart');
                        data.append('product_id', productId);
                        data.append('quantity', quantity);

                        fetch(wc_add_to_cart_params ? wc_add_to_cart_params.ajax_url : '/wp-admin/admin-ajax.php', {
                            method: 'POST',
                            body: data
                        })
                        .then(response => response.json())
                        .then(res => {
                            window.location.href = orderNowBtn.href;
                        })
                        .catch(err => {
                            window.location.href = orderNowBtn.href;
                        });
                    });
                }
            });
        </script>
        <?php
    }
}

