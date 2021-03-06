<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tags'))
        {
            Schema::create('tags', function (Blueprint $table) {
                $table->id();
                $table->string('name', 128)->unique();
                $table->foreignId('type_id')->nullable()
                    ->constrained('tag_types')->cascadeOnUpdate()->nullOnDelete();
                $table->string('description', 1000)->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
