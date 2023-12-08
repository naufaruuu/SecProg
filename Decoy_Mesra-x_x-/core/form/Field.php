<?php

namespace app\core\form;
use app\core\Model;

class Field 
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_SELECT = 'select';
    public const TYPE_NUMBER = 'number';

    public string $type;
    public Model $model;
    public string $attribute;
    public array $options = [];

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->attribute = $attribute;
        $this->model = $model;
    }

    public function __toString(): string
    {
        if ($this->type === self::TYPE_SELECT) {
            return $this->renderSelect();
        }


        return sprintf('
          <div class="mb-3 form-group">
            <label>%s</label>
            <input type="%s" class="form-control %s" name = "%s" value="%s"></textarea>
            <div class="invalid-feedback">
                %s
            </div>
          </div>
',          $this->attribute,
            $this->type,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->getFirstError($this->attribute)
        );
    }

    private function renderSelect(): string
    {
        $optionsHtml = '';
        foreach ($this->options as $value => $text) {
            $selected = $this->model->{$this->attribute} == $value ? ' selected' : '';
            $optionsHtml .= sprintf('<option value="%s"%s>%s</option>', $value, $selected, $text);
        }

        return sprintf('
                <select class="form-select %s" name="%s">%s</select>
                <div class="invalid-feedback">
                    %s
                </div>
        ',      
                $this->model->hasError($this->attribute) ? ' is-invalid' : '',
                $this->attribute,
                $optionsHtml,
                $this->model->getFirstError($this->attribute)
        );
    }

    public function selectField(array $options = []): Field
    {
        $this->type = self::TYPE_SELECT;
        $this->options = $options;
        return $this;
    }


    public function passwordField(): Field
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
}

?>
