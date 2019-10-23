<?php
$subClass_subSectionB = '';
switch($subClass_css){
	case 'subClass_subSectionB':
		$subClass_subSectionB = 'subSelected';
		break;	
	default:
		$toto = '';
}
?>
<ul class="submenu">
	<li><a href='sectionb/subSectionB' class="<?php echo  $subClass_subSectionB ?>">SubSectionB</a>  </li>
</ul>