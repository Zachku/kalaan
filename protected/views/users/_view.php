<?php
/* @var $this UsersController */
/* @var $data Users */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_id), array('view', 'id'=>$data->user_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('profile_image_url')); ?>:</b>
	<?php echo CHtml::encode($data->profile_image_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('motto')); ?>:</b>
	<?php echo CHtml::encode($data->motto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('register_date')); ?>:</b>
	<?php echo CHtml::encode($data->register_date); ?>
	<br />


</div>