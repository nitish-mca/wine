<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FaviorateWine Entity
 *
 * @property int $id
 * @property int $wine_id
 * @property int $user_id
 * @property bool $status
 *
 * @property \App\Model\Entity\Wine $wine
 * @property \App\Model\Entity\User $user
 */
class FaviorateWine extends Entity
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
}
