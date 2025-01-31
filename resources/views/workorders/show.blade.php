@extends('layouts.mainlayout')


@section('content')
<div class="container text-center">

    <!--top row info-->
    <div class="row">
        <div class="col-4">
            <h6>Company: {{ $workorder->user->company_name }}</h6>
        </div>

        <div class="col-4">
            <h6>Jobname: {{ $workorder->jobname }}</h6>
        </div>


        <div class="col-4">
            <h5>Work Order #: {{ $workorder->id }}</h5>
        </div>

        <!--middle row info-->
        <div class="row">
            <div class="col-4">
                <h6>Name: {{ $workorder->user->name }}</h6>
            </div>

            <div class="col-4">
                <h6>Jobnumber: {{ $workorder->jobnumber }}</h6>
            </div>



            <div class="col-4">
                <h6>Date: {{ $workorder->created_at->format('M-d-Y g:i:s A') }} </h6>
            </div>

            <!--bottom row info-->
            <div class="row">
                <div class="col-4">
                    <h6>Phone: {{ $workorder->user->phone }}</h6>
                </div>

                <div class="col-4">
                    <h6>Email: {{ $workorder->user->email }}</h6>
                </div>


                <table class="table table-bordered">
                    <thead>

                    <tbody>
                        <div class=" text-center">
                            <h2>Small format</h2>
                        </div>

                        <tr>
                            <td></td>
                            <td><b>Originals</td>
                            <td><b>Copies</td>
                            <td><b>Size</td>
                            <td><b>Paper</td>
                            <td><b>Color</td>
                            <td><b>Sides</td>
                            <td><b>Scale</td>
                            <td><b>Binding</td>
                            <td><b>Description</td>
                        <tr>
                        <tr>
                            <th scope="row">Small format 1</th>
                            <td>{{ $workorder->sm1orig }}</td>
                            <td>{{ $workorder->sm1copy }}</td>
                            <td>{{ $workorder->sm1size }}</td>
                            <td>{{ $workorder->sm1paper }}</td>
                            <td>{{ $workorder->sm1color }}</td>
                            <td>{{ $workorder->sm1sides }}</td>
                            <td>{{ $workorder->sm1scale }}</td>
                            <td>{{ $workorder->sm1binding }}</td>
                            <td>{{ $workorder->sm1description }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Small format 2</th>
                            <td>{{ $workorder->sm2orig }}</td>
                            <td> {{ $workorder->sm2copy }}</td>
                            <td>{{ $workorder->sm2size }}</td>
                            <td>{{ $workorder->sm2paper }}</td>
                            <td>{{ $workorder->sm2color }}</td>
                            <td>{{ $workorder->sm2sides }}</td>
                            <td>{{ $workorder->sm2scale }}</td>
                            <td>{{ $workorder->sm2binding }}</td>
                            <td>{{ $workorder->sm2description }}</td>
                        </tr>
                    </tbody>
                </table>


                <table class="table table-bordered">

                    <tbody>
                        <div class=" text-center">
                            <h2>Large format</h2>
                        </div>

                        <tr>
                            <th scope="row">Small Format</th>
                            <td>{{ $workorder->no_small_format }}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td><b>Originals</td>
                            <td><b>Copies</td>
                            <td><b>Size</td>
                            <td><b>Colorsides</td>
                            <td><b>Scale</td>
                            <td><b>Binding</td>
                            <td><b>Description</td>
                        <tr>
                        <tr>
                            <th scope="row">Large format 1</th>
                            <td>{{ $workorder->lg1orig }}</td>
                            <td>{{ $workorder->lg1copy }}</td>
                            <td>{{ $workorder->lg1size }}</td>
                            <td> {{ $workorder->lg1colorsides }}</td>
                            <td>{{ $workorder->lg1scale }}</td>
                            <td>{{ $workorder->lg1binding }}</td>
                            <td> {{ $workorder->lg1description }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Large format 2</th>
                            <td>{{ $workorder->lg2orig }}</td>
                            <td> {{ $workorder->lg2copy }}</td>
                            <td>{{ $workorder->lg2size }}</td>
                            <td> {{ $workorder->lg2colorsides }}</td>
                            <td>{{ $workorder->lg2scale }}</td>
                            <td>{{ $workorder->lg2binding }}</td>
                            <td> {{ $workorder->lg2description }}</td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <tbody>
                        <div class=" text-center">
                            <h2>Turnaround</h2>
                        </div>

                        <tr>
                            <th scope="row">Turnaround</th>
                            <td>{{ $workorder->turnaround }}</td>
                        </tr>

                    </tbody>
                </table>

                <table class="table table-bordered">
                    <tbody>
                        <div class=" text-center">
                            <h2>Delivery</h2>
                        </div>

                        <tr>
                            <th scope="row">Delivery</th>
                            <td>{{ $workorder->delivery }}</td>
                            <th scope="row">Alt Address</th>
                            <td>{{ $workorder->alt_address }}</td>
                        </tr>

                    </tbody>

                    <table class="table table-bordered">
                        <tbody>
                            <div class=" text-center">
                                <h2>Special Instructions</h2>
                            </div>

                            <tr>
                                <th scope="row">Special Instructions</th>
                                <td>{{ $workorder->specialinstructions }}</td>
                            </tr>

                        </tbody>

                    </table>
                    <table class="table table-bordered">
                        <tbody>
                            <div class=" text-center">
                                <h2>Attached Files</h2>
                            </div>
                            <tr class="text-start">
                                <td scope="row">{{$file['title']}}</td>
                                <td><a href="{{ $file['url'] }}" target="_blank">Download</a></td>
                            </tr>
                        </tbody>

                    </table>
                    <div class="my-5">
                        <a href="{{url('/workorders')}}" class="btn btn-success">Back to Orders</a>
                    </div>
                    @endsection