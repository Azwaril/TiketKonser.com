<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateCategoryColumnInTicketsTable extends Migration
{
    public function up()
    {
        // Isi data NULL menjadi 'reguler' supaya aman diubah ke ENUM
        DB::table('tickets')
            ->whereNull('category')
            ->update(['category' => 'reguler']);

        // Ubah kolom category jadi ENUM dengan 2 opsi dan default 'reguler'
        Schema::table('tickets', function (Blueprint $table) {
            $table->enum('category', ['vip', 'reguler'])->default('reguler')->change();
        });
    }

    public function down()
    {
        // Kembalikan kolom category ke string biasa (varchar 255)
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('category')->nullable()->change();
        });
    }
}
