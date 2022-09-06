<!DOCTYPE html>
<html>
   <head>
      <style>
         table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
         }
         .title{
            font-size: 25px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-weight:normal;
         }
         .header{
            font-size: 10px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-weight:normal;
      
         }
         /* #footer { }
       position: fixed; left: 0px;
        #footer .page:after { content: "Page "counter(page, decimal) " of " counter(page, decimal) ; }
     @page { margin: 20px 30px 40px 50px; } */
     #date {position: fixed; left: 0px; bottom: -30px; text-align: center;font-size: 13px;}
     #test .page:after { content: "Page "counter(page, decimal) " of " counter(page, decimal) ; }
     @page { margin: 20px 30px 40px 50px; }
     footer {
      position: fixed; right: 0px; bottom: -30px; text-align: center;font-size: 13px;
            }
         
      </style>
   </head>
   <body>
      <div id="date">
         <p class="page">   <p >Printed By: {{ Auth::user()->name }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date Printed: {{ date('m/d/Y') }} </p>
      </p>
       </div> 
      <footer>
        
         <div id="test">
          
            <p class="page"></p>
         </div>
     </footer>
     <main>
    
      @foreach ($PatientInfos as $PatientInfo)
   <table>
      <tr>
         <th colspan="2" rowspan="3">  <img src='data:image/jpeg;base64,{{$imageLogo}}' width="100px" height="100px"/></th>
         <th class="title"  colspan="4">Master Patient Record</th>
         <th colspan="4" class="header">Master Patient Index (MPI)<br>{{ $PatientInfo->MPI }}</th>
         <th colspan="2" rowspan="3"><img src="{{$imageF}}" width="120px" height="120px"></th>
      </tr>
      <tr>
         <td class="header" colspan="2"><b>Last Name:</b>
               <br>  {{ $PatientInfo->LastName }}
         </td>
         <td class="header" colspan="2"> <b>First Name:</b>
               <br>{{ $PatientInfo->FirstName }}</td>
         <td class="header"colspan="2"><b>Middle Name:</b>
               <br> {{ $PatientInfo->MiddleName }}</td>
         <td class="header" colspan="2"><b>Ext. Name:</b><br>{{ $PatientInfo->ExtensionName}}</td>
      </tr>
      <tr>
         <td class="header" colspan="2"><b>Sex :
         </b> <br>{{ $PatientInfo->Sex }}
         </td>
         <td class="header"colspan="2"><b>Birth Place :</b><br>{{ $PatientInfo->BirthPlace }}</td>
         <td class="header"colspan="2"><b>Birth Date:</b><br> {{ $PatientInfo->Birthdate }}</td>
         <td class="header" colspan="2"><b>Age :</b><br>{{ $PatientInfo->Age }} </td>
      </tr>
      <tr>
         <td colspan="12" class="header" style="background-color:rgb(177, 241, 241)"><center><b>Patient Information</b><center></td>
         
      </tr>
      <tr>
         <td colspan="3"  class="header" ><b>Nationality</b> : <br> {{ $PatientInfo->Nationality}}</br> </td>
         <td colspan="3"  class="header" ><b>Occupation : </b><br>{{ $PatientInfo->Occupation}}</br></td>
            <td colspan="3"  class="header" ><b>Marital Status : </b><br> {{ $PatientInfo->MaritalStatus}}</br></td>
            <td colspan="3"  class="header" ><b>Religion : </b><br> {{ $PatientInfo->Religion}}</br></td>
         </tr>
      
         <tr>
            <td colspan="12"  class="header" ><b>Address</b> : <br> {{ $PatientInfo->Address}}</br> </td>
         </tr>
         @foreach ($PatientContact as $PatientContacts )
         <tr>
            <td colspan="12"  class="header" ><b>Phone no. :</b>  <br> {{ $PatientContacts->contactNumber}}</br> </td>
          
         
         </tr>
         @endforeach
         
         <tr>
            <td colspan="12" class="header" style="background-color:rgb(177, 241, 241)"><center><b>BACKGROUND DETAILS</b><center></td>
         </tr>
         <tr>
            <td colspan="3"  class="header" ><b>Father's Name</b> : <br> {{ $PatientInfo->FatherName }}</br> </td>
            <td colspan="5"  class="header" ><b>Address : </b><br> {{ $PatientInfo->FatherAddress }}</br></td>
            <td colspan="4"  class="header" ><b>Phone No. : </b><br> 
            @if($PatientInfo->FatherTelNo != null)
               {{ $PatientInfo->FatherTelNo }}
            @endif
        
            </br></td>
         </tr>
         <tr>
            <td colspan="3"  class="header" ><b>Mother's Name</b> : <br> {{ $PatientInfo->MotherName }}</br> </td>
            <td colspan="5"  class="header" ><b>Address : </b><br> {{ $PatientInfo->MotherAddress }}</br></td>
            <td colspan="4"  class="header" ><b>Phone No. : </b><br> 
            @if($PatientInfo->MotherTelNo != null)
               {{ $PatientInfo->MotherTelNo }}
            @endif
      
            </br>
            </td>
         </tr>
         <tr>
            <td colspan="3"  class="header" ><b>Spouse Name</b> : <br> {{ $PatientInfo->SpouseName }}</br> </td>
            <td colspan="5"  class="header" ><b>Address : </b><br> {{ $PatientInfo->SpouseAddress }}</br></td>
            <td colspan="4"  class="header" ><b>Phone No. : </b><br>
            @if($PatientInfo->SpouseTelNo != null)
               {{ $PatientInfo->SpouseTelNo }}
            @endif
      
            </br>
            </td>
         </tr>
         <tr>
            <td colspan="3"  class="header" ><b>Employer Name</b> : <br> {{ $PatientInfo->EmployerName }}</br> </td>
            <td colspan="5"  class="header" ><b>Address : </b><br> {{ $PatientInfo->EmployerAddress }}</br></td>
            <td colspan="4"  class="header" ><b>Phone No. : </b><br>  
            @if($PatientInfo->EmployerTelNo != null)
               {{ $PatientInfo->EmployerTelNo }}
            @endif
  
            </br>
         </td>
         </tr>
      
      
            <tr>
               <td colspan="12" class="header" style="background-color:rgb(177, 241, 241) "><center><b>HEALTH MAINTENANCE OGRANIZATION (HMO) INFORMATION</b><center></td>
            </tr>
            <tr>
               <td colspan="6"  class="header" ><b>Is this person a patient here?</b>  <br> Yes</br> </td>
               <td colspan="6"  class="header" ><b>Is this patient covered by insurance?</b><br> Yes</br></td>
            
            </tr>
            <tr>
               <td colspan="3"  class="header" ><b>HMO: </b> <br>{{ $PatientInfo->HMOName }}</br> </td>
               <td colspan="3"  class="header" ><b>ID/Account No. : </b><br>{{ $PatientInfo->HMOID }}</br></td>
               <td colspan="3"  class="header" ><b>Client Type : </b><br> {{ $PatientInfo->HMOClientType }}</br></td>
               <td colspan="3"  class="header" ><b>Member Type : </b><br>{{ $PatientInfo->HMOMemberType }}</br></td>
            </tr>
            <tr>
               <td colspan="3"  class="header" ><b>Last Name :  </b> <br> {{ $PatientInfo->HMOLName }}</br> </td>
               <td colspan="3"  class="header" ><b>First Name : </b><br> {{ $PatientInfo->HMOFName }}</br></td>
               <td colspan="3"  class="header" ><b>Middle Name : </b><br> {{ $PatientInfo->HMOMName }}</br></td>
               <td colspan="3"  class="header" ><b>Birthdate : </b><br> {{ $PatientInfo->HMOBday }}</br></td>
            </tr>
            <tr>
               <td colspan="3"  class="header" ><b>Other HMO: </b> <br>N/A &nbsp;</br> </td>
               <td colspan="3"  class="header" ><b>ID/Account No. : </b><br>N/A &nbsp;</br></td>
               <td colspan="3"  class="header" ><b>Client Type : </b><br>N/A &nbsp;</br></td>
               <td colspan="3"  class="header" ><b>Member Type : </b><br>N/A &nbsp;</br></td>
            </tr>
            <tr>
               <td colspan="3"  class="header" ><b>Last Name :  </b> <br>N/A &nbsp;</br> </td>
               <td colspan="3"  class="header" ><b>First Name : </b><br>N/A &nbsp;</br></td>
               <td colspan="3"  class="header" ><b>Middle Name : </b><br>N/A &nbsp;</br></td>
               <td colspan="3"  class="header" ><b>Birthdate : </b><br>N/A &nbsp;</br></td>
            </tr>
            <tr>
               <td colspan="12" class="header" style="background-color:rgb(177, 241, 241)"><center><b>RESPONSIBLE FOR DEPENDENT</b><center></td>
            </tr>
            <tr>
               <td colspan="3"  class="header" ><b>HMO: </b> <br>N/A &nbsp;</br> </td>
               <td colspan="3"  class="header" ><b>ID/Account No. : </b><br>N/A &nbsp;</br></td>
               <td colspan="3"  class="header" ><b>Client Type : </b><br>N/A &nbsp;</br></td>
               <td colspan="3"  class="header" ><b>Member Type : </b><br>N/A &nbsp;</br></td>
            </tr>
            <tr>
               <td colspan="3"  class="header" ><b>Last Name :  </b> <br>N/A &nbsp;</br> </td>
               <td colspan="3"  class="header" ><b>First Name : </b><br>N/A &nbsp;</br></td>
               <td colspan="3"  class="header" ><b>Middle Name : </b><br>N/A &nbsp;</br></td>
               <td colspan="3"  class="header" ><b>Birthdate : </b><br>N/A &nbsp;</br></td>
            </tr>
            <tr>
               <td colspan="12" class="header" style="background-color:rgb(177, 241, 241)"><center><b>EMERGENCY CONTACT</b><center></td>
            </tr>
            <tr>
               <td colspan="3"  class="header" ><b>Name of local friend or relative : <br>  (not living at same address)</b> <br>{{$U_CONTACTNAME}}</br> </td>
               <td colspan="3"  class="header" ><b>Relationship to patient : </b></br><br> {{$U_CONTACTRELATIONSHIP}}</br></td>
               <td colspan="3"  class="header" ><b>Home phone no. : </b><br> {{$U_CONTACTTELNO}}</br></td>
               <td colspan="3"  class="header" ><b>Telephone no. : </b><br> {{$U_CONTACTTELNO}}</br></td>
            </tr>
            <tr>
               <td colspan="12"  class="header" ><b>Temporary address</b> : <br> {{$U_CONTACTADDRESS}}</br> </td>
               
               
            </tr>
            <tr>
               <td colspan="12"  class="header" ><b>Permanent address : </b><br> {{$U_CONTACTADDRESS}}</br></td>
            </tr>
            <tr>
               <td colspan="12" class="header" style="background-color:rgb(177, 241, 241)"><center><b>RESPONSIBLE FOR HOSPITAL ACCOUNT</b><center></td>
            </tr>
            <tr>
               <td colspan="3"  class="header" >
                  <b>Name of local friend or relative : <br>  (not living at same address)</b>  <br>{{$U_RESPONSIBLENAME}}</br> 
               </td>
               <td colspan="3"  class="header" >
                  <b>Relationship to patient : </b></br><br> {{$U_RESPONSIBLERELATIONSHIP}}</br>
               </td>
               <td colspan="3"  class="header" >
                  <b>Home phone no. : </b><br> {{$U_MOBILENO}}</br>
               </td>
               <td colspan="3"  class="header" >
                  <b>Telephone no. : </b><br> {{$U_RESPONSIBLETELNO}}</br>
               </td>
            </tr>
            <tr>
               <td colspan="6"  class="header" ><b>Temporary address</b> : <br> {{$U_RESPONSIBLESTREET}} &nbsp; {{$U_RESPONSIBLEBARANGAY}} &nbsp; {{$U_RESPONSIBLECITY}} &nbsp; {{$U_RESPONSIBLEPROVINCE}} &nbsp; {{$U_RESPONSIBLEZIP}} &nbsp; {{$U_RESPONSIBLECOUNTRY}}</br> </td>
               <td colspan="6"  class="header" ><b>Occupation : </b><br>N/A &nbsp;</br></td>
               
            </tr>
            <tr>
               <td colspan="3"  class="header" ><b>Hospital ID</b> : <br>N/A &nbsp; </br> </td>
               <td colspan="5"  class="header" ><b>Hospital Name : </b><br>N/A &nbsp;</br></td>
               <td colspan="4"  class="header" ><b>Registry type : </b><br>N/A &nbsp;</br></td>
            </tr>
            <tr>
               <td colspan="12" class="header" style="background-color:rgb(177, 241, 241)"><center><b>LAST VISIT RECORD</b><center></td>
            </tr>
            <tr>
               <td colspan="6"  class="header" ><b>Start-date:&nbsp;</b>
                  <br>
                  @if($U_STARTDATE != null)
                     {{$U_STARTDATE}}
                     @endif
                  
                  </br> 
               </td>
               <td colspan="6"  class="header" ><b>End-date:&nbsp;</b>
                <br>
                  @if($U_ENDDATE != null)
                {{$U_ENDDATE}}
                  @endif
               
               </br></td>

            
              
            </tr>
            <tr>
               <td colspan="12"  class="header" ><b>Primary and Chief complaints : </b>
                  <br> 
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$CHIEFCOMPLAINT}}</br></td>
            </tr>
            <tr>
               <td colspan="12"  class="header" ><b>Final diagnosis : </b><br>
             
                
                     
                     <ul>
                        <li>{{$U_ICDCODE}} &nbsp; {{$U_ICDDESC}} &nbsp;</li>   
                     </ul>
                     <br> 
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$NOTES}}
                  
                  </br> </td>
            </tr>
   </table> 
   
   <BR>
       
      <table >

         <tr>
            <td colspan="12"   style="background-color:rgb(177, 241, 241);   font-size: 12px;
          
            font-weight:normal; ">
               <center><b><pre>                                   LAST HOSPITAL VISIT RECORDS                                       </pre></b><center></td>
      

         </tr>
         <tr>
            <td  colspan="3" class="header" ><Center><b>Hospital ID</b> </Center> </td>
            <td  colspan="5" class="header" ><Center><b>Hospital Name </Center></td>
            <td colspan="4" class="header" ><Center><b>Registry type </Center></td>
         </tr>
         <tr>
            <td colspan="3"  class="header" ><Center>&nbsp; </Center> </td>
            <td colspan="5"  class="header" ><Center>{{$COMPANY}}</Center></td>
            <td colspan="4" class="header" ><Center> {{$VISITTYPE}}</Center></td>
         </tr>
      </table>
      
      <br>
      
     
{{-- <div id="footer">
   <p class="page"> </p>
 </div>  --}}

{{--  
   <button onclick="window.print()">Print this page</button> --}}
   @endforeach

  </main>
   

   </body>
</html>