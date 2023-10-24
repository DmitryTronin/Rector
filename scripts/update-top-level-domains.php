#!/usr/bin/env php

<?php

/*
 * To update top level domains from the command line run:
 * $ ./update-top-level-domains.php
 */

$topLevelDomainsLocation = 'https://data.iana.org/TLD/tlds-alpha-by-domain.txt';

$topLevelDomains = file_get_contents($topLevelDomainsLocation);

if (!is_string($topLevelDomains)) { die('Failed to fetch domains'); }

$topLevelDomains = preg_split('/\r\n|\r|\n/', $topLevelDomains);
array_shift($topLevelDomains);

if (!is_array($topLevelDomains)) { die('Unable to parse domains'); }

$exportedArray = '[' . PHP_EOL;

foreach ($topLevelDomains as $domain) {
    if (! empty($domain)) {
        $domain = strtolower($domain);
        $exportedArray .= "    '{$domain}'," . PHP_EOL;
    }
}

$exportedArray .= ']';

$phpFileTemplate = <<<TEMPLATE
<?php

/**
 * @see https://data.iana.org/TLD/tlds-alpha-by-domain.txt
 */
 
return {$exportedArray};
 
TEMPLATE;

$file_path = '../src/data/top-level-domains.php';

if (!file_exists(dirname($file_path))) {
 mkdir(dirname($file_path), 0777, true); //recursive directory creation
}

if (!is_writable(dirname($file_path))) {
 die('Do not have write permissions for '.dirname($file_path));
}

$writeToFile = file_put_contents($file_path, $phpFileTemplate);

if (!$writeToFile) { die('Failed to write to file'); }

echo "Successfully Fetched Top Level Domains\n";
exit();