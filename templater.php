<?php

// Templater.php
class Templater
{
  // Path to templates directory
  private $path;

  /**
   * Constructor
   * @param string $path Path to templates directory
   */
  public function __construct($path)
  {
    $this->path = $path;
  }

  /**
   * Render a template file
   * @param string $view The template file to render
   * @param array $context Data to be passed to the template
   */
  public function render($view, $context = [])
  {
    $file = $this->path . $view;
    if (!file_exists($file)) {
      throw new Exception("Template " . $file . " does not exist.");
    }
    // Extract array values to php variables
    extract($context);
    include($file);
  }

}

