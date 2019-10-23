<?php
$subClass_accueil = '';
switch($subClass_css){
	case 'subClass_accueil':
		$subClass_accueil = 'subSelected';
		break;	
	default:
		$toto = '';
}
?>
<ul class="submenu">
	<li><a href='accueil/' class="<?php echo  $subClass_accueil ?>">Accueil</a>  </li>
</ul>