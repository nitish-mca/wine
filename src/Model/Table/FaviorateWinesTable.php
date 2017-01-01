<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FaviorateWines Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Wines
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\FaviorateWine get($primaryKey, $options = [])
 * @method \App\Model\Entity\FaviorateWine newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FaviorateWine[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FaviorateWine|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FaviorateWine patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FaviorateWine[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FaviorateWine findOrCreate($search, callable $callback = null)
 */
class FaviorateWinesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('faviorate_wines');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Wines', [
            'foreignKey' => 'wine_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['wine_id'], 'Wines'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
