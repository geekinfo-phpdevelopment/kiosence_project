<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 10);
            $table->date('joining_date');
            $table->date('dob');
            $table->foreignIdFor(User::class)->constrained();
            $table->string('mobile', 14);
            $table->string('gender', 10);
            $table->string('adr_ln1', 100);
            $table->string('adr_ln2', 100);
            $table->string('city', 100);
            $table->string('state', 100);
            $table->tinyInteger('pincode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
