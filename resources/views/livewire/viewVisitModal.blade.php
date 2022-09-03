    <!-- Modal -->
  <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="viewVisitModal" tabindex="-1" role="dialog" aria-labelledby="viewVisitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewVisitModalLabel">View Visit</h5>
          {{-- <button type="button" class="btn-close" id="closeViewVisit"  aria-label="Close"> --}}
            <button type="button" class="btn-close" id="closeAll4"  aria-label="Close">
            {{-- <span aria-hidden="true">&times;</span> --}}
          </button>
        </div>
        <div class="modal-body">
            {{-- <@livewire('create-visit', $patients) --}}
              <div class="row">
                <div class="col-sm-2">
                  <label for="mpi">Master Patient Index</label>
                  <input type="text" value="" id="mpiUpdate" name="mpi" class="form-control" readonly>
                </div>
                <div class="col">
                  <label for="nameVisit">Name</label>
                  <input type="text" value="" id="nameVisitUpdate" name="nameVisit" class="form-control" readonly>
              </div>
                <div class="col">
                  <label for="hpidVisit">Medical Record Number</label>
                  <input type="text" value="" id="hpidVisitUpdate" name="hpidVisit" class="form-control" readonly>
                </div>
                @php $visit = date('Y').'-'.$newVisitID; @endphp
                <div class="col">
                  <label for="visitID">Visit ID</label>
                  <input type="text" value="" id="visitIDUpdate" name="visitID" class="form-control shadow-none" readonly>
                </div>
                {{-- <div class="col">
  
                </div>
                <div class="w-100"></div> --}}
                <div class="col">
                  <label for="selectVisit"> Select Type of Visit</label>
                  <select name="selectVisit" id="selectVisitUpdate" class="form-control" required readonly>
                    <option value="">Select Visit</option>
                    <option value="inpatient">In-Patient</option>
                    <option value="outpatient">Out-Patient</option>
                  </select>
                </div>
                <div class="w-100"></div>
               
                <div class="col mt-3">
                  <label for="hospitalName">Hospital</label>
                  <input type="text" name="hospitalName" id="hospitalNameInputUpdate" class="form-control" value="" readonly >
                </div>
                <div class="col-sm-2 hidden">
                  <label for="clerk">Assisting Clerk</label>
                  <input type="text" value="" id="clerkUpdate" name="clerk" class="form-control" readonly>
                </div>
                <div class="col mt-3">
                  <label for="dateArrival">Admit Date</label>
                  <input type="text" value="" id="dateArrivalUpdate" name="dateArrival" class="form-control" readonly>
                </div>
                <div class="col mt-3">
                  <label for="dateDischarged">Discharged Date</label>
                  <input type="text" value="" id="dateDischargedUpdate" name="dateDischarged" class="form-control datepicker">
                </div>
                <div class="w-100"></div>
                {{-- <div class="w-100"></div> --}}
                <hr class="mt-2">
                <div class="w-100"></div>
                <div class="col">
                  <label for="chiefComplaint">Chief Complaint</label>
                  <textarea name="chiefComplaintUpdate" id="chiefComplaintUpdate" cols="30" rows="" class="form-control chiefComplaintUpdate shadow-none" readonly></textarea>
                </div>
                <div class="w-100 mb-3"></div>
                <hr>
                <div class="row">
                  <label for="">Final Diagnosis</label>
                </div>
                <div class="col-sm-2 p-1">
                  <label>ICD10 Code</label>
                  <input type="text" id="icdCodeUpdate" name="icdCode" class="form-control" readonly>
                  
                </div>
                <div class="col-sm-2 pt-2-5">
                  <br>
                  <span class="" id="selectICDUpdate">
                    <i id="selectIDS">Search</i>
                  </span>
                </div>
               <!--  <div class="col-sm-3">
                  <label for="icdCode">ICD10</label>
                  <select name="icdCode" id="icdCode" class="form-control">
                    @foreach ($icd10gets as $icd10get)
                        <option   value="{{$icd10get->icd10Code}}">{{$icd10get->icd10Code}}</option>
                    @endforeach
                  </select>
                </div> -->
                  <div class="col">
                    <label for="icdDesc">ICD10 Description</label>
                    <textarea name="icdDesc" id="icdDescUpdate" cols="30" rows="3" class="form-control shadow-none"  readonly></textarea>
                  </div>
                  {{-- <div class="w-100"></div> --}}
                <div class="col">
                  <label for="FinalDiagnosis"> Notes</label>
                  <textarea name="FinalDiagnosis" id="FinalDiagnosisUpdate" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <div class="w-100"></div>
                
                {{-- <div class="col">
                  <label for="dateArrival">Arrival Date/Time</label>
                  <input type="text" value="{{time('H')}}" id="dateArrivalUpdate" name="dateArrival" class="form-control" readonly>
                </div>- --}}
              </div>
          </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary">Close</button> --}}
          <button type="button" class="btn btn-primary" id="dischargeButton" disabled>Discharge</button>
        </div>
      </div>
    </div>
  </div>