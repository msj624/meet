jQuery(function(){

    //jQuery('.wrap').addClass('wpeden-theme-options');
    //jQuery('.wpeden-theme-options h3').each();
     
     jQuery('select').chosen();
          

});

function mediaupload(id){
      var id = '#'+id;
      tb_show('Upload Image','media-upload.php?TB_iframe=1&width=640&height=624');
      window.send_to_editor = function(html) {           
              var imgurl = jQuery('img',"<p>"+html+"</p>").attr('src');                                    
              jQuery(id).val(imgurl);
              tb_remove();
              }
      
  }