<?php

/**
 * Transform a markdown string to a html one
 *
 * @param string $markdown
 * @return string
 */
function markdown2html($markdown)
{
  $parser = new sfMarkdownParser();
  
  return $parser->transform( $markdown );
}
