<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class EmpleadoTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('empleado');
        $this->setDisplayField('nombres');
        $this->setPrimaryKey('idEmpleado');

        // Agregar las relaciones
        $this->belongsTo('Puesto', [
            'foreignKey' => 'idPuesto',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Tienda', [
            'foreignKey' => 'idTienda',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('idPuesto')
            ->requirePresence('idPuesto', 'create')
            ->notEmptyString('idPuesto', 'El puesto es requerido.');

        $validator
            ->integer('idTienda')
            ->requirePresence('idTienda', 'create')
            ->notEmptyString('idTienda', 'La tienda es requerida.');

        $validator
            ->scalar('nombres')
            ->maxLength('nombres', 100)
            ->requirePresence('nombres', 'create')
            ->notEmptyString('nombres', 'Los nombres son requeridos.');

        $validator
            ->scalar('apellidos')
            ->maxLength('apellidos', 100)
            ->requirePresence('apellidos', 'create')
            ->notEmptyString('apellidos', 'Los apellidos son requeridos.');

        $validator
            ->date('fecha_nacimiento')
            ->requirePresence('fecha_nacimiento', 'create')
            ->notEmptyDate('fecha_nacimiento', 'La fecha de nacimiento es requerida.');

        $validator
            ->requirePresence('fotografia', 'create') // Cambia 'Fotografia' a 'fotografia'
            ->notEmptyFile('fotografia', 'La fotografía es requerida.');

        $validator
            ->decimal('salario')
            ->requirePresence('salario', 'create')
            ->notEmptyString('salario', 'El salario es requerido.');

        return $validator;
    }
}
