<?php  

//die('We got cheezeburger here');

/**
 *    here you can additional functions create this file in your child theme
 **/

/**
 *    some basic firephp to get some info about the queries run
 **/
function thematic_firephp()    {
    global $wpdb;

    $query_table[] = array("SQL", "Execution Time", "Calling Function");
    $expensive_query_time = 0;
    $expensive_query = "";
    $total_time = 0;
 
    foreach($wpdb->queries as $query)
    {
        $query_table[] = array($query[0], $query[1], $query[2]);
        /* Get the most expensive query */
        if($query[1] > $expensive_query_time)
        {
            $expensive_query_time = $query[1];
            $expensive_query = $query[0];
            $total_time += $query[1];
        }
    }
 
    $total_queries = count($wpdb->queries);
    $firephp = FirePHP::getInstance(true);
 
    /* Display the queries in a formatted table */
    $firephp->group('Query', array( 'Collapsed' => false,  
                                    'Color' => '#000'));
    $firephp->table($total_queries . " queries took " . 
                    $total_time . " seconds.", $query_table);
 
    /* Display the query summary */
    $firephp->group('Query Summary', array( 'Collapsed' => false,  
                                            'Color' => '#000'));
    $firephp->log($total_queries, 'Total Queries');
    $firephp->log($expensive_query, 'Expensive Query');
    $firephp->log($expensive_query_time, 'Expensive Query Time');

}
