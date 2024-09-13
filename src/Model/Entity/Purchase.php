<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Purchase Entity
 *
 * @property int $id
 * @property string $transaction_code
 * @property \Cake\I18n\FrozenDate $date
 * @property int $customer_id
 * @property int $motorcycle_id
 * @property int $quantity
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Motorcycle $motorcycle
 */
class Purchase extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'transaction_code' => true,
        'date' => true,
        'customer_id' => true,
        'motorcycle_id' => true,
        'quantity' => true,
        'customer' => true,
        'motorcycle' => true,
        'created_by' => true,
        'modified_by' => true,
    ];
}
