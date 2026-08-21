<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scanbridge_otps', function (Blueprint $table) {
            $table->id();
            $table->string('mobile', 20)->index();
            $table->string('code', 10);
            $table->string('purpose', 30);
            $table->unsignedTinyInteger('attempts')->default(0);
            $table->timestamp('expires_at');
            $table->timestamp('used_at')->nullable();
            $table->timestamps();

            $table->index(['mobile', 'purpose']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scanbridge_otps');
    }
};
