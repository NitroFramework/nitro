<?php

use Nitro\Database\Schema\SchemaBuilder;

return new class {
    public function up(SchemaBuilder $schema): void
    {
        if ($schema::hasColumn('users', 'email_verified_at')) {
            return;
        }

        $schema->table('users', function ($table) {
            $table->timestamp('email_verified_at')->nullable();
        });
    }

    public function down(SchemaBuilder $schema): void
    {
        // Column drop omitted: the schema builder's ALTER path doesn't expose a
        // dropColumn here, and leaving the nullable column is harmless on rollback.
    }
};
