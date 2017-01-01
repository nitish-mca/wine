<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Wine Entity
 *
 * @property int $id
 * @property string $title
 * @property int $category_id
 * @property string $photo
 * @property string $dir
 * @property string $description
 * @property bool $status
 * @property int $user_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\FaviorateWine[] $faviorate_wines
 * @property \App\Model\Entity\WineIngredient[] $wine_ingredients
 */
class Wine extends Entity
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
