<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FaviorateWinesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FaviorateWinesTable Test Case
 */
class FaviorateWinesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FaviorateWinesTable
     */
    public $FaviorateWines;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.faviorate_wines',
        'app.wines',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FaviorateWines') ? [] : ['className' => 'App\Model\Table\FaviorateWinesTable'];
        $this->FaviorateWines = TableRegistry::get('FaviorateWines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FaviorateWines);

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
