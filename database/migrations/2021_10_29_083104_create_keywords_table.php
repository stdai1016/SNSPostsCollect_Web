<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('keywords'))
        {
            Schema::create('keywords', function (Blueprint $table) {
                $table->id();
                // $table->addColumn('nvarchar', 'word', ['length'=>64])->unique();
                $table->string('word', 128)->unique();
                // $table->addColumn('nvarchar', 'description', ['length'=>500])
                $table->string('description', 1000)
                    ->nullable();
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
        Schema::dropIfExists('keywords');
    }
}
