<div>
    <table class="widefat fixed">
        <thead>
            <tr class="alternate">
                <th class="manage-column column-columnname" scope="col">{{__('Ticket Title','ch-kanban')}}</th>
                <th class="manage-column column-columnname" scope="col">{{__('Created by','ch-kanban')}}</th>
               {{-- <th class="manage-column column-columnname" scope="col">Contacto asociado</th>
                <th class="manage-column column-columnname" scope="col">Empresa</th> --}}
                <th class="manage-column column-columnname" scope="col">{{__('Status','ch-kanban')}}</th>
                <th class="manage-column column-columnname" scope="col">{{__('Created at','ch-kanban')}}</th>
                <th class="manage-column column-columnname" scope="col">{{__('Priority','ch-kanban')}}</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach ($cards as $card )
            <tr>
                <td class="column-columnname"><a href="/wp-admin/post.php?post={{$card->ID}}&action=edit">{{$card->post_title}}</a></td>
                <td class="column-columnname"><a href="{{get_author_posts_url(get_the_author_meta($card->post_author))}}">{{get_the_author_meta('display_name', $card->post_author)}}</a></td>
              {{--  <td class="column-columnname">{{ get_post_meta( $card->ID, 'ticket_propietario', true )}}</td>
                <td class="column-columnname">{{ get_post_meta( $card->ID, 'ticket_empresa', true )}}</td> --}}
                <td class="column-columnname">
                    <?php $estado = wp_get_post_terms( $card->ID, 'estado' );?>
                    {{ $estado[0]->name }}
                </td>
                <td class="column-columnname">{!!  \Carbon\Carbon::parse($card->post_date)->locale("es_ES") !!}</td>
                <td class="column-columnname">
                    <?php $prioridad = wp_get_post_terms( $card->ID, 'prioridad' );?>
                    {{ $prioridad[0]->name }}
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>