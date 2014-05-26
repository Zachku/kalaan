
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/view.js', CClientScript::POS_END); ?>

<h2>View as a quest <?php echo CHtml::link('here', array('catches/viewasaquest', 'id' => $catch->catch_id));?></h2>
<?php if ($catch->image_url === null) { ?>
    <h2>Add Image of your catch</h2>
    <?php echo CHtml::form('add_image', 'post', array('enctype' => 'multipart/form-data')); ?> 
    <div class='row'> <?php echo CHtml::activeFileField($catch, 'image'); ?> </div>
    <?php echo CHtml::activeHiddenField($catch, 'user_id', array('value' => $catch->user_id)) ?>
    <?php echo CHtml::activeHiddenField($catch, 'catch_id', array('value' => $catch->catch_id)) ?>
    <div class='row'> <?php echo CHtml::submitButton('Submit'); ?> </div>
    <?php echo CHtml::endForm(); ?>
<?php } else { ?>
    <div id="catch_image"><?php echo CHtml::image(Yii::app()->request->baseUrl . '/' . 'images' . '/' . 'catch_images' . '/' . $catch->image_url); ?></div>
    <p> Delete this image <?php
        echo CHtml::link("here", '#', array(
            'submit' => array('catches/delete_image'),
            'params' => array('catch_id' => $catch->catch_id), 'confirm' => 'Are you sure you want to delete this image?'))
        ?> </p>
<?php } ?>


<?php
/*
 * Lures
 * see _lure_form
 */
?>
<div id ="fish">
    <?php $this->renderPartial('_fish_form', array('fish' => $fish, 'catch' => $catch)); ?>
</div>

<?php
/*
 * Lures
 * see _lure_form
 */
?>
<div id ="lure">
    <?php $this->renderPartial('_lure_form', array('lure' => $lure, 'catch' => $catch)); ?>
</div>

<?php
/*
 * Lakes
 * see _lake_form
 */
?>
<div id ="lake">
    <?php $this->renderPartial('_lake_form', array('lake' => $lake, 'catch' => $catch)); ?>
</div>

<?php
/*
 * Render Goole maps via _location view
 */
?>
<div id='location'>
    <?php $this->renderPartial('_location', array('catch' => $catch, 'message' => $message)); ?>
</div>


<?php
/*
 * Date
 */
?>
<div id="date">
    <?php $this->renderPartial('_date', array('catch' => $catch)); ?>
</div>
<?php
/*
 * Delete catch
 */
?>
<p>
    <?php
    echo CHtml::link("Delete this catch", '#', array(
        'submit' => array('catches/delete'),
        'params' => array('catch_id' => $catch->catch_id), 'confirm' => 'Are you sure you want to delete this catch?'))
    ?> 
</p>

