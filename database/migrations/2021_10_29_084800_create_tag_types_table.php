<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tag_types'))
        {
            Schema::create('tag_types', function (Blueprint $table) {
                $table->id();
                // $table->addColumn('nvarchar', 'name', ['length'=>64])->unique();
                $table->string('name', 128)->unique();
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
        Schema::dropIfExists('tag_types');
    }
}
