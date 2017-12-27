<?php

class Usuario
{
    private $idUsuario;
    private $desLogin;
    private $desSenha;
    private $dtCadastro;
    

    /**
     * Get the value of idUsuario
     */ 
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     *
     * @return  self
     */ 
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get the value of desLogin
     */ 
    public function getDesLogin()
    {
        return $this->desLogin;
    }

    /**
     * Set the value of desLogin
     *
     * @return  self
     */ 
    public function setDesLogin($desLogin)
    {
        $this->desLogin = $desLogin;

        return $this;
    }

    /**
     * Get the value of desSenha
     */ 
    public function getDesSenha()
    {
        return $this->desSenha;
    }

    /**
     * Set the value of desSenha
     *
     * @return  self
     */ 
    public function setDesSenha($desSenha)
    {
        $this->desSenha = $desSenha;

        return $this;
    }

    /**
     * Get the value of dtCadastro
     */ 
    public function getDtCadastro()
    {
        return $this->dtCadastro;
    }

    /**
     * Set the value of dtCadastro
     *
     * @return  self
     */ 
    public function setDtCadastro($dtCadastro)
    {
        $this->dtCadastro = $dtCadastro;

        return $this;
    }

    public function loadById($id){
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_Usuario WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));

        if(count($results) > 0){
            $row = $results[0];
            $this->setIdUsuario($row['idusuario']);
            $this->setDesLogin($row['desLogin']);
            $this->setDesSenha($row['desSenha']);
            $this->setDtCadastro(new DateTime($row['dtCadastro']));
        }
    }

    public static function getList(){
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_Usuario ORDER BY desLogin");
    }

    public static function search($login){
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_Usuario WHERE desLogin LIKE :SEARCH ORDER BY desLogin", array(
            ':SEARCH' => "%".$login."%"
        ));
    }

    public function login($login, $password){

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_Usuario WHERE desLogin = :LOGIN AND desSenha = :PASSWORD", array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));

        if(count($results) > 0){
            $row = $results[0];
            $this->setIdUsuario($row['idusuario']);
            $this->setDesLogin($row['desLogin']);
            $this->setDesSenha($row['desSenha']);
            $this->setDtCadastro(new DateTime($row['dtCadastro']));
        } else {
            throw new Exception("Login e/ou senha inválidos", 1);
            
        }

    }


    public function __toString(){
        return json_encode(array(
            "idusuario" => $this->getIdUsuario(),
            "desLogin" => $this->getDesLogin(),
            "desSenha" => $this->getDesSenha(),
            "dtCadastro"=>$this->getDtCadastro()->format("d/m/y H:i:s")
        ));
        


    }
}
