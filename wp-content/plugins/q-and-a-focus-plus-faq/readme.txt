=== Q and A Focus Plus FAQ ===
Contributors: ELsMystERy, Dalton
Author: Spectrum Visions
Author URL: http://spectrumvisions.com
Plugin URL: http://spectrumvisions.com/plugins/wordpress/qa-focus-plus
Requires at least: 3.0
Tested up to: 3.7.1
Stable tag: 1.3.8
Tags: FAQ, Frequently, Asked, Questions, Knowledge, Comments, Tags, Ratings, Anchor
License: GPLv2
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=3EHFFXE5WBUJ2

A powerful and easy to use full-featured FAQ with comments, tags and ratings for your WordPress site.

== Description ==

Q & A Focus Plus FAQ, by [Spectrum Visions](http://spectrumvisions.com "Spectrum Visions"), adds new features and enhancements to the popular Q & A Plus FAQ and Knowledge Base by Raygun, making it easy to create an even better full-featured, fully searchable FAQ on your WordPress site. The source code has been cleaned up and optimized and the JavaScript and CSS files have been minimized for better performance. It allows you to create, categorize, and reorder an unlimited number of FAQs and insert them into a page with simple shortcodes. Q & A Focus Plus uses the native Custom Post Type functionality in WordPress 3.0. and above with added support for comments and post tags.

Questions can be shown/hidden with a simple jQuery animation; users without JavaScript enabled will click through to the single question page. There is an option to have questions jump into "focus" at the top of the page when clicked on, much like anchor links. With the new ratings system, you can allow anonymous visitors to rate your FAQs, or restrict the ratings to logged in users only. It even includes a Recent FAQs widget! ALL FOR FREE!

Q & A Focus Plus supports post tags. You can add tags to each question in the editor. The tags will function like the tags used on standard posts and even show up in your tag cloud.

If you have version 1.0.5 or higher of Raygun's Q & A Plus FAQ and Knowledge Base installed, Q & A Focus Plus will automatically import your settings upon activation.

Version 1.3 includes these new features:

* Optimized source code and minified JavaScript and CSS.

* A Recent FAQs widget.

* Support for comments.

* Add post tags to your FAQs.

* Question title focus/anchor link behavior.

* Ratings system.

* Change category header size and question title CSS.

* Sort the FAQ by menu order, or by ratings.

== Installation ==

IMPORTANT: If you have the Raygun/Momnt version of Q & A Plus FAQ and Knowledge Base installed you must deactivate it before installing this one. Your current FAQs will be preserved and Q & A Focus Plus will import your settings from Q & A version 1.0.5 and up. You will need to visit the settings page to activate some of the new features.

1. Extract the zip file and upload the contents to the wp-content/plugins/ directory of your WordPress installation. 

2. Deactivate Q & A FAQ and Knowledgbase by Raygun/Momnt, if it is installed.

3. Activate Q & A Focus Plus FAQ from plugins page. 

To get started, click on the **Q & A Focus Plus** section of the **Settings** menu of your WordPress Dashboard. The first thing you'll want to do is create a FAQ homepage, this is where visitors will be able to view your FAQs. This can be a page that already exists, or the plugin can automatically create the page and add the shortcode for you. By default, the FAQ homepage is "FAQS", so if that works for you, go ahead and click the **Create Page** button to add a new page to your site.

To use a page that already exists on your site, enter the page slug in the **FAQ homepage** field. For example, the page slug of your "About" page is "about". If you'd like your FAQs to be on a sub-page on your site, you can use a slash, so a page called "FAQs" that is a child page of "About" would have the slug "about/faqs". You will then need to add the "[qa]" shortcode to that page.

The default options should work for most sites, so let's create a few FAQs and see how they look. From the WordPress Dashboard, look for the **FAQs** menu, and then click **Add New**. Just like a typical WordPress post, you'll be able to add a title and body content, as well as set your category, add tags and enable comments. The title is the "Question" part of the FAQ and will be displayed on the FAQ page. The content section is hidden by default and will be displayed when the visitor clicks on the title. The category section allows you to organize your FAQs into multiple categories which are displayed on the homepage and on their own individual category pages. A FAQ can belong to multiple categories.

Add your FAQ like you would any normal WordPress post. Once you've added some FAQs, visit your site and take a look. The FAQ homepage will be at "yoursite.com/faqs" by default, or wherever you set the FAQs homepage slug in the plugin settings.

Take a look at the options on the "Plugin Settings" tab and try them out. You can add a search box on the FAQ homepage, category pages, and control the position of the search box. You can also customimze the animations and other aspects of the FAQ show/hide behavior. Each option has a small question mark next to it. Hover over this mark for a tooltip with more information about that option.

### The [qafp] and [qa] shortcodes ###

The [qafp] and [qa] (for backwards compatibility) shortcodes allow you to put your FAQs on any page on your site, and has quite a few options. If you need to create a new FAQ page, just use the shortcode without any options. You can also use the shortcode to place individual FAQs, single FAQ categories, and FAQ pages with custom options anywhere on your site. You can combine most shortcode attributes in any combination you want. Here are the basic Q & A Focus Plus shortcode options:

**FAQ homepage**: <code>[qafp]</code> and <code>[qafp]</code>. Will insert the entire FAQ homepage anywhere on your site.

**Single category page**: <code>[qafp cat=dogs]</code> and <code>[qa cat=dogs]</code>. By specifying a category slug, you can add an entire category of FAQ entries anywhere on your site. You can find the category slug on the **FAQs &rarr; FAQ Categories** page.

**Single FAQ page**: <code>[qafp id=123]</code> and <code>[qa id=123]</code>. By specifying an ID, you can insert an individual FAQ entry anywhere on your site.

Hompage specific shortcodes:

**Limit**: <code>[qafp limit=5]</code> and <code>[qa limit=5]</code>. Controls the number of FAQs returned on the FAQ homepage. Use **-1** to return all FAQ entries.

**Enable excerpts**: <code>[qafp excerpts=true]</code> and <code>[qa excerpts=true]</code>. Whether to limit posts length on the homepage. Entries that are longer than 40 words will be shortened and a "Continue reading" link will be added. Possible values are **true** or **false**.

** Sort order**: <code>[qafp sort=menu_order/ratings]</code> and <code>[qa sort=menu_order/ratings]</code>. Sort the questions on the FAQ homepage by **menu order**, or **ratings** (if ratings are enabled).

General shortcode attributes:

**Search**: <code>[qafp search=home]</code> and <code>[qa search=home]</code>. Whether to show the search field. Possible values are **home**, **categories**, **both**, or **none** to disable the search field.

**Search position**: <code>[qafp searchpos=top]</code> and <code>[qa searchpos=top]</code>. Position of the search box, if enabled. Possible values are **top** or **bottom**.

**Permalinks**: <code>[qafp permalinks=true]</code> and <code>[qa permalinks=true]</code>. Whether to show permalinks for individual FAQs. This makes it easier for users to click through and bookmark your content. Possible values are **true** or **false**.

**Animation**: <code>[qafp animation=fade]</code> and <code>[qa animation=fade]</code>. Customize the animation style when opening and closing FAQs. Possible values are **fade**, **slide**, and **none**.

**Accordion**: <code>[qafp accordion=true]</code> and <code>[qa accordion=true]</code>. Clicking on one FAQ entry closes any other open FAQ entries on the page. Setting this to **false** will allow multiple FAQs to be open and visible on the page at the same time.

**Collapsible**: <code>[qafp collapsible=true]</code> and <code>[qa collapsible=true]</code>. You can completely disable the show/hide behavior by setting this to **false**.

**Focus**: <code>[qafp focus=true]</code> and <code>[qa focus=true]</code>. **NEW FEATURE** Adds a link anchor behavior. When set to **true**, the current question will jump to the top of the browser window. You can completely disable the focus behavior by setting this to **false**.

**Horizontal Rule**: <code>[qafp hr=true]</code> and <code>[qa hr=true]</code>. **NEW FEATURE** Adds a horizontal rule after each answer. You can completely disable the horizontal rule by setting this to **false**.

Miscellaneous shortcodes:

**Show home link**: <code>[qafp_show_home_link]</code>. Adds a link to the FAQ home page anywhere on the site.

**Show last updated**: <code>[qafp_show_last_updated]</code>. Displays the date that the FAQ was last updated anywhere on the site, even when the option to display it on the FAQ home page is disabled. It only displays the date: no extra text or formatting.

== Frequently Asked Questions ==

= Is Q & A Focus Plus better than the old Q & A? =

We believe it is. A lot of time has been spent updating the old code to optimize it and remove many redundancies. We have also spent a lot of time adding new features and troubleshooting it on several different websites.

= Is Q & A Focus Plus totally free? =

It is indeed! You do not have to pay for any additional features and there is no premium version that you will need to buy in order to get premium features.

= Where can I find a demo of Q & A Focus Plus? =

Check out the FAQ at [ELsMystERy.com](https://elsmystery.com/content/home-studio-faq/ "ELsMystERy.com FAQ").

= Why do I get an error when I try to install Q & A Focus Plus? =

You probably need to disable the Raygun/Momnt version of the Q & A FAQ and Knowledge Base for WordPress. Q & A Focus Plus will not install if Raygun's Q & A FAQ and Knowledge Base is enabled.

= Q & A Focus Plus did not import my settings from the Raygun/Momnt version of the Q & A FAQ and Knowledge Base for WordPress. =

Q & A Focus Plus will only import settings from version 1.0.5 and higher of Raygun's Q & A FAQ and Knowledge Base.

= Why do I get a "nothing found" error when I click the tags on my FAQs? =

Make sure that you have not checked "Disable built-in tag support" on the options page.

= Why does the question title CSS revert back to the default setting? =

You probably entered invalid CSS, or had some unsupported characters in it.

= What characters are supported by the question title CSS option? =

You can enter the following into the question title CSS input field: **alphanumeric characters** (A to Z and 0 to 9), **periods** (.), **dashes** (-), **colons** (:), **semicolons** (;) and the **percent sign** (%).

= The ratings do not seem to be working. =

Make sure that JavaScript is enabled in your browser. Also, you will only be able to rate each question once if you are not restricting ratings to logged in users only and you have left the "Visitor rating wait time" option blank.

= How do I prevent anonymous visitors from rating more then once? =

The plugin tries to prevent that when the "Visitor rating wait time" option is left blank. If someone has found a way around that, there isn't much that you can do other than restrict the ratings to registered users.

= How do I enable comments on my FAQs? =

Check "Allow comments" in the post editor. You can also enable comments on all FAQs by doing a bulk edit in the FAQ list. 

= When I click "Add comment" I get a 404 error. =

Go to the Admin -> Settings -> Permalinks page to refresh your permalinks and try again.

= With JavaScript disabled, clicking on FAQ titles causes a 404 error. =

You may need to refresh your permalinks. From the WP Dashboard, visit "Settings->Permalinks", then click "Save Permalinks".

= I'm having trouble with the plugin. What should I do? =

Read the documentation! If that does not help, check the [frequently asked questions](http://wordpress.org/plugins/q-and-a-focus-plus-faq/faq/ "FAQ"). If you do not find a solution there, you can get support on the [Wordpress Q and A Focus Plus FAQ plugin support page](http://wordpress.org/support/plugin/q-and-a-focus-plus-faq "Wordpress support page").

If you ask a question that is already answered in one of these resources, you probably won't get a reply. Ninety percent of the support requests we get are because people will not read the documentation, or experiment with different options. So, PLEASE, make sure that you try turning options off and on to see if that solves the issue before contacting us. We will be glad to help you solve undocumented issues, but we cannot help you solve problems caused by other programs, or not reading the documentation.

== Screenshots ==

1. The FAQ homepage.

2. A single FAQ page.

3. The plugin settings page.

4. The FAQ entry page.

== Upgrade Notice ==

Version 1.2 and higher is a customized upgrade to the original 1.0.6 version of Q and A Plus. If you have the Raygun/Momnt version installed you must deactivate it before installing this one. Your FAQs will be preserved. 

== Changelog ==

= 1.3.8 = 

* Removed FAQ last updated information from categories to prevent it from showing multiple times when there is more than one category on a page.

* The link to FAQ home will now only appear when viewing a single FAQ, or category. It will no longer appear when using the shortcode in regular posts and pages.

* Added <code>[qafp_show_home_link]</code> shortcode to add a link to the FAQ home anywhere on the site.

* Added <code>[qafp_show_last_updated]</code> shortcode to display the FAQ last updated date anywhere on the site, even when disabled in the options.

* Optimized some more code.

* Made minor cosmetic changes to the FAQ last updated information CSS.

* Updated documentation.

= 1.3.7 =

* Removed unnecessary and redundant excerpt functions that were left over from the old version and did weird things with some themes.

* Tested for compatibility with Wordpress 3.7.

= 1.3.6.4 =

* Added option to show, or hide the FAQ last updated line.

* Changed the name of the .pot file to match the text domain.

= 1.3.6.2 =

* Minor changes made to the documentation.

= 1.3.6 =

* Fixed: forgot to update the .pot file in version 1.3.5.

= 1.3.5 =

* Fixed: search button translation problem.

* Updated the readme file.

= 1.3.4 =

* Removed breadcrumbs option.

= 1.3.3 =

* Improved communications between Q & A Focus Plus and Easy Taxonomy Support.

* Changed the comments link at the bottom of FAQs in page and category views to the Wordpress default.

* Fixed old bug: the excerpts option would not be checked after saving the settings.

= 1.3.2 =

* Reverted back to global post_tag support because the changes in 1.3.1 did not work correctly.

* Added option to disable tag support. This is useful if you do not want to use tags, or you have a plugin that provides post_tag support for custom post types.

* Added option to hide post tags so they do not display on the FAQs.

* Updated the documentation.

= 1.3.1 =

* Improved tag support. It now only adds post tag support to Q & A Focus Plas FAQs without filtering all other post types.

* Removed obsolete code, such as the authorization options.

* Made some minor cosmetic changes.

* Updated the documentation.

* Removed changes prior to 1.2.0 from the readme file to shorten it up. 

= 1.3.0 =

* Added option to restrict ratings to logged in members only, or allow anonymous visitors to rate questions.

* Added option to set the number of minutes an anonymous visitor must wait before rating a question again. This option can be left blank to restrict anonymous visitors from rating the same question more than once from the same IP address.

= 1.2.9 =

* Converted "true/false" string values from the original Q & A to boolean values.

= 1.2.8 =

* Fixed version update bug.

* Fixed comments link style issues.

= 1.2.7 =

* Added comment support.

* Added a Recent FAQs widget.

* Added FAQ last updated date and time at the top of the FAQ home page and category views.

= 1.2.6 =

* Removed ratings shortcode.

* Included taxonomy support in the plugin.

* Moved ratings options to their own settings group.

* Fixed bug that caused the selected ratings icon color option to get lost when turning off ratings.

= 1.2.5 =

* Fixed breadcrumbs. When enabled, breadcrumbs replace the category in the "Posted in:" meta field. The title is no longer converted to breadcrumbs. 

* Corrected problems with the way the front end JavaScript and CSS files were being enqueued.

* Removed the jQuery option, since Wordpress comes with jQuery there is no need to force load it from another source.

* Updated the documentation.

= 1.2.4 =

* Updated the documentation.

* Added CSS input checks.

* Added links to header and CSS information.

* Corrected code for better language translation support.

= 1.2.3 =

* Added settings are now imported from Q and A Plus during installation.

= 1.2.0 =

* Added focus behavior, setting and shortcode. This works like an anchor link, so the question jumps to the top of the page when opened.

* Added setting and shortcode to include ratings at the bottom of each answer for logged in users.

* Added setting and shortcode to sort questions on the FAQ homepage by menu order, or ratings (if ratings are enabled).

* Added setting and shortcode to have a horizontal rule placed at the end of each answer.

* Added setting to change the category header (H1, H2, H3, H4).

* Added setting to customize the question title CSS.

* Added links back to FAQ homepage in single post and category views.

* Added support for post tags when used with our Custom Post Taxonomy Support plugin.

* Minified front end CSS and JavaScript and optimized some of the code for better performance.

