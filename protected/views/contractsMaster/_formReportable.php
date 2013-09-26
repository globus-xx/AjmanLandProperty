<meta charset="UTF-8">
<div class="form">
    
     <p class="note">الحقول المميزة بالعلامة  <span class="required">*</span> مطلوبة .     </p>
     
     <h3>قم بتضمين الحقول في التقرير</h3>
     <p>قم بالتأكد من كل الحقول التي تريد تضمينها في هذا التقرير</p>
     
     
     <div style="direction: ltr;width:500px;float:left">
         <h1>1. Contracts Source:</h1>
         <table>
         <tr><th colspan="5">ContractMaster</th></tr>    
         <tr><td><input type="checkbox" /></td><td>Date</td><td>From : <input type="text" value="should be date picker" /></td><td>To : <input type="text" value="should be date picker" /></td><td></td></tr>    
         <tr><td><input type="checkbox" /></td><td>UserID</td><td><select><option>8787</option> <option>98986565</option></select></td><td></td><td></td></tr>    
         <tr><td><input type="checkbox" /></td><td>ContractType</td><td><select><option>بيع</option> <option>شراء</option></select></td><td></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>AmountCorrected</td><td><select><option>></option> <option><</option> <option>>=</option> <option><=</option>  <option>=</option> </select></td><td><input type="text" value="Value To Be Compared" /></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>Fee</td><td><select><option>></option> <option><</option> <option>>=</option> <option><=</option>  <option>=</option> </select></td><td><input type="text" value="Value To Be Compared" /></td><td></td></tr>         
         </table>
     </div>
     
     <div style="direction: ltr;width:500px;float:left">
         <table>
         <tr><th colspan="5">ContractDetails</th></tr>    
         <tr><td colspan="5">Buyer</td></tr>
         <tr><td><input type="checkbox" /></td><td>Age</td><td><select><option>></option> <option><</option> <option>>=</option> <option><=</option>  <option>=</option> </select></td><td><input type="text" value="Value To Be Compared" /></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>Nationality</td><td><select><option>Syrian</option> <option>local</option></select></td><td></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>Name</td><td><input type="text" value="auto complete textbox" /></td><td></td><td></td></tr>    
         
         <tr><td colspan="5">Seller</td></tr>
         <tr><td><input type="checkbox" /></td><td>Age</td><td><select><option>></option> <option><</option> <option>>=</option> <option><=</option>  <option>=</option> </select></td><td><input type="text" value="Value To Be Compared" /></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>Nationality</td><td><select><option>Syrian</option> <option>local</option></select></td><td></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>Name</td><td><input type="text" value="auto complete textbox" /></td><td></td><td></td></tr>                      
         </table>
     </div>
     
     
     
     <div style="direction: ltr;width:500px;float:left">
         <table>
         <tr><th colspan="5">LandMaster</th></tr>                      
         <tr><td><input type="checkbox" /></td><td>LocationID</td><td><select><option>2121</option> <option>8787</option></select></td><td></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>Plot_No</td><td><select><option>785</option> <option>789</option></select></td><td></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>Location</td><td><select><option>citycenter</option> <option>safouh</option></select></td><td></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>LandType</td><td><select><option>Grand</option> <option>Super</option></select></td><td></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>TotalArea</td><td><select><option>></option> <option><</option> <option>>=</option> <option><=</option>  <option>=</option> </select></td><td><input type="text" value="Value To Be Compared" /></td><td></td></tr>                 
         </table>
     </div>
     
     
     <div style="direction: ltr;width:500px;float:left">
         <table>
         <tr><th colspan="5">Real Estate</th></tr>                      
         <tr><td><input type="checkbox" /></td><td>NameOfOffice</td><td></td><td></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>NameOfWaseet</td><td></td><td></td><td></td></tr>                                           
         </table>
     </div>
     
     
     
     <div style="direction: ltr;width:500px;float:left">
         <h3>Grouping Area :</h3>
         <textarea name="textarea" style="width:250px;height:60px;">
            Naionality 
            LocationID 
            ContractType 
         </textarea>
     </div>
     
     
     <div style="direction: ltr;width:500px;float:left">
         <br><br>
         <h3>Report Shape For Exapmle If I Choose The Report Feilds:</h3>
         
         <table>
             <tr><th colspan="4">Nationality</th></tr>
             
             <tr><th>LocationID</th><th>Plot_No</th><th>Location</th><th>Name</th></tr>             
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             
             <tr><td></td><td></td><td></td><td><b>AmountCorrected</b> : 2225</td></tr>
             <tr><td></td><td></td><td></td><td><b>Fees</b> : 4585</td></tr>
             <tr><td></td><td></td><td></td><td><b>count of the group</b> : 5</td></tr>
             
             
             
             <tr><th colspan="4">LocationID</th></tr>
             
             <tr><th>LocationID</th><th>Plot_No</th><th>Location</th><th>Name</th></tr>             
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             
             <tr><td></td><td></td><td></td><td><b>AmountCorrected</b> : 2225</td></tr>
             <tr><td></td><td></td><td></td><td><b>Fees</b> : 4585</td></tr>
             <tr><td></td><td></td><td></td><td><b>count of the group</b> : 5</td></tr>
             
             
             
             <tr><th colspan="4">ContractType</th></tr>
             
             <tr><th>LocationID</th><th>Plot_No</th><th>Location</th><th>Name</th></tr>             
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             
             <tr><td></td><td></td><td></td><td><b>AmountCorrected</b> : 2225</td></tr>
             <tr><td></td><td></td><td></td><td><b>Fees</b> : 4585</td></tr>
             <tr><td></td><td></td><td></td><td><b>count of the group</b> : 5</td></tr>
             
             <tr><td colspan="4"><hr></td></tr>
             <tr><td></td><td></td><td></td><td><b>Total AmountCorrected</b> : 2225</td></tr>
             <tr><td></td><td></td><td></td><td><b>Total Fees</b> : 4585</td></tr>
             <tr><td></td><td></td><td></td><td><b>Total count of the group</b> : 15 </td></tr>
             
         </table>
     </div>
     
     
     
     <div style="direction: ltr;width:500px;float:left">
         <br></br>
         <h1>2. Deeds Source:</h1>
         <table>
         <tr><th colspan="5">DeedMaster</th></tr>    
         <tr><td><input type="checkbox" /></td><td>DateCreated</td><td>From : <input type="text" value="should be date picker" /></td><td>To : <input type="text" value="should be date picker" /></td><td></td></tr>    
         <tr><td><input type="checkbox" /></td><td>UserID</td><td><select><option>8787</option> <option>98986565</option></select></td><td></td><td></td></tr>    
         <tr><td><input type="checkbox" /></td><td>ContractID</td><td></td><td></td><td></td></tr>          
         <tr><td><input type="checkbox" /></td><td>ArchiveUpdate</td><td><select><option>False</option> <option>True</option></select></td><td></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>Remarks</td><td><select><option>Canceled</option> <option>0</option></select></td><td></td><td></td></tr>         
         </table>
     </div>
     
     
     
     <div style="direction: ltr;width:500px;float:left">         
         <table>
         <tr><th colspan="5">DeedDetails</th></tr>    
         <tr><td><input type="checkbox" /></td><td>Age</td><td><select><option>></option> <option><</option> <option>>=</option> <option><=</option>  <option>=</option> </select></td><td><input type="text" value="Value To Be Compared" /></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>Nationality</td><td><select><option>Syrian</option> <option>local</option></select></td><td></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>Name</td><td><input type="text" value="auto complete textbox" /></td><td></td><td></td></tr>    
         </table>
     </div>
     
     
     
     <div style="direction: ltr;width:500px;float:left">
         <table>
         <tr><th colspan="5">LandMaster</th></tr>                      
         <tr><td><input type="checkbox" /></td><td>LocationID</td><td><select><option>2121</option> <option>8787</option></select></td><td></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>Plot_No</td><td><select><option>785</option> <option>789</option></select></td><td></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>Location</td><td><select><option>citycenter</option> <option>safouh</option></select></td><td></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>LandType</td><td><select><option>Grand</option> <option>Super</option></select></td><td></td><td></td></tr>
         <tr><td><input type="checkbox" /></td><td>TotalArea</td><td><select><option>></option> <option><</option> <option>>=</option> <option><=</option>  <option>=</option> </select></td><td><input type="text" value="Value To Be Compared" /></td><td></td></tr>                 
         </table>
     </div>
     
     
     <div style="direction: ltr;width:500px;float:left">
         <h3>Grouping Area :</h3>
         <textarea name="textarea" style="width:250px;height:60px;">
            Naionality 
            LocationID 
            ContractType 
         </textarea>
     </div>
     
     <div style="direction: ltr;width:500px;float:left">
         <br><br>
         <h3>Report Shape For Exapmle If I Choose The Report Feilds (Same As Previous Except That Total is only groupp count ):</h3>
         
         <table>
             <tr><th colspan="4">Nationality</th></tr>
             
             <tr><th>LocationID</th><th>Plot_No</th><th>Location</th><th>Name</th></tr>             
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             
             <tr><td></td><td></td><td></td><td><b>count of the group</b> : 5</td></tr>
             
             
             
             <tr><th colspan="4">LocationID</th></tr>
             
             <tr><th>LocationID</th><th>Plot_No</th><th>Location</th><th>Name</th></tr>             
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             
             <tr><td></td><td></td><td></td><td><b>count of the group</b> : 5</td></tr>
             
             
             
             <tr><th colspan="4">ContractType</th></tr>
             
             <tr><th>LocationID</th><th>Plot_No</th><th>Location</th><th>Name</th></tr>             
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             <tr><td>654</td><td>321</td><td>citycenter</td><td>Ahmad Alnuimi</td></tr>
             
             <tr><td></td><td></td><td></td><td><b>count of the group</b> : 5</td></tr>
             <tr><td colspan="4"><hr></td></tr>
             <tr><td></td><td></td><td></td><td><b>Total count of the group</b> : 15 </td></tr>
         </table>
     </div>
     
     
     <h3>Note : There Is Other Notes In The Documentation This Page Only For Shape Clarification</h3>      
     
</div><!-- form -->


