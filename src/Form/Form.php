<?php

namespace Core\Form;

use core\Auth\Token;

class Form
{
    public $surround = 'div';
    /**
     * @var array
     */
    private $data;

    /**
     * Form constructor.
     *
     * @param array $data
     */
    public function __construct ($data = [])
    {
        $this->data = $data;
    }

    /**
     * @param       $name
     * @param       $label
     * @param null  $placeholder
     * @param array $options
     * @return string
     */
    public function FormInput ($name, $label, $placeholder = null, $options = [])
    {
        $params = [];

        if(!array_key_exists('type', $options)){ $options['type'] = 'text'; }
        if(!array_key_exists('id', $options)){ $options['id'] = $name; }
        if(!array_key_exists('autocomplete', $options)){ $options['autocomplete'] = 'off'; }
        if ($options['type'] == 'textarea' && !array_key_exists('row', $options)){
            $options['row'] = 7;
        }

        if ($options['type'] !== 'submit' && !array_key_exists('value', $options)) {
            $options['value'] = $this->getValue($name);
        }

        if(count($options) > 0){
            foreach ($options as $k => $v) {
                $params [] = $k .' = "' . $v . '"';
            }
        }

        $param = implode(' ', $params);

        if ($label != '') {
            if (array_key_exists('required', $options)) {
                $label = '<label for="' . $options['id'] . '">' . $label . ' <span class="indication">*</span></label>';
            } else {
                $label = '<label for="' . $options['id'] . '">' . $label . ' </label>';
            }
        }
        else {
            if (array_key_exists('required', $options)) {
                if ($placeholder) {
                    $placeholder = $placeholder . ' *';
                }
            }
        }


        if ($options['type'] === 'textarea') {

            //Si je précise des class
            if(array_key_exists('class', $options) && $options['class'] != 'form-control'){
                $class_explode = explode(' ', $options['class']);

                if (in_array('summernote', $class_explode)) {
                    $value = $options['value'];
                } else {
                    $value = strip_tags($options['value']);
                }

                $input = '<textarea name="' . $name . '"  placeholder="' . $placeholder . '" ' . $param . '>' . $value . '</textarea>';
            }
            else {
                $input = '<textarea name="' . $name . '"  placeholder="' . $placeholder . '" ' . $param . '>' . $options['value'] . '</textarea>';
            }
        }
        elseif ($options['type'] === 'radio' || $options['type'] === 'checkbox') {

            $input = '<input name="' . $name . '" '.$param.'> 
            <span for="' . $options['id'] . '" class="is-indication">' . $label . '</span>';

        }
        elseif ($options['type'] === 'submit') {
            $input = '<input name="' . $name . '" value="' . $placeholder . '" '.$param.'>';
        }
        else {
            $input = '<input name="' . $name . '" placeholder="' . $placeholder . '" '.$param.' />';
        }
        //ajoute de la partie indication
        if (array_key_exists('indication', $options)) {
            $input .= '<span class="is-indication">' . $options['indication'] . '</span>';
        }

        if ($options['type'] === 'radio' || $options['type'] === 'checkbox') {
            return $input;
        } else {
            return $label . $input;
        }

    }

    /**
     * @param       $name
     * @param       $label
     * @param null  $placeholder
     * @param array $options
     * @param array $value
     * @return string
     */
    public function FormSelect ($name, $label, $placeholder = null, $options = [], $value = [])
    {
        $class = isset($options['class']) ? $options['class'] : '';
        $id = isset($options['id']) ? $options['id'] : $name;
        $require = isset($options['required']) ? $options['required'] : null;
        $multiple = isset($options['multiple']) ? $options['multiple'] : null;
        $indication = isset($options['indication']) ? $options['indication'] : null;

        if ($label != '') {
            if ($require) {
                $label = '<label for="' . $id . '">' . $label . ' <span class="indication">*</span></label>';
            } else {
                $label = '<label for="' . $id . '">' . $label . ' </label>';
            }
        } else {
            if ($require) {
                if ($placeholder) {
                    $placeholder = $placeholder . ' *';
                }
            }
        }
        if (isset($multiple)) {
            $input = '<select class="' . $class . '" name="' . $name . '" id="' . $id . '" multiple="' . $multiple . '" ' . $require . ' placeholder="' . $placeholder . '">';
        } else {
            $input = '<select class="' . $class . '" name="' . $name . '" id="' . $id . '" ' . $require . ' placeholder="' . $placeholder . '">';
        }
        $input .= '<option value="">' . $placeholder . '</option>';
        foreach ($value as $k => $v) {
            $attribute = '';
            if ($k == $this->getValue($name)) {
                $attribute = ' selected';
            }
            $input .= '<option value="' . $k . '" ' . $attribute . '>' . $v . '</option>';
        }
        $input .= '</select>';
        if (isset($indication)) {
            $input .= '<span class="is-indication">' . $indication . '</span>';
        }

        return $label . $input;
    }

    /**
     * @param        $name
     * @param        $label
     * @param string $btn
     * @param array  $options
     * @return string
     */
    public function FormButton ($name, $label, $options = [], $btn = 'btn')
    {
        $type = isset($options['type']) ? $options['type'] : 'submit';
        $class = isset($options['class']) ? $options['class'] : '';
        $id = isset($options['id']) ? $options['id'] : $name;
        $url = isset($options['url']) ? $options['url'] : '#';
        $value = isset($options['value']) ? $options['value'] : null;
        $data_target = isset($options['data-target']) ? 'data-target="' . $options['data-target'] . '"' : null;
        $data_toggle = isset($options['data-toggle']) ? 'data-toggle="' . $options['data-toggle'] . '"' : null;
        $title = isset($options['title']) ? 'title="' . $options['title'] . '"' : null;

        if ($btn === 'lien') {
            $input = '<a href="' . $url . '" id="' . $id . '"  class="' . $class . '" ' . $data_toggle . ' ' . $data_target . ' ' . $title . ' >' . $label . '</a>';
        } else {
            $input = '<button name="' . $name . '" id="' . $id . '" type="' . $type . '" value="' . $value . '" 
            class="' . $class . '" title="' . $value . '" ' . $data_toggle . ' ' . $data_target . ' ' . $title . '>' . $label . '</button>';
        }

        return $input;
    }

    /**
     * @param $index
     * @return mixed|null
     */
    protected function getValue ($index)
    {
        if (is_object($this->data)) {
            return $this->data->$index;
        }
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    /**
     * @param $html
     * @return string
     */
    private function surround ($html)
    {
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }

    public function csrf($type){
        $csrf = new DBAuth();
        return $csrf->csrf();
    }
}