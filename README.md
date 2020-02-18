# Phar Deserialization Exploit on CVE-2019-18889 Sample
This is a sample how to exploit insecure phar deserialization with payload in a phar archive.

# Installation
Simply run `composer install` in command line.
Make sure `phar.readonly = Off` in the `php.ini` to be able to generate phar archive. This parameter can be `Off` on the machine where phar archive will be exploited.

# How to use
Run `php generate.php` to create phar archive. You will see `symfony_rce.phar.tar` file in the project root directory.
This generator uses [phpggc](https://github.com/ambionics/phpggc) library to generate payload. All the payload located in `generate.php`:
```
$parameters = $gc->process_parameters([
   'function' => 'exec',
   'parameter' => 'truncate -s 0 info.php; echo "<?php phpinfo();" >> info.php',
]);
```
You can specify any payload instead or run the same tool with a command line.

Run `test_phar.php` to see how this issue can be exploited. Execution of this script will render symfony error and place `info.php` file with specified above payload.

# Symfony Fixes
The issue affects versions 3.4.0 to 3.4.34, 4.2.0 to 4.2.11 and 4.3.0 to 4.3.7 (CVE-2019-18889).
The issue has been fixed in Symfony 3.4.35, 4.2.12 and 4.3.8.
Please see more at [CVE-2019-18889 - Forbid serializing AbstractAdapter and TagAwareAdapter instances](https://symfony.com/blog/cve-2019-18889-forbid-serializing-abstractadapter-and-tagawareadapter-instances)
