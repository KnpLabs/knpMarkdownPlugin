<?php

/**
 * knpMarkdownPlugin configuration.
 * 
 * @package     knpMarkdownPlugin
 * @subpackage  config
 * @author      Your name here
 * @version     SVN: $Id: PluginConfiguration.class.php 17207 2009-04-10 15:36:26Z Kris.Wallsmith $
 */
class knpMarkdownPluginConfiguration extends sfPluginConfiguration
{
  const VERSION = '1.0.0-DEV';

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $this->dispatcher->connect( 'routing.load_configuration', array($this, 'listenToRoutingLoadConfigurationEvent') );
  }

  /**
   * Listen to the routing.load_configuration event
   *
   * @param sfEvent $event
   */
  public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $event->getSubject()->prependRoute( 'knp_markdown_preview', new sfRoute(
        '/markdown/preview',
        array('module' => 'knpMarkdown', 'action' => 'preview'),
        array(),
        array()
      ) );

    sfWidgetFormMarkdown::setRouting( $event->getSubject() );
  }

}
