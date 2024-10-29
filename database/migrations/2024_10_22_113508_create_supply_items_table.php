<?php

use App\Models\Medicines;
use App\Models\SupplyHead;
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
        Schema::create('supply_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Medicines::class)->constrained();
            $table->integer('quantity');
            $table->decimal('sgst', 8, 2);
            $table->decimal('cgst', 8, 2);
            $table->decimal('item_total',8,2);
            $table->foreignIdFor(SupplyHead::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supply_items');
    }
};
