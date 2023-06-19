<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->string('matricule');
            $table->string('status');
            $table->date('tech_visit');
            $table->string('model');
            $table->float('tax');
            $table->integer('nb_places');
            $table->float('total_price');
            $table->float('paid_price');
            $table->float('monthly_price');
            $table->foreignId('driver_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete()
            ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transports');
    }
};
