<?php

namespace TupiShop\Model\Catalog;

class ProductStock extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $productStockId;

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
    public $quantity;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $values;

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
        $this->hasMany('productStockId', 'TupiShop\Model\Catalog\ProductStockValue', 'productStockId', ['alias' => 'ProductStockValue']);
        $this->belongsTo('productId', 'TupiShop\Model\Catalog\\Product', 'productId', ['alias' => 'Product']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'product_stock';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductStock[]|ProductStock
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductStock
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
}
