<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TransactionFixture
 */
class TransactionFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'transaction';
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
                'kode_transaksi' => 'Lorem ipsum dolor ',
                'jenis_transaksi' => 'Lorem ipsum dolor sit amet',
                'customer_id' => 1,
                'total' => 1.5,
                'voucher_id' => 1,
                'tanggal' => '2024-09-11 04:42:06',
                'created_at' => '2024-09-11 04:42:06',
                'updated_at' => '2024-09-11 04:42:06',
            ],
        ];
        parent::init();
    }
}
