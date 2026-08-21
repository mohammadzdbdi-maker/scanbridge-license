<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scanbridge_prices', function (Blueprint $table) {
            $table->id();
            $table->string('plan');
            $table->unsignedInteger('duration_months');
            $table->unsignedBigInteger('price')->default(0);
            $table->timestamps();
            $table->unique(['plan', 'duration_months']);
        });

        Schema::create('scanbridge_plan_device_pricing', function (Blueprint $table) {
            $table->id();
            $table->string('plan')->unique();
            $table->unsignedInteger('base_devices')->default(1);
            $table->unsignedBigInteger('price_per_extra_device')->default(0);
            $table->timestamps();
        });

        $plans = ['Normal', 'Ttac', 'TtacPlus'];
        $durations = [1, 3, 6, 12];
        $now = now();

        $priceRows = [];
        foreach ($plans as $plan) {
            foreach ($durations as $d) {
                $priceRows[] = [
                    'plan' => $plan,
                    'duration_months' => $d,
                    'price' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }
        $priceRows[] = [
            'plan' => 'Trial',
            'duration_months' => 0,
            'price' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ];
        DB::table('scanbridge_prices')->insert($priceRows);

        $deviceRows = [];
        foreach (array_merge($plans, ['Trial']) as $plan) {
            $deviceRows[] = [
                'plan' => $plan,
                'base_devices' => 1,
                'price_per_extra_device' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('scanbridge_plan_device_pricing')->insert($deviceRows);
    }

    public function down(): void
    {
        Schema::dropIfExists('scanbridge_plan_device_pricing');
        Schema::dropIfExists('scanbridge_prices');
    }
};
