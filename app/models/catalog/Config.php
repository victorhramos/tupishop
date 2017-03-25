<?php

namespace TupiShop\Model\Catalog;

class Config extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $configId;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $key;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $value;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $createdAt;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $updatedAt;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'config';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Config[]|Config
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Config
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
