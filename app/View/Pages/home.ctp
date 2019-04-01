<?php
/**
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */

if (!Configure::read('debug')):
	throw new NotFoundException();
endif;

App::uses('Debugger', 'Utility');
?>

<?php
if (Configure::read('debug') > 0):
	Debugger::checkSecurityKeys();
endif;
?>


<!-- INICIO VISTA HOME MAIN -->
<html lang="">
<head>
    <title>SISTEMA EXTERNO | 1.0</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,800,100' rel='stylesheet' type='text/css'>
    <link href='../../webroot/css/style.css' rel='stylesheet' type='text/css'>
    <link href='http://api.androidhive.info/gcm/styles/default.css' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('input#send_to_single_user').on('click', function () {
                var msg = $('#send_to_single').val();
                var to = $('.select_single').val();
                if (msg.trim().length === 0) {
                    alert('Enter a message');
                    return;
                }

                $('#send_to_single').val('');
                $('#loader_single').show();

                $.post("v1/users/" + to + '/message',
                    {user_id: user_id, message: msg},
                    function (data) {
                        if (data.error === false) {
                            $('#loader_single').hide();
                            alert('Push notification sent successfully! You should see a Toast message on device.');
                        } else {
                            alert('Sorry! Unable to post message');
                        }
                    }).done(function () {

                }).fail(function () {
                    alert('Sorry! Unable to send message');
                }).always(function () {
                    $('#loader_single').hide();
                });
            });

            function scrollToBottom(cls) {
                $('.' + cls).scrollTop($('.' + cls + ' ul li').last().position().top + $('.' + cls + ' ul li').last().height());
            }
        });
    </script>
</head>
<body>
<div class="header">
    <label class="logo"></label>
    <h2 class="small"></h2>
</div>
<div class="container_body">
    <div class="topics">
        <h2 class="heading"></h2><a href="#"></a>
    </div>
    <div class="topics">
        <div class="separator"></div>
        <h2 class="heading">Enviar mensaje a un solo usuario</h2><br/><br/>

        <div class="container">
            <select class="select_single">
                <?php
                $usuarios = $this->Usuario->find('all');
                foreach ($usuarios as $key => $usuario) {
                    ?>
                    <option value="<?= $usuario['usuario_id'] ?>"><?= $usuario['nombre'] ?> (<?= $usuario['email'] ?>)</option>
                    <?php
                }
                ?>
            </select><br/>
            <textarea id="send_to_single" class="textarea_msg" placeholder="Escribe el mensaje"></textarea><br/>
            <input id="send_to_single_user" type="button" value="Enviar a un solo usuario" class="btn_send"/>
            <img src="loader.gif" id="loader_single" class="loader"/>
        </div>
        <br/>
        <div class="separator"></div>
    </div>
    <br/><br/>
</div>

</body>
</html>








