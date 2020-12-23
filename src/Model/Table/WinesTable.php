<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Wines Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ColorsTable&\Cake\ORM\Association\BelongsTo $Colors
 * @property \App\Model\Table\CountriesTable&\Cake\ORM\Association\BelongsTo $Countries
 * @property \App\Model\Table\RegionsTable&\Cake\ORM\Association\BelongsTo $Regions
 * @property \App\Model\Table\VineyardsTable&\Cake\ORM\Association\BelongsTo $Vineyards
 * @property \App\Model\Table\YearsTable&\Cake\ORM\Association\BelongsTo $Years
 * @property \App\Model\Table\GrapesTable&\Cake\ORM\Association\BelongsToMany $Grapes
 *
 * @method \App\Model\Entity\Wine get($primaryKey, $options = [])
 * @method \App\Model\Entity\Wine newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Wine[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Wine|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Wine saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Wine patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Wine[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Wine findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WinesTable extends Table
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
        $this->addBehavior('Translate', ['fields' => ['description']]);
        
        $this->setTable('wines');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Colors', [
            'foreignKey' => 'color_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Regions', [
            'foreignKey' => 'region_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Vineyards', [
            'foreignKey' => 'vineyard_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Years', [
            'foreignKey' => 'year_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('Grapes', [
            'foreignKey' => 'wine_id',
            'targetForeignKey' => 'grape_id',
            'joinTable' => 'grapes_wines',
        ]);
		
		$this->belongsToMany('Files', [
            'foreignKey' => 'wine_id',
            'targetForeignKey' => 'file_id',
            'joinTable' => 'files_wines',
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->integer('rating_AVG')
            ->requirePresence('rating_AVG', 'create')
            ->notEmptyString('rating_AVG');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['color_id'], 'Colors'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['region_id'], 'Regions'));
        $rules->add($rules->existsIn(['vineyard_id'], 'Vineyards'));
        $rules->add($rules->existsIn(['year_id'], 'Years'));

        return $rules;
    }
}
