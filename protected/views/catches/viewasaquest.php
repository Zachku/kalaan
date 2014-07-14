<?php if ($catch->date != NULL && $catch->date != NULL)  ?>
<h2>User's <?php echo $owner->username; ?> catch  <?php if ($catch->date != NULL) echo ' of ' . date('j.m.Y', strtotime($catch->date)) ?>: </h2> 
<h1> <?php
    if ($fish != NULL) {
        echo $fish->name;
    }
    if ($catch->weight != null) {
        echo ", " . $catch->weight . ' kg';
    }
    ?>
</h1>

<?php
/*
 * Fish
 */
?>
<div id="imageonqview">
    <h2>Image</h2>
    <?php if ($catch->image_url === null) { ?>
        <p>No image yet.</p>
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
    <h2>Map</h2>
    <?php
    /*
     * Yii Google maps extension
     * http://www.yiiframework.com/extension/egmap/
     */
    Yii::import('application.extensions.EGMap.*');
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
    if (isset($lake)) {
        echo $lake->lake_name . ", " . $lake->town;
    }
    ?>

</div>


<?php $this->beginWidget('CHtmlPurifier'); ?>
<?php
/*
 * Lure
 */
?>
<div id ="lureonqview"></div>
<h2>Lure</h2>
<p> <?php
    if ($catch->lure_id) {
        echo "<p>Brand: " . $lure->brand . "</p>";
        echo "<p>Model: " . $lure->model . '</p>';
        echo "<p>Url: " . $lure->url . '</p>';
    } else {
        echo 'There is no lure selected yet.';
    }
    ?> 
</p>
<?php
/*
 * Lake
 */
?>
<div id ="Lakeonqview">
    <h2>Lake</h2>
    <p> <?php
        if ($catch->lake_id != null) {
            echo "<p>Town: " . $lake->town . "</p>";
            echo "<p>Lake: " . $lake->lake_name . '</p>';
        } else {
            echo 'There is no lake selected yet.';
        }
        ?> 
    </p>
</div>
<?php $this->endWidget(); ?>