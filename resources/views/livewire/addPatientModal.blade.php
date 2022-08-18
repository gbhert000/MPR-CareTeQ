<div class="modal fade" wire:ignore.self id="studentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Patient Registration</h5>
                @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ 
                    Session::get('message') }}</p>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeReset1" onclick="resetInput()"></button>
            </div>
            <!-- START FORM -->
            <form action="add" method="POST">
                {{ csrf_field() }}
                {{-- <input name="_token" type="hidden" value="..."> --}}
                <!-- START MODAL BODY -->
                <div class="modal-body">
                    <div class="row">
                    <!-- START PICTURE -->
                        <div class="col-sm-2">
                            <div class="row">
                                <img src="img/profile.png" alt="" class="profile-pic mx-auto">
                            </div>
                        </div>
                    <!-- END PICTURE -->   
                   
                        <div class="col-md">
                            <h5>Personal Information</h5>

                            <!-- START PERSONAL INFORMATION -->
                            <div class="row">
                                <div class="col pr-1">
                                    <label>First Name <i id="requiredFields">*</i> </label>
                                    <input type="text" class="form-control" name="U_FIRSTNAME" id="addFirstName" autocomplete="off" required>
                                    {{-- {{$firstName}} --}}
                                    @error('U_FIRSTNAME') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col px-1">
                                    <label>Last Name <i id="requiredFields">*</i></label>
                                    <input type="text"  class="form-control" name="U_LASTNAME" id="addLastName"  autocomplete="off" required>
                                    {{-- @error('lastName') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
            
                                
                                <div class="col-sm px-1">
                                    <label>Middle Name</label>
                                    <input type="text"  class="form-control" name="U_MIDDLENAME" id="U_MIDDLENAME"  autocomplete="off">
                                    {{-- @error('middleName') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                <div class="col-sm-2  px-1">
                                    <label>Ext.</label>
                                    <input type="text"  class="form-control" autocomplete="off">
                                    {{-- @error('extensionName') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                <div class="w-100"></div>
                                <div class="col-sm-2 pr-1">
                                    <label>Birthdate <i id="requiredFields">*</i> </label>
                                    <input type="text" class="form-control datepicker1" name="U_BIRTHDATE" id="bday11" placeholder="yyyy-mm-dd" autocomplete="off" required>
                                    {{-- @error('birthDate') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                <div class="col-sm-1 px-1">
                                    <label>Age</label>
                                    <input type="text"class="form-control"  id="age1" name="age" readonly> 
                                    {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                <div class="col-sm px-1">
                                    <label>Civil Status</label>
                                    <select name="U_CIVILSTATUS" id="U_CIVILSTATUS" class="form-control" >
                                        <option value="">Select</option>
                                        <option value="Married">Married</option>
                                        <option value="Single">Single</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Annulled">Annulled</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Separated">Separated</option>
                                        <option value="Child">Child</option>
                                    </select>
                                    {{-- <input type="text"class="form-control" id="civil" name="U_CIVILSTATUS"> --}}
                                    {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                
                                <div class="col px-1">
                                    <label>Sex</label>
                                    <select name="sex" id="regSex" class="form-control"  >
                                        <option value=""></option>
                                        @foreach ($get_genderList as $sex)
                                            <option value="{{$sex->sexCode}}">
                                                {{$sex->sex}}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- @error('sex') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                {{-- <div class="w-100"></div> --}}
                                
                                <div class="col px-1">
                                    <label>Place of Birth</label>
                                    <input type="text"class="form-control" name="placeOfBirth" >
                                    {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                
                                <div class="col px-1">
                                    <label>Nationality</label>
                                    {{-- <input type="text"class="form-control" name="nationality"> --}}
                                    <select name="nationality"  class="form-control" placeholder="Search" style="width: 100%;">
                                        <OPtion></OPtion>
                                        @foreach ($nationalities as $nation)
                                                <option value="{{$nation->Nationality}}">{{$nation->Nationality}}</option>  
                                        @endforeach
                                    </select>
                                    {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                {{-- <div class="w-100"></div> --}}
                                <div class="col px-1">
                                    <label>Religion</label>
                                    <input type="text" class="form-control" name="religion">
                                    {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                
                                <div class="col ">
                                    <label>Occupation</label>
                                    <input type="text" class="form-control" name="occupation">
                                    {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>

                                
                            </div>
                            <!-- END PERSONAL INFORMATION -->
                            <!-- START ADDRESS -->
                            <div class="row">
                                <h5>Present Address</h5>

                                <div class="col pr-1">
                                    <label>Home Address</label>
                                    <input type="text"class="form-control" name="street">
                                </div>

                                <div class="col px-1 ">
                                    <label>Country</label>
                                    <select name="country1" id="regCountry" class="form-control" placeholder="Search" style="width: 100%;">
                                        <OPtion></OPtion>
                                        @foreach ($get_Country as $country)
                                            {{-- @if($country->country!=null)
                                                <option selected value=""></option>
                                            @else --}}
                                                <option value="{{$country->country}}">{{$country->country}}</option>
                                            {{-- @endif --}}
                                            
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col px-1">
                                    <label>Province</label>
                                    <select name="province" id="regProvince"class="form-control" placeholder="Search" style="width: 100%;" disabled>
                                        <option value=""></option>
                                        
                                    </select>
                                </div>
                                
                                
                                <div class="col px-1">
                                    <label>Municipality</label>
                                    <select name="municipality"  id="regMunicipality" class="form-control" placeholder="Search" style="width: 100%;" disabled>
                                        <option value=""></option>
                                    </select>
                                </div>

                                <div class="col px-1">
                                    <label>Barangay</label>
                                    <select name="brgy" id="regBarangay" class="form-control" placeholder="Search" style="width: 100%;" disabled>
                                        <option value=""></option>
                                    </select>
                                </div>
                
                                    
                                <div class="col-sm-1 px-1">
                                    <label>Zip Code</label>
                                    <input type="text"class="form-control" name="postal" id="regPostal">
                                </div>
                                <div class="w-100"></div> 
                            </div>
                            <!-- END ADDRESS -->

                            <!-- START CONTACT -->

                            <input type="number" class="" value="1" name="countContact" id="countContact">
                            <!-- START FIRST CONTACT -->
                            <div class="row">
                                <div class="col">
                                    <h5 class="dis-inline">Contact Information</h5>
                                    <span class="dis-inline ml-3" id="addaContact"><img src="icon/plus.png" alt="" class="iconPlus"></span>
                                    <span class="dis-inline ml-3" id="removeaContact"><img src="icon/minus.png" alt="" class="iconPlus"></span>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-sm-2">
                                    <label for="contactType1">Label</label>
                                    <select name="contactType1" id="contactType1" class="form-control">
                                        <option value="">Select Label</option>
                                        <option value="home">Home {{'(Telephone)'}}</option>
                                        <option value="work">Work </option>
                                        <option value="personal">Personal {{'(Mobile)'}} </option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label>Contact Number</label>
                                    <input type="text"class="form-control"  name="contact1">
                                </div>

                                <div class="col">
                                    <label for="noteContact1">Note:</label>
                                    <input type="text"class="form-control"  name="noteContact1">
                                </div>
                            </div>
                            <!-- END FIRST CONTACT -->
                            <!-- START SECOND CONTACT -->
                            <div class="row">
                                <div class="col-sm-2 cols2 hidden" id="anotherContactType2">
                                    <label for="contactType2">Label</label>
                                    <select name="contactType2" id="contactType2" class="form-control">
                                        <option value="">Select Label</option>
                                        <option value="home">Home {{'(Telephone)'}}</option>
                                        <option value="work">Work </option>
                                        <option value="personal">Personal {{'(Mobile)'}} </option>
                                    </select>
                                </div>

                                <div class="col cols2 hidden" id="anotherContact2" >
                                    <label>Contact Number</label>
                                    <input type="text" class="form-control" name="contact2">
                                </div>

                                <div class="col cols2 hidden">
                                    <label for="noteContact1">Note:</label>
                                    <input type="text"class="form-control"  name="noteContact2">
                                </div>
                            </div>
                            <!-- END SECOND CONTACT -->
                            <!-- START THIRD CONTACT -->
                            <div class="row">
                                <div class="col-sm-2 cols3 hidden" id="anotherContactType3">
                                    <label for="contactType3">Label</label>
                                    <select name="contactType3" id="contactType3" class="form-control">
                                        <option value="">Select Label</option>
                                        <option value="home">Home {{'(Telephone)'}}</option>
                                        <option value="work">Work </option>
                                        <option value="personal">Personal {{'(Mobile)'}} </option>
                                    </select>
                                </div>

                                <div class="col cols3 hidden" id="anotherContact3"  >
                                    <label>Contact Number</label>
                                    <input type="text"  class="form-control" name="contact3">
                                </div>

                                <div class="col cols3 hidden">
                                    <label for="noteContact3">Note:</label>
                                    <input type="text"class="form-control"  name="noteContact3">
                                </div>
                            </div>
                            <!-- END THIRD CONTACT -->
                            <!-- START FOURTH CONTACT -->
                            <div class="row">
                                <div class="col-sm-2 cols4 hidden" id="anotherContactType3">
                                    <label for="contactType3">Label</label>
                                    <select name="contactType3" id="contactType3" class="form-control">
                                        <option value="">Select Label</option>
                                        <option value="home">Home {{'(Telephone)'}}</option>
                                        <option value="work">Work </option>
                                        <option value="personal">Personal {{'(Mobile)'}} </option>
                                    </select>
                                </div>

                                <div class="col cols4 hidden" id="anotherContact3"  >
                                    <label>Contact Number</label>
                                    <input type="text" class="form-control" name="contact4">
                                </div>

                                <div class="col cols4 hidden">
                                    <label for="noteContact3">Note:</label>
                                    <input type="text"class="form-control"  name="noteContact3">
                                </div>
                            </div>
                            <!-- END FOURTH CONTACT -->
                            <!-- END CONTACT -->
                        </div>
                    
                    </div>
                </div>
                <!-- END MODAL BODY -->

                <!-- START FOOTER -->
                <div class="modal-footer">
            <!-- {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#confirmModal #studentModal" id="closeAdd" wire:click="resetInputFields()">Close</button> --}} -->
                    <button type="button" class="btn btn-secondary"  id="closeReset1" onclick="resetInputAdd()">Close</button>
                    <button type="submit" class="btn btn-primary" id="addPatient" >Save changes</button>
                </div>
                <!-- END FOOTER -->
            </form>
            <!-- END FORM -->
        </div>
    </div>
</div>
