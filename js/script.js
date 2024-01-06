$(document).ready(function () {
    function afficherInscription() {
        document.getElementById("inscriptionForm").style.display = "block";
        document.getElementById("connexionForm").style.display = "none";
    }

    function cacherInscription() {
        document.getElementById("inscriptionForm").style.display = "none";
        document.getElementById("connexionForm").style.display = "block";
    }
})

function startGame(){
    window.location.href = 'game/map.php';
}

function showRanking() {
    window.location.href = 'leaderboard.php';
}