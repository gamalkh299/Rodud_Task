<?php

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
        Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('size');
                $table->decimal('weight', 8, 2);
                $table->string('weight_unit');
                $table->string('loading_location');
                $table->string('delivery_location');
                $table->timestamp('pickup_time');
                $table->timestamp('delivery_time');
                $table->enum('order_status', ['Pending', 'In Progress', 'Shipped', 'Delivered', 'Canceled', 'Returned'])->default('Pending');
                $table->enum('truck_type', ['Small', 'Medium', 'Large', 'Extra Large'])->default('Small');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
