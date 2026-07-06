<?php

use Nitro\Database\Schema\SchemaBuilder;

return new class {
    public function up(SchemaBuilder $schema): void
    {
        $schema->create('password_reset_tokens', function ($table) {
            $table->string('email')->unique();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(SchemaBuilder $schema): void
    {
        $schema->dropIfExists('password_reset_tokens');
    }
};
