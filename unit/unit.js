// Not sure why this isn't set by default in qunit.js..
QUnit.jsDump.HTML = false;

$(function(){ // START CLOSURE

$('#jq_version').html( $.fn.jquery );


test( 'clickoutside', function() {
  expect( 21 );
  
  var div = $('<div><div id="a"><div id="a1"></div></div><div id="b"><div id="b1"><div id="b2"></div></div></div><div id="c"></div></div>').appendTo( 'body' ),
    bound = div.find('*'),
    a    = $('#a')[0],
    a1   = $('#a1')[0],
    b    = $('#b')[0],
    b1   = $('#b1')[0],
    b2   = $('#b2')[0],
    c    = $('#c')[0],
    body = $('body')[0],
    elems,
    targets;
  
  ok( $.data( document, 'events' ) == undefined, 'clickoutside-specific click event should not be bound to document yet' );
  
  bound.bind( 'clickoutside', function(e){
    elems.push( this );
    targets.push( e.target );
  });
  
  equals( $.data( document, 'events' ).click[0].namespace, 'clickoutside-special-event', 'clickoutside-specific click event should be bound to document' );
  
  elems = [];
  targets = [];
  $(a).click();
  same( targets, [a,a,a,a,a], 'target should be the clicked element' );
  same( elems, [a1,b,b1,b2,c], 'event should have been triggered on these elements' );
  
  elems = [];
  targets = [];
  $(a1).click();
  same( targets, [a1,a1,a1,a1], 'target should be the clicked element' );
  same( elems, [b,b1,b2,c], 'event should have been triggered on these elements' );
  
  elems = [];
  targets = [];
  $(b).click();
  same( targets, [b,b,b,b,b], 'target should be the clicked element' );
  same( elems, [a,a1,b1,b2,c], 'event should have been triggered on these elements' );
  
  elems = [];
  targets = [];
  $(b1).click();
  same( targets, [b1,b1,b1,b1], 'target should be the clicked element' );
  same( elems, [a,a1,b2,c], 'event should have been triggered on these elements' );
  
  elems = [];
  targets = [];
  $(b2).click();
  same( targets, [b2,b2,b2], 'target should be the clicked element' );
  same( elems, [a,a1,c], 'event should have been triggered on these elements' );
  
  elems = [];
  targets = [];
  $(c).click();
  same( targets, [c,c,c,c,c], 'target should be the clicked element' );
  same( elems, [a,a1,b,b1,b2], 'event should have been triggered on these elements' );
  
  elems = [];
  targets = [];
  $(body).click();
  same( targets, [body,body,body,body,body,body], 'target should be the clicked element' );
  same( elems, [a,a1,b,b1,b2,c], 'event should have been triggered on these elements' );
  
  $(a).add(a1).unbind( 'clickoutside' );
  
  elems = [];
  targets = [];
  $(body).click();
  same( targets, [body,body,body,body], 'target should be the clicked element' );
  same( elems, [b,b1,b2,c], 'event should have been triggered on these elements' );
  
  bound.unbind( 'clickoutside' );
  
  ok( $.data( document, 'events' ) == undefined, 'clickoutside-specific click event should no longer be bound to document' );
  
  elems = [];
  targets = [];
  $(body).click();
  same( targets, [], 'event should not trigger' );
  same( elems, [], 'event should not trigger' );
  
});


}); // END CLOSURE
