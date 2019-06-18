
<div class="mensajes form">
<?php echo $this->Form->create('Mensaje'); ?>
	<fieldset>
		<legend><?php echo __('Enviar Mensaje'); ?></legend>
	<?php
		echo $this->Form->input('usuario_id',array('label' => 'De:'));
        echo $this->Form->input('usuarios.usuario_id', array('label' => 'Para:', 'value'=>'usuarios.usuario_id'));
		echo $this->Form->input('titulo',array('label' => 'Asunto: ','type' => 'text'));
        echo $this->Form->input('mensaje',array('label' => 'Contenido del mensaje:', 'type' => 'textarea'));
	?>
    <?php echo $this->Form->end(__('Enviar'));?>
	</fieldset>


</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar Mensajes'), array('controller' => 'mensajes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Mensaje'), array('controller' => 'mensajes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
