<div class="gremios form">
<?php echo $this->Form->create('Gremio'); ?>
	<fieldset>
		<legend><?php echo __('Editar Gremio'); ?></legend>
	<?php
		echo $this->Form->input('gremio_id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('fecha_creacion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Gremio.gremio_id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Gremio.gremio_id')))); ?></li>

		<li><?php echo $this->Html->link(__('Listar Gremios'), array('controller' => 'gremios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Gremio'), array('controller' => 'gremios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Mensajes'), array('controller' => 'mensajes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Mensaje'), array('controller' => 'mensajes', 'action' => 'add')); ?> </li>
	</ul>
</div>
