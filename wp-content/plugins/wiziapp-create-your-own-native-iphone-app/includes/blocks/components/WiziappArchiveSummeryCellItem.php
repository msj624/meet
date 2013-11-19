<?php
/**
* The archive summery component
* 
* The component knows how to return: title, numOfPosts, imageURL, actionURL
* 
* @package WiziappWordpressPlugin
* @subpackage UIComponents
* @author comobix.com plugins@comobix.com
*/
class WiziappArchiveSummeryCellItem extends WiziappLayoutComponent{
    /**
    * The attribute map
    * 
    * @var array
    */
    var $attrMap = array(
        'L1' => array('title', 'numOfPosts', 'timeLabel', 'actionURL'),
        'L2' => array('title', 'numOfPosts', 'timeLabel', 'imageURL', 'actionURL'), 
    );
    
    /**
    * The css classes to attach to the component according to the layout
    * 
    * @var mixed
    */
    var $layoutClasses = array(
        'L1' => 'archive',
        'L2' => 'archive',
    );
    
    /**
    * The base name of the component, the application knows the component by this name
    * 
    * @var string
    */
    var $baseName = 'archiveSummeryCellItem';

    public $htmlTemplate = '<li class="archiveSummeryCellItem __ATTR_class__ cellItem default">
                            <a href="__ATTR_actionURL__" class="actionURL __ATTR_class__" data-transition="slide">
                                <span class="attribute text_attribute imageURL __ATTR_classOf-imageURL__" data-image-src="__ATTR_imageURL__">
                                    <img class="hidden" src="" data-class="__ATTR_classOf-imageURL__"/>
                                </span>
                                <span class="__ATTR_classOf-timeLabel__ timeLabel attribute text_attribute">__ATTR_timeLabel__</span>
                                <span class="__ATTR_classOf-title__ title attribute text_attribute">__ATTR_title__</span>
                                <span class="__ATTR_classOf-numOfPosts__ numOfPosts attribute text_attribute">__ATTR_numOfPosts__</span>
                            </a>
                            </li>';
    
    /**
    * constructor 
    * 
    * @uses WiziappLayoutComponent::init()
    * 
    * @param string $layout the layout name
    * @param array $data the data the components relays on
    * @return WiziappArchiveSummeryCellItem
    */
    function WiziappArchiveSummeryCellItem($layout='L1', $data){
        parent::init($layout, $data);    
    }
    
    /**
    * Attribute getter method
    * 
    * @returns the id of the component
    */
    function get_id_attr(){
        return strtolower("archive_{$this->data[0]}");    
    }
    
    /**
    * Attribute getter method
    * 
    * @returns the title of the component
    */
    function get_title_attr(){
        return $this->data[0];
    }
    
    /**
    * Attribute getter method
    * 
    * @returns the time label of the component
    */
    function get_timeLabel_attr(){
        $label = '';
        if ( !empty($this->data[3]) ){
            $label = $this->data[3];    
        } else {
            $label = $this->data[0];
        }
        
        return $label;
    }
    
    /**
    * Attribute getter method
    * 
    * @returns the imageURL of the component
    */
    function get_imageURL_attr(){
        $image = '';
        /*if ( $this->data[2] == 'months') {
            $month_code = date('m', strtotime("10 {$this->data[0]} 2000"));
            $image = "cuts_month{$month_code}";
        }*/
        
        return $image;
    }
    
    /**
    * Attribute getter method
    * 
    * @returns the numOfPosts of the component
    */
    function get_numOfPosts_attr(){
        return "{$this->data[1]} ".__('posts', 'wiziapp');
    }
    
    /**
    * Attribute getter method
    * 
    * @returns the actionURL of the component
    */
    function get_actionURL_attr(){
        $type = $this->data[2];
        $link = '';
        if ( $type == 'years' ){
            $link = WiziappLinks::archiveYearLink($this->data[0]);
        } elseif ( $type == 'months' ) {
            $link = WiziappLinks::archiveMonthLink($this->data[3], $this->data[4]);
        }
        return $link;
    }
    
}