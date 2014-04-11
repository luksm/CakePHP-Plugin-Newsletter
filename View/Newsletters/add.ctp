<div class="newsletters form">
<?php echo $this->Form->create('Newsletter'); ?>
	<fieldset>
		<legend><?php echo __('Add Newsletter'); ?></legend>
	<?php
		echo $this->Form->input('nome');
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Newsletters'), array('action' => 'index')); ?></li>
	</ul>
</div>
