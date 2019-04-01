<div class="mensajes index">
	<h2><?php echo __('Mensajes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('mensaje_id'); ?></th>
			<th><?php echo $this->Paginator->sort('gremio_id'); ?></th>
			<th><?php echo $this->Paginator->sort('usuario_id', 'Usuario'); ?></th>
			<th><?php echo $this->Paginator->sort('mensaje'); ?></th>
			<th><?php echo $this->Paginator->sort('fecha_creacion'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($mensajes as $mensaje): ?>
	<tr>
		<td>
			<?php /* echo $this->Html->link($mensaje['Mensaje']['mensaje'], array('controller' => 'mensajes', 'action' => 'view', $mensaje['Mensaje']['mensaje_id'])); */?>
		    <?php echo h($mensaje['Mensaje']['mensaje_id']); ?>
		</td>
		<td><?php echo h($mensaje['Mensaje']['gremio_id']); ?>&nbsp;</td>
		<td>
		<?php echo h($mensaje['Mensaje']['usuario_id']); ?>&nbsp;
		</td>
		<td><?php echo h($mensaje['Mensaje']['mensaje']); ?>&nbsp;</td>
		<td><?php echo h($mensaje['Mensaje']['fecha_creacion']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $mensaje['Mensaje']['mensaje_id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $mensaje['Mensaje']['mensaje_id'])); ?>
			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $mensaje['Mensaje']['mensaje_id']), array('confirm' => __('Are you sure you want to delete # %s?', $mensaje['Mensaje']['mensaje_id']))); ?>
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
		<li><?php echo $this->Html->link(__('Listar Mensajes'), array('controller' => 'mensajes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Mensaje'), array('controller' => 'mensajes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('Listar Gremios'), array('controller' => 'gremios', 'action' => 'add')); ?> </li>
	</ul>
</div>
