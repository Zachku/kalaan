<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => array('lures/create'),
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>


    <div class = 'row'>
        <?php echo $form->labelEx($lure, 'brand'); ?>
        <?php echo $form->textField($lure, 'brand'); ?>
        <?php echo $form->error($lure, 'brand'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($lure, 'model'); ?>
        <?php echo $form->textField($lure, 'model'); ?>
        <?php echo $form->error($lure, 'model'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($lure, 'weight'); ?>
        <?php echo $form->textField($lure, 'weight'); ?>
        <?php echo $form->error($lure, 'weight'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($lure, 'url'); ?>
        <?php echo $form->textField($lure, 'url'); ?>
        <?php echo $form->error($lure, 'url'); ?>
    </div>  

    <div class="row">
        <?php echo $form->labelEx($lure, 'color'); ?>
        <?php echo $form->textField($lure, 'color'); ?>
        <?php echo $form->error($lure, 'color'); ?>
    </div>  

    <div class="row buttons">
        <?php echo CHtml::submitButton($lure->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
</div>


<?php $this->endWidget(); ?>

</div><!-- form -->