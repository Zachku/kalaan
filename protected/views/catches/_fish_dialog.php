
<?php
echo CHtml::link('open dialog', '#', array(
    'onclick' => '$("#fishdialog").dialog("open"); return false;',
));

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'fishdialog',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Fish',
        'autoOpen' => TRUE,
    ),
));
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'enableAjaxValidation' => true,
    'id' => 'fish_form'
        ));
?>

<div class = 'row'>
<?php echo $form->labelEx($fish, 'name'); ?>
    <?php echo CHtml::activeDropDownList($fish, 'fish_id', $fishes_list); ?>
    <?php echo $form->error($fish, 'name'); ?>
</div>

<div class = 'row'>
<?php echo $form->labelEx($catch, 'weight'); ?>
    <?php echo CHtml::activeNumberField($catch, 'weight'); ?>
    <?php echo $form->error($catch, 'weight'); ?>
</div>

<div class="row buttons">
<?php
echo CHtml::ajaxSubmitButton("Save", 
        array('catches/add_fish', 'id' => $catch->catch_id), 
        array('success'=>'function(){$("#fishdialog").dialog("close");location.reload();}', 'update' => '#',  ), 
        array('id' => 'fishSubmit'));
?>
</div>

<?php $this->endWidget(); ?>
<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>