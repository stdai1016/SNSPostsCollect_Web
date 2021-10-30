<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeywordsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('keywords_tags'))
        {
            Schema::create('keywords_tags', function (Blueprint $table) {
                $table->id();
                $table->foreignId('keyword_id')
                    ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('tag_id')
                    ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->unique(['keyword_id', 'tag_id']);
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
        Schema::dropIfExists('keywords_tags');
    }
}
