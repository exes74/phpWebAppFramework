<?php

require_once 'Framework/Modele.php';

class User extends Modele {

    /**
     * Vérifie qu'un utilisateur existe dans la BD
     * @param string $login Le login
     * @param string $mdp Le mot de passe
     * @return boolean Vrai si l'utilisateur existe, faux sinon
     */
    public function connecter($login, $pass){		
        $sql = "select password from user where username = ? ";
		$password = $this->executerRequete($sql, array($login));
		if ($password->rowCount() == 1){ 
			$passDb = $password->fetch();
			if(password_verify($pass, $passDb['password'])) {
				return 1;
			}else{
				return 0;				
			}
		}else{
			return 0;
		}
    }
	
	public function getUserRights($id_user){
		$sql = "select controleurName, actionName from user_rights where idUser = ? ";
		$get_rights = $this->executerRequete($sql, array($id_user));
        if ($get_rights->rowCount() > 0){
            $tmpArray=  $get_rights->fetchAll(PDO::FETCH_ASSOC);  //on get en assoc
			$userRights = [];
			foreach ($tmpArray as $controleur): 
				array_push($userRights, strtolower($controleur['controleurName'].'_'.$controleur['actionName']));
			endforeach;
			return $userRights;
        }else{
            return NULL;
		}
	}
	

	public function checkPassword($login, $pass){		
        $sql = "select password from user where id = ? ";
		$password = $this->executerRequete($sql, array($login));
		if ($password->rowCount() == 1){ 
			$passDb = $password->fetch();
			if(password_verify($pass, $passDb['password'])) {
				return 1;
			}else{
				return 0;				
			}
		}else{
			return 0;
		}
    }
	
    public function getUtilisateur($login)    {
        $sql = "select username as login, id, password as mdp, is_admin, activated from user where username=? ";
        $utilisateur = $this->executerRequete($sql, array($login));
        if ($utilisateur->rowCount() == 1)
            return $utilisateur->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("No user match the given identifiers.");
    }
	
	public function getUsername($username)    {
        $sql = "select username from user where username = ? ";
		$login_used = $this->executerRequete($sql, array($username));
        if ($login_used->rowCount() == 1)
            return 1;  // Accès à la première ligne de résultat
        else
            return 0;
    }
	
	public function getUserId($username)    {
        $sql = "select id from user where username = ? ";
		// var_dump($sql.$username);
		$idTmp = $this->executerRequete($sql, array($username));
        if ($idTmp->rowCount() == 1)
            return $idTmp -> fetch();  // Accès à la première ligne de résultat
        else
            return NULL;
    }
	
	public function getNbUsers()    {
        $sql = "select count(1) from user";
		$nb_users = $this->executerRequete($sql);
        if ($nb_users->rowCount() == 1)
            return $nb_users->fetch();  // Accès à la première ligne de résultat
        else
            return 0;
    }
	
	public function detailUser($id)    {
        $sql = "select id,username, create_time, is_admin, activated from user where id=?";
        $utilisateur = $this->executerRequete($sql, array($id));
        if ($utilisateur->rowCount() == 1)
            return $utilisateur->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun utilisateur ne correspond aux identifiants fournis");
    }
	
	public function getAllUsers()    {
        $sql = "select id,username, create_time, is_admin, activated from user";
        $data = $this->executerRequete($sql, array());
        if ($data->rowCount() > 0)
            return $data->fetchAll();  // Accès à la première ligne de résultat
        else
			return 'Empty';
    }
	
	public function deleteUser($id)    {
		if($id != 0){
			$sql = "delete from user where id=?";
			$delUser = $this->executerRequete($sql, array($id));
			$sql = "delete from user_groups where idUser=?";
			$delUser = $this->executerRequete($sql, array($id));
			if ($delUser->rowCount() == 1)
				return 1;  // Accès à la première ligne de résultat
			else
				return 0;
		}
	}
	
	public function insertUser($name,$passHash)    {
		// on insert le user
		$sql = "INSERT INTO `user`(`username`, `password`, `activated`, `is_admin`) VALUES (?,?,1,0)";
		$insert_user = $this->executerRequete($sql, array($name,$passHash));
        if ($insert_user->rowCount() == 1){
			return 1;
		}else{
			return 0;
		}
    }	
	
	public function updatePassword($id_user, $newPass)   {		
        $sql = "update user set password = ? where id = ? ";
        $success = $this->executerRequete($sql, array($newPass, $id_user,));
        if ($success->rowCount() == 1)
            return 1;  // Accès à la première ligne de résultat
        else
			return 0;
    }
	
	public function activateUser($id_user)   {		
        $sql = "update user set activated = 1 where id = ? ";
        $success = $this->executerRequete($sql, array($id_user));
        if ($success->rowCount() == 1)
            return 1;  // Accès à la première ligne de résultat
        else
			return 0;
    }
	
	public function deactivateUser($id_user)   {		
        $sql = "update user set activated = 0 where id = ? ";
        $success = $this->executerRequete($sql, array($id_user));
        if ($success->rowCount() == 1)
            return 1;  // Accès à la première ligne de résultat
        else
			return 0;
    }
	
	public function setAdmin($id_user)   {		
        $sql = "update user set admin = 1 where id = ? ";
        $success = $this->executerRequete($sql, array($id_user));
        if ($success->rowCount() == 1)
            return 1;  // Accès à la première ligne de résultat
        else
			return 0;
    }
	
	public function unsetAdmin($id_user)   {		
        $sql = "update user set admin = 0 where id = ? ";
        $success = $this->executerRequete($sql, array($id_user));
        if ($success->rowCount() == 1)
            return 1;  // Accès à la première ligne de résultat
        else
			return 0;
    }
	
	public function getDefaultDashboardView($id_user,$viewType)    {
		if($viewType == 'standard'){
			$sql = "select defaultview  from user where id=?";
		}elseif($viewType== 'full'){
			$sql = "select defaultviewfull  from user where id=?";
		}  
        $sql = "select defaultview  from user where id=?";
        $utilisateur = $this->executerRequete($sql, array($id_user));
        if ($utilisateur->rowCount() == 1)
            return $utilisateur->fetch(); 
        else
            return 0;
    }
	
	public function updateDefaultView($id_user, $idview,$viewType) {
		if($viewType == 'standard'){
			$sql = "update user set defaultview = ? where id = ? ";
		}elseif($viewType== 'full'){
			$sql = "update user set defaultviewfull = ? where id = ? ";
		}       
        $success = $this->executerRequete($sql, array($idview, $id_user));
        if ($success->rowCount() == 1)
            return 1;  // Accès à la première ligne de résultat
        else
			return 0;
    }
	

	
}

