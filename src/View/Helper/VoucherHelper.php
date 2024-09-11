<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Voucher helper
 */
class VoucherHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];
    public function getVoucher(int $quantity): string
    {
        if ($quantity > 10) {
            return 'Voucher Hotel Santika';
        }
        return 'Voucher Belanja Indomaret';
    }

}
