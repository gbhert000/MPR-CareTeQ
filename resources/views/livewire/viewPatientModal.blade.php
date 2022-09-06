<div>
    <div class="modal fade" wire:ignore.self id="viewPatientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
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
                        {{-- <button type="button" class="btn-close"  aria-label="Close" id="closeReset" onclick="resetInput()"></button>
                         --}}
                         <button type="button" class="btn-close" id="closeAll2"  aria-label="Close">
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
                                    <div class="row pb-4">
                                        {{-- {{public_path()}} --}}
                                        {{-- {{storage_path()}} --}}
                                        <input type="hidden" value="{{asset('myFiles/uploads')}}" id="storage">
                                        <img src="" alt="" id="patientImage" class="profile-pic mx-auto">
                                        {{-- <img src="{{ storage_path('app/uploads/') }}" alt="" id="patientImage" class="profile-pic mx-auto"> --}}
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="row">
                                        {{-- <i data-toggle="modal" data-target="#addImageModal" >Add Picture</i> --}}
                                        {{-- <i > Add Image</i> --}}
                                        <img src="icon/webcam.png" alt="" id="addingImage" class="iconImage" >
                                        {{-- <input type="button" class="btn btn-primary formc-control"> --}}
                                    </div>
                                    {{-- <br> --}}
                                    <input type="hidden" name="hiddenImage" id="hiddenImage">
                                    
                                    <div class="w-100"></div>
                                    <div class="row">
                                        <label>Master Patient Index {{'MPI'}}</label>
                                        <input type="text" class="form-control no-bg" name="CODE" id="CODE" readonly>
                                    </div>
                                    {{-- <br><br> --}}
                                    
                                    <div class="row hpidDiv">
                                        <label for="hpidUpdate">Medical Record Number {{'MRN'}}</label>
                                        <input type="text" class="form-control" name="hpidUpdate" ID="hpidUpdate" maxlength="11">
                                   </div>
                                    
                                    {{-- <br><br><br> --}}
                                    <div class="w-100"></div>
                                    <div class="row text-center mt-3"><a  id='idreport' class="btn btn-danger" >Export PDF</a>    </div>
                                </div>
                                <div class="col-md">
                                    @if(Session::has('message'))
                                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                    @endif
                                    <h3>Personal Information</h3>
                                    <div class="row">
                                        <div class="col pr-1-cust">
                                            <label>Last Name <i id="requiredFields">*</i></label>
                                            <input type="text"  class="form-control" name="U_LASTNAME" id="U_LASTNAME" readonly required>
                                            {{-- @error('lastName') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                        </div>
                                        <div class="col pr-1-cust">
                                            <label>First Name <i id="requiredFields">*</i></label>
                                            <input type="text" class="form-control" name="U_FIRSTNAME" id="U_FIRSTNAME" readonly  required>
                                            {{-- {{$firstName}} --}}
                                            {{-- @error('U_FIRSTNAME') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                        </div>
                                        <div class="col-sm pr-1-cust">
                                            <label>Middle Name<i id="requiredFields">*</i></label>
                                            <input type="text"  class="form-control" name="U_MIDDLENAME" id="U_MIDDLENAME"  >
                                            {{-- @error('middleName') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                        </div>
                                        <div class="col-sm-2 pr-1-cust">
                                            <label>Ext.</label>
                                            <input type="text" name="extensionName" id="extensionName"class="form-control">
                                            {{-- @error('extensionName') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                        </div>
                        
                                        <div class="w-100"></div>
                                        <div class="col-sm-2 pr-1-cust">
                                            <label>Birthdate<i id="requiredFields">*</i></label>
                                            <input type="text" class="form-control" name="U_BIRTHDATE"id="bday1"  placeholder="mm/dd/yyyy" readonly>
                                            {{-- @error('birthDate') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                        </div>
                                        <div class="col-sm-1 pr-1-cust">
                                            <label>Age<i id="requiredFields">*</i></label>
                                            <input type="text" class="form-control" id="age" name="age" readonly>
                                            @error('age') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="pr-1-cust col-sm-2">
                                            <label>Sex<i id="requiredFields">*</i></label>
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
                                        <div class="pr-1-cust col-sm-2">
                                            <label>Civil Status<i id="requiredFields">*</i></label>
                                            <select class="form-control"  name="U_CIVILSTATUS" id="U_CIVILSTATUS">
                                                <option value="" selected></option>
                                                @foreach ($maritals as $marital)
                                                    <option value="{{$marital->MaritalStatus}}">{{$marital->MaritalStatus}}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                        <div class="col-sm-2 px-1">
                                            <label for="idType">ID Type</label>
                                            {{-- <input type="text" class="form-control"> --}}
                                            <select name="idType" id="idTypeUpdate" class="form-control">
                                                <option value="">Select Type</option>
                                                @foreach ($idTypes as $idType)
                                                    <option value="{{$idType->name}}">{{$idType->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col px-1 ">
                                            <label for="idNumber">ID Number</label>
                                            <input type="text" class="form-control" name="idNumber" id="idNumberUpdate" placeholder="">
                                        </div>
                                        <div class="w-100"></div>
                                        
                                        <div class="pr-1-cust col">
                                            <label>Place of Birth</label>
                                            <input type="text" class="form-control" name="U_BIRTHPLACE" id="U_BIRTHPLACE">
                                            {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                        </div>
                                        {{-- <div class="w-100"></div> --}}
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
                                        
                                        {{-- <div class="w-100"></div> --}}
                                        
                                        {{-- <div class="w-100"></div> --}}
                                        <div class="pr-1-cust col">
                                            <label>Religion</label>
                                            <select class="form-control"  name="U_RELIGION" id="U_RELIGION">
                                                <option value="" selected></option>
                                                @foreach ($religions as $religion)
                                                    <option value="{{$religion->ReligionName}}">{{$religion->ReligionName}}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control" name="U_RELIGION" id="U_RELIGION"> --}}
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
                                                
                                                <div class="col" >
                                                    <label>Country<i id="requiredFields">*</i></label>
                                                    <select  name="country" id="regCountryUpdate"  placeholder="Search"  class="form-control" style="width: 100%;">   
                                                        {{-- <option id="getCountry" selected></option> --}}
                                                            @foreach ($countries as $country)
                                                            <option value="{{$country->country}}">{{$country->country}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col px-1">
                                                    <label>Province<i id="requiredFields">*</i></label>
                                                    <select name="province" id="regProvinceUpdate" class="form-control" placeholder="Search" style="width: 100%;" readonly>
                                                        {{-- <option value="" id="getProvince" selected></option>  --}}
                                                        {{-- @foreach ($getProvs as $getProv)
                                                            <option value="{{$getProv->province}}">{{$getProv->province}}</option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>

                                                
                                                <div class="col ">
                                                    <label>Municipality<i id="requiredFields">*</i></label>
                                                                <select name="municipality1" id="regMunicipalityUpdate" class="form-control" placeholder="Search" style="width: 100%;" readonly>
                                                                    {{-- <option id="getCity"></option> --}}
                                                                </select>
                                                </div>
                                                <div class="w-100"></div>
                                                <div class="col ">
                                                    <label>Barangay<i id="requiredFields">*</i></label>
                                                                <select name="brgy1" id="regBarangayUpdate"  class="form-control" placeholder="Search" style="width: 100%;" readonly>
                                                                    {{-- <option id="getBrgy"></option> --}}
                                                                </select>
                                                </div>
                                                <div class="col ">
                                                    <label>Address</label>
                                                    <input type="text"class="form-control" id="street" name="street">
                                                </div>

                                                <div class="col-sm-2 ">
                                                    <label>Zip Code<i id="requiredFields">*</i></label>
                                                    <input type="text" class="form-control" name="postal" id="regPostalUpdate" readonly >
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
                                        <input type="number" class="hidden" name="countContactUpdate" id="countContactUpdate">
                                        <div class="col">
                                            <h5 class="dis-inline">Contact Information</h5>
                                            {{-- <span class="dis-inline ml-3" id="addaContactUpdate"><img src="icon/plus.png" alt="" class="iconPlus"></span>
                                            <span class="dis-inline ml-3" id="removeaContactUpdate"><img src="icon/minus.png" alt="" class="iconPlus"></span> --}}
                                        </div>
                                        <div class="w-100"></div>
                                        
                                        <div class="w-100"></div>
                                        <div class="row  colsUpdate1 hidden">
                                            <div class="col ">
                                                <label for="contactType1">Contact Type<i id="requiredFields">*</i></label>
                                                <select name="contactType1" id="contactType1" class="form-control" >
                                                <option value="" selected>Select Type</option> 
                                                @foreach ($contTypes as $contType)
                                                    <option value="{{$contType->contacttype}}">{{$contType->contacttype}}</option>
                                                @endforeach
                                                </select>
                                                <input type="text" class="hidden" id="hideContact1" name="hideContact1">
                                            </div>
                                            
                                        
                                            <div class="col">
                                                <label>Contact Number<i id="requiredFields">*</i></label>
                                                <input type="text"class="form-control" name="contact1" id="contact1" maxlength="13" autocomplete="off" >
                                            </div>
                                            <div class="col">
                                                <label for="noteContact1">Note:</label>
                                                <input type="text"class="form-control"  name="noteContact1" id="noteContact1">
                                            </div>
                                        </div>

                                        {{-- END FIRST CONTACT --}}
                                        <div class="w-100"></div>      
                                        {{-- START 2ND CONTACT --}}
                                        <div class="row colsUpdate2 hidden mt-3">
                                            <div class="col">
                                            {{-- <label for="contactType2">Label</label> --}}
                                                <select name="contactType2" id="contactType2" class="form-control" >
                                                    <option value="" selected>Select Type</option> 
                                                    @foreach ($contTypes as $contType)
                                                        <option value="{{$contType->contacttype}}">{{$contType->contacttype}}</option>
                                                    @endforeach
                                                </select>
                                                <input type="text" class="hidden" id="hideContact2" name="hideContact2">
                                            </div>
                                            <div class="col">
                                                {{-- <label>Contact Number</label> --}}
                                                <input type="text" class="form-control" name="contact2" id="contact2" maxlength="13" autocomplete="off">
                                            </div>
                                            <div class="col">
                                                {{-- <label for="noteContact2">Note:</label> --}}
                                                <input type="text"class="form-control"  name="noteContact2" id="noteContact2">
                                            </div>
                                        </div>
                                            
                                    <div class="w-100"></div>                                
                                        {{-- END 2ND CONTACT --}}
                                        {{-- START 3RD CONTACT --}}
                                    <div class="row  colsUpdate3 mt-3 hidden ">
                                        <div class="col">
                                            {{-- <label for="contactType3 ">Label</label> --}}
                                            <select name="contactType3" id="contactType3" class="form-control" >
                                                <option value="" selected>Select Type</option> 
                                                @foreach ($contTypes as $contType)
                                                    <option value="{{$contType->contacttype}}">{{$contType->contacttype}}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" class="hidden" id="hideContact3" name="hideContact3">
                                        </div>
                                        <div class="col " id=""  >
                                            {{-- <label>Contact Number</label> --}}
                                            <input type="text" class="form-control" name="contact3" id="contact3" maxlength="13" autocomplete="off">
                                        </div>
                                        <div class="col">
                                        {{-- <label for="noteContact3">Note:</label> --}}
                                            <input type="text"class="form-control"  name="noteContact3" id="noteContact3">
                                        </div>
                                    </div>
                                        <div class="w-100"></div>      
                                        {{-- start 4th contact --}}
                                    <div class="row colsUpdate4 hidden mt-3">
                                        <div class="col  " id="">
                                            {{-- <label for="contactType4">Label</label> --}}
                                            <select name="contactType4" id="contactType4" class="form-control">
                                                <option value="" selected>Select Type</option> 
                                            @foreach ($contTypes as $contType)
                                                <option value="{{$contType->contacttype}}">{{$contType->contacttype}}</option>
                                            @endforeach
                                            </select>
                                        <input type="text" class="hidden" id="hideContact4" name="hideContact4">
                                    </div>
                                        <div class="col  " id=""  >
                                        {{-- <label>Contact Number</label> --}}
                                        <input type="text" class="form-control" name="contact4" id="contact4"maxlength="13" autocomplete="off">
                                    </div>
                                    <div class="col  ">
                                        {{-- <label for="noteContact4">Note:</label> --}}
                                        <input type="text"class="form-control"  name="noteContact4" id="noteContact4">
                                    </div>
                                </div>

                                    <div class="row">
                                        <span class=""><i class="cursor-pointer"  id="addaContactUpdate">Add Contact</i></span>
                                    </div>

                                    <input type="text" class="hidden" name="hiddenEmailCount" id="hiddenEmailCount">
                                    <!-- START FIRST EMAIL -->
                                    <div class="row emailsUpdate1 hidden mt-3" >
                                        <div class="col ">
                                            <label for="emailType1"> Email Type</label>
                                            <select name="emailType1" id="emailType1Update" class="form-control">
                                                <option value="" selected>Select Type</option>
                                                @foreach ($emailTypes as $emailType)
                                                    <option value="{{$emailType->emailtype}}">{{$emailType->emailtype}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col" >
                                            <label for="email1">Email</label>
                                            <input type="email" name="email1" id="email1Update" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label for="noteEmail1">Note</label>
                                            <input type="text" name="noteEmail1" id="noteEmail1Update" class="form-control">
                                            <input type="text" class="hidden" name="hiddenEmmailId1" id="hiddenEmailId1">
                                        </div>
                                    </div>
                            <!-- END FIRST EMAIL -->
                            <!-- START SECOND EMAIL  -->
                                    <div class="row emailsUpdate2 hidden mt-3">
                                        <div class="col">
                                        <!--  <label for="emailType2"> Email Type</label> -->
                                            <select name="emailType2" id="emailType2Update" class="form-control">
                                                <option value="" selected>Select Type</option>
                                                @foreach ($emailTypes as $emailType)
                                                    <option value="{{$emailType->emailtype}}">{{$emailType->emailtype}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col" >
                                            <!-- <label for="email2">Email</label> -->
                                            <input type="email" name="email2" id="email2Update" class="form-control">
                                        </div>
                                        <div class="col">
                                            <!-- <label for="noteEmail2">Note</label> -->
                                            <input type="text" name="noteEmail2" id="noteEmail2Update" class="form-control">
                                            <input type="text" class="hidden" name="hiddenEmmailId2" id="hiddenEmailId2">
                                        </div>
                                    </div>
                            <!-- END SECOND EMAIL -->
                            <!-- START THIRD EMAIL -->
                                    <div class="row emailsUpdate3 hidden mt-3">
                                        <div class="col">
                                            <!-- <label for="emailType3"> Email Type</label> -->
                                            <select name="emailType3" id="emailType3Update" class="form-control">
                                                <option value="" selected>Select Type</option>
                                                @foreach ($emailTypes as $emailType)
                                                    <option value="{{$emailType->emailtype}}">{{$emailType->emailtype}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col" >
                                            <!-- <label for="email3">Email</label> -->
                                            <input type="email" name="email3" id="email3Update" class="form-control">
                                        </div>
                                        <div class="col">
                                            <!-- <label for="noteEmail3">Note</label> -->
                                            <input type="text" name="noteEmail3" id="noteEmail3Update" class="form-control">
                                            <input type="text" class="hidden" name="hiddenEmmailId3" id="hiddenEmailId3">
                                        </div>
                                    </div>
                            <!-- END THIRD EMAIL -->
                            <!-- START FOURTH EMAIL -->
                                    <div class="row emailsUpdate4 hidden mt-3">
                                        <div class="col">
                                            <!-- <label for="emailType4"> Email Type</label> -->
                                            <select name="emailType4" id="emailType4Update" class="form-control">
                                                <option value="" selected>Select Type</option>
                                                @foreach ($emailTypes as $emailType)
                                                    <option value="{{$emailType->emailtype}}">{{$emailType->emailtype}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col" >
                                            <!-- <label for="email4">Email</label> -->
                                            <input type="email" name="email4" id="email4Update" class="form-control">
                                        </div>
                                        <div class="col">
                                            <!-- <label for="noteEmail4">Note</label> -->
                                            <input type="text" name="noteEmail4" id="noteEmail4Update" class="form-control">
                                            <input type="text" class="hidden" name="hiddenEmmailId4" id="hiddenEmailId4">
                                        </div>
                                    </div>
                            <!-- END FOURTH EMAIL -->
                                    <div class="row">
                                        <span class="" ><i class="cursor-pointer" id="addaEmailUpdate">Add Email</i></span> 
                                    </div>
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
                                    <label for="sameFatherAddress">Same As Patient Address</label>
                                    <input type="checkbox" name="sameFatherAddress" id="sameFatherAddress">
                                </div>
                                <div class="col">
                                    <label for="setEmergency">Set As Emergency Contact</label>
                                    <input type="checkbox" name="setEmergency" id="setEmergencyFather">
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
                                    <input type="text"class="form-control" name="fatherExtName" id="fatherExtName"  placeholder="Extension">
                                </div>
                                <div class="col-sm-2">
                                    <label>Contact Number</label>
                                    <input type="text"class="form-control" name="fatherContactNo" id="fatherContactNo"  placeholder="Contact No." maxlength="13">
                                </div>
                                {{-- <div class="w-100"></div> --}}
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
                                
                                <div class="w-100"></div>
                               
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
                                <div class="col">
                                    <label>Address</label>
                                    <input type="text"class="form-control" id="fatherStreet" name="fatherStreet"  placeholder="Address">
                                </div>
                                <div class="col-sm-2">
                                    <label>Postal Code</label>
                                    <input type="text"class="form-control" name="fathersPostal" id="regFathersPostal" readonly>
                                    {{-- <select disable name="postal" id="regPostal" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full empty" placeholder="Search" style="width: 100%; height: 100%;">
                                        <option value=""></option>
                                    </select> --}}
                                </div>                    
                            </div>
                            <hr>

                                <!-- {{-- MOTHER'S INFORMATION --}} -->
                            <div class="row">
                                <div class="col">
                                    <h5>Mother's Maiden Information</h5>
                                </div>
                                <div class="col">
                                    <label for="sameMotherAddress">Same As Patient Address</label>
                                    <input type="checkbox" name="sameMotherAddress" id="sameMotherAddress">
                                </div>
                                <div class="col">
                                    <label for="setEmergency">Set As Emergency Contact</label>
                                    <input type="checkbox" name="setEmergency" id="setEmergencyMother">
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
                                    <input type="text"class="form-control" name="motherContactNo" id="motherContactNo" placeholder="Contact No." maxlength="13">
                                </div>
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
                                {{-- <div class="w-100"></div> --}}
                                
                                <div class="w-100"></div>

                                
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
                                    <label>Address</label>
                                    <input type="text"class="form-control" id="motherStreet" name="motherStreet"  placeholder="Street">
                                </div>
                                <div class="col-sm-2">
                                    <label>Postal Code</label>
                                    <input type="text"class="form-control" name="mothersPostal" id="regmothersPostal" readonly>
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
                                    <label for="sameSpouseAddress">Same As Patient Address</label>
                                    <input type="checkbox" name="sameSpouseAddress" id="sameSpouseAddress">
                                </div>
                                <div class="col">
                                    <label for="setEmergency">Set As Emergency Contact</label>
                                    <input type="checkbox" name="setEmergency" id="setEmergencySpouse">
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
                                    <input type="text"class="form-control" name="spouseContactNo" id="spouseContactNo" placeholder="Contact No." maxlength="13">
                                </div>
                                {{-- <div class="w-100"></div> --}}
                                
                                
                                

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
                                <div class="w-100"></div>
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
                                    <label>Street</label>
                                    <input type="text"class="form-control" id="spouseStreet" name="spouseStreet"  placeholder="Street">
                                </div>
                                <div class="col-sm-2">
                                    <label>Postal Code</label>
                                    <input type="text"class="form-control" name="spousesPostal" id="regSpousesPostal" readonly>
                                    {{-- <select disable name="postal" id="regPostal" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full empty" placeholder="Search" style="width: 100%; height: 100%;">
                                        <option value=""></option>
                                    </select> --}}
                                </div>
                            </div>
                               
                                <br>
                                <hr>
                               {{-- EMERGENCY CONTACT --}}
                               <div class="row">
                                <div class="col">
                                    <h5>Emergency Contact Information</h5>
                                </div>
                                <div class="col">
                                    <label for="sameEmergencyAddress">Same As Patient Address</label>
                                    <input type="checkbox" name="sameEmergencyAddress" id="sameEmergencyAddress">
                                </div>
                                <div class="col">
                                    <label for="sameEmergency">Relationship</label>
                                    <input type="text" id="relationToPatient" name="relationToPatient" class="form-control d-inline w-75" placeholder="Relationship with patient">
                                </div>
                                <div class="w-100"> </div>
                                <div class="col pr-1-cust">
                                    <label>Last Name</label>
                                    <input type="text"class="form-control" name="emergencyLastName" id="emergencyLastName" placeholder="Last Name">
                                </div>
                                <div class="col pr-1-cust">
                                    <label>First Name</label>
                                    <input type="text"class="form-control" name="emergencyFirstName" id="emergencyFirstName" placeholder="First Name">
                                </div>
                                <div class="col pr-1-cust">
                                    <label>Middle Name</label>
                                    <input type="text"class="form-control" name="emergencyMiddleName" id="emergencyMiddleName" placeholder="Middle Name">
                                </div>
                                <div class="col-sm-1">
                                    <label>Ext</label>
                                    <input type="text"class="form-control" name="emergencyExtName" id="emergencyExtName" placeholder="Extension">
                                </div>
                                <div class="col-sm-2">
                                    <label>Contact Number</label>
                                    <input type="text"class="form-control" name="emergencyContactNo" id="emergencyContactNo" placeholder="Contact No." maxlength="13">
                                </div>
                                <div class="col">
                                    <label>Country</label>
                                    <select name="emergencyCountry" id="regEmergencyCountry" class="form-control" placeholder="Search" style="width: 100%;">
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
                                {{-- <div class="w-100"></div> --}}
                                
                                <div class="w-100"></div>

                                
                                <div class="col">
                                    <label>Province</label>
                                    <select name="emergencyProvince" id="regEmergencyProvince" class="form-control" placeholder="Search" style="width: 100%;">
                                            <option selected value="" id="getEmergencyProvince"></option>
                                        
                                    </select>
                                </div>
                            
                                <div class="col">
                                    <label>Municipality</label>
                                                <select name="emergencyMunicipality" id="regEmergencyMunicipality" class="form-control" placeholder="Search" style="width: 100%;">
                                                    <option selected value="" id="getEmergencyCity"></option>
                                                </select>
                                </div>
                                <div class="col">
                                    <label>Barangay</label>
                                                <select name="emergencyBrgy" id="regEmergencyBarangay" class="form-control" placeholder="Search" style="width: 100%;">
                                                    <option selected value="" id="getEmergencyBrgy"></option>
                                                </select>
                                </div>
                                <div class="col-sm-2">
                                    <label>Address</label>
                                    <input type="text"class="form-control" id="emergencyStreet" name="emergencyStreet"  placeholder="Street">
                                </div>
                                <div class="col-sm-2">
                                    <label>Postal Code</label>
                                    <input type="text"class="form-control" name="emergencyPostal" id="regEmergencyPostal" readonly>
                                    {{-- <select disable name="postal" id="regPostal" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full empty" placeholder="Search" style="width: 100%; height: 100%;">
                                        <option value=""></option>
                                    </select> --}}
                                </div>
                                
                                
                            </div>
                            
                        </fieldset>
                        <!-- END BACKGROUND INFORMATION -->
                        <!-- START HMO -->
                        <fieldset id="tab031">
                            <div class="row">

                                {{-- FIRST PROVIDER --}}
                                <h5>Provider</h5>
                                <div class="col">
                                    <input type="text" id="identifierforHMO1" name="identifierforHMO1" value="1" class="hidden">
                                    <label for="providerName">Health Care Provider Name:</label>
                                    {{-- <div class="w-100"></div> --}}
                                    
                                    <select name="providerName" id="providerName1" class="form-control" >
                                        <option value="">{{'Select HMO'}}</option>
                                        {{-- <option value=""selected></option> --}}
                                    @foreach ($insCode as $provider)
                                        <option value="{{$provider->U_INSNAME}}">{{$provider->U_INSNAME}}</option> 
                                    @endforeach
                                </select>
                                </div>
                                <div class="col">
                                    <label for="otherHmo1"><i>If Others, Specify</i></label>
                                    <input type="text" name="otherHmo1" id="otherHmo1" class="form-control" readonly>
                                </div>
                                <div class="col">
                                    <label for="memberID">ID/Account No.</label>
                                    <input type="text" name="memberID" class="form-control" id="memberID1">
                                </div>
                                <div class="col-sm">
                                    <label for="relationMem">Client Type</label>
                                    <select name="relationMem" id="relationMem1" class="form-control">
                                        <option value="">Select Relation</option>
                                        <option value="Member">Member</option>
                                        <option value="Dependent">Dependent</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="insMemType">Member Type</label>
                                    <select name="insMemType" id="insMemTypeID1" class="form-control" >
                                        <option value="">{{'Select Member Type'}}</option>
                                    @foreach ($memType as $type)
                                        <option value="{{$type->NAME}}">{{$type->NAME}}</option> 
                                    @endforeach
                                    </select>
                                </div>
                                <div class="w-100"></div>
                                <div class="col">
                                    <label for="memberLname">Member Last Name</label>
                                    <input type="text" name="memberLname" class="form-control" id="memberLname1" readonly>
                                </div>
                                <div class="col">
                                    <label for="memberFname">Member First Name</label>
                                    <input type="text" name="memberFname" class="form-control" id="memberFname1" readonly>
                                </div>
                                <div class="col">
                                    <label for="memberMname">Member Middle Name</label>
                                    <input type="text" name="memberMname" class="form-control" id="memberMname1" readonly>
                                </div>
                                <div class="col-sm-1">
                                    <label for="memberEname">Ext.</label>
                                    <input type="text" name="memberEname" class="form-control" id="memberEname1" readonly>
                                </div>
                                <div class="col">
                                    <label>Sex</label>
                                    <select name="memberSex" id="memberSex1" class="form-control" readonly>
                                        <option value=""></option>
                                        @foreach ($get_genderList as $sex)
                                            <option value="{{$sex->sexCode}}">
                                                {{$sex->sex}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="memberBDay">Birthdate</label>
                                    <input type="text" name="memberBDay" class="form-control" id="memberBDay1" readonly>
                                </div>
                                
                            </div>
                            <hr>
                            <div class="row hidden" id="dependentProvider" style="margin-top:25px;">
                              
                                {{-- DEPENDENT PROVIDER --}}
                                <h5>Dependent Provider</h5>
                                <div class="col">
                                    <input type="text" id="identifierforHMO3" name="identifierforHMO3" value="3" class="hidden">
                                    <label for="dependentProvider">Health Care Provider Name:</label>
                                    {{-- <div class="w-100"></div> --}}
                                    
                                    <select name="dependentProvider" id="providerName3" class="form-control" >
                                        <option value="">{{'Select HMO'}}</option>
                                    @foreach ($insCode as $provider)
                                        <option value="{{$provider->U_INSNAME}}">{{$provider->U_INSNAME}}</option> 
                                    @endforeach
                                </select>
                                </div>
                                <div class="col">
                                    <label for="otherHmo3"><i>If Others, Specify</i></label>
                                    <input type="text" name="otherHmo3" id="otherHmo3" class="form-control" readonly>
                                </div>
                                <div class="col">
                                    <label for="DPmemberID">ID/Account No.</label>
                                    <input type="text" name="DPmemberID" class="form-control" id="memberID3">
                                </div>
                                <div class="col">
                                    <label for="DPrelationMem">Client Type</label>
                                    <select name="DPrelationMem" id="relationMem3" class="form-control">
                                        <option value="">Select Relation</option>
                                        <option value="Member">Member</option>
                                        <option value="Dependent">Dependent</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="DPinsMemType">Member Type</label>
                                    <select name="DPinsMemType" id="insMemTypeID3" class="form-control" >
                                        <option value="">{{'Select Member Type'}}</option>
                                    @foreach ($memType as $type)
                                        <option value="{{$type->NAME}}">{{$type->NAME}}</option> 
                                    @endforeach
                                    </select>
                                </div>
                                <div class="w-100"></div>
                                <div class="col">
                                    <label for="DPmemberLname">Member Last Name</label>
                                    <input type="text" name="DPmemberLname" class="form-control" id="memberLname3">
                                </div>
                                <div class="col">
                                    <label for="DPmemberFname">Member First Name</label>
                                    <input type="text" name="DPmemberFname" class="form-control" id="memberFname3">
                                </div>
                                <div class="col">
                                    <label for="DPmemberMname">Member Middle Name</label>
                                    <input type="text" name="DPmemberMname" class="form-control" id="memberMname3">
                                </div>
                                <div class="col-sm-1">
                                    <label for="DPmemberEname">Ext.</label>
                                    <input type="text" name="DPmemberEname" class="form-control" id="memberEname3">
                                </div>
                                <div class="col">
                                    <label>Sex</label>
                                    <select name="DPmemberSex" id="memberSex3" class="form-control" >
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
                                    <label for="DPmemberBDay">Birthdate</label>
                                    <input type="text" name="DPmemberBDay" class="form-control" id="memberBDay3">
                                </div>
                                
                            </div>
                            
                            <hr>
                            <span><i id="addAnotherProvider">Add Another Provider</i></span>
                            <div class="row hidden" id="anotherProvider1">

                                {{-- FIRST PROVIDER --}}
                                <h5>Provider</h5>
                                <div class="col">
                                    <input type="text" id="identifierforHMO2" name="identifierforHMO2" value="2" class="hidden">
                                    <label for="providerName2nd">Health Care Provider Name:</label>
                                    {{-- <div class="w-100"></div> --}}
                                    
                                    <select name="providerName2nd" id="providerName2" class="form-control" >
                                        <option value="">{{'Select HMO'}}</option>
                                    @foreach ($insCode as $provider)
                                        <option value="{{$provider->U_INSNAME}}">{{$provider->U_INSNAME}}</option> 
                                    @endforeach
                                </select>
                                </div>

                                <div class="col">
                                    <label for="otherHmo"><i>If Others, Specify</i></label>
                                    <input type="text" name="otherHmo" id="otherHmo1" class="form-control" readonly>
                                </div>
                                <div class="col">
                                    <label for="memberID2nd">ID/Account No.</label>
                                    <input type="text" name="memberID2nd" class="form-control" id="memberID2">
                                </div>
                                <div class="col">
                                    <label for="relationMem2nd">Client Type</label>
                                    <select name="relationMem2nd" id="relationMem2" class="form-control">
                                        <option value="">Select Relation</option>
                                        <option value="Member">Member</option>
                                        <option value="Dependent">Dependent</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="insMemType2nd">Member Type</label>
                                    <select name="insMemType2nd" id="insMemTypeID2" class="form-control" >
                                        <option value="">{{'Select Member Type'}}</option>
                                    @foreach ($memType as $type)
                                        <option value="{{$type->NAME}}">{{$type->NAME}}</option> 
                                    @endforeach
                                    </select>
                                </div>
                                <div class="w-100"></div>
                                <div class="col">
                                    <label for="memberLname2nd">Member Last Name</label>
                                    <input type="text" name="memberLname2nd" class="form-control" id="memberLname2">
                                </div>
                                <div class="col">
                                    <label for="memberfname">Member First Name</label>
                                    <input type="text" name="memberFname2nd" class="form-control" id="memberFname2">
                                </div>
                                <div class="col">
                                    <label for="memberMname">Member Middle Name</label>
                                    <input type="text" name="memberMname2nd" class="form-control" id="memberMname2">
                                </div>
                                <div class="col-sm-1">
                                    <label for="memberEname">Ext.</label>
                                    <input type="text" name="memberEname2nd" class="form-control" id="memberEname2">
                                </div>
                                <div class="col">
                                    <label>Sex</label>
                                    <select name="memberSex2nd" id="memberSex2" class="form-control" >
                                        <option value=""></option>
                                        @foreach ($get_genderList as $sex)
                                            <option value="{{$sex->sexCode}}">
                                                {{$sex->sex}}
                                                </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="memberBDay">Birthdate</label>
                                    <input type="text" name="memberBDay2nd" class="form-control" id="memberBDay2">
                                </div>
                                
                            </div>
                            <div class="row hidden" id="dependentProvider1" style="margin-top:25px;">
                              
                                {{-- DEPENDENT PROVIDER SECOND--}}
                                <h5>Dependent Provider</h5>
                                <div class="col">
                                    <input type="text" id="identifierforHMO4" name="identifierforHMO4" value="4" class="hidden">
                                    <label for="dependentProvider">Health Care Provider Name:</label>
                                    {{-- <div class="w-100"></div> --}}
                                    
                                    <select name="dependentProvider1" id="providerName4" class="form-control" >
                                        <option value="">{{'Select HMO'}}</option>
                                    @foreach ($insCode as $provider)
                                        <option value="{{$provider->U_INSNAME}}">{{$provider->U_INSNAME}}</option> 
                                    @endforeach
                                </select>
                                </div>
                                <div class="col">
                                    <label for="DPmemberID1">ID/Account No.</label>
                                    <input type="text" name="DPmemberID1" class="form-control" id="memberID4">
                                </div>
                                <div class="col">
                                    <label for="DPrelationMem1">Client Type</label>
                                    <select name="DPrelationMem1" id="relationMem4" class="form-control">
                                        <option value="">Select Relation</option>
                                        <option value="Member">Member</option>
                                        <option value="Dependent">Dependent</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="DPinsMemType1">Member Type</label>
                                    <select name="DPinsMemType1" id="insMemTypeID4" class="form-control" >
                                        <option value="">{{'Select Member Type'}}</option>
                                    @foreach ($memType as $type)
                                        <option value="{{$type->NAME}}">{{$type->NAME}}</option> 
                                    @endforeach
                                    </select>
                                </div>
                                <div class="w-100"></div>
                                <div class="col">
                                    <label for="DPmemberLname1">Member Last Name</label>
                                    <input type="text" name="DPmemberLname1" class="form-control" id="memberLname4">
                                </div>
                                <div class="col">
                                    <label for="DPmemberfname">Member First Name</label>
                                    <input type="text" name="DPmemberFname1" class="form-control" id="memberFname4">
                                </div>
                                <div class="col">
                                    <label for="DPmemberMname">Member Middle Name</label>
                                    <input type="text" name="DPmemberMname1" class="form-control" id="memberMname4">
                                </div>
                                <div class="col-sm-1">
                                    <label for="DPmemberEname">Ext.</label>
                                    <input type="text" name="DPmemberEname1" class="form-control" id="memberEname4">
                                </div>
                                <div class="col">
                                    <label>Sex</label>
                                    <select name="DPmemberSex1" id="memberSex4" class="form-control" >
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
                                    <label for="DPmemberBDay1">Birthdate</label>
                                    <input type="text" name="DPmemberBDay" class="form-control" id="memberBDay4">
                                </div>
                                
                            </div>
                            
                            <hr>
                            
                    
                        </fieldset>
                        <!-- END HMO -->
                        <!-- START MEDICAL INFORMATION -->
                        <fieldset id="tab041">
                            
                            <div class="row">
                                <div class="col">
                                    <label for="patientHeightcm">Height{{'(cm)'}}:</label>
                                    <input type="number" name="patientHeightcm" id="centimeter" class="form-control" step=".01" min="145" max="192.5">
                                </div>
                                <div class="col">
                                    <label for="patientHeightin">Height{{'(in)'}}:</label>
                                    <input type="number" class="form-control" name="patientHeightin" id="inch" step=".01">
                                </div>
                                <div class="col">
                                    <label for="patientWeightkg">Weight{{'(kg)'}}:</label>
                                    <input type="number" name="patientWeightkg" id="kg" class="form-control" step=".01">
                                </div>
                                <div class="col">
                                    <label for="patientWeightlb">Weight{{'(lb)'}}:</label>
                                    <input type="number" name="patientWeightlb" id="lb" class="form-control" step=".01">
                                </div>
                                <div class="col">
                                    <label for="patientBMI">Body Mass Index{{'(BMI)'}}:</label>
                                    <input type="number" name="patientBMI" id="bmi" class="form-control" step=".01">
                                </div>
                            </div>
                            <hr>
                            <div class="w-100"></div>
                          
                            <div class="row">
                                <div class="col col-md">
                                    <div class="row">
                                        
                                   
                                    <h5>Allergies</h5>
                                            <div class="col-md-6">
                                                <label for="allergy1">Allergic to:</label>
                                                <input type="text" name="allergy1" id="allergy1" placeholder="Allergic to" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="allergy2">Allergic to:</label>
                                                <input type="text" name="allergy2" id="allergy2" placeholder="Allergic to" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="allergy3">Allergic to:</label>
                                                <input type="text" name="allergy3" id="allergy3" placeholder="Allergic to" class="form-control">
                                            </div>
                                         
                                            <div class="col-md-6 hidden" id="allegyField4">
                                                <label for="allergy4">Allergic to:</label>
                                                <input type="text" name="allergy4" id="allergy4" placeholder="Allergic to" class="form-control w-30">
                                            </div>

                                            <div class="col-md-6 hidden" id="allegyField5">
                                                <label for="allergy5">Allergic to:</label>
                                                <input type="text" name="allergy4" id="allergy5" placeholder="Allergic to" class="form-control " >
                                            </div>

                                            <div class="col-md-6 hidden" id="allegyField6">
                                                <label for="allergy6">Allergic to:</label>
                                                <input type="text" name="allergy6" id="allergy6" placeholder="Allergic to" class="form-control " >
                                            </div>

                                            <div class="col-md-6 hidden" id="allegyField7">
                                                <label for="allergy7">Allergic to:</label>
                                                <input type="text" name="allergy7" id="allergy7" placeholder="Allergic to" class="form-control " >
                                            </div>

                                            <div class="w-100"></div>
                                            <div class="col">
                                                <span><i class="addAnotherAllergy" id="addAnotherAllergy" >Add Another Field</i> </span>
                                            </div>

                                            <div class="w-100"></div>
                                            <div class="col" >
                                                <span ><i class="addAnotherAllergy1 hidden" id="addAnotherAllergy1" >Add Another Field</i></span>
                                            </div>


                                            <div class="w-100"></div>
                                            <div class="col" >
                                                <span ><i class="addAnotherAllergy2 hidden" id="addAnotherAllergy2" >Add Another Field</i></span>
                                            </div>

                                            <div class="w-100"></div>
                                            <div class="col" >
                                                <span ><i class="addAnotherAllergy3 hidden" id="addAnotherAllergy3" >Add Another Field</i></span>
                                            </div>
                                </div>
                                </div>              
                                <div class="col col-md">
                                    <h5>Personal and Social History</h5>
                                    <div class="row">
                                    <div class="col-6">
                                           <label for="smoker">Smoker:</label>
                                           <input type="checkbox" name="smoker">
                                       </div>
                                       <div class="col-6">
                                           <label for="alcoholic">Alcohol:</label>
                                           <input type="checkbox" name="alcoholic">
                                       </div>
                                       <div class="w-100"></div>
                                       <div class="col-6">
                                           <label for="drugs">Illicit Drugs:</label>
                                           <input type="checkbox" name="drugs">
                                       </div>
                                       
                                       <div class="col-6">
                                           <!-- <label for="sexActive">Sexually Active:</label> -->
                                           <p>Sexually Active: <input type="checkbox" name="sexActive"></p>
                                       </div>
                                    </div>
                                </div>
                            </div>
                           
                        </fieldset>
                        <!-- END MEDICAL INFORMATION -->

                        <fieldset id="tab051">
                            
                           
                            <hr class="my-3">
                            <table class="patient-list-table mx-auto w-100">
                                <thead>
                                    <th>MPI</th>
                                    <!-- <th>Hospital Code</th> -->
                                    <th>Hospital Registered</th>
                                    <th>Medical Record Number {{'(MRN)'}}</th>
                                    <th>Date Recorded</th>
                                    {{-- <th>Transaction</th> --}}
                                </thead>
                                <tbody id="hospitalIdtable">
                                    {{-- <TD>{{ $CODE }}</TD> --}}
                                    {{-- <td id="code"></td>
                                    <td id="hospitalCode"></td>
                                    <td id="hpid"></td>
                                    <td id="dateUpdated"></td>
                                    <td id="editedBy"></td>
                                    <td>{{ Auth::user()->userName }}</td>
                                    <td id="transactionNote"></td> --}}
                                </tbody>
                            </table>
                        </fieldset>
                        <input type="text" id="createdBy" class="hidden" name="createdBy">
                        <input type="text" id="createdDate" class="hidden" name="createdDate">
                    </div>
                <!-- END MODAL BODY -->

                <!-- START MODAL FOOTER -->
                    <div class="modal-footer justify-content-between">
                        <div class="col">
                            <button type="button"  class="btn btn-secondary text-left"  id="viewVisit" >View Visit</button>
                            <button type="button"  class="btn btn-success text-left"  id="addVisit"  onclick="">Create Visit</button>
                        </div>
                        <div class="col text-right">
                             {{-- <button type="button"  class="btn btn-secondary"  id="closeReset"  onclick="resetInput()">Close</button> --}}
                            <input type="text" class="hidden" id="hiddenInput" name="hiddenCode">
                            <!-- {{-- <button type="button" class="btn btn-primary" wire:click="update('{{$CODE}}')" id="updateBtn" data-bs-dismiss="modal">Save Changes</button> --}} -->
                            <button type="submit" class="btn btn-primary"  id="submitButt">Save changes</button>
                        </div>

                       
                    </div>
                <!-- END MODAL FOOTER -->
                </form>
            </div>
        </div>

    </div>

</div>

<style>
    #addAnotherAllergy{
        font-style: normal;
    }
    #addAnotherAllergy1{
        font-style: normal;
    }
    #addAnotherAllergy2{
        font-style: normal;
    }
    #addAnotherAllergy3{
        font-style: normal;
    }
    #addAnotherAllergy:hover{
        cursor:cell
    }
    #addAnotherAllergy1:hover{
        cursor:cell
    }
    #addAnotherAllergy2:hover{
        cursor:cell
    }
    #addAnotherAllergy3:hover{
        cursor:cell
    }
    #addAnotherProvider:hover{
        cursor:cell
    }
    
</style>
