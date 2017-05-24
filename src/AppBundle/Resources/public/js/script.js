/*
 * Runek
 * http://www.scoopthemes.com/
 *
 * Copyright (c) 2014, ScoopThemes
 * Licensed under the BSD license.
 */
'use strict';

var appMaster = {

    preLoader: function(){
        var imageSources = [];
        $('img').each(function() {
            var sources = $(this).attr('src');
            imageSources.push(sources);
        });
        if($(imageSources).load()){
            $('.pre-loader').fadeOut('slow');
        }
    },

    navSpy: function(){
        /* affix the navbar after scroll below header */
        $('#nav.navbar-static-top').affix({
            offset: {
                top: $('header').height() - $('#nav').height()
            }
        });

        /* highlight the top nav as scrolling occurs */
        $('body').scrollspy({
            target: '#nav'
        });
    },

    smoothScroll: function() {
        // Smooth Scrolling 
        $('a[href*=#]:not([href=#carousel-example-generic], [href=#testimonials-carousel], [href=#carousel-team], [href=#carousel-slider])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    },

    scollToTop: function(){
        /* smooth scrolling for scroll to top */
        $('.scroll-top').click(function() {
            $('body,html').animate({
                scrollTop: 0
            }, 1000);
        });
    },

    headerSlider: function(){

        var docHeight = $(window).height();
        
        $("#slider").height(docHeight + "px");

        $('.mh-container').height(docHeight + "px");

    },
    owlCarousel: function(){
        var owl = $("#owl-screenshots");

        owl.owlCarousel({
            pagination:true
        });

        $(".owl-next").click(function() {
            owl.trigger('owl.next');
        });

        $(".owl-prev").click(function(){
            owl.trigger('owl.prev');
        });

    },

    maps: function(){
        // When the window has finished loading create our google map below
        google.maps.event.addDomListener(window, 'load', init);
        google.maps.event.addDomListener(window, 'resize', init);

        function init() {
            // Basic options for a simple Google Map
            // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var mapOptions = {
                zoom: 15,
                draggable: true,
                zoomControl: true,
                scrollwheel: false,
                streetViewControl: false,

                // The latitude and longitude to center the map (always required)
                center: new google.maps.LatLng(44.7866, 20.4489), // Belgrade
                // How you would like to style the map.
                // This is where you would paste any style found on Snazzy Maps.
                styles: [
                    {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
                    {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
                    {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                    {
                        featureType: 'administrative.locality',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#de5749'}]
                    },
                    {
                        featureType: 'poi',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#de5749'}]
                    },
                    {
                        featureType: 'poi.park',
                        elementType: 'geometry',
                        stylers: [{color: '#263c3f'}]
                    },
                    {
                        featureType: 'poi.park',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#6b9a76'}]
                    },
                    {
                        featureType: 'road',
                        elementType: 'geometry',
                        stylers: [{color: '#38414e'}]
                    },
                    {
                        featureType: 'road',
                        elementType: 'geometry.stroke',
                        stylers: [{color: '#212a37'}]
                    },
                    {
                        featureType: 'road',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#9ca5b3'}]
                    },
                    {
                        featureType: 'road.highway',
                        elementType: 'geometry',
                        stylers: [{color: '#746855'}]
                    },
                    {
                        featureType: 'road.highway',
                        elementType: 'geometry.stroke',
                        stylers: [{color: '#1f2835'}]
                    },
                    {
                        featureType: 'road.highway',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#f3d19c'}]
                    },
                    {
                        featureType: 'transit',
                        elementType: 'geometry',
                        stylers: [{color: '#2f3948'}]
                    },
                    {
                        featureType: 'transit.station',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#de5749'}]
                    },
                    {
                        featureType: 'water',
                        elementType: 'geometry',
                        stylers: [{color: '#17263c'}]
                    },
                    {
                        featureType: 'water',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#515c6d'}]
                    },
                    {
                        featureType: 'water',
                        elementType: 'labels.text.stroke',
                        stylers: [{color: '#17263c'}]
                    }
                ]
            };
            var mapElement = document.getElementById('map');
            var map = new google.maps.Map(mapElement, mapOptions);
            var infoWindow = new google.maps.InfoWindow({map: map});
            var infowindow = new google.maps.InfoWindow();
            // Get the HTML DOM element that will contain your map
            // We are using a div with id="map" seen below in the <body>

            // Create the Google Map using out element and options defined above

            var currentPos;
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    currentPos= new google.maps.LatLng(pos.lat, pos.lng);
                    infoWindow.setPosition(pos);
                    infoWindow.setContent('Location found.');
                    map.setCenter(pos);
                }, function () {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.');
            }


            var objects = [];
            var marker;
            $.ajax({
                type: 'GET',
                url: Routing.generate('map'),
                data: {get_param: 'name'},
                dataType: "json",
                success: function (data) {
                    for (var key in data) {
                        if (data.hasOwnProperty(key)) {
                            var val = data[key];
                            objects.push({
                                name: val.name,
                                address: val.address,
                                lat: val.latitude,
                                lng: val.longitude
                            });

                        }
                    }

                    for (var i = 0, object; object = objects[i]; i++) {
                        addMarker(object);
                    }

                },
                error: function (data) {
                    console.log(data.get_param);
                }
            });

            function addMarker(object) {
                marker = new google.maps.Marker({
                    animation: google.maps.Animation.DROP,
                    position: {lat: object.lat, lng: object.lng},
                    icon: '../bundles/app/img/bar.png',
                    map: map
                });

                var distPos =  new google.maps.LatLng(object.lat, object.lng);
                var distance = google.maps.geometry.spherical.computeDistanceBetween(currentPos, distPos)/1000;
                var d=parseFloat(Math.round(distance * 100) / 100).toFixed(2);
                //alert(d+'km' + object.name);

                google.maps.event.addListener(marker, 'click', (function (marker) {
                    return function () {
                        infowindow.setContent(object.name + '<br>' + object.address + '<br>' + d +'km');
                        infowindow.open(map, marker);
                    }
                })(marker));

                // marker.addListener('click', toggleBounce);
                // marker.setMap(map);
            }

        }


    },
    animateScript: function() {
        $('.scrollpoint.sp-effect1').waypoint(function(){$(this).toggleClass('active');$(this).toggleClass('animated fadeInLeft');},{offset:'100%'});
       $('.scrollpoint.sp-effect2').waypoint(function(){$(this).toggleClass('active');$(this).toggleClass('animated fadeInRight');},{offset:'100%'});
       $('.scrollpoint.sp-effect3').waypoint(function(){$(this).toggleClass('active');$(this).toggleClass('animated fadeInDown');},{offset:'100%'});
       $('.scrollpoint.sp-effect4').waypoint(function(){$(this).toggleClass('active');$(this).toggleClass('animated fadeIn');},{offset:'100%'});
       $('.scrollpoint.sp-effect5').waypoint(function(){$(this).toggleClass('active');$(this).toggleClass('animated fadeInUp');},{offset:'100%'});
       $('.scrollpoint.sp-effect6').waypoint(function(){$(this).toggleClass('active');$(this).toggleClass('animated bounceIn');},{offset:'100%'});
    }
};


$(document).ready(function() {

    appMaster.smoothScroll();
    appMaster.animateScript();
    //appMaster.navSpy();
    appMaster.scollToTop();
    appMaster.headerSlider();
    appMaster.owlCarousel();
    appMaster.maps();

});