<h2>Lure</h2>
<p> <?php
    if ($catch->lure_id) {
        echo "<p>Brand: " . $lure->brand . "</p>";
        echo "<p>Model: " . $lure->model . '</p>';
    } else {
        echo 'There is no lure selected yet.';
    }
    ?> 
</p>
<p> <?php echo CHtml::link('Update lure', '', array('id' => 'SelectLureLink')); ?> </p>
<div id ="SelectLure">
    <div class="form">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'enableAjaxValidation' => TRUE,
            'id' => 'lure-form',
        ));
        ?>
        <?php if (isset($lureMessage)) { ?> 
            <div class ="successMessage">
                <?php echo $lureMessage; ?> 
            </div>
        <?php } ?> 


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
            <?php
            echo CHtml::ajaxSubmitButton("Save", array('catches/add_lure', 'id' => $catch->catch_id), array('update' => '#lureEdit'), array('id' => 'lureSubmit'));
            ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>