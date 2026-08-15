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
        Schema::table('quiz_types', function (Blueprint $table) {
            $table->text('description')->nullable()->after('slug');
        });
    }

    public function down()
    {
        Schema::table('quiz_types', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
