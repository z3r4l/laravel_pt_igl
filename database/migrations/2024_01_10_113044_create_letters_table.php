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
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_letter_id')->constrained('category_letters')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('no_letter');
            $table->string('shipper_name');
            $table->text('shipper_address');
            $table->string('consignee_name');
            $table->text('consignee_address');
            $table->string('consignee_attn');
            $table->string('consignee_phone');
            $table->string('shipment');
            $table->string('total_gross_weight');
            $table->string('total_package');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
