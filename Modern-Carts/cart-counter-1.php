<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WooCommerce Dynamic Cart Count Snippet Reference</title>
    
    <style>
        /* ==========================================
           1. CART COUNT BADGE CSS STYLE
           ========================================== */
        .cart-badge {
            background-color: #8b0040 !important;
            color: #ffffff !important;
            font-size: 10px !important;
            font-weight: 700 !important;
            padding: 2px 6px !important;
            border-radius: 10px !important;
            position: absolute !important;
            top: -8px !important;
            right: -12px !important;
            display: inline-block !important;
            line-height: 1 !important;
        }

        /* Container wrapper reference */
        .cart-icon-wrapper {
            position: relative;
        }
    </style>
</head>
<body>

    <!-- ==========================================
       2. HTML MARKUP FOR CART COUNT BADGE
       ========================================== -->
    <div style="position: relative; display: inline-block;">
        <a href="/cart/">
            Cart
            <span class="cart-badge s-cart-count">0</span>
        </a>
    </div>

    <!-- ==========================================
       3. JAVASCRIPT LOGIC FOR WOOCOMMERCE CART COUNT
       ========================================== -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function updateCartCount() {
                // Fetching cart data from WooCommerce Store API
                fetch('/wp-json/wc/store/v1/cart', {
                    method: 'GET',
                    headers: { 'Content-Type': 'application/json' }
                })
                .then(response => response.json())
                .then(data => {
                    let itemCount = 0;
                    if (data && data.items_count !== undefined) {
                        itemCount = data.items_count;
                    }
                    // Updating all elements with class '.s-cart-count'
                    document.querySelectorAll('.s-cart-count').forEach(el => {
                        el.textContent = itemCount;
                    });
                })
                .catch(error => {
                    console.error('Cart count fetch error:', error);
                });
            }

            // Initial load update
            updateCartCount();

            // Real-time synchronization with WooCommerce events using jQuery
            if (typeof jQuery !== 'undefined') {
                jQuery(document.body).on('added_to_cart removed_from_cart wc_fragments_refreshed', function() {
                    updateCartCount();
                });
            }
        });
    </script>

</body>
</html>

