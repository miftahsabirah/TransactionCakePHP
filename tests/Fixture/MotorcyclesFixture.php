<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MotorcyclesFixture
 */
class MotorcyclesFixture extends TestFixture
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
                'brand' => 'Lorem ipsum dolor sit amet',
                'model' => 'Lorem ipsum dolor sit amet',
                'year' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
