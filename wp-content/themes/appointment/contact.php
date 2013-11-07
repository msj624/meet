<?php  
/**
   Template Name:Contact Us 
 * @file           contact.php
 * @package        Appointment
 * @author         Priyanshu Mittal,Shahid Mansuri and Akhilesh Nagar
 * @copyright      2013 Appointment
 * @license        license.txt
 * @version        Release: 2.3.6
 * @filesource     wp-content/themes/appoinment/contact.php
 */

?>
<?php get_header();
  get_template_part('orange','header');
?>
	
 
    
 	<!-- About Us Content -->
		<div class="container portfolio_space">
	<div class="row-fluid">
	<div class="span12 contact_top">	
				  <?php the_post();?>
				     <h2>Contact <span>(Let's get in touch)</span></h2>	
					 <?php //the_content(); ?>
	    </div>				 
	</div>
				   
	<div class="row-fluid">
		<div class="span12">
			<div class="span5">
				 <!--   <address class="con_detail">
					378 Kingston Court<br>
					West New York, NJ 07093<br><br>
					
					Phone: 973-960-4715<br>
					Fax: <a href="">0276-758645</a><br> 
					Email: <a href="">info@busiprof.com</a><br>
					</address>
					--> 
					<?php the_content();?>
					
			</div>
			
			<div class="span7">
				<h2 class="contact_form">Drop a line for us</h2>
				<form method="post" id="contactus_form">
				       
			    <input type="text" name="yourname" id="yourname" class="contact-small cont_input" value="Your Name..." onClick="if(this.value=='Your Name...'){this.value=''}" onBlur="if(this.value==''){this.value='Your Name...'}"  />  
				<input type="text" name="email" id="email" value="Your Email..." class="contact-small cont_input" onClick="if(this.value=='Your Email...'){this.value=''}" onBlur="if(this.value==''){this.value='Your Email...'}"  />
				
				<textarea  class="cont-large"cols="40" rows="5" name="message" id="message" onClick="if(this.value=='Write Message...'){this.value=''}" onBlur="if(this.value==''){this.value='Write Message...'}">Write Message...</textarea>
				<input  type="submit" name="submit" id="submit"  class="btn appo_btn" value="Send Now!" />
					   
					   
				   
		
				</form>
			</div>
		</div>
	</div>	
	
		
		<font color="#FF0000">
<?php 
if(isset($_POST['submit']))
{
	$flag=1;
	if($_POST['yourname']=='')
	{
		$flag=0;
		
		echo "Please Enter Your Name<br>";
	}
	
	else if(!preg_match('/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/',$_POST['yourname']))
	{
   		$flag=0;
		echo "Please Enter Valid Name<br>";
	}
	
	if($_POST['email']=='')
	{
		$flag=0;
		echo "Please Enter E-mail<br>";
	}
	
		
		else if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST['email']))
		{
			$flag=0;
		echo "Please Enter Valid E-Mail<br>";
		}
	
	
	if($_POST['message']=='')
	{
		$flag=0;
		echo "Please Enter Message";
	}
	
	
	
if ( empty($_POST) || !wp_verify_nonce($_POST['redify_name_nonce_field'],'redify_name_nonce_check') )
{
   print 'Sorry, your nonce did not verify.';
   exit;
}
else
{
   	if($flag==1)
	{
	wp_mail(sanitize_email(get_option("admin_email")),trim($_POST['yourname'])." sent you a message from ".get_option("blogname"),stripslashes(trim($_POST['message'])),"From: ".trim($_POST['yourname'])." <".trim($_POST['email']).">\r\nReply-To:".trim($_POST['email']));

	echo "Mail Successfully Sent";
	 
	
	}
	}
}

?>	
</font>
<!--Finish Mail send code-->
		
		
	</div>
	<!-- /Main_area -->
<?php get_footer(); ?>