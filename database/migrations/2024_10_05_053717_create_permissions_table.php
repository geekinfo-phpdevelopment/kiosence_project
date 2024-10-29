<?php

use App\Models\Module;
use App\Models\Role;
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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Role::class)->constrained();
            $table->tinyInteger('permission_id');
            $table->tinyInteger('read');
            $table->tinyInteger('write');
            $table->tinyInteger('edit');
            $table->tinyInteger('delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
