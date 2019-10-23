<?php 
$this->titre = "Administration";
$this->class_css = "admin";
$subClass_css = "subClass_actions";
//utilisé pour les selector en no JS
include("./lib/adminSubMenu.php"); 

		// echo "<pre>";
		// print_r($allControleurs);
		// echo "</pre>";
 ?>
<h2>Administration - Gestion des autorisations</h2>
<div id='returnViewCrud'>
</div>
<button class='updateAllActions'>Mettre &agrave; jour toutes les actions en base</button>
<button class='publishPrivileges'>Publier les privileges</button>

<div class='even'>

<?php foreach ($allControleurs as $controleur => $actions):?>
<fieldset>
	<legend><h4><?= $this->cln($controleur) ?></h4></legend>
	<table id="" class="display" style="width:100%; text-align:center">
		<thead>
			<th>ID DB Action</th>
			<th>Nom Action</th>
			<th>Existe dans la DB</th>
			<th>Actions</th>	
		</thead>
		<tbody>
		<?php foreach ($actions as $action):?>
		<tr>
			<td><?= $this->cln($action['id']) ?></td>
			<td><?= $this->cln($action['name']) ?></td>
			<td><?= str_replace(1 , "Oui" , $this->cln($action['isActive'])) ?:"Non" ?></td>
			<td>
				<button class='roleActionMgt' id="<?= $this->cln($action['id']) ?>" nameAction="<?= $this->cln($action['name']) ?>" nameControleur="<?= $this->cln($controleur) ?>">Gerer les autorisation</button>
			</td>
		</tr>
		<?php endforeach; ?>	
		</tbody>
	</table>
</fieldset>
<?php endforeach; ?>			
</div>

<div class="roleactionmodal" id='roleactionmodal'>
<div class="roleactionmodal-content" id='roleactionmodal-content'>	
		<legend><h3>Gestion des autorisations pour l'action<span id="spanActionName"> - Controleur <span id="spanControleurName"></span></h3></legend>
		<select multiple="multiple" id="ActionRoleSelector" >
		</select>
		<div id='confirmAction'></div>
  </div>
</div>