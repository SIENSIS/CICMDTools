<?php

namespace SIENSIS\CICMDTools\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class Crypt extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Developer';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'crypt';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Crypts a string to store in the database';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'crypt';

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
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $textToCrypt = CLI::prompt('Text to crypt', null, 'required');

        $encrypter = service('encrypter');

        $ciphertext = base64_encode($encrypter->encrypt($textToCrypt));

        CLI::newLine();
        CLI::write('Ciphertext: ' . $ciphertext);
    }
}
