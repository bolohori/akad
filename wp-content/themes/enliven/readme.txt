Theme Name 			: Enliven
Version    			: 1.1.2
Tested up to 		: 4.4.2
Stable tag 			: 1.1.2
Theme URL  			: http://www.themezhut.com/themes/enliven/
Theme Documentation : http://www.themezhut.com/enliven-wordpress-theme-documentation
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
This theme is based on _s by automattic. (http://www.underscores.me)


== DESCRIPTION ==

Enliven is a modern beautiful multipurpose WordPress theme that will be the perfect solution for your business website. Enliven has a clean portfolio layout that utilizes the Jetpack's portfolio content type. And also it utilizes the Jetpack's testimonial content type to showcase your customer feedbacks in a nicer and clean way. Business homepage widgets help you to setup the business homepage faster and without touching any code. 


== COPYRIGHT AND LICENSE == 

External resources linked to the theme. 
* Open Sans Font by Steve Matteson. - https://www.google.com/fonts/specimen/Open+Sans
  Licensed under Apache License, version 2.0 - http://www.apache.org/licenses/LICENSE-2.0.html
  
* Montserrat Font by Julieta Ulanovsky. - https://www.google.com/fonts/specimen/Montserrat
  Licensed under SIL Open Font License, 1.1 - http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL

Resources packed within the theme. 
* Based on Underscores http://underscores.me/, (C) 2012-2015 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css http://necolas.github.io/normalize.css/, (C) 2012-2015 Nicolas Gallagher and Jonathan Neal, [MIT](http://opensource.org/licenses/MIT)
* FontAwesome.
  Font Awesome is fully open source and is GPL friendly. http://fortawesome.github.io/Font-Awesome/license/
* Bootstrap by twitter.
  Bootstrap is Licensed under the MIT License. https://github.com/twbs/bootstrap/blob/master/LICENSE.
* ScrollReveal by Julian Lloyd
  ScrollReveal is Licensed under the MIT License. https://github.com/jlmakes/scrollreveal.js/blob/master/LICENSE
* FlexSlider by woothemes.
  FlexSlider is Licensed under the GPLv2 license. http://www.gnu.org/licenses/gpl-2.0.html
* HTML5 Shiv @afarkas @jdalton @jon_neal @rem | MIT/GPL2 Licensed
* Other custom js files are our own creation and is licensed under the same license as this theme. 
* Image shown in the screenshot *
	Image Link - https://pixabay.com/en/student-typing-keyboard-text-woman-849825/
	Image License - https://creativecommons.org/publicdomain/zero/1.0/deed.en

All other resources and theme elements are licensed under the [GNU GPL](http://www.gnu.org/licenses/old-licenses/gpl-2.0.html), version 2 or later.

Enliven includes support for Portfolio Content Type and Testimonial Content Type in Jetpack.


== INSTALLATION ==
	
1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your Enliven theme right away.


== BRIEF DOCUMENTATION ==

1. Custom Main Menu

After just installing the theme it will display the pages as the default menu. You can add your own links, categories, pages for the menu.

Go to Appearance > Menus in the WordPress Dashboard.
In the edit menus tab click on the link “create new menu”.
Give a Menu Name and click button “create menu”.
Then you can choose/create the links from the three tabs(Pages/Links/Categories) which is in the left hand side.
After Creating the menu select the Theme Location of the menu.(It’s under the Menu Settings which is in the bottom of the page.) In this case tick the “Primary Menu”.
Hit Save.

2. Adding a business homepage.

Go to Pages > Add New in the WordPress Dashboard
Give it a name whatever you want. eg : Home.
Then from the page attributes options box select the Template as Business Template.
Then Go to Settings > Reading in the WordPress Dashboard and select the option a static page which is under the heading “Front Page Displays”.
Then Select the page that you created from the “Front Page” drop down . eg: Home

* Adding a blog listing page when the business homepage is activated. 

Go to Pages > Add New in the WordPress Dashboard
Give it a name whatever you want. eg : Blog.
Then from the page attributes options box select the Template as Default Template.
Then Go to Settings > Reading in the WordPress Dashboard and select the option “A static page” which is under the heading “Front Page Displays”.
Then Select the page that you created from the “Blog Page” drop down . eg: Blog.

3. Widgets for Business Template.

Business Template has 1 widget area called "Business Template", to display frontpage widgets.

And there are 6 widgets for business template widget area.
1. Enliven Blocks Widget
2. Enliven Call to Action
3. Enliven Clients
4. Enliven Featured Pages
5. Enliven Portfolio Widget
6. Enliven Testimonial Widget
7. Enliven Blog Posts Widget

After making a business homepage drag and drop these widgets to "Business Template" widget area and arrange them any order you prefer.

FONT AWESOME ICONS FOR ENLIVEN BLOCKS WIDGET

Note that following is not the complete list of icons. To find more icons please visit - http://fortawesome.github.io/Font-Awesome/cheatsheet/ 

1.  fa-adjust 
2.  fa-adn 
3.  fa-align-center 
4.  fa-align-justify  
5.  fa-align-left 
6.  fa-align-right 
7.  fa-ambulance 
8.  fa-anchor 
9.  fa-android 
10. fa-angle-double-down  
11. fa-angle-double-left 
12. fa-angle-double-right  
13. fa-angle-double-up  
14. fa-angle-down 
15. fa-angle-left 
16. fa-angle-right 
17. fa-angle-up 
18. fa-apple 
19. fa-bars 
20. fa-beer 
21. fa-behance 
22. fa-behance-square 
23. fa-bell 
24. fa-bell-o 
25. fa-bitbucket 
26. fa-bitbucket-square 
27. fa-bold 
28. fa-bolt 
29. fa-bomb 
30. fa-book 



==== THEME CHANGELOG ====

- Version 1.0.0
Intial Release.

- Version 1.0.1
Fixed stylesheet issues.
Added flush rewrite rules for CPTs.
Fixed some issues in mobile navigation.
Modified post navigation links.

- Version 1.0.2
Fixed some issues slider style.
Added logo image upload option.
Added footer copyright editor.

- Version 1.0.3
Added testimonial templates.

- Version 1.0.4
Fixed empty appearance issue in blog archive page.
Fixed some widget style issues.
Changed translations files.

- Version 1.0.5
Corrected all the wrong usage of get_theme_mod with empty().
Removed enliven_posts_nav() function and used the_posts_navigation().
Removed enliven_post_navigation() function and used the_post_navigation().
Added 'enliven' prefix for all the post thumbnail sizes.
Added 'is_jetpack_cpt_active' active callback for customizer jetpack portfolio and testimonial sections.
Removed layouts folder.
Used esc_url to escape image url in the content-hero.php file.
Changed css/js enqueue handle names to standard handle names.
Used wp_script_add_data() to check useragent.
Changed enliven_admin_scripts() to enqueue admin css/js files only for widget page. 
Portfolio and Testimonial widgets wrapped with "if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) )"
Removed content creation sections for slider. Used pages instead.
Added Blog Posts Widget.
Added scrollreveal.js.
Added plugin-enhancement.php to help users install or activate Jetpack Modules as needed 

- Version 1.0.6
Removed content creation areas and used pages instead of them in Enliven: Icon Block Widget and Enliven: Call to Action widget.
Fixed a translation issue in Featured Pages Widget.
Updated screenshot image.

- Version 1.0.7
Removed images folder as it is no longer needed.

- Version 1.0.8
Fixed some issues in Enliven: Clients widget.
Added enliven_filter_theme_page_templates() function to filter portfolio page template when the jetpack is not active.

- Version 1.0.9
Removed plugin-enhancements.php.
Added class-tgm-plugin-activation.php
Added enliven_register_required_plugins() function.

- Version 1.1.0
Fixed some translation issues.

- Version 1.1.1
Added global $post to blocks-widget.php and featured-pages-widget.php
Added wp_reset_postdata() function to blocks-widget.php and featured-pages-widget.php
Fixed some styling issues.

- Version 1.1.2
Added theme-info.php to the theme.
Added few descriptions to customize.php
Updated translation file.