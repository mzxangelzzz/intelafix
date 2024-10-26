<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PuestoFixture
 */
class PuestoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'puesto';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'idPuesto' => 1,
                'nombrePuesto' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
