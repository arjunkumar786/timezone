<?php

namespace Drupal\adminconfigform;

use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * TimeZoneServices: Service class which return current time.
 */
class TimeZoneServices {

  /**
   * {@inheritdoc}
   */
  protected $config;

  /**
   * {@inheritdoc}
   */
  protected $timezone;

  /**
   * {@inheritdoc}
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->config = $config_factory->get('adminconfigform.settings');
    $this->timezone = $this->config->get('timezone');
  }

  /**
   * Function return current date-time.
   */
  public function getTime() {
    $timezone = $this->timezone;
    $date = new \DateTime("now", new \DateTimeZone($timezone));
    return $date->format("l, jS M Y - H:i A");
  }

}
