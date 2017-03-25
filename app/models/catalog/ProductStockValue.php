<?php

namespace TupiShop\Model\Catalog;

class ProductStockValue extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $productStockValueId;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $productOptionValueId;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $productStockId;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('productOptionValueId', 'TupiShop\Model\Catalog\\ProductOptionValue', 'productOptionValueId', ['alias' => 'ProductOptionValue']);
        $this->belongsTo('productStockId', 'TupiShop\Model\Catalog\\ProductStock', 'productStockId', ['alias' => 'ProductStock']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'product_stock_value';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductStockValue[]|ProductStockValue
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductStockValue
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
