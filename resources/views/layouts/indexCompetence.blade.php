@extends('layouts.app')

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
                <li class="breadcrumb-item"><a href="/portfolio">Portfolio</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$competence->titre}}</li>
            </ol>
    </nav>
    <div id = "create_competencetemp">
        <template-competence :competence="{{ json_encode($competence) }}"></template-competence>
    </div>
@endsection

@push('js')
<script>
        $(function(){
            new Vue({
                el: '#create_competencetemp',
                props : {
                        competence: {},
                }
            });
        });


</script>
@endpush