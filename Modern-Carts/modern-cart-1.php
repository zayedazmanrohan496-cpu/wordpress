/**
 * Safe Side Cart Snippet with Function Duplicate Prevention
 */

if ( ! function_exists( 'custom_side_cart_drawer' ) ) {
    add_action('wp_footer', 'custom_side_cart_drawer');
    function custom_side_cart_drawer() {
        if ( ! function_exists('WC') || ! WC()->cart || is_cart() || is_checkout() ) return;
        ?>
        <div id="side-cart-overlay" class="side-cart-overlay"></div>
        <div id="side-cart-drawer" class="side-cart-drawer">
            <div class="side-cart-header">
                <h3>শপিং কার্ট</h3>
                <button id="close-side-cart" class="close-cart-btn">বন্ধ করুন &rarr;</button>
            </div>
            <div class="side-cart-content-wrapper">
                <div id="side-cart-content">
                    <?php custom_render_side_cart_content(); ?>
                </div>
            </div>
            <div class="side-cart-footer">
                <div class="side-cart-subtotal">
                    <span>সর্বমোট:</span>
                    <span class="subtotal-amount"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                </div>
                <a href="<?php echo wc_get_checkout_url(); ?>" class="side-cart-checkout-btn">এগিয়ে যান</a>
            </div>
        </div>
        <?php
    }
}

if ( ! function_exists( 'custom_render_side_cart_content' ) ) {
    function custom_render_side_cart_content() {
        if ( ! function_exists('WC') || ! WC()->cart || WC()->cart->is_empty() ) {
            echo '<p class="empty-cart-msg">আপনার কার্ট বর্তমানে খালি আছে।</p>';
            return;
        }
        
        echo '<ul class="side-cart-items">';
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                ?>
                <li class="side-cart-item">
                    <div class="cart-item-image">
                        <?php echo $_product->get_image(array(60, 60)); ?>
                    </div>
                    <div class="cart-item-details">
                        <a href="<?php echo esc_url( $product_permalink ); ?>" class="cart-item-title">
                            <?php echo $_product->get_name(); ?>
                        </a>
                        <div class="cart-item-price-qty">
                            <span class="qty"><?php echo $cart_item['quantity']; ?></span> &times; 
                            <span class="price"><?php echo WC()->cart->get_product_price( $_product ); ?></span>
                        </div>
                    </div>
                    <div class="cart-item-remove">
                        <?php
                            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                '<a href="%s" class="remove-side-item" aria-label="%s" data-product_id="%s" data-cart_item_key="%s">&times;</a>',
                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                esc_html__( 'এই আইটেমটি মুছে ফেলুন', 'woocommerce' ),
                                esc_attr( $product_id ),
                                esc_attr( $cart_item_key )
                            ), $cart_item_key );
                        ?>
                    </div>
                </li>
                <?php
            }
        }
        echo '</ul>';
    }
}

if ( ! function_exists( 'custom_side_cart_fragments' ) ) {
    add_filter( 'woocommerce_add_to_cart_fragments', 'custom_side_cart_fragments' );
    function custom_side_cart_fragments( $fragments ) {
        if ( function_exists('WC') && WC()->cart ) {
            ob_start();
            custom_render_side_cart_content();
            $fragments['#side-cart-content'] = ob_get_clean();
            $fragments['.subtotal-amount'] = '<span class="subtotal-amount">' . WC()->cart->get_cart_subtotal() . '</span>';
        }
        return $fragments;
    }
}

if ( ! function_exists( 'custom_side_cart_css' ) ) {
    add_action('wp_head', 'custom_side_cart_css');
    function custom_side_cart_css() {
        ?>
        <style>
            .side-cart-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 99998; display: none; }
            .side-cart-drawer { position: fixed; top: 0; right: -400px; width: 380px; max-width: 85%; height: 100%; background: #ffffff; z-index: 99999; box-shadow: -2px 0 15px rgba(0,0,0,0.1); transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: flex; flex-direction: column; font-family: 'Plus Jakarta Sans', sans-serif; }
            .side-cart-drawer.open { right: 0; }
            .side-cart-header { display: flex; justify-content: space-between; align-items: center; padding: 18px 20px; border-bottom: 1px solid rgba(224, 122, 95, 0.2); background-color: #fff1ee; }
            .side-cart-header h3 { margin: 0; font-size: 16px; font-weight: 700; color: #2b2d42; }
            .close-cart-btn { background: none; border: none; font-size: 14px; font-weight: 600; cursor: pointer; color: #e07a5f; }
            .side-cart-content-wrapper { flex: 1; overflow-y: auto; padding: 15px 20px; }
            .side-cart-items { list-style: none; padding: 0; margin: 0; }
            .side-cart-item { display: flex; align-items: center; padding: 12px 0; border-bottom: 1px solid #f1f5f9; }
            .cart-item-image img { width: 60px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #fbdcd5; margin-right: 12px; }
            .cart-item-details { flex: 1; }
            .cart-item-title { font-size: 14px; color: #2b2d42; text-decoration: none; display: block; font-weight: 600; margin-bottom: 5px; }
            .cart-item-price-qty { font-size: 13px; color: #8d99ae; }
            .cart-item-price-qty .price { color: #e07a5f; font-weight: 700; }
            .cart-item-remove a { color: #8d99ae; text-decoration: none; font-size: 20px; font-weight: bold; padding: 5px; }
            .cart-item-remove a:hover { color: #e07a5f; }
            .side-cart-footer { padding: 20px; border-top: 1px solid rgba(224, 122, 95, 0.2); background: #fff1ee; }
            .side-cart-subtotal { display: flex; justify-content: space-between; font-size: 16px; font-weight: 700; margin-bottom: 15px; color: #2b2d42; }
            .side-cart-subtotal .subtotal-amount { color: #e07a5f; }
            .side-cart-checkout-btn { display: block; width: 100%; background-color: #e07a5f; color: #ffffff; text-align: center; padding: 12px 0; text-decoration: none; font-weight: 700; border-radius: 6px; font-size: 15px; }
            .side-cart-checkout-btn:hover { background-color: #d06245; color: #ffffff; }
            .empty-cart-msg { text-align: center; color: #8d99ae; margin-top: 30px; font-size: 14px; }
        </style>
        <?php
    }
}

if ( ! function_exists( 'custom_side_cart_js' ) ) {
    add_action('wp_footer', 'custom_side_cart_js');
    function custom_side_cart_js() {
        ?>
        <script>
            jQuery(document).ready(function($) {
                function openSideCart() {
                    $('#side-cart-drawer').addClass('open');
                    $('#side-cart-overlay').fadeIn(200);
                }

                function closeSideCart() {
                    $('#side-cart-drawer').removeClass('open');
                    $('#side-cart-overlay').fadeOut(200);
                }

                $(document.body).on('added_to_cart', function() {
                    openSideCart();
                });

                $(document).on('click', '#close-side-cart, #side-cart-overlay', function() {
                    closeSideCart();
                });

                $(document).on('click', '.cart-btn, .bottom-nav-cart', function(e) {
                    if (!$(e.target).closest('a').attr('href').includes('cart')) {
                        e.preventDefault();
                        openSideCart();
                    }
                });
            });
        </script>
        <?php
    }
}

