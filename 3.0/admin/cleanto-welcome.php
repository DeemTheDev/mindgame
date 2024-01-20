<?php include(dirname(__FILE__).'/header.php');include(dirname(__FILE__).'/user_session_check.php');include(dirname(dirname(__FILE__)) . "/objects/class_adminprofile.php");$con = new cleanto_db();$conn = $con->connect();$objadminprofile = new cleanto_adminprofile();$objadminprofile->conn = $conn;?>	<div class="container"> 		<div id="cta-cleanto-welcome">			<div class="cta-welcome-main col-md-12 col-sm-12">				<h1> Welcome to Cleanto 3.0</h1>				<div class="ct-into-text">					Thank you for choosing Cleanto! If this is your first time using Cleanto, you will find some helpful "Getting Started" links below. If you just updated the plugin, you can find out what's new in the "What's New" section below. 				</div>				<div class="ct-cleanto-badge">					<img src="<?php echo SITE_URL;?>/assets/images/cleanto-logo-new.png" />				</div>			</div>			<div class="cta-welcome-inner br-2">				<div class=""></div>								<div class="cta-cleato-articles col-md-6 col-lg-6 ">					<div class="panel panel-default h-450 br-2">						<div class="panel-heading bg-info">Getting Started</div>						<div class="panel-body">							<ul class="cta-articles-ul">								<li><a href="https://skymoonlabs.ticksy.com/article/8625/" target="_BLANK">Introduction <i class="fa fa-external-link"></i></li>								<li><a href="https://skymoonlabs.ticksy.com/article/8627/" target="_BLANK">Installation & Basic Configuration Guide <i class="fa fa-external-link"></i></li>								<li><a href="https://skymoonlabs.ticksy.com/article/9030/" target="_BLANK">Update with New Version <i class="fa fa-external-link"></i></li>								<li><a href="https://skymoonlabs.ticksy.com/article/8637/" target="_BLANK">Shortcode or embed code in website <i class="fa fa-external-link"></i></li>								<li><a href="https://skymoonlabs.ticksy.com/article/8636/" target="_BLANK">Scheduling in cleanto <i class="fa fa-external-link"></i></li>								<li><a href="https://skymoonlabs.ticksy.com/article/8632/" target="_BLANK">Services - Add method, units <i class="fa fa-external-link"></i></li>								<li><a href="https://skymoonlabs.ticksy.com/article/8631/" target="_BLANK">Appointments Calender <i class="fa fa-external-link"></i></li>								<a href="https://skymoonlabs.ticksy.com/articles/100005425" class="btn-primary btn btn-circle">Read all articles <i class="fa fa-external-link"></i></a>															</ul>						</div>					</div>				</div>				<div class="cta-cleato-help col-md-6 col-lg-6 ">					<div class="panel panel-default h-450 br-2">						<div class="panel-heading bg-success">Help</div>						<div class="panel-body">							<iframe width="100%" height="315" src="https://www.youtube.com/embed/videoseries?list=PL31cBaqxDRtp-wu7GJ5PaTYmBu4b4vIAz" frameborder="0" allowfullscreen></iframe>						</div>					</div>				</div>				<div class="cta-cleato-changelog col-md-12 col-lg-12 ">					<div class="panel panel-default br-2">						<div class="panel-heading bg-primary">Cleanto Change Log</div>						<div class="panel-body">							<div class="ct-changelog-menu col-md-3 col-sm-4 col-xs-12 col-lg-3 np">								<ul class="nav nav-tab nav-stacked">																		<li class="active"><a href="#version3_0" data-toggle="pill">What's new in 3.0? </a></li>									<li><a href="#version2_8" data-toggle="pill">Version 2.8 </a></li>									<li><a href="#version2_7" data-toggle="pill">Version 2.7 </a></li>									<li><a href="#version2_6" data-toggle="pill">Version 2.6 </a></li>									<li><a href="#version2_5" data-toggle="pill">Version 2.5 </a></li>									<li><a href="#version2_4" data-toggle="pill">Version 2.4 </a></li>									<li><a href="#version2_3" data-toggle="pill">Version 2.3</a></li>									<li><a href="#version2_2" data-toggle="pill">Version 2.2</a></li>									<li><a href="#version2_1" data-toggle="pill">Version 2.1</a></li>									<li><a href="#version2_0" data-toggle="pill">Version 2.0</a></li>									<li><a href="#version1_6" data-toggle="pill">Version 1.6</a></li>									<li><a href="#version1_5" data-toggle="pill">Version 1.5</a></li>									<li><a href="#version1_4" data-toggle="pill">Version 1.4</a></li>									<li><a href="#version1_3" data-toggle="pill">Version 1.3</a></li>									<li><a href="#version1_2" data-toggle="pill">Version 1.2</a></li>									<li><a href="#version1_1" data-toggle="pill">Version 1.1</a></li>									<li><a href="#version1_0" data-toggle="pill">Version 1.0</a></li>								</ul>							</div>							<div class="panel-body">								<div class="cta-changelog-details tab-content col-md-9 col-sm-8 col-lg-9 col-xs-12 container-fluid">								<div class="changelog-details tab-pane active" id="version3_0">									<h4 class="nm">What's new in Version 3.0?</h4>									<ul class="cta-changelog-ul">										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Manual Booking feature</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Auto Update feature</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Manage default view(month/week/day) in appointments calendar</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Manage First Day(Sunday/Monday) in appointments & frontend calendar</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Appointment cancellation reason in appointment cancel by client</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Frontend Right side cart scrollable issue</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Frontend Design issues</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Admin Design issues</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Wrong Book Appointment link in my appointments page</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Responsive issue of recurrence booking dropdowns in frontend booking form</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Frontend language labels issue</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Schedule not save properly issue</li>																			</ul>								</div>								<div class="changelog-details tab-pane" id="version2_8">									<h4 class="nm">Version 2.8</h4>									<ul class="cta-changelog-ul">										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Manageable company title for frontend.</li>										<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Dynamic loader feature</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Staff and admin login conflict issue.</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Email validation in email settings.</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Phone number issue in frontend.</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Staff issue for already booked slot in frontend calendar if there is no staff.</li>									</ul>								</div>								<div class="changelog-details tab-pane" id="version2_7">									<h4 class="nm">Version 2.7</h4>									<ul class="cta-changelog-ul">										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Recurrence with End Date</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>SEO meta tags/GA</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Multi languages with country flag listing in front booking page</li>										<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Labels section design in settings</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Scroll issue in iframe</li>									</ul>								</div>								<div class="changelog-details tab-pane" id="version2_6">									<h4 class="nm">Version 2.6</h4>									<ul class="cta-changelog-ul">										<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>front and admin design</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Save blank image when no crop</li>									</ul>								</div>								<div class="changelog-details tab-pane" id="version2_5">									<h4 class="nm">Version 2.5</h4>									<ul class="cta-changelog-ul">										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Booking form page title manageable</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Section to manage admin email</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>PHP mailer latest version</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Remove item from cart</li>										<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Admin password security/complexity</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Font family include issue for SSL enabled sites</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Booking form background image update issue</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Sample data: booking not showing in Appointments calendar</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Language Label issue</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Add staff not working in strict mode issue</li>									</ul>								</div>								<div class="changelog-details tab-pane" id="version2_4">									<h4 class="nm">Version 2.4</h4>									<ul class="cta-changelog-ul">										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Separate staff dashboard section to manage bookings, schedule, payments and profile for staff</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Option to choose staff on booking form option</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Recurrence booking (daily, weekly, biweekly, monthly) feature</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Option to manage gif loader</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Option to reset colours to default settings</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Popover issue in delete services</li>									</ul>								</div>								<div class="changelog-details tab-pane" id="version2_3">									<h4 class="nm">Version 2.3</h4>									<ul class="cta-changelog-ul">										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Strict mode issue</li>									</ul>									</div>								<div class="changelog-details tab-pane" id="version2_2">									<h4 class="nm">Version 2.2</h4>									<ul class="cta-changelog-ul">										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Appointment details fields show/hide.</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Gmail SMTP settings issue.</li>										<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Edit email templates functionality.</li>										<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Language dropdown on booking page.</li>										<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Installer path settings.</li>									</ul>									</div>								<div class="changelog-details tab-pane" id="version2_1">									<h4 class="nm">Version 2.1</h4>									<ul class="cta-changelog-ul">										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Label issue fixed.</li>										<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Improved startup configuration</li>									</ul>									</div>								<div class="changelog-details tab-pane" id="version2_0">										<h4 class="nm">Version 2.0</h4>										<ul class="cta-changelog-ul">											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Add new staff in business</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Add ablity to change the google fonts for front booking</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Allow making all methods,units,addons sortable for front booking form</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Language selection dropdown in front booking</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Made all form fields manageable for front booking</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Assign an appointment to staff</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Check the payment details of the staff</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Make first postal code get displayed in placeholder in front booking</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Allow admin to add favicon for site</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Added bouncing effect for selected date and time in front calendar </li>											<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Improved display of emails</li>											<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Improved database structure of users table</li>										</ul>										</div>									<div class="changelog-details tab-pane" id="version1_6">										<h4 class="nm">Version 1.6</h4>										<ul class="cta-changelog-ul">										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Payment gateway PayUmoney</li>																				<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Textlocal SMS Gateway</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Payment method bank transfer</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Service description dynamic manage from admin</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>How we will get in dynamic manage from admin</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Phone number country display manage from admin</li>										<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>New Labels added</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Bugs Fixed</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Booking notification design issue fixed</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>iframe full height not scroll issue fixed</li>										<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Internet Explorer 11  browser design fixed.</li>										<li><span class="ct-fixed bg-info br-3 b-shadow">Fixed</span>Email sending if auto confirm is enable with subject confirm</li>										<li><span class="ct-fixed bg-info br-3 b-shadow">Fixed</span>Prevent user from click multiple times the same button.</li>										<li><span class="ct-fixed bg-info br-3 b-shadow">Fixed</span>Update addons in mozilla browser fixed</li>										<li><span class="ct-fixed bg-info br-3 b-shadow">Fixed</span>Authorize.Net payment gateway issue fixed.</li>										<li><span class="ct-fixed bg-info br-3 b-shadow">Fixed</span>Make allow special characters while booking.</li>										<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Minimum Image upload size to  1Kb</li>										<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Confirmation message before removing sample data</li>										<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Image Size validation improved</li>										<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Improved initial data for new setup</li>										<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>All Dates made translatable</li>										<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Labels Improved</li>										<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Email send with name setted  on settings</li>										</ul>									</div>								<div class="changelog-details tab-pane" id="version1_5">										<h4 class="nm">Version 1.5</h4>										<ul class="cta-changelog-ul">											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Nexmo sms gateway added</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Company logo manageable from admin</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Installer Script added</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>New Labels added</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Option to delete registered customers added</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Company address for booking page visible/hide option added</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Zip code dynamic for booking page visible/hide option added</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Login and Booking page background manageable added</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Existing and new user booking enable disabled from settings</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Tooltip added for description in booking page</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Tooltip for calendar display available slots</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Company logo visible/hide option added</li>																																																											<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Reset button functionality fixed while adding addons</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Prevent booking without login fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Frequently discount issue fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Update and insert conflication get solved in promocode</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>PDF invoice for displaying long text fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Country code uneditable manually fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Display of tax/vat in payment listing fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Working of save monthly schedule type fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Display of add break tab in schedule tab fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Off times in front panel in calendar time slots fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Display of expiry date while adding coupon fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Notifications count issue on dashboard fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Embed Code white space issue fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Language translatable issue fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Specific mobile view design issue fixed</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Calendar labels made translateable</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Display message on delete in services</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Allowed existing, new and guest user booking</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Pattern of saving language labels improved</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Made booking page as root page</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>validations in configuration form for admin improved</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Made One Save Button Instead Of many save button in all Sms options (Settings -> SMS Notification)</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Improved display of zip-code Enable/disable Button in (Settings -> General)</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Js code improved in ajax</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Front message improved</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Save postal code improved</li>													</ul>										</div>									<div class="changelog-details tab-pane" id="version1_4">										<h4 class="nm">Version 1.4</h4>										<ul class="cta-changelog-ul">											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>2checkout payment method added</li><li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Postal Code Enable/Disable option added</li>												<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Upload image errors fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Start time should be smaller than end time issue fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Units and addons duplicate names conflict fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>While adding addons, multiple Quantity option fixed </li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Notification popup issue fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Stripe user email information issue fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Overbooking issue on already booked slots fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Js issue fixed while addon Multiple Quanity in Addons</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Booking time in email template issue fixed</li><li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>PDF Invoice empty method issue fixed</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Postal code validation improved</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Service page labels improved</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Data table download reports improved</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Loading image added for payment option pages</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Notifications design Improved</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Display message on adding and deleting offdays</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Display transaction id in payment listing for pay at venue option</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Displayed AM/PM in capitals</li><li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Enabled froentend design option even with single unit</li>																																				</ul>										</div>									<div class="changelog-details tab-pane" id="version1_3">										<h4 class="nm">Version 1.3</h4>										<ul class="cta-changelog-ul">											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Stripe payment method added</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>RTL added</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>SMS Notification added</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Manageable SMS templates added</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Twilio SMS gateway added</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Plivo SMS gateway added</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Company phone option added</li>											<li><span class="ct-fixed bg-success br-3 b-shadow">Added</span>Manageable Email templates added</li>																						<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Admin menu design improved</li>											<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Email Template design Improved</li>											<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Dynamic timezone while configure</li>											<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Manage vacuum & parking status according to settings</li>											<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Default country code in profile fixed</li>											<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Forget password for Admin and Client email notification fixed</li>											<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Cancellation policy in front-end sync with admin setting fixed</li>											<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Notification booking status displaying fixed</li>										</ul>										</div>									<div class="changelog-details tab-pane" id="version1_2">										<h4 class="nm">Version 1.2</h4>										<ul class="cta-changelog-ul">											<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Language settings issue fixed</li>											<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>PDF Invoice labels issue fixed</li>											<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Calendar date selection issue fixed</li>											<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>All placeholders made translatable</li>										</ul>										</div>									<div class="changelog-details tab-pane" id="version1_1">										<h4 class="nm">Version 1.1</h4>										<ul class="cta-changelog-ul">												<li><span class="ct-added bg-success br-3 b-shadow">Added</span>Multi language feature added</li>											<li><span class="ct-added bg-success br-3 b-shadow">Added</span>Authorize.Net Payment Gateway added</li>											<li><span class="ct-added bg-success br-3 b-shadow">Added</span>New default image option in add-ons services added</li>											<li><span class="ct-added bg-success br-3 b-shadow">Added</span>Remember me password feature is added</li>											<li><span class="ct-added bg-success br-3 b-shadow">Added</span>Custom css feature added</li>											<li><span class="ct-added bg-success br-3 b-shadow">Added</span>Default country code option from admin added</li>											<li><span class="ct-added bg-success br-3 b-shadow">Added</span>Default flag selected in user registration added</li>											<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Service add-on add new pricing rule improved</li>											<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Sample data functionality improved </li>											<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Admin profile validation improved</li>											<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>Validation error messages improved</li>											<li><span class="ct-improved bg-info br-3 b-shadow">Improved</span>User details display improved</li>											<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Discount calculations issue fixed</li>											<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Add-ons selection issue fixed</li>											<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Date issue fixed in calendar</li>											<li><span class="ct-fixed bg-danger br-3 b-shadow">Fixed</span>Availability time slots issue fixed</li>										</ul>										</div>									<div class="changelog-details tab-pane" id="version1_0">										<h4 class="nm">Version 1.0</h4>										<ul class="cta-changelog-ul">											<li><span class="ct-added bg-success br-3 b-shadow">Release</span>Initial release</li>										</ul>										</div>								</div>							</div>														</div>					</div>				</div>											</div>		</div>	</div><?phpinclude(dirname(__FILE__).'/footer.php');?>