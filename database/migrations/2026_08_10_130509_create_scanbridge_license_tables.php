<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scanbridge_licenses', function (Blueprint $table) {
            $table->id();
            $table->string('license_key')->unique();
            $table->string('plan')->default('Normal');
            $table->string('customer_name')->nullable();
            $table->string('pharmacy_name')->nullable();
            $table->string('status')->default('active');
            $table->unsignedInteger('max_devices')->default(1);
            $table->timestamp('expires_at')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        Schema::create('scanbridge_activations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('license_id')->constrained('scanbridge_licenses')->cascadeOnDelete();
            $table->string('device_id');
            $table->string('device_name')->nullable();
            $table->string('app_version')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('last_seen_at')->nullable();
            $table->timestamps();

            $table->unique(['license_id', 'device_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scanbridge_activations');
        Schema::dropIfExists('scanbridge_licenses');
    }
};
