

'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(100).fadeOut("slow");

        /*------------------
            Gallery filter
        --------------------*/
        $('.featured__controls li').on('click', function () {
            $('.featured__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.featured__filter').length > 0) {
            var containerEl = document.querySelector('.featured__filter');
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //Humberger Menu
    $(".humberger__open").on('click', function () {
        $(".humberger__menu__wrapper").addClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").addClass("active");
        $("body").addClass("over_hid");
    });

    $(".humberger__menu__overlay").on('click', function () {
        $(".humberger__menu__wrapper").removeClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").removeClass("active");
        $("body").removeClass("over_hid");
    });

    /*------------------
        Navigation
    --------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*-----------------------
        Categories Slider
    ------------------------*/
    $(".categories__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 4,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {

            0: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 3,
            },

            992: {
                items: 4,
            }
        }
    });


    $('.hero__categories__all').on('click', function () {
        $('.hero__categories ul').slideToggle(400);
    });

    /*--------------------------
        Latest Product Slider
    ----------------------------*/
    $(".latest-product__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*-----------------------------
        Product Discount Slider
    -------------------------------*/
    $(".product__discount__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 3,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {

            320: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 2,
            },

            992: {
                items: 3,
            }
        }
    });

    /*---------------------------------
        Product Details Pic Slider
    ----------------------------------*/
    $(".product__details__pic__slider").owlCarousel({
        loop: true,
        margin: 20,
        items: 4,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*-----------------------
        Price Range Slider
    ------------------------ */
    var rangeSlider = $(".price-range"),
        minamount = $("#minamount"),
        maxamount = $("#maxamount"),
        minPrice = rangeSlider.data('min'),
        maxPrice = rangeSlider.data('max');
    rangeSlider.slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minPrice, maxPrice],
        slide: function (event, ui) {
            minamount.val('Rs.' + ui.values[0]);
            maxamount.val('Rs.' + ui.values[1]);
        }
    });
    minamount.val('Rs. ' + rangeSlider.slider("values", 0));
    maxamount.val('Rs. ' + rangeSlider.slider("values", 1));

    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*------------------
        Single Product
    --------------------*/
    $('.product__details__pic__slider img').on('click', function () {

        var imgurl = $(this).data('imgbigurl');
        var bigImg = $('.product__details__pic__item--large').attr('src');
        if (imgurl != bigImg) {
            $('.product__details__pic__item--large').attr({
                src: imgurl
            });
        }
    });

    /*-------------------
        Quantity change
    --------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        var productId = $button.parent().data('product-id');
        var price = $button.parent().data('price');

        console.log(productId)
        $button.parent().find('input').val(newVal);
        $.ajax({
            url: '/update-quantity', // Replace with your server endpoint
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                sku: productId,
                quantity: newVal
            },
            success: function (response) {
                var newTotal = (newVal * price).toFixed(2);
                $button.parent().closest('tr').find('.shoping__cart__total').text(newTotal);
                updateTotalSum();

            },
            error: function (error) {
                console.error('Error updating quantity:', error);
                // Optionally, you can revert the value in case of an error
                input.val(oldValue);
            }
        });
    });

    var  total = 0;
    var nettotal=0;
    $('.mytotal').each(function () {
        total += parseFloat($(this).text());
    });
    $('.subtotal').text(total.toFixed(2));

    if (total > 1000) {
        $('.free').text('Free');
        nettotal = total; // Delivery charge is free
        $('.nettotal').text(nettotal.toFixed(2));

    } else {
        
        var deliveryCharge = parseFloat($('.delivaryCharge').text());
         nettotal = total + deliveryCharge;
        $('.nettotal').text(nettotal.toFixed(2));

    }
console.log(nettotal)


})(jQuery);

function updateTotalSum() {
    var totalSum = 0;

    $('.shoping__cart__total').each(function () {
        totalSum += parseFloat($(this).text());
    });

    var netTotal;

    if (totalSum > 1000) {
        $('#free').text('Free');
        netTotal = totalSum; // Delivery charge is free
    } else {
        var deliveryCharge = parseFloat($('#delicaryCharge').text());
        netTotal = totalSum + deliveryCharge;
    }
console.log(netTotal);
    $('#netTotal').text(netTotal.toFixed(2)); // Update the total sum and format to 2 decimal places
    $('#subtotal').text(totalSum.toFixed(2)); // Update the subtotal and format to 2 decimal places
}
// Initial total sum calculation
updateTotalSum();