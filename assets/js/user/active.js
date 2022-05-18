$("#search").keyup(function() {
    var filter = $(this).val(),
        count = 0;
    $('#div_all .art1').each(function() {
        if ($(this).text().search(new RegExp(filter, "i")) < 0) {
            $(this).hide();
        } else {
            $(this).show();
            count++;
        }
    });

});

function deleteallc() {
    $.ajax({
        url: "../controller/deleteallcart.php",
        method: "POST",
        data: {},
        cache: false,
        success: function(response) {
            Swal.fire(
                'Removed !',
                'All articles are removed from your cart !.',
                'success'
            ).then(function() {
                location.reload();
            })

        },

    });
    return false;
}

function search() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    ul = document.getElementsByClassName("div_all")[0];
    li = ul.getElementsByClassName("art1")[0];
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByClassName("label")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

let notyf = new Notyf();

function QuickView(id, label, prix, description, image, promo) {
    $('#label_quickview').html(label);
    var prixpromo = 0;
    if (promo > 0) {
        prixpromo = prix - (prix * promo) / 100;
        $('#prix_quickview').html(prixpromo + " DT");
        $('#prix_promo_quickview').html(prix + " DT");
    } else {
        prixpromo = prix;
        $('#prix_quickview').html(prixpromo + " DT");
        $('#prix_promo_quickview').html(" ");
        $('#promo_badge_quick').hide();
    }
    $('#image_quickview').attr("src", image);
    $('#description_quickview').html(description);
    $('#cart_quickview').attr("onclick", "addcquickview(" + id + "," + prixpromo + ")");
    $('#wishlist_quickview').attr("onclick", "addwquickview(" + id + ",'" + image + "','" + label + "'," + prixpromo + ")");
    $('#quickview').modal('show');
}
$(function() {
    var tbl = $('#table_cart');
    tbl.find('tr').each(function() {
        calculateOrder();
        $(this).find('.qte').bind("blur", function() {
            calculateSum();
            calculateOrder();
        });
    });

    function calculateOrder() {
        var order_summary = 0;
        var tbl = $('#table_cart');
        tbl.find('tr').each(function() {
            var total_row = parseFloat($(this).find(".total_row").html());
            if (isNaN(total_row)) {
                total_row = 0;
            }
            order_summary += total_row;
            $('#order_summary').text(order_summary.toFixed(2) + " DT");
            $('#pay').text(order_summary.toFixed(2) + " DT");
        });
    }

    function calculateSum() {
        var tbl = $('#table_cart');
        tbl.find('tr').each(function() {
            var sum = 0;
            $(this).find('.promo_prix').each(function() {
                prix = parseFloat($(this).html());
                q = $(this).parent().find('.qte').val();
                sum = prix * q;

            });

            $(this).find('.total_row').text(sum.toFixed(2));
        });
    }
});

function addcquickview(id, prix) {
    quantity = $('#qty').val();
    $.ajax({
        url: "../controller/addcart.php",
        method: "POST",
        data: { 'id': id, 'quantity': quantity, 'prix': prix },
        cache: false,
        success: function(response) {
            notyf.success('Article Added Successfully to the cart !');
            //  alert($('#quantity_cart').text());
            $('#quantity_cart').text(response);
            $('#pay').text((parseFloat($('#pay').html()) + parseFloat(prix * quantity)).toFixed(2) + " DT");


        },

    });
    return false;
}

function addwquickview(id, image, label, prix) {
    quantity = $('#qty').val();
    $.ajax({
        url: "../controller/addwishlist.php",
        method: "POST",
        data: { 'id': id, 'quantity': quantity, 'prix': prix, 'image': image, 'label': label },
        cache: false,
        success: function(response) {
            Swal.fire(
                'ADDED!',
                'The article has been added to your wishlist !.',
                'success'
            ).then(function() {
                location.reload();
            })

        },

    });
    return false;
}

function addc(id, quantity = 1, prix) {

    $.ajax({
        url: "../controller/addcart.php",
        method: "POST",
        data: { 'id': id, 'quantity': quantity, 'prix': prix },
        cache: false,
        success: function(response) {
            notyf.success('Article Added Successfully to the cart !');
            //  alert($('#quantity_cart').text());
            $('#quantity_cart').text(response);
            $('#pay').text((parseFloat($('#pay').html()) + parseFloat(prix * quantity)).toFixed(2) + " DT");


        },

    });
    return false;
}

function addw(id, image, label, quantity, prix) {
    $.ajax({
        url: "../controller/addwishlist.php",
        method: "POST",
        data: { 'id': id, 'quantity': quantity, 'prix': prix, 'image': image, 'label': label },
        cache: false,
        success: function(response) {
            Swal.fire(
                'ADDED!',
                'The article has been added to your wishlist !.',
                'success'
            ).then(function() {
                location.reload();
            })

        },

    });
    return false;
}

function addwtoc(id, quantity, prix) {
    $.ajax({
        url: "../controller/addwtoc.php",
        method: "POST",
        data: { 'id': id, 'quantity': quantity, 'prix': prix },
        cache: false,
        success: function(response) {
            Swal.fire(
                'ADDED!',
                'The article has been added to your cart !.',
                'success'
            ).then(function() {
                location.reload();
            })
        },

    });
    return false;
}

function addwtocall() {

    var ul = $('#wishlist-ul');
    var array_wishlist = [];
    ul.find('li').each(function() {
        id = parseInt($(this).find('.wishlist-id').val());
        quantity = parseInt($(this).find('.wishlist-quantity').html());
        prix = parseFloat($(this).find('.wishlist-price').html());
        array_wishlist.push({
            id,
            quantity,
            prix
        });
    });
    console.log(array_wishlist);
    $.ajax({
        url: "../controller/addwishlistall.php",
        method: "POST",
        data: { data: array_wishlist },
        cache: false,
        success: function(response) {
            Swal.fire(
                'ADDED!',
                'All Articles are added to your cart !.',
                'success'
            ).then(function() {
                location.reload();
            })

        },

    });
    return false;
}

function deletec(id, label, promo) {
    Swal.fire({
        title: (promo > 0) ? 'You Sure about removing ' + label + '? \n its in promo !' : 'You Sure about removing ' + label + '?',
        showDenyButton: true,
        confirmButtonText: `YES`,
        denyButtonText: `No`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "../controller/deletecart.php",
                method: "POST",
                data: { 'id': id },
                cache: false,
                success: function(response) {
                    if (response == "True") {
                        Swal.fire(
                            'Removed!',
                            'The article has been removed.',
                            'success'
                        ).then(function() {
                            location.reload();
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                    }

                },

            });

        }
    })
}


function deletew(id) {

    $.ajax({
        url: "../controller/deletewishlist.php",
        method: "POST",
        data: { 'id': id },
        cache: false,
        success: function(response) {
            Swal.fire(
                'Deleted!',
                'The article has been removed from your whishlist !.',
                'success'
            ).then(function() {
                location.reload();
            })

        },

    });
    return false;
}

function updatec() {

    var tbl = $('#table_cart');
    var array_cart = [];
    tbl.find('tr').each(function() {
        $(this).find('.id_art').each(function() {
            id = parseInt($(this).val());
            quantity = parseInt($(this).parent().find('.qte').val());
            prix = parseFloat($(this).parent().find('.promo_prix').html());
            array_cart.push({
                id,
                quantity,
                prix
            });
        });
    });
    console.log(array_cart);
    $.ajax({
        url: "../controller/updatecart.php",
        method: "POST",
        data: { data: array_cart },
        cache: false,
        success: function(response) {
            notyf.success('Updated !');
            // $('#quantity_cart').text(response);

        },

    });
    return false;
}
(function($) {
    'use strict';

    // :: All Variables

    var bigshopWindow = $(window),
        wel_slides = $('.welcome_slides'),
        welSlidesTwo = $('.welSlideTwo');

    // :: Preloader Code

    bigshopWindow.on('load', function() {
        $('#preloader').fadeOut('1000', function() {
            $(this).remove();
        });
    });

    // :: Menu Code

    if ($.fn.classyNav) {
        $('#bigshopNav').classyNav();
    }

    // :: Fixed Top Dropdown Code    

    $(".classy-navbar-toggler").on("click", function() {
        $(".top-header-area").toggleClass("z-index-reduce");
    });
    $(".classycloseIcon, .language-currency-dropdown a.btn").on("click", function() {
        $(".top-header-area").removeClass("z-index-reduce");
    });
    $(".language-currency-dropdown a.btn").on("click", function() {
        $(".classy-menu").removeClass("menu-on");
        $(".navbarToggler").removeClass("active");
    });

    // :: Search Form Code    
    $(".search-btn").on("click", function() {
        $(".search-form").toggleClass("active");
    });

    // :: New Arrivals Slider Code

    if ($.fn.owlCarousel) {
        $(".megamenu-slides").owlCarousel({
            items: 1,
            margin: 0,
            loop: false,
            nav: true,
            navText: ['<i class="icofont-rounded-left"></i>', '<i class="icofont-rounded-right"></i>'],
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000
        });
    }

    // :: Hero Slides Code - Home 1

    if ($.fn.owlCarousel) {
        wel_slides.owlCarousel({
            items: 1,
            margin: 0,
            loop: false,
            dots: true,
            nav: true,
            navText: ['<i class="icofont-rounded-left"></i>', '<i class="icofont-rounded-right"></i>'],
            autoplay: true,
            autoplayTimeout: 6000,
            smartSpeed: 800,
            rewind: true,
            animateIn: "fadeIn",
            animateOut: "fadeOut"
        });

        wel_slides.on('translate.owl.carousel', function() {
            var layer = $("[data-animation]");
            layer.each(function() {
                var anim_name = $(this).data('animation');
                $(this).removeClass('animated ' + anim_name).css('opacity', '0');
            });
        });

        $("[data-delay]").each(function() {
            var anim_del = $(this).data('delay');
            $(this).css('animation-delay', anim_del);
        });

        $("[data-duration]").each(function() {
            var anim_dur = $(this).data('duration');
            $(this).css('animation-duration', anim_dur);
        });

        wel_slides.on('translated.owl.carousel', function() {
            var layer = wel_slides.find('.owl-item.active').find("[data-animation]");
            layer.each(function() {
                var anim_name = $(this).data('animation');
                $(this).addClass('animated ' + anim_name).css('opacity', '1');
            });
        });
    }

    // :: Hero Slides Code - Home 2

    if ($.fn.owlCarousel) {
        welSlidesTwo.owlCarousel({
            items: 2,
            margin: 15,
            loop: true,
            center: true,
            nav: true,
            navText: ['<i class="icofont-rounded-left"></i>', '<i class="icofont-rounded-right"></i>'],
            dots: true,
            autoplay: true,
            smartSpeed: 1500,
            autoplayTimeout: 7000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 2
                }
            }
        });

        welSlidesTwo.on('translate.owl.carousel', function() {
            var layer = $("[data-animation]");
            layer.each(function() {
                var anim_name = $(this).data('animation');
                $(this).removeClass('animated ' + anim_name).css('opacity', '0');
            });
        });

        $("[data-delay]").each(function() {
            var anim_del = $(this).data('delay');
            $(this).css('animation-delay', anim_del);
        });

        $("[data-duration]").each(function() {
            var anim_dur = $(this).data('duration');
            $(this).css('animation-duration', anim_dur);
        });

        welSlidesTwo.on('translated.owl.carousel', function() {
            var layer = welSlidesTwo.find('.owl-item.center').find("[data-animation]");
            layer.each(function() {
                var anim_name = $(this).data('animation');
                $(this).addClass('animated ' + anim_name).css('opacity', '1');
            });
        });
    }

    // :: New Arrivals Slides Code

    if ($.fn.owlCarousel) {
        $(".new_arrivals_slides").owlCarousel({
            items: 4,
            margin: 30,
            loop: false,
            nav: true,
            navText: ['<i class="icofont-rounded-left"></i>', '<i class="icofont-rounded-right"></i>'],
            dots: false,
            autoplay: false,
            smartSpeed: 1500,
            autoplayTimeout: 7000,
            autoplayHoverPause: true,
            responsive: {
                320: {
                    items: 1
                },
                480: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                }
            }
        });
    }


    // :: Featured Product Slides Code

    if ($.fn.owlCarousel) {
        $(".featured_product_slides").owlCarousel({
            items: 2,
            margin: 30,
            loop: true,
            nav: true,
            navText: ['<i class="icofont-rounded-left"></i>', '<i class="icofont-rounded-right"></i>'],
            dots: false,
            autoplay: true,
            smartSpeed: 1500,
            autoplayTimeout: 7000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 2
                }
            }
        });
    }

    // :: Popular Items Slides Code

    if ($.fn.owlCarousel) {
        $(".popular_items_slides").owlCarousel({
            items: 4,
            margin: 30,
            loop: true,
            nav: true,
            navText: ['<i class="icofont-rounded-left"></i>', '<i class="icofont-rounded-right"></i>'],
            dots: false,
            autoplay: true,
            smartSpeed: 1500,
            autoplayTimeout: 7000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                }
            }
        });
    }

    // :: Popular Brands Slide Code

    if ($.fn.owlCarousel) {
        $(".popular_brands_slide").owlCarousel({
            items: 6,
            margin: 30,
            loop: true,
            nav: false,
            dots: false,
            center: false,
            autoplay: true,
            smartSpeed: 800,
            responsive: {
                0: {
                    items: 2
                },
                480: {
                    items: 3
                },
                768: {
                    items: 4
                },
                992: {
                    items: 6
                }
            }
        });
    }

    // :: Testimonial Slides Code

    if ($.fn.owlCarousel) {
        $(".testimonials_slides").owlCarousel({
            items: 1,
            margin: 0,
            loop: true,
            dots: true,
            center: true,
            autoplay: true,
            nav: true,
            navText: ['<i class="icofont-rounded-left"></i>', '<i class="icofont-rounded-right"></i>'],
            smartSpeed: 800
        });
    }

    // :: Shop Catagory Slides Code

    if ($.fn.owlCarousel) {
        $(".shop_by_catagory_slides").owlCarousel({
            items: 7,
            margin: 30,
            loop: true,
            dots: true,
            autoplay: true,
            smartSpeed: 800,
            responsive: {
                0: {
                    items: 2
                },
                480: {
                    items: 3
                },
                576: {
                    items: 4
                },
                768: {
                    items: 5
                },
                992: {
                    items: 6
                },
                1200: {
                    items: 7
                }
            }
        });
    }

    // :: Tooltip Code

    if ($.fn.tooltip) {
        $('[data-toggle="tooltip"]').tooltip();
    }

    // :: Popup Gallery Code

    if ($.fn.magnificPopup) {
        $('.video_btn').magnificPopup({
            disableOn: 0,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: true,
            fixedContentPos: false
        });
        $('.gallery_img').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
        $('.size_guide_img').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    }

    // :: ScrollUp Code

    if ($.fn.scrollUp) {
        $.scrollUp({
            scrollSpeed: 1000,
            easingType: 'easeInOutQuart',
            scrollText: '<i class="icofont-rounded-up"></i>'
        });
    }

    // :: Counterup Code

    if ($.fn.counterUp) {
        $('.counter').counterUp({
            delay: 10,
            time: 2000
        });
    }

    // :: Nice Select Code

    if ($.fn.niceSelect) {
        $('select').niceSelect();
    }

    // :: Jarallax Code

    if ($.fn.jarallax) {
        $('.jarallax').jarallax({
            speed: 0.2
        });
    }

    // :: Popover Code

    if ($.fn.popover) {
        $('[data-toggle="popover"]').popover({
            html: true,
            trigger: 'hover',
            content: function() {
                return '<img src="' + $(this).data('img') + '" />';
            }
        });
    }

    // :: Countdown Code

    $('[data-countdown]').each(function() {
        var $this = $(this),
            finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $(this).find(".days").html(event.strftime("%D"));
            $(this).find(".hours").html(event.strftime("%H"));
            $(this).find(".minutes").html(event.strftime("%M"));
            $(this).find(".seconds").html(event.strftime("%S"));
        });
    });

    // :: Price Range Code

    $('.slider-range-price').each(function() {
        var min = $(this).data('min'),
            max = $(this).data('max'),
            unit = $(this).data('unit'),
            value_min = $(this).data('value-min'),
            value_max = $(this).data('value-max'),
            label_result = $(this).data('label-result'),
            t = $(this);
        $(this).slider({
            range: true,
            min: min,
            max: max,
            values: [value_min, value_max],
            slide: function(event, ui) {
                var result = label_result + " " + unit + ui.values[0] + ' - ' + unit + ui.values[1];
                t.closest('.slider-range').find('.range-price').html(result);
            }
        });
    });

    // :: PreventDefault "a" Click

    $("a[href='#']").on('click', function($) {
        $.preventDefault();
    });

    //::  WoW Active Code

    if (bigshopWindow.width() > 767) {
        new WOW().init();
    }

})(jQuery)