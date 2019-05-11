<div class="mensajes form">
<?php echo $this->Form->create('Mensaje'); ?>
	<fieldset>
		<legend><?php echo __('Editar Mensaje'); ?></legend>
	<?php
		echo $this->Form->input('mensaje_id');
		echo $this->Form->input('usuario_id');
		echo $this->Form->input('titulo');
        echo $this->Form->input('mensaje');
        echo $this->Form->input('estado');
		echo $this->Form->input('fecha_creacion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Editar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Eliminar mensaje'), array('action' => 'delete', $this->Form->value('Mensaje.mensaje_id')),
                array('confirm' => __('Está seguro que desea eliminar este mensaje # %s?', $this->Form->value('Mensaje.mensaje_id')))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Mensajes'), array('controller' => 'mensajes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Mensaje'), array('controller' => 'mensajes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
