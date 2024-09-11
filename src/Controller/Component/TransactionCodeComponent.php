<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

/**
 * TransactionCode component
 */
class TransactionCodeComponent extends Component
{
    public function generateTransactionCode(string $transactionDate, string $prefix, string $tableName): string
    {
        // Ambil tahun dan bulan dari tanggal transaksi
        $currentYear = date('y', strtotime($transactionDate)); // Dua digit tahun
        $currentMonth = date('m', strtotime($transactionDate)); // Dua digit bulan

        // Tentukan tabel transaksi yang akan digunakan
        $table = TableRegistry::getTableLocator()->get($tableName);

        // Cari nomor urut terakhir untuk bulan dan tahun yang sama
        $lastTransaction = $table->find()
            ->select(['transaction_code'])
            ->where([
                'YEAR(date)' => $currentYear + 2000,
                'MONTH(date)' => $currentMonth
            ])
            ->order(['transaction_code' => 'DESC'])
            ->first();

        $lastCode = $lastTransaction ? $lastTransaction->transaction_code : null;

        // Mengatur nomor urut berdasarkan transaksi terakhir
        if ($lastCode) {
            // Ambil nomor urut terakhir (4 digit terakhir)
            $lastNumberStr = substr($lastCode, -4);
            if (is_numeric($lastNumberStr)) {
                $lastNumber = (int)$lastNumberStr;
                $newNumber = str_pad((string)($lastNumber + 1), 4, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '0001';
            }
        } else {
            $newNumber = '0001';
        }

        // Kembalikan kode transaksi dengan format [Prefix][Tahun][Bulan][Nomor Urut]
        return $prefix . $currentYear . $currentMonth . $newNumber;
    }
}
