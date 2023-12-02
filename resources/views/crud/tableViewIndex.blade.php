@extends('layouts.app')

@section('title', 'TableView')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="container mt-5">
                    <h2 class="mb-4">View Table Data</h2>
                    <div style="overflow: scroll">
                        <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Age</th>
                                    <th>City</th>
                                    <th>Contact</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function() {
            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('crud.tableViewIndex') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'surname',
                        name: 'surname'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'age',
                        name: 'age'
                    },
                    {

                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'contact',
                        name: 'contact'
                    },
                ]
            });
        });
    </script>
@endsection
