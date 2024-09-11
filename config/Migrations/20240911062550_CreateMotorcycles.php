<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateMotorcycles extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('motorcycles');
        $table->addColumn('brand', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('model', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('year', 'year', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
