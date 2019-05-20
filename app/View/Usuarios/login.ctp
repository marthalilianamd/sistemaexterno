<div class="usuarios form">
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Form->create('Usuario'); ?>
    <fieldset>
        <legend><?php echo __('Inicio de Sesión'); ?></legend>
        <?php
        echo $this->Form->input('email',array('label' => 'Email', 'type'=>'email'));
        echo $this->Form->input('contrasena',array('label' => 'Contraseña','type'=>'password'));

        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Iniciar sesión')); ?>
</div>
<?php
/*echo $this->Html->link( "Crear usuario",   array('action'=>'add') );
*/?>