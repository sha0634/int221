<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('client_email');
            $table->foreignId('portfolio_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('status')->default('pending'); // 'pending', 'active', 'completed', 'declined'
            $table->timestamp('signed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->nullable()->constrained()->onDelete('set null');
            $table->string('client_email');
            $table->foreignId('portfolio_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->decimal('amount', 10, 2);
            $table->date('due_date');
            $table->string('status')->default('unpaid'); // 'unpaid', 'paid', 'overdue'
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('contracts');
    }
};
