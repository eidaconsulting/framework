<?php

namespace Core\Form;

/**
 * Class BootstrapForm
 *
 * @package Core\Form
 */
class BootstrapForm extends Form
{

    /**
     * @param       $name    : Nom du champ
     * @param       $label   : Label du champs
     * @param null  $placeholder
     * @param array $options : Les options c'est a dire le type, etc.
     * @return string
     */
    public function input ($name, $label, $placeholder = null, $options = [])
    {
        if (!array_key_exists('class', $options)) {
            if (isset($options['type']) && $options['type'] === 'submit') {
                $options['class'] = 'btn btn-primary';
            } else {
                $options['class'] = 'form-control';
            }

        }

        if (in_array('file', $options)) {
            return $this->FormInput($name, $label, $placeholder, $options);
        } elseif ($label == null) {
            $return = $this->FormInput($name, $label, $placeholder, $options);
            return $this->surround($return);
        } elseif (in_array('radio', $options)) {
            return $this->FormInput($name, $label, $placeholder, $options);
        } else {
            return $this->surround($this->FormInput($name, $label, $placeholder, $options));
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
    public function select ($name, $label, $placeholder = null, $options = [], $value = [])
    {
        if (!array_key_exists('class', $options)) {
            $options['class'] = 'form-control';
        }
        return $this->surround($this->FormSelect($name, $label, $placeholder, $options, $value));
    }

    /**
     * @param        $name
     * @param        $label
     * @param array  $options
     * @param string $btn
     * @return string
     */
    public function button ($name, $label, $options = [], $btn = 'btn')
    {
        if (!array_key_exists('class', $options)) {
            $options['class'] = 'btn btn-primary';
        }
        return $this->surround($this->FormButton($name, $label, $options, $btn));
    }

    /**
     * @param $html
     * @return string
     */
    protected function surround ($html)
    {
        return '<div class="form-group">' . $html . '</div>';
    }

}