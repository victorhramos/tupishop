<?php

namespace TupiShop\Model\Catalog;

class CartProduct extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $cartProductId;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $cartId;

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
     * @Column(type="string", length=255, nullable=true)
     */
    public $key;

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
        $this->hasMany('cartProductId', 'TupiShop\Model\Catalog\CartProductOption', 'cartProductId', ['alias' => 'CartProductOption']);
        $this->hasManyToMany('cartProductId', 'TupiShop\Model\Catalog\CartProductOption', 'cartProductId', 'optionValueId', 'TupiShop\Model\Catalog\ProductOptionValue', 'productOptionValueId', ['alias' => 'Options']);
        $this->belongsTo('productId', 'TupiShop\Model\Catalog\\Product', 'productId', ['alias' => 'Product']);
        $this->belongsTo('cartId', 'TupiShop\Model\Catalog\\Cart', 'cartId', ['alias' => 'Cart']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cart_product';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CartProduct[]|CartProduct
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CartProduct
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
