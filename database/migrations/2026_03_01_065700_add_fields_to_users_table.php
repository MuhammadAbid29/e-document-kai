<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('nip')->unique()->nullable()->after('id');

            $table->foreignId('divisi_id')
                  ->nullable()
                  ->constrained('divisis')
                  ->cascadeOnDelete();

            $table->string('role')->default('user');

        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn('nip');
            $table->dropColumn('role');
            $table->dropConstrainedForeignId('divisi_id');

        });
    }
};