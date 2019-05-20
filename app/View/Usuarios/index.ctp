<div class="usuarios index">
	<h2><?php echo __('Usuarios'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('usuario_id'); ?></th>
			<th><?php echo $this->Paginator->sort('Nombre'); ?></th>
			<th><?php echo $this->Paginator->sort('Email'); ?></th>
            <th><?php echo $this->Paginator->sort('Contraseña'); ?></th>
			<th><?php echo $this->Paginator->sort('Móvil'); ?></th>
            <th><?php echo $this->Paginator->sort('Token móvil'); ?></th>
            <th><?php echo $this->Paginator->sort('Fecha Creación'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($usuarios as $usuario): ?>
	<tr>
		<td>
        <?php echo $this->Html->link($usuario['Usuario']['nombre'],
            array('controller' => 'usuarios', 'action' => 'view', $usuario['Usuario']['usuario_id'])); ?>
		</td>
		<td><?php echo h($usuario['Usuario']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($usuario['Usuario']['email']); ?>&nbsp;</td>
        <td><?php echo h($usuario['Usuario']['contrasena']); ?>&nbsp;</td>
		<td><?php echo h($usuario['Usuario']['movil_numero']); ?>&nbsp;</td>
        <td><?php echo h($usuario['Usuario']['fcm_registro']); ?>&nbsp;</td>
        <td><?php echo h($usuario['Usuario']['fecha_creacion']); ?>&nbsp;</td>


		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $usuario['Usuario']['usuario_id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $usuario['Usuario']['usuario_id'])); ?>
			<?php echo $this->Form->postLink(__('Elimnar'), array('action' => 'delete', $usuario['Usuario']['usuario_id']), array('confirm' => __('Estás seguro de eliminar el # %s?', $usuario['Usuario']['usuario_id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Listar Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Mensajes'), array('controller' => 'mensajes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Mensaje'), array( 'controller' => 'mensajes', 'action' => 'add')); ?> </li>

	</ul>
</div>

