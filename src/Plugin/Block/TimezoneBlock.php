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
   * @var timezonesetting
   *
   * Variable will save the service object value
   */
  protected $timezonesetting;
  protected $config;
  /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\adminconfigform\TimeZoneServices $timezone
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, TimeZoneServices $timezone, ConfigFactoryInterface $config) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->timezonesetting = $timezone;
    $this->config = $config;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
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
    $city = $configsetting->get('city');;
    return [
      '#theme' => 'adminconfigform',
      '#country' => $country,
      '#city' => $city,
      '#datetime' => $datetime,
      '#cache' => [
        'tags' =>  ['block:timezoneblock'],
      ],
    ];
  }

}
