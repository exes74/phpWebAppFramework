<?php 
$this->titre = "Administration";
$this->class_css = "admin";
$subClass_css = "subClass_roles";
//utilisé pour les selector en no JS
include("./lib/adminSubMenu.php"); 
 ?>

<h2>Administration - Gestion des roles</h2>
<div id='returnCoinCrud'>
	<button class='createNewRole'>Cr&eacute;er un nouveau role</button>
</div>
<div class='even'>
	<table id="userlist" class="display" style="width:100%">
		<thead>
			<tr>
				<th class='thfull'>Id Role</th>
				<th class='thfull'>Nom</th>
				<th class='thfull'>Description</th>
				<th class='thfull'>Actions</th>				
			</tr>
		</thead>
		<tbody>
<?php foreach ($roles as $role):?>
		<tr>
			<td><?= $this->cln($role['id']) ?></td>
			<td><?= $this->cln($role['name']) ?></td>
			<td><?= $this->cln($role['description']) ?></td>
			<td>
				<button class='rmRole'  id="<?= $this->cln($role['id']) ?>" nameRole="<?= $this->cln($role['name']) ?>">Supprimer</button>
				<button class='renameRole'  id="<?= $this->cln($role['id']) ?>" nameRole="<?= $this->cln($role['name']) ?>" descriptionRole="<?= $this->cln($role['description']) ?>">Renommer</button>
				<button class='groupRoleMgt' id="<?= $this->cln($role['id']) ?>" nameRole="<?= $this->cln($role['name']) ?>">Gerer les Groupes</button>
			</td>
		</tr>
<?php endforeach; ?>			
		</tbody>
	</table>
</div>

<div class="roleaddmodal" id='roleaddmodal'>
<div class="roleaddmodal-content" id='roleaddmodal-content'>
	<form class="pure-form pure-form-stacked" id='pureform'>
		<fieldset id='roleAddData'>	
		<legend><h3 id='noDel'>Creer un nouveau role</h3></legend>
		Nom du role : <input type="text" width ="50" id='roleAddName'>
		Description du role : <input type="text" width ="200" id='roleAddDescription'>
		<br><button class='addRoleAjax' id='addRoleAjax' >OK</button><button id='hidemodal'>Cancel</button>
		</fieldset>
	</form>
  </div>
</div>


<div class="rolerenamemodal" id='rolerenamemodal'>
<div class="rolerenamemodal-content" id='rolerenamemodal-content'>
	<form class="pure-form pure-form-stacked" id='pureform'>
		<fieldset id='roleNewData'>	
		<legend><h3>Modifier le role</h3></legend>
		Id Role : <input type="text" width ="50" id='roleId' readonly><br>
		Nom du role : <input type="text" width ="50" id='roleNewName'><br>
		Description du role : <input type="text" width ="200" id='roleNewDescription'>
		<br><button class='renameRoleAjax' id='renameRoleAjax' >OK</button><button id='hidemodal'>Cancel</button>
		</fieldset>
	</form>
  </div>
</div>


<div class="grouprolemodal" id='grouprolemodal'>
<div class="grouprolemodal-content" id='grouprolemodal-content'>	
		<legend><h3>Ajout/Suppression de groupe au role<span id="spanRoleName"></span></h3></legend>
		<select multiple="multiple" id="GroupRoleSelector" >
		</select>
		<div id='confirmAction'></div>
  </div>
</div>