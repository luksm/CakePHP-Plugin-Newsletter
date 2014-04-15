<?php
App::uses('NewsletterAppModel', 'Newsletter.Model');
/**
 * Newsletter Model
 *
 */
class Newsletter extends NewsletterAppModel {
    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'email';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'email' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
            'email' => array(
                'rule' => array('email'),
            ),
            'unique' => array(
                'rule' => 'isUnique'
            ),
        ),
    );
}
