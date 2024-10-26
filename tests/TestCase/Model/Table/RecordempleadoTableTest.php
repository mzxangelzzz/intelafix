<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RecordempleadoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RecordempleadoTable Test Case
 */
class RecordempleadoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RecordempleadoTable
     */
    protected $Recordempleado;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Recordempleado',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Recordempleado') ? [] : ['className' => RecordempleadoTable::class];
        $this->Recordempleado = $this->getTableLocator()->get('Recordempleado', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Recordempleado);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RecordempleadoTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
