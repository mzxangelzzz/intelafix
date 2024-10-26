<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tienda Model
 *
 * @method \App\Model\Entity\Tienda newEmptyEntity()
 * @method \App\Model\Entity\Tienda newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Tienda> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tienda get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Tienda findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Tienda patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Tienda> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tienda|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Tienda saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Tienda>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tienda>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tienda>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tienda> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tienda>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tienda>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tienda>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tienda> deleteManyOrFail(iterable $entities, array $options = [])
 */
class TiendaTable extends Table
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

        $this->setTable('tienda');
        $this->setDisplayField('nombreTienda');
        $this->setPrimaryKey('idTienda');
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
            ->scalar('nombreTienda')
            ->maxLength('nombreTienda', 100)
            ->requirePresence('nombreTienda', 'create')
            ->notEmptyString('nombreTienda');

        return $validator;
    }
}
