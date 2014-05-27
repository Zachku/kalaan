<div id="mapOnIndex">
    <?php
    /*
     * Yii Google maps extension
     * http://www.yiiframework.com/extension/egmap/
     */
    Yii::import('ext.egmap.*');
    $gMap = new EGMap();
    $gMap->setWidth(900);
    $gMap->setHeight(400);
    $gMap->zoom = 4;
    $mapTypeControlOptions = array(
        'position' => EGMapControlPosition::RIGHT_TOP,
        'style' => EGMap::MAPTYPECONTROL_STYLE_HORIZONTAL_BAR
    );

    $gMap->mapTypeControlOptions = $mapTypeControlOptions;

// Preparing InfoWindow with information about our marker.
    $info_window_a = new EGMapInfoWindow("<div class='gmaps-label' style='color: #000;'>Catch</div>");

// If we have already created marker - show it

    $markers = array();
    foreach ($catches as $catch) {
        if ($catch->coord_latitude && $catch->coord_latitude) {
            $marker = new EGMapMarker($catch->coord_latitude, $catch->coord_longitude, array('title' => $catch->user_id));
            
            $info_box = new EGMapInfoBox('<div style="color:#000; background: #fff; padding: 2px;"><a href="' . $this->createUrl('catches/viewasaquest', array('id' => $catch->catch_id)) . '"> View this catch </a></div>');
            
            $marker->addHtmlInfoBox($info_box);
            
            $gMap->addMarker($marker);
            
        }
    }
    foreach ($markers as $marker) {
        $gMap->addMarker($marker);
    }/*
      $marker = new EGMapMarker($catch->coord_latitude, $catch->coord_longitude, array('title' => 'Catch','draggable' => false), 'marker');
      $marker->addHtmlInfoWindow($info_window_a);
      $gMap->addMarker($marker);
      $gMap->setCenter($catch->coord_latitude, $catch->coord_longitude); */

    $gMap->setCenter(62.300741, 27.140715);

// If we don't have marker in database - make sure user can create one

    $gMap->renderMap(array(), Yii::app()->language);
    ?>
</div>