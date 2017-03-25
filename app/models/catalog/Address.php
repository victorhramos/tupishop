<?php

namespace TupiShop\Model\Catalog;

class Address extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $addressId;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $customerId;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $deliverTo;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $street;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    public $number;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $complement;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $district;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $city;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $state;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $country;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('customerId', 'TupiShop\Model\Catalog\\Customer', 'customerId', ['alias' => 'Customer']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'address';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Address[]|Address
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Address
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
