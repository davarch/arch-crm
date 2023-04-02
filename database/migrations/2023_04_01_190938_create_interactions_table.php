<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interactions', static function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('type');
            $table->mediumText('content')->nullable();

            $table->foreignId('user_id')
                ->nullable()
                ->index()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('contact_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('project_id')
                ->nullable()
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }
};
