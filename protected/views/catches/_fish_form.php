<h2>Fish</h2>
<p> <?php
    if ($catch->fish_id != null)
        echo "Fish: " . $fish->name;
    else
        echo 'There is no fish selected yet.';
    ?> 
</p>

<p> <?php echo CHtml::link('Update fish', '', array('id' => 'SelectFishLink')); ?> </p>
<div id ="SelectFish">
    <div class="form">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'enableAjaxValidation' => true,
            'id' => 'fish_form'
        ));
        ?>


        <?php if (isset($fishMessage)) { ?> 
            <div class ="successMessage">
                <?php echo $fishMessage; ?> 
            </div>
        <?php } ?> 

        <div class = 'row'>
            <?php echo $form->labelEx($fish, 'name'); ?>
            <?php echo CHtml::activeDropDownList($fish, 'fish_id', $fishes_list);?>
            <?php echo $form->error($fish, 'name'); ?>
        </div>

        <div class="row buttons">
            <?php
            echo CHtml::ajaxSubmitButton("Post", array('catches/add_fish', 'id' => $catch->catch_id), array('update' => '#fishEdit'), array('id' => 'fishSubmit'));
            ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>
