<?php
return [

	'driver' => env('MAIL_DRIVER', 'mailgun'),
	'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
	'port' => env('MAIL_PORT', 587),
	'from' => ['address' => null, 'name' => null],
	'encryption' => env('MAIL_ENCRYPTION', 'tls'),
	'username' => env('postmaster@www.webprinciples.com'),
	'password' => env('e793b7a667a8b114f06ead659ab91c02'),
	'sendmail' => '/usr/sbin/sendmail -bs',
	'pretend' => env('MAIL_PRETEND', false)

];