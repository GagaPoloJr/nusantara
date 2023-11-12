<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\PermissionRegistrar;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $teams = config('permission.teams');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }
        if ($teams && empty($columnNames['team_foreign_key'] ?? null)) {
            throw new \Exception('Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->bigIncrements('access_id'); // permission id
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name'); // For MySQL 8.0 use string('guard_name', 125);
            $table->timestamps();
            $table->string('description')->nullable();       // For MySQL 8.0 use string('name', 125);
            $table->string('create_by')->nullable();       // For MySQL 8.0 use string('name', 125);
            $table->string('update_by')->nullable();       // For MySQL 8.0 use string('name', 125);
            $table->boolean('deleted')->nullable();
            $table->string('delete_by')->nullable();       // For MySQL 8.0 use string('name', 125);
            $table->timestamp('delete_date')->nullable();       // For MySQL 8.0 use string('name', 125);
            $table->string('delete_reason')->nullable();       // For MySQL 8.0 use string('name', 125);

            $table->unique(['name', 'guard_name']);
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) use ($teams, $columnNames, $tableNames) {
            $table->bigIncrements('group_id'); // role id
            if ($teams || config('permission.testing')) { // permission.testing is a fix for sqlite testing
                $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
                $table->index($columnNames['team_foreign_key'], str_replace('.','_',$tableNames['roles']).'_team_foreign_key_index');
            }
            $table->string('name');
            $table->string('guard_name');
            $table->string('company_id')->nullable();
            $table->boolean('visible')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->string('description')->nullable();
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->boolean('deleted')->nullable();
            $table->string('delete_by')->nullable();
            $table->timestamp('delete_date')->nullable();
            $table->string('delete_reason')->nullable();
            if ($teams || config('permission.testing')) {
                $table->unique([$columnNames['team_foreign_key'], 'name', 'guard_name']);
            } else {
                $table->unique(['name', 'guard_name']);
            }
            $table->foreign('company_id')
                ->references('company_id')
                ->on('core.companys')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotPermission);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_'.str_replace('.','_',$tableNames['permissions']).'_model_id_model_type_index');

            $table->foreign(PermissionRegistrar::$pivotPermission)
                ->references('access_id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_model_has_'.str_replace('.','_',$tableNames['permissions']).'_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], PermissionRegistrar::$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_model_has_'.str_replace('.','_',$tableNames['permissions']).'_permission_model_type_primary');
            } else {
                $table->primary([PermissionRegistrar::$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_model_has_'.str_replace('.','_',$tableNames['permissions']).'_permission_model_type_primary');
            }

        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotRole);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->boolean('is_admin')->default(true);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_'.str_replace('.','_',$tableNames['roles']).'_model_id_model_type_index');

            $table->foreign(PermissionRegistrar::$pivotRole)
                ->references('group_id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_'.str_replace('.','_',$tableNames['roles']).'_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], PermissionRegistrar::$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_'.str_replace('.','_',$tableNames['roles']).'_role_model_type_primary');
            } else {
                $table->primary([PermissionRegistrar::$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_'.str_replace('.','_',$tableNames['roles']).'_role_model_type_primary');
            }
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotPermission);
            $table->unsignedBigInteger(PermissionRegistrar::$pivotRole);

            $table->foreign(PermissionRegistrar::$pivotPermission)
                ->references('access_id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign(PermissionRegistrar::$pivotRole)
                ->references('group_id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary([PermissionRegistrar::$pivotPermission, PermissionRegistrar::$pivotRole], 'role_has_model_has_'.str_replace('.','_',$tableNames['permissions']).'_permission_id_role_id_primary');
        });

        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::dropIfExists($tableNames['role_has_permissions']);
        Schema::dropIfExists($tableNames['model_has_permissions']);
        Schema::dropIfExists($tableNames['model_has_roles']);
        Schema::dropIfExists($tableNames['roles']);
        Schema::dropIfExists($tableNames['permissions']);
    }
}
