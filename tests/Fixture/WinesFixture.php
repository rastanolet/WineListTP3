<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * WinesFixture
 */
class WinesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'color_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'country_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'region_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'vineyard_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'year_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'price' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'description' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'photo' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'rating_AVG' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'wines_ibfk_1' => ['type' => 'index', 'columns' => ['color_id'], 'length' => []],
            'wines_ibfk_2' => ['type' => 'index', 'columns' => ['country_id'], 'length' => []],
            'wines_ibfk_4' => ['type' => 'index', 'columns' => ['region_id'], 'length' => []],
            'wines_ibfk_5' => ['type' => 'index', 'columns' => ['vineyard_id'], 'length' => []],
            'wines_ibfk_6' => ['type' => 'index', 'columns' => ['year_id'], 'length' => []],
            'wines_ibfk_9' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'wines_ibfk_1' => ['type' => 'foreign', 'columns' => ['color_id'], 'references' => ['colors', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'wines_ibfk_2' => ['type' => 'foreign', 'columns' => ['country_id'], 'references' => ['countries', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'wines_ibfk_4' => ['type' => 'foreign', 'columns' => ['region_id'], 'references' => ['regions', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'wines_ibfk_5' => ['type' => 'foreign', 'columns' => ['vineyard_id'], 'references' => ['vineyards', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'wines_ibfk_6' => ['type' => 'foreign', 'columns' => ['year_id'], 'references' => ['years', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'wines_ibfk_9' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 1,
                'color_id' => 1,
                'country_id' => 1,
                'region_id' => 1,
                'vineyard_id' => 1,
                'year_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'price' => 1.5,
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'photo' => 'Lorem ipsum dolor sit amet',
                'rating_AVG' => 1,
                'created' => '2020-10-13 21:38:30',
                'modified' => '2020-10-13 21:38:30',
            ],
        ];
        parent::init();
    }
}
