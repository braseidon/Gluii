<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCommentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_status_id_foreign');
            $table->renameColumn('status_id', 'commentable_id');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->string('commentable_type')->index()->after('commentable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->renameColumn('commentable_id', 'status_id');
        });

        // Foreign keys
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
        });
    }
}
