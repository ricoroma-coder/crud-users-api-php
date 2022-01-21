<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $this->table('users', ['id' => false, 'primary_key' => 'id'])
            ->addColumn('id', 'biginteger', [
                'identity' => true
            ])
            ->addColumn('name', 'string', [
                'null' => false
            ])
            ->addColumn('address', 'string', [
                'null' => false
            ])
            ->addColumn('city', 'string', [
                'null' => false
            ])
            ->addColumn('state', 'string', [
                'null' => false
            ])
            ->addIndex(['name'], ['unique' => true])
            ->create();
    }
}
