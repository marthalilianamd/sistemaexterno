<?php
App::uses('Gremio', 'Model');

/**
 * Gremio Test Case
 */
class GremioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.gremio',
		'app.mensaje'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Gremio = ClassRegistry::init('Gremio');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Gremio);

		parent::tearDown();
	}

}
