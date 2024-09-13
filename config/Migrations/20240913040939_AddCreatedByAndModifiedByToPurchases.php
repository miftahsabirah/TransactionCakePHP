<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddCreatedByAndModifiedByToPurchases extends AbstractMigration
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
        // Tambahkan kolom created_by dan modified_by ke tabel purchases
        $table = $this->table('purchases');
        
        $table->addColumn('created_by', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true, // Allow null saat initial migration
        ]);

        $table->addColumn('modified_by', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true, // Allow null saat initial migration
        ]);

        // Tambahkan foreign key ke tabel users
        $table->addForeignKey('created_by', 'users', 'id', [
            'delete' => 'SET_NULL', 
            'update' => 'NO_ACTION'
        ]);
        $table->addForeignKey('modified_by', 'users', 'id', [
            'delete' => 'SET_NULL',
            'update' => 'NO_ACTION'
        ]);

        $table->update();
    }
}
