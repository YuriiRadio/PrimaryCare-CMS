var map, marker, infowindow;
function initMap() {
    
    var lat = $('#map').data('lat');
    var lng = $('#map').data('lng');

    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: lat, lng: lng},
        zoom: 14
    });

    //infowindow = new google.maps.InfoWindow();

    marker = new google.maps.Marker({
        position: {lat: lat, lng: lng},
        map: map
    });
    
    //console.log(marker);
}


//$(function () {
//
//    function initMap() {
//
//        var location = new google.maps.LatLng(51.008722, 26.750944);
//        var mapCanvas = document.getElementById('map');
//        var mapOptions = {
//            center: location,
//            zoom: 8,
//            panControl: false,
//            mapTypeId: google.maps.MapTypeId.ROADMAP
//        }
//        var map = new google.maps.Map(mapCanvas, mapOptions);
//
//        var infowindow = new google.maps.InfoWindow();
//
//        var marker = new google.maps.Marker({
//            map: map
//        });
//
//    }
//
//    google.maps.event.addDomListener(window, 'load', initMap);
//});