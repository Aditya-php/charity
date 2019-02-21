
/**
 * 0.1.0
 * Deferred load js/css file, used for ui-jq.js and Lazy Loading.
 * 
 * @ flatfull.com All Rights Reserved.
 * Author url: http://themeforest.net/user/flatfull
 */
var uiLoad = uiLoad || {};

(function($, $document, uiLoad) {
	"use strict";

		var loaded = [],
		promise = false,
		deferred = $.Deferred();

		/**
		 * Chain loads the given sources
		 * @param srcs array, script or css
		 * @returns {*} Promise that will be resolved once the sources has been loaded.
		 */
		uiLoad.load = function (srcs) {
			srcs = $.isArray(srcs) ? srcs : srcs.split(/\s+/);
			if(!promise){
				promise = deferred.promise();
			}

      $.each(srcs, function(index, src) {
      	promise = promise.then( function(){
      		return src.indexOf('.css') >=0 ? loadCSS(src) : loadScript(src);
      	} );
      });
      deferred.resolve();
      return promise;
		};

		/**
		 * Dynamically loads the given script
		 * @param src The url of the script to load dynamically
		 * @returns {*} Promise that will be resolved once the script has been loaded.
		 */
		var loadScript = function (src) {
			if(loaded[src]) return loaded[src].promise();

			var deferred = $.Deferred();
			var script = $document.createElement('script');
			script.src = src;
			script.onload = function (e) {
				deferred.resolve(e);
			};
			script.onerror = function (e) {
				deferred.reject(e);
			};
			$document.body.appendChild(script);
			loaded[src] = deferred;

			return deferred.promise();
		};

		/**
		 * Dynamically loads the given CSS file
		 * @param href The url of the CSS to load dynamically
		 * @returns {*} Promise that will be resolved once the CSS file has been loaded.
		 */
		var loadCSS = function (href) {
			if(loaded[href]) return loaded[href].promise();

			var deferred = $.Deferred();
			var style = $document.createElement('link');
			style.rel = 'stylesheet';
			style.type = 'text/css';
			style.href = href;
			style.onload = function (e) {
				deferred.resolve(e);
			};
			style.onerror = function (e) {
				deferred.reject(e);
			};
			$document.head.appendChild(style);
			loaded[href] = deferred;

			return deferred.promise();
		}

})(jQuery, document, uiLoad);;
// lazyload config
var jp_config = {
  easyPieChart:   [   'libs/jquery/jquery.easy-pie-chart/dist/jquery.easypiechart.fill.js'],
  sparkline:      [   'libs/jquery/jquery.sparkline/dist/jquery.sparkline.retina.js'],
  plot:           [   'libs/jquery/flot/jquery.flot.js',
                      'libs/jquery/flot/jquery.flot.pie.js',
                      'libs/jquery/flot/jquery.flot.resize.js',
                      'libs/jquery/flot.tooltip/js/jquery.flot.tooltip.min.js',
                      'libs/jquery/flot.orderbars/js/jquery.flot.orderBars.js',
                      'libs/jquery/flot-spline/js/jquery.flot.spline.min.js'],
  moment:         [   'libs/jquery/moment/moment.js'],
  screenfull:     [   'libs/jquery/screenfull/dist/screenfull.min.js'],
  slimScroll:     [   'libs/jquery/slimscroll/jquery.slimscroll.min.js'],
  sortable:       [   'libs/jquery/html5sortable/jquery.sortable.js'],
  nestable:       [   'libs/jquery/nestable/jquery.nestable.js',
                      'libs/jquery/nestable/jquery.nestable.css'],
  filestyle:      [   'libs/jquery/bootstrap-filestyle/src/bootstrap-filestyle.js'],
  slider:         [   'libs/jquery/bootstrap-slider/bootstrap-slider.js',
                      'libs/jquery/bootstrap-slider/bootstrap-slider.css'],
  chosen:         [   'libs/jquery/chosen/chosen.jquery.min.js',
                      'libs/jquery/chosen/bootstrap-chosen.css'],
  TouchSpin:      [   'libs/jquery/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js',
                      'libs/jquery/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css'],
  wysiwyg:        [   'libs/jquery/bootstrap-wysiwyg/bootstrap-wysiwyg.js',
                      'libs/jquery/bootstrap-wysiwyg/external/jquery.hotkeys.js'],
  dataTable:      [   'libs/jquery/datatables/media/js/jquery.dataTables.min.js',
                      'libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.js',
                      'libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.css'],
  vectorMap:      [   'libs/jquery/bower-jvectormap/jquery-jvectormap-1.2.2.min.js',
                      'libs/jquery/bower-jvectormap/jquery-jvectormap-world-mill-en.js',
                      'libs/jquery/bower-jvectormap/jquery-jvectormap-us-aea-en.js',
                      'libs/jquery/bower-jvectormap/jquery-jvectormap.css'],
  footable:       [   'libs/jquery/footable/v3/js/footable.min.js',
                      'libs/jquery/footable/v3/css/footable.bootstrap.min.css'],
  fullcalendar:   [   'libs/jquery/moment/moment.js',
                      'libs/jquery/fullcalendar/dist/fullcalendar.min.js',
                      'libs/jquery/fullcalendar/dist/fullcalendar.css',
                      'libs/jquery/fullcalendar/dist/fullcalendar.theme.css'],
  daterangepicker:[   'libs/jquery/moment/moment.js',
                      'libs/jquery/bootstrap-daterangepicker/daterangepicker.js',
                      'libs/jquery/bootstrap-daterangepicker/daterangepicker-bs3.css'],
  tagsinput:      [   'libs/jquery/bootstrap-tagsinput/dist/bootstrap-tagsinput.js',
                      'libs/jquery/bootstrap-tagsinput/dist/bootstrap-tagsinput.css']

};
;
+function ($) {
  Drupal.behaviors.epsdiamondUiJp = {
    attach: function(context, settings) {
      $(function(){
        $("[ui-jq]").each(function(){
          var self = $(this);
          var options = eval('[' + self.attr('ui-options') + ']');

          if ($.isPlainObject(options[0])) {
            options[0] = $.extend({}, options[0]);
          }

          uiLoad.load(Drupal.settings.theme_path+'/'+jp_config[self.attr('ui-jq')]).then( function(){
            self[self.attr('ui-jq')].apply(self, options);
          });
        });
      });
    }
  };
}(jQuery);
;
+function ($) {

  $(function(){

      // nav
      $(document).on('click', '[ui-nav] a', function (e) {
        var $this = $(e.target), $active;
        $this.is('a') || ($this = $this.closest('a'));
        
        $active = $this.parent().siblings( ".active" );
        $active && $active.toggleClass('active').find('> ul:visible').slideUp(200);
        
        ($this.parent().hasClass('active') && $this.next().slideUp(200)) || $this.next().slideDown(200);
        $this.parent().toggleClass('active');
        
        $this.next().is('ul') && e.preventDefault();
      });

  });
}(jQuery);;
+function ($) {

  $(function(){

      $(document).on('click', '[ui-toggle-class]', function (e) {
        e.preventDefault();
        var $this = $(e.target);
        $this.attr('ui-toggle-class') || ($this = $this.closest('[ui-toggle-class]'));

		var classes = $this.attr('ui-toggle-class').split(','),
			targets = ($this.attr('target') && $this.attr('target').split(',')) || Array($this),
			key = 0;
		$.each(classes, function( index, value ) {
			var target = targets[(targets.length && key)];
			$( target ).toggleClass(classes[index]);
			key ++;
		});
		$this.toggleClass('active');

      });

      $('[data-toggle="tooltip"]').tooltip({animation: true,placement: "bottom"});
  });
}(jQuery);
;
+function ($) {

  $(function(){

  	// Checks for ie
    var isIE = !!navigator.userAgent.match(/MSIE/i) || !!navigator.userAgent.match(/Trident.*rv:11\./);
    isIE && $('html').addClass('ie');

 	// Checks for iOs, Android, Blackberry, Opera Mini, and Windows mobile devices
	var ua = window['navigator']['userAgent'] || window['navigator']['vendor'] || window['opera'];
	(/iPhone|iPod|iPad|Silk|Android|BlackBerry|Opera Mini|IEMobile/).test(ua) && $('html').addClass('smart');

  });
}(jQuery);
;
/**
 * @file
 * bootstrap.js
 *
 * Provides general enhancements and fixes to Bootstrap's JS files.
 */

var Drupal = Drupal || {};

(function($, Drupal){
  "use strict";

 /* Drupal.behaviors.bootstrap = {
    attach: function(context) {
      // Provide some Bootstrap tab/Drupal integration.
      $(context).find('.tabbable').once('bootstrap-tabs', function () {
        var $wrapper = $(this);
        var $tabs = $wrapper.find('.nav-tabs');
        var $content = $wrapper.find('.tab-content');
        var borderRadius = parseInt($content.css('borderBottomRightRadius'), 10);
        var bootstrapTabResize = function() {
          if ($wrapper.hasClass('tabs-left') || $wrapper.hasClass('tabs-right')) {
            $content.css('min-height', $tabs.outerHeight());
          }
        };
        // Add min-height on content for left and right tabs.
        bootstrapTabResize();
        // Detect tab switch.
        if ($wrapper.hasClass('tabs-left') || $wrapper.hasClass('tabs-right')) {
          $tabs.on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
            bootstrapTabResize();
            if ($wrapper.hasClass('tabs-left')) {
              if ($(e.target).parent().is(':first-child')) {
                $content.css('borderTopLeftRadius', '0');
              }
              else {
                $content.css('borderTopLeftRadius', borderRadius + 'px');
              }
            }
            else {
              if ($(e.target).parent().is(':first-child')) {
                $content.css('borderTopRightRadius', '0');
              }
              else {
                $content.css('borderTopRightRadius', borderRadius + 'px');
              }
            }
          });
        }
      });
    }
  };*/

  /**
   * Bootstrap Popovers.
   */
  /*Drupal.behaviors.bootstrapPopovers = {
    attach: function (context, settings) {
      if (settings.bootstrap && settings.bootstrap.popoverEnabled) {
        var elements = $(context).find('[data-toggle="popover"]').toArray();
        for (var i = 0; i < elements.length; i++) {
          var $element = $(elements[i]);
          var options = $.extend(true, {}, settings.bootstrap.popoverOptions, $element.data());
          $element.popover(options);
        }
      }
    }
  };*/

  /**
   * Bootstrap Tooltips.
   */
  /*Drupal.behaviors.bootstrapTooltips = {
    attach: function (context, settings) {
      if (settings.bootstrap && settings.bootstrap.tooltipEnabled) {
        var elements = $(context).find('[data-toggle="tooltip"]').toArray();
        for (var i = 0; i < elements.length; i++) {
          var $element = $(elements[i]);
          var options = $.extend(true, {}, settings.bootstrap.tooltipOptions, $element.data());
          $element.tooltip(options);
        }
      }
    }
  };
*/
  /**
   * Anchor fixes.
   */
  /*var $scrollableElement = $();
  Drupal.behaviors.bootstrapAnchors = {
    attach: function(context, settings) {
      var i, elements = ['html', 'body'];
      if (!$scrollableElement.length) {
        for (i = 0; i < elements.length; i++) {
          var $element = $(elements[i]);
          if ($element.scrollTop() > 0) {
            $scrollableElement = $element;
            break;
          }
          else {
            $element.scrollTop(1);
            if ($element.scrollTop() > 0) {
              $element.scrollTop(0);
              $scrollableElement = $element;
              break;
            }
          }
        }
      }
      if (!settings.bootstrap || !settings.bootstrap.anchorsFix) {
        return;
      }
      var anchors = $(context).find('a').toArray();
      for (i = 0; i < anchors.length; i++) {
        if (!anchors[i].scrollTo) {
          this.bootstrapAnchor(anchors[i]);
        }
      }
      $scrollableElement.once('bootstrap-anchors', function () {
        $scrollableElement.on('click.bootstrap-anchors', 'a[href*="#"]:not([data-toggle],[data-target])', function(e) {
          this.scrollTo(e);
        });
      });
    },
    bootstrapAnchor: function (element) {
      element.validAnchor = element.nodeName === 'A' && (location.hostname === element.hostname || !element.hostname) && element.hash.replace(/#/,'').length;
      element.scrollTo = function(event) {
        var attr = 'id';
        var $target = $(element.hash);
        if (!$target.length) {
          attr = 'name';
          $target = $('[name="' + element.hash.replace('#', '') + '"');
        }
        var offset = $target.offset().top - parseInt($scrollableElement.css('paddingTop'), 10) - parseInt($scrollableElement.css('marginTop'), 10);
        if (this.validAnchor && $target.length && offset > 0) {
          if (event) {
            event.preventDefault();
          }
          var $fakeAnchor = $('<div/>')
            .addClass('element-invisible')
            .attr(attr, $target.attr(attr))
            .css({
              position: 'absolute',
              top: offset + 'px',
              zIndex: -1000
            })
            .appendTo(document);
          $target.removeAttr(attr);
          var complete = function () {
            location.hash = element.hash;
            $fakeAnchor.remove();
            $target.attr(attr, element.hash.replace('#', ''));
          };
          if (Drupal.settings.bootstrap.anchorsSmoothScrolling) {
            $scrollableElement.animate({ scrollTop: offset, avoidTransforms: true }, 400, complete);
          }
          else {
            $scrollableElement.scrollTop(offset);
            complete();
          }
        }
      };
    }
  };*/


  if(Drupal.jsAC){
    Drupal.jsAC.prototype.setStatus = function (status) {
      var $throbber = $('.glyphicon-refresh', $('#' + this.input.id).parent());

      switch (status) {
        case 'begin':
          $throbber.addClass('glyphicon-spin');
          $(this.ariaLive).html(Drupal.t('Searching for matches...'));
          break;
        case 'cancel':
        case 'error':
        case 'found':
          $throbber.removeClass('glyphicon-spin');
          break;
      }
    };
  }
  if(Drupal.tableSelect){
    Drupal.tableSelect = function () {
      // Do not add a "Select all" checkbox if there are no rows with checkboxes in the table
      if ($('td input:checkbox', this).length == 0) {
        return;
      }

      // Keep track of the table, which checkbox is checked and alias the settings.
      var table = this, checkboxes, lastChecked;
      var strings = { 'selectAll': Drupal.t('Select all rows in this table'), 'selectNone': Drupal.t('Deselect all rows in this table') };
      var updateSelectAll = function (state) {
        // Update table's select-all checkbox (and sticky header's if available).
        $(table).prev('table.sticky-header').andSelf().find('th.select-all input:checkbox').each(function() {
          $(this).attr('title', state ? strings.selectNone : strings.selectAll);
          this.checked = state;
        });
      };

      // Find all <th> with class select-all, and insert the check all checkbox.
      $('th.select-all', table).prepend($('<label class="i-checks"><input class="form-checkbox checkbox" type="checkbox"><i></i></label>').attr('title', strings.selectAll)).click(function (event) {
        if ($(event.target).is('input:checkbox')) {
          // Loop through all checkboxes and set their state to the select all checkbox' state.
          checkboxes.each(function () {
            this.checked = event.target.checked;
            // Either add or remove the selected class based on the state of the check all checkbox.
            $(this).closest('tr').toggleClass('selected', this.checked);
          });
          // Update the title and the state of the check all box.
          updateSelectAll(event.target.checked);
        }
      });

      // For each of the checkboxes within the table that are not disabled.
      checkboxes = $('td input:checkbox:enabled', table).click(function (e) {
        // Either add or remove the selected class based on the state of the check all checkbox.
        $(this).closest('tr').toggleClass('selected', this.checked);

        // If this is a shift click, we need to highlight everything in the range.
        // Also make sure that we are actually checking checkboxes over a range and
        // that a checkbox has been checked or unchecked before.
        if (e.shiftKey && lastChecked && lastChecked != e.target) {
          // We use the checkbox's parent TR to do our range searching.
          Drupal.tableSelectRange($(e.target).closest('tr')[0], $(lastChecked).closest('tr')[0], e.target.checked);
        }

        // If all checkboxes are checked, make sure the select-all one is checked too, otherwise keep unchecked.
        updateSelectAll((checkboxes.length == $(checkboxes).filter(':checked').length));

        // Keep track of the last checked checkbox.
        lastChecked = e.target;
      });

      // If all checkboxes are checked on page load, make sure the select-all one
      // is checked too, otherwise keep unchecked.
      updateSelectAll((checkboxes.length == $(checkboxes).filter(':checked').length));
    };
  }

if(Drupal.behaviors.password){
  Drupal.behaviors.password = {
    attach: function (context, settings) {
      var translate = settings.password;
      $('input.password-field', context).once('password', function () {
        var passwordInput = $(this);
        var innerWrapper = $(this).parent();
        var outerWrapper = $(this).parent().parent();

        // Add identifying class to password element parent.
        innerWrapper.addClass('password-parent');

        // Add the password confirmation layer.
        $('input.password-confirm', outerWrapper).parent().prepend('<div class="password-confirm">' + translate['confirmTitle'] + ' <span></span></div>').addClass('confirm-parent');
        var confirmInput = $('input.password-confirm', outerWrapper);
        var confirmResult = $('div.password-confirm', outerWrapper);
        var confirmChild = $('span', confirmResult);

        // Add the description box.
        var passwordMeter = '<div class="password-strength"><div class="password-strength-title">' + translate['strengthTitle'] + '</div><div class="password-strength-text" aria-live="assertive"></div><div class="password-indicator"><div class="indicator"></div></div></div>';
        $(confirmInput).parent().after('<div class="password-suggestions description"></div>');
        $(innerWrapper).prepend(passwordMeter);
        var passwordDescription = $('div.password-suggestions', outerWrapper).hide();

        // Check the password strength.
        var passwordCheck = function () {

          // Evaluate the password strength.
          var result = Drupal.evaluatePasswordStrength(passwordInput.val(), settings.password);

          // Update the suggestions for how to improve the password.
          if (passwordDescription.html() != result.message) {
            passwordDescription.html(result.message);
          }

          // Only show the description box if there is a weakness in the password.
          if (result.strength == 100) {
            passwordDescription.hide();
          }
          else {
            passwordDescription.show();
          }

          // Adjust the length of the strength indicator.
          $(innerWrapper).find('.indicator').css('width', result.strength + '%');

          // Update the strength indication text.
          $(innerWrapper).find('.password-strength-text').html(result.indicatorText);

          passwordCheckMatch();
        };

        // Check that password and confirmation inputs match.
        var passwordCheckMatch = function () {

          if (confirmInput.val()) {
            var success = passwordInput.val() === confirmInput.val();

            // Show the confirm result.
            confirmResult.css({ visibility: 'visible' });

            // Remove the previous styling if any exists.
            if (this.confirmClass) {
              confirmChild.removeClass(this.confirmClass);
            }

            // Fill in the success message and set the class accordingly.
            var confirmClass = success ? 'ok' : 'error';
            confirmChild.html(translate['confirm' + (success ? 'Success' : 'Failure')]).addClass(confirmClass);
            this.confirmClass = confirmClass;
          }
          else {
            confirmResult.css({ visibility: 'hidden' });
          }
        };

        // Monitor keyup and blur events.
        // Blur must be used because a mouse paste does not trigger keyup.
        passwordInput.keyup(passwordCheck).focus(passwordCheck).blur(passwordCheck);
        confirmInput.keyup(passwordCheckMatch).blur(passwordCheckMatch);
      });
    }
  };
}
})(jQuery, Drupal);
;
(function ($) {
  jQuery('html').removeClass('no-js');
  Drupal.behaviors.epsdiamond = {
    attach: function(context, settings) {
      $(document).ready(function() {

        /* Primary Messages */
        if($(".view-content .list-messages:last-child .mailbox-content .collapse").length){
          $('.view-content .list-messages:last-child .mailbox-content .collapse').collapse('show');
        }
        /* END -> Primary Messages */
        /* Change Language */
        if($('.language-block > ul.language-switcher-locale-url li.active a').length){
          var current_language = $('.language-block > ul.language-switcher-locale-url li.active a').text();
          $('.language-block > a.language-main-link').html(current_language+' <span class="caret"></span>');
        }
        /* END -> Change Language */
        /* Menu - Active */
        if($("ul.nav.menu-navigation > .active-trail").length){
          if(!$("ul.nav.menu-navigation > .active-trail").is(".active")){
            $("ul.nav.menu-navigation > .active-trail").addClass("active");
          }
        }

        if($("ul.nav.menu-navigation > li.expanded > a.active").length){
          if(!$("ul.nav.menu-navigation > li.expanded > a.active").parent('li').is(".active")){
            $("ul.nav.menu-navigation > li.expanded > a.active").parent('li').addClass("active");
          }
        }

        /* END -> Menu - Active */
        /* Views bulk operations (select box) */
        if($('input.vbo-table-select-all').length){
          $('input.vbo-table-select-all').click(function(event) {  //on click
            if (this.checked) { // check select status
              $('input.vbo-select').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes
              });
            } else {
              $('input.vbo-select').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes
              });
            }
          });
        }
        if($('input.vbo-select').length){
          $('input.vbo-select').click(function(event) {
            jQuery(this).parent().parent().trigger('click');
          });
        }
        /* END -> Views bulk operations (select box) */

/*=========================================Pratheesh==========================================================================*/
        /* Selected package in add new member */
        if($('#afl-add-new-member .form-item-field-afl-enrollment-fee-und .form-radios input:radio').length){
          //if the radio already selected
          if($('#afl-add-new-member .form-item-field-afl-enrollment-fee-und .form-radios input:radio').is(':checked')) {
            $('#afl-add-new-member .form-item-field-afl-enrollment-fee-und .form-radios input:radio:checked').parent().parent().addClass("active-package");

          }
          //in logged user add mbr
          $('#afl-add-new-member .form-item-field-afl-enrollment-fee-und .form-radios input:radio').on('change',function() {
            $('#afl-add-new-member .form-item-field-afl-enrollment-fee-und').removeClass("active-package");
            if($(this).is(":checked")) {

                $(this).parent().parent().addClass("active-package");
            }
          });
        }

        if($('#afl-ref-member .form-item-field-afl-enrollment-fee-und .form-radios input:radio').length){
          //if the radio already selected
          if($('#afl-ref-member .form-item-field-afl-enrollment-fee-und .form-radios input:radio').is(':checked')) {
            $('#afl-ref-member .form-item-field-afl-enrollment-fee-und .form-radios input:radio:checked').parent().parent().addClass("active-package");

          }
          //in logged user add mbr
          $('#afl-ref-member .form-item-field-afl-enrollment-fee-und .form-radios input:radio').on('change',function() {
            $('#afl-ref-member .form-item-field-afl-enrollment-fee-und').removeClass("active-package");
            if($(this).is(":checked")) {

                $(this).parent().parent().addClass("active-package");
            }
          });
        }
        if($('#afl-join-member .form-item-field-afl-enrollment-fee-und .form-radios input:radio').length){
           //if the radio already selected
          if($('#afl-join-member .form-item-field-afl-enrollment-fee-und .form-radios input:radio').is(':checked')) {
            $('#afl-join-member .form-item-field-afl-enrollment-fee-und .form-radios input:radio:checked').parent().parent().addClass("active-package");

          }
          //new user without login
          $('#afl-join-member .form-item-field-afl-enrollment-fee-und .form-radios input:radio').on('change',function() {
            $('#afl-join-member .form-item-field-afl-enrollment-fee-und').removeClass("active-package");
            if($(this).is(":checked")) {

                $(this).parent().parent().addClass("active-package");
            }
          });
        }
        $('#commerce-checkout-form-review #edit-commerce-payment #edit-commerce-payment-payment-method ').removeClass("active-payment");
        if($('#commerce-checkout-form-review #edit-commerce-payment .form-radios .form-item-commerce-payment-payment-method input:radio').is(':checked')) {
            $('#commerce-checkout-form-review #edit-commerce-payment .form-radios .form-item-commerce-payment-payment-method input:radio:checked').parent().parent().addClass("active-payment");

          }
          $('#commerce-checkout-form-review #edit-commerce-payment .form-radios .form-item-commerce-payment-payment-method input:radio').on('change',function() {
            $('#commerce-checkout-form-review #edit-commerce-payment .form-radios .form-item-commerce-payment-payment-method').removeClass("active-payment");
            if($(this).is(":checked")) {

                $(this).parent().parent().addClass("active-payment");
            }
          });
/*===================================================================================================================*/

$( ".percentage-n-amount" ).change(function() {
  if ($(this).val().indexOf('%') > -1){
    $(this).closest('.input-group').find('.input-group-addon:first').html('%');
  }
  else{
     $(this).closest('.input-group').find('.input-group-addon:first').html($(this).attr('groupfields'));
  }
});

$( ".percentage-n-amount" ).each(function() {
  if ($(this).val().indexOf('%') > -1){
    $(this).closest('.input-group').find('.input-group-addon:first').html('%');
  }
  else{
     $(this).closest('.input-group').find('.input-group-addon:first').html($(this).attr('groupfields'));
  }
});

$('input.single-switch-checkbox').on('change', function() {
    $('input.single-switch-checkbox').not(this).prop('checked', false);
});


/*=========================================================================================================================*/
$('.mail_icon').click(function(){
     if($(this).find('i').hasClass('fa-plus')){
      $(this).find('i').removeClass('fa-plus');
        $(this).find('i').addClass('fa-minus');
     }
    else{
      $(this).find('i').removeClass('fa-minus');
      $(this).find('i').addClass('fa-plus');
    }
});

/*============================================================================================================================*/


    $(".copy-export-code").click(function() {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(this).closest('tr').find('td:eq(7) div').html()).select();
    document.execCommand("copy");
    $temp.remove();
    return false;
    });



/*========================================================================================================*/

    $(".cop-banner-link").click(function() {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(this).parent().parent().find('.banner-image-copy').html()).select();
    document.execCommand("copy");
    $temp.remove();
    return false;
    });






/*=============================================================================================================*/

      });
    }
  };
}(jQuery));

;
