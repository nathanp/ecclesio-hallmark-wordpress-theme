<?php
/*
 * Add support/settings for Church Theme Content plugin
 */

add_theme_support( 'church-theme-content' );

// Sermons
add_theme_support( 'ctc-sermons', array(
    'taxonomies' => array(
        'ctc_sermon_topic',
        'ctc_sermon_book',
        'ctc_sermon_series',
        'ctc_sermon_speaker',
        'ctc_sermon_tag',
    ),
    'fields' => array(
        '_ctc_sermon_has_full_text',
        '_ctc_sermon_video',
        '_ctc_sermon_audio',
        '_ctc_sermon_pdf',
    ),
    'field_overrides' => array()
) );

//add_theme_support( 'ctfw-responsive-embeds' ); //doesn't seem to be working


// Events
add_theme_support( 'ctc-events', array(
    'taxonomies' => array(
        'ctc_event_category',
    ),
    'fields' => array(
        '_ctc_event_start_date',
        '_ctc_event_end_date',
        '_ctc_event_start_time',
        '_ctc_event_end_time',
        '_ctc_event_hide_time_range',
        '_ctc_event_time',                // time description
        '_ctc_event_recurrence',
        '_ctc_event_recurrence_end_date',
        '_ctc_event_venue',
        '_ctc_event_address',
        '_ctc_event_show_directions_link',
        '_ctc_event_map_lat',
        '_ctc_event_map_lng',
        '_ctc_event_map_type',
        '_ctc_event_map_zoom',
        '_ctc_event_registration_url',
    ),
    'field_overrides' => array(
        '_ctc_event_recurrence' => array(
            'desc' => sprintf( __( 'Dates automatically move forward after event ends. <br />Install <a href="%s" target="_blank">Custom Recurring Events</a> for more options.', 'ecclesio' ), 'https://eccles.io' )
        )//Adds custom link to purchase recurring events add-on
    )
) );
// Remove default link to purchase recurring events add-on
remove_action( 'ctmb_field-_ctc_event_recurrence', 'ctc_append_custom_recurrence_note' );

// People
add_theme_support( 'ctc-people', array(
    'taxonomies' => array(
        'ctc_person_group',
    ),
    'fields' => array(
        '_ctc_person_position',
        '_ctc_person_phone',
        '_ctc_person_email',
        '_ctc_person_urls',
    ),
    'field_overrides' => array()
) );

// Locations
add_theme_support( 'ctc-locations', array(
    'taxonomies' => array(),
    'fields' => array(
        '_ctc_location_address',
        '_ctc_location_show_directions_link',
        '_ctc_location_map_lat',
        '_ctc_location_map_lng',
        '_ctc_location_map_type',
        '_ctc_location_map_zoom',
        '_ctc_location_phone',
        '_ctc_location_email',
        '_ctc_location_times',
    ),
    'field_overrides' => array()
) );


?>