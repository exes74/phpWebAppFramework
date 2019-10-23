<?php

require_once 'Framework/Modele.php';

class Group extends Modele {
	
	public function getNbGroups()    {
        $sql = "select count(1) from groups";
		$nb_groups = $this->executerRequete($sql);
        if ($nb_groups->rowCount() == 1)
            return $nb_groups->fetch();  // Accès à la première ligne de résultat
        else
            return 0;
    }
		
	public function getAllGroups()    {
        $sql = "select id,name, description from groups";
        $data = $this->executerRequete($sql, array());
        if ($data->rowCount() > 0)
            return $data->fetchAll();  // Accès à la première ligne de résultat
        else
			return 'Empty';
    }
	
	public function deleteGroup($id)    {
        $sql = "delete from groups where id = ?";
        $data = $this->executerRequete($sql, array($id));
		$sql = "delete from user_groups where idGroup = ?";
        $data = $this->executerRequete($sql, array($id));
		$sql = "delete from groups_roles where idGroups = ?";
        $data = $this->executerRequete($sql, array($id));
		if ($data->rowCount() == 1){
				return 1;  // Accès à la première ligne de résultat
		}else{
				return 0;
		}
    }
	
	public function renameGroup($id,$name,$description)    {
        $sql = "update groups set name= ?, description = ? where id = ?";
        $data = $this->executerRequete($sql, array($name, $description, $id));
		if ($data->rowCount() == 1){
				return 1;  // Accès à la première ligne de résultat
		}else{
				return 0;
		}
    }
	
	public function createGroup($name,$description)    {
		$sql = "INSERT INTO `groups` (`id`, `name`, `description`) VALUES (NULL, ?, ?);";
        $data = $this->executerRequete($sql, array($name,$description));
		if ($data->rowCount() == 1){
				return 1;  // Accès à la première ligne de résultat
		}else{
				return 0;
		}
    }
	
	public function getUsersInGroup($idGroup) {
		$returnHtml = '';
		//get users in group
		$sql = "SELECT distinct user.id, user.username FROM `user` join `user_groups` on user.id = user_groups.idUser join groups on user_groups.idGroup = groups.id where groups.id = ?";
        $inGroup = $this->executerRequete($sql, array($idGroup));
		//get users not in group	
		$sql = "select user.id,user.username from user where user.id not in (SELECT distinct user.id FROM `user` join `user_groups` on user.id = user_groups.idUser join groups on user_groups.idGroup = groups.id where groups.id = ?)";
		$notInGroup = $this->executerRequete($sql, array($idGroup));

		if ($inGroup->rowCount() > 0){
			$tabInGroup = $inGroup->fetchAll(); 
			foreach($tabInGroup as $user):
				$returnHtml = $returnHtml."<option value='".$user['id']."' selected>".$user['username']."</option>";
			endforeach;
		}
		if ($notInGroup->rowCount() > 0){			
			$tabNotInGroup = $notInGroup->fetchAll();
			foreach($tabNotInGroup as $user):
				$returnHtml = $returnHtml."<option value='".$user['id']."' >".$user['username']."</option>";
			endforeach;
		}
		return $returnHtml;
    }
	
	public function removeUserFromGroup($idUser,$idGroup)   {
		$sql = "delete from `user_groups` where idUser = ? and IdGroup = ?;";
        $data = $this->executerRequete($sql, array($idUser,$idGroup));
		if ($data->rowCount() == 1){
				return 1;  // Accès à la première ligne de résultat
		}else{
				return 0;
		}
    }
	
	public function addUserToGroup($idUser,$idGroup)   {
		$sql = "INSERT INTO `user_groups` (`id`, `idUser`, `IdGroup`) VALUES (NULL, ?, ?);";
        $data = $this->executerRequete($sql, array($idUser,$idGroup));
		if ($data->rowCount() == 1){
				return 1;  // Accès à la première ligne de résultat
		}else{
				return 0;
		}
    }
	
}