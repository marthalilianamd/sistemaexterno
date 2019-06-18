<div class="mensajes view">
<h2><?php echo __('Mensaje'); ?></h2>
	<dl>
		<dt><?php echo __('Mensaje'); ?></dt>
		<dd>
			<?php echo $this->Html->link($mensaje['Mensaje']['mensaje_id'], array('controller' => 'mensajes', 'action' => 'view', $mensaje['Mensaje']['mensaje_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usuario'); ?></dt>
		<dd>
			<?php echo $this->Html->link($mensaje['Usuario']['nombre'], array('controller' => 'usuarios', 'action' => 'view', $mensaje['Usuario']['usuario_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mensaje'); ?></dt>
		<dd>
			<?php echo h($mensaje['Mensaje']['mensaje']); ?>
			&nbsp;
		</dd>
        <dt><?php echo __('Estado Entrega al móvil'); ?></dt>
        <dd>
            <?php echo h($mensaje['Mensaje']['estado']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Estado final SMS'); ?></dt>
        <dd>
            <?php echo h($mensaje['Mensaje']['estadosms']); ?>
            &nbsp;
        </dd>
		<dt><?php echo __('Fecha envío'); ?></dt>
		<dd>
			<?php echo h($mensaje['Mensaje']['fecha_creacion']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar Mensaje'), array('action' => 'edit', $mensaje['Mensaje']['mensaje_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Eliminar Mensaje'), array('action' => 'delete', $mensaje['Mensaje']['mensaje_id']),
                array('confirm' => __('Desea eliminar el mensaje # %s?', $mensaje['Mensaje']['mensaje_id']))); ?> </li>

		<li><?php echo $this->Html->link(__('Listar Mensajes'), array('controller' => 'mensajes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Mensaje'), array('controller' => 'mensajes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
    <h3><?php echo __('Mensajes relacionados'); ?></h3>
    <?php if (!empty($mensaje['Mensaje'])): ?>
    <dl>
        <dt><?php echo __('Mensaje Id'); ?></dt>
		<dd>
	        <?php echo $mensaje['Mensaje']['mensaje_id']; ?>
&nbsp;       </dd>

        <dt><?php echo __('Usuario Id'); ?></dt>
        <dd>
            <?php echo $mensaje['Mensaje']['usuario_id']; ?>
    &nbsp;  </dd>
        <dt><?php echo __('Titulo'); ?></dt>
        <dd>
            <?php echo $mensaje['Mensaje']['titulo']; ?>
&nbsp;      </dd>
        <dt><?php echo __('Mensaje'); ?></dt>
		<dd>
	        <?php echo $mensaje['Mensaje']['mensaje']; ?>
&nbsp;      </dd>
        <dt><?php echo __('Estado'); ?></dt>
        <dd>
            <?php echo $mensaje['Mensaje']['estado']; ?>
&nbsp;      </dd>
		<dt><?php echo __('Fecha Creacion'); ?></dt>
		<dd>
	        <?php echo $mensaje['Mensaje']['fecha_creacion']; ?>
&nbsp;      </dd>
    </dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Editar Mensaje'), array('controller' => 'mensajes', 'action' => 'edit', $mensaje['Mensaje']['mensaje_id'])); ?></li>
			</ul>
		</div>
	</div>
	