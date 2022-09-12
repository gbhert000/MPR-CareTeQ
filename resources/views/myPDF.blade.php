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
      {{-- <footer>
        
         <div id="test">
          
            <p class="page"></p>
         </div>
     </footer> --}}
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
            <td colspan="6"  class="header" ><b>Father's Name</b> : <br> {{ $PatientInfo->FatherName }}</br> </td>
            <td colspan="6"  class="header" ><b>Phone No. : </b><br> 
            @if($PatientInfo->FatherTelNo != null)
               {{ $PatientInfo->FatherTelNo }}
            @endif
        
            </br></td>
         </tr>

         <tr>
            <td colspan="12"  class="header" ><b>Address : </b><br> {{ $PatientInfo->FatherAddress }}</br></td>
         </tr>
         <tr>
            <td colspan="6"  class="header" ><b>Mother's Name</b> : <br> {{ $PatientInfo->MotherName }}</br> </td>
            <td colspan="6"  class="header" ><b>Phone No. : </b><br> 
            @if($PatientInfo->MotherTelNo != null)
               {{ $PatientInfo->MotherTelNo }}
            @endif
      
            </br>
            </td>
         </tr>
         <tr>
            <td colspan="12"  class="header" ><b>Address : </b><br> {{ $PatientInfo->MotherAddress }}</br></td>
         </tr>
         <tr>
            <td colspan="6"  class="header" ><b>Spouse Name</b> : <br> {{ $PatientInfo->SpouseName }}</br> </td>
     
            <td colspan="6"  class="header" ><b>Phone No. : </b><br>
            @if($PatientInfo->SpouseTelNo != null)
               {{ $PatientInfo->SpouseTelNo }}
            @endif
      
            </br>
            </td>
         </tr>

         <tr>
            <td colspan="12"  class="header" ><b>Address : </b><br> {{ $PatientInfo->SpouseAddress }}</br></td>
         </tr>
         <tr>
            <td colspan="6"  class="header" ><b>Employer Name</b> : <br> {{ $PatientInfo->EmployerName }}</br> </td>
            <td colspan="6"  class="header" ><b>Phone No. : </b><br>  
            @if($PatientInfo->EmployerTelNo != null)
               {{ $PatientInfo->EmployerTelNo }}
            @endif
  
            </br>
         </td>
         </tr>
         <tr>
            <td colspan="12"  class="header" ><b>Address : </b><br> {{ $PatientInfo->EmployerAddress }}</br></td>
         </tr>
            
  
           <tr>
            <td colspan="12" class="header" style="background-color:rgb(177, 241, 241) "><center><b>HEALTH MAINTENANCE OGRANIZATION (HMO) INFORMATION</b><center></td>
         </tr>
    
         
         <tr>
            <td colspan="3"  class="header" ><b>HMO: </b> <br>
               @if ( $patient_HMO->FirsthmoName != null)
               @if ($patient_HMO->FirstotherHmoName != null)
                     {{ $patient_HMO->FirstotherHmoName }}
               @else
                   {{ $patient_HMO->FirsthmoName }} 
                @endif
            @else
            N/A
            @endif
            </br> </td>
            <td colspan="3"  class="header" ><b>ID/Account No. : </b><br>
               @if($patient_HMO->FirsthmoAccountID != null)
               {{$patient_HMO->FirsthmoAccountID  }}
               @else
               N/A
               @endif</br></td>
            <td colspan="3"  class="header" ><b>Client Type : </b><br> 
               @if($patient_HMO->FirstclientType != null)
               {{$patient_HMO->FirstclientType  }}
               @else
               N/A
               @endif</br></td>
            <td colspan="3"  class="header" ><b>Member Type : </b><br>
               @if($patient_HMO->Firstmembertype != null)
               {{$patient_HMO->Firstmembertype  }}
               @else
               N/A
               @endif</br></td>
         </tr>
         <tr>
            <td colspan="3"  class="header" ><b>Last Name :  </b> <br> 
               @if($patient_HMO->FirstmemberLname != null)
               {{$patient_HMO->FirstmemberLname }}
               @else
               N/A
               @endif</br> </td>
            <td colspan="3"  class="header" ><b>First Name : </b><br> 
               @if($patient_HMO->FirstmemberFname != null)
               {{$patient_HMO->FirstmemberFname  }}
               @else
               N/A
               @endif</br></td>
            <td colspan="3"  class="header" ><b>Middle Name : </b><br> 
               @if($patient_HMO->FirstmemberMname != null)
               {{$patient_HMO->FirstmemberMname }}
               @else
               N/A
               @endif</br></td>
            <td colspan="3"  class="header" ><b>Birthdate : </b><br>
               @if($patient_HMO->FirstmemberBDay != null)
               {{$patient_HMO->FirstmemberBDay  }}
               @else
               N/A
               @endif</br></td>
         </tr>


         <tr>
            <td colspan="3"  class="header" ><b>HMO: </b> <br>
               @if ( $patient_HMO->SecondhmoName != null)
               @if ($patient_HMO->SecondotherHmoName != null)
                     {{ $patient_HMO->SecondotherHmoName }}
               @else
                   {{ $patient_HMO->SecondhmoName }} 
                @endif
            @else
            N/A
            @endif
            </br> </td>
            <td colspan="3"  class="header" ><b>ID/Account No. : </b><br>
               @if($patient_HMO->SecondhmoAccountID != null)
               {{$patient_HMO->SecondhmoAccountID  }}
               @else
               N/A
               @endif</br></td>
            <td colspan="3"  class="header" ><b>Client Type : </b><br> 
               @if($patient_HMO->SecondclientType != null)
               {{$patient_HMO->SecondclientType  }}
               @else
               N/A
               @endif</br></td>
            <td colspan="3"  class="header" ><b>Member Type : </b><br>
               @if($patient_HMO->Secondmembertype != null)
               {{$patient_HMO->Secondmembertype  }}
               @else
               N/A
               @endif</br></td>
         </tr>
         <tr>
            <td colspan="3"  class="header" ><b>Last Name :  </b> <br> 
               @if($patient_HMO->SecondmemberLname != null)
               {{$patient_HMO->SecondmemberLname }}
               @else
               N/A
               @endif</br> </td>
            <td colspan="3"  class="header" ><b>Second Name : </b><br> 
               @if($patient_HMO->SecondmemberFname != null)
               {{$patient_HMO->SecondmemberFname  }}
               @else
               N/A
               @endif</br></td>
            <td colspan="3"  class="header" ><b>Middle Name : </b><br> 
               @if($patient_HMO->SecondmemberMname != null)
               {{$patient_HMO->SecondmemberMname }}
               @else
               N/A
               @endif</br></td>
            <td colspan="3"  class="header" ><b>Birthdate : </b><br>
               @if($patient_HMO->SecondmemberBDay != null)
               {{$patient_HMO->SecondmemberBDay  }}
               @else
               N/A
               @endif</br></td>
         </tr>

       
         <tr>
            <td colspan="12" class="header" style="background-color:rgb(177, 241, 241) "><center><b>RESPONSIBLE FOR DEPENDENT</b><center></td>
         </tr>
           
         <tr>
            <td colspan="3"  class="header" ><b>HMO: </b> <br>
               @if ( $patient_HMO->ThirdhmoName != null)
               @if ($patient_HMO->ThirdotherHmoName != null)
                     {{ $patient_HMO->ThirdotherHmoName }}
               @else
                   {{ $patient_HMO->ThirdhmoName }} 
                @endif
            @else
            N/A 
            @endif
            </br> </td>
            <td colspan="3"  class="header" ><b>ID/Account No. : </b><br>
               @if($patient_HMO->ThirdhmoAccountID != null)
               {{$patient_HMO->ThirdhmoAccountID  }}
               @else
               N/A
               @endif</br></td>
            <td colspan="3"  class="header" ><b>Client Type : </b><br> 
               @if($patient_HMO->ThirdclientType != null)
               {{$patient_HMO->ThirdclientType  }}
               @else
               N/A
               @endif</br></td>
            <td colspan="3"  class="header" ><b>Member Type : </b><br>
               @if($patient_HMO->Thirdmembertype != null)
               {{$patient_HMO->Thirdmembertype  }}
               @else
               N/A
               @endif</br></td>
         </tr>
         <tr>
            <td colspan="3"  class="header" ><b>Last Name :  </b> <br> 
               @if($patient_HMO->ThirdmemberLname != null)
               {{$patient_HMO->ThirdmemberLname }}
               @else
               N/A
               @endif</br> </td>
            <td colspan="3"  class="header" ><b>Third Name : </b><br> 
               @if($patient_HMO->ThirdmemberFname != null)
               {{$patient_HMO->ThirdmemberFname  }}
               @else
               N/A
               @endif</br></td>
            <td colspan="3"  class="header" ><b>Middle Name : </b><br> 
               @if($patient_HMO->ThirdmemberMname != null)
               {{$patient_HMO->ThirdmemberMname }}
               @else
               N/A
               @endif</br></td>
            <td colspan="3"  class="header" ><b>Birthdate : </b><br>
               @if($patient_HMO->ThirdmemberBDay != null)
               {{$patient_HMO->ThirdmemberBDay  }}
               @else
               N/A
               @endif</br></td>
         </tr>

          
           
         <tr>
            <td colspan="3"  class="header" ><b>Other HMO: </b> <br>
               @if ( $patient_HMO->FourthhmoName != null)
                  @if ($patient_HMO->FourthotherHmoName != null)
                        {{ $patient_HMO->FourthotherHmoName }}
                  @else
                      {{ $patient_HMO->FourthhmoName }} 
                   @endif
               @else
               N/A
               @endif
            </br> </td>
            <td colspan="3"  class="header" ><b>ID/Account No. : </b><br>
               @if($patient_HMO->FourthhmoAccountID != null)
               {{$patient_HMO->FourthhmoAccountID  }}
               @else
               N/A
               @endif</br></td>
            <td colspan="3"  class="header" ><b>Client Type : </b><br> 
               @if($patient_HMO->FourthclientType != null)
               {{$patient_HMO->FourthclientType  }}
               @else
               N/A
               @endif</br></td>
            <td colspan="3"  class="header" ><b>Member Type : </b><br>
               @if($patient_HMO->Fourthmembertype != null)
               {{$patient_HMO->Fourthmembertype  }}
               @else
               N/A
               @endif</br></td>
         </tr>
         <tr>
            <td colspan="3"  class="header" ><b>Last Name :  </b> <br> 
               @if($patient_HMO->FourthmemberLname != null)
               {{$patient_HMO->FourthmemberLname }}
               @else
               N/A
               @endif</br> </td>
            <td colspan="3"  class="header" ><b>Fourth Name : </b><br> 
               @if($patient_HMO->FourthmemberFname != null)
               {{$patient_HMO->FourthmemberFname  }}
               @else
               N/A
               @endif</br></td>
            <td colspan="3"  class="header" ><b>Middle Name : </b><br> 
               @if($patient_HMO->FourthmemberMname != null)
               {{$patient_HMO->FourthmemberMname }}
               @else
               N/A
               @endif</br></td>
            <td colspan="3"  class="header" ><b>Birthdate : </b><br>
               @if($patient_HMO->FourthmemberBDay != null)
               {{$patient_HMO->FourthmemberBDay  }}
               @else
               N/A
               @endif</br></td>
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