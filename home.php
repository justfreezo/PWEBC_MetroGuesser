<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Accueil</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
     <h1>Salut, <?php echo $_SESSION['user_name']; ?></h1>
     <a href="authentification/logout.php">Déconnexion</a>

    <script>
        $.ajax({
            url: 'https://data.iledefrance-mobilites.fr/api/explore/v2.1/catalog/datasets/emplacement-des-gares-idf-data-generalisee/exports/json?lang=fr&refine=mode%3A%22METRO%22&timezone=Europe%2FBerlin',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Check if data is an array and is not empty
                if (Array.isArray(data) && data.length > 0) {
                    // Iterate through each station
                    $.each(data, function(index, station) {
                        // Extract specific fields from each station
                        var geoPoint = station.geo_point_2d;
                        var resCom = station.res_com;
                        var nomLong = station.nom_long;


                        // Do something with the extracted fields (e.g., log to console)
                        console.log('Station ' + (index + 1) + ':');
                        console.log('Geo Point:', geoPoint);
                        console.log('Res Com:', resCom);
                        console.log('Nom Long:', nomLong);
                    });
                } else {
                    console.error('Data is not in the expected format.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Request failed. Status: ' + status + ', Error: ' + error);
            }
        });
    </script>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>