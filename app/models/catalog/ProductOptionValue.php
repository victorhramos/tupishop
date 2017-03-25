<?php

namespace TupiShop\Model\Catalog;

class ProductOptionValue extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $productOptionValueId;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $productOptionId;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $value;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $stock;

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
        $this->hasMany('productOptionValueId', 'TupiShop\Model\Catalog\CartProductOption', 'optionValueId', ['alias' => 'CartProductOption']);
        $this->belongsTo('productOptionId', 'TupiShop\Model\Catalog\\ProductOption', 'productOptionId', ['alias' => 'ProductOption']);
        $this->hasMany('productOptionValueId', 'TupiShop\Model\Catalog\ProductStockValue', 'productOptionValueId', ['alias' => 'ProductStockValue']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'product_option_value';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductOptionValue[]|ProductOptionValue
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductOptionValue
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
