var map, infoWindow;
function initMap() {
    var centerLatLng = new google.maps.LatLng(markersData[0].lat, markersData[0].lng);
    var mapOptions = {
        center: centerLatLng,
        zoom: 8
    };
    map = new google.maps.Map(document.getElementById("departments-map"), mapOptions);

    infoWindow = new google.maps.InfoWindow();

    google.maps.event.addListener(map, "click", function() {
        infoWindow.close();
    });

    var bounds = new google.maps.LatLngBounds();
    for (var i = 0; i < markersData.length; i++) {
        var latLng = new google.maps.LatLng(markersData[i].lat, markersData[i].lng);
        var name = markersData[i].name;
        var address = markersData[i].address;
        var phone = markersData[i].phone;

        var iconBase = 'http://maps.google.com/mapfiles/kml/pal3/';
        var icons = {
            agpfm: iconBase + 'icon21.png',
            fop: iconBase + 'icon31.png'
        };
        var icon;

        switch(Number(markersData[i].department_type)) {
            case 1:
                icon = icons.agpfm;
                break;
            case 2:
                icon = icons.fop;
                break;
        }

        addMarker(latLng, icon, name, address, phone);
        bounds.extend(latLng);
    }
    map.fitBounds(bounds);
}

function addMarker(latLng, icon, name, address, phone) {
    var marker = new google.maps.Marker({
        position: latLng,
        icon: icon,
        map: map,
        title: name
    });


    google.maps.event.addListener(marker, "click", function() {
        var contentString = '<div class="infowindow">' +
                                '<h3>' + name + '</h3>' +
                                '<p>' + address + '</p>' +
                                '<p>' + phone + '</p>' +
                            '</div>';
        infoWindow.setContent(contentString);
        infoWindow.open(map, marker);
    });
}