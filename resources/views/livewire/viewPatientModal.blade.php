<div class="modal fade" wire:ignore.self id="viewPatientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div role="document" class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- START HEADER -->
            <div class="modal-header row d-flex justify-content-between mx-1 mx-sm-3 mb-0 pb-0 border-0">
                <div class=" col tabs active firsttab" id="tab01">
                    <h6 class="font-weight-bold ">Personal Information</h6>
                </div>
                <div class="col tabs " id="tab02">
                    <h6 class="text-muted">Background Information</h6>
                </div>
                <div class="col tabs" id="tab03">
                    <h6 class="text-muted">Health Maintenance Organization</h6>
                </div>
                <div class="col tabs" id="tab04">
                    <h6 class="text-muted">Medical Information</h6>
                </div>
                <div class="col tabs" id="tab05">
                    <h6 class="text-muted">Hospital Information</h6>
                </div>
                <div class="col float-right text-right">
                    <button type="button" class="btn-close"  aria-label="Close" id="closeReset" onclick="resetInput()"></button>
                </div>
            </div>
            <!-- END HEADER -->
            <div class="line"></div>
            <form action="update" method="POST" >
                @csrf
            <!-- START MODAL BODY -->
            
                <div class="modal-body">
                    <!-- START PERSONAL INFORMATION -->
                    <fieldset id="tab011" class="show">
                        <div class="row">
                            <div class="col-sm-2 ">
                                <div class="col pb-4">
                                    <img src="img/profile.png" alt="" class="profile-pic mx-auto">
                                </div>
                                <div class="w-100"></div>
                                <div class="col"></div>
                                <div class="w-100"></div>
                                <div class="w-100"></div>
                                <div class="col">
                                    <label>Master Patient Index {{'MPI'}}</label>
                                    <input type="text" class="form-control no-bg" name="CODE" id="CODE" readonly>
                                </div>
                            </div>
                            <div class="col-md">
                                @if(Session::has('message'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                @endif
                                <h3>Personal Information</h3>
                                <div class="row">
                                    <div class="col pr-1-cust">
                                        <label>Last Name</label>
                                        <input type="text"  class="form-control" name="U_LASTNAME" id="U_LASTNAME" readonly required>
                                        {{-- @error('lastName') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                    </div>
                                    <div class="col pr-1-cust">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="U_FIRSTNAME" id="U_FIRSTNAME" readonly  required>
                                        {{-- {{$firstName}} --}}
                                        {{-- @error('U_FIRSTNAME') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                    </div>
                                    <div class="col-sm pr-1-cust">
                                        <label>Middle Name</label>
                                        <input type="text"  class="form-control" name="U_MIDDLENAME" id="U_MIDDLENAME"  >
                                        {{-- @error('middleName') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                    </div>
                                    <div class="col-sm-2 pr-1-cust">
                                        <label>Ext.</label>
                                        <input type="text" name="extensionName" id="extensionName"class="form-control">
                                        {{-- @error('extensionName') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                    </div>
                    
                                    <div class="w-100"></div>
                                    <div class="col pr-1-cust">
                                        <label>Birthdate</label>
                                        <input type="text" class="form-control datepicker" name="U_BIRTHDATE"id="bday1"  placeholder="mm/dd/yyyy">
                                        {{-- @error('birthDate') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                    </div>
                                    <div class="col pr-1-cust">
                                        <label>Age</label>
                                        <input type="text" class="form-control" id="age" name="age" readonly>
                                        @error('age') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="pr-1-cust col">
                                        <label>Sex</label>
                                        <select name="updatesex" id="updatesex" class="form-control">
                                            {{-- <option value="" selected></option> --}}

                                                    @foreach ($get_genderList as $sex)
                                                        <option value="{{$sex->sexCode}}">
                                                            {{$sex->sex}}
                                                        </option>
                                                    @endforeach
                                        </select>
                                        {{-- @error('sex') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                    </div>
                                    <div class="pr-1-cust col">
                                        <label>Civil Status</label>
                                        <select name="U_CIVILSTATUS"  id="U_CIVILSTATUS" class="form-control" >
                                            {{-- <option value="" selected></option> --}}
                                            {{-- <option value="{{$U_CIVILSTATUS}}"selected>{{$U_CIVILSTATUS}}</option> --}}
                                            <option value="MARRIED">Married</option>
                                            <option value="SINGLE">Single</option>
                                            <option value="WIDOWED">Widowed</option>
                                            <option value="ANNULLED">Annulled</option>
                                            <option value="DIVORCED">Divorced</option>
                                            <option value="SEPARATED">Separated</option>
                                            <option value="CHILD">Child</option>
                                        </select>
                                    </div>
                                    
                                    
                                    <div class="pr-1-cust col">
                                        <label>Place of Birth</label>
                                        <input type="text" class="form-control" name="U_BIRTHPLACE" id="U_BIRTHPLACE">
                                        {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                    </div>
                                    
                                    <div class="pr-1-cust col">
                                        <label>Nationality</label>
                                        <select class="form-control"  name="U_NATIONALITY" id="U_NATIONALITY">
                                            <option value="" selected></option>
                                            @foreach ($nationalities as $nation)
                                                <option value="{{$nation->Nationality}}">{{$nation->Nationality}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="w-100"></div> --}}
                                    <div class="pr-1-cust col">
                                        <label>Religion</label>
                                        <input type="text" class="form-control" name="U_RELIGION" id="U_RELIGION">
                                        {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                    </div>
                                    
                                    <div class="pr-1-cust col">
                                        <label>Occupation</label>
                                        <input type="text"class="form-control"  name="U_OCCUPATION" id="U_OCCUPATION">
                                        {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                    </div>
                                </div>
                                <div class="row">
                                        <h3>Address</h3>
                                            <div class="w-100"></div>
                                            <div class="col pr-1">
                                                <label>Street</label>
                                                <input type="text"class="form-control" id="street" name="street">
                                            </div>
                                            <div class="col px-1" >
                                                <label>Country</label>
                                                <select  name="country" id="regCountryUpdate"  placeholder="Search"  class="form-control" style="width: 100%;">   
                                                    <option id="getCountry" selected></option>
                                                        @foreach ($get_Country as $country)
                                                        <option value="{{$country->country}}">{{$country->country}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col px-1">
                                                <label>Province</label>
                                                <select name="province" id="regProvinceUpdate" class="form-control" placeholder="Search" style="width: 100%;">
                                                    <option value="" id="getProvince" selected></option> 
                                                </select>
                                            </div>
                                            <div class="col px-1">
                                                <label>Municipality</label>
                                                            <select name="municipality1" id="regMunicipalityUpdate" class="form-control" placeholder="Search" style="width: 100%;">
                                                                <option id="getCity"></option>
                                                            </select>
                                            </div>
                                            <div class="col px-1">
                                                <label>Barangay</label>
                                                            <select name="brgy1" id="regBarangayUpdate"  class="form-control" placeholder="Search" style="width: 100%;">
                                                                <option id="getBrgy"></option>
                                                            </select>
                                            </div>

                                            <div class="col-sm-1 px-1">
                                                <label>Zip Code</label>
                                                <input type="text" class="form-control" name="postal" id="regPostalUpdate" >
                                            </div>                          
                                
                                {{-- ADDRESS --}}
                                    
                            </div>
                            {{-- END ADDRESS --}}
                            
                            {{-- <hr> --}}
                        </div>
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col">
                                <hr>
                                <div class="row">
                                    {{-- FIRST CONTACT --}}
                                    <input type="number" class="" name="countContactUpdate" id="countContactUpdate">
                                    <div class="col">
                                        <h5 class="dis-inline">Contact Information</h5>
                                        <span class="dis-inline ml-3" id="addaContactUpdate"><img src="icon/plus.png" alt="" class="iconPlus"></span>
                                        <span class="dis-inline ml-3" id="removeaContactUpdate"><img src="icon/minus.png" alt="" class="iconPlus"></span>
                                    </div>
                                    <div class="w-100"></div>
                                    
                                    <div class="w-100"></div>
                                    <div class="col colsUpdate1 hidden">
                                        <label for="contactType1">Contact Type</label>
                                        <select name="contactType1" id="contactType1" class="form-control" >
                                        <option value="" selected></option> 
                                            <option value="HOME">Home {{'(Telephone)'}}</option>
                                            <option value="WORK">Work </option>
                                            <option value="PERSONAL">Personal {{'(Mobile)'}} </option>
                                        </select>
                                        <input type="text" class="hidden" id="hideContact1" name="hideContact1">
                                    </div>
                                    
                                
                                    <div class="col colsUpdate1 hidden">
                                        <label>Contact Number</label>
                                        <input type="text"class="form-control" name="contact1" id="contact1" >
                                    </div>
                                    <div class="col colsUpdate1 hidden">
                                    <label for="noteContact1">Note:</label>
                                    <input type="text"class="form-control"  name="noteContact1" id="noteContact1">
                                </div>

                                    {{-- END FIRST CONTACT --}}
                                    <div class="w-100"></div>      
                                    {{-- START 2ND CONTACT --}}
                                    <div class="col colsUpdate2 hidden">
                                    <label for="contactType2">Label</label>
                                    <select name="contactType2" id="contactType2" class="form-control" >
                                        <option value="" selected></option> 
                                        <option value="HOME">Home {{'(Telephone)'}}</option>
                                            <option value="WORK">Work </option>
                                            <option value="PERSONAL">Personal {{'(Mobile)'}} </option>
                                    </select>
                                    <input type="text" class="hidden" id="hideContact2" name="hideContact2">
                                </div>
                                <div class="col colsUpdate2 hidden">
                                    <label>Contact Number</label>
                                    <input type="text" class="form-control" name="contact2" id="contact2">
                                </div>
                                <div class="col colsUpdate2 hidden">
                                    <label for="noteContact2">Note:</label>
                                    <input type="text"class="form-control"  name="noteContact2" id="noteContact2">
                                </div>
                                <div class="w-100"></div>                                
                                    {{-- END 2ND CONTACT --}}
                                    {{-- START 3RD CONTACT --}}
                                    <div class="col colsUpdate3 hidden">
                                        <label for="contactType3 ">Label</label>
                                        <select name="contactType3" id="contactType3" class="form-control" >
                                        <option value="" selected></option> 
                                            <option value="HOME">Home {{'(Telephone)'}}</option>
                                            <option value="WORK">Work </option>
                                            <option value="PERSONAL">Personal {{'(Mobile)'}} </option>
                                        </select>
                                        <input type="text" class="hidden" id="hideContact3" name="hideContact3">
                                    </div>
                                    <div class="col colsUpdate3 hidden" id=""  >
                                        <label>Contact Number</label>
                                        <input type="text" class="form-control" name="contact3" id="contact3">
                                    </div>
                                    <div class="col colsUpdate3 hidden">
                                    <label for="noteContact3">Note:</label>
                                    <input type="text"class="form-control"  name="noteContact3" id="noteContact3">
                                </div>
                                    <div class="w-100"></div>      
                                    {{-- start 4th contact --}}

                                    <div class="col colsUpdate4 hidden" id="">
                                        <label for="contactType4">Label</label>
                                        <select name="contactType4" id="contactType4" class="form-control">
                                            <option value="" selected></option> 
                                            <option value="HOME">Home {{'(Telephone)'}}</option>
                                                <option value="WORK">Work </option>
                                                <option value="PERSONAL">Personal {{'(Mobile)'}} </option>
                                        </select>
                                    <input type="text" class="hidden" id="hideContact4" name="hideContact4">
                                 </div>
                                    <div class="col colsUpdate4 hidden" id=""  >
                                    <label>Contact Number</label>
                                    <input type="text" class="form-control" name="contact4" id="contact4" >
                                </div>
                                <div class="col colsUpdate4 hidden">
                                    <label for="noteContact4">Note:</label>
                                    <input type="text"class="form-control"  name="noteContact4" id="noteContact4">
                                </div>
                                <div class="w-100"></div>
                                    <div class="col-md">
                                    <label>Email Address</label>
                                    <input type="text"class="form-control w-50" name="email">
                                    {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <!-- END PERSONAL INFORMATION -->

                    <!-- START BACKGROUND INFORMATION -->
                    <fieldset class="p-3" id="tab021" >
                             <!-- {{-- FATHER'S INFORMATION --}} -->
                        <div class="row">
                            <div class="col">
                                <h5>Father's Information</h5>
                            </div>
                            <div class="col">
                                <label for="sameFatherAddress">Same As Patient</label>
                                <input type="checkbox" name="sameFatherAddress" id="sameFatherAddress">
                            </div>
                            <div class="w-100"></div>
                            <div class="col pr-1-cust" >
                                <label>Last Name</label>
                                <input type="text" class="form-control"  name="fatherLastName"   id="fatherLastName" placeholder="Last Name">
                            </div>
                            <div class="col pr-1-cust">
                                <label>First Name</label>
                                <input type="text"class="form-control" name="fatherFirstName" id="fatherFirstName" placeholder="First Name">
                            </div>
                            <div class="col pr-1-cust">
                                <label>Middle Name</label>
                                <input type="text"class="form-control" name="fatherMiddleName" id="fatherMiddleName"  placeholder="Middle Name">
                            </div>
                            <div class="col-sm-1">
                                <label>Ext</label>
                                <input type="text"class="form-control" name="fatherExtName" id="fatherMiddleName"  placeholder="Extension">
                            </div>
                            <div class="col-sm-2">
                                <label>Contact Number</label>
                                <input type="text"class="form-control" name="fatherContactNo" id="fatherContactNo"  placeholder="Contact No.">
                            </div>
                            {{-- <div class="w-100"></div> --}}
                            <div class="col-sm-1">
                                <label>House No.</label>
                                <input type="text"class="form-control" id="fatherHouseNo" name="fatherHouseNo" placeholder="House No">
                            </div>
                            <div class="col-sm-2">
                                <label>Street</label>
                                <input type="text"class="form-control" id="fatherStreet" name="fatherStreet"  placeholder="Street">
                            </div>
                            <div class="w-100"></div>

                            <div class="col">
                                <label>Country</label>
                                <select name="fathersCountry" id="regFathersCountry" class="form-control" placeholder="Search" style="width: 100%;">
                                    {{-- <option selected value=""></option> --}}
                                    <option value="" selected></option>
                                    {{-- <option value=""></option> --}}
                                    {{-- <option value="{{$country1}}">{{$country1}}</option> --}}
                                    @foreach ($get_Country as $country)
                                        
                                            <option value="{{$country->country}}">{{$country->country}}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label>Province</label>
                                <select name="fathersProvince" id="regFathersProvince" class="form-control" placeholder="Search" style="width: 100%;">
                                    {{-- <option value="{{$province1}}" selected>{{$province1}}</option> --}}
                                    <option value="" selected id="getFathersProvince"></option>
                                    
                                </select>
                            </div>
                        
                            <div class="col">
                                <label>Municipality</label>
                                            <select name="fathersMunicipality" id="regfathersMunicipality" class="form-control" placeholder="Search" style="width: 100%;">
                                                {{-- <option value="{{$municipality1}}" selected>{{$municipality1}}</option> --}}
                                                <option selected value="" id="getFathersMunicipality"></option>
                                            </select>
                            </div>
                            <div class="col">
                                <label>Barangay</label>
                                            <select name="fathersBrgy" id="regFathersBarangay" class="form-control" placeholder="Search" style="width: 100%;">
                                                    <option selected value="" id="getFathersBrgy"></option>
                                                {{-- <option value="{{$brgy}}" selected></option> --}}
                                            </select>
                            </div>
                            <div class="col-sm-2">
                                <label>Postal Code</label>
                                <input type="text"class="form-control" name="fathersPostal" id="regFathersPostal">
                                {{-- <select disable name="postal" id="regPostal" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full empty" placeholder="Search" style="width: 100%; height: 100%;">
                                    <option value=""></option>
                                </select> --}}
                            </div>                    
                        </div>
                        <hr>

                            <!-- {{-- MOTHER'S INFORMATION --}} -->
                        <div class="row">
                            <div class="col">
                                <h5>Mother's Information</h5>
                            </div>
                            <div class="col">
                                <label for="sameMotherAddress">Same As Patient</label>
                                <input type="checkbox" name="sameMotherAddress" id="sameMotherAddress">
                            </div>
                            <div class="w-100"> </div>
                            <div class="col pr-1-cust">
                                <label>Last Name</label>
                                <input type="text"class="form-control" name="motherLastName" id="motherLastName" placeholder="Last Name">
                            </div>
                            <div class="col pr-1-cust">
                                <label>First Name</label>
                                <input type="text"class="form-control" name="motherFirstName" id="motherFirstName" placeholder="First Name">
                            </div>
                            <div class="col pr-1-cust">
                                <label>Middle Name</label>
                                <input type="text"class="form-control" name="motherMiddleName" id="motherMiddleName" placeholder="Middle Name">
                            </div>
                            <div class="col-sm-1">
                                <label>Ext</label>
                                <input type="text"class="form-control" name="motherExtName" id="motherExtName" placeholder="Extension">
                            </div>
                            <div class="col-sm-2">
                                <label>Contact Number</label>
                                <input type="text"class="form-control" name="motherContactNo" id="motherContactNo" placeholder="Contact No.">
                            </div>
                            {{-- <div class="w-100"></div> --}}
                            <div class="col-sm-1">
                                <label>House No.</label>
                                <input type="text"class="form-control" id="motherHouseNo" name="motherHouseNo"  placeholder="House No">
                            </div>
                            <div class="col-sm-2">
                                <label>Street</label>
                                <input type="text"class="form-control" id="motherStreet" name="motherStreet"  placeholder="Street">
                            </div>
                            <div class="w-100"></div>

                            <div class="col">
                                <label>Country</label>
                                <select name="mothersCountry" id="regMothersCountry" class="form-control" placeholder="Search" style="width: 100%;">
                                    <option value="" selected></option>
                                    @foreach ($get_Country as $country)
                                        {{-- @if($country->country!=null)
                                            <option selected value=""></option>
                                        @else --}}
                                            <option value="{{$country->country}}">{{$country->country}}</option>
                                        {{-- @endif --}}
                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label>Province</label>
                                <select name="mothersProvince" id="regMothersProvince" class="form-control" placeholder="Search" style="width: 100%;">
                                        <option selected value="" id="getMotherProvince"></option>
                                    
                                </select>
                            </div>
                        
                            <div class="col">
                                <label>Municipality</label>
                                            <select name="mothersMunicipality" id="regMothersMunicipality" class="form-control" placeholder="Search" style="width: 100%;">
                                                <option selected value="" id="getMotherCity"></option>
                                            </select>
                            </div>
                            <div class="col">
                                <label>Barangay</label>
                                            <select name="mothersBrgy" id="regMothersBarangay" class="form-control" placeholder="Search" style="width: 100%;">
                                                <option selected value="" id="getMotherBrgy"></option>
                                            </select>
                            </div>
                            <div class="col-sm-2">
                                <label>Postal Code</label>
                                <input type="text"class="form-control" name="mothersPostal" id="regmothersPostal">
                                {{-- <select disable name="postal" id="regPostal" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full empty" placeholder="Search" style="width: 100%; height: 100%;">
                                    <option value=""></option>
                                </select> --}}
                            </div>
                            <div class="w-100"></div>
                        </div>
                        <hr>
                            <!-- {{-- SPOUSE'S INFORMATION --}} -->
                        <div class="row">
                            <div class="col">
                                <h5>Spouse's Information</h5>
                            </div>
                            <div class="col">
                                <label for="sameSpouseAddress">Same As Patient</label>
                                <input type="checkbox" name="sameSpouseAddress" id="sameSpouseAddress">
                            </div>
                            <div class="w-100"> </div>
                            <div class="col pr-1-cust">
                                <label>Last Name</label>
                                <input type="text"class="form-control" name="spouseLastName" id="spouseLastName" placeholder="Last Name">
                            </div>
                            <div class="col pr-1-cust">
                                <label>First Name</label>
                                <input type="text"class="form-control" name="spouseFirstName" id="spouseFirstName" placeholder="First Name">
                            </div>
                            <div class="col pr-1-cust">
                                <label>Middle Name</label>
                                <input type="text"class="form-control" name="spouseMiddleName" id="spouseMiddleName" placeholder="Middle Name">
                            </div>
                            <div class="col-sm-1">
                                <label>Ext</label>
                                <input type="text"class="form-control" name="spouseExtName" id="spouseExtName" placeholder="Extension">
                            </div>
                            <div class="col-sm-2">
                                <label>Contact Number</label>
                                <input type="text"class="form-control" name="spouseContactNo" placeholder="Contact No.">
                            </div>
                            {{-- <div class="w-100"></div> --}}
                            <div class="col-sm-1">
                                <label>House No.</label>
                                <input type="text"class="form-control" id="spouseHouseNo" name="spouseHouseNo"  placeholder="House No">
                            </div>
                            <div class="col-sm-2">
                                <label>Street</label>
                                <input type="text"class="form-control" id="spouseStreet" name="spouseStreet"  placeholder="Street">
                            </div>
                            <div class="w-100"></div>

                            <div class="col">
                                <label>Country</label>
                                <select name="spousesCountry" id="regSpousesCountry" class="form-control" placeholder="Search" style="width: 100%;">
                                    {{-- <option value="{{$country1}}" selected>{{$country1}}</option> --}}
                                    <option value="" selected></option>
                                    @foreach ($get_Country as $country)
                                        {{-- @if($country->country!=null)
                                            <option selected value=""></option>
                                        @else --}}
                                            <option value="{{$country->country}}">{{$country->country}}</option>
                                        {{-- @endif --}}
                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label>Province</label>
                                <select name="spousesProvince" id="regSpousesProvince" class="form-control" placeholder="Search" style="width: 100%;">
                                    {{-- <option value="{{$province1}}" selected>{{$province1}}</option> --}}
                                        <option selected value="" id="getSpouseProvince"></option>
                                    
                                </select>
                            </div>
                        
                            <div class="col">
                                <label>Municipality</label>
                                            <select name="spousesMunicipality" id="regSpousesMunicipality" class="form-control" placeholder="Search" style="width: 100%;">
                                                {{-- <option value="{{$municipality1}}" selected></option> --}}
                                                <option selected value="" id="getSpouseCity"></option>
                                            </select>
                            </div>
                            <div class="col">
                                <label>Barangay</label>
                                            <select name="spousesBrgy" id="regSpousesBarangay" class="form-control" placeholder="Search" style="width: 100%;">
                                                {{-- <option value="{{$brgy}}" selected>{{$brgy}}</option> --}}
                                                <option selected value="" id="getSpouseBrgy"></option>
                                            </select>
                            </div>
                            <div class="col-sm-2">
                                <label>Postal Code</label>
                                <input type="text"class="form-control" name="spousesPostal" id="regSpousesPostal">
                                {{-- <select disable name="postal" id="regPostal" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full empty" placeholder="Search" style="width: 100%; height: 100%;">
                                    <option value=""></option>
                                </select> --}}
                            </div>
                            <div class="w-100"></div>      
                        </div>
                    </fieldset>
                    <!-- END BACKGROUND INFORMATION -->
                    <!-- START HMO -->
                    <fieldset id="tab031">
                        <div class="row">

                            {{-- FIRST PROVIDER --}}
                            <h5>Provider</h5>
                            <div class="col">
                                <label for="providerName">Health Care Provider Name:</label>
                                {{-- <div class="w-100"></div> --}}
                                
                                <select name="providerName" id="providerName" class="form-control" >
                                    <option value="">{{'Select HMO'}}</option>
                                @foreach ($insCode as $provider)
                                    <option value="{{$provider->U_INSNAME}}">{{$provider->U_INSNAME}}</option> 
                                @endforeach
                            </select>
                            </div>
                            <div class="col">
                                <label for="memberID">ID/Account No.</label>
                                <input type="text" name="memberID" class="form-control">
                            </div>
                            <div class="col">
                                <label for="relationMem">Client Type</label>
                                <select name="relationMem" id="relationMem" class="form-control">
                                    <option value="">Select Relation</option>
                                    <option value="Member">Member</option>
                                    <option value="Dependent">Dependent</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="insMemType">Member Type</label>
                                <select name="insMemType" id="insMemTypeID" class="form-control" >
                                    <option value="">{{'Select Member Type'}}</option>
                                @foreach ($memType as $type)
                                    <option value="{{$type->NAME}}">{{$type->NAME}}</option> 
                                @endforeach
                                </select>
                            </div>
                            <div class="w-100"></div>
                            <div class="col">
                                <label for="memberLname">Member Last Name</label>
                                <input type="text" name="memberLname" class="form-control" id="memberLname">
                            </div>
                            <div class="col">
                                <label for="memberfname">Member First Name</label>
                                <input type="text" name="memberFname" class="form-control" id="memberFname">
                            </div>
                            <div class="col">
                                <label for="memberMname">Member Middle Name</label>
                                <input type="text" name="memberMname" class="form-control" id="memberMname">
                            </div>
                            <div class="col-sm-1">
                                <label for="memberEname">Ext.</label>
                                <input type="text" name="memberEname" class="form-control" id="memberEname">
                            </div>
                            <div class="col">
                                <label>Sex</label>
                                <select name="memberSex" id="memberSex" class="form-control" >
                                    
                                    <option value=""></option>
                                    @foreach ($get_genderList as $sex)
                                        <option value="{{$sex->sex}}">
                                            {{$sex->sex}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="memberBDay">Birthdate</label>
                                <input type="text" name="memberBDay" class="form-control" id="memberBDay">
                            </div>
                            
                        </div>
                        <hr>
                        <span><i id="addAnotherProvider">Add Another Provider</i></span>
                        <div class="row hidden" id="anotherProvider">

                            {{-- FIRST PROVIDER --}}
                            <h5>Provider</h5>
                            <div class="col">
                                <label for="providerName2nd">Health Care Provider Name:</label>
                                {{-- <div class="w-100"></div> --}}
                                
                                <select name="providerName2nd" id="providerName2nd" class="form-control" >
                                    <option value="">{{'Select HMO'}}</option>
                                @foreach ($insCode as $provider)
                                    <option value="{{$provider->U_INSNAME}}">{{$provider->U_INSNAME}}</option> 
                                @endforeach
                            </select>
                            </div>
                            <div class="col">
                                <label for="memberID2nd">ID/Account No.</label>
                                <input type="text" name="memberID2nd" class="form-control">
                            </div>
                            <div class="col">
                                <label for="relationMem2nd">Client Type</label>
                                <select name="relationMem2nd" id="relationMem2nd" class="form-control">
                                    <option value="">Select Relation</option>
                                    <option value="Member">Member</option>
                                    <option value="Dependent">Dependent</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="insMemType2nd">Member Type</label>
                                <select name="insMemType2nd" id="insMemTypeID2nd" class="form-control" >
                                    <option value="">{{'Select Member Type'}}</option>
                                @foreach ($memType as $type)
                                    <option value="{{$type->NAME}}">{{$type->NAME}}</option> 
                                @endforeach
                                </select>
                            </div>
                            <div class="w-100"></div>
                            <div class="col">
                                <label for="memberLname2nd">Member Last Name</label>
                                <input type="text" name="memberLname2nd" class="form-control" id="memberLname2nd">
                            </div>
                            <div class="col">
                                <label for="memberfname">Member First Name</label>
                                <input type="text" name="memberFname2nd" class="form-control" id="memberFname2nd">
                            </div>
                            <div class="col">
                                <label for="memberMname">Member Middle Name</label>
                                <input type="text" name="memberMname2nd" class="form-control" id="memberMname2nd">
                            </div>
                            <div class="col-sm-1">
                                <label for="memberEname">Ext.</label>
                                <input type="text" name="memberEname2nd" class="form-control" id="memberEname2nd">
                            </div>
                            <div class="col">
                                <label>Sex</label>
                                <select name="memberSex2nd" id="memberSex2nd" class="form-control" >
                                    <option value="" selected>
                                        {{-- @foreach ($getPatientSex as $getSex)
                                            @switch($getSex)
                                                @case("M")
                                                    {{'Male'}}
                                                    @break
                                                @case("F")
                                                    {{'Female'}}
                                                    @break
                                                @default
                                                {{'Non-Binary'}}
                                        @endswitch
                                        @endforeach --}}
                                    </option>
                                    @foreach ($get_genderList as $sex)
                                        <option value="{{$sex->sex}}">
                                            {{$sex->sex}}
                                            </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="memberBDay">Birthdate</label>
                                <input type="text" name="memberBDay2nd" class="form-control" id="memberBDay2nd">
                            </div>
                            
                        </div>
                        
                        <hr>

                        <div class="row">
                            <div class="col">
                                <h5>Personal and Social History</h5>
                            </div>
                            <div class="w-100"></div>
                            <div class="col">
                                <label for="smoker">Smoker:</label>
                                <input type="checkbox" name="smoker">
                            </div>
                            <div class="col">
                                <label for="alcoholic">Alcohol:</label>
                                <input type="checkbox" name="alcoholic">
                            </div>
                            <div class="col">
                                <label for="drugs">Illicit Drugs:</label>
                                <input type="checkbox" name="drugs">
                            </div>
                            <div class="col">
                                <label for="sexActive">Sexually Active:</label>
                                <input type="checkbox" name="sexActive">
                            </div>
                            
                            
                        </div>
                    </fieldset>
                    <!-- END HMO -->
                    <!-- START MEDICAL INFORMATION -->
                    <fieldset id="tab041">
                        <div class="row">
                            <div class="col">
                                <label for="patientHeight">Height{{'(cm)'}}:</label>
                                <input type="number" name="patientHeight" id="patientHeight" class="form-control">
                            </div>
                            <div class="col">
                                <label for="patientHeight">Height{{'(in)'}}:</label>
                                <input type="number" class="form-control">
                            </div>
                            <div class="col">
                                <label for="patientWeight">Weight{{'(kg)'}}:</label>
                                <input type="number" name="patientWeight" id="patientWeight" class="form-control">
                            </div>
                            <div class="col">
                                <label for="patientBMI">Body Mass Index{{'(BMI)'}}:</label>
                                <input type="number" name="patientBMI" id="patientBMI" class="form-control">
                            </div>
                            {{-- <div class="w-100"></div> --}}
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h5>Allergies</h5>
                            </div>
                            <div class="w-100"></div>
                            <div class="col">
                                <label for="allergy1">Allergic to:</label>
                                <input type="text" name="allergy1" id="allergy1" placeholder="Allergic to" class="form-control">
                            </div>
                            <div class="col">
                                <label for="allergy2">Allergic to:</label>
                                <input type="text" name="allergy2" id="allergy2" placeholder="Allergic to" class="form-control">
                            </div>
                            <div class="col">
                                <label for="allergy3">Allergic to:</label>
                                <input type="text" name="allergy3" id="allergy3" placeholder="Allergic to" class="form-control">
                            </div>
                            <div class="w-100"></div>
                            <div class="col hidden" id="allegyField4">
                                <label for="allergy4">Allergic to:</label>
                                <input type="text" name="allergy4" id="allergy4" placeholder="Allergic to" class="form-control w-30">
                            </div>
                            <div class="col hidden" id="allegyField5">
                                <label for="allergy5">Allergic to:</label>
                                <input type="text" name="allergy4" id="allergy5" placeholder="Allergic to" class="form-control " >
                            </div>
                            <div class="w-100"></div>
                            <div class="col">
                                <span><i class="addAnotherAllergy" id="addAnotherAllergy">Add Another Field</i></span>
                            </div>
                            <div class="w-100"></div>
                            <div class="col ">
                                <span><i class="addAnotherAllergy1 hidden" id="addAnotherAllergy1" >Add Another Field</i></span>
                            </div>
                        </div>
                    </fieldset>
                    <!-- END MEDICAL INFORMATION -->

                </div>
            <!-- END MODAL BODY -->

            <!-- START MODAL FOOTER -->
                <div class="modal-footer">
                    <button type="button"  class="btn btn-secondary"  id="closeReset"  onclick="resetInput()">Close</button>
                    <input type="text" class="" id="hiddenInput" name="hiddenCode">
                    <!-- {{-- <button type="button" class="btn btn-primary" wire:click="update('{{$CODE}}')" id="updateBtn" data-bs-dismiss="modal">Save Changes</button> --}} -->
                    <button type="submit" class="btn btn-primary"  id="submitButt">Save changes</button>
                </div>
            <!-- END MODAL FOOTER -->
            </form>
        </div>
    </div>

</div>