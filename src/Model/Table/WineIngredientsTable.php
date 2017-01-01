<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WineIngredients Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Wines
 * @property \Cake\ORM\Association\BelongsTo $Ingredients
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\WineIngredient get($primaryKey, $options = [])
 * @method \App\Model\Entity\WineIngredient newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WineIngredient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WineIngredient|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WineIngredient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WineIngredient[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WineIngredient findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WineIngredientsTable extends Table
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

        $this->table('wine_ingredients');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Wines', [
            'foreignKey' => 'wine_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Ingredients', [
            'foreignKey' => 'ingredient_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
            ->integer('qty')
            ->allowEmpty('qty');

        $validator
            ->boolean('garnish_options')
            ->allowEmpty('garnish_options');

        $validator
            ->decimal('cost')
            ->allowEmpty('cost');

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
        $rules->add($rules->existsIn(['ingredient_id'], 'Ingredients'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
