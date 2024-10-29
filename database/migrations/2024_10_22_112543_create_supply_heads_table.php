<?php

use App\Models\Client;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('supply_heads', function (Blueprint $table) {
            $table->id();
            $table->decimal('sub_total', 8, 2);
            $table->foreignIdFor(Client::class)->constrained();
            $table->date('supply_date');
            $table->decimal('sgst', 8, 2);
            $table->decimal('cgst', 8, 2);
            $table->decimal('total', 8, 2);
            $table->string('payment_mode');
            $table->date('due_date');
            $table->tinyInteger('payment_status')->default(1);
            $table->timestamps();
            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supply_heads');
    }
};
