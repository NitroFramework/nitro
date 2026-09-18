<?php

use Nitro\Database\Schema\SchemaBuilder;

/**
 * Storage for the "database" session driver.
 *
 * Only needed when SESSION_DRIVER=database; the file, redis and native drivers
 * do not read this table.
 */
return new class {
    public function up(SchemaBuilder $schema): void
    {
        $schema->create('sessions', function ($table) {
            $table->string('id', 128);
            $table->text('payload');
            $table->integer('last_activity')->unsigned();

            $table->primary('id');

            // The sweep deletes by last_activity and nothing else, so it is the
            // one column worth indexing.
            $table->index('last_activity');
        });
    }

    public function down(SchemaBuilder $schema): void
    {
        $schema->dropIfExists('sessions');
    }
};
