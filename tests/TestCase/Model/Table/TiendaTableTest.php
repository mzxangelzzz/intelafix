<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TiendaTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TiendaTable Test Case
 */
class TiendaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TiendaTable
     */
    protected $Tienda;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Tienda',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Tienda') ? [] : ['className' => TiendaTable::class];
        $this->Tienda = $this->getTableLocator()->get('Tienda', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Tienda);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TiendaTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
