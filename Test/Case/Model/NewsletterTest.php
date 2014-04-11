<?php
App::uses('Newsletter', 'Newsletter.Model');

/**
 * Newsletter Test Case
 *
 */
class NewsletterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.newsletter.newsletter'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Newsletter = ClassRegistry::init('Newsletter.Newsletter');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Newsletter);

		parent::tearDown();
	}

}
