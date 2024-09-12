@extends('layouts.app')
@section('content')
<div id = "home">
    <home-page :propos="{{ json_encode($propos) }}" :formations="{{ json_encode($formations) }}"></home-page>
</div>

@endsection
@push('js')
<script>
        $(function(){
            new Vue({
                el: '#home',
                props: {
                    propos: [],
                    formations: [],
                }
            });
        });


</script>
@endpush
