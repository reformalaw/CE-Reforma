<section>
	<div class="middle-inner">
		<div class="page">
			<div class="inner-top-link"></div>
			<div class="forum-list">
					<div class="inner-box-title"><?php echo link_to($objectForums->getTitle(),'forums/topicList?forumsId='.$objectForums->getId()); ?></div>
					<div class="topiclist-heading">
						<div class="topiclist-img">
							<?php
								$userObject = Doctrine::getTable('Users')->find(array($objectForumsTopic->getUserId()));
								$userProfile = clsCommon::userProfileImage($objectForumsTopic->getUserId(),"thumb");
								#$userProfilePath = $ssSiteUrl.DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR.$userProfile["path"];
								$userProfilePath = $userProfile["path"];
								echo image_tag($userProfilePath,array('title'=>$userProfile['title']));
							?>
						</div>
						<div class="topiclist-detail">
                        	<h3><?php echo ucwords($userObject->getFirstName().' '.$userObject->getLastName()); ?></h3>
                            <p class="topicname">
							<span>
								<?php echo $forumsTopic; ?>
							</span>

							<strong>
								
								<?php if(in_array($objectForumsTopic->getTotalReplies(), array(0,1))) { ?>
								    ( <?php echo $objectForumsTopic->getTotalReplies(); ?> reply to this topic)    
								<?php } else { ?>
								    ( <?php echo $objectForumsTopic->getTotalReplies(); ?> replies to this topic)    
                                <?php } ?>								    

							</strong>
                            </p>
							<!--Start Topic Discription-->
							<p class="desc">
							<?php echo nl2br($objectForumsTopic->getDescription()); ?>
							</p>
							<!-- End Topic Discription -->
							<p class="date-time">
								<?php echo date(sfConfig::get('app_dateformat'),strtotime($objectForumsTopic->getCreateDateTime())); ?>
							</p>

							<?php if($sf_user->getAttribute('user_user_id') != ''): ?>
								<a onclick="addForumsReply('<?php echo $forumsId; ?>','<?php echo $topicId; ?>');" href="javascript:void(0);"><?php echo image_tag('legalgrip/post-reply-btn.png'); ?></a>
							<?php endif; ?>

						</div>
					</div>
			<?php if($pager->getnbResults() > 0): ?>
				<?php foreach($pager as $forumsReplay): ?>
					<div class="topicreply-listing">
						<ul>
							<li class="head"><?php echo ucwords($forumsReplay["ForumReplyUsers"]->getFirstName().' '.$forumsReplay["ForumReplyUsers"]->getLastName());?></li>
							<li class="details">
								<div class="replyimage">
									<?php
										$userProfile = clsCommon::userProfileImage($forumsReplay->getUserId(),"small");
										#$userProfilePath = $ssSiteUrl.DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR.$userProfile["path"];
										$userProfilePath = $userProfile["path"];
										echo image_tag($userProfilePath,array('title'=>$userProfile['title']));
									?>
								</div>
								<div class="replydetails">
									<p class="posted">Posted <?php echo date(sfConfig::get('app_dateformat'),strtotime($forumsReplay->getUpdateDateTime())); ?>
										<!--|<span>
											<?php //echo $forumsReplay["ForumReplyUsers"]->getCity() ?>
										</span>-->
									</p>
									<?php echo nl2br($forumsReplay->getReply())?>
								</div>
							</li>
						</ul>
					</div>
				<?php endforeach; ?>
			<?php else: ?> 
					<div class="topicreply-listing">No Reply Found!</div>
			<?php endif;?>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
function addForumsReply(forumsId,topicId) {

			$.fancybox.open({
				href : "<?php echo url_for('forums/newReply?forumsId=')?>"+forumsId+"/topicId/"+topicId,
				type : 'iframe',
				padding : 5,
				minHeight: 430,
        		minWidth: 400
			});

	}
</script>


<?php /*
</br>
<?php if($sf_user->getAttribute('user_user_id') != ''): ?>
	<a onclick="addForumsReply('<?php echo $forumsId; ?>','<?php echo $topicId; ?>');" href="javascript:void(0);">addReplay</a>
<?php endif; ?>


<?php if($pager->getnbResults() > 0): ?>

</br><b><?php echo "Forums Topic: ".$forumsTopic; ?></b>
<table border=1>
		<tr>
			<td>Replied Person Image</td>
			<td>Replied Person Name</td>
			<td>Date Replied Posted</td>
			<td>Actual Reply</td>
		</tr>
<?php foreach($pager as $forumsReplay): ?>
		<tr>
			<td valign="top">
				<?php
					$userProfile = clsCommon::userProfileImage($forumsReplay->getUserId(),"medium");
					$userProfilePath = $ssSiteUrl.DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR.$userProfile["path"];
					echo image_tag($userProfilePath,array('title'=>$userProfile['title']));
				?>
			</td>
			<td valign="top">
				<?php echo $forumsReplay["ForumReplyUsers"]->getFirstName().' '.$forumsReplay["ForumReplyUsers"]->getLastName()?>
			</td>
			<td>
				<?php echo date(sfConfig::get('app_dateformat'),strtotime($forumsReplay->getUpdateDateTime())); ?>
			</td>
			<td valign="top">
				<?php echo nl2br($forumsReplay->getReply())?>
			</td>
		</tr>
<?php endforeach; ?>
</table>

<?php
	$varExtra = "";
	if($orderBy) $varExtra .="&orderBy=$orderBy";
	if($orderType) $varExtra .="&orderType=$orderType";
	if($topicId != "") $varExtra .="&topicId=$topicId";
?>
<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'forums/replyList', 'varExtra' => $varExtra));?>
<?php else: ?> 
	</br></br>
	<table border="1">
		<tr>
			<td>NO RECORD FOUND </td>
		</tr>
	</table>
<?php endif; ?>
*/ ?>