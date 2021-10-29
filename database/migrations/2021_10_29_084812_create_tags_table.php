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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->addColumn('nvarchar', 'name', ['length'=>64])->unique();
            $table->foreignId('type_id')->nullable()
                  ->constrained('tag_types')->cascadeOnUpdate()->nullOnDelete();
            $table->boolean('blocked')->nullable();
            $table->addColumn('nvarchar', 'description', ['length' => 500])
                  ->nullable();
        });
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
