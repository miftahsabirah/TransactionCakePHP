<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VouchersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VouchersTable Test Case
 */
class VouchersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VouchersTable
     */
    protected $Vouchers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Vouchers',
        'app.Transaction',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Vouchers') ? [] : ['className' => VouchersTable::class];
        $this->Vouchers = $this->getTableLocator()->get('Vouchers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Vouchers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\VouchersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
