<?php

namespace Core\Form;

class Form
{
    /**
     * @var array
     */
    private $data;
    public $surround = 'div';

    /**
     * Form constructor.
     * @param array $data
     */
    public function __construct($data = []) {
        $this->data = $data;
    }

    /**
     * @param $html
     * @return string
     */
    private function surround($html){
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }

    /**
     * @param $index
     * @return mixed|null
     */
    protected function getValue($index){
        if(is_object($this->data)){
            return $this->data->$index;
        }
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    /**
     * @param $name
     * @param $label
     * @param null $placeholder
     * @param array $options
     * @return string
     */
    public function FormInput($name, $label, $placeholder = null, $options = []){
        $type = isset($options['type']) ? $options['type'] : 'text';
        $class = isset($options['class']) ? $options['class'] : '';
        $id = isset($options['id']) ? $options['id'] : $name;
        $require = isset($options['required']) ? $options['required'] : null;
        $maxlength = isset($options['maxlength']) ? 'maxlength="'. $options['maxlength'] . '"' : null;
        $data_target = isset($options['data-target']) ? 'data-target="' . $options['data-target'] . '"' : null;
        $data_toggle = isset($options['data-toggle']) ? 'data-toggle="' . $options['data-toggle'] . '"' : null;
        $data_mask = isset($options['data-mask']) ? $options['data-mask'] : null;
        $accept = isset($options['accept']) ? $options['accept'] : null;
        $indication = isset($options['indication']) ? $options['indication'] : null;
        $checked = isset($options['checked']) ? 'checked = checked' : null;
        $autocomplete = isset($options['autocomplete']) ? 'autocomplete="on"' : 'autocomplete="off"';
        if($type !== 'submit'){
            $value = isset($options['value']) ? $options['value'] : $this->getValue($name);
        }

        if(!is_null($data_mask)){ $data_mask = 'data-mask = "'.$data_mask.'"'; }
        if(!is_null($maxlength) && $maxlength >= 500) {$row = 10; } else { $row = 7; }

        if($label != ''){
            if($type !== 'checkbox'){
                if($type !== 'radio') {
                    if ($require) {
                        $label = '<label for="' . $id . '">' . $label . ' <span class="indication">*</span></label>';
                    } else {
                        $label = '<label for="' . $id . '">' . $label . ' </label>';
                    }
                }
            }
        }
        else {
            if($require){
                if($placeholder){
                    $placeholder = $placeholder . ' *';
                }
            }
        }


        if($type === 'textarea'){
            $class_explode = explode(' ', $class);
            if(in_array('summernote', $class_explode)){
                $input = '<textarea id="'.$id.'" '. $require .' name="' . $name . '" class="'.$class.'" rows="'.$row.'" 
            placeholder="'. $placeholder .'" '. $maxlength .'>' . $value . '</textarea>';
                if(isset($indication)){ $input .= '<span class="is-indication">'.$indication.'</span>'; }
            }
            else {
                $input = '<textarea id="'.$id.'" '. $require .' name="' . $name . '" class="'.$class.'" rows="'.$row.'" 
            placeholder="'. $placeholder .'" '. $maxlength .'>' . strip_tags($value) . '</textarea>';
                if(isset($indication)){ $input .= '<span class="is-indication">'.$indication.'</span>'; }
            }
        }
        elseif($type === 'radio'){
            $input = '<input id="'.$id.'" name="'.$name.'" type="'.$type.'" value="'.$value.'" class="'.$class.'" '.$checked.'> 
            <span for="'.$id.'" class="is-indication">'.$label.'</span>';
        }
        elseif($type === 'checkbox'){
            $input = '<input id="'.$id.'" name="'.$name.'" type="'.$type.'" value="'.$value.'" class="'.$class.'" '.$checked.'> 
            <span for="'.$id.'" class="is-indication">'.$label.'</span>';
        }
        elseif($type === 'submit'){
            $input = '<input id="'.$id.'" name="'.$name.'" type="'.$type.'" value="'.$placeholder.'" class="'.$class.'" 
            '.$data_toggle.' '.$data_target.'>';
        }
        elseif(!is_null($accept) && $type === 'file'){
            $input = '<input id="'.$id.'" name="'.$name.'" type="'.$type.'" value="'.$placeholder.'" class="'.$class.'" 
            '.$data_toggle.' '.$data_target.' accept="'.$accept.'">';
            if(isset($indication)){ $input .= '<span class="is-indication">'.$indication.'</span>'; }
        }
        else {
            $input = '<input id="'.$id.'" type="'.$type.'" name="' . $name . '" value="' . $value . '" 
            class="'.$class.'" placeholder="'. $placeholder .'" '. $maxlength .' ' . $data_mask . '  '. $require .' '.$autocomplete.' />';
            if(isset($indication)){ $input .= '<span class="is-indication">'.$indication.'</span>'; }
        }

        if($type === 'radio'){
            return $input;
        }
        elseif($type === 'checkbox'){
            return $input;
        }
        else {
            return $label . $input;
        }

    }

    /**
     * @param $name
     * @param $label
     * @param null $placeholder
     * @param array $options
     * @param array $value
     * @return string
     */
    public function FormSelect($name, $label, $placeholder = null, $options = [], $value = []){
        $class = isset($options['class']) ? $options['class'] : '';
        $id = isset($options['id']) ? $options['id'] : $name;
        $require = isset($options['required']) ? $options['required'] : null;
        $multiple = isset($options['multiple']) ? $options['multiple'] : null;
        $indication = isset($options['indication']) ? $options['indication'] : null;

        if($label != ''){
            if($require){
                $label = '<label for="'.$id.'">' . $label . ' <span class="indication">*</span></label>';
            }
            else{
                $label = '<label for="'.$id.'">' . $label . ' </label>';
            }
        }
        else {
            if($require){
                if($placeholder){
                    $placeholder = $placeholder . ' *';
                }
            }
        }
        if(isset($multiple)){
            $input = '<select class="'.$class.'" name="'.$name.'" id="'.$id.'" multiple="'.$multiple.'" '.$require.' placeholder="'. $placeholder .'">';
        }
        else {
            $input = '<select class="'.$class.'" name="'.$name.'" id="'.$id.'" '.$require.' placeholder="'. $placeholder .'">';
        }
        $input .= '<option value="">'. $placeholder .'</option>';
        foreach ($value as $k => $v){
            $attribute = '';
            if($k == $this->getValue($name)){
                $attribute = ' selected';
            }
            $input .= '<option value="' . $k .'" ' . $attribute . '>' . $v . '</option>';
        }
        $input .= '</select>';
        if(isset($indication)){ $input .= '<span class="is-indication">'.$indication.'</span>'; }

        return $label . $input;
    }

    /**
     * @param $name
     * @param $label
     * @param string $btn
     * @param array $options
     * @return string
     */
    public function FormButton($name, $label, $options = [], $btn = 'btn'){
        $type = isset($options['type']) ? $options['type'] : 'submit';
        $class = isset($options['class']) ? $options['class'] : '';
        $id = isset($options['id']) ? $options['id'] : $name;
        $url = isset($options['url']) ? $options['url'] : '#';
        $value = isset($options['value']) ? $options['value'] : null;
        $data_target = isset($options['data-target']) ? 'data-target="' . $options['data-target'] . '"' : null;
        $data_toggle = isset($options['data-toggle']) ? 'data-toggle="' . $options['data-toggle'] . '"' : null;
        $title= isset($options['title']) ? 'title="' . $options['title'] . '"' : null;

        if($btn === 'lien'){
            $input = '<a href="'.$url.'" id="'.$id.'"  class="'.$class.'" '.$data_toggle.' '.$data_target.' '.$title.' >'. $label.'</a>';
        }
        else {
            $input = '<button name="'.$name.'" id="' . $id . '" type="' . $type . '" value="' . $value . '" 
            class="'.$class.'" title="' . $value . '" '.$data_toggle.' '.$data_target.' '.$title.'>' . $label . '</button>';
        }

        return $input;
    }
}