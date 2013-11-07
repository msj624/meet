
<div class="container">
 
<div class="row-fluid">
<div class="span7">
<img class="gray aligncenter" src="<?php echo sensitive_get_theme_opts('home_featured_image',sensitive_THEME_URL."/images/banner.png"); ?>" />
</div>
<div class="span5 wpeden-intro">
<h2><?php echo sensitive_get_theme_opts('home_featured_title',"Sensitive"); ?></h2>
<p>
<?php echo nl2br(wptexturize(sensitive_get_theme_opts('home_featured_desc',"Sensitive, Fully Responsive WordPress Theme using Bootstrap"))); ?> 
</p><br>
 <center>
         <a href="<?php echo sensitive_get_theme_opts('home_featured_btnurl','#'); ?>" class="btn btn-large <?php echo sensitive_get_theme_opts('button_style','btn-info'); ?>"><i class="icon-fire icon-white"></i> <?php echo sensitive_get_theme_opts('home_featured_btntxt','Get It Now!'); ?></a>
</center>
</div>
</div>
</div>    
     