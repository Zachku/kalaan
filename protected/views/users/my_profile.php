<h1>Welcome <?php echo $user->username; ?> to your profile</h1>
<p>Add new catch <?php echo CHtml::link('here', array('catches/create')); ?> </p>

<h2>Your catches</h2>
<?php $date = 0; ?>
<?php foreach($catches as $catch){ ?>
    <?php 
    if($date != $catch->date){
        echo'<h3>' . $catch->date . '</h3>';
    }
    $date = $catch->date;
            
    ?>
    <p><?php echo CHtml::link($catch->catch_id, array('catches/view', 'id' => $catch->catch_id)); ?></p>
<?php } ?>


