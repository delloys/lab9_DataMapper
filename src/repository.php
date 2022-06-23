<?php

namespace root\ActiveRecord;
use root\ActiveRecord\data_Mapper;

class repository
{
    private data_Mapper $dataM;
    private $info = array();

    public function __construct()
    {
        $this->dataM = new data_Mapper();
        $this->info = $this->dataM->getAllDM();
    }

    public function getAllRep()
    {
        echo "repos";
        $this->dataM->getAllInfoDM($this->info);
    }

    public function getByIDRep($id)
    {
        $this->dataM->getByIDDN($id,$this->info);
    }

    public function getFilterRep($login)
    {
        $this->dataM->getFilterDM($login,$this->info);
    }

    public function addInfoRep($login,$pass,$msg)
    {
        $this->dataM->addInfoDM($login,$pass,$msg);
        $this->info = $this->dataM->getAllDM();
    }
    public function changeInfoRep($id,$newPass)
    {
        $this->dataM->changeInfoDM($id,$newPass);
        $this->info = $this->dataM->getAllDM();
    }
    public function deleteInfoRep($id)
    {
        $this->dataM->deleteInfoDM($id);
        $this->info = $this->dataM->getAllDM();
    }

}