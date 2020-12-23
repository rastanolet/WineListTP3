<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VineyardsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VineyardsTable Test Case
 */
class VineyardsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VineyardsTable
     */
    public $Vineyards;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Vineyards',
        'app.Wines',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Vineyards') ? [] : ['className' => VineyardsTable::class];
        $this->Vineyards = TableRegistry::getTableLocator()->get('Vineyards', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Vineyards);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
