<?php

namespace Drupal\adminconfigform\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\adminconfigform\TimeZoneServices;

/**
 * Provides a 'Timezone' Block.
 *
 * @Block(
 *   id = "timezone_block",
 *   admin_label = @Translation("Timezone block"),
 *   category = @Translation("Timezone"),
 * )
 */
class TimezoneBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Variable will save the timezone setting object value.
   *
   * @var timezonesetting
   */
  protected $timezonesetting;

  /**
   * Variable will save the config object value.
   *
   * @var config
   */
  protected $config;

  /**
   * Main construtor class.
   *
   * @param array $configuration
   *   Configuration object.
   * @param string $plugin_id
   *   Plugin id object.
   * @param mixed $plugin_definition
   *   Plugin definition object.
   * @param \Drupal\adminconfigform\TimeZoneServices $timezone
   *   Timezone setting object.
   * @param Drupal\Core\Config\ConfigFactoryInterface $config
   *   Config factory object.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, TimeZoneServices $timezone, ConfigFactoryInterface $config) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->timezonesetting = $timezone;
    $this->config = $config;
  }

  /**
   * Create function to pass object as an arguments.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   Main container object.
   * @param array $configuration
   *   Configuration object.
   * @param string $plugin_id
   *   Plugin id object.
   * @param mixed $plugin_definition
   *   Plugin definition factory object.
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
          $configuration,
          $plugin_id,
          $plugin_definition,
          $container->get('adminconfigform.timezone_service'),
          $container->get('config.factory')
      );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $configsetting = $this->config->get('adminconfigform.settings');
    $datetime = $this->timezonesetting->getTime();
    $country = $configsetting->get('country');
    $city = $configsetting->get('city');
    ;
    return [
      '#theme' => 'adminconfigform',
      '#country' => $country,
      '#city' => $city,
      '#datetime' => $datetime,
      '#cache' => [
        'tags' => ['block:timezoneblock'],
      ],
    ];
  }

}
