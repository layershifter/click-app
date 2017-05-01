@extends('layout.app')

@section('scripts')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/dataTables.semanticui.min.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/js/dataTables.semanticui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.js"></script>

    <script>
      $(document).ready(function () {
        $('#clicks').DataTable({
          ajax: '{{ action('ClickController@index') }}',
          processing: true,
          serverSide: true,
        })
      })
    </script>
@endsection

@section('columns')
    <tr>
        <th>ID</th>
        <th>User Agent</th>
        <th>Referrer</th>
        <th>Param 1</th>
        <th>Param 2</th>
        <th>Errors</th>
        <th>Bad domain</th>
    </tr>
@endsection

@section('content')
    <table id="clicks" class="ui celled table" cellspacing="0" width="100%">
        <thead>
        @yield('columns')
        </thead>
        <tfoot>
        @yield('columns')
        </tfoot>
    </table>

    @yield('scripts')
@endsection