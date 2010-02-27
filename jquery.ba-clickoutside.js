/*!
 * jQuery clickoutside event - v1.0 - 2/27/2010
 * http://benalman.com/projects/jquery-clickoutside-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */

// Script: jQuery clickoutside event
//
// *Version: 1.0, Last updated: 2/27/2010*
// 
// Project Home - http://benalman.com/projects/jquery-clickoutside-plugin/
// GitHub       - http://github.com/cowboy/jquery-clickoutside/
// Source       - http://github.com/cowboy/jquery-clickoutside/raw/master/jquery.ba-clickoutside.js
// (Minified)   - http://github.com/cowboy/jquery-clickoutside/raw/master/jquery.ba-clickoutside.min.js (0.7kb)
// 
// About: License
// 
// Copyright (c) 2010 "Cowboy" Ben Alman,
// Dual licensed under the MIT and GPL licenses.
// http://benalman.com/about/license/
// 
// About: Examples
// 
// This working example, complete with fully commented code, illustrates one way
// in which this plugin can be used.
// 
// clickoutside - http://benalman.com/code/projects/jquery-clickoutside/examples/clickoutside/
// 
// About: Support and Testing
// 
// Information about what version or versions of jQuery this plugin has been
// tested with, what browsers it has been tested in, and where the unit tests
// reside (so you can test it yourself).
// 
// jQuery Versions - 1.4.2
// Browsers Tested - Internet Explorer 6-8, Firefox 2-3.6, Safari 3-4, Chrome, Opera 9.6-10.1.
// Unit Tests      - http://benalman.com/code/projects/jquery-clickoutside/unit/
// 
// About: Release History
// 
// 1.0 - (2/27/2010) Initial release

(function($){
  '$:nomunge'; // Used by YUI compressor.
  
  // A jQuery object containing all elements to which the 'clickoutside' event
  // is bound.
  var elems = $([]),
    
    // Internal references.
    doc = document,
    
    // Reused strings.
    clickoutside = 'clickoutside',
    click_namespaced = 'click.' + clickoutside + '-special-event';
    
    // Event: clickoutside event
    // 
    // Triggered on an event when the mouse is clicked outside that element.
    // 
    // Usage:
    // 
    // > jQuery('selector').bind( 'clickoutside', function(event) {
    // >   var clicked_elem = $(event.target);
    // >   ...
    // > });
    // 
    // Additional Notes:
    // 
    // * Because the 'clickoutside' event utilizes the 'click' event
    //   internally, if the 'click' event has its event propagation stopped
    //   on a clicked element for some reason, it will prevent 'clickoutside'
    //   from triggering on any related elements.
    
    $.event.special[ clickoutside ] = {
    
    // Called only when the first 'clickoutside' event callback is bound per
    // element.
    setup: function(){
      
      // Add this element to the list of elements to which the 'clickoutside'
      // event is bound.
      elems = elems.add( this );
      
      // If this is the first element, bind a handler to document to catch
      // all 'click' events. Be careful that stopping 'click' event
      // propagation for some other reason will interfere with 'clickoutside'
      // working properly!
      if ( elems.length === 1 ) {
        $(doc).bind( click_namespaced, handle_event );
      }
    },
    
    // Called only when the last 'clickoutside' event callback is unbound per
    // element.
    teardown: function(){
      
      // Remove this element from the list of elements to which the
      // 'clickoutside' event is bound.
      elems = elems.not( this );
      
      // If this is the last element removed, remove the document 'click' event
      // handler that "powers" this special event.
      if ( elems.length === 0 ) {
        $(doc).unbind( click_namespaced );
      }
    },
    
    // Called every time a 'clickoutside' event callback is bound per element.
    add: function( handlerObj ) {
      var old_handler = handlerObj.handler;
      
      // This function is executed every time the event is triggered. This is
      // used to override the default event.target reference with one that is
      // more useful.
      handlerObj.handler = function( event, elem ) {
        
        // Set the event object's .target property to the element that the user
        // clicked, not the element the event that the 'clickoutside' event was
        // triggered on.
        event.target = elem;
        
        old_handler.apply( this, arguments );
      };
    }
  };
  
  // When an element is clicked..
  function handle_event( event ) {
    
    // Iterate over all elements to which the 'clickoutside' event is bound.
    $(elems).each(function(){
      var elem = $(this);
      
      // If this element isn't the clicked element, and this element doesn't
      // contain the clicked element, then the clicked element is considered
      // outside, and the event should be triggered!
      if ( this !== event.target && !elem.has(event.target).length ) {
        
        // Use triggerHandler instead of trigger so that the event doesn't
        // bubble. Pass the 'click' event.target in so that the 'clickoutside'
        // event.target can be overridden.
        elem.triggerHandler( clickoutside, [ event.target ] );
      }
    });
  };
  
})(jQuery);
