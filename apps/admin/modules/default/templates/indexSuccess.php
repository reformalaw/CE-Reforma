<!-- Bread Crumb Start -->

<table cellspacing="0" cellpadding="0" class="AdminNavBar" style="height:30px;">
    <tr>
        <td class="AdminBreadCrumb"></td>
        <td class="AdminToolBar" nowrap="nowrap"></td>
    </tr>
</table>
<!-- Bread Crumb End -->
<?php include_partial('default/message'); ?>
<?php if($sf_user->isAuthenticated() && ($sf_user->hasCredential('admin')) || $sf_user->hasCredential('staff')): ?>

<!-- Admin Control Panel Start -->
<table width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td class="ContentPad">
        	<div class="leftIcon">
        	   <h2 align="center">Welcome to Counsel Edge Admin Panel !!</h2>
            	<ul>
                	<!--<li>
                    	<a href="<?php echo url_for('administrators/index');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/staffManager.png",array("alt"=>"Staff Manager","title"=>"Staff Manager"))?></div>
                            <div class="name">Staff Manager</div>
                        </a>
                    </li> -->
                    <li>
                    	<a href="<?php echo url_for('users/index');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/userManager.png",array("alt"=>"User Manager","title"=>"User Manager"))?></div>
                            <div class="name">User Manager</div>
                        </a>
                    </li>
                   <!-- <li>
                    	<a href="<?php echo url_for('roles/index');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/rollPermission.png",array("alt"=>"Roles & Permission","title"=>"Roles & Permission"))?></div>
                            <div class="name">Roles &amp; Permission</div>
                        </a>
                    </li> -->
                    <li>
                    	<a href="<?php echo url_for('case/index');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/casesManager.png",array("alt"=>"Cases Manager","title"=>"Cases Manager"))?></div>
                            <div class="name">Cases Manager</div>
                        </a>
                    </li>
                    <li>
                    	<a href="<?php echo url_for('activity/index');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/activityLogging.png",array("alt"=>"Activity Logging","title"=>"Activity Logging"))?></div>
                            <div class="name">Activity Logging</div>
                        </a>
                    </li>
                    <li>
                    	<a href="<?php echo url_for('staticpages/index');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/counseledgePages.png",array("alt"=>"Counceledge Pages","title"=>"Counsel Edge Pages"))?></div>
                            <div class="name">Counsel Edge Pages</div>
                        </a>
                    </li>
                    <li>
                    	<a href="<?php echo url_for('staticpages/lgList');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/legalgripPages.png",array("alt"=>"Legalgrip Pages","title"=>"Legalgrip Pages"))?></div>
                            <div class="name">Legalgrip Pages</div>
                        </a>
                    </li>            
                    <li>
                    	<a href="<?php echo url_for('faq/index');?>">

                            <div class="img"><?php echo image_tag("admin/controlpanel/globalManager.png",array("alt"=>"Global FAQ Manager","title"=>"Global FAQ Manager"))?></div>
                            <div class="name">Global FAQ Manager</div>
                        </a>
                    </li>
                    <li>
                    	<a href="<?php echo url_for('media/index');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/stockphotoManager.png",array("alt"=>"Stock Photo Manager","title"=>"Stock Photo Manager"))?></div>
                            <div class="name">Stock Photo Manager</div>
                        </a>
                    </li>
                    <li>
                    	<a href="<?php echo url_for('userswebsite/index');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/websiteManager.png",array("alt"=>"Website Manager","title"=>"Website Manager"))?></div>
                            <div class="name">Website Manager</div>
                        </a>
                    </li>
                    <li>
                    	<a href="<?php echo url_for('Forums/forumsList');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/forumTopic.png",array("alt"=>"Forum Topic","title"=>"Forum Topic"))?></div>
                            <div class="name">Forum Topic</div>
                        </a>
                    </li>
                    <li>
                    	<a href="<?php echo url_for('forumreplay/index');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/forumReply.png",array("alt"=>"Forum Reply","title"=>"Forum Reply"))?></div>
                            <div class="name">Forum Reply</div>
                        </a>
                    </li>
                    <li>
                    	<a href="<?php echo url_for('statistics/index');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/statisctics.png",array("alt"=>"Statistics","title"=>"Statistics"))?></div>
                            <div class="name">Statistics</div>
                        </a>
                    </li>
                    <li>
                    	<a href="<?php echo url_for('siteconfig/index');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/siteConfig.png",array("alt"=>"Site Config","title"=>"Site Config"))?></div>
                            <div class="name">Site Config</div>
                        </a>
                    </li>
                    <li>
                    	<a href="<?php echo url_for('administrators/myprofile'); ?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/manageProfile.png",array("alt"=>"Manage Profile","title"=>"Manage Profile"))?></div>
                            <div class="name">Manage Profile</div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="leftIcon customerIcon">
            	<h2>Manage Accounting</h2>
            	<ul>
                	<li>
                    	<a href="<?php echo url_for('accounting/customerPayReport');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/customerPaymentHistory.png",array("alt"=>"Customer Payment History","title"=>"Customer Payment History"))?></div>
                            <div class="name">Customer Payment History</div>
                        </a>
                    </li>
                    <li>
                    	<a href="<?php echo url_for('accounting/thirdpartyPayReport');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/paymentHistory.png",array("alt"=>"3rd Party Payment History","title"=>"3rd Party Payment History"))?></div>
                            <div class="name">3rd Party Payment History</div>
                        </a>
                    </li>
                    <li>
                    	<a href="<?php echo url_for('globalreport/finance');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/finaceReport.png",array("alt"=>"Finace Report","title"=>"Finance Report"))?></div>
                            <div class="name">Finance Report</div>
                        </a>
                    </li>
                </ul>
            </div>
        </td>
    </tr>
</table>
<!-- Control Panel End -->
<?php elseif($sf_user->isAuthenticated() && $sf_user->hasCredential('customer')): ?>
<!-- Customer Control Panel Start -->
<table width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td class="ContentPad">
        	<div class="leftIcon">
        	   <h2 align="center">Welcome to Counsel Edge Admin Panel !!</h2>
            	<ul>
            	
                    <li>
                    	<a href="<?php echo url_for('administrators/myprofile'); ?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/manageProfile.png",array("alt"=>"Manage Profile","title"=>"Manage Profile"))?></div>
                            <div class="name">Manage Profile</div>
                        </a>
                    </li>
            	
                    <?php if($sf_user->getAttribute('billingSucscription') == "Yes"): ?>
                	<li>
                    	<a href="<?php echo url_for('customercase/index');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/casesManager.png",array("alt"=>"Cases Manager","title"=>"Cases Manager"))?></div>
                            <div class="name">Cases Manager</div>
                        </a>
                    </li>
                    <!--<li>
                    	<a href="<?php //echo url_for('customeractivity/index');?>">
                            <div class="img"><?php //echo image_tag("admin/controlpanel/activityLogging.png",array("alt"=>"Activity Logging","title"=>"Activity Logging"))?></div>
                            <div class="name">Activity Logging</div>
                        </a>
                    </li>-->
                    <?php endif; ?>
                    <?php if($sf_user->getAttribute('WebsiteSubscriotion') == 'Yes'): ?>

                    <?php /* ?>
                    <li>
                    	<a href="<?php echo url_for('usertheme/index'); ?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/manageThemes.png",array("alt"=>"Manage Themes","title"=>"Manage Themes"))?></div>
                            <div class="name">Manage Themes</div>
                        </a>
                    </li>
                    <?php */ ?>
                    
					<?php /* ?>
                    <li>
                    	<a href="<?php echo url_for('websitemenu/index'); ?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/manageMenu.png",array("alt"=>"Manage Menu","title"=>"Manage Menu"))?></div>
                            <div class="name">Manage Menu</div>
                        </a>
                    </li>
                    <?php */ ?>

					<?php /* ?>
                    <li>
                    	<a href="<?php echo url_for('themebanner/index'); ?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/manageBanner.png",array("alt"=>"Manage Banner","title"=>"Manage Banner"))?></div>
                            <div class="name">Manage Banner</div>
                        </a>
                    </li>
                    <?php */ ?>

                    <?php /* ?>
                    <li>
                    	<a href="<?php echo url_for('contactus/index'); ?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/manageContact.png",array("alt"=>"Manage Contact Page","title"=>"Manage Contact Page"))?></div>
                            <div class="name">Manage Contact Page</div>
                        </a>
                    </li>
                    <?php */ ?>

                    <li>
                    	<a href="<?php echo url_for('usertheme/index'); ?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/manageWebsiteContent.png",array("alt"=>"Manage Website Content","title"=>"Manage Website Content"))?></div>
                            <div class="name">Manage Website Content</div>
                        </a>
                    </li>
                    <?php endif; ?>
					
                    <?php if($sf_user->getAttribute('NetworkProfileSubscription')== 'Yes'): ?>
						<li>
							<a href="<?php echo url_for('administrators/networkprofile'); ?>">
								<div class="img"><?php echo image_tag("admin/controlpanel/network-profile.png",array("alt"=>"Manage Network Profile","title"=>"Manage Network Profile"))?></div>
								<div class="name">Manage Network Profile</div>
							</a>
						</li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php if($sf_user->getAttribute('billingSucscription') == 'Yes'): ?>
            <div class="leftIcon customerIcon">
            	<h2>Manage Accounting</h2>
            	<ul>
                
                	<li>
                    	<a href="<?php echo url_for('customerreport/paymentReport');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/paymentReport.png",array("alt"=>"Payment Report","title"=>"Payment Report"))?></div>
                            <div class="name">Payment Report</div>
                        </a>
                    </li>
                    
                    <?php /* ?>
                    <li>
                    	<a href="<?php echo url_for('customerreport/underPaymentReport');?>">
                            <div class="img"><?php echo image_tag("admin/controlpanel/underpayReport.png",array("alt"=>"Underpay Report","title"=>"UnderPay Report"))?></div>
                            <div class="name">UnderPay Report</div>
                        </a>
                    </li>
                    <?php */ ?>
                </ul>
            </div>
            <?php endif; ?>
        </td>
    </tr>
</table>
<!-- Control Panel End -->
<?php endif; ?>
