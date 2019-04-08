<h3>API WEB - Sistema Externo</h3>
<h1>Selecciona el servicio :</h1>

<ul>
<li><?php echo $this->Html->link('Solicitud lista de usuarios', array('controller' => 'apiwebtest', 'action' => 'request_index')); ?></li>
<li><?php echo $this->Html->link('Solicitud para añadir un usuarios', array('controller' => 'apiwebtest', 'action' => 'request_add')); ?></li>
<li><?php echo $this->Html->link('Ver usuario con ID 32', array('controller' => 'apiwebtest', 'action' => 'request_view', 32)); ?></li>
<li><?php echo $this->Html->link('Actualizar usuarios con ID 34', array('controller' => 'apiwebtest', 'action' => 'request_edit',34)); ?></li>
<li><?php echo $this->Html->link('Eliminar usuario con ID 32', array('controller' => 'apiwebtest', 'action' => 'request_delete'), 32); ?></li>
</ul>

