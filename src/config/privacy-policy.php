<?php

return [
	/*
    |--------------------------------------------------------------------------
    | Singular or Plural Viewpoint
    |--------------------------------------------------------------------------
    |
    | Set to true for singular viewpoint (e.g. "My website...").
    | Set to false for plural viewpoint (e.g. "Our website...").
    |
    */
	'singular' => false,

	/*
    |--------------------------------------------------------------------------
    | Data Controller
    |--------------------------------------------------------------------------
    |
    | Contact data of the data controller.
    |
    */
	'data_controller' => [
		'organisation' => 'Acme Corporation',
		'name' => 'John Doe',
		'address' => 'Acme Street 1, 123456 Acme City, USA',
		'email' => 'privacy@example.com',
		'phone' => '+1 555-0123',
	],

	/*
    |--------------------------------------------------------------------------
    | Data Processing
    |--------------------------------------------------------------------------
    |
    | For details see https://github.com/webflorist/privacy-policy-laravel#data-processing-array-optional
    |
    */
	'data_processing' => [],

	/*
    |--------------------------------------------------------------------------
    | Cookies
    |--------------------------------------------------------------------------
    |
    | This config describes the cookies used by your site.
    |
    | If your site uses no cookies at all, simply set this to `false`.
    |
    | If not, see https://github.com/webflorist/privacy-policy-laravel#cookies-arrayfalse-mandatory
    |
    */
	'cookies' => false,

	/*
    |--------------------------------------------------------------------------
    | Processors
    |--------------------------------------------------------------------------
    |
    | Definition of processors used with data processings or cookies.
    |
    | Several processors are already included.
    | See: https://github.com/webflorist/privacy-policy-text/blob/main/src/processors.php
    |
    | On the configuration of additional ones see:
    | https://github.com/webflorist/privacy-policy-laravel#processors-array-optional
    |
    */
	'processors' => [],
];
