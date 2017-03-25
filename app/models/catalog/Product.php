<?php

namespace TupiShop\Model\Catalog;

class Product extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $productId;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $category_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $stock;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $thumb;

    /**
     * Dynamic Price by CustomerGroup
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    public $price;

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
        $this->hasMany('productId', 'TupiShop\Model\Catalog\CartProduct', 'productId', ['alias' => 'CartProduct']);
        $this->hasMany('productId', 'TupiShop\Model\Catalog\ProductOption', 'productId', ['alias' => 'ProductOption']);
        $this->hasMany('productId', 'TupiShop\Model\Catalog\ProductStock', 'productId', ['alias' => 'ProductStock']);
        $this->hasMany('productId', 'TupiShop\Model\Catalog\ProductPrice', 'productId', ['alias' => 'ProductPrice']);
        $this->belongsTo('category_id', 'TupiShop\Model\Catalog\\Category', 'categoryId', ['alias' => 'Category']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Product[]|Product
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Product
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'product';
    }

    public function afterFetch()
    {
        $this->setPrice();
    }

    /**
     * Define product price dynamically
     * @method setPrice
     */
    private function setPrice()
    {
        $di = \Phalcon\Di::getDefault();
        $session = $di->getSession();
        $customer = \TupiShop\Model\Catalog\Customer::findFirst($session->get('customer'));

        $group = $di->getShared('storeConfig')->defaultCustomerGroup;

        if ($customer) {
            $group = $customer->customer_group_id;
        }

        $price = \TupiShop\Model\Catalog\ProductPrice::findFirst([
            'productId = :p: and customerGroupId = :c:',
            'bind' => [
                'p' => $this->productId,
                'c' => $customer->customer_group_id
            ]
        ]);

        $this->price = $price->price;
    }

}
