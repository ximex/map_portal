<?php

require_once('classes/DBMap.php');
require_once('classes/DBLayers.php');

$dbMap = new DBMap();
$map = $dbMap->getMapById($_GET['mapid']);
$dbMap->incrementRequests($_GET['mapid']);
$dbMap = null;

$dbLayers = new DBLayers();
$layers = $dbLayers->getLayersByMapId($_GET['mapid']);
$dbLayers = null;

if ($map['active']) {

?>
    <h1><?= $map['name'] ?></h1>
    <h3><?= $map['username'] ?> am <?= $map['build'] ?></h3>
    <p><?= $map['description'] ?></p>
    <div id="map" style="height: 400px"></div>
    <p><?= $map['requests'] ?> Aufrufe</p>
    <script>
        window.onload = function () {
            var map = new L.Map(
                'map',
                {
                    minZoom: 0,
                    maxZoom: 18,
                    center: new L.LatLng(0, 0),
                    zoom: 8
                }
            );

            var layersControl = new L.Control.Layers();
            layersControl.addTo(map);

            <?php foreach ($layers as $layer) { ?>
            layersControl.addOverlay(new L.TileLayer.WMS(
                '<?= $layer['url'] ?>',
                {
                    version: '<?= $layer['version'] ?>',
                    layers: '<?= $layer['layers'] ?>',
                    format: '<?= $layer['format'] ?>',
                    transparent: true
                }
                ).addTo(map),
            '<?= $layer['name'] ?>'
            );
            <?php } ?>
        };
    </script>
<?php

} else {
    require_once('pages/failure.php');
}

?>