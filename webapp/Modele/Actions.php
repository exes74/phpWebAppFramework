<?php

require_once 'Framework/Modele.php';

class Action extends Modele {
	
	// Liste de toutes les actions possibles sur le framework
	public function listAllActions()    {
		$controleurs = [];
		// on liste les controleurs disponibles
		$path    = './Controleur';
		$files = scandir($path);
		$files = array_diff(scandir($path), array('.', '..'));
		foreach ($files as $file){
			if(is_file('./Controleur/'.$file)){
				include_once './Controleur/'.$file;
				$class_name=str_replace(".php","",$file);
				$array_tmp = array_diff(get_class_methods($class_name),array('__construct','clean','setRequete','executerAction' ));
				$array_tmp = array_combine($array_tmp, $array_tmp);
				foreach ($array_tmp as $value =>$key):
					$array_tmp[$value] = [];
					$array_tmp[$value]['name'] = $key;
					$array_tmp[$value]['isActive'] = 0;
					$array_tmp[$value]['id'] = 0;
				endforeach;
				$controleurs[$class_name]=$array_tmp;			
			}
		}
		$allControleurs = $this->checkActionInDb($controleurs);
		return $allControleurs;
    }
	
	public function checkActionInDb($controleurs){
		//get all actions et mise en forme
		$sql = 'SELECT * FROM `actions`';
        $results = $this->executerRequete($sql, array());
        $dataTmp = $results->fetchAll();
		$data = array();
		foreach ($dataTmp as $dataTmp1):
			$newArray = array($dataTmp1['id'],$dataTmp1['name'],'0');	
			$data[$dataTmp1['controleur']][]=$newArray;
		endforeach;
		// print_r('<hr>');
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		//on check pour chaque action recuperee dans les classes si elle existe déja en base pour la mettre à is active=1
		foreach($data as $valueD => $actionD):
			foreach ($actionD as $value => $key):
					if (array_key_exists($key[1],$controleurs[$valueD])){
						$controleurs[$valueD][$key[1]]['isActive']= 1;
						$controleurs[$valueD][$key[1]]['id']= $key[0];
					}
					else{
						$controleurs[$valueD][$key[1]]['name']= $key[1];
						$controleurs[$valueD][$key[1]]['isActive']= 2;
						$controleurs[$valueD][$key[1]]['id']= $key[0];
					}
			endforeach;
		endforeach;

		return($controleurs);
	}
	
	
	//Recuperation de toutes les actions par controleur puis MAJ en base (ajout des nouvelles et suppression des anciennes
	public function updateAllActions(){
		//on recupere toutes les actions
		$allControleurs = $this->listAllActions();
		//on filtre celles qui ne sont pas encore en base (active = 0)
		$updateList = [];
		$deleteList= [];
		foreach ($allControleurs as $controleur => $nameControleur):
			foreach ($nameControleur as $action):
				if ($action['isActive'] == 0){
					array_push($updateList,[$controleur,$action['name']]);
				}
				if ($action['isActive'] == 2){
					array_push($deleteList,[$action['id']]);
				}
			endforeach;
		endforeach;
		print_r($deleteList);
		//insertion en base des actions				
		//préparation du sql
		$sqlValueInsert = '';
		$sqlValueDelete = '';
		foreach ($updateList as $item):
			$sqlValueInsert = $sqlValueInsert."('".$item[0]."','".$item[1]."'),";
		endforeach;
		foreach ($deleteList as $item):
			$sqlValueDelete = $sqlValueDelete."".$item[0].",";
		endforeach;
		$sqlValueDelete= rtrim($sqlValueDelete, ",");
		$sqlValueInsert= rtrim($sqlValueInsert, ",");
		
		if ($sqlValueInsert != ''){
			$sql = "INSERT INTO `actions` (`controleur`, `name`) VALUES ".$sqlValueInsert;
			$insert_actions = $this->executerRequete($sql);
			if ($insert_actions->rowCount() > 0)
				$success_insert = 1;  // Accès à la première ligne de résultat
			else
				$success_insert = 0; 
		}else{
				$success_insert = 1; 
		}
		if ($sqlValueDelete != ''){
			$sql = "delete from `actions` where id in (".$sqlValueDelete.")";
			var_dump($sql);
			$delete_actions = $this->executerRequete($sql);
			if ($delete_actions->rowCount() > 0)
				$success_delete = 1;  // Accès à la première ligne de résultat
			else
				$success_delete = 0; 
		}else{
			$success_delete = 1;
		}		
		if( $success_delete == 1 && $success_insert == 1){
			return 1;
		}else{
			return 0;
		}		
    }
	
	public function getNbActions()    {
        $sql = "select count(1) from actions";
		$nb_actions = $this->executerRequete($sql);
        if ($nb_actions->rowCount() == 1)
            return $nb_actions->fetch();  // Accès à la première ligne de résultat
        else
            return 0;
    }
	
	public function updateAllPrivileges()    {
		//on drop la table de privilege actuelle
		$sql = "delete from user_rights;";
		$results = $this->executerRequete($sql, array());
		//On recupere le tableau USER/ACTION en join user->groups->roles->actions
        $sql = "SELECT user.id, actions.id, actions.controleur, actions.name FROM user inner join user_groups on user.id = user_groups.idUser inner join groups_roles on groups_roles.idGroups = user_groups.IdGroup inner join roles_actions on roles_actions.idRole=groups_roles.idRoles inner join actions on roles_actions.idAction = actions.id";
		$results = $this->executerRequete($sql, array());
        $user_actions = $results->fetchAll();
		//on prépare le tableau des droits pour insertion
		$sqlValueInsert = '';
		foreach ($user_actions as $item):
			$sqlValueInsert = $sqlValueInsert."(".$item[0].",".$item[1].",'".$item[2]."','".$item[3]."'),";
		endforeach;
		$sqlValueInsert= rtrim($sqlValueInsert, ",");
		$sql = "INSERT INTO `user_rights` (`idUser`, `IdAction`, `controleurName`, `actionName`)  VALUES  ".$sqlValueInsert.";";
		$insert_actions = $this->executerRequete($sql);
		if ($insert_actions->rowCount() > 0)
			return 1;  // Accès à la première ligne de résultat
		else
			return 0;		
    }
	
	public function updateUserPrivileges($idUser)    {
		//on drop la table de privilege actuelle
		$sql = "delete from user_rights where idUser = ?;";
		$results = $this->executerRequete($sql, array($idUser));
		//On recupere le tableau USER/ACTION en join user->groups->roles->actions
        $sql = "SELECT user.id, actions.id, actions.controleur, actions.name FROM user inner join user_groups on user.id = user_groups.idUser inner join groups_roles on groups_roles.idGroups = user_groups.IdGroup inner join roles_actions on roles_actions.idRole=groups_roles.idRoles inner join actions on roles_actions.idAction = actions.id where user.id = ?";
		$results = $this->executerRequete($sql, array($idUser));
        if ($results->rowCount() > 0){
			$user_actions = $results->fetchAll();
		
			//on prépare le tableau des droits pour insertion
			$sqlValueInsert = '';
			foreach ($user_actions as $item):
				$sqlValueInsert = $sqlValueInsert."(".$item[0].",".$item[1].",'".$item[2]."','".$item[3]."'),";
			endforeach;
			$sqlValueInsert= rtrim($sqlValueInsert, ",");
			$sql = "INSERT INTO `user_rights` (`idUser`, `IdAction`, `controleurName`, `actionName`)  VALUES  ".$sqlValueInsert.";";
			$insert_actions = $this->executerRequete($sql);
			if ($insert_actions->rowCount() > 0)
				return 1;  // Accès à la première ligne de résultat
			else
				return 0;
		}
    }


	public function removeActionFromRole($idAction,$idRole)   {
		$sql = "delete from `roles_actions` where idRole = ? and idAction = ?;";
        $data = $this->executerRequete($sql, array($idRole,$idAction));
		if ($data->rowCount() == 1){
				return 1;  // Accès à la première ligne de résultat
		}else{
				return 0;
		}
    }
	
	public function addActionToRole($idAction,$idRole)    {
		$sql = "INSERT INTO `roles_actions` (`id`, `idRole`, `idAction`) VALUES (NULL, ?, ?);";
        $data = $this->executerRequete($sql, array($idRole,$idAction));
		if ($data->rowCount() == 1){
				return 1;  // Accès à la première ligne de résultat
		}else{
				return 0;
		}
    }
	
	public function getActionsInRole($actionId) {
		$returnHtml = '';
		//get actions in role
		$sql = "SELECT roles.id, roles.name FROM `roles` join `roles_actions` on roles.id = roles_actions.idRole join actions on roles_actions.idAction = actions.id where actions.id =?";
        $inRole = $this->executerRequete($sql, array($actionId));
		//get actions not in role	
		$sql = "SELECT roles.id, roles.name FROM `roles` where roles.id not in (SELECT roles.id FROM `roles` join `roles_actions` on roles.id = roles_actions.idRole join actions on roles_actions.idAction = actions.id where actions.id = ?)";
		$notInRole = $this->executerRequete($sql, array($actionId));

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
	
}
