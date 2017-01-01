<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WineIngredientsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WineIngredientsTable Test Case
 */
class WineIngredientsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WineIngredientsTable
     */
    public $WineIngredients;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.wine_ingredients',
        'app.wines',
        'app.categories',
        'app.users',
        'app.devices',
        'app.faviorate_wines',
        'app.ingredients'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('WineIngredients') ? [] : ['className' => 'App\Model\Table\WineIngredientsTable'];
        $this->WineIngredients = TableRegistry::get('WineIngredients', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WineIngredients);

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
