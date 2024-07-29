@extends('../layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create New Customers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Customers</a></li>
                        <li class="breadcrumb-item active">add</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- /.row -->
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <form id="quickForm" method="post" action="{{ route('customer.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h1 class="card-title text-primary">Personal Details</h1> <br>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Full name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone Number"
                                        value="{{ old('phone') }}">
                                    @error('phone')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="">
                                        <label>Provision</label>
                                        <select id="getDistrictsByProvision" name="provision_id"
                                            class="form-control select2" style="width: 100%;"
                                            value="{{ old('provision_id') }}">
                                            <option selected="selected">Select Provisions</option>
                                            @foreach ($provisions as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->provision_name }}</option>
                                            @endforeach

                                        </select>
                                        @error('provision_id')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="">
                                        <label>District</label>
                                        <select id="districtOptions" name="district_id" class="form-control select2"
                                            style="width: 100%;" value="{{ old('district_id') }}">
                                            <option selected="selected">Select District</option>

                                        </select>
                                        @error('district_id')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="">
                                        <label>Gaupalika</label>
                                        <select id="gaupalikaOptions" name="gaupalika_id" class="form-control select2"
                                            value="{{ old('gaupalika_id') }}" style="width: 100%;">
                                            <option selected="selected">Select Gaupalika</option>

                                        </select>
                                        @error('gaupalika_id')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Ward No.:</label>
                                    <input type="number" name="ward_no" class="form-control" placeholder="Ward No."
                                        value="{{ old('ward_no') }}">
                                    @error('ward_no')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="">
                                        <label>Gender</label>
                                        <select class="form-control select2" name="gender" style="width: 100%;"
                                            value="{{ old('gender') }}">
                                            <option selected="selected">Select Gender </option>
                                            <option value="male">Male</option>
                                            <option value=female>Female</option>
                                            <option value="others">Others</option>

                                        </select>
                                        @error('gender')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Amount Of Lottery:</label>
                                    <input type="number" name="lottery_amount" class="form-control" placeholder="Amount."
                                        value="{{ old('lottery_amount') }}">
                                    @error('lottery_amount')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Photo:</label> <br>
                                    <input type="file" name="photo" />
                                    @error('photo')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">CitizenShip Number:</label>
                                    <input type="text" class="form-control" name="citizenship_no"
                                        value="{{ old('citizenship_no') }}" />
                                    @error('citizenship_no')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <h1 class="card-title text-success">Employment Details</h1> <br>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>Occupation</label>
                                    <input type="text" name="occupation" class="form-control"
                                        placeholder="Occupation" value="{{ old('occupation') }}">
                                    @error('occupation')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Monthly Salary</label>
                                    <input type="text" name="salary" name="text" class="form-control"
                                        placeholder="monthly salary in NRS" value="{{ old('salary') }}">
                                    @error('salary')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Working Location</label>
                                    <input type="text" name="wlocation" class="form-control"
                                        placeholder="working location" value="{{ old('wlocation') }}">
                                    @error('wlocation')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                            <hr>
                            <h1 class="card-title text-info">Family Details</h1> <br>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>Full Father name:</label>
                                    <input type="text" name="father_name" class="form-control"
                                        placeholder="Enter Full name" value="{{ old('father_name') }}">
                                    @error('father_name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Full Mother Name:</label>
                                    <input type="text" name="mother_name" class="form-control"
                                        placeholder="Mother name" value="{{ old('mother_name') }}">
                                    @error('mother_name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>



                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Husband / Wifename:</label>
                                    <input type="text" name="hf_name" class="form-control"
                                        placeholder="husband or wife name" value="{{ old('hf_name') }}">
                                    @error('hf_name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">No.Of family members:</label>
                                    <input type="text" name="no_of_members" class="form-control"
                                        placeholder="No.Of family members" value="{{ old('no_of_members') }}">
                                    @error('no_of_members')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Refered By:</label>
                                    <input type="text" name="refered_by" class="form-control"
                                        placeholder="refered By name" value="{{ old('refered_by') }}">
                                    @error('refered_by')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Assume you have an AJAX function to fetch options
        $('#getDistrictsByProvision').on('change', fetchDistricts);
        $('#districtOptions').on('change', fetchGaupalika);

        function fetchDistricts(e) {
            var value = e.target.value;
            $.ajax({
                url: "/get-districts/" + value,
                method: "GET",
                success: function(response) {

                    $('#districtOptions').html("");
                    if ($.trim(response)) {
                        // Assuming response is an array of options
                        $.each(response, function(index, option) {
                            $('#districtOptions').append($('<option>', {
                                value: option.id,
                                text: option.districts_name
                            }));
                        });
                    }
                }
            });
        }

        function fetchGaupalika(e) {
            var value = e.target.value;
            $.ajax({
                url: "/get-gaupalaika/" + value,
                method: "GET",
                success: function(response) {

                    $('#gaupalikaOptions').html("");
                    if ($.trim(response)) {
                        // Assuming response is an array of options
                        $.each(response, function(index, option) {

                            $('#gaupalikaOptions').append($('<option>', {
                                value: option.id,
                                text: option.gaupalika_name
                            }));
                        });
                    }
                }
            });
        }
    </script>
@endsection
