<?php

/**
 * Base actions for the knpMarkdownPlugin knpMarkdown module.
 * 
 * @package     knpMarkdownPlugin
 * @subpackage  knpMarkdown
 * @author      Your name here
 * @version     SVN: $Id: BaseActions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
abstract class BaseknpMarkdownActions extends sfActions
{
  public function executePreview(sfWebRequest $request)
  {
    $parser = new sfMarkdownParser();

    return $this->renderText($parser->transform($request->getParameter('data')));
  }
}
