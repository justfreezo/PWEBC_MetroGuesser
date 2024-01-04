$(document).ready(function () {

    var map = L.map('map').setView([48.8566, 2.3522], 12);
    var stationsWithCoordinates = null;
    let lat = null;
    let lon = null;
    var stationName = null;
    var essai = false;
    var boutonSuiv = $('#boutonSuivant');

    var stationMarker = null;
    var clickedMarker = null;
    var polyline = null;

    boutonSuiv.css('display', 'none');

    // Use CartoDB Positron style tile layer
    L.tileLayer('https://tiles.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}@2x.png', {
        attribution: '',
        minZoom: 11,
        maxZoom: 18
    }).addTo(map);



    $.ajax({
        url: 'https://data.iledefrance-mobilites.fr/api/explore/v2.1/catalog/datasets/emplacement-des-gares-idf-data-generalisee/exports/json?lang=fr&refine=mode%3A%22METRO%22&timezone=Europe%2FBerlin',
        method: 'GET',
        dataType: 'json',
        success: function (data) {

            if (Array.isArray(data) && data.length > 0) {
                stationsWithCoordinates = data.filter(function (station) {
                    return station.geo_point_2d && typeof station.geo_point_2d.lat === 'number' && typeof station.geo_point_2d.lon === 'number';
                });

                if (stationsWithCoordinates.length > 0) {
                    newStation(stationsWithCoordinates);
                } else {
                    console.error('No stations with valid coordinates found.');
                }

            } else {
                console.error('Data is not in the expected format.');
            }
        },
        error: function (xhr, status, error) {
            console.error('Request failed. Status: ' + status + ', Error: ' + error);
        }
    });

    function newStation(data){
        if (clickedMarker) {
            map.removeLayer(clickedMarker);
            map.removeLayer(stationMarker);
            map.removeLayer(polyline);
        }
        var randomStation = getRandomStation(stationsWithCoordinates);

        lat = randomStation.geo_point_2d.lat;
        lon = randomStation.geo_point_2d.lon;
        stationName = randomStation.nom_long;

        $("#station_name").text(stationName);
    }

    function getRandomStation(data) {
        return data[Math.floor(Math.random() * data.length)];
    }


    map.on('click', function (e) {
        if(!essai){

            var clickedLatLng = e.latlng; // Coordonnées du clic

            // Coordonnées de la station aléatoire (lat, lon)
            var stationLatLng = L.latLng(lat, lon);

            // Calcul de la distance entre le clic et la station
            var distance = Math.round(clickedLatLng.distanceTo(stationLatLng));

            clickedMarker = L.marker(clickedLatLng).addTo(map);

            stationMarker = L.marker(stationLatLng).addTo(map);

            polyline = L.polyline([clickedLatLng, stationLatLng], {color: 'blue'}).addTo(map)
                .bindPopup(distance + " mètres")
                .openPopup();
        }
        essai = true;
        afficherBoutonSuivant();
    });

    function afficherBoutonSuivant() {
        boutonSuiv.css('display', 'block');

        boutonSuiv.on('click', function() {
            newStation();
            essai = false;
            boutonSuiv.css('display', 'none');
        });

    }
})

function stopGame(){
    window.location.href = 'home.php';
    // Sauvegarder le score
}