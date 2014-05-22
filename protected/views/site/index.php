<?php
Yii::import('ext.egmap.*');
 
$gMap = new EGMap();
$gMap->setJsName('test_map');
$gMap->width = '100%';
$gMap->height = 300;
$gMap->zoom = 4;
$gMap->setCenter(62.300741,27.140715);
 
 
$circle = new EGMapCircle(new EGMapCoord(34.04924594193164, -118.24104309082031));
$circle->radius = 300000;
$circle->addHtmlInfoWindow(new EGMapInfoWindow('Hey! I am a circle!'));
$gMap->addCircle($circle);
 
$gMap->renderMap();
?>