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
        Schema::create('banned_posts', function (Blueprint $table) {
            $table->foreignId('admin_id');
            $table->foreignId('user_id');
            $table->foreignId('post_id');
            $table->text('reason');
            $table->enum('status', ['Active', 'Post Deleted']);
            $table->timestamp('added_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banned_posts');
    }
};
