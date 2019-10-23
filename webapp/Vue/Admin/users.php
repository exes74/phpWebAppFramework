<?php 
$this->titre = "Administration";
$this->class_css = "admin";
$subClass_css = "subClass_users";
//utilisé pour les selector en no JS
include("./lib/adminSubMenu.php"); 
 ?>
<h2>Administration - Gestion des utilisateurs</h2>
<div id="returnCoinCrud">
</div>
<div class='even'>
	<table id="userlist" class="display" style="width:100%">
		<thead>
			<tr>
				<th class='thfull'>Id User</th>
				<th class='thfull'>Nom</th>
				<th class='thfull'>Créé le</th>
				<th class='thfull'>Activé</th>
				<th class='thfull'>Master Admin</th>
				<th class='thfull'>Actions</th>				
			</tr>
		</thead>
		<tbody>
<?php foreach ($users as $user):?>
		<tr>
			<th><?= $this->cln($user['id']) ?></th>
			<th><?= $this->cln($user['username']) ?></th>
			<th><?= $this->cln($user['create_time']) ?></th>
			<th><?= str_replace(1 , "Oui" , $this->cln($user['activated'])) ?:"Non" ?></th>
			<th><?= str_replace(1 , "Oui" , $this->cln($user['is_admin'])) ?:"Non" ?></th>
			<th>
				<button class='rmUser' id="<?= $this->cln($user['id']) ?>" nameUser="<?= $this->cln($user['username']) ?>">Supprimer</button>
				<button class='<?= str_replace(1 , "daUser" , $this->cln($user['activated'])) ?:"acUser" ?>' id="<?= $this->cln($user['id']) ?>" nameUser="<?= $this->cln($user['username']) ?>" ><?= str_replace(1 , "Désactiver" , $this->cln($user['activated'])) ?:"Activer" ?></button>	
			</th>
		</tr>
<?php endforeach; ?>			
		</tbody>
	</table>
</div>


