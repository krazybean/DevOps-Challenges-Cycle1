<?php
ini_set( 'date.timezone', 'America/Chicago');
ini_set('error_reporting', E_ALL);
$creds = parse_ini_file(getenv('HOME') . "/.rackspace_cloud_credentials");
require 'vendor/autoload.php';
use OpenCloud\Rackspace;

$client = new Rackspace(Rackspace::US_IDENTITY_ENDPOINT, array(
    'username' => $creds['username'],
    'apiKey'   => $creds['apiKey']
));
$client->authenticate();

$credentials = $client->getCredentials();

$compute = $client->ComputeService('cloudServersOpenStack', 'ORD', 'publicURL');

$iterator = $compute->serverList();
while ($iterator->valid()) {
    $server = $iterator->current();
    echo $server->name;
    echo "\n";
    $iterator->next();
}


?>
