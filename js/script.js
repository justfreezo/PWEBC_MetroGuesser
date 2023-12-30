document.addEventListener("DOMContentLoaded", init);

function init(){
    var map = L.map('map', {
        center: [48.85341, 2.3488],
        zoom: 11,
        minZoom: 11,
        maxZoom: 18
    });
    map.setView([48.85341, 2.3488]);


    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    }).addTo(map);
}