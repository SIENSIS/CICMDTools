# Install via composer

> composer require siensis/cicmdtools @dev 

# CI4 Commands

- __crypt__: Command to crypt a text with CI4 encryption key configured (_php spark key:generate_)
- __decrypt__: Command to decrypt a text with CI4 encryption key configured
- __zip__: Zip all project content into a zip. Before it clears logs
- __db:reboot__: Drop or Empty database and calls migrations to rebuild database project
- __db:backup__: Exports database as a mysql dump file
- __generate:model__: Command to generate a model with validation rules (from Vulcan tools)

# Helpers

- __setting__: hash_setting, crypt_setting to store or to get a configuration attribute from Codeigniter4/Settings package
- __text__: Added startsWith, endsWith, obscureMiddle, cryptb64, decryptb64,hmacb64
- __generateStringID__: Generate an string ID based on time uniqueid function. This helper permits: prefix, suffix, split characters with '-' and more_entropy. By default prefix='', suffix='', split=0 (disabled), more_entropy=false