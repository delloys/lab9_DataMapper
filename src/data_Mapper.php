<?php

namespace root\ActiveRecord;
use PDO;

class data_Mapper
{
    private $id;
    private $login;
    private $pass;
    private $msg;
    private $link;

    public function __construct()
    {
        $this->link = new PDO('mysql:host=localhost;dbname=msgDB', 'delloys', 'delloyspass');
    }

    public function Command($command)
    {
        $sql = $this->link->prepare($command);
        $sql->execute();
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getLogin()
    {
        return $this->login;
    }
    public function setLogin($login)
    {
        $this->login = $login;
    }
    public function getPass()
    {
        return $this->pass;
    }
    public function setPass($pass)
    {
        $this->pass = $pass;
    }
    public function getMsg()
    {
        return $this->msg;
    }
    public function setMsg($msg)
    {
        $this->msg=$msg;
    }

    public function getAllDM(): array
    {
        $cmd = "select * from msgs;";
        $sql = $this->link->prepare($cmd);
        $sql->execute();
        $result = $sql->fetchAll();
        $info = array();
        if (isset($result)) {
            foreach ($result as $row)
            {
                echo $cmd;
                $NewInfo = new data_Mapper();
                $NewInfo->setId($row['id']);
                $NewInfo->setLogin($row['login']);
                $NewInfo->setPass($row['pass']);
                $NewInfo->setMsg($row['msg']);
                echo $NewInfo->pass;

                array_push($info, $NewInfo);
            }
        }
        return $info;
    }

    public function getAllInfoDM($users)
    {
        foreach ($users as $record)
        {
            $id = $record->getId();
            $login = $record->getLogin();
            $pass = $record->getPass();
            $msg = $record->getMsg();
            echo "<p>" . "ID : ". $id . " | Логин : " . $login . "| Пароль : " . $pass . "  | Сообщение : ". $msg . "</p>";
        }
    }

    public function getByIDDN($id,$info)
    {
        $result = '';
        foreach ($info as $record)
        {
            if ($record->getId() == $id)
            {
                $result = "<p>" . "ID : ".$record->getId() .' | Логин : '. $record->getLogin() .'| Пароль :'. $record->getPass() .' | Сообщение : '. $record->getMsg();
            }
        }
        if ($result === '')
        {
            echo "Записи с таким id не существует";
        } else {
            echo $result;
        }
    }

    public function getFilterDM($login,$info)
    {
        $result ='<p>';
        foreach ($info as $record)
        {
            if (trim($record->getLogin()," ") ===$login)
            {
                $result = "<p>" . "ID : ".$record->getId() .' | Логин : '. $record->getLogin() .'| Пароль :'. $record->getPass() .' | Сообщение : '. $record->getMsg();
            }
        }
        echo $result;
    }

    public function addInfoDM($login,$pass,$msg)
    {
        $this->Command("insert into msgs(login,pass,msg) values ('$login','$pass','$msg');");
    }

    public function changeInfoDM($id,$newPass) {
        $this->Command("update msgs set  pass = '$newPass' where id = $id;");
    }

    public function deleteInfoDM($id) {
        $this->Command("delete from msgs where id = $id;");

    }

}
