<div class="usuarios view">
<h2><?php echo __('Usuario'); ?></h2>
	<dl>
		<dt><?php echo __('Usuario'); ?></dt>
		<dd>
			<?php echo $this->Html->link($usuario['Usuario']['nombre'], array('controller' => 'usuarios', 'action' => 'view', $usuario['Usuario']['usuario_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['email']); ?>
			&nbsp;
		</dd>
        <dt><?php echo __('Contaseña'); ?></dt>
        <dd>
            <?php echo h($usuario['Usuario']['contrasena']); ?>
            &nbsp;
        </dd>
		<dt><?php echo __('Móvil'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['movil_numero']); ?>
			&nbsp;
		</dd>
        <dt><?php echo __('Registro Móvil fcm'); ?></dt>
        <dd>
            <?php echo h($usuario['Usuario']['fcm_registro']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Fecha Creación'); ?></dt>
        <dd>
            <?php echo h($usuario['Usuario']['fecha_creacion']); ?>
            &nbsp;
        </dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar Usuario'), array('action' => 'edit', $usuario['Usuario']['usuario_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Eliminar Usuario'), array('action' => 'delete', $usuario['Usuario']['usuario_id']),
                array('confirm' => __('Está seguro de eliminar este mensaje # %s?', $usuario['Usuario']['usuario_id']))); ?> </li>

		<li><?php echo $this->Html->link(__('Listar Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Mensajes'), array('controller' => 'mensajes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Mensaje'), array('controller' => 'mensajes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Mensajes relacionados'); ?></h3>
	<?php if (!empty($usuario['Mensaje'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Mensaje Id'); ?></th>
		<th><?php echo __('Usuario Id'); ?></th>
		<th><?php echo __('Mensaje'); ?></th>
		<th><?php echo __('Fecha Creacion'); ?></th>
		<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($usuario['Mensaje'] as $mensaje): ?>
		<tr>
			<td><?php echo $mensaje['mensaje_id']; ?></td>
			<td><?php echo $mensaje['usuario_id']; ?></td>
			<td><?php echo $mensaje['mensaje']; ?></td>
			<td><?php echo $mensaje['fecha_creacion']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Ver'), array('controller' => 'mensajes', 'action' => 'view', $mensaje['mensaje_id'])); ?>
				<?php echo $this->Html->link(__('Editar'), array('controller' => 'mensajes', 'action' => 'edit', $mensaje['mensaje_id'])); ?>
				<?php echo $this->Form->postLink(__('Eliminar'), array('controller' => 'mensajes', 'action' => 'delete', $mensaje['mensaje_id']),
                    array('confirm' => __('Está seguro de eliminar este mensaje # %s?', $mensaje['mensaje_id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Nuevo Mensaje'), array('controller' => 'mensajes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
