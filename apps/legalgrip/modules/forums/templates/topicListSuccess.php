<section>
	<div class="middle-inner">
		<div class="page">
			<div class="inner-top-link"></div>
			<div class="forum-list">
				<div class="inner-box-title"> <?php echo $forumsTitle;  #echo ucfirst($forumsTitle); ?> </div>
				<div class="forum-heading">
					<div class="forum-pagination">
						<?php
						/*$varExtra = "";
						if($orderBy) $varExtra .="&orderBy=$orderBy";
						if($orderType) $varExtra .="&orderType=$orderType";
						if($forumsId != "") $varExtra .="&forumsId=$forumsId";*/
						?>
						<?php #include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'forums/topicList', 'varExtra' => $varExtra));?>
					</div>

					<?php if($sf_user->getAttribute('user_user_id') != ''): ?>
						<div class="post-topic-btn">
							<a onclick="addForumsTopic('<?php echo $forumsId; ?>');" href="javascript:void(0);">
								<?php echo image_tag('legalgrip/post-topic-btn.png'); ?>
							</a>
						</div>
					<?php endif; ?>
					

					<div class="forum-search">
							<form id="frmSearchTopic" action="<?php echo url_for('forums/topicList?forumsId='.$forumsId) ?>"  method="post" enctype="multipart/form-data">
							<?php if($pager->getnbResults() > 0){ ?>
									<?php $form->setDefault("topicAttribute",$orderBy); ?>
									<?php echo $form["topicAttribute"]->render(array('onChange' => "sortby(this.value)"));?>
								<?php } ?>
								<?php $form->setDefault("searchtopic",$searchBy); ?>
								<label class=fontLabel>Search Topic: </label>
								<?php //echo $form["searchtopic"]->renderLabel(array(),array('class'=>'fontLabel'));?>
								<?php echo $form["searchtopic"]->render();?>
								<?php echo tag('input', array('name' => 'button', 'type' => 'button', 'id' => 'button', 'value' => 'Search', 'onClick'=>"frmsubmit();")); ?>
								<?php echo link_to("Clear","forums/topicList?forumsId=".$forumsId, array('class'=>"linkClass")); ?>
							</form>
					</div>
					
				</div>
				<div class="forum-listing">
					<?php if($pager->getnbResults() > 0): ?>
						<ul>
								<li class="head"><div class="first">Topic / Question</div><div class="second">Replies</div><div class="third">Views</div><div class="forth">Last Post By</div></li>
							<?php	foreach($pager as $forumsTopic):	?>
								<li class="row">
									<div class="first">
										<?php echo image_tag('legalgrip/forumlist-icon.png'); ?>
										<?php echo link_to($forumsTopic->getTopic(),"forums/replyList?topicId=".$forumsTopic->getId().'&forumsId='.$forumsId); ?> 
										<!--<p><?php //echo nl2br(substr($forumsTopic->getDescription(),0, 50 ).'...'); ?><p>--> <!--topic description-->
										<p><?php echo date(sfConfig::get('app_dateformat'),strtotime($forumsTopic->getCreateDateTime())); ?></p>
									</div>
									<div class="second">
										<?php echo $forumsTopic->getTotalReplies(); ?>
									</div>
									<div class="third">
										<?php echo $forumsTopic->getTotalViews(); ?>
									</div>
									<div class="forth">
										<?php $userData = Doctrine::getTable('Users')->find(array($forumsTopic->getLastRepliedBy())); ?>
										<?php 
										if($userData == "")
										echo "---";
										else
										echo ucwords($userData->getFirstName().' '.$userData->getLastName());
										?>
										<p>
											<?php 
											if($userData != "")
											 echo date(sfConfig::get('app_dateformat'),strtotime($forumsTopic->getLastRepliedDateTime())); ?>
										</p>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php else: ?>
						  <div>
							<div>No Topics Found!</div>
						  </div>	
					<?php endif; ?>
				</div>
				<?php
				$varExtra = "";
				if($orderBy) $varExtra .="&orderBy=$orderBy";
				if($orderType) $varExtra .="&orderType=$orderType";
				if($forumsId != "") $varExtra .="&forumsId=$forumsId";
				if($searchBy) $varExtra .="&searchBy=$searchBy";
				?>
				<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'forums/topicList', 'varExtra' => $varExtra));?>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
function addForumsTopic(forumsId) {

    $.fancybox.open({
        href : "<?php echo url_for('forums/newTopic?forumsId=')?>"+forumsId,
        type : 'iframe',
        padding : 5,
        minHeight: 370,
        minWidth: 400
    });

}

$(function () {
    $("#search_topic_topicAttribute").selectbox();
    $("#frmSearchTopic > div > ul.sbOptions > li:last a").css('border-bottom','0'); // Remove CSS from Sort By Drop Down
});

function sortby(val) {
    $("#frmSearchTopic").submit();
}

function frmsubmit()
{
	$("#frmSearchTopic").submit();
}
</script>

<?php /*
</br>
<!--when user login at that time it display-->
<?php if($sf_user->getAttribute('user_user_id') != ''): ?>
<a onclick="addForumsTopic('<?php echo $forumsId; ?>');" href="javascript:void(0);">addTopic</a>
<?php endif; ?>

<?php if($pager->getnbResults() > 0): ?>
<?php
$varExtra ="";
if($forumsId != "") $varExtra .="&forumsId=$forumsId"; ?>

<b><?php echo "Forums Title: ".$forumsTitle ?></b>
<table border="1">
<tr>
<td>Topic/Question</td>
<td><?php include_partial('default/ordering',array('title'=>'Topic Posted Date','ordering'=>true,"siteURL"=>'forums/topicList','alias'=>'CreateDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
<td><?php include_partial('default/ordering',array('title'=>'Total Replies','ordering'=>true,"siteURL"=>'forums/topicList','alias'=>'TotalReplies','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
<td><?php include_partial('default/ordering',array('title'=>'Most Views','ordering'=>true,"siteURL"=>'forums/topicList','alias'=>'TotalViews','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
<td><?php include_partial('default/ordering',array('title'=>'Last Reply Posted user','ordering'=>true,"siteURL"=>'forums/topicList','alias'=>'LastRepliedDateTime','orderBy'=>$orderBy,'orderType'=>$orderType, 'extra_vars'=>$varExtra));?></td>
<td>Last reply date time</td>
</tr>
<?php	foreach($pager as $forumsTopic):	?>
<tr>
<td><?php echo link_to($forumsTopic->getTopic(),"forums/replyList?topicId=".$forumsTopic->getId().'&forumsId='.$forumsId); ?></td>
<td><?php echo date(sfConfig::get('app_dateformat'),strtotime($forumsTopic->getCreateDateTime())); ?></td>
<td><?php echo $forumsTopic->getTotalReplies(); ?></td>
<td><?php echo $forumsTopic->getTotalViews(); ?></td>
<?php $userData = Doctrine::getTable('Users')->find(array($forumsTopic->getLastRepliedBy())); ?>
<td><?php
if($userData == "")
echo "---";
else
echo $userData->getFirstName().' '.$userData->getLastName();
?></td>
<td><?php echo date(sfConfig::get('app_dateformat'),strtotime($forumsTopic->getLastRepliedDateTime())); ?></td>
</tr>
<?php endforeach; ?>
</table>

<?php
$varExtra = "";
if($orderBy) $varExtra .="&orderBy=$orderBy";
if($orderType) $varExtra .="&orderType=$orderType";
if($forumsId != "") $varExtra .="&forumsId=$forumsId";
?>
<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'forums/topicList', 'varExtra' => $varExtra));?>
<?php else: ?>
</br></br>
<table border="1">
<tr>
<td>NO RECORD FOUND </td>
</tr>
</table>
<?php endif; ?>

*/?>