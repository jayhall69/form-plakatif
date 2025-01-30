<?php

// local dev site / test environment
//
if( strpos($_SERVER['SERVER_NAME'], 'dev')!==false ){

    define("TEST_MODE", true);
    define("TEST_MAIL_SITEOWNER", 'you@localhost.localdomain');
}

// production site / live environment
//
elseif( strpos($_SERVER['SERVER_NAME'], 'yourlivedomain')!==false ){

    define("MAIL_SITEOWNER", 'owner@website.com');
    define("TEST_MODE", false); // NOTE: Set to true for testing in live environment
    define("TEST_MAIL_SITEOWNER", 'your@email.com'); // testing in live environment
}