<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EmpleadoFixture
 */
class EmpleadoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'empleado';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'idEmpleado' => 1,
                'idPuesto' => 1,
                'idTienda' => 1,
                'nombres' => 'Lorem ipsum dolor sit amet',
                'apellidos' => 'Lorem ipsum dolor sit amet',
                'fecha_nacimiento' => '2024-10-22',
                'fotografia' => 'Lorem ipsum dolor sit amet',
                'salario' => 1.5,
            ],
        ];
        parent::init();
    }
}
