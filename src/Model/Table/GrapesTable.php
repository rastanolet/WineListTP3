<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Grapes Model
 *
 * @property \App\Model\Table\WinesTable&\Cake\ORM\Association\BelongsToMany $Wines
 *
 * @method \App\Model\Entity\Grape get($primaryKey, $options = [])
 * @method \App\Model\Entity\Grape newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Grape[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Grape|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Grape saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Grape patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Grape[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Grape findOrCreate($search, callable $callback = null, $options = [])
 */
class GrapesTable extends Table
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

        $this->setTable('grapes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Wines', [
            'foreignKey' => 'grape_id',
            'targetForeignKey' => 'wine_id',
            'joinTable' => 'grapes_wines',
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

        return $validator;
    }
}
