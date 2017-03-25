<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class ProductOptionValueMigration_101
 */
class ProductOptionValueMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('product_option_value', [
                'columns' => [
                    new Column(
                        'productOptionValueId',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'size' => 11,
                            'first' => true
                        ]
                    ),
                    new Column(
                        'productOptionId',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'productOptionValueId'
                        ]
                    ),
                    new Column(
                        'value',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 255,
                            'after' => 'productOptionId'
                        ]
                    ),
                    new Column(
                        'createdAt',
                        [
                            'type' => Column::TYPE_DATETIME,
                            'size' => 1,
                            'after' => 'value'
                        ]
                    ),
                    new Column(
                        'updatedAt',
                        [
                            'type' => Column::TYPE_DATETIME,
                            'size' => 1,
                            'after' => 'createdAt'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('PRIMARY', ['productOptionValueId'], 'PRIMARY'),
                    new Index('productOptionId', ['productOptionId'], null)
                ],
                'references' => [
                    new Reference(
                        'product_option_value_ibfk_1',
                        [
                            'referencedTable' => 'product_option',
                            'columns' => ['productOptionId'],
                            'referencedColumns' => ['productOptionId'],
                            'onUpdate' => 'CASCADE',
                            'onDelete' => 'CASCADE'
                        ]
                    )
                ],
                'options' => [
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '6',
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
