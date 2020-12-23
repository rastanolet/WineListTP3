<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GrapesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GrapesTable Test Case
 */
class GrapesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GrapesTable
     */
    public $Grapes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Grapes',
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
        $config = TableRegistry::getTableLocator()->exists('Grapes') ? [] : ['className' => GrapesTable::class];
        $this->Grapes = TableRegistry::getTableLocator()->get('Grapes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Grapes);

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
