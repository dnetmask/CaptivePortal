<?php

namespace Netmask\CautivePortal\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Netmask\CautivePortal\CautivePortalServiceProvider;
use Symfony\Component\Console\Input\InputOption;
use TCG\Voyager\Traits\Seedable;

class InstallCommand extends Command
{
    use Seedable;

    protected $seedersPath = __DIR__.'/../database/seeds/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cautiveportal:install {--replace}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Netmask Cautive Portal package';

    protected function getOptions()
    {
        return [
            ['replace', null, InputOption::VALUE_NONE, 'Replace publishable files', null],
        ];
    }
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {

        $this->info('Publishing CautivePortal');

        $options = ['--provider' => CautivePortalServiceProvider::class];

        if ($this->option('replace')) {
            $options [] = ['--force', $this->option('replace')];
        }

        $this->call('vendor:publish', $options);

        /*$this->info('Seeding CautivePortal data into the database');
        $this->seed('WifiUsersTableSeeder');*/

        $this->info('Adding CautivePortal routes to routes/web.php');
        $routes_contents = $filesystem->get(base_path('routes/web.php'));

        if (false === strpos($routes_contents, 'cautiveportal_routes')) {
            $filesystem->append(
                base_path('routes/web.php'),
                "\n\ncautiveportal_routes();\n"
            );
        }

        $this->info('Adding cautiveportal.sass to resources/sass/app.scss');
        $routes_contents = $filesystem->get(base_path('resources/sass/app.scss'));

        if (false === strpos($routes_contents, 'cautiveportal.sass')) {
            $filesystem->append(
                base_path('resources/sass/app.scss'),
                "\n\n// Cautive portal css\n@import 'cautiveportal.sass';\n"
            );
        }
    }
}
