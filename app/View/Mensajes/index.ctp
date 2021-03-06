<div class="mensajes index">
	<h2><?php echo __('Mensajes enviados a móviles'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
            <th><?php echo $this->Paginator->sort('mensaje_id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('mensajes.usuario_id', 'De'); ?></th>
            <th><?php echo $this->Paginator->sort('usuarios.usuario_id', 'Para'); ?></th>
            <th><?php echo $this->Paginator->sort('titulo', 'Asunto'); ?></th>
			<th><?php echo $this->Paginator->sort('mensaje', 'Contenido Mensaje'); ?></th>
            <th><?php echo $this->Paginator->sort('estado', 'Estado Entrega a móvil'); ?></th>
            <th><?php echo $this->Paginator->sort('estadosms', 'Estado final SMS'); ?></th>
			<th><?php echo $this->Paginator->sort('fecha_creacion', 'Fecha de envío'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($mensajes as $mensaje): ?>
	<tr>
		<td>
			<?php /* echo $this->Html->link($mensaje['Mensaje']['mensaje'],
                array('controller' => 'mensajes', 'action' => 'view', $mensaje['Mensaje']['mensaje_id'])); */?>
		    <?php echo h($mensaje['Mensaje']['mensaje_id']); ?>
		</td>
        <td>
            <?php echo ($this->Html->link($mensaje['Usuario']['nombre'], array('controller' => 'usuarios', 'action' => 'view', $mensaje['Mensaje']['usuario_id']))); ?>
		</td>
        <td>
            <?php echo ($this->Html->link($mensaje['Mensaje']['usuariodestino_id'], array('controller' => 'usuarios', 'action' => 'view', $mensaje['Mensaje']['usuariodestino_id']))); ?>
        </td>
        <!--<td>
            <?php /*echo $this->Html->link($this->Session->read('nombreusuario'),array('controller' => 'usuarios','action'=>'view', $this->Session->read('idusuario'))); */?>
        </td>-->
        <td><?php echo h($mensaje['Mensaje']['titulo']); ?>&nbsp;</td>
		<td><?php echo h($mensaje['Mensaje']['mensaje']); ?>&nbsp;</td>
        <td><?php echo h($mensaje['Mensaje']['estado']); ?>&nbsp;</td>
        <td><?php echo h($mensaje['Mensaje']['estadosms']); ?>&nbsp;</td>
		<td><?php echo h($mensaje['Mensaje']['fecha_creacion']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $mensaje['Mensaje']['mensaje_id'])); ?>
			<?php /*echo $this->Html->link(__('Editar'), array('action' => 'edit', $mensaje['Mensaje']['mensaje_id'])); */?>
			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $mensaje['Mensaje']['mensaje_id']),
                array('confirm' => __('Está seguro de eliminar este mensaje # %s?', $mensaje['Mensaje']['mensaje_id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Página {:page} of {:pages}, mostrando {:current} registros de {:count} total, iniciando en {:start}, finalizando en  {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previo'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('siguiente') . ' >', array(), null, array('class' => 'next disabled'));
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
    </ul>
</div>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/5.9.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.9.1/firebase-messaging.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#config-web-app -->

<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyD9JIIMRNl1yx_Ip4LGUhppNOt0GbYqJ3Q",
        authDomain: "message-delivery-system.firebaseapp.com",
        databaseURL: "https://message-delivery-system.firebaseio.com",
        projectId: "message-delivery-system",
        storageBucket: "message-delivery-system.appspot.com",
        messagingSenderId: "1087302060910",
        appId: "1:1087302060910:web:85c92968d8d60202"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
</script>
