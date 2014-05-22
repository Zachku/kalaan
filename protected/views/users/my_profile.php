<p>Welcome <?php echo $user->username; ?> to your profile</p>
<p>Add new catch <?php echo CHtml::link('here', array('catches/create')); ?> </p>

<h3>Your catches</h3>
<?php foreach($catches as $catch){ ?>
    <?php echo CHtml::link($catch->catch_id, array('catches/view', 'id' => $catch->catch_id)); ?>
<?php } ?>


