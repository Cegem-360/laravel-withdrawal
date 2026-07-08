<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('elallas.table', 'elallas_declarations'), function (Blueprint $table): void {
            $table->id();
            $table->string('type')->default('elallas');
            $table->string('consumer_name');
            $table->text('consumer_address');
            $table->string('consumer_email');
            $table->text('subject');
            $table->date('contract_date');
            $table->string('order_reference')->nullable();
            $table->text('message')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->string('ip', 45)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('elallas.table', 'elallas_declarations'));
    }
};
