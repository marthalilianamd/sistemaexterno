<div class="usuarios form">
<?php echo $this->Form->create('Usuario'); ?>
	<fieldset>
		<legend><?php echo __('Crear Usuario'); ?></legend>
	<?php
		echo $this->Form->input('nombre',array('label' => 'Nombre'));
		echo $this->Form->input('email',array('label' => 'Email', 'type'=>'email'));
        echo $this->Form->input('contrasena',array('label' => 'Contraseña','type'=>'password'));
        echo $this->Form->input('movil_numero',array('label' => 'Móvil'));
        echo $this->Form->input('fcm_registro',array('label' => 'Token Móvil'));
        echo $this->Form->input('fecha_creacion', array('label' => 'Fecha Creación'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Crear')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Mensajes'), array('controller' => 'mensajes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Mensaje'), array('controller' => 'mensajes', 'action' => 'add')); ?> </li>
	</ul>
</div>

