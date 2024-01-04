$(document).ready(function () {

    var map = L.map('map').setView([48.8566, 2.3522], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18
    }).addTo(map);



    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    $.ajax({
        url: 'https://data.iledefrance-mobilites.fr/api/explore/v2.1/catalog/datasets/emplacement-des-gares-idf-data-generalisee/exports/json?lang=fr&refine=mode%3A%22METRO%22&timezone=Europe%2FBerlin',
        method: 'GET',
        dataType: 'json',
        success: function(data) {

            if (Array.isArray(data) && data.length > 0) {
                var stationsWithCoordinates = data.filter(function (station) {
                    return station.geo_point_2d && typeof station.geo_point_2d.lat === 'number' && typeof station.geo_point_2d.lon === 'number';
                });

                if (stationsWithCoordinates.length > 0) {

                    var randomStation = getRandomStation(stationsWithCoordinates);
                    console.log("Station aleatoire :" + randomStation);

                    var lat = randomStation.geo_point_2d.lat;
                    var lon = randomStation.geo_point_2d.lon;
                    var stationName = randomStation.nom_long;

                    L.marker([lat, lon]).addTo(map)
                        .bindPopup(stationName)
                        .openPopup();

                    $("#station_name").text(stationName);
                } else {
                    console.error('No stations with valid coordinates found.');
                }

                $.each(data, function (index, station) {

                    var geoPoint = station.geo_point_2d;
                    var resCom = station.res_com;
                    var nomLong = station.nom_long;

                    console.log('Station ' + (index + 1) + ':');
                    console.log('Geo Point:', geoPoint);
                    console.log('Res Com:', resCom);
                    console.log('Nom Long:', nomLong);
                });
            } else {
                console.error('Data is not in the expected format.');
            }
        },
        error: function (xhr, status, error) {
            console.error('Request failed. Status: ' + status + ', Error: ' + error);
        }
    });
    function getRandomStation(data) {
        return data[Math.floor(Math.random() * data.length)];
    }
});
