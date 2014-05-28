<h2>Date</h2>
<?php echo CHtml::beginForm(); ?>   
<div class ="row">
    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name' => 'catch_date',
        'attribute' => $catch->date,
        'value' => $catch->date,
        'options' => array(
            'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
            'dateFormat'=>'dd-mm-yy',
        ),
        'htmlOptions' => array(
            'style' => ''
        ),
    ));
    ?>

</div>
<div class="row submit">
    <?php
    echo CHtml::ajaxSubmitButton('Save', array('catches/add_date', 'id' => $catch->catch_id),
        array('id' => 'dateSubmit',
            'type' => 'post',
            'name' => 'dateSubmit',
            'update' => '#dateEdit'), array('id' => 'dateSubmit'));
    ?>
</div>
<?php echo CHtml::endForm(); ?>