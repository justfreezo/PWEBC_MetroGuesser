$(document).ready(function () {
    $.ajax({
        url: 'https://data.iledefrance-mobilites.fr/api/explore/v2.1/catalog/datasets/emplacement-des-gares-idf-data-generalisee/exports/json?lang=fr&refine=mode%3A%22METRO%22&timezone=Europe%2FBerlin',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data && data.length > 0) {
                var metroStations = data.map(function (station) {
                    return {
                        geo_point_2d: {
                            lon: station.geo_point_2d.lon,
                            lat: station.geo_point_2d.lat
                        },
                        nom_long: station.nom_long
                    };
                });
                console.log('Stations:', metroStations);
            } else {
                console.error('Structure invalide ou vide.');
            }
        },
        error: function (error) {
            console.error('Erreur: ', error);
        }
    });
});