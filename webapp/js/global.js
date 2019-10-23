$(document).ready(function() {		
	$('#userlist').DataTable( {
		autoWidth : true,
		processing : true ,  
		scrollX      : true,
		scrollCollapse: true,
		dom: 'Blpfrtip',
		sPaginationType: 'full_numbers',
		buttons: [
			{
				extend: 'collection',
				text: 'Export',
				buttons: [ 'excel','copy' ]
			}
		],
	});
	
	$('#datatable').DataTable( {
		autoWidth : true,
		processing : true ,  
		scrollX      : true,
		scrollCollapse: true,
		dom: 'Blpfrtip',
		sPaginationType: 'full_numbers',
		buttons: [
			{
				extend: 'collection',
				text: 'Export',
				buttons: [ 'excel','copy' ]
			}
		],
	});
	
	
	
	///LOADING BUTTON
	$(".se-pre-con").fadeOut("slow");
	///END 
		
	////////////////////GESTION MODAL WINDOWS POUR LES GROUPES ///////////////////////////
	//////Group Add MODAL///
	$( "#hidemodal" ).click(function() {
		$('#groupaddmodal').hide();
	});
	
	$( ".addGroupAjax" ).click(function() {
		groupAddName = $('#groupAddName').val();
		groupAddDescription = $('#groupAddDescription').val();
		$.ajax({
			url : '/webapp/admin/ajax/', 
			type : 'GET', 
			data : 'do=createGroup&nameGroup='+groupAddName+'&description='+groupAddDescription,
			success : function(response, status, xhr){
				$( "#returnCoinCrud" ).html(response );
				location.reload(); 
			}
		});
	});

	$( "#groupaddmodal" ).click(function(event) {
		// console.log(event.target.id);
		if(event.target.id != 'groupaddmodal-content' && event.target.id != 'groupAddName'  && event.target.id != 'groupAddDescription' && event.target.id != 'addGroupAjax' && event.target.id!= 'groupAddData' && event.target.id!= 'pureform'  && event.target.id!= ''){
			$('#groupaddmodal').hide();	
		}		 
	});
	////END
	
	////GROUP RENAME MODAL	
	$( "#hidemodal" ).click(function() {
			$('#grouprenamemodal').hide();
		});
		
	$( ".renameGroupAjax" ).click(function() {
		idGroup =$('#groupId').val();
		groupNewName = $('#groupNewName').val();
		groupNewDescription = $('#groupNewDescription').val();
		$.ajax({
			url : '/webapp/admin/ajax/', 
			type : 'GET', 
			data : 'do=renameGroup&idGroup='+idGroup+'&nameGroup='+groupNewName+'&description='+groupNewDescription,
			success : function(response, status, xhr){
				$( "#returnCoinCrud" ).html(response );
				location.reload(); 
			}
		});
	});
	$( "#grouprenamemodal" ).click(function(event) {
		// console.log(event.target.id);
		if(event.target.id != 'grouprenamemodal-content' && event.target.id != 'groupNewName'  && event.target.id != 'groupNewDescription' && event.target.id != 'renameGroupAjax' && event.target.id!= 'groupNewData' && event.target.id!= 'pureform'  && event.target.id!= 'groupId' && event.target.id!= ''){
			$('#grouprenamemodal').hide();	
		}		 
	});
		
		////USER GROUP ADD/REMOVE MODAL	
	$( "#hidemodal" ).click(function() {
			$('#usergroupmodal').hide();
			$('#UserGroupSelector').html('');
		});
	$( "#usergroupmodal" ).click(function(event) {
		// console.log(event.target.id);
		if(event.target.id == 'usergroupmodal' ){
			$('#UserGroupSelector').html('');
			$('#usergroupmodal').hide();	

		}		 
	});
	
	
	
	////////////////////GESTION MODAL WINDOWS POUR LES ROLES ///////////////////////////
	//////Group Add MODAL///
	$( "#hidemodal" ).click(function() {
		$('#roleaddmodal').hide();
	});
	
	$( ".addRoleAjax" ).click(function() {
		roleAddName = $('#roleAddName').val();
		roleAddDescription = $('#roleAddDescription').val();
		$.ajax({
			url : '/webapp/admin/ajax/', 
			type : 'GET', 
			data : 'do=createRole&nameRole='+roleAddName+'&description='+roleAddDescription,
			success : function(response, status, xhr){
				$( "#returnCoinCrud" ).html(response );
				location.reload(); 
			}
		});
	});

	$( "#roleaddmodal" ).click(function(event) {
		// console.log(event.target.id);
		if(event.target.id == 'roleaddmodal' ){
		// if(event.target.id != 'groupaddmodal-content' && event.target.id != 'groupAddName'  && event.target.id != 'groupAddDescription' && event.target.id != 'addGroupAjax' && event.target.id!= 'groupAddData' && event.target.id!= 'pureform'  && event.target.id!= ''){
			$('#roleaddmodal').hide();	
		}		 
	});
	////END
	
	////GROUP RENAME MODAL	
	$( "#hidemodal" ).click(function() {
			$('#rolerenamemodal').hide();
		});
		
	$( ".renameRoleAjax" ).click(function() {
		idRole =$('#roleId').val();
		roleNewName = $('#roleNewName').val();
		roleNewDescription = $('#roleNewDescription').val();
		$.ajax({
			url : '/webapp/admin/ajax/', 
			type : 'GET', 
			data : 'do=renameRole&idRole='+idRole+'&nameRole='+roleNewName+'&description='+roleNewDescription,
			success : function(response, status, xhr){
				$( "#returnCoinCrud" ).html(response );
				location.reload(); 
			}
		});
	});
	$( "#rolerenamemodal" ).click(function(event) {
		// console.log(event.target.id);
		if(event.target.id == 'rolerenamemodal' ){
		// if(event.target.id != 'grouprenamemodal-content' && event.target.id != 'groupNewName'  && event.target.id != 'groupNewDescription' && event.target.id != 'renameGroupAjax' && event.target.id!= 'groupNewData' && event.target.id!= 'pureform'  && event.target.id!= 'groupId' && event.target.id!= ''){
			$('#rolerenamemodal').hide();	
		}		 
	});
		
		////USER GROUP ADD/REMOVE MODAL	
	$( "#hidemodal" ).click(function() {
			$('#grouprolemodal').hide();
			$('#GroupRoleSelector').html('');
		});
	$( "#grouprolemodal" ).click(function(event) {
		// console.log(event.target.id);
		if(event.target.id == 'grouprolemodal' ){
			$('#GroupRoleSelector').html('');
			$('#grouprolemodal').hide();	

		}		 
	});
	
///////////////////MODAL DE GESTION DES ACTIONS////////////////
		////USER GROUP ADD/REMOVE MODAL	
	$( "#hidemodal" ).click(function() {
			$('#roleactionmodal').hide();
			$('#RoleActionSelector').html('');
		});
	$( "#roleactionmodal" ).click(function(event) {
		// console.log(event.target.id);
		if(event.target.id == 'roleactionmodal' ){
			$('#RoleActionSelector').html('');
			$('#roleactionmodal').hide();
		}		 
	});




///////////MODAL GENERIC
	$( ".hidemodal" ).click(function() {
		$('.modal').hide();
	});
	$( ".modal" ).click(function(event) {
		// console.log(event.target.className);
		if(event.target.className == 'modal' ){
		// if(event.target.id != 'groupaddmodal-content' && event.target.id != 'groupAddName'  && event.target.id != 'groupAddDescription' && event.target.id != 'addGroupAjax' && event.target.id!= 'groupAddData' && event.target.id!= 'pureform'  && event.target.id!= ''){
			$('.modal').hide();	
		}		 
	});	
	});	
///////////////GESTION DES GROUPES////////////////////////////
///SHOW ADD GROUP MODAL
$(document).on('click', '.createNewGroup', function() {
	$('#groupaddmodal').show();
});

///SHOW RENAME GROUP MODAL
$(document).on('click', '.renameGroup', function() {
	groupId =$(this).attr('id');
	$('#groupId').val(groupId);
	groupNewName =$(this).attr('nameGroup');
	$('#groupNewName').val(groupNewName);
	groupNewDescription =$(this).attr('descriptionGroup');
	$('#groupNewDescription').val(groupNewDescription);
	$('#grouprenamemodal').show();
});

///SHOW USER GROUP ADD REMOVE MODAL
$(document).on('click', '.userGroupMgt', function() {
	groupId =$(this).attr('id');
	$('#spanGroupId').text(groupId);
	groupNewName =$(this).attr('nameGroup');
	$('#spanGroupName').text(groupNewName);
	data = '';
	$('#UserGroupSelector').html(data);
	$('#UserGroupSelector').multiSelect('destroy');
	//CREATION DES LISTES USERS IN ET OUT DU GROUPES
	$.ajax({
			url : '/webapp/admin/ajax/', 
			type : 'GET', 
			data : 'do=userGroupsMapping&groupId='+groupId,
			success : function(response, status, xhr){
				data = response;
				$('#UserGroupSelector').html(data);
				$('#UserGroupSelector').multiSelect({
				selectableHeader: "<div class='custom-header'>Utilisateurs hors du groupe</div>",
				selectionHeader: "<div class='custom-header'>Utilisateurs dans le groupe</div>",
				  afterSelect: function(values){
					// alert("Select value: "+values);
					$.ajax({
						url : '/webapp/admin/ajax/', 
						type : 'GET', 
						data : 'do=addUserToGroup&idUser='+values+"&idGroup="+groupId,
						success : function(response, status, xhr){
							$( "#confirmAction" ).html(response );
							$('#confirmAction').contents().wrap('<div class="temporary">').parent().fadeOut(2600);
						}
					});
					
				  },
				  afterDeselect: function(values){
					// alert("Deselect value: "+values);
					$.ajax({
						url : '/webapp/admin/ajax/', 
						type : 'GET', 
						data : 'do=removeUserFromGroup&idUser='+values+"&idGroup="+groupId,
						success : function(response, status, xhr){
							$( "#confirmAction" ).html(response );
							$('#confirmAction').contents().wrap('<div class="temporary">').parent().fadeOut(2600);
						}
					});
					
				  }
				});				
			}
		});
	//ON AFFICHE !
	$('#usergroupmodal').show();
});




////////////////////GESTION DES ROLES //////////////////////////

///SHOW ADD ROLE MODAL
$(document).on('click', '.createNewRole', function() {
	$('#roleaddmodal').show();
});

///SHOW RENAME ROLE MODAL
$(document).on('click', '.renameRole', function() {
	roleId =$(this).attr('id');
	$('#roleId').val(roleId);
	roleNewName =$(this).attr('nameRole');
	$('#roleNewName').val(roleNewName);
	roleNewDescription =$(this).attr('descriptionRole');
	$('#roleNewDescription').val(roleNewDescription);
	$('#rolerenamemodal').show();
});

///SHOW USER GROUP ADD REMOVE MODAL
$(document).on('click', '.groupRoleMgt', function() {
	roleId =$(this).attr('id');
	$('#spanRoleId').text(roleId);
	roleName =$(this).attr('nameRole');
	$('#spanRoleName').text(roleName);
	data = '';
	$('#GroupRoleSelector').html(data);
	$('#GroupRoleSelector').multiSelect('destroy');
	//CREATION DES LISTES GROUPES IN ET OUT DES ROLES
	$.ajax({
			url : '/webapp/admin/ajax/', 
			type : 'GET', 
			data : 'do=groupRolesMapping&roleId='+roleId,
			success : function(response, status, xhr){
				data = response;
				$('#GroupRoleSelector').html(data);
				$('#GroupRoleSelector').multiSelect({
				selectableHeader: "<div class='custom-header'>Groupes hors du role</div>",
				selectionHeader: "<div class='custom-header'>Groupe possedant les droits du role</div>",
				  afterSelect: function(values){
					// alert("Select value: "+values);
					$.ajax({
						url : '/webapp/admin/ajax/', 
						type : 'GET', 
						data : 'do=addGroupToRole&idGroup='+values+"&idRole="+roleId,
						success : function(response, status, xhr){
							$( "#confirmAction" ).html(response );
							$('#confirmAction').contents().wrap('<div class="temporary">').parent().fadeOut(2600);
						}
					});
					
				  },
				  afterDeselect: function(values){
					// alert("Deselect value: "+values);
					$.ajax({
						url : '/webapp/admin/ajax/', 
						type : 'GET', 
						data : 'do=removeGroupFromRole&idGroup='+values+"&idRole="+roleId,
						success : function(response, status, xhr){
							$( "#confirmAction" ).html(response );
							$('#confirmAction').contents().wrap('<div class="temporary">').parent().fadeOut(2600);
						}
					});
					
				  }
				});				
			}
		});
	//ON AFFICHE !
	$('#grouprolemodal').show();
});

$(document).on('click', '.roleActionMgt', function() {
	actionId =$(this).attr('id');
	$('#spanActionId').text(actionId);
	actionName =$(this).attr('nameAction');
	$('#spanActionName').text(actionName);
	controleurName =$(this).attr('nameControleur');
	$('#spanControleurName').text(controleurName);
	data = '';
	$('#ActionRoleSelector').html(data);
	$('#ActionRoleSelector').multiSelect('destroy');
	//CREATION DES LISTES GROUPES IN ET OUT DES ROLES
	$.ajax({
			url : '/webapp/admin/ajax/', 
			type : 'GET', 
			data : 'do=groupActionsMapping&actionId='+actionId,
			success : function(response, status, xhr){
				data = response;
				$('#ActionRoleSelector').html(data);
				$('#ActionRoleSelector').multiSelect({
				selectableHeader: "<div class='custom-header'>Role non autorisé à exécuter</div>",
				selectionHeader: "<div class='custom-header'>Role autorisé à exécuter</div>",
				  afterSelect: function(values){
					// alert("Select value: "+values);
					$.ajax({
						url : '/webapp/admin/ajax/', 
						type : 'GET', 
						data : 'do=addActionToRole&idRole='+values+"&idAction="+actionId,
						success : function(response, status, xhr){
							$( "#confirmAction" ).html(response );
							$('#confirmAction').contents().wrap('<div class="temporary">').parent().fadeOut(2600);
						}
					});
					
				  },
				  afterDeselect: function(values){
					// alert("Deselect value: "+values);
					$.ajax({
						url : '/webapp/admin/ajax/', 
						type : 'GET', 
						data : 'do=removeActionFromRole&idRole='+values+"&idAction="+actionId,
						success : function(response, status, xhr){
							$( "#confirmAction" ).html(response );
							$('#confirmAction').contents().wrap('<div class="temporary">').parent().fadeOut(2600);
						}
					});
					
				  }
				});				
			}
		});
	//ON AFFICHE !
	$('#roleactionmodal').show();
});

///////MAJ DES ACTIONS EN BASE A PARTIR DES CLASSES PHP //////
$(document).on('click', '.updateAllActions', function() {
	var r = confirm("Confirmer la mise à jour des actions en base.");
	if (r == true) {
		$.ajax({
			url : '/webapp/admin/ajax/', 
			type : 'GET', 
			data : 'do=updateAllActions',
			success : function(response, status, xhr){
				location.reload();
			}
		});
	}
});

////MAJ DES PRIVILEGES DES UTILISATEURS EN BAS//////
$(document).on('click', '.publishPrivileges', function() {
	var r = confirm("Confirmer la mise à jour des droits utilisateurs.");
	if (r == true) {
		$.ajax({
			url : '/webapp/admin/ajax/', 
			type : 'GET', 
			data : 'do=updatePrivileges',
			success : function(response, status, xhr){
				$( "#returnViewCrud" ).html(response);
				$('#returnViewCrud').contents().wrap('<div class="temporary">').parent().fadeOut(2600);
			}
		});
	}
});

//SUPPRESSION USER
$(document).on('click', '.rmUser', function() {
	var idUser = $(this).attr('id');
	var nameUser = $(this).attr('nameUser');
	var r = confirm("Confirmer la supression de l'utilisateur: "+nameUser+idUser);
	if (r == true) {
		$.ajax({
			url : '/webapp/admin/ajax/', 
			type : 'GET', 
			data : 'do=deleteUser&idUser='+idUser,
			success : function(response, status, xhr){
				location.reload(); 
			}
		});
	}
});

////ACTIVATION USER
$(document).on('click', '.acUser', function() {
	var idUser = $(this).attr('id');
	var nameUser = $(this).attr('nameUser');
	var r = confirm("Confirmer l'activation de l'utilisateur: "+nameUser+idUser);
	if (r == true) {
		$.ajax({
			url : '/webapp/admin/ajax/', 
			type : 'GET', 
			data : 'do=activateUser&idUser='+idUser,
			success : function(response, status, xhr){
				location.reload(); 
			}
		});
	}
});
///DESACTIVATION USER
$(document).on('click', '.daUser', function() {
	var idUser = $(this).attr('id');
	var nameUser = $(this).attr('nameUser');
	var r = confirm("Confirmer la désactivation de l'utilisateur: "+nameUser+idUser);
	if (r == true) {
		$.ajax({
			url : '/webapp/admin/ajax/', 
			type : 'GET', 
			data : 'do=desactivateUser&idUser='+idUser,
			success : function(response, status, xhr){
				location.reload(); 
			}
		});
	}
});


///SUPPRESSSION GROUPE
$(document).on('click', '.rmGroup', function() {
	var idGroup = $(this).attr('id');
	var nameGroup = $(this).attr('nameGroup');
	var r = confirm("Confirmer la suppression du groupe: "+nameGroup+idGroup);
	if (r == true) {
		$.ajax({
			url : '/webapp/admin/ajax/', 
			type : 'GET', 
			data : 'do=deleteGroup&idGroup='+idGroup,
			success : function(response, status, xhr){
				location.reload(); 
			}
		});
	}
});

///SUPPRESSSION ROLE
$(document).on('click', '.rmRole', function() {
	var idRole = $(this).attr('id');
	var nameRole = $(this).attr('nameRole');
	var r = confirm("Confirmer la suppression du groupe: "+nameRole+idRole);
	if (r == true) {
		$.ajax({
			url : '/webapp/admin/ajax/', 
			type : 'GET', 
			data : 'do=deleteRole&idRole='+idRole,
			success : function(response, status, xhr){
				location.reload(); 
			}
		});
	}
});

////RELOAD DES DROITS UTILISATEURS
$(document).on('click', '.userReloadRights', function() {
	$.ajax({
		url : '/webapp/user/ajax/', 
		type : 'GET', 
		data : 'do=reloadRights',
		success : function(response, status, xhr){
			location.reload(); 
		}
	});
});


function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    var filename = $("#spanSrvListTitle").text(); 
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
};

function openInNewTab(url) {
  var win = window.open(url, '_blank');
  win.focus();
}
