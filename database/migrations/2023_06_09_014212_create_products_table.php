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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('description');
            $table->integer('stock');
            $table->integer('price');

            // TODO! Incluir despues para ejemplo de Rollback
            $table->string('image');
            $table->foreignId('category_id')
                
                // TODO: Determina la tabla y la comlumna a la que se hace referencia
                ->constrained()

                // TODO: Indica que si se borra la referencia tambien se borra los datos asociados
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
