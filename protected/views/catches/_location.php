<h2>Set the catch on map</h2>
<?php
/*
 * Yii Google maps extension
 * http://www.yiiframework.com/extension/egmap/
 */
Yii::import('ext.egmap.*');
$gMap = new EGMap();
$gMap->setWidth(900);
$gMap->setHeight(300);
$gMap->zoom = 6;
$mapTypeControlOptions = array(
    'position' => EGMapControlPosition::RIGHT_TOP,
    'style' => EGMap::MAPTYPECONTROL_STYLE_HORIZONTAL_BAR
);

$gMap->mapTypeControlOptions = $mapTypeControlOptions;

// Preparing InfoWindow with information about our marker.
$info_window_a = new EGMapInfoWindow("<div class='gmaps-label' style='color: #000;'>Hi! I'm your marker!</div>");

// Setting up an icon for marker.
$icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/car.png");

$icon->setSize(32, 37);
$icon->setAnchor(16, 16.5);
$icon->setOrigin(0, 0);

// Saving coordinates after user dragged our marker.
$dragevent = new EGMapEvent('dragend', "function (event) { 
                                            alert('Location saved');
                                            $.ajax({
                                            'type':'POST',
                                            'url':'" . $this->createUrl('catches/add_coords', array('id' => $catch->catch_id)) . "',
                                            'data':({'lat': event.latLng.lat(), 'lng': event.latLng.lng()}),
                                            'cache':false,
                                        });}", false, EGMapEvent::TYPE_EVENT_DEFAULT);



// If we have already created marker - show it
if ($catch->coord_latitude && $catch->coord_longitude) {

    $marker = new EGMapMarker($catch->coord_latitude, $catch->coord_longitude, array('title' => 'something',
        'draggable' => true), 'marker', array('dragevent' => $dragevent));
    $marker->addHtmlInfoWindow($info_window_a);
    $gMap->addMarker($marker);
    $gMap->setCenter($catch->coord_latitude, $catch->coord_longitude);


// If we don't have marker in database - make sure user can create one
} else {
    $gMap->setCenter(64.406878, 26.682490);

    // Setting up new event for user click on map, so marker will be created on place and respectful event added.
    $gMap->addEvent(new EGMapEvent('click', 'function (event) {var marker = new google.maps.Marker({position: event.latLng, map: ' . $gMap->getJsName() .
            ', draggable: true}); ' . $gMap->getJsName() .
            '.setCenter(event.latLng); var dragevent = ' . $dragevent->toJs('marker') .
            'alert("Location saved");' .
                '; $.ajax({' .
                '"type":"POST",' .
                '"url":"' . $this->createUrl('catches/add_coords', array('id' => $catch->catch_id)) . '",' .
                '"data":({"lat": event.latLng.lat(), "lng": event.latLng.lng()}),' .
                '"cache":false,' .
            '}); }', false, EGMapEvent::TYPE_EVENT_DEFAULT_ONCE));
}
$gMap->renderMap(array(), Yii::app()->language);
?>
<?php if ($message != NULL) echo '<h2>' . $message . '</h2>'; ?>
<?php Yii::app()->createUrl('catches/add_coords'); ?>

<?php /*
  <div id ="coords">
  <h2>Coordinates</h2>
  <div class="form">

  <?php
  $form = $this->beginWidget('CActiveForm', array(
  'action' => array('catches/add_coords', 'id' => $catch->catch_id),
  'enableAjaxValidation' => false,
  ));
  ?>

  <div class = 'row'>
  <?php echo $form->labelEx($catch, 'coord_latitude'); ?>
  <?php echo $form->textField($catch, 'coord_latitude'); ?>
  <?php echo $form->error($catch, 'coord_latitude'); ?>
  </div>

  <div class="row">
  <?php echo $form->labelEx($catch, 'coord_longitude'); ?>
  <?php echo $form->textField($catch, 'coord_longitude'); ?>
  <?php echo $form->error($catch, 'coord_longitude'); ?>
  </div>

  <div class="row buttons">
  <?php echo CHtml::submitButton($catch->isNewRecord ? 'Create' : 'Save'); ?>
  </div>

  <?php $this->endWidget(); ?>
  </div>
  </div>
 */
?>