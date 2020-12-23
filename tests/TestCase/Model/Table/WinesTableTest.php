<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WinesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WinesTable Test Case
 */
class WinesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\WinesTable
     */
    public $Wines;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Wines',
        'app.Users',
        'app.Colors',
        'app.Countries',
        'app.Grapes',
        'app.Regions',
        'app.Vineyards',
        'app.Years',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Wines') ? [] : ['className' => WinesTable::class];
        $this->Wines = TableRegistry::getTableLocator()->get('Wines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Wines);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
