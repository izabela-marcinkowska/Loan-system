<?php

// Templater.php
class Templater
{
  // Path to templates directory
  private $path;

  // Data to be passed to templates
  private $data = [];

  /**
   * Constructor
   * @param string $path Path to templates directory
   * @param array $data Data to be passed to templates
   */
  public function __construct($path, $data = [])
  {
    $this->path = rtrim($path, '/') . '/';
    $this->data = $data;
  }

  /**
   * Render a template file
   * @param string $view The template file to render
   * @param array $context Data to be passed to the template
   * @return string The rendered template
   */
  public function render($view, $context = [])
  {
    $mergedContext = array_merge($this->data, $context);
    return $this->load($view, $mergedContext);
  }

  /**
   * Load a template file
   * @param string $view The template file to load
   * @param array $context Data to be passed to the template
   * @return string The rendered template
   */
  private function load($view, $context)
  {
    $file = $this->path . $view;
    if (!file_exists($file)) {
      throw new Exception("Template " . $file . " does not exist.");
    }

    extract($context);
    ob_start();
    include($file);
    return ob_get_clean();
  }

  /**
   * Get a value from the data array
   * @param string $key The key to get from the data array
   * @return mixed The value from the data array
   */
  public function get($key)
  {
    return $this->data[$key];
  }
}
