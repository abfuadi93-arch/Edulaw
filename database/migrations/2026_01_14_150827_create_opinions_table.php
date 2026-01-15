<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opinions', function (Blueprint $table) {
            $table->id();

            // relasi ke user (nullable -> boleh submit tanpa login)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // untuk guest submission
            $table->string('guest_name')->nullable();
            $table->string('guest_email')->nullable();

            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');

            // workflow status
            $table->string('status')->default('submitted'); // submitted|reviewed|published|rejected
            $table->timestamp('published_at')->nullable();

            // catatan admin saat moderasi
            $table->text('admin_note')->nullable();

            $table->timestamps();

            $table->index(['status', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opinions');
    }
};
