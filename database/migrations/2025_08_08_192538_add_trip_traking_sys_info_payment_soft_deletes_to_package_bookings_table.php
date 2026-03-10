<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('package_bookings', function (Blueprint $table) {
            // Additional booking details
            $table->longText('special_requests')->nullable()->after('message');

            // Payment tracking
            $table->enum('payment_status', ['unpaid', 'partial', 'paid'])
                  ->default('unpaid')
                  ->after('status');
            $table->decimal('amount_paid', 10, 2)->nullable()->after('payment_status');
            $table->string('currency', 3)->default('USD')->after('amount_paid');

            // Trip tracking & archiving
            $table->date('trip_start_date')->nullable()->after('custom_date');
            $table->date('trip_end_date')->nullable()->after('trip_start_date');
            $table->boolean('is_archived')->default(false)->after('trip_end_date');

            // System info
            $table->string('booking_reference')->unique()->nullable()->after('is_archived');
            $table->string('ip_address', 45)->nullable()->after('booking_reference');
            $table->string('user_agent')->nullable()->after('ip_address');

            // Audit timestamps
            $table->timestamp('confirmed_at')->nullable()->after('user_agent');
            $table->timestamp('cancelled_at')->nullable()->after('confirmed_at');

            // Soft deletes
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('package_bookings', function (Blueprint $table) {
            $table->dropColumn([
                'special_requests',
                'payment_status',
                'amount_paid',
                'currency',
                'trip_start_date',
                'trip_end_date',
                'is_archived',
                'booking_reference',
                'ip_address',
                'user_agent',
                'confirmed_at',
                'cancelled_at',
                'deleted_at'
            ]);
        });
    }
};
