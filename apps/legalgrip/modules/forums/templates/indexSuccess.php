<section>
	<div class="middle-inner">
		<div class="page">
			<div class="inner-top-link"></div>
			<div class="forum-list">
				<div class="inner-box-title"> Forums & Categories </div>
					</br>
					<div class="forum-search">
						<form id="frmSearchTopic" action="<?php echo url_for('forums/index') ?>"  method="post" enctype="multipart/form-data">
						
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<label class="fontLabel">Search Forum:</label>
							<?php //echo $form["searchforum"]->renderLabel();?>
							<?php $form->setDefault("searchforum",$searchBy); ?>
							<?php echo $form["searchforum"]->render();?>
							<?php echo tag('input', array('name' => 'search_btn', 'type' => 'submit', 'id' => 'submit', 'class' => 'CommonButton', 'value' => 'Search')); ?>
							<?php echo link_to("Clear","forums/index", array('class'=>"linkClass")); ?>
						</form>
					</div>
					
					<?php if($pager->getnbResults() > 0): ?>
						<?php	foreach($pager as $forumsCategories):	?>
							<div class="forum-topic-list">
								<ul>
										<li class="head"><div class="first"> <?php echo $forumsCategories->getTitle(); ?> </div><div class="second">No. of Topics</div><div class="third">No. of Total Replies</div></li>
									<?php foreach($forumsCategories["ForumCategoriesForums"] as $forums): ?>
										<li class="row">
											<div class="first">
												<?php echo image_tag('legalgrip/forum-topiclist-icon.png'); ?>
												<?php echo link_to($forums->getTitle(), "forums/topicList?forumsId=".$forums->getId()); ?>
											</div>
											<div class="second">
												<?php echo $forums->getTotalTopic(); ?>
											</div>
											<div class="third">
												<?php echo $forums->getTotalReplies(); ?>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endforeach; ?>
						<div class="forum-topiclist-paging">
							<?php
								$varExtra = "";
								if($orderBy) $varExtra .="&orderBy=$orderBy";
								if($orderType) $varExtra .="&orderType=$orderType";
								if($searchBy) $varExtra .="&searchBy=$searchBy";
							?>
							<?php include_partial("default/pagging",array('pager' => $pager, '','strUrl' => 'forums/index', 'varExtra' => $varExtra));?>
						</div>
					<?php else: ?>
						<div class="forum-topic-list">No Forums & Categories Found</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
</section>