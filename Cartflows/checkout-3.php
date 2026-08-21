/**

 * CartFlows Checkout Senior Dev Edition - Responsive Fix for Mobile Place Order Button

 */



add_action('wp_head', 'custom_checkout_senior_dev_design');

function custom_checkout_senior_dev_design() {

    if (is_checkout()) {

        ?>

        <style>

            @import url('https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap');



            .woocommerce-checkout, .cartflows-container {

                font-family: 'Hind Siliguri', sans-serif !important;

                background-color: #f8fafc !important;

            }



            /* --- Form Layout & Overlap Fix --- */

            .woocommerce-checkout .form-row {

                margin-bottom: 12px !important;

                display: flex !important;

                flex-direction: column !important;

                clear: both !important;

                width: 100% !important;

            }



            .woocommerce-checkout .form-row label {

                position: relative !important;

                display: block !important;

                margin-bottom: 5px !important;

                font-weight: 600 !important;

                color: #1e293b !important;

                font-size: 14px !important;

                transform: none !important;

            }



            .woocommerce-checkout .form-row input.input-text {

                width: 100% !important;

                height: 44px !important;

                border: 1px solid #cbd5e1 !important;

                border-radius: 8px !important;

                padding: 8px 14px !important;

                font-size: 14px !important;

                background-color: #ffffff !important;

                box-sizing: border-box !important;

                color: #0f172a !important;

                transition: border-color 0.2s ease, box-shadow 0.2s ease;

            }



            .woocommerce-checkout .form-row textarea,

            .woocommerce-checkout #order_comments {

                width: 100% !important;

                max-width: 100% !important;

                min-height: 80px !important;

                height: auto !important;

                border: 1px solid #cbd5e1 !important;

                border-radius: 8px !important;

                padding: 10px 14px !important;

                font-size: 14px !important;

                background-color: #ffffff !important;

                box-sizing: border-box !important;

                color: #0f172a !important;

                resize: vertical !important;

            }



            .woocommerce-checkout .form-row input.input-text:focus, 

            .woocommerce-checkout .form-row textarea:focus {

                border-color: #2563eb !important;

                box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12) !important;

                outline: none !important;

            }



            /* --- Main Section Cards --- */

            .woocommerce-billing-fields, 

            #order_review_heading, 

            #order_review,

            .cartflows-checkout-form {

                background: #ffffff !important;

                padding: 18px 20px !important;

                border-radius: 12px !important;

                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03) !important;

                border: 1px solid #f1f5f9 !important;

                margin-bottom: 14px !important;

                box-sizing: border-box !important;

            }



            .woocommerce-checkout h3, 

            #order_review_heading {

                color: #0f172a !important;

                font-size: 18px !important;

                font-weight: 700 !important;

                border-bottom: 2px solid #2563eb !important;

                padding-bottom: 6px !important;

                margin-bottom: 14px !important;

            }



            /* --- 🚚 UNIQUE ANIMATED DELIVERY CHARGE SECTION --- */

            .woocommerce-shipping-totals, 

            .woocommerce-shipping-methods,

            #shipping_method {

                border: none !important;

                background: transparent !important;

                list-style: none !important;

                padding: 0 !important;

                margin: 0 !important;

            }



            #shipping_method li {

                background: #f8fafc !important;

                border: 1.5px solid #e2e8f0 !important;

                border-radius: 10px !important;

                padding: 12px 16px !important;

                margin-bottom: 10px !important;

                display: flex !important;

                align-items: center !important;

                justify-content: space-between !important;

                cursor: pointer !important;

                position: relative !important;

                transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;

            }



            #shipping_method li:hover {

                border-color: #93c5fd !important;

                background-color: #f0f7ff !important;

                transform: translateY(-1px);

            }



            #shipping_method li:has(input:checked) {

                border-color: #2563eb !important;

                background-color: #eff6ff !important;

                box-shadow: 0 4px 12px rgba(37, 99, 235, 0.12) !important;

            }



            #shipping_method input[type="radio"] {

                margin-right: 12px !important;

                accent-color: #2563eb !important;

                transform: scale(1.2);

            }



            #shipping_method label {

                font-size: 14.5px !important;

                font-weight: 600 !important;

                color: #1e293b !important;

                margin-bottom: 0 !important;

                cursor: pointer !important;

                width: 100% !important;

                display: flex !important;

                align-items: center !important;

                justify-content: space-between !important;

            }



            /* Table Line Clean */

            .woocommerce-checkout-review-order-table, 

            .woocommerce-checkout-review-order-table th, 

            .woocommerce-checkout-review-order-table td {

                border: none !important;

                padding: 8px 0 !important;

            }



            .woocommerce-checkout-review-order-table tr {

                border-bottom: 1px solid #f1f5f9 !important;

            }



            /* --- 🛍️ PREMIUM ANIMATED PLACE ORDER BUTTON (DESKTOP & GENERAL) --- */

            #add_payment_method #payment #place_order::before, 

            .woocommerce-checkout #payment #place_order::before,

            .cartflows-container #place_order::before,

            #add_payment_method #payment #place_order::after, 

            .woocommerce-checkout #payment #place_order::after,

            .cartflows-container #place_order::after,

            #place_order i, 

            #place_order span.dashicons {

                display: none !important;

                content: "" !important;

            }



            #add_payment_method #payment #place_order, 

            .woocommerce-checkout #payment #place_order,

            .cartflows-container #place_order {

                position: relative !important;

                background: linear-gradient(135deg, #1e40af 0%, #2563eb 50%, #1d4ed8 100%) !important;

                background-size: 200% auto !important;

                color: #ffffff !important;

                font-size: 17px !important;

                font-weight: 700 !important;

                padding: 14px 20px !important;

                border-radius: 10px !important;

                width: 100% !important;

                max-width: 100% !important;

                border: none !important;

                box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35) !important;

                cursor: pointer;

                display: flex !important;

                align-items: center !important;

                justify-content: center !important;

                gap: 8px !important;

                overflow: hidden !important;

                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;

                box-sizing: border-box !important;

                text-align: center !important;

                white-space: nowrap !important;

            }



            #place_order svg {

                flex-shrink: 0 !important;

            }



            /* Animated Shimmer Effect on Button */

            #add_payment_method #payment #place_order::before,

            .woocommerce-checkout #payment #place_order::before {

                content: '' !important;

                display: block !important;

                position: absolute !important;

                top: 0;

                left: -100%;

                width: 100%;

                height: 100%;

                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent) !important;

                animation: shimmer 3s infinite;

            }



            @keyframes shimmer {

                0% { left: -100%; }

                30% { left: 100%; }

                100% { left: 100%; }

            }



            #add_payment_method #payment #place_order:hover, 

            .woocommerce-checkout #payment #place_order:hover {

                background-position: right center !important;

                box-shadow: 0 10px 25px rgba(37, 99, 235, 0.45) !important;

                transform: translateY(-2px);

            }



            #add_payment_method #payment #place_order:hover svg, 

            .woocommerce-checkout #payment #place_order:hover svg {

                animation: bagBounce 0.5s ease infinite alternate;

            }



            @keyframes bagBounce {

                0% { transform: translateY(0); }

                100% { transform: translateY(-3px); }

            }



            /* --- 📱 ULTIMATE MOBILE RESPONSIVE BUTTON FIX --- */

            @media (max-width: 768px) {

                .woocommerce-checkout, .cartflows-container {

                    padding: 2px !important;

                }



                .woocommerce-billing-fields, 

                #order_review_heading, 

                #order_review,

                .cartflows-checkout-form {

                    padding: 12px 12px !important;

                    margin-bottom: 10px !important;

                    border-radius: 10px !important;

                }



                .woocommerce-checkout h3, 

                #order_review_heading {

                    font-size: 15px !important;

                    margin-bottom: 10px !important;

                }



                .woocommerce-checkout .form-row input.input-text {

                    height: 40px !important;

                    font-size: 13px !important;

                }



                .woocommerce-checkout .form-row textarea,

                .woocommerce-checkout #order_comments {

                    font-size: 13px !important;

                    padding: 8px 10px !important;

                    min-height: 65px !important;

                }



                #shipping_method li {

                    padding: 10px 10px !important;

                }



                #shipping_method label {

                    font-size: 13px !important;

                }



                /* মোবাইল বাটনের স্পেশাল ফিক্স */

                #add_payment_method #payment #place_order, 

                .woocommerce-checkout #payment #place_order,

                .cartflows-container #place_order {

                    font-size: 13.5px !important; /* টেক্সট সাইজ ছোট করা হয়েছে */

                    padding: 12px 10px !important;  /* প্যাডিং কমানো হয়েছে */

                    gap: 6px !important;

                    letter-spacing: -0.2px !important;

                }



                #place_order span {

                    font-size: 13.5px !important;

                    white-space: nowrap !important;

                }



                #place_order svg {

                    width: 16px !important;

                    height: 16px !important;

                }

            }

        </style>



        <script>

        document.addEventListener("DOMContentLoaded", function() {

            function forceBengaliTranslation() {

                // ১. লেবেল কাস্টমাইজেশন

                const labels = {

                    "First name": "আপনার নাম",

                    "Street address": "পূর্ণাঙ্গ ঠিকানা (গ্রাম/রোড নম্বর)",

                    "Town / City": "জেলা / শহর",

                    "Phone": "মোবাইল নম্বর",

                    "Order notes": "আপনার প্রোডাক্টের সাইজ, কালার বা অন্যান্য বৈশিষ্ট্য এখানে লিখুন"

                };



                document.querySelectorAll('.form-row label').forEach(label => {

                    let text = label.innerText.replace('*', '').trim();

                    if (labels[text]) {

                        label.innerHTML = labels[text] + ' <abbr class="required" title="required">*</abbr>';

                    }

                });



                // ২. টেক্সট এরিয়া প্লেসহোল্ডার

                const noteField = document.querySelector('#order_comments');

                if (noteField) {

                    noteField.setAttribute('placeholder', 'আপনার প্রোডাক্টের সাইজ, কালার বা অন্যান্য বৈশিষ্ট্য এখানে লিখুন...');

                }



                // ৩. ডিকশনারি ট্রান্সলেশন

                const fullTranslations = {

                    "Billing details": "বিলিং তথ্য",

                    "Your order": "আপনার অর্ডার",

                    "Product": "পণ্য",

                    "Subtotal": "সাবটোটাল",

                    "Shipping": "ডেলিভারি চার্জ",

                    "Total": "সর্বমোট",

                    "Cash on delivery": "ক্যাশ অন ডেলিভারি (পণ্য হাতে পেয়ে টাকা দিন)",

                    "Pay with cash upon delivery.": "পণ্য হাতে পাওয়ার পর মূল্য পরিশোধ করুন।"

                };



                // ৪. শিপিং অপশন ও জেনারেল টেক্সট অনুবাদ

                document.querySelectorAll('h3, th, td, label, span, p, #shipping_method label').forEach(el => {

                    let cleanText = el.innerText ? el.innerText.trim() : '';



                    if(cleanText.includes("Inside Dhaka")) {

                        el.innerText = el.innerText.replace("Inside Dhaka:", "ঢাকার ভিতরে:");

                    }

                    if(cleanText.includes("Outside Dhaka")) {

                        el.innerText = el.innerText.replace("Outside Dhaka:", "ঢাকার বাইরে:");

                    }

                    if(cleanText.includes("Basic")) {

                        el.innerText = el.innerText.replace("Basic:", "সাধারণ ডেলিভারি:");

                    }



                    if (fullTranslations[cleanText]) {

                        el.innerText = fullTranslations[cleanText];

                    }

                });



                // ৫. প্রাইভেসি পলিসি

                const privacyEl = document.querySelector('.woocommerce-privacy-policy-text p');

                if (privacyEl) {

                    privacyEl.innerText = "আপনার ব্যক্তিগত তথ্য অর্ডার প্রসেস করা এবং এই ওয়েবসাইটে আপনার অভিজ্ঞতা সহজ করার জন্য ব্যবহার করা হবে।";

                }



                // ৬. মোবাইলের জন্য অপটিমাইজড বাটন টেক্সট ও আইকন

                const orderBtn = document.querySelector('#place_order');

                if (orderBtn) {

                    let btnText = orderBtn.innerText || orderBtn.value;

                    let priceMatch = btnText.match(/[0-9.,]+\s?৳?/);

                    let finalPrice = priceMatch ? ' (' + priceMatch[0] + ')' : '';



                    let bagIcon = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>`;

                    

                    /* মোবাইলেও যাতে এক লাইনে সুন্দর ধরে তাই কন্টেন্ট এক লাইনে রাখা হলো */

                    orderBtn.innerHTML = bagIcon + '<span>অর্ডার কনফার্ম করুন' + finalPrice + '</span>';

                }

            }



            forceBengaliTranslation();



            if (window.jQuery) {

                jQuery(document).ajaxComplete(function() {

                    forceBengaliTranslation();

                });

            }

        });

        </script>

        <?php

    }

}

