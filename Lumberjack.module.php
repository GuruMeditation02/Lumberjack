<?php

/**
 * 
 * Lumberjack logger
 *
 * @author GuruMeditation
 * 
 * ProcessWire 2.x 
 * Copyright (C) 2014 by Ryan Cramer 
 * Licensed under GNU/GPL v2, see LICENSE.TXT
 * 
 * http://processwire.com
 * 
 */
class Lumberjack extends WireData implements Module {

  /**
   * Initialise
   *
   * @access public
   *
   */
  public function init() {
    // Ensure the module is enabled from the settings 
    if($this->lumberEnabled == 1) {
      $this->pages->addHookBefore('save', $this, 'saveLogs'); 
    }
  }

  /**
   * Logs hook
   *
   */
  public function saveLogs($event) {

    $page = $event->arguments[0];
    $tpl = $page->template;

    // If the page template has the required field we can log the IP address
    if($tpl->hasField("lumb_ip_log")) {
      $page->of(false);
      $page->lumb_ip_log = $this->wire('session')->getIP();
      $page->save('lumb_ip_log'); // Save the field
      //$this->message($this->wire('session')->getIP()); // Debug
    } 
    // If the page template has the required field we can log the User Agent string
    if($tpl->hasField("lumb_ua_log")) {
      $page->of(false);
      $ua_string = $_SERVER['HTTP_USER_AGENT']; // Get the User Agent String
      $ua_string = str_replace(array("\r", "\n", "\t"), ' ', substr(strip_tags($ua_string), 0, 255)); // Sanitize
      $page->lumb_ua_log = $ua_string;
      $page->save('lumb_ua_log'); // Save the field
      //$this->message($ua_string); // Debug
    }
  }

  /**
   * Install the required fields
   *
   * @access public
   *
   */
  public function ___install() {

    // IP field
    if(!$this->fields->get('lumb_ip_log')) {
      $field_ip = new Field();
      $field_ip->type = $this->modules->get("FieldtypeText");
      $field_ip->name = 'lumb_ip_log';
      $field_ip->label = 'IP Address';
      $field_ip->tags = 'Lumberjack';
      $field_ip->icon = 'eye';
      $field_ip->save();
    }

    // User Agent field
    if(!$this->fields->get('lumb_ua_log')) {
      $field_agent = new Field();
      $field_agent->type = $this->modules->get("FieldtypeText");
      $field_agent->name = 'lumb_ua_log';
      $field_agent->label = 'User Agent';
      $field_agent->tags = 'Lumberjack';
      $field_agent->icon = 'eye';
      $field_agent->save();
    }
  }

  /**
   * Uninstall the fields we installed previously
   *
   * @access public
   *
   */
  public function ___uninstall() {

    $fields = wire('fields');

    // Array of fields to delete
    $fs = array(
      'lumb_ip_log',
      'lumb_ua_log',
    );

    foreach($fs as $f) {
      // Get each field from the array above
      $f = $fields->get($f);
      // Get the fieldgroups for each field
      $fgs = $f->getFieldgroups();
      // Loop through each fieldgroup 
      foreach($fgs as $fg) {
        // Remove the field from each fieldgroup it's linked to
        $fg->remove($f);
        $fg->save();
      }
      // Now delete the field
      $fields->delete($f);
    }
  }
}