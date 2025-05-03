@extends('layouts.app')

@section('content')
    <div id = "securedashboard">
        <secure-dashboard></secure-dashboard>
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