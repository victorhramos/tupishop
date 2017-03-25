<?php
namespace TupiShop\Controller\Catalog;

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        // s($this->cart->toArray());
        $samsung = \TupiShop\Model\Catalog\Product::findFirst(1);
        s($samsung->ProductPrice->toArray());
        //
        // $opts = [];
        // foreach ($samsung->ProductOption as $option) {
        //     $opts[$option->name] = [
        //         'type' => $option->type,
        //         'values' => $option->ProductOptionValue->toArray()
        //     ];
        // }
        //
        // s($opts);
        // $st = [];
        // foreach ($samsung->ProductStock as $i => $stock) {
        //     $st[$i]['quantity'] = $stock->quantity;
        //     foreach ($stock->ProductStockValue as $j => $stockValue) {
        //         $st[$i]['options'][] = [
        //             'option_id' => $stockValue->ProductOptionValue->ProductOption->productOptionId,
        //             'option' => $stockValue->ProductOptionValue->ProductOption->name,
        //             'value_id' => $stockValue->ProductOptionValue->productOptionValueId,
        //             'value' => $stockValue->ProductOptionValue->value
        //         ];
        //     }
        // }
        //
        // s($st);
        //
        //
        // $categories = [];
        // foreach (\TupiShop\Model\Catalog\Category::find('parent is null') as $i => $category) {
        //     $categories[$i] = $category->toArray();
        //     $categories[$i]['childs'] = $category->Childs->toArray();
        // }
        //
        // s($categories);
        //
        // s($this->customer->toArray());
        // s($this->customer->Cart->Products->toArray());

        // $cart = [];
        // foreach ($this->customer->Cart->CartProduct as $i => $cp) {
        //     $cart[$i] = $cp->Product->toArray();
        //     $cart[$i]['options'] = $cp->Options->toArray();
        // }
        //
        // s($cart);
        // s($this->customer->Cart->getProductsWithOptions());
        // s($this->customer->Cart->Products->toArray());
        // s($this->customer->Cart->CartProduct->Options->toArray());
        // $this->cart->addProduct(1, 1, [1,3]);
        s($this->cart->toArray());
        die();
    }
}
