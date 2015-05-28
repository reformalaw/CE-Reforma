<table width="98%" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td align="left" valign="top">
			<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td width="150" align="left" valign="top" class="LeftMenu">
						<!--START VERTICAL MENU-->
						<?php include_partial('personalcms/customerMenu');?>
						<!--END VERTICAL MENU-->
					</td>
					<td align="center" valign="top" class="CashDetails">
					<table width="96%" cellspacing="0" cellpadding="0">
						<tr>
							<td align="left" valign="top" height="5">&nbsp;</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteTab">
								<table width="100%" cellspacing="0" cellpadding="0">
									<tr>
										<td width="10" class="BorderBottom">&nbsp;</td>
										<!--td width="110" align="center" valign="middle" class="SelectTab">ContactUs Page</td> -->
										<!--td width="2" align="center" valign="middle" class="BorderBottom"></td-->
										<!--td class="BorderBottom">&nbsp;</td-->
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteDetails">
								<table width="100%" cellspacing="10" cellpadding="0">
                                <tr><td height="10"></td></tr>
                                    <tr>
				  <td align="center" class="ContentPad"><table width="98%" cellspacing="1" cellpadding="0" class="CaseEditForm" id ="r">
  <tr class="fldbg">
																	<td class="titleTd" width="20%">Field Type</td>
																	<td class="titleTd" width="27%">Label</td>
																	<td class="titleTd" width="35%">Options ( Comma Separated )</td>
																	<td class="titleTd">Required</td>
																	<td class="titleTd">&nbsp;</td>
																</tr>
																<tr>
																	<td valign="middle" class="fldrowlightbg" >
																		<select id="fieldType" onchange="checkFieldType();"    style="width:175px;">
																			<option value="Text">Text</option>
																			<option value="TextArea">TextArea</option>
																			<option value="DropDown">DropDown</option>
																			<option value="CheckBox">CheckBox</option>
																			<option value="Radio">Radio</option>
																			<option value="Captcha">Captcha</option>
																			<option value="FileUpload">FileUpload</option>
																			
																		</select>
																		
																	
																	</td>
																	<td valign="middle" class="fldrowlightbg"><input type="text" name="Label" id="label" style="width:250px;"></td>
																	<td valign="top" class="fldrowlightbg">
																		<textarea name="Options" id="options" disabled="disabled" cols="30" rows="2"></textarea>
																	</td>
																	<td valign="middle" class="fldrowlightbg"><input type="checkbox" name="Required" id="required" onClick="checkRequired();">
															
																	
																	
																	</td>
																	<td id="btn" valign="middle" class="fldrowlightbg">
																		
																		<p id="modeAdd" >
																			<!--<a href="#" id="blue_button" title="Add New">
																			<?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
																			Add 

																			</a>-->
																			<input type="button" value="Add" class="CommonButton" id="blue_button" name="submit" onClick="TrimTextArea();">
																			
																		</p>
																		<p id="modeEdit" style="display:none">
																			
																			
																			<input type="button" value="Save" class="CommonButton" id="edit_btn" name="submit" onClick="TrimTextArea();">
																			<input type="button" value="Cancel" class="CommonButton" id="cancel_btn" name="submit" onclick="cancelRow();">
																			<!--<a href='#' id="cancel_btn" onclick="cancelRow();">Cancel</a>-->
																		</p>
																		
																	</td>
																</tr>
</table>
</td>
			  </tr>
              	<tr><td height="5"></td></tr>
									<tr>
										<td align="center" valign="top">
											<table width="98%" cellspacing="1" cellpadding="1" class="PageListHeading">
												<tr>
													<td align="left" valign="middle"><strong>Customer Contact Page Field List</strong></td>
														<!--<td align="right" valign="middle" height="36">-->
															<!--<form action="<?php //echo url_for('website/practiceAreaList?customerId='.$customerId) ?>" method="post">
																									<span>
																									<?php //echo $objSearchForm['search_text']->renderLabel(); ?>:</span>&nbsp;&nbsp;<?php //echo $objSearchForm['search_text']->render(); ?>
																									<?php //echo tag('input', array('name' => 'search_btn', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
																									
																									<?php //echo link_to("Clear","website/practiceAreaList?customerId=".$customerId,array('class' => 'CommonButton')); ?>
															</form>-->
														<!--</td>-->
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td align="center" valign="top">
											<table width="100%" cellspacing="0" cellpadding="0">
										<tr>
											<td class="ContentPad">
												<table width="100%" cellspacing="0" cellpadding="0" align="center" class="">

													<!--<tr>
														<td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Fa qs","title"=>"Fa qs","align"=>"middle"))?></td>
														<td width="90%" class="ContentBtmDotLn">
															<div style="float:left;" class="Title">Customer Field List</div>
															<div style="float:right;" class="padrht"> -->
																<!--form action="<?php //echo url_for('faq/index') ?>" method="post">

																	<span>Search:</span>&nbsp;&nbsp;
																	<?php //echo tag('input', array('name' => 'search_text', 'type' => 'text', 'id' => 'search_text', 'size' => '25', 'value' => $sf_request->getParameter('search_text'))); ?>
																	<?php //echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>

																	<a href="<?php //echo url_for('faq/counceledgeList') ?>">Clear</a>
																</form-->
														<!--	</div>
														</td>
													</tr>-->
													<tr valign="top">
														<td colspan="2" class="dot"></td>
													</tr>
                                                    <?php include_partial('default/message'); ?>
													<?php /*if($sf_user->hasFlash('errMsg')) { ?>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
																<tr>
																	<td class="dot2"></td>
																</tr>
																<tr>
																	<td class="errormss" align="center"><?php #echo $sf_user->getFlash('errMsg');?>/td>
																</tr>

																<tr>
																	<td class="dot2"></td>
																</tr>
															</table>

														</td>
													</tr>
													<?php }?>
													<?php if($sf_user->hasFlash('succMsg')) { ?>

													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
																<tr>

																	<td class="dot2"></td>	
																</tr>
																<tr>
																	<td class="success" align="center"><?php #echo $sf_user->getFlash('succMsg');?></td>

																</tr>
																<tr>
																	<td class="dot2"></td>
																</tr>
															</table>
														</td>
													</tr>
													<?php } */?> 
													
													
                                                    <tr align="center" valign="top" style="display:none" id="ajaxMsg">
                                                        <td colspan="2" class="ListAreaPad">
                                                            <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                                    		  <tr>
                                                                <td class="success" align="center" ><a href="#" id="msg">Field added successfully.</a></td>
                                                              </tr>
                                                            </table>                                                        </td>
                                                    </tr>	
                                                    												
													<tr align="center" valign="top" style="display:none" id="ajaxMsgEdit">
														<td colspan="2" class="ListAreaPad">
															<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
																<tr>
																	<td class="success" align="center"><a href="#" id="msg">Update successful.</a></td>
															</table>														</td>
													</tr>
													
													<?php
														$varExtra = '';
														if($sf_request->getParameter('search_text')) 
															$varExtra .="&search_text=".$sf_request->getParameter('search_text');
													?>
                                                    <tr><td height="10"></td></tr>
													<tr align="center" valign="top">
														<td colspan="2" class="ListAreaPad">
															<table width="98%" cellspacing="1" cellpadding="1" class="brd1">
															
															<tr class="fldbg">
																	<td class="border-right border-left border-top" width="20%" align="center" >
																		<?php include_partial('default/ordering',array('title'=>'Label','ordering'=>false,"siteURL"=>'faq/counceledgeList','alias'=>'Label','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?>																	</td>
																	
																	<td class="border-right border-left border-top" width="20%" align="center">
																		<?php include_partial('default/ordering',array('title'=>'Field Type','ordering'=>false,"siteURL"=>'faq/counceledgeList','alias'=>'FieldType','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?>																	</td>
																	
																	<td class="border-right border-left border-top" width="20%" align="center">
																		<?php include_partial('default/ordering',array('title'=>'Options','ordering'=>false,"siteURL"=>'faq/counceledgeList','alias'=>'Options','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?>																	</td>
																	
																	<td class="border-right border-top"  align="center">
																		<?php include_partial('default/ordering',array('title'=>'Required','ordering'=>false,"siteURL"=>'faq/counceledgeList','alias'=>'Required','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?>																	</td>
																	<td class="whttxt border-right border-top" width="20%" align="center" >Action</td>
																</tr>
																
																
																<?php if($pager->count() > 0){?><!-- if($pager->getnbResults() > 0) -->
																
																
																<!-- Start Drag Drop Area -->
																<tr>
																	<td colspan="5" style="padding:0px;">
																		<div id="contentLeft">
																			<ul id="listRecord">
																			<?php foreach ($pager as $custRecord): ?> 
																				<li  id="recordsArray_<?php echo $custRecord->getId(); ?>">
																					<table cellspacing="0" cellpadding="0" width="100%">
																						<tr>
																							<td width="20%" class="fldrowbg border-right border-left"  align="left" valign="top" id="label_<?php echo $custRecord->getId(); ?>">
																								<?php echo $custRecord->getLabel() ?>																							</td>
																							
																							
																							<td width="20%" class="fldrowbg border-right border-left"  align="left" valign="top" id="fieldType_<?php echo $custRecord->getId(); ?>">
																								<?php echo $custRecord->getFieldType() ?>																							</td>
																							
																							<td width="20%" class="fldrowbg border-right border-left"  align="left" valign="top" id="options_<?php echo $custRecord->getId(); ?>">
																								<?php if($custRecord->getOptions() != '' ) 
																								        echo $custRecord->getOptions();
																								      else 
																								        echo '---';   ?>																							</td>
																							
																							
																							
																							<td width="20%" class="fldrowbg border-right" align="center" valign="top" id="required_<?php echo $custRecord->getId(); ?>">
																								<?php echo $custRecord->getRequired() ?>																							</td>
																							
																							<td width="20%" class="fldrowbg border-right" align="center" id="action">
																							
																								<a href="#" id="editRecord" onclick="editRecord(<?php echo $custRecord->getId()?>);">
																									<?php echo image_tag('admin/edit-cases-icon.png',array(
																																	'border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>'24px','height'=>'25px'))?>																								</a> 
																								<a href="<?php echo url_for('contactus/deleteRecord?id='.$custRecord->getId())?>" id="deleteRecord">
																									<?php echo image_tag('admin/delete-cases-icon.png',array(
																															'width'=>"24px",'height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();"))?>																								</a>																							</td>

																						</tr>
																					</table>
																				</li>
																				<?php endforeach; ?>
																			</ul>
																		</div>																	</td>
																</tr>
																
																<!-- END Drag Drop Area-->
																<?php } else { ?> 
																<tr><td>&nbsp;</td></tr>
																<tr class="fldbg" id="noRecord"><td class="errormss" id="norecord" colspan="5">No Field Found!!</td></tr>
																<tr><td>&nbsp;</td></tr>
																
																
																
																<?php } ?>
																
																
																
															</table>
															</td>
													</tr>
													<tr align="right" valign="top">
														<td colspan="2" class="ListAreaPad">
															<?php
																if($orderBy) $varExtra .="&orderBy=$orderBy";
																if($orderType) $varExtra .="&orderType=$orderType";
															?>
															<?php //include_partial("default/pagging",array('pager' => $pager, '','strUrl' => '@faq_list', 'varExtra' => $varExtra));?>														</td>
													</tr>
												</table>								
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" height="5"></td>
						</tr>
					</table>
				</td>
			</tr>
            <tr>
                <td align="left" valign="top" height="20"></td>
            </tr>
		</table>
	</td>
</tr>

<tr>
    <td align="left" valign="top">&nbsp;</td>
</tr>
<tr>
    <td align="left" valign="top">&nbsp;</td>
</tr>
</table>









<input type="hidden" value="<?php echo $pager->count();?>" id="totalRecord">
<script language="javascript">

   /* Start code added by jaydip dodiya client issue 446 */
    function checkRequired()
    {
        if($('#fieldType').find('option:selected').val() == "Captcha")
        {
            $('#required').attr('checked', true);
        }
    }
    /* End code added by jaydip dodiya client issue 446 */

function checkFieldType() {
	
	var value = $('#fieldType').find('option:selected').val();
	
	
	if(value=='DropDown' ||  value=='CheckBox' || value=='Radio' ){
		//$('#options').attr('readonly', false);
            $('#options').attr('disabled', false);//line added and change by jaydip dodiya cause client issue 406
	}else{
		$('#options').attr('value', '');
		//$('#options').attr('readonly', true);
            $('#options').attr('disabled', true);//line added and change by jaydip dodiya cause client issue 406
	}
		
    /* Start code added by jaydip dodiya client issue 446 */
    if(value == "Captcha")
    {
        $('#required').attr('checked', true);
    }
    else
    {
        $('#required').attr('checked', false);
    }
    /* End code added by jaydip dodiya client issue 446 */

	
}

// functionality is used for editing the dynamic fields data
function editRecord(id){

		var Label 			= $.trim($('#label_'+id).text());
		var FieldType 		= $.trim($('#fieldType_'+id).text());
		var Options 		= $.trim($('#options_'+id).text());
	    var r				= $.trim($('#required_'+id).text());
	 
	  	$('#fieldType').val(FieldType);
	  	$('#label').val(Label);
	  	$('#options').val(Options);
	  
	  	if(r=='Yes')
	  		$('#required').attr('checked', true);
	  	else
	  		$('#required').attr('checked', false);
	  	
	  	//$('#recordsArray_'+id).hide();
	  	
	 	$('#modeAdd').css("display", "none");
	  	$('#modeEdit').css("display", "block");
	  	
	  	$('#rid').remove();
      	$('#r').append("<input type='hidden' name='id' id='rid' value='"+id+"' />");
      	
		if(FieldType=='DropDown' ||  FieldType=='CheckBox' || FieldType=='Radio' ){
			//$('#options').attr('readonly', false);
            $('#options').attr('disabled', false);//line added and change by jaydip dodiya cause client issue 406
		}else{
			$('#options').attr('value', '');
			//$('#options').attr('readonly', true);
            $('#options').attr('disabled', true);//line added and change by jaydip dodiya cause client issue 406
		}
		
    /* Start code added by jaydip dodiya client issue 446 */
    if($('#fieldType').val() == "Captcha")
    {
         $('#required').attr('checked', true);   
    }
    /* End code added by jaydip dodiya client issue 446 */

		$('#labelMsg').remove();
      	$('#optionsMsg').remove();
      	    
	
    
}

// cancel the Edit operation
function cancelRow(){
	
	
	$('#modeAdd').css("display", "block");
  	$('#modeEdit').css("display", "none");
	
  	var id = $('#rid').val();
  	
  	$('#rid').remove();
  	
	
 	$("input[type=text], textarea").val("");
	$('#required').attr('checked', false);
	$('#fieldType').val('Text');
	
	$('#recordsArray_'+id).show();
	
	$('#labelMsg').remove();
    $('#optionsMsg').remove();
        $('#options').attr('disabled', true);//line added and change by jaydip dodiya cause client issue 406
}



$(document).ready(function()
{	
	// functionality is used for connect the friends in search module	
	
	$(function() 
		{
			$("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function()
			{
				
				var order = $(this).sortable("serialize") ;
				
				//alert(order);
				
				$.post("<?php echo url_for("contactus/globelOrdering"); ?>", order, function(theResponse){});
			}
			});
		});
		
	
	
	// functionality is used for saving the dynamic fields data
   $("#edit_btn").click(function() {    
       
	  var id 			= $('#rid').attr('value');
      var FieldType 	= $('#fieldType').attr('value');
      var Label 		= $('#label').attr('value');
      var Options 		= $('#options').attr('value');
      var Required		= $('#required').is(':checked');
      var TotalRecord	= $('#totalRecord').attr('value');
      
      var cnt = 0;
   
      
     if(FieldType=='DropDown' ||  FieldType=='CheckBox' || FieldType=='Radio' ){
      	
      	$('#labelMsg').remove();
      	$('#optionsMsg').remove();
      	
      	if(Label==''){
      	 	var labelError = '<p class="errormss" id="labelMsg" style="float:left; width:260px;padding:0px !important">Please Enter Label</p>';
      	 	$("#label").after(labelError);
      	 	cnt++;
      	 
      	}  
      
      	if(Options==''){
      		var labelError = '<p class="errormss" id="optionsMsg" style="float:left; width:320px; padding:0px !important">Please Ennter Options</p>';
      	 	$("#options").after(labelError);
      	 	cnt++;
      	}
      	
      	
      }else if(Label==''){
      	
      	 $('#labelMsg').remove();
      	 var labelError = '<p class="errormss" id="labelMsg" style="float:left; width:260px;padding:0px !important">Please Enter Label</p>';
      	 $("#label").after(labelError);
      	 cnt++;
      	 
  	  }  
      	
      if(cnt!=0){
      	return false;
      }
      
      	  
      $.ajax( {
          type: "POST",
          url: "<?php echo url_for('contactus/saveData'); ?>",
          data : { id : id, FieldType : FieldType, Label : Label, Options : Options, Required : Required },
          beforeSend: function(){
	   			 
		  },
    	  success: function(output){
    	  	  
	  	      var r;
			  if(Required==true)r='Yes';else r='No';
			  
			  $("input[type=text], textarea").val("");
    	      $('#required').attr('checked', false);
			  $('#fieldType').val('Text');
			  
			  $('#totalRecord').val(TotalRecord);
			  
			
			  //$('#recordsArray_'+id).css("display", "block");
			  $('#recordsArray_'+id).show().html();
			  
			
			  var html = '<table cellspacing="0" cellpadding="0" width="100%"><tr><td width="20%" class="fldrowbg border-right border-left"  align="left" valign="top" id="label_'+id+'">'+Label+'</td><td width="20%" class="fldrowbg border-right border-left"  align="left" valign="top" id="fieldType_'+id+'">'+FieldType+'</td><td width="20%" class="fldrowbg border-right border-left"  align="left" valign="top" id="options_'+id+'">'+Options+'</td><td width="20%" class="fldrowbg border-right border-left"  align="center" valign="top" id="required_'+id+'">'+r+'</td><td class="fldrowbg border-right border-left" align="center" valign="top"><a href="#" id="editRecord" onclick="editRecord('+id+');"><img width="24px" height="25px" border="0" src="/images/admin/edit-cases-icon.png" title="Edit" alt="Edit"></a> <a href="/admin_dev.php/contactus/deleteRecord/id/'+id+'"><img border="0" src="/images/admin/delete-cases-icon.png" onclick="return deleteConfirmation('+id+');" title="Delete" alt="Delete" width="24px" height="25px"></a> </td></tr></table>';
			  $('#recordsArray_'+id).html(html);
			  
			  // for display message
			  $('#ajaxMsgEdit').show();
			  $('#ajaxMsgEdit').delay(3000).fadeOut(1000);
			  
			  $('#modeAdd').css("display", "block");
  			  $('#modeEdit').css("display", "none");
	  	
	  		  $('#rid').remove();
	  	 
          }
      });
    $('#options').attr('disabled', true);//line added and change by jaydip dodiya cause client issue 406
   });
   
   
    
	// functionality is used for saving the dynamic fields data
   $("#blue_button").click(function() {    
       
      var FieldType 	= $('#fieldType').attr('value');
      var Label 		= $('#label').attr('value');
      var Options 		= $('#options').attr('value');
      var Required		= $('#required').is(':checked');
      var TotalRecord	= $('#totalRecord').attr('value');
      var chkRow 		= $('.errormss').text();
      
      
      
     var cnt = 0;
      
     if(FieldType=='DropDown' ||  FieldType=='CheckBox' || FieldType=='Radio' ){
      	
      	$('#labelMsg').remove();
      	$('#optionsMsg').remove();
      	
      	if(Label==''){
      	 	var labelError = '<p class="errormss" id="labelMsg" style="float:left; width:260px;padding:0px !important">Please Enter Label</p>';
      	 	$("#label").after(labelError);
      	 	cnt++;
      	 
      	}  
      
      	if(Options==''){
      		var labelError = '<p class="errormss" id="optionsMsg" style="float:left; width:320px;padding:0px !important">Please Enter Options</p>';
      	 	$("#options").after(labelError);
      	 	cnt++;
      	}
      	
      	
      }else if(Label=='' || Label=='undefined' ){
      	
      	 $('#labelMsg').remove();
      	 var labelError = '<p class="errormss" id="labelMsg" style="float:left; width:260px;padding:0px !important">Please Enter Label</p>';
      	 $("#label").after(labelError);
      	 cnt++;
      	 
  	  }  
      	
      if(cnt!=0){
      	return false;
      }
      	
     
    
      
      $.ajax( {
          type: "POST",
          url: "<?php echo url_for('contactus/saveData'); ?>",
          data : { FieldType : FieldType, Label : Label, Options : Options, Required : Required, TotalRecord : TotalRecord },
          beforeSend: function(){
	   			 
		  },
    	  success: function(output){
    	  		
    	  	  
	  	      var r;
			  if(Required==true)r='Yes';else r='No';
			  
			  
    	      $("input[type=text], textarea").val("");
    	      $('#required').attr('checked', false);
			  $('#fieldType').val('Text');
			  
			  TotalRecord = parseInt(TotalRecord) + 1;
			  $('#totalRecord').val(TotalRecord);
			  
			  // when no record found then
			  
			  if(chkRow == "No Field Found!!"){
			  
			  	$('#noRecord').remove();
			  	 var html = '<tr><td colspan="5"><div id="contentLeft"><ul id="listRecord" class="ui-sortable"><li id="recordsArray_'+output+'"><table cellspacing="0" cellpadding="0" width="100%"><tr><td width="20%" class="fldrowbg border-right border-left"  align="left" valign="top" id="label_'+output+'">'+Label+'</td><td width="20%" class="fldrowbg border-right border-left"  align="left" valign="top" id="fieldType_'+output+'">'+FieldType+'</td><td width="20%" class="fldrowbg border-right border-left"  align="left" valign="top" id="options_'+output+'">'+Options+'</td><td width="20%" class="fldrowbg border-right border-left"  align="center" valign="top" id="required_'+output+'">'+r+'</td><td width="20%" class="fldrowbg border-right border-left"  align="center" valign="top"><a onclick="editRecord('+output+');" id="editRecord" href="#"><img width="24px" height="25px" border="0" src="/images/admin/edit-cases-icon.png" title="Edit" alt="Edit"></a> <a href="/admin_dev.php/contactus/deleteRecord/id/'+output+'"><img border="0" src="/images/admin/delete-cases-icon.png" onclick="return deleteConfirmation();" title="Delete" alt="Delete" width="24px" height="25px"></a> </td></tr></table></ul></div></td></tr>';
			  	 $(".brd1 tr.fldbg").after(html);
			  	 
			  }else{
			  	
			  	 
			  	 var html = '<li id="recordsArray_'+output+'"><table cellspacing="0" cellpadding="0" width="100%"><tr><td width="20%" class="fldrowbg border-right border-left"  align="left" valign="top" id="label_'+output+'">'+Label+'</td><td width="20%" class="fldrowbg border-right border-left"  align="left" valign="top" id="fieldType_'+output+'">'+FieldType+'</td><td width="20%" class="fldrowbg border-right border-left"  align="left" valign="top" id="options_'+output+'">'+Options+'</td><td width="20%" class="fldrowbg border-right border-left"  align="center" valign="top" id="required_'+output+'">'+r+'</td><td width="20%" class="fldrowbg border-right border-left"  align="center" valign="top"><a onclick="editRecord('+output+');" id="editRecord" href="#"><img width="24px" height="25px" border="0" src="/images/admin/edit-cases-icon.png" title="Edit" alt="Edit"></a> <a href="/admin_dev.php/contactus/deleteRecord/id/'+output+'"><img border="0" src="/images/admin/delete-cases-icon.png" onclick="return deleteConfirmation();" title="Delete" alt="Delete" width="24px" height="25px"></a> </td></tr></table>';
			  	 $("#listRecord li:last").after(html);
			  	 
			  }
			 
			  
			  // for display message
			  $('#ajaxMsg').show();
			  $('#ajaxMsg').delay(3000).fadeOut(1000);
			  
			  // for remove the validation message
			  $('#labelMsg').remove();
			  $('#optionsMsg').remove();
			  
			  //For sorting the Row
				 $("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function()
				{
					
					var order = $(this).sortable("serialize") ;
					
					$.post("<?php echo url_for("contactus/globelOrdering"); ?>", order, function(theResponse){});
				}
				});
			  	
			   
          }
      });
    $('#options').attr('disabled', true);//line added and change by jaydip dodiya cause client issue 406
   });
   
   
});
</script>
<script>
function TrimTextArea()
{
    $("#options").val( $.trim($("#options").val()) ) ;
}
</script>
