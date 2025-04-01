<?php

namespace SIENSIS\CICMDTools\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class RebootDB extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Database';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'db:reboot';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Drop all data in tables or drop all tables';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'db:reboot';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [
        '--default' => 'Mode non interactive with all questions by default',
        '--all'     => 'Mode non interactive with all questions by default and migrate all',
    ];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $mode = 0; // 0=interactive 1=default questions 2=default questions and migrate all

        if (CLI::getOption('default')) {
            $mode = 1;
        } elseif (CLI::getOption('all')) {
            $mode = 2;
        } elseif (count($params) > 0 && $params[0] == 'nonui') { // Param to FIX CI4 error when call command from controller
            $mode = 2;
        }

        if ($mode == 0) {
            $howToRemove = CLI::prompt('drop Tables or remove Data?', ['t', 'D']);
            CLI::newLine();
        } else {
            $howToRemove = 't';
        }

        $db = \Config\Database::connect();
        $forge = \Config\Database::forge();
        CLI::write(CLI::color("Connecting to DB...", 'green'));

        $tables = $db->listTables();

        foreach ($tables as $table) {
            if ($howToRemove == 't') {
                $forge->dropTable($table);
                CLI::write('Drop table: ' . CLI::color($table, 'green'));
            } elseif ($howToRemove == 'D') {
                $db->table($table)->emptyTable();
                CLI::write('Empty table: ' . CLI::color($table, 'green'));
            }
        }

        if ($howToRemove == 't') {

            CLI::newLine();

            if ($mode == 0) {
                $migrate = CLI::prompt('Would you like to migrate DB?', ['y', 'n']);
            } else {
                $migrate = 'y';
            }

            if ($migrate == 'y') {

                if ($mode == 0) {
                    $migrate_all = CLI::prompt('Migrate all?', ['n', 'y']);
                } elseif ($mode == 2) {
                    $migrate_all = 'y';
                } else {
                    $migrate_all = 'n';
                }

                if ($migrate_all == 'y') {
                    echo command('migrate -all');
                } else {
                    echo command('migrate');
                }
            }
        }

        if (class_exists('App\Database\Seeds\Install')) {
            CLI::newLine();

            if ($mode == 0)
                $fillData = CLI::prompt('Would you like to populate data. Execute seeder install?', ['y', 'n']);
            else
                $fillData = 'y';

            if ($fillData == 'y') {
                CLI::write(CLI::color("Running seeder install to DB...", 'green'));
                echo command('db:seed Install');
                CLI::write(CLI::color("Seeder install executed.", 'green'));
                CLI::newLine();
            }
        } else {
            CLI::newLine();

            if ($mode == 0)
                $executeSeeders = CLI::prompt('Would you like to execute seeders?', ['y', 'n']);
            else
                $executeSeeders = 'y';

            if ($executeSeeders == 'y') {
                CLI::write(CLI::color("Running seeders to DB...", 'green'));
                $this->executeSeeders();
                CLI::write(CLI::color("Seeders executed.", 'green'));
                CLI::newLine();
            }
        }
    }

    public function executeSeeders()
    {

        $files = new \CodeIgniter\Files\FileCollection();

        $files->addDirectory(APPPATH . 'Database/Seeds');
        $files->removePattern('#^\.#');


        foreach ($files as $file) {
            $seeder = $file->getBasename('.' . $file->getExtension());
            if ($seeder != "Install")
                echo command('db:seed ' . $seeder);
        }
    }
}
