<?php

namespace TupiShop\Model\Catalog;

class CartProductOption extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $cartProductOptionId;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $optionValueId;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $cartProductId;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("shop");
        $this->belongsTo('optionValueId', 'TupiShop\Model\Catalog\\ProductOptionValue', 'productOptionValueId', ['alias' => 'ProductOptionValue']);
        $this->belongsTo('cartProductId', 'TupiShop\Model\Catalog\\CartProduct', 'cartProductId', ['alias' => 'CartProduct']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cart_product_option';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CartProductOption[]|CartProductOption
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CartProductOption
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
