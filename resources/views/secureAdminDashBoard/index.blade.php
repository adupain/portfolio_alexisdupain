@extends('layouts.app')

@section('content')
    <div id = "securedashboard">
        <secure-dash></secure-dash>
    </div>
@endsection

@push('js')
<script>
        $(function(){
            new Vue({
                el: '#securedashboard',
                props : {
                }
            });
        });


</script>
@endpush