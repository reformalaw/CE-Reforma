<?php

/**
 * Represents a FCK Editor widget.
 *
 * @package    sfFCKEditorPlugin
 * @subpackage widget
 * @version    SVN: $Id$
 */
class sfWidgetFormFCKEditor extends sfWidgetForm
{

  /**
   * Constructor.
   *
   * Available options:
   *
   *  * config: Sets custom path to the FCKEditor configuration file
   *  * tool:   Sets the FCKEditor toolbar style
   *  * rows:   number of rows
   *  * width:  editor width
   *  * height: editor height
   *
   * @param array $options     An array of options
   * @param array $attributes  Attributes not supported. FCK editor rendering can be influenced by options.
   *
   * @see sfWidget
   * @see sfWidgetForm
   */
  public function __construct($options = array(), $attributes = array())
  {
    if (!empty($attributes)) {
      throw new Exception('Attributes not supported.');
    }
    
    $this->addOption('config', null);
    $this->addOption('rows', null);
    $this->addOption('width', null);
    $this->addOption('height', null);
    $this->addOption('tool', null);
    
    parent::__construct($options, $attributes);
  }
	
  /**
   * Render the widget
   * 
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  Attributes not supported. FCK editor rendering can be influenced by options.
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    if (!empty($attributes)) {
      throw new Exception('Attributes not supported.');
    }
    
    $editor = new sfRichTextEditorFCK();
    $options = $this->getOptions();
    

    
    $editor->initialize($name, $value, $options);
    
    return $editor->toHTML();
        
   /* $textarea = parent::render($name, $value, $attributes, $errors);

	$js = sprintf(<<<EOF
<script type="text/javascript">
  tinyMCE.init({
    mode:                              "exact",
    elements:                          "%s",
    theme:                             "%s",
    %s
    %s
    theme_advanced_toolbar_location:   "top",
    theme_advanced_toolbar_align:      "left",
    theme_advanced_statusbar_location: "bottom",
    theme_advanced_resizing:           true,
	content_css:						"%s"
    %s
  });
</script>
EOF
    ,
      $this->generateId($name),
      $this->getOption('theme'),
      $this->getOption('width')  ? sprintf('width:                             "%spx",', $this->getOption('width')) : '',
      $this->getOption('height') ? sprintf('height:                            "%spx",', $this->getOption('height')) : '',
      $this->getOption('cssPath') ? $this->getOption('cssPath') : '',
      $this->getOption('config') ? ",\n".$this->getOption('config') : ''
    );*/

    
  }
  
}
