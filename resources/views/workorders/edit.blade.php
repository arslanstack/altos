@extends('layouts.mainlayout')
@section('content')
<div class="container">
    <div class="card col-10 offset-1">
        <h5 class="card-header">Edit Workorder</h5>
        <div class="card-body">
            @include('layouts.messages')
            <form action="{{url('/workorders/' . $workorder->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <label for="jobname" class="form-label">Job name</label>
                        <input type="text" name="jobname" id="jobname"
                            class="form-control @error('jobname') is-invalid @enderror"
                            value={{ $workorder->jobname }}>
                        @error('jobname')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="col-sm-6">
                        <label for="jobnumber" class="form-label">jobnumber</label>
                        <input type="text" id="jobnumber" name="jobnumber" class="form-control"
                            value={{ $workorder->jobnumber }}>
                    </div>
                </div>

                <!--Large Format-->
                <div class="text-center mt-3">
                    <h2>Large format</h2>
                </div>

                <div class="row ">
                    <div class="form-check form-check-inline">
                        <!--<input class="form-check-input" type="checkbox" name="no_small_format" id="no_small_format">-->

                        <label class="form-check-label col-sm-3" for="no_small_format">Small Format</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="no_small_format" id="no_small_format_yes"
                                value="Yes" checked>
                            <label class="form-check-label" for="no_small_format_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="no_small_format" id="no_small_format_no"
                                value="No">
                            <label class="form-check-label" for="no_small_format_no">No</label>
                        </div>
                        <p style="font-size:11px">(Small Format in pdf Binders)</p>
                    </div>
                </div>

                <!--Large Format 1-->
                <div class="accordion" id="accordionPanelsStayOpenLargeFormat1">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne-Lf1" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                Large Format Item #1
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne-Lf1" class="accordion-collapse collapse">
                            <!--show-->
                            <div class="accordion-body">
                                <div class="row justify-content-md-center gx-1">

                                    <div class="col-md-1 ">
                                        <label class="form-label">Orig</label>
                                        <input type="number" min="0" name="lg1orig" value="{{ $workorder->lg1orig }}"
                                            class="form-control form-control-sm" />
                                    </div>
                                    <div class="col-md-1 ">
                                        <label class="form-label">Copies</label>
                                        <input type="number" min="0" name="lg1copy" value="{{ $workorder->lg1copy }}"
                                            class="form-control form-control-sm" />
                                    </div>
                                    <div class="col-md-2 ">
                                        <label class="form-label">Size</label>
                                        <select name="lg1size" class="form-select form-select-sm">
                                            <option selected>{{ $workorder->lg1size }}</option>
                                            <option value="12x18">12x18</option>
                                            <option value="24x36">24x36</option>
                                            <option value="30x42">30x42</option>
                                            <option value="36x48">36x48</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 ">
                                        <label class="form-label" for="typeNumber">Color</label>
                                        <select name="lg1colorsides" class="form-select form-select-sm"
                                            aria-label="Default select example">
                                            <option selected>{{ $workorder->lg1colorsides }}</option>
                                            <option value="Single Sided">Color</option>
                                            <option value="Double Sided">B/W</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label" for="typeNumber">Scale</label>
                                        <select name="lg1scale" class="form-select form-select-sm"
                                            aria-label="Default select example">
                                            <option selected>{{ $workorder->lg1scale }}</option>
                                            <option value="100%">100%</option>
                                            <option value="50%">50%</option>
                                            <option value="Fit">Fit</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 ">
                                        <label class="form-label" for="typeNumber">Binding</label>
                                        <select name="lg1binding" class="form-select form-select-sm"
                                            aria-label="Default select example">
                                            <option selected>{{ $workorder->lg1binding }}</option>
                                            <option value="bind">Bind</option>
                                            <option value="staple">Staple</option>
                                            <option value="loose">Loose</option>
                                            <option value="chicago Screw">Chicago Screw</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="visually-hidden" for="lg1description">Description</label>
                                        <div class="input-group">
                                            <div class="input-group-text">Description</div>
                                            <input type="text" class="form-control" name="lg1description"
                                                id="lg1description" placeholder="Description" max="50"
                                                class="form-control @error('lg1description') is-invalid @enderror"
                                                value={{ $workorder->sm2description }}>
                                            @error('lg1description')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!--Large Format 2-->
                <div class="accordion" id="accordionPanelsStayOpenLargeFormat2">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne-Lf2" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                Large Format Item #2
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne-Lf2" class="accordion-collapse collapse">
                            <!--show-->
                            <div class="accordion-body">
                                <div class="row justify-content-md-center gx-1">

                                    <div class="col-md-1 ">
                                        <label class="form-label">Orig</label>
                                        <input type="number" min="0" name="lg2orig" value="{{ $workorder->lg2orig }}"
                                            class="form-control form-control-sm" />
                                    </div>
                                    <div class="col-md-1 ">
                                        <label class="form-label">Copies</label>
                                        <input type="number" min="0" name="lg2copy" value="{{ $workorder->lg2copy }}"
                                            class="form-control form-control-sm" />
                                    </div>
                                    <div class="col-md-2 ">
                                        <label class="form-label">Size</label>
                                        <select name="lg2size" class="form-select form-select-sm">
                                            <option selected>{{ $workorder->lg2size }}</option>
                                            <option value="12x18">12x18</option>
                                            <option value="24x36">24x36</option>
                                            <option value="30x42">30x42</option>
                                            <option value="36x48">36x48</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 ">
                                        <label class="form-label" for="typeNumber">Color</label>
                                        <select name="lg2colorsides" class="form-select form-select-sm"
                                            aria-label="Default select example">
                                            <option selected>{{ $workorder->lg2colorsides }}</option>
                                            <option value="Single Sided">Color</option>
                                            <option value="Double Sided">B/W</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label" for="typeNumber">Scale</label>
                                        <select name="lg2scale" class="form-select form-select-sm"
                                            aria-label="Default select example">
                                            <option selected>{{ $workorder->lg2scale }}</option>
                                            <option value="100%">100%</option>
                                            <option value="50%">50%</option>
                                            <option value="Fit">Fit</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 ">
                                        <label class="form-label" for="typeNumber">Binding</label>
                                        <select name="lg2binding" class="form-select form-select-sm"
                                            aria-label="Default select example">
                                            <option selected>{{ $workorder->lg2binding }}</option>
                                            <option value="bind">Bind</option>
                                            <option value="staple">Staple</option>
                                            <option value="loose">Loose</option>
                                            <option value="chicago Screw">Chicago Screw</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="visually-hidden"
                                            for="specificSizeInputGroupUsername">Description</label>
                                        <div class="input-group">
                                            <div class="input-group-text">Description</div>
                                            <input type="text" name="lg2description" class="form-control"
                                                id="lg2description" placeholder="Description"
                                                class="form-control @error('lg2description') is-invalid @enderror"
                                                value={{ $workorder->lg2description }}>
                                            @error('lg2description')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!--small Format-->'

                <div class=" text-center">
                    <h2>Small format</h2>
                </div>


                <!--Small Format 1-->
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne-Sf1" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                Small Format Item #1
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne-Sf1" class="accordion-collapse collapse">
                            <!--show-->
                            <div class="accordion-body">
                                <div class="row justify-content-md-center gx-1">

                                    <div class="col-md-1 ">
                                        <label class="form-label">Orig</label>
                                        <input type="number" min="0" name="sm1orig" value="{{ $workorder->sm1orig }}"
                                            class="form-control form-control-sm" />
                                    </div>
                                    <div class="col-md-1 ">
                                        <label class="form-label">Copies</label>
                                        <input type="number" min="0" name="sm1copy" value="{{ $workorder->sm1copy }}"
                                            class="form-control form-control-sm" />
                                    </div>
                                    <div class="col-md-2 ">
                                        <label class="form-label" for="sm1size">Size</label>
                                        <select name="sm1size" class="form-select form-select-sm"
                                            aria-label="sm1size">
                                            <option selected>{{ $workorder->sm1size }}</option>
                                            <option value="8.5x11">8.5x11</option>
                                            <option value="8.5x14">8.5x14</option>
                                            <option value="11x17">11x17</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 ">
                                        <label class="form-label" for="sm1paper">Paper</label>
                                        <select name="sm1paper" class="form-select form-select-sm"
                                            aria-label="sm1paper">
                                            <option selected>{{ $workorder->sm1paper }}</option>
                                            <option value="Standard 20lb">Standard 20lb</option>
                                            <option value="Premium 28lb">Premium 28lb</option>
                                            <option value="Cover Permit Card">Cover Permit Card</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 ">
                                        <label class="form-label" for="sm1sides">Color Sides</label>
                                        <select name="sm1sides" class="form-select form-select-sm"
                                            aria-label="sm1sides">
                                            <option selected>{{ $workorder->sm1color }}</option>
                                            <option value="Single Sided">Single Sided</option>
                                            <option value="Double Sided">Double Sided</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label" for="sm1scale">Scale</label>
                                        <select name="sm1scale" class="form-select form-select-sm"
                                            aria-label="sm1scale">
                                            <option selected>{{ $workorder->sm1scale }}</option>
                                            <option value="100%">100%</option>
                                            <option value="Fit">Fit</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 ">
                                        <label class="form-label" for="sm1binding">Binding</label>
                                        <select class="form-select form-select-sm" name="sm1binding"
                                            aria-label="sm1binding">
                                            <option selected>{{ $workorder->sm1binding }}</option>
                                            <option value="Staple">Staple</option>
                                            <option value="Loose">Loose</option>
                                            <option value="Spiral Bound">Spiral Bound</option>
                                            <option value="Binder">Binder</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="visually-hidden" for="sm1description">Description</label>
                                        <div class="input-group">
                                            <div class="input-group-text">Description</div>
                                            <input type="text" name="sm1description" id="sm1description"
                                                placeholder="Description"
                                                class="form-control @error('sm1description') is-invalid @enderror"
                                                value={{ $workorder->sm1description }}>
                                            @error('sm1description')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--Small Format 2-->
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne-Sf2" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                Small Format Item #2
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne-Sf2" class="accordion-collapse collapse">
                            <!--show-->
                            <div class="accordion-body">
                                <div class="row justify-content-md-center gx-1">

                                    <div class="col-md-1 ">
                                        <label class="form-label">Orig</label>
                                        <input type="number" min="0" name="sm2orig" value="{{ $workorder->sm2orig }}"
                                            class="form-control form-control-sm" />
                                    </div>
                                    <div class="col-md-1 ">
                                        <label class="form-label">Copies</label>
                                        <input type="number" min="0" name="sm2copy" value="{{ $workorder->sm2copy }}"
                                            class="form-control form-control-sm" />
                                    </div>
                                    <div class="col-md-2 ">
                                        <label class="form-label">Size</label>
                                        <select name="sm2size" class="form-select form-select-sm">
                                            <option selected>{{ $workorder->sm2size }}</option>
                                            <option value="8.5x11">8.5x11</option>
                                            <option value="8.5x14">8.5x14</option>
                                            <option value="11x17">11x17</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 ">
                                        <label class="form-label" for="sm2paper">Paper</label>
                                        <select name="sm2paper" class="form-select form-select-sm"
                                            aria-label="sm2paper">
                                            <option selected>{{ $workorder->sm1paper }}</option>
                                            <option value="Standard 20lb">Standard 20lb</option>
                                            <option value="Premium 28lb">Premium 28lb</option>
                                            <option value="Cover Permit Card">Cover Permit Card</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 ">
                                        <label class="form-label" for="sm2sides">Color Sides</label>
                                        <select name="sm2sides" class="form-select form-select-sm"
                                            aria-label="sm2sides">
                                            <option selected>{{ $workorder->sm1color }}</option>
                                            <option value="Single Sided">Single Sided</option>
                                            <option value="Double Sided">Double Sided</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label" for="sm2scale">Scale</label>
                                        <select name="sm2scale" class="form-select form-select-sm"
                                            aria-label="sm2scale">
                                            <option selected>{{ $workorder->sm1scale }}</option>
                                            <option value="100%">100%</option>
                                            <option value="Fit">Fit</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 ">
                                        <label class="form-label" for="typeNumber">Binding</label>
                                        <select class="form-select form-select-sm" name="sm2binding"
                                            aria-label="sm2binding">
                                            <option selected>{{ $workorder->sm2binding }}</option>
                                            <option value="Staple">Staple</option>
                                            <option value="Loose">Loose</option>
                                            <option value="Spiral Bound">Spiral Bound</option>
                                            <option value="Binder">Binder</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="visually-hidden" for="sm2description">Description</label>
                                        <div class="input-group">
                                            <div class="input-group-text">Description</div>
                                            <input type="text" class="form-control" name="sm2description"
                                                id="sm2description" placeholder="Description" max="50"
                                                class="form-control @error('sm2description') is-invalid @enderror"
                                                value={{ $workorder->sm2description }}>
                                            @error('sm2description')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!--Turnaround-->
                <div class="text-center mt-3">
                    <h2>Turnaround</h2>
                    <div class="text-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="turnaround" id="direct_Rush" value="direct_Rush"
                                {{ $workorder->turnaround == 'direct_Rush' ? 'checked' : '' }}>

                            <label class="form-check-label" for="direct_Rush">Direct Rush</label>
                            <p style="font-size:11px">(Call to verify)</p>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="turnaround" id="turnaround1hr" value="turnaround1hr"
                                {{ $workorder->turnaround == 'turnaround1hr' ? 'checked' : '' }}>

                            <label class="form-check-label" for="turnaround1hr">1 Hour Rush</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="turnaround" id="turnaround2hr" value="turnaround2hr"
                                {{ $workorder->turnaround == 'turnaround2hr' ? 'checked' : '' }}>

                            <label class="form-check-label" for="turnaround2hr">2 Hour Rush</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="turnaround" id="turnaround3hr" value="turnaround3hr"
                                {{ $workorder->turnaround == 'turnaround3hr' ? 'checked' : '' }}>

                            <label class="form-check-label" for="turnaround3hr">3 Hour Rush</label>
                        </div>
                        <div class="form-check form-check-inline"> <input class="form-check-input" type="radio" name="turnaround" id="turnaround4hr" value="turnaround4hr"
                                {{ $workorder->turnaround == 'turnaround4hr' ? 'checked' : '' }}>
                            <label class="form-check-label" for="turnaround4hr">Standrard 4 Hour Rush</label>
                            <p style="font-size:11px">(100 Pages or less)</p>
                        </div>
                    </div>

                    <!--Delivery-->
                    <div class="text-center">
                        <h2>Delivery</h2>
                        <p style="font-size:11px">(Not Included in 4 Hr Turnaround)</p>
                    </div>
                    <div class="text-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="delivery" id="Will Call" value="Will Call"
                                {{ $workorder->delivery == 'Will Call' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio1">Will Call</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="delivery" id="route_Delivery"
                                value="Route Delivery" {{ $workorder->delivery == 'route_Delivery' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio2">Route Delivery</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="delivery" id="round_trip_Pickup_and_deliver"
                                value="Round Trip Pickup and Deliver" {{ $workorder->delivery == 'round_trip_Pickup_and_deliver' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio2">Round Trip Pickup and Deliver</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="delivery" id="other" value="other"
                                data-toggle-value="alt_other" {{ $workorder->delivery == 'other' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio2">Other</label>
                        </div>
                        @error('delivery')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!--Alt Address-->
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="alt_address">Alt Address</span>
                        <input type="text" class="form-control" name="alt_address" aria-label="alt_address"
                            aria-describedby="inputGroup-sizing-sm" value={{ $workorder->alt_address }}>
                    </div>

                    <!--Special Instructions-->
                    <div class="text-center mt-4">
                        <span class="input-group-text">Special Instructions</span>
                        <textarea class="form-control" aria-label="Special Instructions" name="specialinstructions"
                            id="specialinstructions" value="specialinstructions">{{ $workorder->specialinstructions }}</textarea>
                        @error('specialinstructions')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <table class="table table-bordered">
                            <tbody>
                                <div class=" text-center">
                                    <h2>Attached Files</h2>
                                </div>
                                <tr class="text-start">
                                    <td scope="row">{{$file['title']}}</td>
                                    <td><a href="{{route('filedownload', $workorder->id)}}" target="_blank">Download</a></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>

                    <!--end container-->



                    <div class="my-5">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
            </form>
            <a href="{{url('/workorders/')}}" class="btn btn-info">Back to Orders</a>
        </div>
    </div>
</div>
@endsection