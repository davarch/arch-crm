<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_titles', static function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name');
            $table->timestamps();
        });
    }
};
