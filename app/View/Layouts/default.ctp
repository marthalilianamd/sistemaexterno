<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'SISTEMA web EXTERNO');
/*$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())*/
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
            <div style="float: left;">
			<h1><?php echo $this->Html->link( 'SISTEMA WEB EXTERNO', array('controller' => 'mensajes','action'=>'index')); ?></h1>
            </div>
            <div style="float: right;">
                <?php if($this->Session->read('Logueado')):?>
                <?php
                echo $this->Html->link( "Cerrar sesión",   array('controller' => 'usuarios','action'=>'logout') );
                echo "<br>";
                ?>
                <?php endif; ?>
            </div>
        </div>
		<div id="content">
            <div>
                <?php if($this->Session->read('Logueado')):?>
                    <?php echo $this->Html->link( "Inicio",   array('controller' => 'mensajes','action'=>'index'));?>
                    <div style="float: right;">
                        Bienvenido
                        <?php echo $this->Html->link($this->Session->read('nombreusuario'),array('controller' => 'usuarios','action'=>'view', $this->Session->read('idusuario'))); ?>
                    </div>
                <?php endif; ?>
        </div>
			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php /*echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'https://cakephp.org/',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);
			*/?>
			<p>
				<?php /*echo $cakeVersion;*/ ?>
			</p>
		</div>
	</div>
	<?php /*echo $this->element('sql_dump'); */?>
</body>

</html>
