<?php
// app/Database/Migrations/001_create_users_table.php
/**
 * Create Users Table Migration
 * 
 * 
 */

use Nitro\Database\Schema\SchemaBuilder;

return new class {
    public function up(SchemaBuilder $schema): void
    {
        $schema->create('users', function($table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status', 20)->default('active');
            $table->timestamps();
            
            $table->index(['status', 'created_at']);
        });
    }

    public function down(SchemaBuilder $schema): void
    {
        $schema->dropIfExists('users');
    }
};