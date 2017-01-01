<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $password_token
 * @property string $email
 * @property string $phone
 * @property string $skype
 * @property string $address
 * @property string $state
 * @property string $country
 * @property \Cake\I18n\Time $last_login
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property bool $status
 * @property string $device_id
 *
 * @property \App\Model\Entity\Device $device
 * @property \App\Model\Entity\FaviorateWine[] $faviorate_wines
 * @property \App\Model\Entity\Ingredient[] $ingredients
 * @property \App\Model\Entity\WineIngredient[] $wine_ingredients
 * @property \App\Model\Entity\Wine[] $wines
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
        '*' => true,
        'id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
    
    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
}
