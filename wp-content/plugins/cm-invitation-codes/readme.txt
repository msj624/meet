=== Plugin Name ===
Name: CM Invitation Codes
Contributors: CreativeMindsSolutions
Donate link: http://plugins.cminds.com/cm-invitation-codes/
Tags: Registration,Invitation,Invitation Codes,Register,Codes,code,WLM,WishList Member,WishList Member Integration,email,email invitation,invite,validation,code, disclaimer,email,moderation,password,redux,user,verification,guest,Blacklist,Whitelist,E-mail,email,registration,domain,DNSBL,spam,block,SpamAssassin,Spam,register,beta,login,antispam,defence,whitelist,comments,comment,blacklist,anti-spam,spammer,spambot,antispambot,guard,security,advanced user management,anti spam users,anti-splog,appthemes,black hat,blackhat,block,block agents,block bot,block bots,block domains,block e-mails,block emails,block ip,block splog,block unwanted users,block user,block users,blog secure,clean database,clean splog,clean users,ip,ip info,ip information,no captcha,plugin,protect,protect registration,recaptcha,register,registration,secure blog,secure wordpress,secure wp,security,security questions,sign up,signup,spam blog,spam blogs,splog,sploggers,standard WordPress,untrusted,untrusted users,unwanted users,user management,user registration spam,user spam,users registration,spam prevention,wangguard,website security,wp secure,wp security,wp-login.php,wp-register.php,wp-signup.php
Requires at least: 3.2
Tested up to: 3.5
Stable tag: 2.2.2

Allows more control over site registration by adding managed groups of invitation codes.

== Description ==

Need more control over Registration for your WordPress site?  If so, you better use groups of invitation codes and send invites to relevant users.
You can track the number of users registered per each invitation code. Invitation Codes are generated automatically once you enter the group name. You can deactivate any existing group once you don't want the invitation code to be used any more

The plug is also integrated with WishList Member and allows to assign WLM group level per each invitation code allowing any new registered user to accept WLM level.

**Use-Cases**

* Beta - Control users in your beta release.
* Members Only - Restrict site registration to members only
* Control - Control sites users by invitation code groups
* WishList Member - Give WLM better control over registration process


**Features**

* Allow registration only by invitation code
* Allow registration activation once receiving email
* Limit the number of users per each invitation code group
* Add Email Validation for specific groups and limit the number of days till validation expires
* Define Invitation Code structure or update code itself
* See the list of users using each code
* Integrate with WishList Member


**More About this Plugin**
	
You can find more information about CM Invitation Codes at [CreativeMinds Website](http://plugins.cminds.com/cm-invitation-codes/).


**More Plugins by CreativeMinds**

* [CM Super ToolTip Glossary](http://wordpress.org/extend/plugins/enhanced-tooltipglossary/) - Easily create Glossary, Encyclopedia or Dictionary of your terms and show tooltip in posts and pages while hovering. Many powerful features. 
* [CM Download manager](http://wordpress.org/extend/plugins/cm-download-manager) - Allow users to upload, manage, track and support documents or files in a directory listing structure for others to use and comment.
* [CM Answers](http://wordpress.org/extend/plugins/cm-answers/) - Allow users to post questions and answers (Q&A) in a stackoverflow style forum which is easy to use, customize and install. w Social integration.. 
* [CM Email Blacklist](http://wordpress.org/extend/plugins/cm-email-blacklist/) - Block users using blacklists domain from registering to your WordPress site.. 
* [CM Multi MailChimp List Manager](http://wordpress.org/extend/plugins/multi-mailchimp-list-manager/) - Allows users to subscribe/unsubscribe from multiple MailChimp lists. 


== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Manage your CM Invitation Codes from Left Side Admin Menu

Note: You must have a call to wp_head() in your template in order for the JS plugin files to work properly.  If your theme does not support this you will need to link to these files manually in your theme (not recommended).

== Frequently Asked Questions ==

= Do you support a customized registration page ? =
Currently we do not. Building your own registration page means you need to call the functions and hooks we are using in this plugin to control invitation codes. This is not supported yet.


== Screenshots ==

1. User interface of CM Invitation Codes.
2. Registration Page including Invitation Code
3. Whishlist Member Integration screen
4. Setting Page
5. Activation Keys page (used for email verification)

== Changelog ==
= 2.2.2 =
* Fixed bug when When the user logs in, if she enters a wrong invitation code, she gets a fatal error. Thanks to akritiko@gmail.com


= 2.2.1 =
* Update readme and plugin homepage

= 2.2 =
* Minor fix in styling

= 2.1 =
* Added option to integrate with WishList Member plugin
* Added option to edit notification e-mails
* Fixed bug when hyphens in group name caused manual (de)activation to fail

= 2.0 =
* Added ability to set custom format of invitation code
* Added activation keys feature
* Added ability to set registrations limit per group
* Added ability to show users registered using specific invitation code
* Added ability to export invitation codes and activation keys to Excel

= 1.1 =
* Limit the number of users per each group
* Update Invitation Code structure or update code itself
* See the list of users using each code

= 1.0 =
* Initial release

