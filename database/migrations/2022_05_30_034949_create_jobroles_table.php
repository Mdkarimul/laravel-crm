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
        Schema::create('jobroles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("job_role",50)->unique();
            $table->string("qualification",100);
            $table->string("certification",100);
            $table->integer("experience");
            $table->float("salary",8,2);
            $table->string("team_name",50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobroles');
    }
};
