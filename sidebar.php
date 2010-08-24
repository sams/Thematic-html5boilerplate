<?php 

    // action hook for placing content above the main asides
    thematic_abovemainasides();

    // action hook creating the primary aside
    widget_area_primary_aside();	
	
    // action hook for placing content between primary and secondary aside
    thematic_betweenmainasides();

    // action hook creating the secondary aside
    widget_area_secondary_aside();		
	
    // action hook for placing content below the main asides
    thematic_belowmainasides(); 
    
?>