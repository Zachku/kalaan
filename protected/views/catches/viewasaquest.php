<?php if($catch->date != NULL && $catch->date != NULL) ?>
<h1>User's <?php echo $owner->username; ?> catch  <?php if($catch->date != NULL) echo ' of ' . $catch->date; ?>: <?php if($fish != NULL) echo $fish->name; ?> </h1>
<?php
/*
 * Fish
 */
?>
<div id="imageonqview">
    <?php if ($catch->image_url === null) { ?>
        <h2>No image yet.</h2>
    <?php } else { ?>
        <div id="catch_image"><?php echo CHtml::image(Yii::app()->request->baseUrl . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'catch_images' . DIRECTORY_SEPARATOR . $catch->image_url); ?></div>
    <?php } ?>
</div>

<?php
/*
 * Map
 */
?>
<div id="maponqview">
    <?php
    /*
     * Yii Google maps extension
     * http://www.yiiframework.com/extension/egmap/
     */
    Yii::import('ext.egmap.*');
    $gMap = new EGMap();
    $gMap->setWidth(400);
    $gMap->setHeight(300);
    $gMap->zoom = 6;
    $mapTypeControlOptions = array(
        'position' => EGMapControlPosition::RIGHT_TOP,
        'style' => EGMap::MAPTYPECONTROL_STYLE_HORIZONTAL_BAR
    );

    $gMap->mapTypeControlOptions = $mapTypeControlOptions;

// Preparing InfoWindow with information about our marker.
    $info_window_a = new EGMapInfoWindow("<div class='gmaps-label' style='color: #000;'>Catch</div>");

// If we have already created marker - show it
    if ($catch->coord_latitude && $catch->coord_longitude) {

        $marker = new EGMapMarker($catch->coord_latitude, $catch->coord_longitude, array('title' => 'Catch',
            'draggable' => false), 'marker');
        $marker->addHtmlInfoWindow($info_window_a);
        $gMap->addMarker($marker);
        $gMap->setCenter($catch->coord_latitude, $catch->coord_longitude);


// If we don't have marker in database - make sure user can create one
    }
    $gMap->renderMap(array(), Yii::app()->language);
    if(isset($lake)) {
        echo $lake->lake_name . ", " . $lake->town;
    }
    ?>

</div>


<?php
/*
 * Fish
 */
?>
<div id ="fishonqview"></div>

<?php
/*
 * Lure
 */
?>
<div id ="lureonqview"></div>

<?php
/*
 * Lake
 */
?>
<div id ="Lakeonqview"></div>
