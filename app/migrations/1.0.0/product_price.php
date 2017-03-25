<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class ProductPriceMigration_100
 */
class ProductPriceMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('product_price', [
                'columns' => [
                    new Column(
                        'productPriceId',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'size' => 11,
                            'first' => true
                        ]
                    ),
                    new Column(
                        'price',
                        [
                            'type' => Column::TYPE_DECIMAL,
                            'size' => 10,
                            'scale' => 2,
                            'after' => 'productPriceId'
                        ]
                    ),
                    new Column(
                        'productId',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'price'
                        ]
                    ),
                    new Column(
                        'customerGroupId',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'productId'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('PRIMARY', ['productPriceId'], 'PRIMARY'),
                    new Index('unique_price', ['productId', 'customerGroupId'], 'UNIQUE'),
                    new Index('customerGroupId', ['customerGroupId'], null)
                ],
                'references' => [
                    new Reference(
                        'product_price_ibfk_1',
                        [
                            'referencedTable' => 'product',
                            'columns' => ['productId'],
                            'referencedColumns' => ['productId'],
                            'onUpdate' => 'CASCADE',
                            'onDelete' => 'CASCADE'
                        ]
                    ),
                    new Reference(
                        'product_price_ibfk_2',
                        [
                            'referencedTable' => 'customer_group',
                            'columns' => ['customerGroupId'],
                            'referencedColumns' => ['customerGroupId'],
                            'onUpdate' => 'CASCADE',
                            'onDelete' => 'CASCADE'
                        ]
                    )
                ],
                'options' => [
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '3',
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
