<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class CartProductOptionMigration_101
 */
class CartProductOptionMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('cart_product_option', [
                'columns' => [
                    new Column(
                        'cartProductOptionId',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'size' => 11,
                            'first' => true
                        ]
                    ),
                    new Column(
                        'optionValueId',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'cartProductOptionId'
                        ]
                    ),
                    new Column(
                        'cartProductId',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'optionValueId'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('PRIMARY', ['cartProductOptionId'], 'PRIMARY'),
                    new Index('optionValueId', ['optionValueId'], null),
                    new Index('cartProductId', ['cartProductId'], null)
                ],
                'references' => [
                    new Reference(
                        'cart_product_option_ibfk_1',
                        [
                            'referencedTable' => 'product_option_value',
                            'columns' => ['optionValueId'],
                            'referencedColumns' => ['productOptionValueId'],
                            'onUpdate' => 'CASCADE',
                            'onDelete' => 'CASCADE'
                        ]
                    ),
                    new Reference(
                        'cart_product_option_ibfk_2',
                        [
                            'referencedTable' => 'cart_product',
                            'columns' => ['cartProductId'],
                            'referencedColumns' => ['cartProductId'],
                            'onUpdate' => 'CASCADE',
                            'onDelete' => 'CASCADE'
                        ]
                    )
                ],
                'options' => [
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '5',
                    'ENGINE' => 'InnoDB',
                    'TABLE_COLLATION' => 'utf8_general_ci'
                ],
            ]
        );
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {

    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

    }

}
