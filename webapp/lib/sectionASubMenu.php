<?php
$subClass_subSectionA = '';
switch($subClass_css){
	case 'subClass_subSectionA':
		$subClass_subSectionA = 'subSelected';
		break;	
	default:
		$toto = '';
}
?>
<ul class="submenu">
	<li><a href='sectiona/subSectionA' class="<?php echo  $subClass_subSectionA ?>">SubSectionA</a>  </li>
</ul>