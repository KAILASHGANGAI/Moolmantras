@extends('../layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Staffs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Staffs</a></li>
                        <li class="breadcrumb-item active">edit</li>
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
                    <form id="quickForm" method="post" action="{{ route('staff.update', $staff->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <h1 class="card-title text-primary">Personal Details</h1> <br>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Full name"
                                        value="{{ $staff->name ?? old('name') }}">
                                    @error('name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone Number"
                                        value="{{ $staff->phone ?? old('phone') }}">
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
                                            <option value="" selected disabled>Select Provisions</option>
                                            @foreach ($provisions as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ isset($staff) && $staff->provision_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->provision_name }}
                                                </option>
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
                                            style="width: 100%;" value="{{ $staff->district_id ?? old('district_id') }}">
                                            <option value="" selected disabled>Select District</option>
                                            @foreach ($districts as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ isset($staff) && $staff->district_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->districts_name }}
                                                </option>
                                            @endforeach

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
                                            value="{{ $staff->gaupalika_id ?? old('gaupalika_id') }}" style="width: 100%;">
                                            <option value="" selected disabled>Select Gaupalika</option>
                                            @foreach ($gaupalikas as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ isset($staff) && $staff->gaupalika_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->gaupalika_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('gaupalika_id')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Ward No.:</label>
                                    <input type="number" name="ward_no" class="form-control" placeholder="Ward No."
                                        value="{{ $staff->ward_no ?? old('ward_no') }}">
                                    @error('ward_no')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="">
                                        <label>Gender</label>
                                        <select class="form-control select2" name="gender" style="width: 100%;"
                                            value="{{ $staff->gender ?? old('gender') }}">
                                            <option selected="selected">Select Gender </option>
                                            <option {{ isset($staff) && $staff->gender == 'male' ? 'selected' : '' }}
                                                value="male">Male</option>
                                            <option {{ isset($staff) && $staff->gender == 'female' ? 'selected' : '' }}
                                                value=female>Female</option>
                                            <option {{ isset($staff) && $staff->gender == 'others' ? 'selected' : '' }}
                                                value="others">Others</option>

                                        </select>
                                        @error('gender')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Photo:</label> <br>
                                    <input type="file" name="photo" />
                                    <img src="{{ asset($staff->photo) }}" height="50" width="50" class="img-fluid"
                                        alt="">
                                    @error('photo')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">CitizenShip Number:</label>
                                    <input type="text" class="form-control" name="citizenship_no"
                                        value="{{ $staff->citizenship_no ?? old('citizenship_no') }}" />
                                    @error('citizenship_no')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>  
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="radio" name="status" value="0"
                                            @if ($item->status == 0) {{ 'checked' }} @endif checked>
                                        <label>Inactive</label>
                                        <input type="radio" name="status" value="1"
                                            @if ($item->status == 0) {{ 'checked' }} @endif>
                                        <label>active</label>
                                    </div>
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
            var selectedDistrictId = $('#districtOptions').val(); // Get the currently selected district ID

            $.ajax({
                url: "/get-districts/" + value,
                method: "GET",
                success: function(response) {
                    $('#districtOptions').html(""); // Clear existing options

                    if ($.trim(response)) {
                        // Assuming response is an array of options
                        $.each(response, function(index, option) {
                            var optionElement = $('<option>', {
                                value: option.id,
                                text: option.districts_name
                            });

                            // Set the selected attribute if the district ID matches the selectedDistrictId
                            if (selectedDistrictId == option.id) {
                                optionElement.attr('selected', 'selected');
                            }

                            $('#districtOptions').append(optionElement);
                        });
                    }
                }
            });
        }

        function fetchGaupalika(e) {
            var value = e.target.value;
            var selectedGaupalikaId = $('#gaupalikaOptions').val(); // Get the currently selected Gaupalika ID

            $.ajax({
                url: "/get-gaupalaika/" + value,
                method: "GET",
                success: function(response) {
                    $('#gaupalikaOptions').html(""); // Clear existing options

                    if ($.trim(response)) {
                        // Assuming response is an array of options
                        $.each(response, function(index, option) {
                            var optionElement = $('<option>', {
                                value: option.id,
                                text: option.gaupalika_name
                            });

                            // Set the selected attribute if the Gaupalika ID matches the selectedGaupalikaId
                            if (selectedGaupalikaId == option.id) {
                                optionElement.attr('selected', 'selected');
                            }

                            $('#gaupalikaOptions').append(optionElement);
                        });
                    }
                }
            });
        }
    </script>
@endsection
