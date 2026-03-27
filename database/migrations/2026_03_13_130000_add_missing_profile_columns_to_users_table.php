<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $columnsToAdd = [
            'role' => fn (Blueprint $table) => $table->enum('role', ['admin', 'employee'])->default('employee')->after('password'),
            'department' => fn (Blueprint $table) => $table->string('department')->nullable()->after('role'),
            'position' => fn (Blueprint $table) => $table->string('position')->nullable()->after('department'),
            'phone' => fn (Blueprint $table) => $table->string('phone')->nullable()->after('position'),
        ];

        foreach ($columnsToAdd as $column => $addColumn) {
            if (!Schema::hasColumn('users', $column)) {
                Schema::table('users', function (Blueprint $table) use ($addColumn) {
                    $addColumn($table);
                });
            }
        }
    }

    public function down(): void
    {
        $columnsToDrop = ['phone', 'position', 'department', 'role'];

        foreach ($columnsToDrop as $column) {
            if (Schema::hasColumn('users', $column)) {
                Schema::table('users', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
