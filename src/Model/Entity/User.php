<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $login
 * @property string $email
 * @property string $password
 * @property int $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $excluded
 *
 * @property \App\Model\Entity\Attendance[] $attendances
 * @property \App\Model\Entity\Desobsession[] $desobsessions
 * @property \App\Model\Entity\Pass[] $passes
 * @property \App\Model\Entity\Patient[] $patients
 * @property \App\Model\Entity\Student[] $students
 * @property \App\Model\Entity\Surgery[] $surgeries
 * @property \App\Model\Entity\Worker[] $workers
 * @property \App\Model\Entity\Profile[] $profiles
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'login' => true,
        'email' => true,
        'password' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'excluded' => true,
        'attendances' => true,
        'desobsessions' => true,
        'passes' => true,
        'patients' => true,
        'students' => true,
        'surgeries' => true,
        'workers' => true,
        'profiles' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
