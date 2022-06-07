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
        Schema::create('company_registrations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->String('company_name',85);
            $table->String('company_slug',85);
            $table->String("tagline",100)->nullable();
            $table->String("website",100)->nullable();
            $table->String("company_email",100);
            $table->String("founder",85);
            $table->String("founder_email",100);
            $table->bigInteger("contact_number");
            $table->String("street_address");
            $table->String("city",85);
            $table->String("state",85);
            $table->String("country",85);
            $table->bigInteger("pin_code");
            $table->String("gstin",20)->nullable();
            $table->time("office_start_at");
            $table->time("office_end_at");
            $table->date("company_estd");
            $table->String("facebook_url")->nullable();
            $table->String("twitter_url")->nullable();
            $table->bigInteger("whats_app")->nullable();
            $table->String("category",50);
            $table->String("erp_url");
            $table->String("password",70);
            $table->String("admin_mac_address",200)->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_registrations');
    }
};
