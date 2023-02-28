<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('complexity');
            $table->unsignedBigInteger('difficulty_id')->after('type_id');
            $table->foreign('difficulty_id')->references('id')->on('difficulties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->tinyInteger('complexity')->after('preview');
            $table->dropForeign('projects_difficulty_id_foreign');
            $table->dropColumn('difficulty_id');
        });
    }
};
