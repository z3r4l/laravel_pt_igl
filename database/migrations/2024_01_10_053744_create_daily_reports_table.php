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
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->id();
            $table->string('type_document');
            $table->string('no_pendaftaran');
            $table->string('date_document');
            $table->string('shipper');
            $table->string('consignee');
            $table->string('name_vessel');
            $table->string('voy');
            $table->string('no_tax')->nullable();
            $table->string('date_faktur')->nullable();
            $table->string('no_bl');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_reports');
    }
};
