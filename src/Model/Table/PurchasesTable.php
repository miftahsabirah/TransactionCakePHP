<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Purchases Model
 *
 * @property \App\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 * @property \App\Model\Table\MotorcyclesTable&\Cake\ORM\Association\BelongsTo $Motorcycles
 *
 * @method \App\Model\Entity\Purchase newEmptyEntity()
 * @method \App\Model\Entity\Purchase newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Purchase[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Purchase get($primaryKey, $options = [])
 * @method \App\Model\Entity\Purchase findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Purchase patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Purchase[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Purchase|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Purchase saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Purchase[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Purchase[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Purchase[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Purchase[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PurchasesTable extends Table
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

        $this->setTable('purchases');
        $this->setDisplayField('transaction_code');
        $this->setPrimaryKey('id');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Motorcycles', [
            'foreignKey' => 'motorcycle_id',
            'joinType' => 'INNER',
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
            ->scalar('transaction_code')
            ->maxLength('transaction_code', 255)
            ->requirePresence('transaction_code', 'create')
            ->notEmptyString('transaction_code');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmptyDate('date');

        $validator
            ->integer('customer_id')
            ->notEmptyString('customer_id');

        $validator
            ->integer('motorcycle_id')
            ->notEmptyString('motorcycle_id');

        $validator
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('customer_id', 'Customers'), ['errorField' => 'customer_id']);
        $rules->add($rules->existsIn('motorcycle_id', 'Motorcycles'), ['errorField' => 'motorcycle_id']);

        return $rules;
    }
}
