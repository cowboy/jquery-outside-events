<?PHP

include "../index.php";

$shell['title3'] = "clickoutside";

$shell['h2'] = 'Why click something, when you can click everything else?';

// ========================================================================== //
// SCRIPT
// ========================================================================== //

ob_start();
?>
$(function(){
  
  // Bind the 'clickoutside' event to each test element.
  $('#test, #test div, #test .bind-me').bind( 'clickoutside', function(event){
    var elem = $(this),
      target = $(event.target),
      text;
    
    // Highlight this element.
    elem.addClass( 'clicked-outside' );
    
    // Update the text to reference the event.target element.
    text = 'Clicked element: ' + target[0].tagName.toLowerCase()
      + ( target.attr('id') ? '#' + target.attr('id')
        : target.attr('class') ? '.' + target.attr('class').replace( / /g, '.' )
        : '' );
    
    elem.children( '.event-target' ).text( text );
    
    // After one second, de-highlight and clear the text. Uses jQuery doTimeout:
    // http://benalman.com/projects/jquery-dotimeout-plugin/
    elem.doTimeout( 'clickoutside', 1000, function(){
      elem.removeClass( 'clicked-outside' );
      elem.children( '.event-target' ).text( '' );
    });
  });
  
});
<?
$shell['script'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// HTML HEAD ADDITIONAL
// ========================================================================== //

ob_start();
?>
<script type="text/javascript" src="../../jquery.ba-clickoutside.js"></script>
<script type="text/javascript" src="../../shared/jquery.ba-dotimeout.js"></script>
<script type="text/javascript" language="javascript">

<?= $shell['script']; ?>

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

.clicked-outside {
  color: #0a0 !important;
  border-color: #0a0 !important;
  background-color: #cfc !important;
}

</style>
<?
$shell['html_head'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// HTML BODY
// ========================================================================== //

ob_start();
?>
<?= $shell['donate'] ?>

<p>
  With <a href="http://benalman.com/projects/jquery-clickoutside-plugin/">jQuery clickoutside event</a> you can bind an event that will be triggered only when the user clicks <em>outside</em> the element in question. And because a reference to the clicked element is available as <code>event.target</code> you can change behavior based on what element is clicked!
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
<?= htmlspecialchars( $shell['script'] ); ?>
</pre>

<?
$shell['html_body'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// DRAW SHELL
// ========================================================================== //

draw_shell();

?>
