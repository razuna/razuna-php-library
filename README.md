Razuna PHP Library for API 2 !
==============================

This is the official Razuna PHP Library 2. Use this to hook up your PHP code to the Razuna API 2.

IMPORTANT
=========
If you are looking for version 1 which used the Razuna API 1, then please take the one from the TAGS as the release and master branch use solely API 2!

Documentation
-------------

The [PHP Library documentation live here](http://wiki.razuna.com/display/ecp/Razuna+PHP+Library). Refer to the [general Razuna API Guide](http://wiki.razuna.com/display/ecp/API+Developer+Guide) also.

Support
-------

Community support is available on the [Razuna GetSatisfaction page](http://getsatisfaction.com/razuna).

Issues
------

Issues should be reported to our [Razuna Issue Tracker](http://issues.razuna.com).

Documentation / Wiki
--------------------

Documentation / Wiki is available at [Razuna Documentation](http://wiki.razuna.com).

Usage
-----

NOTE: You need to have the CURL module enabled in your PHP installation!

// To getasset
include_once 'Razuna.class.php';
$host = 'localhost:8080';
$api_key = '82B39A73A1C14B9A859FD265EC45BCED';
$assetid = '2478925F65604A2D84A9495D0E2ABD6C';
$assettype = 'img';

$conn = new Razuna();
$conn->connect($host, $api_key);

$response = $conn->getasset($assetid, $assettype);
// Note response will be in JSON format
var_dump($response);

Special Thank you
-----------------
Tapan Kumar Thapa for refactoring the PHP class for API2.
