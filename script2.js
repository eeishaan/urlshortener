$(document).ready(function(){
	
/**/debugger;
for( var i=0;i<500;++i)
{
    
    var iDiv=document.createElement('div');
    iDiv.className='alibi';
    var col=Math.floor((Math.random()*400)+1);
    var col1=Math.floor((Math.random()*225)+1);
    var col2=Math.floor((Math.random()*225)+1);
    iDiv.style.background="rgba("+col+","+col1+","+col2+",0.9)";
    var rWidth=Math.floor((Math.random()*55)+1);
    iDiv.style.position="absolute";
    iDiv.style.width=rWidth+'px';
    iDiv.style.height=rWidth+'px';
    var  rTop=Math.floor((Math.random()*93)+2);
    var  rLeft=Math.floor((Math.random()*93)+2);
    iDiv.style.top=rTop+"%";
    iDiv.style.left=rLeft+"%";
    iDiv.style.zIndex="-1";
    
    
    document.body.appendChild(iDiv);
}

//setup
$( ".circle" ).each( function() {
 
    var radius = $( this ).width() / 2,
        left = $( this ).offset().left,
        top = $( this ).offset().top;

 
    $( this ).data( { 
        
        "radius": radius, 
        "left": left, 
        "top": top,
        "clicked": false
        
    } );
    
    $( "body" ).data ( { "hovering":false } );
    $(this).css({"line-height":radius+"px","text-align":"center","font-size":radius/2.26+"px"});
} );

//move and expand
function setLocations( circle, expand, event )  {
        
    var $this = $( circle ),
        circle = $this.data(),
        hoveredX = circle.left + circle.radius,
        hoveredY = circle.top + circle.radius;
        
    $( "body" ).data( "hovering", true );

    //expand circle you're over
    $this.animate( { 
        
        "width": ( 2 * circle.radius ) + expand + "px",
        "height": ( 2 * circle.radius ) + expand + "px",
        "left": circle.left - ( expand / 2 ) + "px",
        "top": circle.top - ( expand / 2 ) + "px",
      	"line-height":((2 * circle.radius)+expand)/2+"px",
       	"font-size":((2 * circle.radius)+expand)/4.5+"px",
        
        
    }, 75 );
    
    
   
    //text in circle
    /*if( $this.children( "div" ).length ) {

        var h = circle.radius + ( expand / 2 ),
            a = h / Math.sqrt( 2 ),
            size = 2 * a,
            padding = h - a;
            
        $this.children( "div" ).animate( { 
            
            "left": padding,
            "top": padding,
            "width": size,
            "height": size
            
        }, 75 );
   
    };*/
    
    //move other cicles out of the way
    $this.siblings( ".circle" ).each( function() {
        debugger;
        var $this = $( this );
        var circle = $this.data();
        var circleX = circle.left + circle.radius;
        var circleY = circle.top + circle.radius;
        var angle = Math.atan2(hoveredY - circleY, hoveredX - circleX);
        var topMove = ((expand /2 ) * Math.sin(angle));
        var leftMove = ((expand /2 ) * Math.cos(angle));
        
        $this.animate( { 
            
            "left": "-=" + leftMove + "px",
            "top":  "-=" + topMove + "px"
              
        }, 75 );
    });
        
}

//put everything back the way it was
function resetLocations() {
    
    $( ".circle" ).each( function() {
         
        var $this = $( this ),
            circle = $this.data();
    
         $this.stop().animate( { 
             
            "width": ( 2 * circle.radius ) + "px",
            "height": ( 2 * circle.radius ) + "px",
            "left": circle.left + "px",
            "top": circle.top + "px",
            "line-height":circle.radius+"px",
            "font-size":circle.radius/2.26+"px"
           
             
        }, 75 );
    
        /*if( $this.children( "div" ).length ) {
    
            var h = circle.radius,
                a = h / Math.sqrt( 2 ),
                size = 2 * a,
                padding = h - a;
                
            $this.children( "div" ).animate( { 
                "left": padding,
                "top": padding,
                "width": size,
                "height": size
                
            }, 75 );
       
        }*/
    
    } );
    
    $( "body" ).data( "hovering", false );
        
};

//is mouse inside circle or in "corner" of div
function inCircle( circle, x, y ) {
    if( circle.hasClass('alibi circle'))
    	return false;

    var radius = circle.outerWidth() / 2,
        circleX = circle.offset().left + radius,
        circleY = circle.offset().top + radius,
        xDiff = ( circleX - x ),
        yDiff = ( circleY - y ),
        mouseDistance = Math.sqrt( ( xDiff * xDiff ) + ( yDiff * yDiff ) );

    return ( mouseDistance > radius ? false : true );
    
};

$( ".circle" ).mouseleave( function( event ) {

    resetLocations();
    $( this ).data( "clicked", false );

});

$( ".circle" ).mousemove( function( event ) {

    if( inCircle( $( this ), event.pageX, event.pageY ) ) {
        
        if ( !$( "body" ).data( "hovering" ) ) {
        
            setLocations( this, 100, event );
    
        };
        
    } else {
            
        if ( $( "body" ).data( "hovering" ) ) {

            resetLocations();
            $( this ).data( "clicked", false );

        };
        
    };
                          
});








});