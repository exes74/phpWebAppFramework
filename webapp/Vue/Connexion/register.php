<?php $this->titre = "Creer un compte"; ?>
<?php $this->class_css = "connection"; ?>



<?php if (isset($alreadyLogin) && $alreadyLogin == 1){
	$toto='';
}else{
?>
<br/>
<div class='content_even'>
<fieldset>
	<legend><h3>Créer un compte</h3></legend>
	<div class='formCenter'>

	<form class="pure-form pure-form-stacked" method="post">
		<fieldset>
			<input name="name" type="text" placeholder="Nom d'utilisateur" required autofocus style="width: 100%;">

			<input name="pass" type="password" placeholder="Mot de passe" required style="width: 100%;">
			<input name="passConf" type="password" placeholder="Confirmez le mot de passe" required style="width: 100%;">
			<span class="pure-form-message">Votre mot de passe doit contenir au moins 8 caractères, incluant une majuscule, une minusule et un chiffre.</span>		 
			<input name="action_register" type="hidden" value="register" >
			<br>
			<button type="submit" class="pure-button pure-button-primary" style="width: 100%;">S'inscrire</button>
		</fieldset>
	</form>
			<?php } ?>
			<?php if (isset($msgSuccess)): ?>
				<p><?= $msgSuccess ?></p>
			<?php endif; ?>
			<?php if (isset($msgErreur)): ?>
				<p><?= $msgErreur ?></p>
			<?php endif; ?>
			<?php if (isset($error)): ?>
				<p><?= $error['username'] ?></p>
			<?php endif; ?>
		</div>
</fieldset>
</div>
