Lumberjack Logger Module
========================

A simple module for ProcessWire CMS that logs the IP / User Agent details of the user when the page is saved.

## Installation

Copy the Lumberjack folder to /site/modules and then refresh the modules from Admin->Modules. Lumberjack can then be installed.

## Usage

Two new fields will be created when Lumberjack is installed.

lumb_ip_log - This field is used to store the IP
lumb_ua_log - This field is used to store the User Agent String

You can add both fields or just one to the required templates. Pages using those templates will then automatically store the IP and User Agent of the user when the page is saved.

## Settings

Lumberjack can be disabled by unchecking the Enabled option on the settings page.