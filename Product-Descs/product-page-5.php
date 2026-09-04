/**
 * Ultra-Responsive & Animated WooCommerce Single Product (Exact Stacked Layout Fix)
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
                border-radius: 0px;
                padding: 35px;
                box-shadow: 0 20px 40px -12px rgba(15, 23, 42, 0.08), 0 0 0 1px rgba(226, 232, 240, 0.8);
                margin-top: 10px;
                margin-bottom: 20px !important;
            }

            /* Universal Vertical Gallery Layout */
            .woocommerce-product-gallery {
                display: flex !important;
                flex-direction: row-reverse !important;
                gap: 15px !important;
                border-radius: 0px;
                align-items: flex-start !important;
            }

            .woocommerce-product-gallery .flex-viewport {
                width: 78% !important;
                float: right !important;
                border-radius: 0px;
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
                border-radius: 0px !important;
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

            /* Breadcrumb Styling */
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
                color: #2563eb !important;
            }

            /* Product Title */
            .single-product h1.product_title {
                font-size: 30px !important;
                font-weight: 600 !important;
                color: #0f172a !important;
                line-height: 1.25 !important;
                margin-bottom: 15px !important;
                letter-spacing: -0.3px;
            }

            /* Product Price */
            .single-product p.price, 
            .single-product span.price {
                font-size: 26px !important;
                font-weight: 600 !important;
                color: #2563eb !important;
                margin-bottom: 25px !important;
                display: flex;
                align-items: center;
                gap: 12px;
            }

            /* Form & Layout Base */
            .single-product form.cart {
                display: flex !important;
                flex-direction: column !important;
                gap: 15px !important;
                margin-top: 25px !important;
                margin-bottom: 25px !important;
                padding-top: 20px;
                border-top: 1px solid #f1f5f9;
            }

            /* Variable Product Options Separation */
            .single-product form.cart table.variations,
            .single-product form.cart .woo-variation-swatches {
                margin-bottom: 5px !important;
            }

            /* Variation Wrapper - Ensure proper column stack */
            .single-product .single_variation_wrap {
                display: flex !important;
                flex-direction: column !important;
                gap: 15px !important;
                border-top: 1px solid #f1f5f9;
                padding-top: 20px;
                margin-top: 10px;
                width: 100% !important;
            }

            /* Top Row: Quantity and Buy Now side-by-side (Universal for both simple & variable) */
            .cart-top-row,
            .single-product .single_variation_wrap .woocommerce-variation-add-to-cart {
                display: flex !important;
                align-items: center !important;
                gap: 12px !important;
                width: 100% !important;
                float: none !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .custom-qty-wrapper {
                display: inline-flex;
                align-items: center;
                background: #f1f5f9;
                border-radius: 0px;
                padding: 5px;
                box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.04);
                transition: all 0.3s ease;
                flex-shrink: 0;
            }

            .custom-qty-btn {
                width: 38px;
                height: 38px;
                background: #ffffff;
                border: none;
                border-radius: 0px;
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
                background: #2563eb;
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

            /* Buttons Styling: Add to Cart / Buy Now & Order Now stacked */
            .single-product .single_add_to_cart_button,
            .single-product .direct-order-now-btn {
                background: linear-gradient(135deg, #2563eb 0%, #1d4ed8) !important;
                color: #ffffff !important;
                font-size: 15px !important;
                font-weight: 600 !important;
                padding: 15px 25px !important;
                border-radius: 0px !important;
                border: none !important;
                box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4) !important;
                transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
                cursor: pointer !important;
                text-transform: uppercase;
                letter-spacing: 0.8px;
                text-align: center;
                text-decoration: none !important;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 100% !important;
                box-sizing: border-box !important;
            }

            .single-product .single_add_to_cart_button {
                flex: 1;
            }

            .single-product .direct-order-now-btn {
                background: linear-gradient(135deg, #0f172a 0%, #000000 100%) !important;
                box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.4) !important;
                width: 100% !important;
            }

            .single-product .single_add_to_cart_button:hover {
                transform: translateY(-2px);
                box-shadow: 0 15px 30px -5px rgba(37, 99, 235, 0.5) !important;
                color: #ffffff !important;
            }

            .single-product .direct-order-now-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.5) !important;
                color: #ffffff !important;
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
                color: #2563eb !important;
            }

            .woocommerce-tabs ul.tabs li.active::after {
                content: '';
                position: absolute;
                bottom: -2px;
                left: 0;
                right: 0;
                height: 3px;
                background: #2563eb;
                border-radius: 0px;
            }

            .woocommerce-Tabs-panel {
                color: #475569 !important;
                line-height: 1.8 !important;
                font-size: 15px !important;
            }

            @media (max-width: 991px) {
                .single-product div.product {
                    padding: 25px;
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

                .single-product .single_add_to_cart_button,
                .single-product .direct-order-now-btn {
                    padding: 12px 15px !important;
                    font-size: 13px !important;
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

// ২. প্রোডাক্ট মেটা রিমুভ করা
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// ৩. 'Order Now' বাটন তৈরি ও সঠিক জায়গায় হুক করা
add_action( 'woocommerce_after_add_to_cart_button', 'add_direct_order_now_button' );
add_action( 'woocommerce_single_variation', 'add_direct_order_now_button', 25 );
function add_direct_order_now_button() {
    static $rendered = false;
    if ( $rendered ) {
        return;
    }
    echo '<button type="button" class="direct-order-now-btn">Order Now</button>';
    $rendered = true;
}

// ৪. PHP হ্যান্ডলার: Order Now প্রসেসিং ও চেকআউটে রিডাইরেক্ট
add_action('template_redirect', 'handle_direct_order_now_action');
function handle_direct_order_now_action() {
    if ( isset($_POST['direct_order_product_id']) ) {
        $product_id   = absint( $_POST['direct_order_product_id'] );
        $quantity     = isset($_POST['quantity']) ? absint( $_POST['quantity'] ) : 1;
        $variation_id = isset($_POST['variation_id']) ? absint( $_POST['variation_id'] ) : 0;

        if ( $variation_id ) {
            $variation_data = array();
            foreach ($_POST as $key => $val) {
                if (strpos($key, 'attribute_') === 0) {
                    $variation_data[$key] = sanitize_text_field($val);
                }
            }
            WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation_data );
        } else {
            WC()->cart->add_to_cart( $product_id, $quantity );
        }

        wp_safe_redirect( wc_get_checkout_url() );
        exit;
    }
}

// ৫. JavaScript: কোয়ান্টিটি এবং বাটনগুলোর সঠিক লেআউট ও স্ট্রাকচার নিশ্চিত করা
add_action('wp_footer', 'ultra_responsive_qty_script');
function ultra_responsive_qty_script() {
    if ( is_product() ) {
        ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                const cartForm = document.querySelector('form.cart');
                if (cartForm) {
                    // ক) কোয়ান্টিটি ইনপুট এবং কাস্টম মাইনাস-প্লাস বাটন তৈরি
                    const qtyInputs = cartForm.querySelectorAll('.quantity input.qty');
                    qtyInputs.forEach(function(qtyInput) {
                        if (qtyInput && !qtyInput.parentNode.classList.contains('custom-qty-wrapper')) {
                            const wrapper = document.createElement('div');
                            wrapper.className = 'custom-qty-wrapper';
                            qtyInput.parentNode.insertBefore(wrapper, qtyInput);

                            const minusBtn = document.createElement('button');
                            minusBtn.type = 'button';
                            minusBtn.className = 'custom-qty-btn qty-minus';
                            minusBtn.innerHTML = '&#8722;';

                            const plusBtn = document.createElement('button');
                            plusBtn.type = 'button';
                            plusBtn.className = 'custom-qty-btn qty-plus';
                            plusBtn.innerHTML = '&#43;';

                            wrapper.appendChild(minusBtn);
                            wrapper.appendChild(qtyInput);
                            wrapper.appendChild(plusBtn);

                            function triggerPopAnimation() {
                                qtyInput.classList.add('pop-anim');
                                setTimeout(function() {
                                    qtyInput.classList.remove('pop-anim');
                                }, 150);
                            }

                            minusBtn.addEventListener('click', function() {
                                let val = parseInt(qtyInput.value) || 1;
                                let min = parseInt(qtyInput.getAttribute('min')) || 1;
                                let step = parseInt(qtyInput.getAttribute('step')) || 1;

                                if (val > min) {
                                    qtyInput.value = val - step;
                                    qtyInput.dispatchEvent(new Event('change', { bubbles: true }));
                                    triggerPopAnimation();
                                }
                            });

                            plusBtn.addEventListener('click', function() {
                                let val = parseInt(qtyInput.value) || 0;
                                let max = parseInt(qtyInput.getAttribute('max')) || 9999;
                                let step = parseInt(qtyInput.getAttribute('step')) || 1;

                                if (val < max || isNaN(max)) {
                                    qtyInput.value = val + step;
                                    qtyInput.dispatchEvent(new Event('change', { bubbles: true }));
                                    triggerPopAnimation();
                                }
                            });
                        }
                    });

                    // খ) সিম্পল প্রোডাক্টের ক্ষেত্রে লেআউট সাজানো
                    const qtyWrapper = cartForm.querySelector(':scope > .quantity');
                    const addToCartBtn = cartForm.querySelector(':scope > .single_add_to_cart_button');
                    const orderNowBtn = cartForm.querySelector(':scope > .direct-order-now-btn');

                    if (qtyWrapper && addToCartBtn && !cartForm.querySelector('.cart-top-row')) {
                        const topRow = document.createElement('div');
                        topRow.className = 'cart-top-row';
                        cartForm.insertBefore(topRow, qtyWrapper);
                        topRow.appendChild(qtyWrapper);
                        topRow.appendChild(addToCartBtn);
                    }

                    if (orderNowBtn) {
                        cartForm.appendChild(orderNowBtn);
                    }
                }

                // গ) ভেরিয়েবল প্রোডাক্টের ক্ষেত্রে রিয়েল-টাইম DOM অবজার্ভার ও ফ্লেক্স র‍্যাপার ফিক্স
                const observer = new MutationObserver(function() {
                    const variationWrap = document.querySelector('.single_variation_wrap');
                    if (variationWrap) {
                        const internalAddToCart = variationWrap.querySelector('.single_add_to_cart_button');
                        const internalQty = variationWrap.querySelector('.quantity');
                        const internalOrderBtn = variationWrap.querySelector('.direct-order-now-btn');

                        // কোয়ান্টিটি এবং Add to Cart বাটনকে এক লাইনে (flex row) রাখা
                        if (internalQty && internalAddToCart && !variationWrap.querySelector('.woocommerce-variation-add-to-cart')) {
                            let varTopRow = document.createElement('div');
                            varTopRow.className = 'woocommerce-variation-add-to-cart';
                            variationWrap.insertBefore(varTopRow, internalQty);
                            varTopRow.appendChild(internalQty);
                            varTopRow.appendChild(internalAddToCart);
                        }

                        // Order Now বাটনটিকে সবার নিচে আলাদা লাইনে (full width) রাখা
                        if (internalOrderBtn && variationWrap.lastElementChild !== internalOrderBtn) {
                            variationWrap.appendChild(internalOrderBtn);
                        }
                    }
                });
                
                const targetNode = document.querySelector('form.cart');
                if (targetNode) {
                    observer.observe(targetNode, { childList: true, subtree: true });
                }

                // ঘ) Order Now Click Event Handler
                const globalBody = document.body;
                globalBody.addEventListener('click', function(e) {
                    if (e.target && e.target.classList.contains('direct-order-now-btn')) {
                        e.preventDefault();

                        let productId = '';
                        const variationInput = cartForm.querySelector('input[name="variation_id"]');
                        if (variationInput && variationInput.value) {
                            productId = variationInput.value;
                        } else {
                            const addCartVal = cartForm.querySelector('button[name="add-to-cart"]');
                            productId = addCartVal ? addCartVal.value : '';
                        }

                        if (!productId || productId == '0') {
                            alert('দয়া করে প্রোডাক্টের সাইজ বা অপশনগুলো সিলেক্ট করুন।');
                            return;
                        }

                        let hiddenInput = cartForm.querySelector('input[name="direct_order_product_id"]');
                        if (!hiddenInput) {
                            hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = 'direct_order_product_id';
                            cartForm.appendChild(hiddenInput);
                        }
                        hiddenInput.value = productId;

                        cartForm.submit();
                    }
                });
            });
        </script>
        <?php
    }
}

