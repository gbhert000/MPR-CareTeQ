<!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="btn-close"  aria-label="Close" id="closeReset" onclick="resetInput()"></button>
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="html-content">
            <div class="container">
                <table class="table table-bordered border border-dark">
                    <thead>
                      <div class="container">
                        <div class="row border border-dark"><span style="text-align: center; font-weight:bold; font-size:25px;">MASTER PATIENT LIST</span></div>
                      </div>
                       <div class="container">
                        <div class="row">
                            <div class="col-2 border border-dark">
                             <img src="img/panga.png" class="rounded mx-auto d-block w-50">
                            </div>
                            <div class="col-3 border border-dark " style="text-align: center;">
                              <p class="2ndcol" style="font-weight: bold;"> Hospital Name:</p>
                            </div>
                            <div class="col-3 border border-dark text -center" style="text-align: center;">
                              <p class="2ndcol" style="font-weight: bold;">PPH 1, GGH</p>
                            </div>
                            <div class="col border border-dark" style="text-align: center;">
                                <p class="2ndcol" style="font-weight: bold;">Registered<br>Patient:</p>
                              </div>
                              <div class="col-1 border border-dark" style="text-align: center;">

                              </div>
                       </div>
                       <div class="row">
                        <div class="col-8 border border-dark " style="text-align: center;">
                          <p class="2ndcol" style="font-weight: bold;">PERIOD: FROM FEBRUARY 20 2022 TO APRIL 30 2022</p>
                        </div>
                        <div class="col border border-dark " style="text-align: center;">
                          <p class="2ndcol" style="font-weight: bold;">total registered<br>patient:</p>
                        </div>
                        <div class="col-1 border border-dark " style="text-align: center;">
                          <p class="2ndcol" style="font-weight: bold;"></p>
                        </div>
                       </div>
                      <tr>
                        <th scope="col" class="col-1"><p style="text-align: center;">NO.</p></th>
                        <th scope="col" class="col-2"><p style="text-align: center;">Master Patient Index</p></th>
                        <th scope="col" class="col-1"><p style="text-align: center;">First Name</p></th>
                        <th scope="col" class="col-1"><p style="text-align: center;">Middle</p></th>
                        <th scope="col" class="col-1"><p style="text-align: center;">Last Name</p></th>
                        <th scope="col" class="col-2"><p style="text-align: center;">Registered</p></th>
                        <th scope="col" class="col"><p style="text-align: center;">Address</p></th>
                        <th scope="col" class="col-1"><p style="text-align: center;">Age</p></th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i=1 @endphp
                        @foreach($patients as $item)
                      <tr>
                        <th scope="row" style="text-align: center;">{{$i}}</th>
                        <td>{{$item->CODE}}</td>
                        <td>{{$item->U_FIRSTNAME}}</td>
                        <td>{{$item->U_MIDDLENAME}}</td>
                        <td>{{$item->U_LASTNAME}}</td>
                        <td>{{$item->DATECREATED}}</td>
                        <td>{{$item->U_ADDRESS}}</td>
                        <td>{{$item->U_AGE}}</td>
                      </tr>
                      @php $i++ @endphp
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <button wire:click="getArray()">PRINT</button>
        </div>
        <button > asd</button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button onclick="print()">Save changes</button>
        </div>
      </div>
    </div>
  </div>
