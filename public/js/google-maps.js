var map;
var markers= [];

function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -29.85868039999999, lng: 31.021840399999974},
      zoom: 13
    });
    var input = document.getElementById('searchMapInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
   
    var infowindow = new google.maps.InfoWindow();

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
  
    var marker = new google.maps.Marker({
        map: map,
        animation: google.maps.Animation.DROP,
        anchorPoint: new google.maps.Point(0, -29)
    });
  
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
    
        /* If the place has a geometry, then present it on a map. */
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
        markers.push(marker);

        var address = '';
        if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }
      
        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
        
        /* Location details */
        document.getElementById('location_description').value = place.formatted_address;
        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value = place.geometry.location.lng();
    });
    
    map.addListener('click', function(e) {
          placeMarkerAndPanTo(e.latLng, map);
    });
}

function placeMarkerAndPanTo(latLng, map) {
        /* Clear Markers on map first before placing a new one */
        clearMarkers();

        var infowindow = new google.maps.InfoWindow();
        
        var marker = new google.maps.Marker({
          position: latLng,
          animation: google.maps.Animation.DROP,
          map: map
        });
        var latitude = marker.position.lat();
        var longitute = marker.position.lng();

        /*save this marker for for now*/ 
        markers.push(marker);

        infowindow.setContent('<div><strong> Latitude: </strong>'+ latitude + '<br><strong>Longitude:</strong> ' + longitute);
        infowindow.open(map, marker);


        document.getElementById('location_description').value = '';
        document.getElementById('latitude').value = latitude;
        document.getElementById('longitude').value = longitute;

        map.panTo(latLng);
}

function clearMarkers(){
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
      }
}