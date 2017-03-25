<?php

namespace TupiShop\Model\Catalog;

use Phalcon\Validation;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;

class Customer extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $customerId;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $firstname;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $lastname;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $phone;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $createdAt;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    public $status;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $updatedAt;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        return true;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $session = \Phalcon\Di::getDefault()->getShared('session');

        // assign only last cart generated by session_id to customer
        $this->hasOne('customerId', 'TupiShop\Model\Catalog\Cart', 'customerId', [
            'alias' => 'Cart',
            'params' => [
                'order' => 'cartId DESC'
            ]
        ]);

        $this->hasMany('customerId', 'TupiShop\Model\Catalog\Address', 'customerId', ['alias' => 'Addresses']);
        $this->belongsTo('customer_group_id', 'TupiShop\Model\Catalog\\CustomerGroup', 'customerGroupId', ['alias' => 'CustomerGroup']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'customer';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Customer[]|Customer
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Customer
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
