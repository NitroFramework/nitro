<?php

use Nitro\Database\Schema\SchemaBuilder;

return new class {
    public function up(SchemaBuilder $schema): void
    {
        $schema->create('jobs', function ($table) {
            $table->id();
            $table->string('queue', 100)->default('default');
            $table->text('payload');
            $table->tinyInteger('attempts')->unsigned()->default(0);
            $table->integer('reserved_at')->unsigned()->nullable();
            $table->integer('available_at')->unsigned();
            $table->integer('created_at')->unsigned();

            // Hot path for pop(): "find the next runnable row for THIS queue."
            // Composite covers the WHERE + ORDER BY id.
            $table->index(['queue', 'reserved_at']);
            $table->index('available_at');
        });
    }

    public function down(SchemaBuilder $schema): void
    {
        $schema->dropIfExists('jobs');
    }
};
