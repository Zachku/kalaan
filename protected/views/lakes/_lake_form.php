<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => array('lakes/create'),
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>


    <div class = 'row'>
        <?php echo $form->labelEx($lake, 'town'); ?>
        <?php echo $form->textField($lake, 'town'); ?>
        <?php echo $form->error($lake, 'town'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($lake, 'lake_name'); ?>
        <?php echo $form->textField($lake, 'lake_name'); ?>
        <?php echo $form->error($lake, 'lake_name'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($lake->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
</div>


<?php $this->endWidget(); ?>

</div><!-- form -->