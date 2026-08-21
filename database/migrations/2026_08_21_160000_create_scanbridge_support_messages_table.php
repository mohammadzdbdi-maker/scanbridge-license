<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scanbridge_support_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('scanbridge_support_tickets')->cascadeOnDelete();
            $table->string('sender'); // customer | admin
            $table->text('message');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scanbridge_support_messages');
    }
};
