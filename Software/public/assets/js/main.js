(function($) {
    "use strict"
    jQuery(document).ready(function() {
        // Navigation for Mobile Device
        $('.custom-navbar').on('click', function(){
            $('.main-menu ul').slideToggle(500);
        });
        $(window).on('resize', function(){
            if ( $(window).width() > 767 ) {
                $('.main-menu ul').removeAttr('style');
            }
        });

// Employee Slider
$('.client-slider').owlCarousel({
    loop: true,
    margin: 20,
    autoplay: false,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    nav: false,
    dots: false,
    responsiveClass: true,
    responsive: {
        0: {
            items: 1
        },
        576: {
            items: 1
        },
        768: {
            items: 2
        },
        992: {
            items: 3
        }
    }
});

// Nice Select
$('select').niceSelect();

// Bmi
$("#bmi").submit(function(e) {

    e.preventDefault();

    

    var weight = $("[name='weight']").val();
    var height = $("[name='height']").val();

    if (weight > 0 && height > 0) { //IF THEY ARE NOT ZERO

        var finalBmi = (weight / (height * height)) * 703;

        $("#dopeBMI").val(finalBmi.toFixed(1));
        if (finalBmi < 18.5) {
            $("#meaning").html('<p class="text-success">You are underweight.</p>');
            $('#applyBtn').removeClass('hide').addClass('show');
        } else if (finalBmi > 18.5 && finalBmi < 24.9){
            $("#meaning").html('<p class="text-primary">You are normal.</p>');
            $('#applyBtn').removeClass('show').addClass('hide');
        } else if(finalBmi > 24.9 && finalBmi < 29.99){
            $('#applyBtn').removeClass('hide').addClass('show');
            $("#meaning").html('<p class="text-warning">You are overweight.</p>');
        } else if(finalBmi > 30 && finalBmi < 39){
            $('#applyBtn').removeClass('hide').addClass('show');
            $("#meaning").html('<p class="text-danger">You are obese.</p>');
        } else if(finalBmi > 39){
            $('#applyBtn').removeClass('hide').addClass('show');
            $("#meaning").html('<p class="text-danger">You are extremely obese.</p>');
        }
    } 
});

// Google Map
if ( $('#mapBox').length ){
    var $lat = $('#mapBox').data('lat');
    var $lon = $('#mapBox').data('lon');
    var $zoom = $('#mapBox').data('zoom');
    var $marker = $('#mapBox').data('marker');
    var $info = $('#mapBox').data('info');
    var $markerLat = $('#mapBox').data('mlat');
    var $markerLon = $('#mapBox').data('mlon');
    var map = new GMaps({
        el: '#mapBox',
        lat: $lat,
        lng: $lon,
        scrollwheel: false,
        scaleControl: true,
        streetViewControl: false,
        panControl: true,
        disableDoubleClickZoom: true,
        mapTypeControl: false,
        zoom: $zoom,
        styles: [
        {
            "featureType": "water",
            "elementType": "geometry.fill",
            "stylers": [
            {
                "color": "#dcdfe6"
            }
            ]
        },
        {
            "featureType": "transit",
            "stylers": [
            {
                "color": "#808080"
            },
            {
                "visibility": "off"
            }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#dcdfe6"
            }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
            {
                "color": "#ffffff"
            }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry.fill",
            "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#ffffff"
            },
            {
                "weight": 1.8
            }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry.stroke",
            "stylers": [
            {
                "color": "#d7d7d7"
            }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "geometry.fill",
            "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#ebebeb"
            }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry",
            "stylers": [
            {
                "color": "#a7a7a7"
            }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry.fill",
            "stylers": [
            {
                "color": "#ffffff"
            }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry.fill",
            "stylers": [
            {
                "color": "#ffffff"
            }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "geometry.fill",
            "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#efefef"
            }
            ]
        },
        {
            "featureType": "road",
            "elementType": "labels.text.fill",
            "stylers": [
            {
                "color": "#696969"
            }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "labels.text.fill",
            "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#737373"
            }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "labels.icon",
            "stylers": [
            {
                "visibility": "off"
            }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "labels",
            "stylers": [
            {
                "visibility": "off"
            }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry.stroke",
            "stylers": [
            {
                "color": "#d6d6d6"
            }
            ]
        },
        {
            "featureType": "road",
            "elementType": "labels.icon",
            "stylers": [
            {
                "visibility": "off"
            }
            ]
        },
        {},
        {
            "featureType": "poi",
            "elementType": "geometry.fill",
            "stylers": [
            {
                "color": "#dadada"
            }
            ]
        }
        ]
    });
}

});

jQuery(window).on('load', function() {
    // WOW JS
    new WOW().init();
    // Preloader
    // $('.preloader').fadeOut(1000);
});

$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
    if (!$(this).next().hasClass('show')) {
        $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
    }
    var $subMenu = $(this).next(".dropdown-menu");
    $subMenu.toggleClass('show');


    $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
        $('.dropdown-submenu .show').removeClass("show");
    });


    return false;
});
})(jQuery);
