<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', static function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('title');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('preferred_name');
            $table->string('email');
            $table->string('phone');
            $table->softDeletes();
            $table->timestamps();
        });
    }
};
