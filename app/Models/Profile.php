<?php

namespace App\Models;

use MVC\Model\Model;

class Profile extends Model
{

    private $id;
    private $profileName;
    private $status;
    private $vizualizar;
    private $atualizar;
    private $cadastrar;
    private $deletar;

    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }

    // Recuperar todos os perfis
    public function showAll() 
    {
        $q = "select * from profiles";
        return $this->db->query($q)->fetchAll();
    }

    // Recupera dados pelo ID
    public function show($id)
    {
        $q = "select * from profiles where id = $id";
        return $this->db->query($q)->fetch();
    }

    // Salvar dados
    public function store()
    {
        $q = "insert into profiles(profileName, status, vizualizar, atualizar, cadastrar, deletar) values (:profileName, :status, :vizualizar, :atualizar, :cadastrar, :deletar)";
        $stmt = $this->db->prepare($q);
        $stmt->bindValue(':profileName', $this->__get('profileName'));
        $stmt->bindValue(':status', $this->__get('status'));
        $stmt->bindValue(':vizualizar', $this->__get('vizualizar'));
        $stmt->bindValue(':atualizar', $this->__get('atualizar'));
        $stmt->bindValue(':cadastrar', $this->__get('cadastrar'));
        $stmt->bindValue(':deletar', $this->__get('deletar'));
        $stmt->execute();

        return $this;
    }

    // Atualizar dados
    public function update()
    {
        $q = 'update profiles set profileName = :profileName, status = :status, vizualizar = :vizualizar, cadastrar = :cadastrar, atualizar = :atualizar, deletar = :deletar where id = :id';
        $stmt = $this->db->prepare($q);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->bindValue(':profileName', $this->__get('profileName'));
        $stmt->bindValue(':status', $this->__get('status'));
        $stmt->bindValue(':vizualizar', $this->__get('vizualizar'));
        $stmt->bindValue(':cadastrar', $this->__get('cadastrar'));
        $stmt->bindValue(':atualizar', $this->__get('atualizar'));
        $stmt->bindValue(':deletar', $this->__get('deletar'));
        $stmt->execute();

        return $this;
    }

    // Deletar perfil
    public function destroy($id)
    {
        $q = "delete from profiles where id = $id";
        $stmt = $this->db->prepare($q);
        $stmt->execute();

        return $this;
    }
}
