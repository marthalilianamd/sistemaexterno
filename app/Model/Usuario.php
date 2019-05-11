<?php
App::uses('AppModel', 'Model');
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
            'email' => array(
                'rule'    => array('email'),
                'allowEmpty' => false,
                'required' => false,
                'on' => 'create' ,
            ),
		),
		'movil_numero' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
                'on' => 'update' ,
				//'last' => false, // Stop validation after this rule
				// // Limit validation to 'create' or 'update' operations
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
}
