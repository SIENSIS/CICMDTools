<?php

namespace SIENSIS\CICMDTools\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class Decrypt extends BaseCommand
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
    protected $name = 'decrypt';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Decrypts a string';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'decrypt';

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
        $textToDecrypt = CLI::prompt('Text to decrypt', null, 'required');

        $encrypter = service('encrypter');

        $plainText = $encrypter->decrypt(base64_decode($textToDecrypt));

        CLI::newLine();
        CLI::write('Plain text: ' . $plainText);
    }
}
