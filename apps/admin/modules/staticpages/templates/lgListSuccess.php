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
						<?php include_partial('staticpages/cmsMenu');?>
						<!--END VERTICAL MENU-->
					</td>
					<td align="center" valign="top" class="CashDetails">
					<table width="96%" cellspacing="0" cellpadding="0">
						<tr>
							<td align="left" valign="top" height="25">&nbsp;</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteTab">
								<?php include_partial('staticpages/cmsHorizontalMenu');?>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="WebsiteDetails">
								<table width="100%" cellspacing="10" cellpadding="0">
									<tr>
										<td align="center" valign="top">
											<table width="98%" cellspacing="1" cellpadding="1" class="PageListHeading">
												<tr>
													<td align="left" valign="middle"><strong>Legalgrip CMS Pages List</strong></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td align="center" valign="top">
											<table cellspacing="0" cellpadding="0" align="center" width="100%">		
												<tr valign="top">
													<td colspan="2" class="dot"></td>
												</tr>
												<tr align="center" valign="top">
													<?php include_partial('default/message'); ?>
												</tr>
												<?php
														$varExtra = '';
														if($sf_request->getParameter('search_text')) 
														$varExtra .="&search_text=".$sf_request->getParameter('search_text');
												?>
												<tr align="center" valign="top">
													<td colspan="2" class="ListAreaPad">
														<table width="100%" cellspacing="1" cellpadding="1" class="brd1">
															<?php if($pager->getnbResults() > 0){?>
															<tr class="fldbg">
																<td width="35%" align="center"><?php include_partial('default/ordering',array('title'=>'Page Title','ordering'=>false,"siteURL"=>'staticpages/index','alias'=>'Title','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																<td width="35%" align="center"><?php include_partial('default/ordering',array('title'=>'Page key','ordering'=>false,"siteURL"=>'staticpages/index','alias'=>'Unique key','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																<td width="15%" align="center"><?php include_partial('default/ordering',array('title'=>'Updated date','ordering'=>false,"siteURL"=>'staticpages/index','alias'=>'Update date time','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
																<td width="15%" align="center" class="whttxt">Action</td>
															</tr>
															<?php $i = 1; ?>
															<?php foreach ($pager->getResults() as $cms_pages):?>
															<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
															<tr class="<?php echo $class;?>">
																<td class="fldrowbg" align="left" valign="top"><?php echo link_to($cms_pages->getTitle(),'staticpages/edit?id='.$cms_pages->getId().'&temp=LG'); //$cms_pages->getTitle()?></td>
																<td class="fldrowbg" align="left" valign="top"><?php $temp = explode("_",$cms_pages->getUniqueKey()); echo $temp[1]; ?></td>
																<td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'), strtotime($cms_pages->getUpdateDateTime())); ?></td>
																<td class="fldrowbg" align="center">
																	<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Edit')),'staticpages/edit?id='.$cms_pages->getId().'&temp=LG'); ?>
																	<?php if($cms_pages->getType() == sfConfig::get("app_CmsPageType_Static")): ?>
																			<a href="#" style="cursor:none;"><?php echo image_tag("admin/blank-img.png",array('width'=>24,'height'=>25)) ; ?></a>
																		<?php else: ?>
																			<?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete', 'OnClick'=>"return deleteConfirmation();")),'staticpages/delete?id='.$cms_pages->getId().'&temp=LG'); ?>
																		<?php endif;?>
																</td>
															</tr>
															<?php endforeach; ?>
															<?php } else { ?> 
															<tr class="fldbg"><td class="errormss">No items found.</td></tr>
															<?php } ?>
														</table>
													</td>
												</tr>
                                                 <tr>
                                                    	<td>&nbsp;</td>
                                                 </tr>
												<tr>
													<!--<td align="center" valign="top"  class="ListAreaPad">-->
													<td colspan="2" class="ListAreaPad" align="center">
														<?php
															if($orderBy) $varExtra .="&orderBy=$orderBy";
															if($orderType) $varExtra .="&orderType=$orderType";
														?>
														<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'staticpages/lgList', 'varExtra' => $varExtra));?>

													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td align="left" valign="top" height="1"></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" height="20">&nbsp;</td>
						</tr>
					</table>
				</td>
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














<!--<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">-->
<!-- Bread Crumb Start -->
<!--<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href='--><?php /*echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">Legal Grip CMS Pages List</div></td>
  <td width="35%" align="right" class="AdminBreadCrumb">
   <!--<table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <td width="57" class="LinkImg" ><a href="<?php //echo url_for('staticpages/new') ?>" title="Add New"><?php //echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
      Add </a></td>     
    </tr>
   </table>-->
  </td>
 </tr>
</table>
<!-- Bread Crumb End -->
</td></tr>
<tr><td width="100%">
<!-- Control Panel Start -->
<table width="100%" cellspacing="2" cellpadding="0">
 <tr>
  <td align="center" class="ContentPad" height="10"></td>
 </tr>
 <tr>
  <td width="95%" align="center" class="ContentPad">
   <table width="99%" align="center" cellpadding="0" cellspacing="0" class="MainTbl">
    <tr>
     <td class="MaintblPadding">
      <table width="100%" cellspacing="0" cellpadding="0">
       <tr>
        <td class="ContentPad">
         <table cellspacing="0" cellpadding="0" align="center" width="100%">
          <!--<tr>
           <td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Cms pages","title"=>"Cms pages","align"=>"middle"))?></td>
           <td width="90%" class="ContentBtmDotLn">
            <div style="float:left;" class="Title">Legal Grip CMS Pages List</div>
            <!--<div style="float:right;" class="padrht">
			<form action="<?php /*echo url_for('staticpages/index') ?>" method="post">
             <span>Search:</span>&nbsp;&nbsp;             
             <?php echo tag('input', array('name' => 'search_text', 'type' => 'text', 'id' => 'search_text', 'size' => '25', 'value' => $sf_request->getParameter('search_text'))); ?>
            <?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
            <a href="<?php echo url_for('staticpages/index')*/ ?><!--">Clear</a>
            </form>
           </div>
           </td>
          </tr>-->
          <!--<tr valign="top">
           <td colspan="2" class="dot"></td>
          </tr>
			<tr align="center" valign="top">-->
				<?php /*include_partial('default/message'); ?>
			</tr>
          <?php              
                $varExtra = '';
                if($sf_request->getParameter('search_text')) 
                  $varExtra .="&search_text=".$sf_request->getParameter('search_text');
                //if($sortBy) $varExtra .="&sortBy=$sortBy";       
          ?>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="100%" cellspacing="1" cellpadding="1" class="brd1">
            <?php if($pager->getnbResults() > 0){?>
             <tr class="fldbg">
                <td width="40%" align="center"><?php include_partial('default/ordering',array('title'=>'Page Title','ordering'=>false,"siteURL"=>'staticpages/index','alias'=>'Title','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                <td width="40%" align="center"><?php include_partial('default/ordering',array('title'=>'Page key','ordering'=>false,"siteURL"=>'staticpages/index','alias'=>'Unique key','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                <td width="15%" align="center"><?php include_partial('default/ordering',array('title'=>'Updated date','ordering'=>false,"siteURL"=>'staticpages/index','alias'=>'Update date time','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                <td width="5%" align="center" class="whttxt">Action</td>
             </tr>              
             <?php #foreach ($cms_pagess as $cms_pages): ?>
             <?php $i = 1; ?>
             <?php foreach ($pager->getResults() as $cms_pages):?>
             <?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
             <tr class="<?php echo $class;?>">
                <td class="fldrowbg" align="left" valign="top"><?php echo $cms_pages->getTitle() ?></td>
                <td class="fldrowbg" align="left" valign="top"><?php $temp = explode("_",$cms_pages->getUniqueKey()); echo $temp[1]; ?></td>
                <td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'), strtotime($cms_pages->getUpdateDateTime())); ?></td>
                <td class="fldrowbg" align="center">
					<?php echo link_to(image_tag('admin/edit-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Edit')),'staticpages/edit?id='.$cms_pages->getId().'&temp=LG'); ?>
                    <!--<a href="<?php //echo url_for('staticpages/edit?id='.$cms_pages->getId().'&temp=LG')?>"><?php //echo image_tag('admin/edit-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Edit'))?></a>&nbsp;-->
                </td>
             </tr>
             <?php endforeach; ?>    
             <?php } else { ?> 
             <tr class="fldbg"><td class="errormss">No Cms pages found!</td></tr>
             <?php } ?>         
            </table>
           </td>
          </tr>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">                     
              <?php                 
                if($orderBy) $varExtra .="&orderBy=$orderBy";
                if($orderType) $varExtra .="&orderType=$orderType";
              ?>
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'staticpages/index', 'varExtra' => $varExtra));?>
           </td>
          </tr>
         </table>
        </td>
       </tr>
      </table>
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<!-- Control Panel End -->
</td></tr>
</table>
<?php */ ?>