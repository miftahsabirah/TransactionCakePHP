<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VouchersFixture
 */
class VouchersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'nama_voucher' => 'Lorem ipsum dolor sit amet',
                'nilai_minimum' => 1.5,
                'created_at' => '2024-09-11 04:41:56',
                'updated_at' => '2024-09-11 04:41:56',
            ],
        ];
        parent::init();
    }
}
