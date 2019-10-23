<?php $this->titre = "Dashboard - Connexion" ?>
<?php $this->class_css = "connection"; ?>

<div class='content_even'>
<fieldset>
	<legend><h3>Connexion</h3></legend>
	<div class='formCenter'>		
			<form class="pure-form" action="connexion/connecter" method="post">
				<fieldset>					
					<input name="login" type="text" placeholder="Nom d'utilisateur" required autofocus style="width: 49%;">
					<input name="password" type="password" placeholder="Mot de passe" required style="width: 50%;">
					<br><br>
					<button type="submit" class="pure-button pure-button-primary" style="width: 100%;">Se connecter</button>
				</fieldset>
			</form>
			<?php if (isset($msgErreur)): ?>
				<p class="bold redText"><?= $msgErreur ?></p>
			<?php endif; ?>
			<?php if (isset($msgSuccess)): ?>
				<p class="bold"><?= $msgSuccess ?></p>
			<?php endif; ?>
			<br/>
			Pas de compte ? <a href='connexion/register'>S'inscrire</a>
	</div>
</fieldset>
</div>


