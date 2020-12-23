<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Wine Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $color_id
 * @property int $country_id
 * @property int $region_id
 * @property int $vineyard_id
 * @property int $year_id
 * @property string $name
 * @property float $price
 * @property string $description
 * @property int $rating_AVG
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Color $color
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\Grape $grape
 * @property \App\Model\Entity\Region $region
 * @property \App\Model\Entity\Vineyard $vineyard
 * @property \App\Model\Entity\Year $year
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
        'user_id' => true,
        'color_id' => true,
        'country_id' => true,
        'region_id' => true,
        'vineyard_id' => true,
        'year_id' => true,
        'name' => true,
        'price' => true,
        'description' => true,
        'rating_AVG' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'color' => true,
        'country' => true,
        'grapes' => true,
        'region' => true,
        'vineyard' => true,
        'year' => true,
	'files' => true,
    ];
}
