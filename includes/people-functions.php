<?php

/**
 * Updates the people_group custom taxonomies labels
 **/
function people_group_labels( $labels ) {
	$labels['singular'] = 'Committee';
	$labels['plural'] = 'Committees';
	$labels['slug'] = 'committees';
	return $labels;
}

add_filter( 'ucf_people_group_labels', 'people_group_labels', 10, 1 );

?>