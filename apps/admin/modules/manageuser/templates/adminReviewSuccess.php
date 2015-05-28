<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
<tr>
<td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
<td width="30%" class="drkgrylnk" align="center"><div class="Title">Review Rating</div></td>
<td width="35%" align="right" class="AdminBreadCrumb">
<table cellpadding="8" cellspacing="0" align="right">
	<tr align="center">
	<td width="57" class="LinkImg" ></td>
	</tr>
</table>
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
			<td align="left" valign="top" colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td height="20" align="left" valign="top">&nbsp;</td>
		</tr> -->
		<tr valign="top">
		<td colspan="2" class="dot"></td>
		</tr>
		<?php include_partial('default/message'); ?>
		
		<tr>
            <td align="center" valign="top" class="CasesListSearch" colspan="2">
            <form action="<?php echo url_for('manageuser/adminReview') ?>"  method="post" enctype="multipart/form-data">
    	       <table width="100%" cellspacing="10" cellpadding="0">
               <tr style="line-height:22px">
                <td width="100px" align="left" valign="top"><?php echo $searchForm['searchcustomer']->renderLabel(); ?></td>
                <td width="200px" align="left" valign="top"><?php 
													$searchForm->setDefault("searchcustomer",$searchBy);
													echo $searchForm['searchcustomer']->render(array("style"=>"width:200px;"));
													
											?>
				</td>

                <td width="110px" align="left" valign="top"><?php echo $searchForm['searchspam']->renderLabel(); ?></td>
                <td width="110px" align="left" valign="top"><?php 
					
					if($searchBySpam != "")
						echo $searchForm['searchspam']->render(array('checked'=>'checked'));
					else
						echo $searchForm['searchspam']->render();
					?>
				</td>

				<td align="left" valign="top"><span class="bluButton"> 
					<?php echo tag('input', array('name' => 'search_btn', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
					<a href="<?php echo url_for('manageuser/adminReview') ?>" class ='CommonButton'>Clear</a></td>
					
               </tr>

			</table>
            </form>
            </td>
        </tr>
        <tr>
			<td align="left" valign="top" colspan="2">&nbsp;</td>
		</tr>

		<tr align="center" valign="top">
		<td colspan="2" class="ListAreaPad">
			<table width="100%" cellspacing="1" cellpadding="1" class="brd1">
			<?php $varExtra =""; ?>
			<?php if($pager->getnbResults() > 0){?>
			<tr class="fldbg">
							<td align="center"><?php include_partial('default/ordering',array('title'=>'Customer Name','ordering'=>false,"siteURL"=>'manageuser/adminReview','alias'=>'Customer Name','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
							<td align="center"><?php include_partial('default/ordering',array('title'=>'Reviewed By','ordering'=>false,"siteURL"=>'manageuser/adminReview','alias'=>'User Name','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
							<td align="center"><?php include_partial('default/ordering',array('title'=>'Rate','ordering'=>false,"siteURL"=>'manageuser/adminReview','alias'=>'Rate','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
							<td align="center"><?php include_partial('default/ordering',array('title'=>'Review','ordering'=>false,"siteURL"=>'manageuser/adminReview','alias'=>'Review','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
							<td align="center"><?php include_partial('default/ordering',array('title'=>'Mark Review As Spam','ordering'=>false,"siteURL"=>'manageuser/adminReview','alias'=>'Spam','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
							<td align="center"><?php include_partial('default/ordering',array('title'=>'Posted Date','ordering'=>false,"siteURL"=>'manageuser/adminReview','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
							<td width="10%" align="center" class="whttxt">Action</td>
			</tr>

			<?php $i =1; ?>
			<?php foreach ($pager->getResults() as $revewRating):?>
			<?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
			<tr class="<?php echo $class;?>">
													<td width="10%" class="fldrowbg" align="left" valign="top"><?php echo link_to(ucwords($revewRating->getReviewRatingCustomers()->getFirstName()." ".$revewRating->getReviewRatingCustomers()->getLastName()), "dashboard/index?customerId=".$revewRating->getReviewRatingCustomers()->getId()); ?></td>
													<td width="10%" valign="top"><?php echo ucwords($revewRating->getReviewRatingUsers()->getFirstName()." ".$revewRating->getReviewRatingUsers()->getLastName()); ?></td>
													<td width="10%" class="fldrowbg" align="center" valign="top"><?php echo clsCommon::displayRatingStar($revewRating->getRate())."     (".$revewRating->getRate().")"; ?></td>
													<td width="40%" class="fldrowbg" align="left" valign="middle"><?php echo nl2br($revewRating->getReview()); ?></td>
													<td width="10%" class="fldrowbg" align="center" valign="top">
													<?php if($revewRating->getSpam() == 1): ?>
																			<input type="checkbox" checked=true id="review_<?php echo $revewRating->getId()?>" onClick="InsertSpam('<?php echo $revewRating->getId()?>');">
																		<?php else: ?>
																			<input type="checkbox"  id="review_<?php echo $revewRating->getId()?>" onClick="InsertSpam('<?php echo $revewRating->getId()?>');">
																		<?php endif; ?>
													</td>
													<td width="10%" class="fldrowbg" align="center" valign="top"><?php echo date(sfConfig::get('app_dateformat'),strtotime($revewRating->getCreateDateTime())) ?></td>
										<td width="10%" class="fldrowbg PracticeAreaActionIcons" align="center" valign="top">

										<?php
										
										if($revewRating->getStatus()== sfConfig::get('app_Status_Active'))
										{
											echo link_to(image_tag("admin/active-cases-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'),'alt'=>'Active')),"manageuser/changeReviewStatus?status=".sfConfig::get('app_Status_Inactive')."&id=".$revewRating->getId()."&flag=admin");
										}
										else
										{
											echo link_to(image_tag("admin/inactive-icon.png",array('width'=>'24px','height'=>'25px','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'),'alt'=>'Inactive')),"manageuser/changeReviewStatus?status=".sfConfig::get('app_Status_Active')."&id=".$revewRating->getId()."&flag=admin");
										}
																	
											echo link_to(image_tag('admin/delete-cases-icon.png',array('border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deleteConfirmation();",'width'=>24,'height'=>25)), 'manageuser/deleteReview?id='.$revewRating->getId().'&userId='.$revewRating->getUserId().'&customerId='.$revewRating->getCustomerId());
										?>
				</td>
			</tr>

			<?php endforeach; ?>
			<?php } else { ?> 
			<tr class="fldbg"><td class="errormss">No items found.</td></tr>
			<?php } ?>
			</table>
		</td>
		</tr>
		<tr align="center" valign="top">
		<td colspan="2" class="ListAreaPad">
			<?php
			if($orderBy) $varExtra .="&orderBy=$orderBy";
			if($orderType) $varExtra .="&orderType=$orderType";
			if($searchBy) $varExtra .="&searchBy=$searchBy";
			if($searchBySpam) $varExtra .="&searchBySpam=$searchBySpam";
			?>
			<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'manageuser/adminReview', 'varExtra' => $varExtra));?>
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

<script type="text/javascript">

function InsertSpam(id)
{
    if(document.getElementById('review_'+id).checked == true)
    {
		$.ajax({
				  'type': 'POST',
				  'url': '<?php echo url_for("manageuser/ajaxSpamInsert"); ?>',
				  'data': {reviewId:id, spamValue:1}
			  });
    }
    else
    {
		$.ajax({
				  'type': 'POST',
				  'url': '<?php echo url_for("manageuser/ajaxSpamInsert"); ?>',
				  'data': {reviewId:id, spamValue:0}
			  });
    }
}
</script>