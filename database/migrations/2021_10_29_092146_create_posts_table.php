<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        if (!Schema::hasTable('posts'))
        {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('author_id')
                    ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('replied_to')->nullable()
                    ->constrained('posts')->cascadeOnUpdate()->cascadeOnDelete();
                // $table->addColumn('nvarchar', 'text', ['length'=>500])->nullable();
                $table->string('text', 1000)->nullable();
                $table->string('referred_to', 255)->nullable();
                $table->dateTime('created_at')->nullable();
                $table->dateTime('updated_at')->nullable();
                $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
