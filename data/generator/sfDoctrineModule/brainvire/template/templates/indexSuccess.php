<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="100%">
<!-- Bread Crumb Start -->
<table cellspacing="0" cellpadding="0" class="AdminNavBar">
 <tr>
  <td width="66%" class="drkgrylnk padlft"><a href='[?php echo url_for("default/index");?]' title="Home"> [?php echo image_tag("admin/icon_Home.gif", array("alt"=>"Home","border"=>"0","title"=>"Home"))?]</a></td>
  <td width="34%" align="right" class="AdminBreadCrumb">
   <table cellpadding="8" cellspacing="0" align="right">
    <tr align="center">
     <td width="57" class="LinkImg" ><a href="[?php echo url_for('<?php echo $this->getModuleName() ?>/new') ?]" title="Add New">[?php echo image_tag("admin/Icon_AddNew.gif" , array("alt"=>"Add New","border"=>"0","title"=>"Add New"))?]<br/>
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
         <table cellspacing="0" cellpadding="0" align="center" class="ContentTable">
          <tr>
           <td width="10%" align="right" class="ContentBtmDotLn Pad5">[?php echo image_tag("admin/Icon_Groups.gif", array("alt"=>"<?php echo sfInflector::humanize($this->getSingularName()) ?>","title"=>"<?php echo sfInflector::humanize($this->getSingularName()) ?>","align"=>"middle"))?]</td>
           <td width="90%" class="ContentBtmDotLn">
            <div style="float:left;" class="Title"><?php echo sfInflector::humanize($this->getPluralName()) ?> List</div>
            <div style="float:right;" class="padrht">
						<form action="[?php echo url_for('<?php echo $this->getModuleName() ?>/index') ?]" method="post">
             <span>Search:</span>&nbsp;&nbsp;             
             [?php echo tag('input', array('name' => 'search_text', 'type' => 'text', 'id' => 'search_text', 'size' => '25', 'value' => $sf_request->getParameter('search_text'))); ?]
            [?php echo tag('input', array('name' => 'submit', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?]
            <a href="[?php echo url_for('<?php echo $this->getModuleName() ?>/index') ?]">Clear</a>
            </form>
           </div>
           </td>
          </tr>
          <tr valign="top">
           <td colspan="2" class="dot"></td>
          </tr>
          [?php if($sf_user->hasFlash('errMsg')) { ?]
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
             <tr>
              <td class="dot2"></td>
             </tr>
             <tr>
              <td class="errormss" align="center">[?php echo $sf_user->getFlash('errMsg');?]/td>
             </tr>
             <tr>
              <td class="dot2"></td>
             </tr>
            </table>
           </td>
          </tr>
          [?php }?]
          [?php if($sf_user->hasFlash('succMsg')) { ?]            
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="55%"  border="0" align="center" cellpadding="0" cellspacing="0">
             <tr>
              <td class="dot2"></td>
             </tr>
             <tr>
              <td class="success" align="center">[?php echo $sf_user->getFlash('succMsg');?]</td>
             </tr>
             <tr>
              <td class="dot2"></td>
             </tr>
            </table>
           </td>
          </tr>
          [?php }?]
          [?php              
                $varExtra = '';
                if($sf_request->getParameter('search_text')) 
                  $varExtra .="&search_text=".$sf_request->getParameter('search_text');
                //if($sortBy) $varExtra .="&sortBy=$sortBy";       
          ?]
          <tr align="center" valign="top">
           <td colspan="2" class="ListAreaPad">
            <table width="95%" cellspacing="1" cellpadding="1" class="brd1">
            [?php if($pager->getnbResults() > 0){?]
             <tr class="fldbg">
              <?php foreach ($this->getColumns() as $column): ?>
              <td align="center">[?php include_partial('default/ordering',array('title'=>'<?php echo sfInflector::humanize(sfInflector::underscore($column->getPhpName())) ?>','ordering'=>true,"siteURL"=>'<?php echo $this->getModuleName() ?>/index','alias'=>'<?php echo sfInflector::humanize(sfInflector::underscore($column->getPhpName())) ?>','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?]</td>
              <?php endforeach; ?>
              <td width="20%" align="center" class="whttxt">Action</td>
             </tr>              
               [?php #foreach ($<?php echo $this->getPluralName() ?> as $<?php echo $this->getSingularName() ?>): ?]
               [?php foreach ($pager->getResults() as $<?php echo $this->getSingularName() ?>):?]
             <tr>
            <?php foreach ($this->getColumns() as $column): ?>
            <?php if ($column->isPrimaryKey()): ?>            
                <td align="center" class="fldrowbg" valign="top"><a href="[?php echo url_for('<?php echo $this->getModuleName() ?>/<?php echo isset($this->params['with_show']) && $this->params['with_show'] ? 'show' : 'edit' ?>?<?php echo $this->getPrimaryKeyUrlParams() ?>) ?]">[?php echo $<?php echo $this->getSingularName() ?>->get<?php echo $column->getPhpName() ?>() ?]</a></td>
            <?php else: ?>
                <td class="fldrowbg" align="center" valign="top">[?php echo $<?php echo $this->getSingularName() ?>->get<?php echo $column->getPhpName() ?>() ?]</td>
            <?php endif; ?>
            <?php endforeach; ?>
                <td class="fldrowbg" align="center">
                <a href="[?php echo url_for('<?php echo $this->getModuleName() ?>/delete?<?php echo $this->getPrimaryKeyUrlParams() ?>)?]">[?php echo image_tag('admin/Delete_small.gif',array('border'=>'0','alt'=>'Delete','title'=>'Delete'))?]</a>
                </td>
             </tr>
             [?php endforeach; ?]    
             [?php } else { ?] 
             <tr class="fldbg"><td class="errormss">No <?php echo sfInflector::humanize($this->getSingularName()) ?> found!</td></tr>
             [?php } ?]         
            </table>
           </td>
          </tr>
          <tr align="right" valign="top">
           <td colspan="2" class="ListAreaPad">                     
              [?php                 
                if($orderBy) $varExtra .="&orderBy=$orderBy";
                if($orderType) $varExtra .="&orderType=$orderType";
              ?]
               [?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => '<?php echo $this->getModuleName() ?>/index', 'varExtra' => $varExtra));?]
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