<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Puesto Model
 *
 * @method \App\Model\Entity\Puesto newEmptyEntity()
 * @method \App\Model\Entity\Puesto newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Puesto> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Puesto get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Puesto findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Puesto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Puesto> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Puesto|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Puesto saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Puesto>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Puesto>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Puesto>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Puesto> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Puesto>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Puesto>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Puesto>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Puesto> deleteManyOrFail(iterable $entities, array $options = [])
 */
class PuestoTable extends Table
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

        $this->setTable('puesto');
        $this->setDisplayField('nombrePuesto');
        $this->setPrimaryKey('idPuesto');
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
            ->scalar('nombrePuesto')
            ->maxLength('nombrePuesto', 100)
            ->requirePresence('nombrePuesto', 'create')
            ->notEmptyString('nombrePuesto');

        return $validator;
    }
}
