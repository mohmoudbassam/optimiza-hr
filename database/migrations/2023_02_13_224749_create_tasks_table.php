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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->integer('percentage')->nullable();
            $table->foreignId('bill_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->double('hours')->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->double('paid')->nullable();
            $table->softDeletes();


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
        Schema::dropIfExists('tasks');
    }
};
