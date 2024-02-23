<?php

require_once '../functions/db.php';
require_once '../functions/validation.php';
require_once '../functions/sendData.php';

class Register
{
    private $result;
    function __construct(array $arr)
    {
        $validation = new Validator($arr);
        if ($validation->getErrors() == "")
        {
            $name = $arr['name'];
            $phone = $arr['phone'];
            $test = $arr['test'];

            $db = new Database();
            $conn = $db->getConnection();

            $stmt = $conn->prepare('SELECT * FROM users WHERE phone = :phone');
    
            $stmt->execute(['phone'=>$phone]);
    
            if ($row = $stmt->fetch(PDO::FETCH_LAZY))
            {
                if ($row['name'] == $name && $row['phone'] == $phone)
                {
                    header("HTTP/1.1 200 OK");
                    $this->result = "<p style='color: red'>Данные уже были отправлены!</p>";
                }
                
                elseif ($row['phone'] == $phone){
                    header("HTTP/1.1 203 OK");
                    $this->result = "<p style='color: red'>Данный телефон уже был отправлен!</p>";
                }
            }
            else
            {
                $data = sendData($name, $phone, $test);
                
                if ($data == '200')
                {
                    header("HTTP/1.1 201 OK");
                    $reg = $conn->prepare('INSERT INTO users VALUES (NULL, :name, :phone)');
                    $reg->execute(['name'=>$name, 'phone'=>$phone]);
                    $this->result = "<p style='color: green'>Отправка данных успешно завершена!</p>";

                }
                else
                {
                    header("HTTP/1.1 203 OK");
                    $this->result = "<p style='color: red'>Ошибка соединения с сервером!</p>";
                }
            }
        }
        else
        {
            header("HTTP/1.1 203 OK");
            $this->result = "<p style='color: red'>{$validation->getErrors()}</p>";
        }
    }

    public function getInfo():void
    {
        echo $this->result;
    }
}