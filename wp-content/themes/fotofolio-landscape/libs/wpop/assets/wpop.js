(function ($) {
    jQuery.fn.center = function () {
        this.css('top', Math.ceil( ( $(window).height() - this.height() - 200 ) / 2 + $(window).scrollTop() ) + 'px');
        this.css('left', Math.ceil( ( $(window).width() - this.width() - 665 ) / 2 + $(window).scrollLeft() ) + 'px');
        return this;
    }

    WPop_Nav = {
        groups: [],
        init: function() {
            $('li', '#wpop_nav').each(function(i) {
                var group = $(this).attr('id').substring(9);
                var option = '#wpop_options_' + group;

                // hide all option elements
                $(option).hide();

                // show the first
                if (i == 0) {
                    $(option).show();
                    $(this).addClass('current');
                } else if (i == 1) {
                    $(this).addClass('alt')
                }

                // add to array
                WPop_Nav.groups.push(group);
            });
            
            $('a', '#wpop_nav').each(function() {
                $(this).bind('click', function() {
                    WPop_Nav.current(this);
                    return false;
                });
            });
        },
        before: function(el) {
            var k = $.inArray($(el).attr('id').substring(9), WPop_Nav.groups) - 1;
            if (k < 0) return null;
            return WPop_Nav.groups[k];
        },
        after: function(el) {
            var k = $.inArray($(el).attr('id').substring(9), WPop_Nav.groups) + 1;
            if (k == WPop_Nav.groups.length ) return null;
            return WPop_Nav.groups[k];
        },
        current: function(el) {
            var li = $(el).parent().get(0);
            var group = $(li).attr('id').substring(9);
            var vis = $('div:visible', '#wpop_content').attr('id').substring(13);
            var after = this.after(li);

            $('#wpop_options_' + vis).fadeOut('fast', function() {
                $('#wpop_nav_' + vis).removeClass('current');
                $(li).addClass('current');

                $('li', '#wpop_nav').removeClass('alt');
                if (after) $('#wpop_nav_' + after).addClass('alt');

                $('#wpop_options_' + group).fadeIn('fast');
            });
        }
    };
    
    WPop_ColorPicker = {
        current: '',
        init: function() {
            $('.wpop_colorpicker').ColorPicker({
                onBeforeShow: function(picker) {
                    WPop_ColorPicker.current = this;

                    var color = $(this).children('div').css('backgroundColor');
                    if (color == 'transparent') color = '#ffffff';

                    $(this).ColorPickerSetColor(WPop_ColorPicker.fixRGB(color));
                },
                onShow: function (picker) {
                    $(picker).fadeIn('fast');
                    return false;
                },
                onHide: function (picker) {
                    $(picker).fadeOut('fast');
                    return false;
                },
                onChange: function (hsb, hex, rgb) {
                    if (hex == 'NaNNaNNaN') return;

                    $(WPop_ColorPicker.current).children('div').css('backgroundColor', '#' + hex);
                    $(WPop_ColorPicker.current).next('input').attr('value','#' + hex);
                }
            });
            
            $('.wpop_color').bind('change keypress', function() {
                try {
                    $(this).prev('div').children('div').animate({backgroundColor: $(this).val()}, 'fast');
                } catch(e) {
                    $(this).prev('div').children('div').css('backgroundColor', $(this).val());
                }
            })
        },
        fixRGB: function(rgb) {
            var color = rgb.slice(4, -1).split(',');
            return {
              r: parseInt(color[0]),
              g: parseInt(color[1]),
              b: parseInt(color[2])
            };
        }
    };
    
    WPop_Uploader = {
        init: function() {
            $('.upload_remove').bind('click', function() {
                WPop_Uploader.remove(this);
            });
                
            $('.upload_button').click(function() {
                var button = this;
                var input = $(this).prev('input');
                var title = $($(this).parents('.option').get(0)).prev('h3').text();
                var post_id = $('#wpop_dummy_post').text();

                tb_show(title, 'media-upload.php?post_id=' + post_id + '&amp;type=image&amp;TB_iframe=1');

                window.send_to_editor = function(html) {
                    tb_remove();
                    var img = $('img', html).attr('src');
                    $(input).val(img);
                    WPop_Uploader.display(input);
                }

                return false;
            });
        },
        display: function(ref) {
            $(ref).next('input').next('div').html('<div style="display: none;"><a href="' + $(ref).val() + '" class="upload_fullsize" target="_blank" title="View full size"><img src="' + $(ref).val() + '" /></a><a href="#" class="upload_remove" title="Remove">Remove</a></div>');
            $('div', $(ref).next('input').next('div')).fadeIn();
            $('.upload_remove', $('div', $(ref).next('input').next('div'))).bind('click', function() {
                WPop_Uploader.remove(this);
                return false;
            });
        },
        remove: function(ref) {
            var block = $(ref).parents('.input').get(0);
            $('.upload_preview div', block).fadeOut('fastx', function() {
                $(this).remove();
                $('.upload', block).val('');
            });
        }
    };

    WPop_Form = {
        init: function() {
            $('#wpop_theme_form').submit(function() {
                $.post('admin-ajax.php', {
                        action: 'wpop_theme_save_options',
                        data: $("#wpop_theme_form *").serialize()
                    },
                    function(res) {
                        WPop.flashMessage(res.text, res.type);
                    }
                , 'json');

                return false;
            });
        }
    };

    WPop = {
        init: function() {
            WPop_Nav.init();
            WPop_ColorPicker.init();
            WPop_Uploader.init();
            WPop_Form.init();

            $('#wpop_message').center();
        },
        flashMessage: function(msg, type) {
            var popup = $('#wpop_message');

            $(popup).html(msg).center();
            $(popup).removeClass('wpop_message_loading wpop_message_succeed wpop_message_error wpop_message_info');
            $(popup).addClass('wpop_message_' + type);
            $(popup).fadeIn('fast', function() {
                window.setTimeout(function(){
                    $(popup).fadeOut('fast'); 
                }, 1500);
            });
        }
    };
})(jQuery);

jQuery(document).ready(function() { 
    WPop.init();
});
