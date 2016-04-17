<?php

$info = array(
	// The module title, typically a little more descriptive than the class name
	'title' => 'Lumberjack',
	// version number (integer)
	'version' => '0.1.1',
	// author
	'author' => 'GuruMeditation',
	// summary is brief description of what this module is
	'summary' => 'A simple module to log the IP / User Agent String when a user saves a page',
	// singular=true: indicates that only one instance of the module is allowed.
	// This is usually what you want for modules that attach hooks.
	'singular' => true,
	// autoload=true: indicates the module should be started with ProcessWire.
	// This is necessary for any modules that attach runtime hooks, otherwise those
	// hooks won't get attached unless some other code calls the module on it's own.
	// Note that autoload modules are almost always also 'singular' (seen above).
	'autoload' => true,
	// Optional font-awesome icon name, minus the 'fa-' part
	'icon' => 'tree',
	// Optionally describe what version of ProcessWire (or other modules) are required.
	// To specify more modules, separate each with a comma (CSV) or make this an array.
	'requires' => 'ProcessWire>=2.6.0',
);