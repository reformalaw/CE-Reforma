<?php
class myTreeWidgetFormCheckboxes extends sfWidgetForm
{
  var $first = true;
  protected function configure($options = array(), $attributes = array())
  {
    $this->addRequiredOption('choices');
    $this->addOption('label_key', 'label');
    $this->addOption('value_key', false);
    $this->addOption('level_key', 'level');
    $this->addOption('children_key', 'children');
    $this->addOption('class', '');
    $this->addOption('treeid', 'tree');
    $this->addOption('label_separator', '&nbsp;');
    $this->addOption('separator', "\n");
    $this->addOption('formatter', array($this, 'formatter'));
    $this->addOption('template', '%group% %options%');
  }
  
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    if ('[]' != substr($name, -2))
    {
      $name .= '[]';
    }
    $choices = $this->getOption('choices');//sfWidgetFormTree::normalizeChoices($this->getOption('choices'), $this->getOption('label_key'), $this->getOption('value_key'), $this->getOption('level_key'), $this->getOption('children_key'));
    if ($choices instanceof sfCallable)
    {
      $choices = $choices->call();
    }
    return $this->formatChoices($name, $value, $choices, $attributes);;
  }
  
  protected function formatChoices($name, $value, $choices, $attributes)
  {
    $inputs = array();
    if($choices!==null)
    {        
      foreach($choices AS $key => $option)
      {          
        if(!is_array($option)) throw new InvalidArgumentException(sprintf('Choice value must be an array, %s given.', gettype($option)));
        if(!isset($option[$this->getOption('label_key')])) throw new InvalidArgumentException(sprintf('Choice with key %s must have a label.', $key));

        $id_attr    = $this->generateId($name, self::escapeOnce($key));
        $val_attr   = self::escapeOnce($key);
        
        $baseAttributes = array(
          'name'  => $name,
          'type'  => 'checkbox',
          'value' => $val_attr,
          'id'    => $id_attr
        );
        
        if(!is_array($value)){
            $value = explode(',',$value);
        }
        if ((is_array($value) && in_array($key, $value)) || $key == $value)
        {
          $baseAttributes['checked'] = 'checked';
        }
        
        $root = false;
        if($this->first)
        {
            $root = true;
            $this->first=false;
        }
        
        $inputs[] = array(
          'input' => $this->renderTag('input', array_merge($baseAttributes, $attributes)),
          'label' => $this->renderContentTag('label', $option[$this->getOption('label_key')], array('for' => $id_attr)),
          'root' => $root,
          'children' => isset($option['children']) ? $this->formatChoices($name, $value, $option['children'], $attributes) : null
        );
      }
    }
    return call_user_func($this->getOption('formatter'), $this, $inputs);
  }
  
  public function formatter($widget, $inputs)
  {
    $rows = array();
    foreach ($inputs as $input)
    {
      $content = $input['input'].$this->getOption('label_separator').$input['label'];
      isset($input['children'])  && $content .= "\n" . $input['children'];
      $rows[] = $this->renderContentTag(
        'li',
        $content
      );
    }
    if(isset($input['root']))
    {
        return $this->renderContentTag('ul', implode($this->getOption('separator'), $rows), array('class' => $this->getOption('class'),'id'=>$this->getOption('treeid')));   
    }
    else 
    {
        return $this->renderContentTag('ul', implode($this->getOption('separator'), $rows), array('class' => $this->getOption('class')));
    }
  }
  
  /*public function setJavaScripts()
  {
    return array('/js/jquery.checkboxtree.js');
  }
  public function setStylesheets()
  {
    return array('/css/jquery.checkboxtree.css');
  }*/

  public function __clone()
  {
    if ($this->getOption('choices') instanceof sfCallable)
    {
      $callable = $this->getOption('choices')->getCallable();
      $class = __CLASS__;
      if (is_array($callable) && $callable[0] instanceof $class)
      {
        $callable[0] = $this;
        $this->setOption('choices', new sfCallable($callable));
      }
    }
  }
}