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
        Schema::create('tbl_process_definitions', function (Blueprint $table) {
            $table->id();
            $table->string('process_code', 20)->unique();
            $table->text('process_description');
            $table->enum('user_type', [
                'super_admin', 
                'admin_erb', 
                'admin_iacuc', 
                'pi', 
                'reviewer_erb',
                'reviewer_iacuc'
            ]);
            $table->enum('direction', ['in', 'out']);
            $table->integer('sequence_order');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['user_type', 'sequence_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_process_definitions');
    }
};
