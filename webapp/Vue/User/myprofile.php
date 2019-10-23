<?php $this->titre = "Dashboard - My Profile"; ?>
<?php $this->class_css = "myprofile"; ?>

<br/>
<h2>Mon Profil</h2>
<div class='content_even'>
<fieldset>
	<legend><h3>Mes informations</h3></legend>
	<table class="table_center">
	<thead></thead>
		<tr>
			<td class='bold'>Nom d'utilisateur</td>
			<td><?= $this->cln($user['username']) ?></td>	
		</tr>
		<!--<tr>
			<td class='bold'>Email</td>
			<td></td>	
		</tr>-->
		<tr>
			<td class='bold'>Créé le</td>
			<td><?= $this->cln($user['create_time']) ?></td>	
		</tr>
		<tr>
			<td class='bold'>Compte activé</td>
			<td><?= str_replace(1 , "Oui" , $this->cln($user['activated'])) ?:"Non" ?></td>	
		</tr>
		<tr>
			<td class='bold'>Est admin</td>
			<td><?= str_replace( 1 , "Oui",$this->cln($user['is_admin'])) ?:"Non" ?></td>	
		</tr>
		<tr>
			<td class='bold'>Mot de passe</td>
			<td><a href = 'user/updatepassword'>Mettre à jour le mot de passe</a></td>	
		</tr>
		<tr>
			<td class='bold'>Droits utilisateurs</td>
			<td><button class='userReloadRights'>Recharger les droits</button></td>	
		</tr>
	</table>
</fieldset>
</div>