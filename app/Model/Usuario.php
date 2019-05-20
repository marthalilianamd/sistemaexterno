<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * Usuario Model
 *
 * @property Usuario $Usuario
 * @property Mensaje $Mensaje
 */
class Usuario extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'usuario_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nombre';




/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'usuario_id' => array(
				'rule' => array('isUnique'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
		),
		'nombre' => array(
			'userDefined' => array(
                'rule' => array('between', 1, 15),
				//'message' => 'Seleccione el nombre del usuario remitente',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
        'email' => array(
            'required' => array(
                'rule' => array('email', true),
                'message' => 'Email inválido'
            ),
        ),
        'contrasena' => array(
            'required' => array(
                'rule' => array('minLength', 5),
                'message' => 'Contraseña debe tener mínimo 5 caracteres'
            ),
            'min_length' => array(
                'rule' => array('minLength', '4'),
                'message' => 'Contraseña mínimo de 6 caracteres'
            )
        ),
		'movil_numero' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => true,
                //'on' => 'create' ,
				//'last' => false, // Stop validation after this rule
				// // Limit validation to 'create' or 'update' operations
			),
            'between' => array(
                    'rule' => array('lengthBetween', 9, 10),
                    'message' => 'Número entre 9 a 10 digitos'
            ),
		),
        'fcm_registro' => array(
            'userDefined' => array(
                'rule' => array('minLength', '3'),
                //'message' => 'Id de registro de móvil (FCM)',
                'allowEmpty' => true,
                'required' => false,
            ),
        ),
        'fecha_creacion' => array(
            'datetime' => array(
                'rule' => array('datetime'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */

    public $hasMany = array(
        'Mensaje' => array(
            'className' => 'Mensaje',
            'foreignKey' => 'mensaje_id',
            'dependent' => true,
        )
    );

    /**
     * Before isUniqueEmail
     * @param array $options
     * @return boolean
     */
    function isUniqueEmail($check) {

        $email = $this->find(
            'first',
            array(
                'fields' => array(
                    'usuario.usuario_id'
                ),
                'conditions' => array(
                    'usuario.email' => $check['email']
                )
            )
        );

        if(!empty($email)){
            if($this->data['Usuario']['id'] == $email['Usuario']['id']){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

    public function beforeSave($options = array())    {
        if (isset($this->data['Usuario']['contrasena'])) {
            $this->data['Usuario']['contrasena'] =
                password_hash($this->data['Usuario']['contrasena'],PASSWORD_BCRYPT);
        }
        // fallback to our parent
        return parent::beforeSave($options);
    }
}
