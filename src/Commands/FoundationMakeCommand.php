<?php

namespace Wiltechs\Foundation\Commands;

use Illuminate\Console\Command;

class FoundationMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'foundation:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Foundation Make';

    protected $loggerHandler;

    /**
     * FoundationServiceCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Handle
     *
     */
    public function handle()
    {
        $this->createDirectories();
        if (!file_exists(base_path('config/foundation.php'))) {
            copy(
                __DIR__ . '/stubs/config/foundation.php',
                base_path('config/foundation.php')
            );
        }

        if (file_exists(base_path(config('foundation.models_namespace') . '/Position.php'))) {
            $this->error(base_path(config('foundation.models_namespace') . '/Position.php') . ' has exits');
            return;
        }

        if (file_exists(base_path(config('foundation.models_namespace') . '/Unit.php'))) {
            $this->error(base_path(config('foundation.models_namespace') . '/Unit.php') . ' has exits');
            return;
        }

        if (file_exists(base_path(config('foundation.models_namespace') . '/Staff.php'))) {
            $this->error(base_path(config('foundation.models_namespace') . '/Staff.php') . ' has exits');
            return;
        }




        copy(
            __DIR__ . '/stubs/migrations/2020_10_02_004238_create_staff_table.php',
            database_path('migrations/2020_10_02_004238_create_staff_table.php')
        );

        copy(
            __DIR__ . '/stubs/migrations/2020_10_02_004310_create_position_table.php',
            database_path('migrations/2020_10_02_004310_create_position_table.php')
        );

        copy(
            __DIR__ . '/stubs/migrations/2020_10_02_004253_create_unit_table.php',
            database_path('migrations/2020_10_02_004253_create_unit_table.php')
        );

        file_put_contents(
            base_path(config('foundation.models_namespace') . '/Staff.php'),
            $this->compileStaffModelStub()
        );

        file_put_contents(
            base_path(config('foundation.models_namespace') . '/Unit.php'),
            $this->compileUnitModelStub()
        );

        file_put_contents(
            base_path(config('foundation.models_namespace') . '/Position.php'),
            $this->compilePositionModelStub()
        );

        $this->info('successfully.');
    }

    /**
     * 创建目录
     */
    protected function createDirectories()
    {
        if (!is_dir($directory = base_path(config('foundation.models_namespace')))) {
            mkdir($directory, 0755, true);
        }

        if (!is_dir($directory = 'database\migrations')) {
            mkdir($directory, 0755, true);
        }
    }

    protected function compileStaffModelStub()
    {
        return str_replace(
            '{{namespace}}',
            config('foundation.models_namespace'),
            file_get_contents(__DIR__ . '/stubs/models/Staff.stub')
        );
    }


    protected function compilePositionModelStub()
    {
        return str_replace(
            '{{namespace}}',
            config('foundation.models_namespace'),
            file_get_contents(__DIR__ . '/stubs/models/Position.stub')
        );
    }

    protected function compileUnitModelStub()
    {
        return str_replace(
            '{{namespace}}',
            config('foundation.models_namespace'),
            file_get_contents(__DIR__ . '/stubs/models/Unit.stub')
        );
    }
}
