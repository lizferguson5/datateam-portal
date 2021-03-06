<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Asset Entity
 *
 * @property int $id
 * @property string $asset_uid
 * @property string $type
 * @property int $mobile
 * @property string $description_of_equipment
 * @property string $manufacturer
 * @property string $model
 * @property string $manufacturer_serial_no
 * @property string $firmware_version
 * @property \Cake\I18n\Time $acquisition_date
 * @property float $original_cost
 * @property string $comments
 */
class Asset extends Entity
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
