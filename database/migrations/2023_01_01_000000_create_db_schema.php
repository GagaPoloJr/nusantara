<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (explode(',', env('DB_SCHEMA')) as $index => $row) {
            if ($row != 'public') {
                try {
                    DB::statement('DROP SCHEMA IF EXISTS ' . $row . ' CASCADE');
                } catch (\Illuminate\Database\QueryException $e) {
                    // Handle the error, log it, or take appropriate action.
                    // For example, you can log the error message.
                    \Log::error('Error dropping schema ' . $row . ': ' . $e->getMessage());
                }
            }
        }

        foreach (explode(',', env('DB_SCHEMA')) as $index => $row) {
            try {
                DB::statement('CREATE SCHEMA IF NOT EXISTS ' . $row);
            } catch (\Illuminate\Database\QueryException $e) {
                // Handle the error, log it, or take appropriate action.
                // For example, you can log the error message.
                \Log::error('Error creating schema ' . $row . ': ' . $e->getMessage());
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (explode(',', env('DB_SCHEMA')) as $index => $row) {
            if ($row != 'public') {
                try {
                    DB::statement('DROP SCHEMA IF EXISTS ' . $row . ' CASCADE');
                } catch (\Illuminate\Database\QueryException $e) {
                    // Handle the error, log it, or take appropriate action.
                    // For example, you can log the error message.
                    \Log::error('Error dropping schema ' . $row . ': ' . $e->getMessage());
                }
            }
        }
    }
};
