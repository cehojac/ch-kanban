<div id='boardlists' class="board-lists">
    @foreach ($terms as $term)
    <div id='{{$term->slug}}' data-term-id="{{$term->term_taxonomy_id}}" class="board-list" ondrop="dropIt(event)" ondragover="allowDrop(event)">
        <div class="list-title">
          {{$term->name}} {{-- (<span class="count {{$term->slug}}">{{count($cards[$term->slug])}}</span>) --}}
        </div>
        @foreach($cards[$term->slug] as $card)
            <div  id='card-{{$card->ID}}' class="card" draggable="true" ondragstart="dragStart(event)">
                @if(has_post_thumbnail($card->ID))
                <div class="card-thumbnail">
                    <div style="background-image: url('{{get_the_post_thumbnail_url($card->ID)}}')";></div>
                </div>
                @endif
                <div class="card-title"><a href="/wp-admin/post.php?post={{$card->ID}}&action=edit">{{$card->post_title}}</a></div>
                <div class="card-time"><strong>{!!  \Carbon\Carbon::parse($card->post_date)->locale("es_ES")->diffForHumans() !!}</strong></div>
                
                <div class="card-priority">
                    <?php $prioridad = wp_get_post_terms( $card->ID, 'prioridad' );?>
                    {{__('Priority','ch-kanban')}}: {{ $prioridad[0]->name }}
                </div>
                <div class="card-auhtor">{{__('Auhtor','ch-kanban')}}: {!!get_avatar( get_the_author_meta( $card->post_author ), 16 )!!} {{get_the_author_meta('display_name', $card->post_author)}}</div>
                <div class="card-menbers"> {{__('Members','ch-kanban')}}: 
                    <?php $members = get_post_meta($card->ID,'ticket_members',true); ?>
                    @foreach ($members as $member )
                        {!!get_avatar( get_the_author_meta( $menber), 16 )!!}
                    @endforeach    
                </div>
            </div>
        @endforeach
    </div>
    @endforeach     
</div>