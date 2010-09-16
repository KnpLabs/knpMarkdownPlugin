<?php

/**
 * A markItUp based markdown editor widget that provides a preview functionality
 *
 * @author Antoine Hérault <antoine.herault@gmail.com>
 */
class sfWidgetFormMarkdown extends sfWidgetFormTextarea
{

  protected static $routing;

  /**
   * Gets a routing instance
   */
  public static function getRouting()
  {
    if ( null === self::$routing )
    {
      throw new sfException( sprintf( 'You must pass a routing instance to the %s class.', get_class( $this ) ) );
    }

    return self::$routing;
  }

  /**
   * Sets a routing instance
   * 
   * @param sfRouting $routing
   */
  public static function setRouting(sfRouting $routing)
  {
    self::$routing = $routing;
  }

  public function configure($options = array(), $attributes = array())
  {
  	$this->addOption( 'fixe_admin_css', true );
    $this->addOption( 'preview', sfConfig::get( 'app_knp_markdown_preview' ) );
    $this->addOption( 'preview_route', sfConfig::get( 'app_knp_markdown_preview_route' ) );
    $this->addOption( 'markitup_dir', sfConfig::get( 'app_knp_markdown_markitup_dir' ) );
    $this->addOption( 'markitup_set', sfConfig::get( 'app_knp_markdown_markitup_set' ) );
    $this->addOption( 'markitup_skin', sfConfig::get( 'app_knp_markdown_markitup_skin' ) );
    $this->addOption( 'jquery_use', sfConfig::get( 'app_knp_markdown_jquery_use' ) );
    $this->addOption( 'jquery_src', sfConfig::get( 'app_knp_markdown_jquery_src' ) );
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $id = $this->generateId( $name, $value );
    $previewUrl = $this->getPreviewUrl();

    $javascript = <<<JS
//<![CDATA[
$(document).ready(function() {
  mySettings.previewParserPath = "$previewUrl";
  $("#$id").markItUp(mySettings);
});
//]]>
JS;

    return parent::render( $name, $value, $attributes, $errors ) . $this->renderContentTag( 'script', $javascript, array('type' => 'text/javascript') );
  }

  public function getPreviewUrl()
  {
    return self::getRouting()->generate( $this->getOption( 'preview_route' ) );
  }

  /**
   * @see sfWidget::getStylesheets()
   */
  public function getStylesheets()
  {
    $stylesheets = array(
      $this->getOption( 'markitup_dir' ) . '/skins/' . $this->getOption( 'markitup_skin' ) . '/style.css' => 'all',
      $this->getOption( 'markitup_dir' ) . '/sets/' . $this->getOption( 'markitup_set' ) . '/style.css' => 'all'
    );
    
    if ($this->getOption('fixe_admin_css'))
    {
      array_unshift( $stylesheets, array( sfConfig::get('app_knp_markdown_web_dir') . '/' . 'markdown.css' => 'all' ) );
    }
    
    return $stylesheets;
  }

  /**
   * @see sfWidget::getJavaScripts()
   */
  public function getJavaScripts()
  {
    $javascripts = array(
      $this->getOption( 'markitup_dir' ) . '/jquery.markitup.js',
      $this->getOption( 'markitup_dir' ) . '/sets/' . $this->getOption( 'markitup_set' ) . '/set.js'
    );

    if ( $this->getOption( 'jquery_use' ) )
    {
      array_unshift( $javascripts, $this->getOption( 'jquery_src' ) );
    }

    return $javascripts;
  }

}

?>