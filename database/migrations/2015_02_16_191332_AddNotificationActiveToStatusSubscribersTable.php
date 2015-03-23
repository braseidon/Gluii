<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotificationActiveToStatusSubscribersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('status_subscribers', function (Blueprint $table) {
            $table->boolean('notifications')->default(1)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('status_subscribers', function (Blueprint $table) {
            $table->dropColumn('notifications');
        });
    }
}
