<?php $this->titre = "Update my password"; ?>
<?php $this->class_css = "myprofile"; ?>

<br/>
<h2>Mon Profil</h2>
<div class='content_even'>
<fieldset>
	<legend><h3>Mise à jour du mot de passe</h3></legend>
	<div class='formCenter'>
		
		<form class="pure-form pure-form-stacked" method="post">
			<fieldset>
				<label for="oldPass" class='bold' style="width: 100%;">Mot de passe actuel</label>
				<input name="oldPass" type="password" placeholder="Mot de passe actuel" required autofocus style="width: 100%;">
				<label for="newPass" class='bold' style="width: 100%;">Nouveau mot de passe</label>
				<input name="newPass" type="password" placeholder="Nouveau mot de passe" required style="width: 100%;">
				<span class="pure-form-message">Votre mot de passe doit contenir au moins 8 caractères, incluant une majuscule, une minusule et un chiffre.</span>		 
				<label for="newPassConf" class='bold' style="width: 100%;">Confirmer le nouveau mot de passe</label>
				<input name="newPassConf" type="password" placeholder="Nouveau mot de passe" required style="width: 100%;">
				<br>
				<button type="submit" class="pure-button pure-button-primary" style="width: 100%;">Mettre à jour</button>
			</fieldset>
		</form>

		<?php if (isset($msgErreur)): ?>
			<p class="bold redText"><?= $msgErreur ?></p>
		<?php endif; ?>

		<?php if (isset($msgSuccess)): ?>
			<p class="bold"><?= $msgSuccess ?></p>
		<?php endif; ?>
	</div>
</fieldset>
</div>

