<?php
$subClass_synthese = '';
$subClass_users= '';
$subClass_groups= '';
$subClass_roles= '';
$subClass_actions= '';
switch($subClass_css){
	case 'subClass_synthese':
		$subClass_synthese = 'subSelected';
		break;
	case 'subClass_roles':
		$subClass_roles = 'subSelected';
		break;	
	case 'subClass_groups':
		$subClass_groups = 'subSelected';
		break;	
	case 'subClass_users':
		$subClass_users = 'subSelected';
		break;	
	case 'subClass_actions':
		$subClass_actions = 'subSelected';
		break;			
	default:
		$toto = '';
}
?>
<ul class="submenu">
	<li><a href='admin/index/' class="<?php echo  $subClass_synthese ?>" >Synthese</a></li>
	<li><a href='admin/users/'class="<?php echo $subClass_users?>" >Utilisateurs</a></li>
	<li><a href='admin/groups/' class="<?php echo $subClass_groups ?>" >Groupes</a></li>
	<li><a href='admin/roles/' class="<?php echo $subClass_roles ?>" >Roles</a></li>
	<li><a href='admin/actions/' class="<?php echo $subClass_actions ?>" >Actions</a></li>	
</ul>