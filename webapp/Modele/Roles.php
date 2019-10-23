<?php

require_once 'Framework/Modele.php';

class Role extends Modele {
	
	public function getNbRoles()    {
        $sql = "select count(1) from roles";
		$nb_roles = $this->executerRequete($sql);
        if ($nb_roles->rowCount() == 1)
            return $nb_roles->fetch();  // Accès à la première ligne de résultat
        else
            return 0;
    }
	
	public function getAllRoles()    {
        $sql = "select id,name, description from roles";
        $data = $this->executerRequete($sql, array());
        if ($data->rowCount() > 0)
            return $data->fetchAll();  // Accès à la première ligne de résultat
        else
			return 'Empty';
    }
	
	public function deleteRole($id)    {
		$sql = "delete from groups_roles where idRoles = ?";
        $data = $this->executerRequete($sql, array($id));
        $sql = "delete from roles where id = ?";
        $data = $this->executerRequete($sql, array($id));
		// $sql = "delete from roles_actions where idGroups = ?";
        // $data = $this->executerRequete($sql, array($id));
		if ($data->rowCount() == 1){
				return 1;  // Accès à la première ligne de résultat
		}else{
				return 0;
		}
    }
	
	public function renameRole($id,$name,$description)    {
        $sql = "update roles set name= ?, description = ? where id = ?";
        $data = $this->executerRequete($sql, array($name, $description, $id));
		if ($data->rowCount() == 1){
				return 1;  // Accès à la première ligne de résultat
		}else{
				return 0;
		}
    }
	
	public function createRole($name,$description)    {
		$sql = "INSERT INTO `roles` (`id`, `name`, `description`) VALUES (NULL, ?, ?);";
        $data = $this->executerRequete($sql, array($name,$description));
		if ($data->rowCount() == 1){
				return 1;  // Accès à la première ligne de résultat
		}else{
				return 0;
		}
    }
	
	public function getGroupsInRole($idRole) {
		$returnHtml = '';
		//get users in group
		$sql = "SELECT groups.id, groups.name FROM `groups` join `groups_roles` on groups.id = groups_roles.idGroups join roles on groups_roles.idRoles = roles.id where roles.id = ?";
        $inRole = $this->executerRequete($sql, array($idRole));
		//get users not in group	
		$sql = "SELECT groups.id, groups.name FROM `groups` where groups.id not in (SELECT groups.id FROM `groups` join `groups_roles` on groups.id = groups_roles.idGroups join roles on groups_roles.idRoles = roles.id where roles.id = ?)";
		$notInRole = $this->executerRequete($sql, array($idRole));

		if ($inRole->rowCount() > 0){
			$tabInRole = $inRole->fetchAll(); 
			foreach($tabInRole as $group):
				$returnHtml = $returnHtml."<option value='".$group['id']."' selected>".$group['name']."</option>";
			endforeach;
		}
		if ($notInRole->rowCount() > 0){			
			$tabNotInRole = $notInRole->fetchAll();
			foreach($tabNotInRole as $group):
				$returnHtml = $returnHtml."<option value='".$group['id']."' >".$group['name']."</option>";
			endforeach;
		}
		return $returnHtml;
    }
	
	public function removeGroupFromRole($idGroup,$idRole)   {
		$sql = "delete from `groups_roles` where idGroups = ? and IdRoles = ?;";
        $data = $this->executerRequete($sql, array($idGroup,$idRole));
		if ($data->rowCount() == 1){
				return 1;  // Accès à la première ligne de résultat
		}else{
				return 0;
		}
    }
	
	public function addGroupToRole($idGroup,$idRole)   {
		$sql = "INSERT INTO `groups_roles` (`id`, `idGroups`, `idRoles`) VALUES (NULL, ?, ?);";
        $data = $this->executerRequete($sql, array($idGroup,$idRole));
		if ($data->rowCount() == 1){
				return 1;  // Accès à la première ligne de résultat
		}else{
				return 0;
		}
    }
	
}