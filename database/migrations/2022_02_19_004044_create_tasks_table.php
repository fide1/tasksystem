<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
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
            $table->string('name');
            $table->integer('department_id')->nullable();
            $table->enum('type', ['public', 'private'])->default('public');
            $table->enum('priority', ['1', '2', '3', '4', '5']);
            $table->date('dueDate');
            $table->enum('status', ['on-going', 'not-going'])->default('on-going');
            $table->integer('done')->nullable();
            $table->string('createdBy');
            $table->string('assignedTo')->nullable();
            $table->string('comments')->nullable();
            $table->string('file_name')->nullable();
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
}
