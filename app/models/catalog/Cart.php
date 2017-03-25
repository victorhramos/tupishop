<?php

namespace TupiShop\Model\Catalog;

class Cart extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $cartId;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $customerId;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    public $sessionId;

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
     *
     * @var decimal
     */
    public $total;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('cartId', 'TupiShop\Model\Catalog\CartProduct', 'cartId', ['alias' => 'CartProduct']);
        $this->hasManyToMany('cartId', 'TupiShop\Model\Catalog\CartProduct', 'cartId', 'productId', 'TupiShop\Model\Catalog\Product', 'productId', ['alias' => 'Products']);
        $this->belongsTo('customerId', 'TupiShop\Model\Catalog\\Customer', 'customerId', ['alias' => 'Customer']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cart';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Cart[]|Cart
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Cart
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function getProductsWithOptions()
    {
        $cart = [];
        foreach ($this->CartProduct as $i => $cp) {
            $cart[$i] = $cp->Product->toArray();
            $cart[$i]['quantity'] = $cp->quantity;
            $cart[$i]['options'] = $cp->Options->toArray();
        }

        return $cart;
    }

    public function afterFetch()
    {
        // update total
        $this->total = $this->getTotal();
        $this->save();
    }

    /**
     * Add Product to Cart
     * @method addProduct
     * @param  [type]     $productId ProductId
     * @param  integer    $qty       Quantity
     * @param  [type]     $options   Array of OptionValueId ex: [1,3]
     */
    public function addProduct($productId, $qty = 1, $options = [])
    {
        $key = base64_encode(json_encode([$productId => $options]));
        $cp = \TupiShop\Model\Catalog\CartProduct::findFirstByKey($key);

        if (!$cp) {
            $cp = new \TupiShop\Model\Catalog\CartProduct();
            $cp->createdAt = date('Y-m-d H:i:s');
            $cp->quantity = $qty;
        } else {
            $cp->quantity += $qty;
        }

        $cp->key = $key;
        $cp->updatedAt = date('Y-m-d H:i:s');
        $cp->cartId = $this->cartId;
        $cp->productId = $productId;

        try {
            $cp->save();
        } catch (Exception $e) {
            return false;
        }

        foreach ($options as $optionValueId) {
            $cpo = \TupiShop\Model\Catalog\CartProductOption::findFirst([
                'cartProductId = :cp: AND optionValueId = :opt:',
                'bind' => [
                    'cp' => $cp->cartProductId,
                    'opt' => $optionValueId
                ]
            ]);

            if (!$cpo) {
                $cpo = new \TupiShop\Model\Catalog\CartProductOption();
                $cpo->cartProductId = $cp->cartProductId;
                $cpo->optionValueId = $optionValueId;
                $cpo->save();
            }
        }

        return true;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->CartProduct as $cp) {
            $total += $cp->Product->price * $cp->quantity;
        }

        return $total;
    }

    public function countItems()
    {
        $count = 0;
        foreach ($this->CartProduct as $cp) {
            $count += $cp->quantity;
        }

        return $count;
    }
}
