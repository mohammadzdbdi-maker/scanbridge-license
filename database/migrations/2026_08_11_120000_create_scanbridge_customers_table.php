<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scanbridge_customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile')->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::table('scanbridge_licenses', function (Blueprint $table) {
            $table->foreignId('customer_id')->nullable()->after('id')->constrained('scanbridge_customers')->nullOnDelete();
        });

        Schema::table('scanbridge_purchase_requests', function (Blueprint $table) {
            $table->foreignId('customer_id')->nullable()->after('id')->constrained('scanbridge_customers')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('scanbridge_purchase_requests', function (Blueprint $table) {
            $table->dropConstrainedForeignId('customer_id');
        });

        Schema::table('scanbridge_licenses', function (Blueprint $table) {
            $table->dropConstrainedForeignId('customer_id');
        });

        Schema::dropIfExists('scanbridge_customers');
    }
};
