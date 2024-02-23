<?php

class Validator
{
    private string $name;
    private string $phone;
    private string $errors = "";

    function __construct($arr)
    {
        $this->name = $arr['name'];
        $this->phone = $arr['phone'];
        $this->validateName();
        $this->validatePhone();
    }

    public function validateName():void
    {
        if ($this->name == "")
        {
            $this->errors .= "Укажите имя!<br>";
        }

        elseif (strlen($this->name) < 2)
        {
            $this->errors .= "Имя должно включать не менее 2-х символов!<br>";	
        }
    }
    
    public function validatePhone():void
    {
        if ($this->phone == "")
        {
            $this->errors .= "Номер не введен!<br>";
        }

        elseif (strlen($this->phone) < 11)
        {
            $this->errors .= "Телефон должен включать не менее 11-ти цифр!<br>";
        }
    }

    public function getErrors():string
    {
        return $this->errors;
    }

}