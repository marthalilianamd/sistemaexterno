<div class="gremios form">
<?php echo $this->Form->create('Gremio'); ?>
	<fieldset>
		<legend><?php echo __('Crear Gremio'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('fecha_creacion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Crear')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar Gremios'), array('controller' => 'gremios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Gremio'), array('controller' => 'gremios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Mensajes'), array('controller' => 'mensajes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Mensaje'), array('controller' => 'mensajes', 'action' => 'add')); ?> </li>
	</ul>
</div>
