<?php 
$this->titre = "Administration";
$this->class_css = "admin";
$subClass_css = "subClass_groups";
//utilisé pour les selector en no JS
include("./lib/adminSubMenu.php"); 
 ?>

<h2>Administration - Gestion des groupes</h2>
<div id='returnCoinCrud'>
	<button class='createNewGroup'>Cr&eacute;er un nouveau groupe</button>
</div>
<div class='even'>
	<table id="userlist" class="display" style="width:100%">
		<thead>
			<tr>
				<th class='thfull'>Id Group</th>
				<th class='thfull'>Nom</th>
				<th class='thfull'>Description</th>
				<th class='thfull'>Actions</th>				
			</tr>
		</thead>
		<tbody>
<?php foreach ($groups as $group):?>
		<tr>
			<td><?= $this->cln($group['id']) ?></td>
			<td><?= $this->cln($group['name']) ?></td>
			<td><?= $this->cln($group['description']) ?></td>
			<td>
				<button class='rmGroup'  id="<?= $this->cln($group['id']) ?>" nameGroup="<?= $this->cln($group['name']) ?>">Supprimer</button>
				<button class='renameGroup'  id="<?= $this->cln($group['id']) ?>" nameGroup="<?= $this->cln($group['name']) ?>" descriptionGroup="<?= $this->cln($group['description']) ?>">Renommer</button>
				<button class='userGroupMgt' id="<?= $this->cln($group['id']) ?>" nameGroup="<?= $this->cln($group['name']) ?>">Gerer les utilisateurs</button>
		
			</td>
		</tr>
<?php endforeach; ?>			
		</tbody>
	</table>
	
<div class="groupaddmodal" id='groupaddmodal'>
<div class="groupaddmodal-content" id='groupaddmodal-content'>
	<form class="pure-form pure-form-stacked" id='pureform'>
		<fieldset id='groupAddData'>	
		<legend><h3 id='noDel'>Creer un nouveau groupe</h3></legend>
		Nom du groupe : <input type="text" width ="50" id='groupAddName'>
		Description du groupe : <input type="text" width ="200" id='groupAddDescription'>
		<br><button class='addGroupAjax' id='addGroupAjax' >OK</button><button id='hidemodal'>Cancel</button>
		</fieldset>
	</form>
  </div>
</div>


<div class="grouprenamemodal" id='grouprenamemodal'>
<div class="grouprenamemodal-content" id='grouprenamemodal-content'>
	<form class="pure-form pure-form-stacked" id='pureform'>
		<fieldset id='groupNewData'>	
		<legend><h3>Modifier le groupe</h3></legend>
		Id Groupe : <input type="text" width ="50" id='groupId' readonly><br>
		Nom du groupe : <input type="text" width ="50" id='groupNewName'><br>
		Description du groupe : <input type="text" width ="200" id='groupNewDescription'>
		<br><button class='renameGroupAjax' id='renameGroupAjax' >OK</button><button id='hidemodal'>Cancel</button>
		</fieldset>
	</form>
  </div>
</div>


<div class="usergroupmodal" id='usergroupmodal'>
<div class="usergroupmodal-content" id='usergroupmodal-content'>	
		<legend><h3>Ajout/Suppression d'utilisateurs dans le groupe <span id="spanGroupName"></span></h3></legend>
		<select multiple="multiple" id="UserGroupSelector" >
		</select>
		<div id='confirmAction'></div>
  </div>
</div>


</div>