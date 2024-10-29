<?php

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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('email',100);
            $table->string('mobile',13);
            $table->string('adr_ln1', 100);
            $table->string('adr_ln2', 100);
            $table->string('city', 100);
            $table->string('state', 100);
            $table->integer('pincode');
            $table->string('contact_person');
            $table->string('contact_mobile');
            $table->timestamps();
            $table->tinyInteger(column: 'status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
