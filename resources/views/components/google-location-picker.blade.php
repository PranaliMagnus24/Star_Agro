

<script>
    function initMap_{{ $fieldName }}() {
        let lat = parseFloat("{{ $latitude ?? 28.7041 }}");
        let lng = parseFloat("{{ $longitude ?? 77.1025 }}");

        if (isNaN(lat) || isNaN(lng)) {
            lat = 28.7041;
            lng = 77.1025;
        }

        const map = new google.maps.Map(document.getElementById("map-{{ $fieldName }}"), {
            center: { lat: lat, lng: lng },
            zoom: 13,
        });

        const marker = new google.maps.Marker({
            position: { lat: lat, lng: lng },
            map: map,
            draggable: true,
        });

        const input = document.getElementById("address-input-{{ $fieldName }}");
        const autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo("bounds", map);

        autocomplete.addListener("place_changed", function () {
            const place = autocomplete.getPlace();
            if (!place.geometry) return;

            const location = place.geometry.location;
            document.getElementById("latitude-{{ $fieldName }}").value = location.lat();
            document.getElementById("longitude-{{ $fieldName }}").value = location.lng();
            marker.setPosition(location);
            map.setCenter(location);
        });

        marker.addListener("dragend", function () {
            const position = marker.getPosition();
            document.getElementById("latitude-{{ $fieldName }}").value = position.lat();
            document.getElementById("longitude-{{ $fieldName }}").value = position.lng();
        });
    }

    // Register to global initMap if not already
    if (!window.initMapCallbacks) window.initMapCallbacks = [];
    window.initMapCallbacks.push(initMap_{{ $fieldName }});
</script> 


