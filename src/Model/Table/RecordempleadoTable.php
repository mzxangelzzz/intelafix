<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Recordempleado Model
 *
 * @method \App\Model\Entity\Recordempleado newEmptyEntity()
 * @method \App\Model\Entity\Recordempleado newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Recordempleado> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Recordempleado get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Recordempleado findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Recordempleado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Recordempleado> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Recordempleado|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Recordempleado saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Recordempleado>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Recordempleado>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Recordempleado>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Recordempleado> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Recordempleado>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Recordempleado>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Recordempleado>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Recordempleado> deleteManyOrFail(iterable $entities, array $options = [])
 */
class RecordempleadoTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('recordempleado');
        $this->setDisplayField('idRecord');
        $this->setPrimaryKey('idRecord');

         // Definir la relación belongsTo con la tabla Empleado
         $this->belongsTo('Empleado', [
            'foreignKey' => 'idEmpleado', // El campo en Recordempleado que es clave foránea
            'joinType' => 'INNER', // O 'LEFT' si lo necesitas opcional
        ]);

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('idEmpleado')
            ->requirePresence('idEmpleado', 'create')
            ->notEmptyString('idEmpleado');

        $validator
            ->scalar('descripcion')
            ->requirePresence('descripcion', 'create')
            ->notEmptyString('descripcion','La Descripcion es requerida.');

        $validator
            ->boolean('tipo_logro')
            ->requirePresence('tipo_logro', 'create')
            ->notEmptyString('tipo_logro');

        $validator
            ->date('fecha_ocurrencia')
            ->requirePresence('fecha_ocurrencia', 'create')
            ->notEmptyDate('fecha_ocurrencia');

            $validator
            ->integer('idEmpleado')
            ->requirePresence('idEmpleado', 'create')
            ->notEmptyString('idEmpleado', 'El Empleado es requerido.');

        return $validator;
    }
}
