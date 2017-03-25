<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class ProductStockValueMigration_101
 */
class ProductStockValueMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('product_stock_value', [
                'columns' => [
                    new Column(
                        'productStockValueId',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'size' => 11,
                            'first' => true
                        ]
                    ),
                    new Column(
                        'productOptionValueId',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'productStockValueId'
                        ]
                    ),
                    new Column(
                        'productStockId',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'productOptionValueId'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('PRIMARY', ['productStockValueId'], 'PRIMARY'),
                    new Index('productOptionValueId', ['productOptionValueId'], null),
                    new Index('productStockId', ['productStockId'], null)
                ],
                'references' => [
                    new Reference(
                        'product_stock_value_ibfk_1',
                        [
                            'referencedTable' => 'product_option_value',
                            'columns' => ['productOptionValueId'],
                            'referencedColumns' => ['productOptionValueId'],
                            'onUpdate' => 'CASCADE',
                            'onDelete' => 'CASCADE'
                        ]
                    ),
                    new Reference(
                        'product_stock_value_ibfk_2',
                        [
                            'referencedTable' => 'product_stock',
                            'columns' => ['productStockId'],
                            'referencedColumns' => ['productStockId'],
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
