<div class="gremios index">
	<h2><?php echo __('Gremios'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('gremio_id'); ?></th>
			<th><?php echo $this->Paginator->sort('nombre'); ?></th>
			<th><?php echo $this->Paginator->sort('fecha_creacion'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($gremios as $gremio): ?>
	<tr>
		<?php /*echo $this->Html->link($gremio['Gremio']['nombre'], array('controller' => 'gremios', 'action' => 'view', $gremio['Gremio']['gremio_id'])); */?>

		<td><?php echo h($gremio['Gremio']['gremio_id']); ?>&nbsp;</td>
		<td><?php echo h($gremio['Gremio']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($gremio['Gremio']['fecha_creacion']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $gremio['Gremio']['gremio_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $gremio['Gremio']['gremio_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $gremio['Gremio']['gremio_id']), array('confirm' => __('Are you sure you want to delete # %s?', $gremio['Gremio']['gremio_id']))); ?>
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
		<li><?php echo $this->Html->link(__('Listar Gremios'), array('controller' => 'gremios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Gremio'), array('controller' => 'gremios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Mensajes'), array('controller' => 'mensajes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Mensaje'), array('controller' => 'mensajes', 'action' => 'add')); ?> </li>
	</ul>
</div>
