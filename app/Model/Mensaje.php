<?php
App::uses('AppModel', 'Model');
/**
 * Mensaje Model
 *
 * @property Usuario $Usuario
 */
class Mensaje extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'mensaje_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'mensaje';


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'mensaje_id' => array(
			'userDefined' => array(
				'rule' => array('isUnique'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
        'usuariodestino_id' => array(
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
                'rule' => array('lengthBetween', 9, 11),
                'message' => 'Número entre 9 a 11 digitos'
            ),
        ),
		'titulo' => array(
            'userDefined' => array(
                'rule' => array('between', 1, 50),
                //'message' => 'El mensaje no pueden enviarse vacio',
                'allowEmpty' => false,
                'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
		),
        'mensaje' => array(
            'userDefined' => array(
                'rule' => array('between', 1, 255),
                //'message' => 'El mensaje no pueden enviarse vacio',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'estado' => array(
            'userDefined' => array(
                'rule' => array('between', 1, 20),
                //'message' => 'El mensaje no pueden enviarse vacio',
                'allowEmpty' => true,
                'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'estadosms' => array(
            'userDefined' => array(
                'rule' => array('between', 1, 50),
                //'message' => 'El mensaje no pueden enviarse vacio',
                'allowEmpty' => true,
                'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo  = array(
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
