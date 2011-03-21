/* Author: Sam S
   this file has thematic script to implement dropdowns; plus some other code to enable html5 placeholder (later more)
*/

// from thematic dropdowns
$(document).ready(function(){
    $('input, textarea').placeholder();
    $("header ul").supersubs({
        minWidth:    12,                                // minimum width of sub-menus in em units
        maxWidth:    27,                                // maximum width of sub-menus in em units
        extraWidth:  1                                // extra width can ensure lines don't sometimes turn over
                                                    // due to slight rounding differences and font-family
    }).superfish({
        delay:       400,                                // delay on mouseout
        animation:   {opacity:'show',height:'show'},// fade-in and slide-down animation
        speed:       'fast',                            // faster animation speed
        autoArrows:  false,                            // disable generation of arrow mark-up
        dropShadows: false                            // disable drop shadows
    });

    // carofredsel - a carosel for any element type - with many options
    /* $(".slider ul").carouFredSel({
        items: 1,
        easing: "linear",
        auto: {
            pauseDuration: 7000,
            delay: 70
        }
    }); */
});

