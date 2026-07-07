<?php

use Nitro\Database\Schema\SchemaBuilder;

return new class {
    public function up(SchemaBuilder $schema): void
    {
        $schema->create('notifications', function ($table) {
            $table->string('id');
            $table->primary('id');
            $table->string('type');
            $table->string('notifiable_type');
            $table->string('notifiable_id');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['notifiable_type', 'notifiable_id']);
        });
    }

    public function down(SchemaBuilder $schema): void
    {
        $schema->dropIfExists('notifications');
    }
};
