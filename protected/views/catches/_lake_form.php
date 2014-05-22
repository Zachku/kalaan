<h2>Lake</h2>
<p> <?php
    if ($catch->lake_id != null)
        echo "Town: " . $lake->town . " Lake: " . $lake->lake_name;
    else
        echo 'There is no lake selected yet.';
    ?> 
</p>

<p> <?php echo CHtml::link('Update lake', '', array('id' => 'SelectLakeLink')); ?> </p>
<div id ="SelectLake">
    <div class="form">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'enableAjaxValidation' => false,
        ));
        ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>


        <div class = 'row'>
            <?php echo $form->labelEx($lake, 'lake_name'); ?>
            <?php echo $form->textField($lake, 'lake_name'); ?>
            <?php echo $form->error($lake, 'lake_name'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($lake, 'town'); ?>
            <?php echo $form->textField($lake, 'town'); ?>
            <?php echo $form->error($lake, 'town'); ?>
        </div>

        <div class="row buttons">
            <?php
            echo CHtml::ajaxSubmitButton("Post", array('catches/add_lake', 'id' => $catch->catch_id), array('update' => '#lake'), array('id' => 'lakeSubmit'));
            ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>
