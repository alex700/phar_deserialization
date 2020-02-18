<?php
    require 'vendor/autoload.php';

    if (\is_file('phar://symfony_rce.phar.tar')) {
        echo "File exists" . PHP_EOL;
    }

