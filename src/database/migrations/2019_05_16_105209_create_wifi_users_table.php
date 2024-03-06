<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWifiUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wifi_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();

            /**
             * WLC Fields: Add them in another migration
             * $table->string('client_mac')->after('XXXXXXX')->nullable();
             * $table->string('ap_mac')->after('client_mac')->nullable();
             * $table->string('wlan')->after('ap_mac')->nullable();
             * $table->string('redirect')->after('wlan')->nullable();
             */


            /**
             * Meraki fields: Add them in another migration
             * $table->string('base_grant_url')->after('email')->nullable();
             * $table->string('user_continue_url')->after('base_grant_url')->nullable();
             * $table->string('node_id')->after('user_continue_url')->nullable();
             * $table->string('node_mac')->after('node_id')->nullable();
             * $table->string('gateway_id')->after('node_mac')->nullable();
             * $table->string('client_ip')->after('gateway_id')->nullable();
             * $table->string('client_mac')->after('client_ip')->nullable();
             */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wifi_users');
    }
}
