$(document).ready(function () {

    var map = L.map('map').setView([48.8566, 2.3522], 12);
    var stationsWithCoordinates = null;
    let lat = null;
    let lon = null;
    var stationName = null;
    var essai = false;
    var boutonSuiv = $('#boutonSuivant');
    var gameStartTime;
    var totalGameTime = 0;

    var stationMarker = null;
    var clickedMarker = null;
    var polyline = null;

    var stationsLimit = 5;
    var stationsGuessed = 0

    var totalScore = 0;

    boutonSuiv.css('display', 'none');

    L.tileLayer('https://tiles.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}@2x.png', {
        attribution: '',
        minZoom: 11,
        maxZoom: 18
    }).addTo(map);
    L.control.scale({
        metric: true,  // Display the scale in meters
        imperial: false  // Do not display the scale in miles
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

    gameStartTime = new Date();

    function newStation(){
        document.getElementById('totalRound').textContent = stationsGuessed + 1 + " sur 5";

        if (stationsGuessed >= stationsLimit) {
            alert("Merci d'avoir joué !");
            saveGame();
            return;
        }

        stationsGuessed += 1;

        if (clickedMarker) {
            map.removeLayer(clickedMarker);
            map.removeLayer(stationMarker);
            map.removeLayer(polyline);
        }

        resetMapView();
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

            stationMarker = L.marker(stationLatLng, { icon: customIcon('red') }).addTo(map);


            polyline = L.polyline([clickedLatLng, stationLatLng], { color: 'green'}).addTo(map)
                .bindPopup(distance + " mètres")
                .openPopup()

            updateScore(distance);
        }
        essai = true;
        afficherBoutonSuivant();
    });

    function customIcon(color) {
        return L.icon({
            iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-${color}.png`,
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            tooltipAnchor: [16, -28],
            shadowSize: [41, 41],
        });
    }

    function resetMapView() {
        map.setView([48.8566, 2.3522], 12);
    }

    function updateScore(distance) {
        var points = calculatePoints(distance);
        totalScore += points;

        document.getElementById('totalScore').textContent = totalScore;

        var percentageProgress = (totalScore / 10000) * 100;
        percentageProgress = Math.min(percentageProgress, 100);
        $('#progressBar').css('width', percentageProgress + '%');
    }

    function updateGameTime() {
        var currentTime = new Date();
        totalGameTime = Math.floor((currentTime - gameStartTime) / 1000);
    }

    function calculatePoints(distance) {
        var maxDist = 10000;
        return distance <= maxDist * 0.05 ? 2000 : distance >= maxDist ? 0 : Math.round(2000 - (distance / maxDist) * 2000);
    }

    function afficherBoutonSuivant() {
        boutonSuiv.css('display', 'block');

        boutonSuiv.off('click').on('click', function() {
            newStation();
            essai = false;
            boutonSuiv.css('display', 'none');
        });
    }

    function saveGame() {
        updateGameTime();

        $.ajax({
            type: 'POST',
            url: 'save_score.php',
            data: {
                uname: playerName,
                playerScore: totalScore,
                timePlayer : totalGameTime
            },
            success: function(response) {
                console.log('Score saved successfully:', response);
            },
            error: function(xhr, status, error) {
                console.error('Error saving score:', error);
            }
        });
        stopGame()
    }
})

function confirmLeave() {
    if (confirm("Voulez-vous quitter le jeu ? Vos points ne seront pas sauvegardés.")) {
        stopGame()
    }
}

function stopGame(){
    window.location.href = '../home.php';
}