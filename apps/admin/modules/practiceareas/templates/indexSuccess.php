<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="35%" class="drkgrylnk padlft"><a href='<?php echo url_for("default/index");?>' title="Home"> <?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?></a></td>
  <td width="30%" class="drkgrylnk" align="center"><div class="Title">Practice Area Categories List</div></td>
  <td width="35%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <td width="57" class="LinkImg" ><a href="<?php echo url_for('practiceareas/new') ?>" title="Add New"><?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?><br/>
      Add </a></td>     
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
           <td width="10%" align="right" class="ContentBtmDotLn Pad5"><?php echo image_tag("admin/Icon_Groups.gif", array("alt"=>"Practice areas","title"=>"Practice areas","align"=>"middle"))?></td>
           <td width="90%" class="ContentBtmDotLn">
            <div style="float:left;" class="Title">Practice Area Categories List</div>
            <div style="float:right;" class="padrht">
		     <!--form action="<?php //echo url_for('practiceareas/index') ?>" method="post">
             <span>Search By Name :</span>&nbsp;&nbsp;             
             <?php //echo tag('input', array('name' => 'search_text', 'type' => 'text', 'id' => 'search_text', 'size' => '25', 'value' => $sf_request->getParameter('search_text'))); ?>
             <?php //echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
            <a href="<?php //echo url_for('practiceareas/index') ?>">Clear</a>
            </form--
           </div>
           </td>
          </tr>-->
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
          //if($sortBy) $varExtra .="&sortBy=$sortBy";
          ?>
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="100%" cellspacing="1" cellpadding="1" class="brd1">
            <?php if(count($qSearch) > 0){?>
             <tr class="fldbg">
                            <!--<td align="center"><?php //include_partial('default/ordering',array('title'=>'Id','ordering'=>true,"siteURL"=>'practiceareas/index','alias'=>'Id','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>-->
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Category Name','ordering'=>false,"siteURL"=>'practiceareas/index','alias'=>'Name','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <!--<td align="center"><?php //include_partial('default/ordering',array('title'=>'Parent Category','ordering'=>false,"siteURL"=>'practiceareas/index','alias'=>'Parent','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>-->
                            <td align="center"><?php include_partial('default/ordering',array('title'=>'Created Date','ordering'=>false,"siteURL"=>'practiceareas/index','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
                            <!--<td align="center"><?php //include_partial('default/ordering',array('title'=>'Updated Date','ordering'=>false,"siteURL"=>'practiceareas/index','alias'=>'Update date time','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>-->
                            <td width="20%" align="center" class="whttxt">Action</td>
             </tr>              
               <?php #for($i=0;$i<count($qSearch);$i++){ ?>
               <?php $i=1;?>
               <?php foreach ($qSearch as $practice_areas):?>
               <?php $class=$i++%2==0?"fldrowbgAlt":"fldrowbg";?>
               <tr class="<?php echo $class;?>">
                <!--<td align="center" class="fldrowbg" valign="top"><a href="<?php //echo url_for('practiceareas/edit?id='.$practice_areas->getId()) ?>"><?php //if (isset($qSearch[$i]['Id'])){ echo $qSearch[$i]['Id']; } ?></a></td>-->
                                                    <td class="fldrowbg" align="left" valign="top"><?php //echo $practice_areas['level'];
                                                    if (isset($practice_areas['level']) && $practice_areas['level'] == 0) {
                                                        if (isset($practice_areas['Name'])){
                                                            echo $practice_areas['Name'];
                                                        }
                                                    }elseif (isset($practice_areas['level']) && $practice_areas['level'] == 1){
                                                        if (isset($practice_areas['Name'])){
                                                            echo "----->".$practice_areas['Name'];
                                                        }
                                                    }elseif (isset($practice_areas['level']) && $practice_areas['level'] == 2){
                                                        if (isset($practice_areas['Name'])){
                                                            echo "---------->".$practice_areas['Name'];
                                                        }
                                                    }
                                                    ?></td>
                                                    <!--<td class="fldrowbg" align="left" valign="top"><?php 
                                                    /*if (isset($practice_areas['ParentId']) && $practice_areas['ParentId'] != 0) {
                                                    echo PracticeAreasTable::getParentName($practice_areas['ParentId']);
                                                    }else {
                                                    echo "Parent Category";
                                                    }*/
                                                    ?></td>-->
                                                    <td class="fldrowbg" align="center" valign="top"><?php if (isset($practice_areas['CreateDateTime'])){ echo date(sfConfig::get('app_dateformat'), strtotime($practice_areas['CreateDateTime'])); }?></td>
                                                    <!--<td class="fldrowbg" align="center" valign="top"><?php //echo $practice_areas->getUpdateDateTime() ?></td>-->
                                        <td class="fldrowbg" align="center">
                                        <?php echo link_to(image_tag('admin/view-icon.png',array('width'=>'24px','height'=>'25px','alt'=>'View','title'=>'Click to View Staff Details')),'practiceareas/view?id='.$practice_areas['Id'].'&level='.$practice_areas['level']); ?>
                                        <?php if (isset($practice_areas['Status']) && $practice_areas['Status'] == "Active") { ?>
												<?php echo link_to(image_tag('admin/active-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>sfConfig::get('app_ActiveDeactive_DactiveToolTip'))),'practiceareas/changeStatus?status=Inactive&id='.$practice_areas['Id']); ?>
                                                <!--<a href="<?php //echo url_for('practiceareas/changeStatus?status=Inactive&id='.$practice_areas['Id'])?>"><?php //echo image_tag('admin/active-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Click To Inactive Status'))?></a>&nbsp;                               	-->
                                        <?php }else {  ?>
												<?php echo link_to(image_tag('admin/inactive-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>sfConfig::get('app_ActiveDeactive_ActiveToolTip'))),'practiceareas/changeStatus?status=Active&id='.$practice_areas['Id']);?>
                                                <!--<a href="<?php //echo url_for('practiceareas/changeStatus?status=Active&id='.$practice_areas['Id'])?>"><?php //echo image_tag('admin/inactive-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Click To Active Status'))?></a>&nbsp;-->
                                        <?php } ?>
                                        <?php echo link_to(image_tag('admin/edit-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Edit')),'practiceareas/edit?id='.$practice_areas['Id'].'&level='.$practice_areas['level']);?>
                                        <?php echo link_to(image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deletePracticeAreaConfirmation(".$practice_areas['level'].");")),'practiceareas/delete?id='.$practice_areas['Id'].'&level='.$practice_areas['level']);?>

                                        <!--<a href="<?php //echo url_for('practiceareas/edit?id='.$practice_areas['Id'].'&level='.$practice_areas['level'])?>"><?php //echo image_tag('admin/edit-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Edit'))?></a>&nbsp;
                                        <a href="<?php //echo url_for('practiceareas/delete?id='.$practice_areas['Id'].'&level='.$practice_areas['level'])?>"><?php //echo image_tag('admin/delete-cases-icon.png',array('width'=>'24px','height'=>'25px','border'=>'0','alt'=>'Delete','title'=>'Delete','OnClick'=>"return deletePracticeAreaConfirmation(".$practice_areas['level'].");"))?></a>-->
                </td>
             </tr>
             <?php //} ?>    
             <?php endforeach; ?>    
             <?php } else { ?> 
             <tr class="fldbg"><td class="errormss">No items found.</td></tr>
             <?php } ?>         
            </table>
           </td>
          </tr>
          <tr align="right" valign="top">
           <td colspan="2" class="ListAreaPad">                     
              <?php                 
              /*if($orderBy) $varExtra .="&orderBy=$orderBy";
              if($orderType) $varExtra .="&orderType=$orderType";
              ?>
               <?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'practiceareas/index', 'varExtra' => $varExtra));*/?>
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