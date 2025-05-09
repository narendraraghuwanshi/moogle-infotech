<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('real_estates', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->enum('real_state_type', ['house', 'department', 'land', 'commercial_ground']);
            $table->string('street', 128);
            $table->string('external_number', 12);
            $table->string('internal_number')->nullable();
            $table->string('neighborhood', 128);
            $table->string('city', 64);
            $table->string('country', 2)->comment('ISO 3166-Alpha2');
            $table->integer('rooms');
            $table->decimal('bathrooms', 5, 2);
            $table->text('comments')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Add validation constraints
            $table->unique(['street', 'external_number', 'internal_number', 'city']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('real_estates');
    }
};
