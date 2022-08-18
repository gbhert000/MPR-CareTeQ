<div class="modal fade" wire:ignore.self id="viewPatientModal" tabindex="-1" aria-labelledby="viewPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewPatientModalLabel">Master Patient Record</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <form>
        @csrf
      <div class="modal-body">
    
        <div class="row">
            <div class="col-sm-2">
              <div class="col">
                  <img src="img/profile.png" alt="" class="profile-pic mx-auto">
              </div>
              <div class="w-100"></div>
              <div class="col">
                  <label>Master Patient ID</label>
                  <input type="text" class="form-control" name="CODE" id="CODE" wire:model="CODE" disabled>
              </div>
                
            </div>
            <div class="col-md">
                <h3>Personal Information</h3>
                <div class="row">
                    <div class="col pr-1">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="U_FIRSTNAME" id="U_FIRSTNAME" wire:model="U_FIRSTNAME" required>
                        {{-- {{$firstName}} --}}
                        {{-- @error('U_FIRSTNAME') <span class="text-danger">{{ $message }}</span> @enderror --}}
                    </div>
                    <div class="col px-1">
                        <label>Last Name</label>
                        <input type="text"  class="form-control" name="U_LASTNAME" id="U_LASTNAME" wire:model="U_LASTNAME">
                        {{-- @error('lastName') <span class="text-danger">{{ $message }}</span> @enderror --}}
                    </div>
  
                    
                    <div class="col-sm px-1">
                        <label>Middle Name</label>
                        <input type="text"  class="form-control" name="U_MIDDLENAME" id="U_MIDDLENAME"  >
                        {{-- @error('middleName') <span class="text-danger">{{ $message }}</span> @enderror --}}
                    </div>
                    <div class="col-sm-2  px-1">
                        <label>Ext.</label>
                        <input type="text" wire:model="extensionName" class="form-control">
                        {{-- @error('extensionName') <span class="text-danger">{{ $message }}</span> @enderror --}}
                    </div>
  
                    <div class="w-100"></div>
                    <div class="col">
                        <label>Birthdate</label>
                        <input type="text" class="form-control datepicker" name="U_BIRTHDATE"  wire:model="U_BIRTHDATE"id="bday1" class="datepicker" placeholder="mm/dd/yyyy">
                        {{-- @error('birthDate') <span class="text-danger">{{ $message }}</span> @enderror --}}
                    </div>
                    <div class="col">
                      <label>Age</label>
                      <input type="text"class="form-control" id="age" wire:model="age">
                      @error('age') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col">
                        <label>Sex</label>
                        <select name="sex" id="regSex" class="form-control" >
                            <option value="" wire:model="sex" selected>
                              @if($sex=='M')
                                  Male
                              @elseif($sex=='F')
                                  {{'Female'}}
                              @else
                                  {{'Non-Binary'}}
                              @endif
                          </option>
                            @foreach ($gender as $sex)
                                <option value="{{$sex->U_GENDER}}">
                                  @if($sex->U_GENDER=='M')
                                    Male
                                  @elseif($sex->U_GENDER=='F')
                                  {{__('Female')}}
                                  @else
                                    {{__('Non-Binary')}}
                                  @endif
                                  </option>
                            @endforeach
                        </select>
                        {{-- @error('sex') <span class="text-danger">{{ $message }}</span> @enderror --}}
                    </div>
                    <div class="w-100"></div>
                    
                    <div class="col">
                        <label>Place of Birth</label>
                        <input type="text"class="form-control" wire:model="U_BIRTHPLACE">
                        {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                    </div>
                    
                    <div class="col">
                        <label>Nationality</label>
                        <input type="text"class="form-control" wire:model="U_NATIONALITY">
                        {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        <label>Religion</label>
                        <input type="text"class="form-control" wire:model="U_RELIGION">
                        {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                    </div>
                    
                    <div class="col">
                        <label>Occupation</label>
                        <input type="text"class="form-control" wire:model="U_OCCUPATION">
                        {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                    </div>
                </div>
                <div class="row">
                  {{-- FIRST CONTACT --}}
                 <div class="col">
                     <h3>Contact Information</h3>
                 </div>
                 <div class="w-100"></div>
                 <div class="col">
                     <label>Email Address</label>
                     <input type="text"class="form-control" name="email">
                     {{-- @error('age') <span class="text-danger">{{ $message }}</span> @enderror --}}
                 </div>
                 <div class="w-100"></div>
                 <div class="col">
                     <label for="contactType1">Contact Type</label>
                     <select name="contactType1" id="contactType1" class="form-control">
                         <option value="home">Home {{'(Telephone)'}}</option>
                         <option value="work">Work </option>
                         <option value="personal">Personal {{'(Mobile)'}} </option>
                     </select>
                 </div>
             
                 <div class="col">
                     <label>Contact Number</label>
                     <input type="text"class="form-control" name="U_1STCONTACT">
                 </div>
                 <div class="w-100"></div>
                
                 <div class="col" id="addingContactUpdate">
                     <i id="addContactUpdate"><span class="iconPlus">Add Another</span></i>
                 </div>
                 {{-- END FIRST CONTACT --}}
                 {{-- START 2ND CONTACT --}}
                 <div class="col hidden" id="anotherContactType">
                  <label for="contactType2">2nd Contact No. Type</label>
                  <select name="contactType2" id="contactType2" class="form-control">
                      <option value="home">Home {{'(Telephone)'}}</option>
                      <option value="work">Work </option>
                      <option value="personal">Personal {{'(Mobile)'}} </option>
                  </select>
              </div>
              <div class="col hidden" id="anotherContact"  >
                  <label>2nd Contact Number</label>
                  <input type="text" class="form-control" name="U_2NDCONTACT">
              </div>
              <div class="w-100"></div>
              <div class="col hidden" id="anotherContactType2">
                  <label for="contactType2">2nd Contact No. Type</label>
                  <select name="contactType2" id="contactType2" class="form-control">
                      <option value="home">Home {{'(Telephone)'}}</option>
                      <option value="work">Work </option>
                      <option value="personal">Personal {{'(Mobile)'}} </option>
                  </select>
              </div>
              
                 {{-- END 2ND CONTACT --}}
                 {{-- START 3RD CONTACT --}}
                 <div class="col hidden" id="anotherContactType1Update">
                     <label for="contactType3">3rd Contact No. Type</label>
                     <select name="contactType3" id="contactType23" class="form-control">
                         <option value="home">Home {{'(Telephone)'}}</option>
                         <option value="work">Work </option>
                         <option value="personal">Personal {{'(Mobile)'}} </option>
                     </select>
                 </div>
                 <div class="col hidden" id="anotherContact1"  >
                     <label>3rd Contact Number</label>
                     <input type="text" class="form-control" name="U_3RDCONTACT">
                 </div>
  
                 <div class="w-100"></div>
                 <div class="col hidden" id="addingContactUpdate2">
                     <i id="addContactUpdate2"><span class="iconPlus">Add Another</span></i>
                 </div>
  
                 {{-- start 4th contact --}}
                 <div class="col hidden" id="anotherContact2"  >
                  <label>4th Contact Number</label>
                  <input type="text" class="form-control" name="U_2NDCONTACT">
              </div>
                 <div class="col hidden" id="addingContactUpdate1">
                     <i id="addContactUpdate1"><span class="iconPlus">Add Another</span></i>
                 </div>
  
             
             </div>
                
            </div>
  
  
        <!--Health Insurance-->
        <div class="col">
            {{-- ADDRESS --}}
                  <div class="row">
                    <h3>Address</h3>
                    <div class="row">
                        
                        <div class="w-100"></div>
                        <div class="col">
                            <label>Country</label>
                           
                            <select name="country1" id="regCountry111" class="form-control" >
                                <option wire:model="country1" selected > {{$country1}}</option>
                                @foreach ($get_Country as $country)
                                    <option value="{{$country->country}}" >{{$country->country}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label>Province</label>
                            <select name="province1" id="regProvince1" class="form-control">
                                <option wire:model="province1" selected>{{$province1}}</option> 
                            </select>
                        </div>
                    </div>
    
                    <div class="w-100"></div>
                    <div class="row">
                        <div class="col">
                            <label>Municipality</label>
                                        <select name="municipality1" id="regMunicipality11" class="form-control">
                                            <option wire:model="municipality1" selected> {{$municipality1}}</option>
                                        </select>
                        </div>
                        <div class="col">
                            <label>Barangay</label>
                                        <select name="brgy" id="regBarangay1" class="form-control">
                                            <option wire:model="brgy" selected>{{$brgy}}</option>
                                        </select>
                        </div>
    
                        <div class="w-100"></div>  
                        <div class="col">
                          <label>House No</label>
                          <input type="text"class="form-control" name="houseNo">
                      </div>
                        <div class="col">
                          <label>Street</label>
                          <input type="text"class="form-control">
                        </div>
                        
                        <div class="col">
                          <label>Postal Code</label>
                          <input type="text"class="form-control" name="postal" id="regPostal1">
                        </div>                          
                        <div class="w-100"></div>
                        <input type="text" class="hidden form-control" disabled>
                      <br>
                      <br>
                      <br>
                        
                        <div class="w-100"><input type="text" class="hidden form-control" disabled></div>
                        <div class="w-100"><input type="text" class="hidden form-control" disabled></div>
                        
                        
                        
                    </div>
                  </div>
                <div class="row">
                  <div class="col">
                      <h3>Background Information</h3>
                  </div>
                  <div class="w-100"></div>
                  <div class="col">
                      <label>Father's Name</label>
                      <input type="text"class="form-control" name="father" id="" placeholder="Juan Zaparte Dela Cruz III">
                  </div>
                  <div class="w-100"></div>
                  <div class="col">
                      <label>Mother's Name</label>
                      <input type="text"class="form-control" name="mother" id="" placeholder="Juan Zaparte Dela Cruz III">
                  </div>
                  <div class="w-100"></div>
                  <div class="col">
                      <label>Spouse's Name</label>
                      <input type="text"class="form-control" name="spouse" id="" placeholder="Juan Zaparte Dela Cruz III">
                  </div>
                     
                  </div>
                
        </div> 
  
        {{-- end health insurance --}}
        
        <div class="w-100"></div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <input type="text" class="hidden" id="hiddenInput">
      <button type="button" class="btn btn-primary" wire:click.prevent="update('{{$CODE}}')" id="updateBtn" data-bs-dismiss="modal">Save Changes</button>
    </div>
    </form>
    </div>
  </div>
  </div>
  {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('/selectsearch/select2/dist/js/select2.min.js') }}" type='text/javascript'></script>
  <link rel="stylesheet" href="{{ asset('/jquery-ui-1.13.1.custom/jquery-ui.css') }}">
  <link rel="stylesheet" href="{{ asset('/jquery-ui-1.13.1.custom/jquery-ui.min.css') }}">
  <script type="text/javascript" src="{{ asset('/jquery-ui-1.13.1.custom/jquery-ui.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/jquery-ui-1.13.1.custom/jquery-ui.min.js') }}"></script> --}}
  {{-- <script src="js/update.js"></script> --}}