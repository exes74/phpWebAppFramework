<?php
//Formatting degueulasse
$class_home = '';
$class_con = '';
$class_sectiona = '';
$class_sectionb = '';
$class_admin = '';
switch($class_css){
	case 'home':
		$class_home = 'courant';
		break;
	case 'admin':
		$class_admin = 'courant';
		break;	
	case 'connection':
		$class_con = 'courant';
		break;		
	case 'sectiona':
		$class_sectiona = 'courant';
		break;		
	case 'sectionb':
		$class_sectionb = 'courant';
		break;	
	default:
		$toto = '';
}
date_default_timezone_set('Europe/Paris');
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <base href="<?= $racineWeb ?>" >		
		<link rel="stylesheet" href="Contenu/style.css" />
		<link rel="icon" type="image/png" href="favicon.ico">
		<link href="Contenu/multiselect.css" media="screen" rel="stylesheet" type="text/css">
		
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
		<!--  <link rel="stylesheet" href="Contenu/datatable.css" />  -->
		<link rel="stylesheet" type="text/css" href="Contenu/buttondatatable.css"/>
		
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/colreorder/1.4.1/css/colReorder.dataTables.css"/>
		<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">


		<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.4/js/dataTables.fixedColumns.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.3/js/dataTables.fixedHeader.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.4.1/js/dataTables.colReorder.js"></script>
		
		<!--  <script src="https://code.highcharts.com/stock/highstock.js"></script>-->
		<!--<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/data.js"></script>		
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/export-data.js"></script>-->
		<script src="https://code.highcharts.com/modules/export-data.js"></script>-->
		
		
		<!--<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>-->
	
		<script src="js/highcharts.js"></script>
		<script src="js/highcharts-more.js"></script>
		<script src="js/data.js"></script>
		<script src="js/exporting.js"></script>
		<script src="js/export-data.js"></script>
		<script src="js/global.js"></script>
		<script src="js/remote-list.min.js"></script>
		<script src="js/multiselect.js"></script>
		<!--<script src="js/matomo.js"></script>-->
		<title><?= $titre ?></title>
    </head>
    <body>
		
        <div id="global">
			<div id='topContent'>
            <header>
                <h1 id="titreSite">App Framework</h1>
				<div id="menu">	
					<div class="tabmenu">  
						<ul>
							<li><a href='/webapp' <?php echo 'class="'. $class_home .'"' ?> >Accueil</a></li>
							<li><a href='sectiona' <?php echo 'class="'. $class_sectiona .'"' ?> >Section A</a></li>
							<li><a href='sectionb' <?php echo 'class="'. $class_sectionb .'"' ?> >Section B</a></li>
							<!-- Gestion des menus "cachés"-->
							<?php if (isset($_SESSION['id_user'])){ ?>
								<!-- On peut inserer ici un menu type my dashboard ou whatever-->
								
								<!-- Menu dédié Admin-->
								<?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1){ ?>	
									<li><a href='admin'<?php echo 'class="'. $class_admin .'"' ?> >Aministration</a></li>
								<?php } ?>
							<?php }else{ ?>
								<!-- Sinon on affiche le lien de connexion-->
								<li><a href='connexion' <?php echo 'class="'. $class_con .'"' ?> >Connexion</button></a>
							<?php } ?>
						</ul>
						
					</div>
					<?php if (isset($_SESSION['id_user'])): ?>
					<div class='login'>
						<div id ='loginContent'>
							Connecté en tant que <?php echo $_SESSION['login'] ?> <a href='connexion/deconnecter'><button class='btnLogout'></button></a><a href='user/myprofile'><button class='btnProfile'></button></a>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</header>
			<div class="se-pre-con"></div>
			<div id = 'returnView'></div>
			</div>
            <div id="contenu">
                <?= $contenu ?>
            </div>

        </div>
    </body>
</html>