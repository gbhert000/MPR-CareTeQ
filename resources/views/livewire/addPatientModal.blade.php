<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" wire:ignore.self id="studentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Patient Registration</h5>
                @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ 
                    Session::get('message') }}</p>
                @endif
                {{-- <button type="button" class="btn-close"  aria-label="Close" id="closeReset1" onclick="resetInputAdd()"></button>
                 --}}
                 <button type="button" class="btn-close" id="closeAll1"  aria-label="Close">
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeReset1" onclick="resetInput()"></button> --}}
            </div>
            <!-- START FORM -->
            <form action="add" method="POST">
               @csrf
                {{-- <input name="_token" type="hidden" value="..."> --}}
                <!-- START MODAL BODY -->
                <div class="modal-body">
                    <div class="row">
                    <!-- START PICTURE -->
                        <div class="col-sm-2">
                            <div class="row">
                                <div class="col">
                                    <img src="img/profile.png" alt="" id="patientImageRegister" class="profile-pic mx-auto">
                                </div>
                                <input type="hidden" name="hiddenImageRegister" id="hiddenImageRegister">

                                <div class="w-100"></div>
                                <br>
                                <br>
                                    <div class="col">
                                        {{-- <i data-toggle="modal" data-target="#addImageModal" >Add Picture</i> --}}
                                        {{-- <i > Add Image</i> --}}
                                        <img src="icon/webcam.png" alt="" id="addingImageRegister">
                                        {{-- <input type="button" class="btn btn-primary formc-control"> --}}
                                    </div>
                                <br>
                                <br>
                                <div class="w-100"></div>
                                <div class="col text-center">
                                    <label for="hpidRegister"> Medical Record Number</label>
                                    <input type="text" name="hpidRegister" id="hpidRegister" class="form-control" maxlength="11">
                                </div>
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
                                    <label>Middle Name <i id="requiredFields">*</i></label>
                                    <input type="text"  class="form-control" name="U_MIDDLENAME" id="addMiddleName"  autocomplete="off" required>
                                    {{-- @error('middleName') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                <div class="col-sm-2  px-1">
                                    <label>Ext.</label>
                                    <input type="text"  class="form-control" autocomplete="off">
                                    {{-- @error('extensionName') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                <div class="w-100"></div>
                                <div class="col-sm-2 pr-1 mt-3">
                                    <label>Birthdate <i id="requiredFields">*</i> </label>
                                <input type="text" class="form-control px-3 datepicker1" name="U_BIRTHDATE" id="bday11" placeholder="mm-dd-yyyy" autocomplete="off" required>
                                    {{-- @error('birthDate') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                <div class="col-sm-1 px-1 mt-3">
                                    <label>Age</label>
                                    <input type="text"class="form-control"  id="age1" name="age" readonly> 
                                    {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                <div class="col-sm-2 px-1 mt-3">
                                    <label>Civil Status <i id="requiredFields">*</i></label> 
                                    <select class="form-control"  name="U_CIVILSTATUS" id="regCivilStatus" required>
                                        <option value="" selected></option>
                                        @foreach ($maritals as $marital)
                                            <option value="{{$marital->MaritalStatus}}">{{$marital->MaritalStatus}}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text"class="form-control" id="civil" name="U_CIVILSTATUS"> --}}
                                    {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                
                                <div class="col-sm-2 px-1 mt-3 ">
                                    <label>Sex <i id="requiredFields">*</i></label>
                                    <select name="sex" id="regSex" class="form-control"  required>
                                        <option value=""></option>
                                        @foreach ($get_genderList as $sex)
                                            <option value="{{$sex->sexCode}}">
                                                {{$sex->sex}}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- @error('sex') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                <div class="col-sm-2 px-1 mt-3">
                                    <label for="idType">ID Type</label>
                                    {{-- <input type="text" class="form-control"> --}}
                                    <select name="idType" id="idType" class="form-control">
                                        <option value="">Select Type</option>
                                        @foreach ($idTypes as $idType)
                                            <option value="{{$idType->name}}">{{$idType->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col px-1 mt-3">
                                    <label for="idNumber">ID Number</label>
                                    <input type="text" class="form-control" name="idNumber" id="idNumber" placeholder="">
                                </div>
                                <div class="w-100"></div>
                                {{-- <div class="w-100"></div> --}}
                                
                                <div class="col pr-1 mt-3">
                                    <label>Place of Birth</label>
                                    <input type="text"class="form-control" name="placeOfBirth" >
                                    {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                
                                <div class="col px-1 mt-3">
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
                                <div class="col px-1 mt-3">
                                    <label>Religion</label>
                                    {{-- <input type="text" class="form-control" name="religion"> --}}
                                    <select class="form-control"  name="religion" id="regReligion">
                                        <option value="" selected></option>
                                        @foreach ($religions as $religion)
                                            <option value="{{$religion->ReligionName}}">{{$religion->ReligionName}}</option>
                                        @endforeach
                                    </select>
                                    {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>
                                
                                <div class="col mt-3 ">
                                    <label>Occupation</label>
                                    <input type="text" class="form-control" name="occupation">
                                    {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </div>

                                
                            </div>
                            <!-- END PERSONAL INFORMATION -->
                            <!-- START ADDRESS -->
                            <div class="row mt-3">
                                <h5>Present Address</h5>

                                

                                <div class="col pr-1 ">
                                    <label>Country <i id="requiredFields">*</i></label>
                                    <select name="country" id="regCountry" class="form-control" placeholder="Search" style="width: 100%;" required>
                                        <option value=""></option>
                                        @foreach ($countries as $country)
                                                <option value="{{$country->country}}">{{$country->country}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col px-1">
                                    <label>Province <i id="requiredFields">*</i></label>
                                    <select name="province" id="regProvince"class="form-control" placeholder="Search" style="width: 100%;" required disabled>
                                        <option value=""></option>
                                        
                                    </select>
                                </div>
                                
                                
                                <div class="col px-1">
                                    <label>Municipality <i id="requiredFields">*</i></label>
                                    <select name="municipality"  id="regMunicipality" class="form-control" placeholder="Search" style="width: 100%;"  required disabled>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="w-100"></div>
                                <div class="col pr-1">
                                    <label>Barangay <i id="requiredFields">*</i></label>
                                    <select name="brgy" id="regBarangay" class="form-control" placeholder="Search" style="width: 100%;" required disabled>
                                        <option value=""></option>
                                    </select>
                                </div>
                
                                <div class="col pr-1">
                                    <label>House No. & Street <i id="requiredFields">*</i></label>
                                    <input type="text"class="form-control" name="street" id="regstreet" required>
                                </div>    
                                <div class="col-sm-2 px-1">
                                    <label>Zip Code <i id="requiredFields">*</i></label>
                                    <input type="text"class="form-control" name="postal" id="regPostal" readonly>
                                </div>
                                <div class="w-100"></div> 
                            </div>
                            <!-- END ADDRESS -->

                            <!-- START CONTACT -->

                            <input type="number" class="hidden" value="1" name="countContact" id="countContact">
                            <!-- START FIRST CONTACT -->
                            <div class="row">
                                <div class="col">
                                    <h5 class="dis-inline">Contact Information</h5>
                                    {{-- <span class="dis-inline ml-3" id="addaContact"><img src="icon/plus.png" alt="" class="iconPlus"></span>
                                    <span class="dis-inline ml-3" id="removeaContact"><img src="icon/minus.png" alt="" class="iconPlus"></span> --}}
                                </div>
                                <div class="w-100"></div>
                                <div class="col-sm-3">
                                    <label for="contactType1">Contact Type <i id="requiredFields">*</i></label>
                                    <select name="contactType1" id="regcontactType1" class="form-control" required>
                                        <option value="">Select Type</option>
                                        @foreach ($contTypes as $contType)
                                            <option value="{{$contType->contacttype}}">{{$contType->contacttype}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col">
                                    <label>Contact Number <i id="requiredFields">*</i></label>
                                    <input type="text"class="form-control"  name="contact1" id="contact1Add" maxlength="13"  autocomplete="off" required>
                                </div>

                                <div class="col">
                                    <label for="noteContact1">Note:</label>
                                    <input type="text"class="form-control"  name="noteContact1" id="noteContact1">
                                </div>
                            </div>
                            <!-- END FIRST CONTACT -->
                            <!-- START SECOND CONTACT -->
                            <div class="row mt-3 cols2 hidden">
                                <div class="col-sm-3" id="anotherContactType2">
                                    {{-- <label for="contactType2">Label</label> --}}
                                    <select name="contactType2" id="contactType2" class="form-control">
                                        <option value="">Select Type</option>
                                        @foreach ($contTypes as $contType)
                                            <option value="{{$contType->contacttype}}">{{$contType->contacttype}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col" id="anotherContact2" >
                                    {{-- <label>Contact Number</label> --}}
                                    <input type="text" class="form-control" name="contact2" id="contact2Add" maxlength="13"  autocomplete="off">
                                </div>

                                <div class="col">
                                    {{-- <label for="noteContact1">Note:</label> --}}
                                    <input type="text"class="form-control"  name="noteContact2">
                                </div>
                            </div>
                            <!-- END SECOND CONTACT -->
                            <!-- START THIRD CONTACT -->
                            <div class="row mt-3 cols3 hidden" >
                                <div class="col-sm-3" id="anotherContactType3">
                                    {{-- <label for="contactType3">Label</label> --}}
                                    <select name="contactType3" id="contactType3" class="form-control">
                                        <option value="">Select Type</option>
                                        @foreach ($contTypes as $contType)
                                            <option value="{{$contType->contacttype}}">{{$contType->contacttype}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col" id="anotherContact3"  >
                                    {{-- <label>Contact Number</label> --}}
                                    <input type="text"  class="form-control" name="contact3" id="contact3Add" maxlength="13"  autocomplete="off">
                                </div>

                                <div class="col">
                                    {{-- <label for="noteContact3">Note:</label> --}}
                                    <input type="text"class="form-control"  name="noteContact3">
                                </div>
                            </div>
                            <!-- END THIRD CONTACT -->
                            <!-- START FOURTH CONTACT -->
                            <div class="row mt-3 cols4 hidden">
                                <div class="col-sm-3 " id="anotherContactType3">
                                    {{-- <label for="contactType3">Label</label> --}}
                                    <select name="contactType4" id="contactType4" class="form-control">
                                        <option value="">Select Type</option>
                                        
                                        @foreach ($contTypes as $contType)
                                            <option value="{{$contType->contacttype}}">{{$contType->contacttype}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col" id="anotherContact3"  >
                                    {{-- <label>Contact Number</label> --}}
                                    <input type="text" class="form-control" name="contact4" id="contact4Add" maxlength="13" autocomplete="off">
                                </div>

                                <div class="col">
                                    {{-- <label for="noteContact3">Note:</label> --}}
                                    <input type="text"class="form-control"  name="noteContact4">
                                </div>
                            </div>
                            <div class="row">
                                <span class="" id="addaContact"><i class="cursor-pointer">Add Contact</i></span>
                                {{-- <span class="dis-inline ml-3" id="addaContact"><img src="icon/plus.png" alt="" class="iconPlus"></span> --}}
                                {{-- <span class="dis-inline ml-3" id="removeaContact"><img src="icon/minus.png" alt="" class="iconPlus"></span> --}}
                            </div>
                            <!-- END FOURTH CONTACT -->
                            <!-- END CONTACT -->

                            <!-- START FIRST EMAIL -->
                            <div class="row emails1">
                                <div class="col col-sm-3">
                                    <label for="emailType1"> Email Type</label>
                                    <select name="emailType1" id="emailType1" class="form-control">
                                        <option value="">Select Type</option>
                                        @foreach ($emailTypes as $emailType)
                                            <option value="{{$emailType->emailtype}}">{{$emailType->emailtype}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col" >
                                    <label for="email1">Email</label>
                                    <input type="email" name="email1" id="email1" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="noteEmail1">Note</label>
                                    <input type="text" name="noteEmail1" id="noteEmail1" class="form-control">
                                </div>
                            </div>
                            <!-- END FIRST EMAIL -->
                            <!-- START SECOND EMAIL  -->
                                <div class="row emails2 hidden mt-3">
                                <div class="col col-sm-3">
                                   <!--  <label for="emailType2"> Email Type</label> -->
                                    <select name="emailType2" id="emailType2" class="form-control">
                                        <option value="">Select Type</option>
                                        @foreach ($emailTypes as $emailType)
                                            <option value="{{$emailType->emailtype}}">{{$emailType->emailtype}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col" >
                                    <!-- <label for="email2">Email</label> -->
                                    <input type="email" name="email2" id="email2" class="form-control">
                                </div>
                                <div class="col">
                                    <!-- <label for="noteEmail2">Note</label> -->
                                    <input type="text" name="noteEmail2" id="noteEmail2" class="form-control">
                                </div>
                            </div>
                            <!-- END SECOND EMAIL -->
                            <!-- START THIRD EMAIL -->
                                <div class="row emails3 hidden mt-3">
                                <div class="col col-sm-3">
                                    <!-- <label for="emailType3"> Email Type</label> -->
                                    <select name="emailType3" id="emailType3" class="form-control">
                                        <option value="">Select Type</option>
                                        @foreach ($emailTypes as $emailType)
                                            <option value="{{$emailType->emailtype}}">{{$emailType->emailtype}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col" >
                                    <!-- <label for="email3">Email</label> -->
                                    <input type="email" name="email3" id="email3" class="form-control">
                                </div>
                                <div class="col">
                                    <!-- <label for="noteEmail3">Note</label> -->
                                    <input type="text" name="noteEmail3" id="noteEmail3" class="form-control">
                                </div>
                            </div>
                            <!-- END THIRD EMAIL -->
                            <!-- START FOURTH EMAIL -->
                                <div class="row emails4 hidden mt-3">
                                <div class="col col-sm-3">
                                    <!-- <label for="emailType4"> Email Type</label> -->
                                    <select name="emailType4" id="emailType4" class="form-control">
                                        <option value="">Select Type</option>
                                        @foreach ($emailTypes as $emailType)
                                            <option value="{{$emailType->emailtype}}">{{$emailType->emailtype}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col" >
                                    <!-- <label for="email4">Email</label> -->
                                    <input type="email" name="email4" id="email4" class="form-control">
                                </div>
                                <div class="col">
                                    <!-- <label for="noteEmail4">Note</label> -->
                                    <input type="text" name="noteEmail4" id="noteEmail4" class="form-control">
                                </div>
                            </div>
                            <!-- END FOURTH EMAIL -->
                            <div class="row">
                                <span class="" id="addaEmail"><i class="cursor-pointer">Add Email</i></span> 
                            </div>
                        </div>
                    
                    </div>
                </div>
                <!-- END MODAL BODY -->

                <!-- START FOOTER -->
                <div class="modal-footer">
            <!-- {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#confirmModal #studentModal" id="closeAdd" wire:click="resetInputFields()">Close</button> --}} -->
                    {{-- <button type="button" class="btn btn-secondary"  id="closeReset1" onclick="resetInputAdd()">Close</button> --}}
                    <button type="submit" class="btn btn-primary" id="addPatient" disabled >Register Patient</button>
                </div>
                <!-- END FOOTER -->
            </form>
            <!-- END FORM -->
        </div>
    </div>
</div>
