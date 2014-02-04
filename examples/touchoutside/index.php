
<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
  <title>Ben Alman &raquo; jQuery outside events &raquo; Examples &raquo; clickoutside</title> 
  <script type="text/javascript" src="../../shared/ba-debug.js"></script> 
  <script type="text/javascript" src="../../shared/jquery-1.4.2.js"></script><script type="text/javascript" src="../../shared/SyntaxHighlighter/scripts/shCore.js"></script><script type="text/javascript" src="../../shared/SyntaxHighlighter/scripts/shBrushJScript.js"></script>  <link rel="stylesheet" type="text/css" href="../../shared/SyntaxHighlighter/styles/shCore.css"> 
  <link rel="stylesheet" type="text/css" href="../../shared/SyntaxHighlighter/styles/shThemeDefault.css"> 
  <link rel="stylesheet" type="text/css" href="../index.css"> 
  
<script type="text/javascript" src="../../jquery.ba-outside-events.js"></script> 
<script type="text/javascript" language="javascript"> 
 
$(function(){
  
  // Elements on which to bind the event.
  var elems = $('#test, #test div, #test .bind-me');
  
  // Clear any previous highlights and text.
  $(document)
    .bind( 'touchend', function(event){
      elems
        .removeClass( 'event-outside' )
        .children( '.event-target' )
          .text( ' ' );
    })
    .trigger( 'touchend' );
  
  // Bind the 'clickoutside' event to each test element.
  elems.bind( 'touchendoutside', function(event){
    var elem = $(this),
      target = $(event.target),
      
      // Update the text to reference the event.target element.
      text = 'Clicked: ' + target[0].tagName.toLowerCase()
        + ( target.attr('id') ? '#' + target.attr('id')
          : target.attr('class') ? '.' + target.attr('class').replace( / /g, '.' )
          : ' ' );
    
    // Highlight this element and set its text.
    elem
      .addClass( 'event-outside' )
      .children( '.event-target' )
        .text( text );
  });
  
});
 
$(function(){
  
  // Syntax highlighter.
  SyntaxHighlighter.highlight();
  
});
 
</script> 
<style type="text/css" title="text/css"> 
 
/*
bg: #FDEBDC
bg1: #FFD6AF
bg2: #FFAB59
orange: #FF7F00
brown: #913D00
lt. brown: #C4884F
*/
 
#page {
  width: 700px;
}
 
#test,
#test div {
  padding: 1em;
  margin-top: 1em;
}
 
#test .bind-me {
  padding: 0 0.5em;
  margin-left: 0.5em;
  white-space: nowrap;
  line-height: 1.6em;
}
 
#test,
#test div,
#test .bind-me {
  color: #ccc;
  border: 2px solid #ccc;
}
 
.event-outside {
  color: #0a0 !important;
  border-color: #0a0 !important;
  background-color: #cfc !important;
}
 
#test .bind-me,
.event-target {
  display: inline-block;
  width: 180px;
  overflow: hidden;
  white-space: pre;
  vertical-align: middle;
}
 
</style> 
 
</head> 
<body> 
 
<div id="page"> 
  <div id="header"> 
    <h1> 
      <a href="http://benalman.com/" class="title"><b>Ben</b> Alman</a> 
       &raquo; <a href="http://benalman.com/projects/jquery-outside-events-plugin/">jQuery outside events</a> &raquo; <a href="../">Examples</a> &raquo; clickoutside    </h1> 
    <h2>Why click something, when you can click everything else?</h2><h3>  <a href="http://benalman.com/projects/jquery-outside-events-plugin/">Project Home</a>,
  <a href="http://benalman.com/code/projects/jquery-outside-events/docs/">Documentation</a>,
  <a href="http://github.com/cowboy/jquery-outside-events/">Source</a> 
</h3>      </div> 
  <div id="content"> 
        <div id="donate"> 
      <p>Your generous donation allows me to continue developing and updating my code!</p> 
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
      <input type="hidden" name="cmd" value="_s-xclick"> 
      <input type="hidden" name="hosted_button_id" value="5791421"> 
      <input class="submit" type="image" src="../donate.gif" name="submit" alt="PayPal - The safer, easier way to pay online!"> 
      <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1"> 
      </form> 
      <div class="clear"></div> 
    </div> 
 
<p> 
  With <a href="http://benalman.com/projects/jquery-outside-events-plugin/">jQuery outside events</a> you can bind to an event that will be triggered only when a specific "originating" event occurs <em>outside</em> the element in question. For example, you can <a href="../clickoutside/">click outside</a>, <a href="../dblclickoutside/">double-click outside</a>, <a href="../mouseoveroutside/">mouse-over outside</a>, <a href="../focusoutside/">focus outside</a> (and <a href="http://benalman.com/code/projects/jquery-outside-events/docs/files/jquery-ba-outside-events-js.html#Defaultoutsideevents">over ten more</a> default "outside" events).
</p> 
<p> 
  You get the idea, right?
</p> 
 
<h2>The clickoutside event, bound to a few elements</h2> 
 
<p>Just click around, and see for yourself!</p> 
 
<div id="test"> 
  test <span class="event-target"></span> 
  
  <div id="a"> 
      a <span class="event-target"></span> 
      <div id="b"> 
          b <span class="event-target"></span> 
      </div> 
  </div> 
  
  <div id="c"> 
      c <span class="event-target"></span> 
      <span id="d" class="bind-me">d <span class="event-target"></span> </span> 
      <span id="e" class="bind-me">e <span class="event-target"></span> </span> 
  </div> 
  
  <div id="f"> 
      f <span class="event-target"></span> 
      <div id="g"> 
          g <span class="event-target"></span> 
          <span id="h" class="bind-me">h <span class="event-target"></span> </span> 
          <span id="i" class="bind-me">i <span class="event-target"></span> </span> 
      </div> 
  </div> 
</div> 
 
<h3>The code</h3> 
 
<div class="clear"></div> 
 
<pre class="brush:js"> 
$(function(){
  
  // Elements on which to bind the event.
  var elems = $('#test, #test div, #test .bind-me');
  
  // Clear any previous highlights and text.
  $(document)
    .bind( 'click', function(event){
      elems
        .removeClass( 'event-outside' )
        .children( '.event-target' )
          .text( ' ' );
    })
    .trigger( 'click' );
  
  // Bind the 'clickoutside' event to each test element.
  elems.bind( 'clickoutside', function(event){
    var elem = $(this),
      target = $(event.target),
      
      // Update the text to reference the event.target element.
      text = 'Clicked: ' + target[0].tagName.toLowerCase()
        + ( target.attr('id') ? '#' + target.attr('id')
          : target.attr('class') ? '.' + target.attr('class').replace( / /g, '.' )
          : ' ' );
    
    // Highlight this element and set its text.
    elem
      .addClass( 'event-outside' )
      .children( '.event-target' )
        .text( text );
  });
  
});
</pre> 
 
  </div> 
  <div id="footer"> 
    <p> 
      If console output is mentioned, but your browser has no console, this example is using <a href="http://benalman.com/projects/javascript-debug-console-log/">JavaScript Debug</a>. Click this bookmarklet: <a href="javascript:if(!window.firebug){window.firebug=document.createElement(&quot;script&quot;);firebug.setAttribute(&quot;src&quot;,&quot;http://getfirebug.com/releases/lite/1.2/firebug-lite-compressed.js&quot;);document.body.appendChild(firebug);(function(){if(window.firebug.version){firebug.init()}else{setTimeout(arguments.callee)}})();void (firebug);if(window.debug&&debug.setCallback){(function(){if(window.firebug&&window.firebug.version){debug.setCallback(function(b){var a=Array.prototype.slice.call(arguments,1);firebug.d.console.cmd[b].apply(window,a)},true)}else{setTimeout(arguments.callee,100)}})()}};">Debug + Firebug Lite</a> to add the Firebug lite console to the current page. Syntax highlighting is handled by <a href="http://alexgorbatchev.com/">SyntaxHighlighter</a>.
    </p> 
    <p> 
      All original code is Copyright &copy; 2010 "Cowboy" Ben Alman and dual licensed under the MIT and GPL licenses. View the <a href="http://benalman.com/about/license/">license page</a> for more details. 
    </p> 
  </div> 
</div> 
 
</body> 
</html>