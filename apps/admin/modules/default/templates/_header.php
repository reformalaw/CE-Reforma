<table cellspacing="0" cellpadding="0" class="AdminMainTable">
  <tr>
    <td class="LogoBar"><?php
    if($sf_user->hasAttribute('admin_firstname') && $sf_user->isAuthenticated() && $sf_user->hasCredential('admin')){
	  	?>
      <div style="float:right; margin:10px 5px;"><strong>Welcome</strong> <?php echo ucfirst($sf_user->getAttribute('admin_firstname')); ?>!!&nbsp;&nbsp;<strong>Last Login : </strong><?php echo sfContext::getInstance()->getUser()->getAttribute('last_login'); ?></div>
      <?php
  	}else if($sf_user->hasAttribute('admin_firstname') && $sf_user->isAuthenticated() && $sf_user->hasCredential('customer')){
  	    ?>
		<div style="float:right; margin:10px 5px;">
			<strong>Welcome</strong> <?php echo ucwords($sf_user->getAttribute('admin_firstname')." ".$sf_user->getAttribute('admin_lastname')); ?>!!&nbsp;&nbsp; <?php /* if (sfContext::getInstance()->getUser()->getAttribute('last_login') != ""){ ?><strong>Last Login : </strong><?php echo sfContext::getInstance()->getUser()->getAttribute('last_login'); ?><?php } */?>
			
			<?php if($sf_user->hasCredential('customer') && $sf_user->getAttribute('WebsiteSubscriotion')== 'Yes' ){ ?>
			 <br>
			 <br>
			 <span><strong> Personal Website URL:&nbsp; </strong><a href="http://<?php echo $sf_user->getAttribute("websiteUrl"); ?>" title="Click here to view Website" target="_blank"><?php echo $sf_user->getAttribute("websiteUrl"); ?></a></span>
			<?php } ?>
			
		</div>
      <?php
  	}else if($sf_user->hasAttribute('admin_firstname') && $sf_user->isAuthenticated() && $sf_user->hasCredential('staff')){
  	    ?>
      <div style="float:right; margin:10px 5px;"><strong>Welcome</strong> <?php echo ucwords($sf_user->getAttribute('admin_firstname')." ".$sf_user->getAttribute('admin_lastname')); ?>!!&nbsp;&nbsp;<?php if (sfContext::getInstance()->getUser()->getAttribute('last_login') != ""){ ?><strong>Last Login : </strong><?php echo sfContext::getInstance()->getUser()->getAttribute('last_login'); ?><?php } ?></div>
      <?php
  	} ?>
      <table cellspacing="0" cellpadding="0">
        <tr>
          <td class="pad1"><div class="dvHeader">
              <h1 class="logo"><a title="Counsel Edge" href="<?php echo url_for("default/index")?>">Counsel Edge</a></h1>
            </div>
            <!--<a href="< ?php echo url_for("default/index")?>" title="Luckzy">< ?php echo image_tag('admin/logo.gif', array('alt'=>'Luckzy', 'border'=>0, 'title'=>'Luckzy'))?></a></a>-->
          </td>
        </tr>
      </table>
      <!-- Top Bar End -->
    </td>
  </tr>
  <?php //if ($sf_user->isAuthenticated() && $sf_user->hasCredential('admin')):?>
  <?php if ($sf_user->isAuthenticated() && $sf_user->hasCredential('admin') ):?>
  <tr>
    <td><!-- Menu Start -->
      <table width="100%" cellspacing="0" cellpadding="0" class="menubar">
        <tr>
          <td class="menubackgr" style="padding:0 0 0 10px;"><div id="myMenuID"></div>
            <script type="text/javascript">
            var myMenu =
            [
            [null,'Home','<?php echo url_for("default/index")?>',null,'Home'],
            _cmSplit,
            [null,'Staff Admins','<?php echo url_for("administrators/index")?>',null,'',
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Add Staff Admnin','<?php echo url_for("administrators/new")?>',null,'Add Staff'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','List Staff Admins','<?php echo url_for("administrators/index")?>',null,'List Staff'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Roles & Permission','<?php echo url_for("roles/index")?>',null,'Manage Roles'],
            
            ],
            
            _cmSplit,
            [null,'Manage Users/Customers','<?php echo url_for("users/index")?>',null,'',
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Add Customers','<?php echo url_for("users/new")?>',null,'Add Customers'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','List Customers','<?php echo url_for("users/index")?>',null,'List Customers'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','List Users','<?php echo url_for("manageuser/index")?>',null,'List Users'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Review Rating','<?php echo url_for("manageuser/adminReview")?>',null,'Review Rating'],
            ],
            
            _cmSplit,
            [null,'Manage Masters','<?php echo url_for("practiceareas/index")?>',null,'',

            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Practice Area','<?php echo url_for("practiceareas/index")?>',null,'Manage Practice Area'],
           /* ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Configurations','<?php echo url_for("default/ComingSoon")?>',null,'Manage Configurations'],*/
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','CMS Pages','<?php echo url_for("staticpages/index")?>',null,'CMS Pages'],
//             ['<?php //echo image_tag("admin/menuimages/config.png")?>','Manage CE Pages','<?php //echo url_for("staticpages/index")?>',null,'Manage CE Pages'],
//             ['<?php //echo image_tag("admin/menuimages/config.png")?>','Manage LG Pages','<?php //echo url_for("staticpages/lgList")?>',null,'Manage LG Pages'],
            /*['<?php //echo image_tag("admin/menuimages/config.png")?>','Manage Personal Site Pages','<?php //echo url_for("personalcms/index")?>',null,'Manage Personal Site Pages'],*/
//             ],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage 3rd Parties','<?php echo url_for("thirdparty/index")?>',null,'3rd Parties List'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Stock Photo','<?php echo url_for("media/index")?>',null,'Manage Stock Photo'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Website','<?php echo url_for("userswebsite/index")?>',null,'Manage Website'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Themes','<?php echo url_for("theme/index")?>',null,'Manage Theme List'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Testimonial','<?php echo url_for("testimonial/index")?>',null,'Manage Testimonial List'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage State','<?php echo url_for("state/index")?>',null,'Manage State'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Counties','<?php echo url_for("counties/index")?>',null,'Manage Counties'],
            ],
            
            _cmSplit,
            [null,'Billing Service','<?php echo url_for("case/index")?>',null,'',
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Cases','<?php echo url_for("case/index")?>',null,'Add Cases'],
            [null,'Manage Accounting',null,null,'',
            
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Customer Payment History','<?php echo url_for("accounting/customerPayReport")?>',null,'View Customer Payment History'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','3rd Party Payment History','<?php echo url_for("accounting/thirdpartyPayReport")?>',null,'View 3rd Party Payment History'],
                        

            /*[null,'Customer Payment',null,null,'',
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Log Payment','<?php echo url_for("accounting/logPayment")?>',null,'Log Payment'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','View Payment History','<?php echo url_for("accounting/customerPayReport")?>',null,'View Payment History'],
            ],

            [null,'3rd Party Payment Received',null,null,'',
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Log Received','<?php echo url_for("accounting/logReceived")?>',null,'Log Received'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','View Payment History','<?php echo url_for("accounting/thirdpartyPayReport")?>',null,'View Payment History'],
            ],*/

            [null,'Global Report',null,null,'',
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Unpaid Customer Report','<?php echo url_for("globalreport/unpaidCustomer")?>',null,'Unpaid Customer'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Unpaid 3rd Party Report','<?php echo url_for("globalreport/unpaidThirdparty")?>',null,'Unpaid 3rd Party'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Finance Report','<?php echo url_for("globalreport/finance")?>',null,'Finance Report']
            ],

            ],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Activity Logging','<?php echo url_for("activity/index")?>',null,'Activity Logging'],

            ],
            
            
            _cmSplit,
            [null,'FAQs','<?php echo url_for("faq/index")?>',null,'',
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Global FAQs','<?php echo url_for("faq/index")?>',null,'Manage Global FAQs'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage CE FAQs','<?php echo url_for("faq/counceledgeList")?>',null,'Manage CE FAQs'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage LG FAQs','<?php echo url_for("faq/leagaltripList")?>',null,'Manage LG FAQs'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Personal Website FAQs','<?php echo url_for("personalWebsiteFAQs/index")?>',null,'Manage Personal Website FAQs'],
            ],
            
            _cmSplit,
            [null,'Forums','<?php echo url_for("Forums/index")?>',null,'Forums',
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Categories','<?php echo url_for("Forums/index")?>',null,'Manage Forums Categories'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Forums','<?php echo url_for("Forums/forumsList")?>',null,'Manage Forums'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Topic','<?php echo url_for("Forums/topicList")?>',null,'Manage Topic'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Reply','<?php echo url_for("forumreplay/index")?>',null,'Manage Reply'],
            ],
            
            _cmSplit,
            [null,'Statistics','<?php echo url_for("statistics/index")?>',null,'Statistics'],
            
            
            _cmSplit,
            [null,'Site Config','<?php echo url_for("siteconfig/index")?>',null,'Site Config'],

            //['<?php //echo image_tag("admin/menuimages/config.png")?>','Site Config','<?php //echo url_for("siteconfig/index")?>',null,'Site Config'],
            //['<?php //echo image_tag("admin/menuimages/config.png")?>','CMS','<?php //echo url_for("cmspages/index")?>',null,'CMS'],
            //],
            
            _cmSplit,
            [null,'Manage Profile','<?php echo url_for("administrators/myprofile") ?>',null,'Manage Profile',
				//['<?php //echo image_tag("admin/menuimages/config.png")?>','Edit Profile','<?php //echo url_for("administrators/myprofile")?>',null,'Edit Profile'],
				//['<?php //echo image_tag("admin/menuimages/config.png")?>','Edit Email','<?php //echo url_for("administrators/changeEmail")?>',null,'Edit Email'],
            ],
            
            _cmSplit,
            ];
            cmDraw ('myMenuID', myMenu, 'hbr', cmThemeOffice, 'ThemeOffice');
     </script>
          </td>
          <td class="logoutmenu" align="right"><b><?php echo link_to('Logout','auth/logout'); ?></b></td>
        </tr>
      </table>
      <!-- Menu End -->
    </td>
  </tr>
  <?php elseif ($sf_user->isAuthenticated() && $sf_user->hasCredential('staff') ):?>
  <tr>
    <td><!-- Menu Start -->
      <table width="100%" cellspacing="0" cellpadding="0" class="menubar">
        <tr>
          <td class="menubackgr" style="padding:0 0 0 10px;"><div id="myMenuID"></div>
            <script type="text/javascript">
            var myMenu =
            [
            [null,'Home','<?php echo url_for("default/index")?>',null,'Home'],
            _cmSplit,
            /*[null,'Roles & Permission',null,null,'',
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Roles','<?php echo url_for("default/ComingSoon")?>',null,'Manage Roles'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Permissions','<?php echo url_for("default/ComingSoon")?>',null,'Manage Permissions'],
            ],*/
            _cmSplit,
            [null,'Manage Users/Customers','<?php echo url_for("users/index")?>',null,'',
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Add Customers','<?php echo url_for("users/new")?>',null,'Add Users/Customers'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','List Customers','<?php echo url_for("users/index")?>',null,'List Users/Customers'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','List Users','<?php echo url_for("manageuser/index")?>',null,'List Users'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Review Rating','<?php echo url_for("manageuser/adminReview")?>',null,'Review Rating'],
            ],
            _cmSplit,
            [null,'Manage Masters','<?php echo url_for("practiceareas/index")?>',null,'',

            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Practice Area','<?php echo url_for("practiceareas/index")?>',null,'Manage Practice Area'],
            /*['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Configurations','<?php echo url_for("default/ComingSoon")?>',null,'Manage Configurations'],*/
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','CMS Pages','<?php echo url_for("staticpages/index")?>',null,'CMS Pages'],
//             ['<?php //echo image_tag("admin/menuimages/config.png")?>','Manage CE Pages','<?php //echo url_for("staticpages/index")?>',null,'Manage CE Pages'],
//             ['<?php //echo image_tag("admin/menuimages/config.png")?>','Manage LG Pages','<?php //echo url_for("staticpages/lgList")?>',null,'Manage LG Pages'],
            /*['<?php //echo image_tag("admin/menuimages/config.png")?>','Manage Personal Site Pages','<?php //echo url_for("personalcms/index")?>',null,'Manage Personal Site Pages'],*/
//             ],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage 3rd Parties','<?php echo url_for("thirdparty/index")?>',null,'3rd Parties List'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Stock Photo','<?php echo url_for("media/index")?>',null,'Manage Stock Photo'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Website','<?php echo url_for("userswebsite/index")?>',null,'Manage Website'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Themes','<?php echo url_for("theme/index")?>',null,'Manage Theme'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Testimonial','<?php echo url_for("testimonial/index")?>',null,'Manage Testimonial List'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage State','<?php echo url_for("state/index")?>',null,'Manage State'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Counties','<?php echo url_for("counties/index")?>',null,'Manage Counties'],
            ],
            
            
            _cmSplit,
            [null,'Billing Service','<?php echo url_for("case/index")?>',null,'',
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Cases','<?php echo url_for("case/index")?>',null,'Add Cases'],
            [null,'Manage Accounting',null,null,'',

            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Customer Payment History','<?php echo url_for("accounting/customerPayReport")?>',null,'View Customer Payment History'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','3rd Party Payment History','<?php echo url_for("accounting/thirdpartyPayReport")?>',null,'View 3rd Party Payment History'],
            

            /*[null,'Customer Payment',null,null,'',
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Log Payment','<?php echo url_for("accounting/logPayment")?>',null,'Log Payment'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','View Payment History','<?php echo url_for("accounting/customerPayReport")?>',null,'View Payment History'],
            ],

            [null,'3rd Party Payment Received',null,null,'',
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Log Received','<?php echo url_for("accounting/logReceived")?>',null,'Log Received'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','View Payment History','<?php echo url_for("accounting/thirdpartyPayReport")?>',null,'View Payment History'],
            ],*/


            [null,'Global Report',null,null,'',
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Unpaid Customer Report','<?php echo url_for("globalreport/unpaidCustomer")?>',null,'Unpaid Customer'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Unpaid 3rd Party Report','<?php echo url_for("globalreport/unpaidThirdparty")?>',null,'Unpaid 3rd Party'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Finance Report','<?php echo url_for("globalreport/finance")?>',null,'Finance Report']
            ],


            ],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Activity Logging','<?php echo url_for("activity/index")?>',null,'Activity Logging'],
            ],

            _cmSplit,
            [null,'FAQs','<?php echo url_for("faq/index")?>',null,'',
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Global FAQs','<?php echo url_for("faq/index")?>',null,'Manage Global FAQs'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage CE FAQs','<?php echo url_for("faq/counceledgeList")?>',null,'Manage CE FAQs'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage LG FAQs','<?php echo url_for("faq/leagaltripList")?>',null,'Manage LG FAQs'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Personal Website FAQs','<?php echo url_for("personalWebsiteFAQs/index")?>',null,'Manage Personal Website FAQs'],
            ],
            
            
            _cmSplit,
            [null,'Forums','<?php echo url_for("Forums/index")?>',null,'Forums',
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Categories','<?php echo url_for("Forums/index")?>',null,'Manage Forums Categories'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Forums','<?php echo url_for("Forums/forumsList")?>',null,'Manage Forums'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Topic','<?php echo url_for("Forums/topicList")?>',null,'Manage Topic'],
            ['<?php #echo image_tag("admin/menuimages/config.png")?>','Manage Reply','<?php echo url_for("forumreplay/index")?>',null,'Manage Reply'],
            ],
            
            _cmSplit,
            [null,'Statistics','<?php echo url_for("statistics/index")?>',null,'Statistics'],
            
            _cmSplit,
            [null,'Site Config','<?php echo url_for("siteconfig/index")?>',null,'Site Config'],
            //['<?php //echo image_tag("admin/menuimages/config.png")?>','Site Config','<?php //echo url_for("siteconfig/index")?>',null,'Site Config'],
            //],
            
            _cmSplit,
            [null,'Manage Profile','<?php echo url_for("administrators/myprofile") ?>',null,'Manage Profile',
				//['<?php //echo image_tag("admin/menuimages/config.png")?>','Edit Profile','<?php //echo url_for("administrators/myprofile")?>',null,'Edit Profile'],
				//['<?php //echo image_tag("admin/menuimages/config.png")?>','Edit Email','<?php //echo url_for("administrators/changeEmail")?>',null,'Edit Email'],
            ],
            
            _cmSplit,
            ];
            cmDraw ('myMenuID', myMenu, 'hbr', cmThemeOffice, 'ThemeOffice');
     </script>
          </td>
          <td class="logoutmenu" align="right"><b><?php echo link_to('Logout','auth/logout'); ?></b></td>
        </tr>
      </table>
      <!-- Menu End -->
    </td>
  </tr>
  <?php elseif ($sf_user->isAuthenticated() && $sf_user->hasCredential('customer') ):?>
  <tr>
    <td><!-- Menu Start -->
      <table width="100%" cellspacing="0" cellpadding="0" class="menubar">
        <tr>
          <td class="menubackgr" style="padding:0 0 0 10px;"><div id="myMenuID"></div>
            <script type="text/javascript">
            var myMenu =
            [
            [null,'Home','<?php echo url_for("default/index")?>',null,'Home'],
            <?php
                if($sf_user->hasCredential('customer') && $sf_user->getAttribute('billingSucscription') == "Yes" ){?>
                _cmSplit,
                [null,'Billing Service','<?php echo url_for("customercase/index")?>',null,'',
                ['<?php //echo image_tag("admin/menuimages/config.png")?>','Manage Cases','<?php echo url_for("customercase/index")?>',null,'Add Cases'],

                [null,'Manage Accounting',null,null,'',

                [null,'Transcation Report',null,null,'',
                ['<?php //echo image_tag("admin/menuimages/config.png")?>','Payment Report','<?php echo url_for("customerreport/paymentReport")?>',null,'Payment Report'],
                ['<?php //echo image_tag("admin/menuimages/config.png")?>','Under Payment Report','<?php echo url_for("customerreport/underPaymentReport")?>',null,'Under Payment Report'],
                ],

//                 ['<?php //echo image_tag("admin/menuimages/config.png")?>','Activity Logging','<?php //echo url_for("customeractivity/index")?>',null,'Activity Logging'],
                ],

                ],

                <?php } ?>
                
				<?php /*if($sf_user->hasCredential('customer') && $sf_user->getAttribute('NetworkProfileSubscription')== 'Yes' ): ?>
                _cmSplit,
                <!--[null,'Profile','<?php echo url_for("default/ComingSoon")?>',null,'Profile'],-->
                <?php endif; */ ?>
             

				/* if website subscription is yes then and then this all menus  are display */
                <?php if($sf_user->hasCredential('customer') && $sf_user->getAttribute('WebsiteSubscriotion')== 'Yes' ): ?>
                _cmSplit,
                
                
                
//                 [null,'Manage Theme',null,null,'',
//                 ['<?php //echo image_tag("admin/menuimages/config.png")?>','Manage Theme','<?php //echo url_for("usertheme/index")?>',null,'FAQs List'],
//                 
// 					<?php //if(sfConfig::get("app_Theme_Yes") == $ssManageColorAndBackground): ?>
// 						['<?php //echo image_tag("admin/menuimages/config.png")?>','Theme Settings','<?php //echo url_for("themeOptions/edit")?>',null,'Theme Setings'],
// 					<?php //endif;?>
                
					/*
						[null,'Manage Menu',null,null,'',
					

					<?php //if(sfConfig::get("app_Theme_Yes") == $ssManageTopMenu): ?>
						['<?php //echo image_tag("admin/menuimages/config.png")?>','Manage Header Menu','<?php //echo url_for("websitemenu/index")?>',null,'Manage Header Menu'],
					<?php //endif   ?>
					<?php //if(sfConfig::get("app_Theme_Yes") == $ssManageFooterMenu): ?>
						['<?php //echo image_tag("admin/menuimages/config.png")?>','Manage Footer Menu','<?php //echo url_for("footermenu/index")?>',null,'Manage Footer Menu'],
					<?php //endif  ?>
					],

					<?php //if(sfConfig::get("app_Theme_Yes") == $ssManageBanner): ?>
						['<?php //echo image_tag("admin/menuimages/config.png")?>','Manage Banner','<?php //echo url_for("themebanner/index")?>',null,'Manage Banner'],
					<?php //endif;?>
	                ['<?php //echo image_tag("admin/menuimages/config.png")?>','Manage Contact US Page','<?php //echo url_for("contactus/index")?>',null,'Manage Contact Page'],					
					*/
//                ],
                
                [null,'Manage Website','<?php echo url_for("usertheme/index")?>',null,'Manage Website',
//                     ['<?php //echo image_tag("admin/menuimages/config.png")?>','Manage CMS Pages','<?php //echo url_for("personalcms/index")?>',null,'CMS Pages'],                
//                     ['<?php //echo image_tag("admin/menuimages/config.png")?>','Manage Practice Area','<?php //echo url_for("WebsitePracticeArea/index")?>',null,'Practice Areas'],
//                     
//                     [null,'FAQs',null,null,'',
//                         ['<?php //echo image_tag("admin/menuimages/config.png")?>','Manage Website FAQs','<?php //echo url_for("faq/personalWebsiteList")?>',null,'Manage FAQs'],
//                         ['<?php //echo image_tag("admin/menuimages/config.png")?>','Global FAQs List','<?php //echo url_for("faq/globalfaqs")?>',null,'Global FAQs'],
//                    ],                    
                    
                
                ],
                <?php endif;?>
                <?php if($sf_user->hasCredential('customer') && $sf_user->getAttribute('NetworkProfileSubscription')== 'Yes' ): ?>
                _cmSplit,
                [null,'Legal Grip','<?php echo url_for("administrators/networkprofile")?>',null,'Legal Grip'],
                <?php endif;  ?>
                _cmSplit,
				[null,'Personal Profile','<?php echo url_for("administrators/myprofile") ?>',null,'Personal Profile',
					//['<?php //echo image_tag("admin/menuimages/config.png")?>','Edit Profile','<?php //echo url_for("administrators/myprofile")?>',null,'Edit Profile'],
					//['<?php //echo image_tag("admin/menuimages/config.png")?>','Edit Email','<?php //echo url_for("administrators/changeEmail")?>',null,'Edit Email'],
				],
                
                
                

                ];
                cmDraw ('myMenuID', myMenu, 'hbr', cmThemeOffice, 'ThemeOffice');
     </script>
          </td>
          <td class="logoutmenu" align="right"><b><?php echo link_to('Logout','auth/logout'); ?></b></td>
        </tr>
      </table>
      <!-- Menu End -->
    </td>
  </tr>
  <?php  endif;?>
  
</table>
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
    window.open(theURL,winName,features);
}
//-->
</script>
