<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Motorcycles Model
 *
 * @property \App\Model\Table\PurchasesTable&\Cake\ORM\Association\HasMany $Purchases
 * @property \App\Model\Table\SalesTable&\Cake\ORM\Association\HasMany $Sales
 *
 * @method \App\Model\Entity\Motorcycle newEmptyEntity()
 * @method \App\Model\Entity\Motorcycle newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Motorcycle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Motorcycle get($primaryKey, $options = [])
 * @method \App\Model\Entity\Motorcycle findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Motorcycle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Motorcycle[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Motorcycle|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Motorcycle saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Motorcycle[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Motorcycle[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Motorcycle[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Motorcycle[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class MotorcyclesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('motorcycles');
        $this->setDisplayField('brand');
        $this->setPrimaryKey('id');

        $this->hasMany('Purchases', [
            'foreignKey' => 'motorcycle_id',
        ]);
        $this->hasMany('Sales', [
            'foreignKey' => 'motorcycle_id',
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
            ->scalar('brand')
            ->maxLength('brand', 255)
            ->requirePresence('brand', 'create')
            ->notEmptyString('brand');

        $validator
            ->scalar('model')
            ->maxLength('model', 255)
            ->requirePresence('model', 'create')
            ->notEmptyString('model');

        $validator
            ->scalar('year')
            ->requirePresence('year', 'create')
            ->notEmptyString('year');

        return $validator;
    }
}
