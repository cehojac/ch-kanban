<?php
namespace NXHBQU;
defined('ABSPATH') or die(exit());

class CMB2Controller
{

    public function __construct()
    {

    }
    public static function index()
    {
        $cmb = new_cmb2_box(array(
            'id' => 'ticket_metabox',
            'title' => __('Ticket attributes', 'ch-kanban'),
            'object_types' => array('ticket'),
        ));
        $cmb2 = new_cmb2_box(array(
            'id' => 'ticket_metabox_notes',
            'title' => __('Ticket notes', 'ch-kanban'),
            'object_types' => array('ticket'),
        ));
        /*
         $cmb3 = new_cmb2_box( array(
             'id'           => 'call_metabox_notes',
             'title'        => 'Llamadas del Ticket',
             'object_types' => array( 'ticket' ),
         ) );
         */

        // agregando campos
        $cmb->add_field(array(
            'name' => __('Description of the ticket', 'ch-kanban'),
            'desc' => __('Add details about this ticket', 'ch-kanban'),
            'id' => 'ticket_description',
            'type' => 'textarea'
        ));
        $cmb->add_field(array(
            'name' => __('Ticket status', 'ch-kanban'),
            'desc' => __('Determine the status of the ticket', 'ch-kanban'),
            'id' => 'estado_ticket',
            'taxonomy' => 'estado', //Enter Taxonomy Slug
            'type' => 'taxonomy_select',
            'default' => 'por-hacer',
            'remove_default' => 'true', // Removes the default metabox provided by WP core.
            // Optionally override the args sent to the WordPress get_terms function.
            'query_args' => array(
                // 'orderby' => 'slug',
                // 'hide_empty' => true,
            ),
        ));
        /*
        $cmb->add_field(  array(
            'name'      	=> __('Ticket author','ch-kanban'),
            'id'        	=> 'ticket_propietario',
            'type'      	=> 'post_search_ajax',
            'desc'			=> __('Search users','ch-kanban'),
            // Optional :
            'limit'      	=> 1, 		// Limit selection to X items only (default 1)
            'sortable' 	 	=> false, 	// Allow selected items to be sortable (default false)
            'object_type'	=> 'user',	// Define queried object type (Available : post, user, term - Default : post)
            'query_args'	=> array(
                 'role' => ['Administrator','Editor']
            )
        ) );
        */
        $cmb->add_field(array(
            'name' => __('Ticket members', 'ch-kanban'),
            'id' => 'ticket_members',
            'type' => 'post_search_ajax',
            'desc' => __('Search users members', 'ch-kanban'),
            // Optional :
            'limit' => 99, 		// Limit selection to X items only (default 1)
            'sortable' => false, 	// Allow selected items to be sortable (default false)
            'object_type' => 'user',	// Define queried object type (Available : post, user, term - Default : post)
        ));
        /*
        $cmb->add_field( array(
            'name'      	=> __('Ticket -related contact','ch-kanban'),
            'id'        	=> 'ticket_contacto',
            'type'      	=> 'post_search_ajax',
            'desc'			=> 'Busca entre el listado de contactos',
            // Optional :
            'limit'      	=> 10, 		// Limit selection to X items only (default 1)
            'sortable' 	 	=> false, 	// Allow selected items to be sortable (default false)
            'query_args'	=> array(
                'post_type'			=> array( 'contacto' ),
                'post_status'		=> array( 'publish' ),
                'posts_per_page'	=> -1
            )
        ) );
        */

        $cmb->add_field(array(
            'name' => __('Ticket priority', 'ch-kanban'),
            'desc' => __('Determine Ticket priority', 'ch-kanban'),
            'id' => 'prioridad_ticket',
            'taxonomy' => 'prioridad', //Enter Taxonomy Slug
            'type' => 'taxonomy_select',
            'default' => __('low', 'ch-kanban'),
            'remove_default' => 'true', // Removes the default metabox provided by WP core.
            // Optionally override the args sent to the WordPress get_terms function.
            'query_args' => array(
                // 'orderby' => 'slug',
                // 'hide_empty' => true,
            ),
        ));

        $group_field_id = $cmb2->add_field(array(
            'id' => 'tickets_notes',
            'type' => 'group',
            'description' => __('Add notes to your ticket', 'ch-kanban'),
            // 'repeatable'  => false, // use false if you want non-repeatable group
            'options' => array(
                'group_title' => __('Note {#}', 'ch-kanban'), // since version 1.1.4, {#} gets replaced by row number
                'add_button' => __('Add another note', 'ch-kanban'),
                'remove_button' => __('Remove note', 'ch-kanban'),
                'sortable' => true,
                // 'closed'         => true, // true to have the groups closed by default
                'remove_confirm' => esc_html__("you're sure?", 'ch-kanban'), // Performs confirmation before removing group.
            ),
        ));


        $cmb2->add_group_field($group_field_id, array(
            'name' => __('Description', 'ch-kanban'),
            'description' => __('Write a short description for this entry', 'ch-kanban'),
            'id' => 'description',
            'type' => 'textarea_small',
        ));

        $cmb2->add_group_field($group_field_id, array(
            'name' => __('Images', 'ch-kanban'),
            'id' => 'image',
            'type' => 'file',
        ));
        /*
        $group_field_id2 = $cmb3->add_field( array(
            'id'          => 'tickets_calls',
            'type'        => 'group',
            'description' => __( 'Agrega llamadas Telefónicas al ticket', 'cmb2' ),
            // 'repeatable'  => false, // use false if you want non-repeatable group
            'options'     => array(
                'group_title'       => __( 'LLamada {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
                'add_button'        => __( 'Agregar otra llamada', 'cmb2' ),
                'remove_button'     => __( 'Quitar llamada', 'cmb2' ),
                'sortable'          => true,
                // 'closed'         => true, // true to have the groups closed by default
                 'remove_confirm' => esc_html__( '¿estás seguro?', 'cmb2' ), // Performs confirmation before removing group.
            ),
        ) );
        
        $cmb3->add_group_field( $group_field_id2,array(
            'name'             => 'Estado de la llamada',
            'desc'             => 'Selecciona una opcion',
            'id'               => 'call_state',
            'type'             => 'select',
            'show_option_none' => true,
            'default'          => 'custom',
            'options'          => array(
                'ocupado'       => __( 'Ocupado', 'cmb2' ),
                'conectado'     => __( 'Conectado', 'cmb2' ),
                'mensaje_vivo'  => __( 'Dejo mensaje en vivo', 'cmb2' ),
                'mensaje_voz'   => __( 'Dejo mensaje de voz', 'cmb2' ),
                'sin_respuesta' => __( 'Sin respuesta', 'cmb2' ),
                'incrrecto'     => __( 'Número incorrecto', 'cmb2' ),
            )) );
        $cmb3->add_group_field( $group_field_id2,  array(
            'name' => 'Fecha de la llamada',
            'id'   => 'call_date',
            'type' => 'text_datetime_timestamp',
        ));
        $cmb3->add_group_field( $group_field_id2, array(
            'name' => 'Descripción',
            'description' => 'Describe la llamada',
            'id'   => 'call_description',
            'type' => 'textarea_small',
        ) );
        */



    }

}
//Make whit Antonella Framework