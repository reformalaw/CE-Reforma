<table width="98%" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">
		<!--START TOP USER DETAIL-->
		<?php  include_component('website', 'usersDetail');?>
		<!--END TOP USER DETAIL-->
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="150" align="left" valign="top" class="LeftMenu">
			<!--START VERTICAL MENU-->
			<?php include_partial("websiteMenu"); ?>
			<!--END VERTICAL MENU-->
        </td>
        <td align="center" valign="top" class="CashDetails">
        	<table width="96%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" height="25">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="WebsiteTab"><table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" class="BorderBottom">&nbsp;</td>
        <td width="80" align="center" valign="middle" class="SelectTab">Page List</td>
        <td width="2" align="center" valign="middle" class="BorderBottom"></td>
        <td width="80" align="center" valign="middle" class="DeSelectTab"><a onClick="javascript: alert('Please select cms page to edit');" href="javascript:void(0)">Edit Page</a></td>
        <td class="BorderBottom">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top" class="WebsiteDetails">
    	<table width="100%" cellspacing="10" cellpadding="0">
           <tr>
                <td align="center" valign="top">
                	<table width="98%" cellspacing="1" cellpadding="1" class="PageListHeading">
                      <tr>
                        <td align="left" valign="middle"><strong>Page List</strong></td>
                        <td align="right" valign="middle">&nbsp;</td>
                      </tr>
                  </table>
                </td>
           </tr>
           <?php if($sf_user->hasFlash('succMsg')) { ?>
           <tr>
				<?php include_partial('default/message'); ?>
           </tr>
           <?php } ?>
          <tr>
            <td align="center" valign="top"><table width="98%" cellspacing="1" cellpadding="1" class="brd1">
            <?php if($pager->getnbResults() > 0){?>
             <tr class="fldbg">
                            <td width="35%" align="left"><?php include_partial('default/ordering',array('title'=>'Page Title','ordering'=>false,"siteURL"=>'personalcms/index','alias'=>'Title','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td width="35%" align="left"><?php include_partial('default/ordering',array('title'=>'Page key','ordering'=>false,"siteURL"=>'personalcms/index','alias'=>'Unique key','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Template','ordering'=>false,"siteURL"=>'personalcms/index','alias'=>'Template','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Created Date','ordering'=>false,"siteURL"=>'personalcms/index','alias'=>'Update date time','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td width="10%" align="center" class="whttxt">Action</td>
             </tr>              
             <?php #foreach ($cms_pagess as $cms_pages): ?>
             <?php $i = 1; ?> 
             <?php foreach ($pager->getResults() as $cms_pages):?>
             <?php
					// Check That Cms page Exist in Menu Or Not 
				$flag = WebsiteMenuTable::checkPracticeOrCmsExist($cms_pages->getWebsiteId(),"CmsPageId", $cms_pages->getId());
			?>
             <?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
             <tr class="<?php echo $class;?>">
                            <td class="fldrowbg" align="left" valign="top">
								<?php //echo $cms_pages->getTitle() ?>
								<?php echo link_to($cms_pages->getTitle(), 'website/customerCmsEdit?id='.$cms_pages->getId().'&customerId='.$sf_params->get('customerId'));?>
							</td>
                            <td class="fldrowbg" align="left" valign="top"><?php echo $cms_pages->getSlug(); ?></td>
                            <td class="fldrowbg" align="left" valign="top"><?php 
                            if ($cms_pages->getTemplate() == "column1") {
                            	echo "Column One";
                            }elseif ($cms_pages->getTemplate() == "column2L"){
                                echo "Column To Left";
                            }else {
                                echo "Column To Right";
                            }
                            ?>
                            </td>
                            <td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'), strtotime($cms_pages->getCreateDateTime())); ?></td>
                            <td class="fldrowbg PracticeAreaActionIcons" align="center">
								<?php
									echo link_to(image_tag('admin/edit-cases-icon.png',array('border'=>'0','alt'=>'Edit','title'=>'Edit','width'=>24,'height'=>25)), 'website/customerCmsEdit?id='.$cms_pages->getId().'&customerId='.$sf_params->get('customerId')); 
									if($cms_pages->getSlug() != 'home'):
										if($flag):
											echo link_to(image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Click here to Delete Cms Page','OnClick'=>"return deleteConfirmation();",'width'=>24,'height'=>25)), 'website/customerCmsDelete?id='.$cms_pages->getId()."&customerId=".$sf_params->get('customerId'));
										else:?>
											<a href="javascript:void(0)" OnClick="CmsPageExist();" > <?php echo image_tag("admin/delete-cases-icon.png",array('width'=>24,'height'=>25)) ;?> </a>
										<?php endif;?>
									<?php else: ?>
										<a href="#" style="cursor:none;"> <?php echo image_tag("admin/blank-img.png",array('width'=>24,'height'=>25)) ;?> </a>
								
								<?php endif; ?>
                                <!--<a href="<?php //echo url_for('website/customerCmsEdit?id='.$cms_pages->getId().'&customerId='.$sf_params->get('customerId'))?>" style="vertical-align:middle;"><?php //echo image_tag('admin/edit-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Edit'))?></a>&nbsp;
                                <a href="<?php //echo url_for('website/customerCmsDelete?id='.$cms_pages->getId())?>" style="vertical-align:middle;"><?php //echo image_tag('admin/Delete_small.gif',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>'return deleteConfirmation()'))?></a>-->
                            </td>
             </tr>
             <?php endforeach; ?>
             <?php } else { ?> 
             <tr class="fldbg"><td class="errormss">No items found.</td></tr>
             <?php } ?>
            </table></td>
          </tr>
			<tr>
				<td align="center" valign="top" colspan="2" class="ListAreaPad">
				<?php

				$varExtra.="&customerId=".$sf_params->get('customerId');
				?>
				<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'website/customerCms', 'varExtra' => $varExtra));?>
				</td>
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
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>








<?php /*?><table width="98%">
<tr>
<td align="left" valign="top">
		<!--START TOP USER DETAIL-->
		<?php  include_component('website', 'usersDetail');?>
		<!--END TOP USER DETAIL-->
</td>
</tr>
</table>

<!--START VERTICAL MENU-->
<table>
<tr>
<td width="150" align="left" valign="top" class="LeftMenu">
<?php include_partial("websiteMenu"); ?>
</td>
</tr>
</table>
<!--END VERTICAL MENU-->
<tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="95%" cellspacing="1" cellpadding="1" class="brd1">
            <?php if($pager->getnbResults() > 0){?>
             <tr class="fldbg">
                            <td width="35%" align="center"><?php include_partial('default/ordering',array('title'=>'Page Title','ordering'=>false,"siteURL"=>'personalcms/index','alias'=>'Title','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td width="35%" align="center"><?php include_partial('default/ordering',array('title'=>'Page key','ordering'=>false,"siteURL"=>'personalcms/index','alias'=>'Unique key','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Template','ordering'=>false,"siteURL"=>'personalcms/index','alias'=>'Template','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td width="10%" align="center"><?php include_partial('default/ordering',array('title'=>'Created Date','ordering'=>false,"siteURL"=>'personalcms/index','alias'=>'Update date time','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <td width="10%" align="center" class="whttxt">Action</td>
             </tr>              
             <?php #foreach ($cms_pagess as $cms_pages): ?>
             <?php $i = 1; ?> 
             <?php foreach ($pager->getResults() as $cms_pages):?>
             <?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
             <tr class="<?php echo $class;?>">
                            <td class="fldrowbg" align="left" valign="top"><?php echo $cms_pages->getTitle() ?></td>
                            <td class="fldrowbg" align="left" valign="top"><?php echo $cms_pages->getSlug(); ?></td>
                            <td class="fldrowbg" align="left" valign="top"><?php 
                            if ($cms_pages->getTemplate() == "column1") {
                            	echo "Column One";
                            }elseif ($cms_pages->getTemplate() == "column2L"){
                                echo "Column To Left";
                            }else {
                                echo "Column To Right";
                            }
                            ?>
                            </td>
                            <td class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'), strtotime($cms_pages->getCreateDateTime())); ?></td>
                            <td class="fldrowbg" align="center">
                                <a href="<?php echo url_for('website/customerCmsEdit?id='.$cms_pages->getId())?>" style="vertical-align:middle;"><?php echo image_tag('admin/edit-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Edit'))?></a>&nbsp;
                                <a href="<?php echo url_for('website/customerCmsDelete?id='.$cms_pages->getId())?>" style="vertical-align:middle;"><?php echo image_tag('admin/Delete_small.gif',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>'return deleteConfirmation()'))?></a>
                            </td>
             </tr>
             <?php endforeach; ?>    
             <?php } else { ?> 
             <tr class="fldbg"><td class="errormss">No Personal CMS Pages found!</td></tr>
             <?php } ?>         
            </table>
           </td>
          </tr><?php */?>