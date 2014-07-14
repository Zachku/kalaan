<h1>Welcome <?php echo $user->username; ?> to your profile</h1>
<p>Add new catch <?php echo CHtml::link('here', array('catches/create')); ?> </p>

<h2>Your catches ordered by date</h2>
<?php $date = 0; ?>
<?php foreach ($catches as $catch) { ?>
    <?php
    if ($date != $catch->date) {

        echo'<h3>' . date('j.m.Y', strtotime($catch->date)) . '</h3>';
    }

    $date = $catch->date;
    ?>
    <?php if (isset($catch->fish->name)) { ?>
        <p><?php echo CHtml::link($catch->fish->name, array('catches/view', 'id' => $catch->catch_id)); //Näytetään nimi, jos sellainen on?></p>
    <?php } else { ?>
        <p><?php echo CHtml::link($catch->catch_id, array('catches/view', 'id' => $catch->catch_id)); // Muussa tapauksessa näytetään id  ?></p>
    <?php } ?>

    <?php if ($catch->image_url != NULL) { ?>
        <div id="catch_image"><?php echo CHtml::image(Catches::model()->getImagesBaseUrltoView() . $catch->image_url); ?></div>
    <?php } ?>    
<?php } ?>
    

