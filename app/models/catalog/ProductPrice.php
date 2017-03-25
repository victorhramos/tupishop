<?php

namespace TupiShop\Model\Catalog;

class ProductPrice extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $productPriceId;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    public $price;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $productId;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $customerGroupId;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('productId', 'TupiShop\Model\Catalog\\Product', 'productId', ['alias' => 'Product']);
        $this->belongsTo('customerGroupId', 'TupiShop\Model\Catalog\\CustomerGroup', 'customerGroupId', ['alias' => 'CustomerGroup']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'product_price';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductPrice[]|ProductPrice
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductPrice
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
