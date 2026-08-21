<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scanbridge_support_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('scanbridge_customers')->cascadeOnDelete();
            $table->foreignId('license_id')->nullable()->constrained('scanbridge_licenses')->nullOnDelete();
            $table->string('original_filename');
            $table->string('stored_path');
            $table->text('customer_note')->nullable();
            $table->string('status')->default('new'); // new | answered | closed
            $table->text('admin_reply')->nullable();
            $table->timestamp('replied_at')->nullable();
            $table->timestamp('delivered_to_app_at')->nullable();
            $table->timestamps();
        });

        Schema::create('scanbridge_update_history', function (Blueprint $table) {
            $table->id();
            $table->string('version');
            $table->text('message')->nullable();
            $table->string('url')->nullable();
            $table->timestamp('published_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scanbridge_update_history');
        Schema::dropIfExists('scanbridge_support_tickets');
    }
};
