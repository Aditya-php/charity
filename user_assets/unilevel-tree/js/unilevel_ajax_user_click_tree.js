var items=[];
(function($) {

  Drupal.behaviors.unilevelPlan = {
    attach: function(context, settings) {

        //Check the
    /*  jQuery('.binary-node-single-item').hover(function(){
        //check the new items are present or not in the dl

         obj = jQuery(this);
          console.log(jQuery(obj).attr('id').replace('user_block_',''));
        //if not present then load from the ajax
         if(jQuery(this).find('.pop-up-content').eq(0).find('.loading-div').length){
             jQuery.ajax({
                url : 'afl/user/get_meta_data/'+jQuery(obj).attr('id').replace('user_block_',''),
                type : 'GET',
                async : false,
                success : function(response){
                    jQuery(obj).find('.pop-up-content').eq(0).find('.tooltip_profile_detaile').append(response);
                    jQuery(obj).find('.pop-up-content').eq(0).find('.loading-div').remove();
                }

             })
         }


      })*/


      jQuery('.btn.no-shadow').click(function(){document.cookie='asideFolded='+(jQuery(this).hasClass('active')?'no':'yes');window.location.reload();return false;})

      if(jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.scroll_class div').length){
                  jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.scroll_class').css('padding-bottom','65px');
                }else{
                  jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.node-centere-item').css('padding-bottom','30px');
                }
        if(jQuery('#block-system-main').length){
        jQuery('html,body').animate({scrollLeft : jQuery('#block-system-main').width()/2},1000);
        if(!jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.scroll_class').eq(0).find('.node-left-item').length)
                  jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.main-member').addClass('last_class');
         }
      //balance the tree

      /* if check HTML tag ID exist or not */
      if($(".load_more_taimeline" ).length){
        $( ".load_more_taimeline" ).on( "click", function() {
          var lastvalu = $('#cd-timeline .cd-timeline-block').last().attr('nid');
          if(Drupal.settings.ajaxurl != 'undefined' && Drupal.settings.parentnode !='undefined' && lastvalu != 'undefined'){
            $.ajax({
              method: "POST",
              url: Drupal.settings.ajaxurl,
              dataType : "html",
              data: { parentnode:Drupal.settings.parentnode,lastvalu:lastvalu},
              success: function(respond){
                $( "#cd-timeline" ).append(respond);
                if(respond.length==0){
                  if($(".load_more_taimeline" ).length){
                    if(Drupal.settings.addmemberurl != 'undefined' && Drupal.settings.parentnode !='undefined' && Drupal.settings.baseurl !='undefined'){
                      addMembers(Drupal.settings.addmemberurl,Drupal.settings.parentnode,Drupal.settings.baseurl);
                    }
                  }
                }
                return false;
              }
            });
            var lastvalu = $('#cd-timeline .cd-timeline-block').last().attr('nid');
            if(lastvalu <= 2){
              if($(".load_more_taimeline" ).length){
                if(Drupal.settings.addmemberurl != 'undefined' && Drupal.settings.parentnode !='undefined' && Drupal.settings.baseurl !='undefined'){
                  addMembers(Drupal.settings.addmemberurl,Drupal.settings.parentnode,Drupal.settings.baseurl);
                }
              }
            }
            return false;
          }
        });
        return false;
      }
      /* END*/

    function addMembers(ajaxurl,parentnode,basepath){
       if(ajaxurl.length && parentnode.length && basepath.length){
        $.ajax({
          method: "POST",
          url: ajaxurl,
          dataType : "html",
          data: { parentnode:parentnode,basepath:basepath},
          success: function(respond){
            $('.load_more_taimeline').parent('div.load_more_btn_area').html(respond);
          }
        });
        return false;
      }
      return false;
    }

    jQuery('.node-left-item,.node-right-item').each(function(){
                  center = window.innerWidth/2;
                  pos = jQuery(this).offset().left;

                  if(center < pos){
                        jQuery(this).find('.pop-up-content').eq(0).addClass('right_tooltip');
                        //style = "left:"+(0-($('.pop-up-content').eq(0).width()+50))+'px';
                   }
                });

    //Add new class for the first last element
    $('.scroll_class').each(function(){
      length =$(this).find('.node-left-item').length;
     if(length == 1){
                      jQuery(this).find('.binar-hr-line-left').eq(0).addClass('no-bg');
                  }else{
                  jQuery(this).find('.binar-hr-line-left').eq(0).addClass('left_no_hr');
                  jQuery(this).find('.binar-hr-line-left').eq(length-1).addClass('right_no_hr');
          }
    });

    }
  };
})(jQuery);

function trigger_hover(obj){

        //if not present then load from the ajax
        if(jQuery(obj).find('.wrap_content').eq(0).hasClass('no-bg')){

              jQuery(obj).find('.mx_pop_content').hide();
              return false;
        }
         if(jQuery(obj).find('.pop-up-content').eq(0).find('.loading-div').length){

             jQuery.ajax({
                url : 'http://africandreamnetwork.com/user/mygenealogy/directTreeAjaxPopupInfo/'+jQuery(obj).attr('id').replace('user_block_',''),
                type : 'GET',
                async : false,
                success : function(response){
                    jQuery(obj).find('.pop-up-content').eq(0).find('.tooltip_profile_detaile').append(response);
                    jQuery(obj).find('.pop-up-content').eq(0).find('.loading-div').remove();
                }

             })
         }
}
function trigger_click(target,parent_id,obj){
          if(jQuery(obj).html() == '&nbsp;')
            return false;
         //make overflow x hidden
        // jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).children().css('overflow-x','hidden');

        //get the scope for the link binary treesssssssssssssssssssssss
         flag=false;
         it=0;
        jQuery('.binary-genealogy-tree').each(function(){
            if(flag){
              jQuery(this).remove();
            }else{
              it++;
            }
            if(jQuery.contains(this, target)){
               //delete all others

               flag = true;

            }

        });



        jQuery('.last_level_user').each(function(){
            //jQuery(this).prev().fadeIn();
            jQuery(this).parent().removeClass('vertical_line');



        });
        console.log(it);
        if(items[it-1] && items[it-1].length){
            jQuery(obj).parent().parent().parent().parent().find('.no-bdr').html(items[it-1]);
            jQuery(obj).parent().parent().parent().parent().find('.no-bdr').removeClass('no-bdr');
            items[it-1]='';
        }


        jQuery(obj).parent().addClass('vertical_line');

        url_arr = window.location.href.split('?');
        get_params = '';
        if(url_arr[1]){
          get_params='?'+(url_arr[1]);
        }
        if(parent_id.length && parent_id !='empty'){
          jQuery.ajax({
              //url : 'ajax-genealogy-tree.php?parent_id='+parent_id + '/1'+get_params,
			  url : 'http://africandreamnetwork.com/user/mygenealogy/directAjaxTree/'+parent_id,
              'type' : 'GET',
              'async' : false,
              'success' : function(response){
                 items[it-1] = jQuery(obj).parent().html();
                 //console.log(items[it-1]);
                 //check the max width
                 if(jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.scroll_class').length){
                  jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.scroll_class').css('padding-bottom','64px');
                }else{
                  jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.node-centere-item').css('padding-bottom','0px');
                }
                  jQuery('#block-system-main').append(response);
                  max_width = max_width();

                    w= jQuery(obj).offset().left;
                    if(jQuery('#block-system-main').width() > window.innerWidth){
                      tt = jQuery('#block-system-main').width()/2;
                    }else{
                      tt = window.innerWidth/2;
                    }

                   width_offset=0;
                   if(jQuery('#block-system-main').width() > window.innerWidth){

                     width_offset=150;

                   }
                   var ot=0;
                   if(jQuery(".app.aside-lg").hasClass("app-aside-folded") || (!jQuery('#aside').width())){
                        if((!jQuery('#aside').width())){
                           ot+=157;
                         }else{
                           ot+=97;
                         }

                        if(jQuery('.scroll_class').width() > window.innerWidth)
                            ot+=97;
                    }
                     console.log(w);

                    if((w-90-width_offset+ot)>tt){

                        class_div="binar-hr-line-left";
                        width = w - tt-90-width_offset;
                         css_style = 'margin-right';
                         binary_tree_left = jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).offset().left;
                          w =jQuery('.binary-genealogy-tree').width()- w +jQuery(".nav.menu-navigation").width()-20;
                          width+=ot;


                    }else{
                      class_div="binar-hr-line-right";
                      width = tt-w+80+width_offset;
                      css_style = 'margin-left';
                      binary_tree_left = jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).offset().left;

                       w-=binary_tree_left - 35;
                       width-=ot;

                    }



                    console.log('width-window--'+w);


                  jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).prepend('<span class="line_logic hr_class '+class_div+' "></span>');
                  //position set up
                  jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.hr_class').css('width',width+'px');
                  //get the binary tre left
                  jQuery('.binary-genealogy-tree').eq(jQuery('.binary-genealogy-tree').length -1).find('.hr_class').css(css_style,w+'px');
                  jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).addClass('binary_tree_extended');
                  jQuery('html,body').animate({scrollTop : jQuery('.binary-genealogy-tree').eq(jQuery('.binary-genealogy-tree').length -1).offset().top},1000);
                  jQuery('html,body').animate({scrollLeft : tt},1000);
                  jQuery('.node-left-item,.node-right-item').each(function(){

                  pos = jQuery(this).offset().left;

                  if(tt < pos){
                        jQuery(this).find('.pop-up-content').eq(0).addClass('right_tooltip');
                        //style = "left:"+(0-($('.pop-up-content').eq(0).width()+50))+'px';
                   }


                });

                  //Add new class for the first last element
                jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.scroll_class').each(function(){
                  length =jQuery(this).find('.node-left-item').length;
                  if(length == 1){
                       jQuery(this).find('.binar-hr-line-left').eq(0).addClass('no-bg');
                  }else{
                  jQuery(this).find('.binar-hr-line-left').eq(0).addClass('left_no_hr');
                  jQuery(this).find('.binar-hr-line-left').eq(length-1).addClass('right_no_hr');
                  }
                });

                jQuery(obj).parent().addClass('no-bdr');
                 //if it is last level then add the last_class class
                 if(!jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.scroll_class').eq(0).find('.node-left-item').length)
                  jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.main-member').addClass('last_class');
                 jQuery(obj).parent().find('.images_wrapper').html('&nbsp');
                 jQuery(obj).parent().removeClass('client');
                 jQuery(obj).parent().removeClass('networker');
                 jQuery(obj).parent().find('.wrap_content').html('&nbsp');
                 jQuery(obj).parent().find('.wrap_content').addClass('no-bg');
                 jQuery(obj).html('&nbsp;');
                 if(jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.scroll_class div').length){
                  jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.scroll_class').css('padding-bottom','65px');
                }else{
                  jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.node-centere-item').css('padding-bottom','30px');
                }

              }

          });
      }

}




;
/*! jquery.cookie v1.4.1 | MIT */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):"object"==typeof exports?a(require("jquery")):a(jQuery)}(function(a){function b(a){return h.raw?a:encodeURIComponent(a)}function c(a){return h.raw?a:decodeURIComponent(a)}function d(a){return b(h.json?JSON.stringify(a):String(a))}function e(a){0===a.indexOf('"')&&(a=a.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\"));try{return a=decodeURIComponent(a.replace(g," ")),h.json?JSON.parse(a):a}catch(b){}}function f(b,c){var d=h.raw?b:e(b);return a.isFunction(c)?c(d):d}var g=/\+/g,h=a.cookie=function(e,g,i){if(void 0!==g&&!a.isFunction(g)){if(i=a.extend({},h.defaults,i),"number"==typeof i.expires){var j=i.expires,k=i.expires=new Date;k.setTime(+k+864e5*j)}return document.cookie=[b(e),"=",d(g),i.expires?"; expires="+i.expires.toUTCString():"",i.path?"; path="+i.path:"",i.domain?"; domain="+i.domain:"",i.secure?"; secure":""].join("")}for(var l=e?void 0:{},m=document.cookie?document.cookie.split("; "):[],n=0,o=m.length;o>n;n++){var p=m[n].split("="),q=c(p.shift()),r=p.join("=");if(e&&e===q){l=f(r,g);break}e||void 0===(r=f(r))||(l[q]=r)}return l};h.defaults={},a.removeCookie=function(b,c){return void 0===a.cookie(b)?!1:(a.cookie(b,"",a.extend({},c,{expires:-1})),!a.cookie(b))}});;
