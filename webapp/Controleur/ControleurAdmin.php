<?php

require_once 'ControleurAdministration.php';
require_once 'Modele/Users.php';
require_once 'Modele/Groups.php';
require_once 'Modele/Roles.php';
require_once 'Modele/Actions.php';
/**
 * Controleur des actions d'administration
 */
class ControleurAdmin extends ControleurAdministration
{
    public function __construct(){
		$this->user = new User();
		$this->groups = new Group();
		$this->roles = new Role();
		$this->actions = new Action();
    }
	
    public function viewIndex()
    {
		$nbUsers = $this->user->getNbUsers();
		$nbGroups = $this->groups->getNbGroups();
		$nbRoles = $this->roles->getNbRoles();
        $this->genererVue(array('nbUsers' => $nbUsers, 'nbGroups' => $nbGroups , 'nbRoles' => $nbRoles ));
	}
	
    public function index()
    {
		$nbUsers = $this->user->getNbUsers();
		$nbGroups = $this->groups->getNbGroups();
		$nbRoles = $this->roles->getNbRoles();
		$nbActions = $this->actions->getNbActions();
        $this->genererVue(array('nbUsers' => $nbUsers, 'nbGroups' => $nbGroups , 'nbRoles' => $nbRoles, 'nbActions' => $nbActions ));
    }
	
	public function users()
    {
		$users = $this->user->getAllUsers();
        $this->genererVue(array('users' => $users));
    }
	
	public function actions()
    {
		$allControleurs = $this->actions->listAllActions();
        $this->genererVue(array('allControleurs' => $allControleurs));
    }
	
	public function updateAllActions(){
		// $this->genererVue();
		$this->actions->updateAllActions();
	}
	
	//gestion des appels AJAX au controleur d'admin (non configurable piece/piece)
	public function ajax(){
		if ($this->requete->existeParametre("do")){
			$do = $this->requete->getParametre("do");
			switch($do){
				/////////////////GESTION DES ACTIONS AJAX/////////////////////
			case 'updateAllActions':
				if ($this->actions->updateAllActions() == 1){
					$data = 'Mise &agrave; jour r&eacute;ussie';
				}else{
					$data = 'Erreur lors de la mise &agrave; jour en base.'	;
				}
				break;
			case 'updatePrivileges':
				if ($this->actions->updateAllPrivileges() == 1){
					$data = 'Mise &agrave; jour r&eacute;ussie';
				}else{
					$data = 'Erreur lors de la mise &agrave; jour en base.'	;
				}
				break;
			case 'groupActionsMapping':
				$actionId = $this->requete->getParametre("actionId");
				$data = $this->actions->getActionsInRole($actionId);
				break;
			case 'addActionToRole':
				if($this->requete->existeParametre("idAction") && $this->requete->existeParametre("idRole")  ){
					$idAction = $this->requete->getParametre("idAction");
					$idRole = $this->requete->getParametre("idRole");
					if ($this->actions->addActionToRole($idAction,$idRole) == 1){
						$data = 'Ajout reussi';
					}else{
						$data = 'Erreur lors de l\'ajout de l\'action au role'	;
					}
				}
				break;
			case 'removeActionFromRole':
				if($this->requete->existeParametre("idAction") && $this->requete->existeParametre("idRole")  ){
					$idAction = $this->requete->getParametre("idAction");
					$idRole = $this->requete->getParametre("idRole");
					if ($this->actions->removeActionFromRole($idAction,$idRole) == 1){
						$data = 'Suppression reussie';
					}else{
						$data = 'Erreur lors de la supression de l\'action du role'	;
					}
				}
				break;
				/////////////GESTION DES UTILISATEURS AJAX/////////////////////
			case 'deleteUser':
				$id_user = $this->requete->getParametre("idUser");
				if ($this->user->deleteUser($id_user) == 1){
					$data = 'Supression r&eacute;ussie';
				}else{
					$data = 'Erreur lors de la supression.'	;
				}
				break;
			case 'activateUser':
				$id_user = $this->requete->getParametre("idUser");
				if ($this->user->activateUser($id_user) == 1){
					$data = 'Activation r&eacute;ussie';
				}else{
					$data = 'Erreur lors de l\'activation.'	;
				}
				break;
			case 'desactivateUser':
				$id_user = $this->requete->getParametre("idUser");
				if ($this->user->deactivateUser($id_user) == 1){
					$data = 'Desactivation r&eacute;ussie';
				}else{
					$data = 'Erreur lors de la desactivation.'	;
				}
				break;
				//////////////GESTION DES GROUPES AJAX /////////////////////////
			case 'userGroupsMapping':
				$idGroup = $this->requete->getParametre("groupId");
				$data = $this->groups->getUsersInGroup($idGroup);
				break;
			case 'createGroup':
				if($this->requete->existeParametre("nameGroup") && $this->requete->existeParametre("description")  ){
					$name = $this->requete->getParametre("nameGroup");
					$description = $this->requete->getParametre("description");
					if ($this->groups->createGroup($name,$description) == 1){
						$data = 'Cr&eacute;ation du groupe r&eacute;ussie';
					}else{
						$data = 'Erreur lors de création du groupe.'	;
					}
				}
				break;
			case 'addUserToGroup':
				if($this->requete->existeParametre("idUser") && $this->requete->existeParametre("idGroup")  ){
					$idUser = $this->requete->getParametre("idUser");
					$idGroup = $this->requete->getParametre("idGroup");
					if ($this->groups->addUserToGroup($idUser,$idGroup) == 1){
						$data = 'Ajout reussi';
					}else{
						$data = 'Erreur lors de l\'ajout au groupe'	;
					}
				}
				break;
			case 'removeUserFromGroup':
				if($this->requete->existeParametre("idUser") && $this->requete->existeParametre("idGroup")  ){
					$idUser = $this->requete->getParametre("idUser");
					$idGroup = $this->requete->getParametre("idGroup");
					if ($this->groups->removeUserFromGroup($idUser,$idGroup) == 1){
						$data = 'Suppression reussie';
					}else{
						$data = 'Erreur lors de la supression de l\'utilisatreur dans le groupe'	;
					}
				}
				break;
			case 'renameGroup':
				if($this->requete->existeParametre("idGroup") &&$this->requete->existeParametre("nameGroup") && $this->requete->existeParametre("description")  ){
					$idGroup = $this->requete->getParametre("idGroup");
					$name = $this->requete->getParametre("nameGroup");
					$description = $this->requete->getParametre("description");
					if ($this->groups->renameGroup($idGroup,$name,$description) == 1){
						$data = 'Modification du groupe r&eacute;ussie';
					}else{
						$data = 'Erreur lors de la modification du groupe.'	;
					}
				}
				break;
			case 'deleteGroup':
				$id_group = $this->requete->getParametre("idGroup");
				if ($this->groups->deleteGroup($id_group) == 1){
					$data = 'Supression r&eacute;ussie';
				}else{
					$data = 'Erreur lors de la supression.'	;
				}
				break;
			//////////GESTION DES ROLES AJAX/////////////////////
			case 'groupRolesMapping':
				$idRole = $this->requete->getParametre("roleId");
				$data = $this->roles->getGroupsInRole($idRole);
				break;
			case 'createRole':
				if($this->requete->existeParametre("nameRole") && $this->requete->existeParametre("description")  ){
					$name = $this->requete->getParametre("nameRole");
					$description = $this->requete->getParametre("description");
					if ($this->roles->createRole($name,$description) == 1){
						$data = 'Cr&eacute;ation du role r&eacute;ussie';
					}else{
						$data = 'Erreur lors de création du role.'	;
					}
				}
				break;
			case 'addGroupToRole':
				if($this->requete->existeParametre("idGroup") && $this->requete->existeParametre("idRole")  ){
					$idRole = $this->requete->getParametre("idRole");
					$idGroup = $this->requete->getParametre("idGroup");
					if ($this->roles->addGroupToRole($idGroup,$idRole) == 1){
						$data = 'Ajout reussi';
					}else{
						$data = 'Erreur lors de l\'ajout au role'	;
					}
				}
				break;
			case 'removeGroupFromRole':
				if($this->requete->existeParametre("idRole") && $this->requete->existeParametre("idGroup")  ){
					$idRole = $this->requete->getParametre("idRole");
					$idGroup = $this->requete->getParametre("idGroup");
					if ($this->roles->removeGroupFromRole($idGroup,$idRole) == 1){
						$data = 'Suppression reussie';
					}else{
						$data = 'Erreur lors de la supression du groupe dans le role'	;
					}
				}
				break;
			case 'renameRole':
				if($this->requete->existeParametre("idRole") &&$this->requete->existeParametre("nameRole") && $this->requete->existeParametre("description")  ){
					$idRole = $this->requete->getParametre("idRole");
					$name = $this->requete->getParametre("nameRole");
					$description = $this->requete->getParametre("description");
					if ($this->roles->renameRole($idRole,$name,$description) == 1){
						$data = 'Modification du role r&eacute;ussie';
					}else{
						$data = 'Erreur lors de la modification du role.'	;
					}
				}
				break;
			case 'deleteRole':
				$id_role = $this->requete->getParametre("idRole");
				if ($this->roles->deleteRole($id_role) == 1){
					$data = 'Supression r&eacute;ussie';
				}else{
					$data = 'Erreur lors de la supression.'	;
				}
				break;
			
			
			//////////////EEEEEEND/////////////
			default:
				$data = '';
			}
			print_r($data);	
		}else{
			print_r('Impossible');	
		}
	}
	
	public function groups()
    {
        $groups = $this->groups->getAllGroups();
        $this->genererVue(array('groups' => $groups));
    }
	
	public function roles()
    {
		$roles = $this->roles->getAllRoles();
        $this->genererVue(array('roles' => $roles));
    }
}

