<div class="gremios view">
<h2><?php echo __('Gremio'); ?></h2>
	<dl>
		<dt><?php echo __('Gremio'); ?></dt>
		<dd>
			<?php echo $this->Html->link($gremio['Gremio']['nombre'], array('controller' => 'gremios', 'action' => 'view', $gremio['Gremio']['gremio_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($gremio['Gremio']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha Creacion'); ?></dt>
		<dd>
			<?php echo h($gremio['Gremio']['fecha_creacion']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Gremio'), array('action' => 'edit', $gremio['Gremio']['gremio_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Gremio'), array('action' => 'delete', $gremio['Gremio']['gremio_id']), array('confirm' => __('Are you sure you want to delete # %s?', $gremio['Gremio']['gremio_id']))); ?> </li>

		<li><?php echo $this->Html->link(__('Listar Gremios'), array('controller' => 'gremios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Gremio'), array('controller' => 'gremios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Mensajes'), array('controller' => 'mensajes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Mensaje'), array('controller' => 'mensajes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Mensajes'); ?></h3>
	<?php if (!empty($gremio['Mensaje'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Mensaje Id'); ?></th>
		<th><?php echo __('Gremio Id'); ?></th>
		<th><?php echo __('Usuario Id'); ?></th>
		<th><?php echo __('Mensaje'); ?></th>
		<th><?php echo __('Fecha Creacion'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($gremio['Mensaje'] as $mensaje): ?>
		<tr>
			<td><?php echo $mensaje['mensaje_id']; ?></td>
			<td><?php echo $mensaje['gremio_id']; ?></td>
			<td><?php echo $mensaje['usuario_id']; ?></td>
			<td><?php echo $mensaje['mensaje']; ?></td>
			<td><?php echo $mensaje['fecha_creacion']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Ver'), array('controller' => 'mensajes', 'action' => 'view', $mensaje['mensaje_id'])); ?>
				<?php echo $this->Html->link(__('Editar'), array('controller' => 'mensajes', 'action' => 'edit', $mensaje['mensaje_id'])); ?>
				<?php echo $this->Form->postLink(__('Eliminar'), array('controller' => 'mensajes', 'action' => 'delete', $mensaje['mensaje_id']), array('confirm' => __('Are you sure you want to delete # %s?', $mensaje['mensaje_id']))); ?>
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
