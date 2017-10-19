<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\AttendancesTable|\Cake\ORM\Association\HasMany $Attendances
 * @property \App\Model\Table\DesobsessionsTable|\Cake\ORM\Association\HasMany $Desobsessions
 * @property \App\Model\Table\PassesTable|\Cake\ORM\Association\HasMany $Passes
 * @property \App\Model\Table\PatientsTable|\Cake\ORM\Association\HasMany $Patients
 * @property \App\Model\Table\StudentsTable|\Cake\ORM\Association\HasMany $Students
 * @property \App\Model\Table\SurgeriesTable|\Cake\ORM\Association\HasMany $Surgeries
 * @property \App\Model\Table\WorkersTable|\Cake\ORM\Association\HasMany $Workers
 * @property \App\Model\Table\ProfilesTable|\Cake\ORM\Association\BelongsToMany $Profiles
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Attendances', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Desobsessions', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Passes', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Patients', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Surgeries', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Workers', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsToMany('Profiles', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'profile_id',
            'joinTable' => 'profiles_users'
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
            ->scalar('login')
            ->requirePresence('login', 'create')
            ->notEmpty('login')
            ->add('login', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->email('email')
            ->allowEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('password')
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->integer('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->integer('excluded')
            ->requirePresence('excluded', 'create')
            ->notEmpty('excluded');

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
        $rules->add($rules->isUnique(['login']));
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
