<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftdeleteAndPostStatusToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('users', 'deleted_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->softDeletes();
            });
        }

        if(!Schema::hasColumn('blog_categories', 'deleted_at')) {
            Schema::table('blog_categories', function (Blueprint $table) {
                $table->string('avatar')->nullable();
                $table->softDeletes();
            });
        }

        if(!Schema::hasColumn('blogs', 'deleted_at')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->string('status')->default('PENDING');
                $table->softDeletes();
            });
        }

        if(!Schema::hasColumn('comments', 'deleted_at')) {
            Schema::table('comments', function (Blueprint $table) {
                $table->softDeletes();
            });
        }

        if(!Schema::hasColumn('users', 'deleted_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
