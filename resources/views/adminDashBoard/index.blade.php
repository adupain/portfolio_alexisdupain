@extends('layouts.app')

@section('content')
    <div id = "dashboard">
        <dash-board></dash-board>
    </div>
@endsection

@push('js')
<script>
        $(function(){
            new Vue({
                el: '#dashboard',
                props : {
                }
            });
        });


</script>
@endpush