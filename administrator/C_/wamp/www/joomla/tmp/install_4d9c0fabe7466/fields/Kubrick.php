<?php
defined('_JEXEC') or die( 'Restricted access' );
jimport('joomla.form.formfield');
class JFormFieldKubrick extends JFormField
{
    protected $type = 'Kubrick';
    function getInput()
    {
        $path = JURI::root().'modules/mod_the_piecemaker/fields/';
        $js = "
			window.addEvent('domready', function() {
				var k = new Kubrick('".$this->id."', {
					color: '$this->value',
					onColorChange: function(new_color) {
						$('".$this->id."').value = new_color;
					}
				});
			});
        ";
        JHTML::_( 'behavior.mootools' );
        JHTML::stylesheet( 'Kubrick.css', $path );
        JHTML::script( 'Kubrick.js', $path );
        $document = JFactory::getDocument();
        $document->addScriptDeclaration( $js );
        $html = '<input id="'.$this->id.'" name="'.$this->name.'" value="'.$this->value.'" type="text" size="13" class="colorpicker" />';
        return $html;
    }
}