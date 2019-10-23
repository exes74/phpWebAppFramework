<?php 
$this->titre = "Administration";
$this->class_css = "admin";
$subClass_css = "subClass_synthese";
//utilisé pour les selector en no JS
include("./lib/adminSubMenu.php"); 
 ?>

<h2>Administration - Synthèse</h2>
<div class='content_even'>
<fieldset>
	<legend><h3>Utilisateurs</h3></legend>
	<table class="table_center">
		<tr>
			<td class='bold'>Nombres d'utilisateurs:</td>
			<td><?= $this->cln($nbUsers[0]) ?></td>	
		</tr>		
	</table>
</fieldset>
</div>
<div class='content_odd'>
<fieldset>
	<legend><h3>Groupes</h3></legend>
	<table class="table_center">
		<tr>
			<td class='bold'>Nombres de groupes:</td>
			<td><?= $this->cln($nbGroups[0]) ?></td>	
		</tr>		
	</table>
</fieldset>
</div>
<div class='content_even'>
<fieldset>
	<legend><h3>Roles</h3></legend>
	<table class="table_center">
		<tr>
			<td class='bold'>Nombres de roles:</td>
			<td><?= $this->cln($nbRoles[0]) ?></td>	
		</tr>		
	</table>
</fieldset>
<fieldset>
	<legend><h3>Actions</h3></legend>
	<table class="table_center">
		<tr>
			<td class='bold'>Nombres d'actions:</td>
			<td><?= $this->cln($nbActions[0]) ?></td>	
		</tr>		
	</table>
</fieldset>
</div>