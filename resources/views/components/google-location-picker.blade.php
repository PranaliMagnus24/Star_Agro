<div>
    <input type="text" id="address-input" class="form-control" placeholder="Enter Location" value="{{ $address }}">
    <input type="hidden" name="{{ $fieldName }}[latitude]" id="latitude" value="{{ $latitude }}">
    <input type="hidden" name="{{ $fieldName }}[longitude]" id="longitude" value="{{ $longitude }}">

    <div id="map" style="height: 300px; margin-top: 10px;"></div>
</div>

<script>
    function initMap() {
        let lat = parseFloat("{{ $latitude ?? 28.7041 }}");
        let lng = parseFloat("{{ $longitude ?? 77.1025 }}");

        if (isNaN(lat) || isNaN(lng)) {
            lat = 28.7041;
            lng = 77.1025;
        }

        let map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: lat, lng: lng },
            zoom: 13,
        });

        let marker = new google.maps.Marker({
            position: { lat: lat, lng: lng },
            map: map,
            draggable: true,
        });

        let input = document.getElementById("address-input");
        let autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo("bounds", map);

        autocomplete.addListener("place_changed", function () {
            let place = autocomplete.getPlace();
            if (!place.geometry) return;

            let location = place.geometry.location;
            document.getElementById("latitude").value = location.lat();
            document.getElementById("longitude").value = location.lng();
            marker.setPosition(location);
            map.setCenter(location);
        });

        google.maps.event.addListener(marker, "dragend", function () {
            let position = marker.getPosition();
            document.getElementById("latitude").value = position.lat();
            document.getElementById("longitude").value = position.lng();
        });
    }
</script>


<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap"></script>

