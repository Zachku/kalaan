<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/view.js', CClientScript::POS_END); ?>
<div id='view_actions'>
    <?php
    /*
     * View catch as a quest
     */
    ?>
    <p> <?php echo CHtml::link('View this catch as a quest', array('catches/viewasaquest', 'id' => $catch->catch_id)); ?></p>

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
</div>



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
 * Render Goole maps via _location view
 */
?>
<div id='locationEdit'>
    <?php $this->renderPartial('_location', array('catch' => $catch, 'message' => $message)); ?>
</div>


<?php
/*
 * Date
 */
?>
<div id="dateEdit">
    <?php $this->renderPartial('_date', array('catch' => $catch)); ?>
</div>


<?php
/*
 * Lures
 * see _lure_form
 */
?>
<div id ="fishEdit">
    <?php $this->renderPartial('_fish_form', array('fish' => $fish, 'catch' => $catch, 'fishes_list' => $fishes_list)); ?>
</div>


<?php
/*
 * Lures
 * see _lure_form
 */
?>
<div id ="lureEdit">
    <?php $this->renderPartial('_lure_form', array('lure' => $lure, 'catch' => $catch)); ?>
</div>


<?php
/*
 * Lakes
 * see _lake_form
 */
?>
<div id ="lakeEdit">
    <?php $this->renderPartial('_lake_form', array('lake' => $lake, 'catch' => $catch)); ?>
</div>

<?php
/*
 * If there is no fis added, show fish dialog
 * see _lake_dialog
 */
?>
<div id ="lakeEdit">
    <?php
    if ($catch->fish_id == NULL) {
        $this->renderPartial('_fish_dialog', array('fish' => $fish, 'catch' => $catch, 'fishes_list' => $fishes_list));
    }
    ?>
</div>




