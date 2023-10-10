<?php

use App\Models\Copy;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('copies', function (Blueprint $table) {
            $table->id('copy_id');
            $table->boolean('hardcovered')->default(0);    //0 puha, 1 kemeny
            $table->integer('status')->default(0);  //0 konyvtarban, 1 felhasznalonal, 2 selejtes
            $table->year('publication');
            $table->foreignId('book_id')->references('book_id')->on('books');
            $table->timestamps();
        });

        Copy::create([
            'publication' => 2020,
            'book_id' => 1
        ]);

        Copy::create([
            'publication' => 2000,
            'book_id' => 2
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copies');
    }
};
