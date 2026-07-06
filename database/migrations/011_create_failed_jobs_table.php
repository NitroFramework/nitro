<?php

use Nitro\Database\Schema\SchemaBuilder;

return new class {
    public function up(SchemaBuilder $schema): void
    {
        $schema->create('failed_jobs', function ($table) {
            // UUID primary key so retries from external tools (dashboards,
            // CLI) don't collide if someone manually inserts a row.
            $table->char('id', 36);
            $table->string('queue', 100);
            $table->string('class', 255);
            $table->tinyInteger('attempts')->unsigned();
            $table->text('payload');
            $table->text('exception');
            $table->integer('failed_at')->unsigned();

            $table->primary('id');
            $table->index('failed_at');
            $table->index('queue');
        });
    }

    public function down(SchemaBuilder $schema): void
    {
        $schema->dropIfExists('failed_jobs');
    }
};
