<?php 
  include("dbConnection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link href="style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="jquery.js"></script>
</head>

<body>

<!-- Modal -->
<!-- Insert Modal -->
<div class="modal fade" id="insert_edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title text-success" id="main_title"></h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form>
  <div class="mb-1">
    <label for="exampleInputEmail1" class="form_label">Firstname:</label>
    <input id="firstname" type="text" class="form-control" name="first_name"  placeholder = "Enter Firstname " >
    <div id="firstHelp" style="visibility:hidden" class="text-danger fw-bold mt-1 fs-6">Please enter firstname!!!</div>
  </div>
  <div class="mb-1">
    <label for="last_name" class="form_label">Lastname:</label>
    <input type="text" class="form-control" name="last_name" id="lastname" placeholder = "Enter Lastname">
    <div id="lastHelp" style="visibility:hidden"  class="text-danger fw-bold mt-1 fs-6">Please enter lastname!!!</div>
  </div>
    <div class="mb-3 role_container">
    <label class="form_label" for="user_role">Role:</label>
    <div class="select_container">
    <select class="form-select" id="user_role" >
       <option value="1">User</option>
       <option value="2">Admin</option>
   </select>
   </div>
   </div>
   <div class="status_container">
      <label class="form_label">Status:</label>  
      <label class="switch">
      <input id="user_status" value="" type="checkbox">
      <span class="slider round"></span>
     </label>
    </div>
    </form>

  </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary" id="insert_update_data" name="update_data" class="btn btn-primary">Save changes</button>
       </div>
    </div>
  </div>
 </form>
</div>
</div>

<!-- Delete modal -->

<div class="modal" id="deletemodal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title text-danger">Delete Alert</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-warning">Are you sure that you want to delete user</p>
          <div>
            <p class="text-info fw-bolder">UserFullName: <span id="delete_fullname" class="text-primary fw-bolder"></span></p>
        </div>      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="delete_btn" data-bs-dismiss="modal" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>     

<div class="header">
    <h1 class="header_highlight">Managment System</h1>
</div>
<div class="table_conntainer" >
<div>

 <?php 
  $indecator = "confirm_top_group";
  include 'includes/group.php'; 
  ?> 
<div class="table_conn"  >
<table  class="content_table table table-hover" > 
 <thead >
  <tr>
    <th class="w-25"> <input id="main_checkbox" type="checkbox"></th>
    <th class="w-75">Name</th>
    <th class="w-25">Role</th>
    <th class="w-25">Status</th>
    <th class="w-25" style="text-align: center;">Action</th>
  </tr>
 </thead>
 
 <tbody id="table">
   <?php 
     $query = "SELECT * FROM users";
     $sth = $dbh->prepare($query);
     $sth->execute();
     $result = $sth->fetchAll();
     
     if ($result) {
        foreach($result as $row) { ?>      
            <tr class="table-info" id="<?php echo $row["id"]; ?>">
              <td><input class="check_input" id="<?php echo $row["id"]; ?>" value="<?php echo $row["id"]; ?>" type="checkbox" name="type"></td>
              <td class="h4 align-middle" id="full_name<?php echo $row["id"]; ?>"><?php echo $row["username"]." ". $row["userfamilyname"]; ?></td>
              <td class="h4 align-middle " id="user_role<?php echo $row["id"]; ?>"><?php echo $row["user_role"]; ?></td>
              <td><div class="status_container"><div id="user_status<?php echo $row["id"]; ?>" style="background-color:<?php if($row["user_status"] > 0) { echo "green";}?>" class="status"></div></div></td>
              <td>
               <div class="btn_group">
                  <button class="btn edit btn-primary" popovertarget="<?php echo $row["id"]?>"  type="submit">Edit</button>
                  <button class="btn delete btn-danger" popovertarget="<?php echo $row["id"]?>" value="<?php echo $row["id"]; ?>" type="submit">Delete</button>
               </div>
            </td>
          </tr>   
        
        <?php  } ?>
     <?php } ?>
  
  </tbody>
</table> 
        </div>
<div>
<?php 
  $indecator = "confirm_bottom_group";
  include 'includes/group.php'; 
?> 

</div>
</div>
</div>
<div class="modal" id="groupmodal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 id="group_modal" class="modal-title text-danger">Group Action</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div>
             <h3 id="error_hg" class="text-danger fw-bolder"></h3>
        </div>
          <div>
             <p id="error_massage" class="text-danger fw-bolder"></p>
        </div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Understood</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>

function setInputObservers() {
  const firstname = document.getElementById("firstname");
  const lastname = document.getElementById("lastname");
  firstname.addEventListener("input", handleValueChange);
  lastname.addEventListener("input", handleValueChange);
}

setInputObservers();

function handleValueChange(e) {
     let checkedInputStr;
     let inputString = e.target.value
     console.log(e.target.value)
     checkedInputStr = inputString.replaceAll(' ', '');
     if (checkedInputStr.length > 0 ) {
         if (e.target.id === "firstname"){
             document.getElementById("firstHelp").style.visibility = "hidden"
         }else if (e.target.id === "lastname") {
              document.getElementById("lastHelp").style.visibility = "hidden"
         }
     }
}

// Group Action 
$('input[name=type]').click(function() {
   inputClicked() 
});

function inputClicked()  {
let mainCheck = true;
let inputList = document.getElementsByClassName('check_input');
let main_checkbox = document.getElementById("main_checkbox")

for (let item of inputList) {
   if (!item.checked) {
    mainCheck = false;
   }
}
main_checkbox.checked = mainCheck;

}

$(document).ready( function (){
  $("#main_checkbox").click( function(e) {
   let allUsersSelected = $('#main_checkbox').is(':checked');
   if (allUsersSelected) {
    $('input:checkbox').prop('checked', true);
   }else {
    $('input:checkbox').prop('checked', false);
   }
  })
})

$(document).ready( function (){
  $("#confirm_top_group").click(function() {
    console.log("uuu")
    let selectorValue =  $(".form-select-top").val();
    groupAction(selectorValue)
  });
})
$(document).ready( function (){
  $("#confirm_bottom_group").click(function() {4
    let groupBtnValue = document.getElementsByClassName("confirm_grouo_op")[1];
    console.log(groupBtnValue)
    let selectorValue = $("#form-select-bottom").val()
    groupAction(selectorValue)
  })
})

function groupAction(selectorValue) {
   let arrSelectedInputs = []
    $("input:checkbox[name=type]:checked").each(function(){
      console.log($(this).val())
      arrSelectedInputs.push($(this).val());
    });

    document.getElementById("group_modal").innerHTML = "Group Action";
    document.getElementById("error_hg").innerHTML=""
    if (arrSelectedInputs.length === 0 && selectorValue==="0") {
      document.getElementById("error_massage").innerHTML="Please select action and users";
      $('#groupmodal').modal('show');
      return;
    }else if (arrSelectedInputs.length === 0) {
      document.getElementById("error_massage").innerHTML="Please select users";
      $('#groupmodal').modal('show');
      return;
    }else if (selectorValue==="0"){
      document.getElementById("error_massage").innerHTML="Please select action";
      $('#groupmodal').modal('show');
      return;
    }

    $.ajax({
    dataType: "json",
    method: "POST",
    url: "groupAction.php",
    data: {
      "click_group_btn": selectorValue,
      "users_id": arrSelectedInputs,
    },
    success: function(rsp) {
      const response = JSON.parse(rsp);
      if(response["status"]===false  ) {
         document.getElementById("group_modal").innerHTML = "Group Action";
         document.getElementById("error_hg").innerHTML=response["error"]["code"];
         document.getElementById("error_massage").innerHTML=response["error"]["massage"];
         $('#groupmodal').modal('show');
        return;
      }

      let elementsIdChange = response["ids"];
      elementsIdChange.forEach(id=> {
          let dynamicId = "#user_status"
          dynamicId += id
          if (selectorValue === "1") {
            $(dynamicId).css("background-color", "green");
          }else if (selectorValue === "2"){
            $(dynamicId).css("background-color", "gray");
          }else if (selectorValue === "3") {
            dynamicId = "#"
            dynamicId += id
            $(dynamicId).remove()
          }       
      })
    }
   })
  }

// delete Data
$(document).ready( function (){
  $("#delete_btn").click( function(e) {
   e.preventDefault();
   let userId  = $(".btn-danger").val();
   $.ajax({
    method: "POST",
    url: "delete.php",
    data: {
      "click_delete_btn": true,
      "user_id": userId,
    },
    success: function(rsp) {
      let response;
      response = JSON.parse(rsp);

      if (!response["status"]  || (response["error"] !== null)) {
         showFetchDeleteModalError(response["error"], "Delete Action");
         return;
      }
       let id="#";
       id += response["id"];
       console.log(id)
       $(id).remove();
    }
   })
  })
})

$(document).ready( function (){
  $(".delete").click(showDeleteAlert)
})

function showDeleteAlert() {
  let userId = $(this).attr("popovertarget");
  $(".btn-danger").val(userId);
   $.ajax({
    dataType: "json",
    method: "POST",
    url: "update.php",
    data: {
      "click_fetch_btn": true,
      "user_id": userId,
    },
    success: function(response) {
        const obj = JSON.parse(response);
        console.log(obj)
        let value = obj["user"];
        if (obj["status"] == false) {
          showFetchDeleteModalError(obj["error"], "DeleteAction");
          return;
        }
         document.getElementById("delete_fullname").innerHTML = value["username"] + " " + value["userfamilyname"];   
         $('#deletemodal').modal('show'); 
      }
    })
}

function showFetchDeleteModalError(error, action) {
  document.getElementById("group_modal").innerHTML = action;
  document.getElementById("error_hg").innerHTML=error.code;
  document.getElementById("error_massage").innerHTML= error.massage;
  $('#groupmodal').modal('show');
}
// Insert Data 

// Reset Insert modal
$(document).ready( function (){
  $("#insert_data").click( function(e) {
    document.getElementById("main_title").innerHTML = "Add User";
    document.getElementById("insert_update_data").value = "insert";
  })
})

function onResetInsert_Edit_Modal() {
   let firstHelp = document.getElementById("firstHelp");
   let lastHelp = document.getElementById("lastHelp");
   lastHelp.style.visibility = "hidden";
   firstHelp.style.visibility = "hidden";
   $("#firstname").val("");
   $("#lastname").val("");
   $("#user_role").val("1");
   $("#user_status").val("0"); 
   $('#user_status').prop('checked', false);
}

// Insert - Update User
$(document).ready( function (){
  $("#insert_update_data").click(function(e) {
   
   let btnValue = document.getElementById("insert_update_data").value
   if (btnValue === "insert") {
    onInsertUser(e);
   }else if (btnValue === "update") {
    updateData(e)
   }
  })
})

function onInsertUser(e) {
   let isUserOnline = $('#user_status').is(':checked');
   let data = {};
   data["first_name"] = $("#firstname").val();
   data["last_name"] = $("#lastname").val();
   data["user_role"] =  $("#user_role").val();

   if (isUserOnline) {
     data["user_status"] = 1;
   } else {
     data["user_status"] = 0;
   }
   console.log(data)
   e.preventDefault();
   let userId  = $(this).attr("popovertarget");
   $.ajax({
    method: "POST",
    url: "insert.php",
    data: {
      "insert": true,
      "user_id": userId,
      "user_data": data
    },
    success: function(rsp) {
     let response;
     response = JSON.parse(rsp);
     let value = response["user"]
     console.log(value);
      if((response["status"] ===false)  || (response["error"] !== null)) {
         let firstHelp = document.getElementById("firstHelp");
         let lastHelp = document.getElementById("lastHelp");
        if ((value["first_name"] ==="") && (value["last_name"]==="")) {
            lastHelp.style.visibility = "visible";
            firstHelp.style.visibility = "visible"
        }else if (value["first_name"] ==="") {
             firstHelp.style.visibility = "visible";
        }else if (value["last_name"]===""){
            lastHelp.style.visibility = "visible";
        }
        return;
      }

       let fullName = value["username"] + " " + value["userfamilyname"];
       let userRole = value["user_role"];

       let table = document.getElementById("table");
   
        // Create row element
       let row = document.createElement("tr");
       row.id = value["id"];
       row.className = "table-info"

       // Create cells
       let c1 = document.createElement("td");
       let c2 = document.createElement("td");
       let c3 = document.createElement("td");
       let c4 = document.createElement("td");
       let c5 = document.createElement("td");
    
       // firstCell populate
       let input = document.createElement("input")
       let isInputWillBeChecked = $('#main_checkbox').is(':checked');
       input.setAttribute("type", "checkbox");
       input.setAttribute("value", value["id"])
       input.setAttribute("name", "type")
       input.onclick = inputClicked
       input.id = value["id"];

       if (isInputWillBeChecked){
        input.setAttribute("checked", true)
       }
       c1.appendChild(input)
      
       // secondCell populat
       c2.innerText = fullName
       c2.id = "full_name" + value["id"];
       c2.className = "h4 align-middle"

       // thirdCell populate
       c3.innerText = userRole
       c3.id = "user_role" + value["id"];
       c3.className = "h4 align-middle"

       // forthCell populate
       let div = document.createElement("div");
       let innerDiv = document.createElement("div");
       div.className = "status_container";
     
       innerDiv.className = "status";
       innerDiv.id = "user_status" + value["id"]
       let isOnline = value["user_status"];
       if (isOnline) {
         innerDiv.style.background = "#008000";
       }else {
         innerDiv.style.background = "#808080";
       }
       div.appendChild(innerDiv);
       c4.appendChild(div); 
       div.appendChild(innerDiv);
       c4.appendChild(div);
 
       let buttonDiv = document.createElement("div");
       let buttonsArr = ["Edit", "Delete"];
 
       buttonsArr.forEach(buttonText => {
         let btn = document.createElement("button");
         btn.setAttribute('popovertarget', value["id"]);
         if (buttonText === "Edit") {
           btn.textContent = buttonText;
           btn.className = "btn edit btn-primary";
           btn.onclick = fetchData;
         }else {
          btn.setAttribute('onclick', "showDeleteAlert");
          btn.textContent = buttonText;
          btn.className = "delete btn btn-danger";
          btn.onclick = showDeleteAlert;
        }
        buttonDiv.appendChild(btn);
      })

       buttonDiv.className = "btn_group";
       c5.appendChild(buttonDiv);
        
       // Append cells to row
       row.appendChild(c1);
       row.appendChild(c2);
       row.appendChild(c3);
       row.appendChild(c4);
       row.appendChild(c5);
      
       // Append row to table body
       table.appendChild(row)
       $('#insert_edit_modal').modal('hide');
       onResetInsert_Edit_Modal();   
    }
   })
  }

// Update data
function updateData(e) {
   e.preventDefault()
   let userId  = $(".btn-danger").val();
   let isUserOnline = $('#user_status').is(':checked');
   let idArray = ["#full_name","#user_status", "#user_role"]
   let data = {};

   data["first_name"] = $("#firstname").val();
   data["last_name"] = $("#lastname").val();
   data["user_role"] =  $("#user_role").val();

   if (isUserOnline) {
     data["user_status"] = 1;
   } else {
     data["user_status"] = 0;
   }
   console.log(data);
   $.ajax({
    dataType: "json",
    method: "POST",
    url: "update.php",
    data: {
      "click_update_btn": true,
      "user_update_id": userId,
      "user_data": data
    },
    success: function(rsp) {
      const response = JSON.parse(rsp);
      console.log(response)
      let value = response["user"];
      if(!response["status"]  || (response["error"] !== null)) {
         let firstHelp = document.getElementById("firstHelp");
         let lastHelp = document.getElementById("lastHelp");
        if ((value["first_name"] ==="") && (value["last_name"]==="")) {
            lastHelp.style.visibility = "visible";
            firstHelp.style.visibility = "visible";
        }else if (value["first_name"] ==="") {
             firstHelp.style.visibility = "visible";
        }else if (value["last_name"]===""){
            lastHelp.style.visibility = "visible";
        }
        return;
      }

        idArray.forEach((element) =>{
          let dynamicId = "";
          switch (element) {
            case "#full_name":
               dynamicId += element;
               dynamicId += userId;
               $(dynamicId).text(value["first_name"] + " " + value["last_name"]);           
              break;
            case "#user_role":
               dynamicId += element;
               dynamicId += userId;
               console.log(value["user_role"])
               $(dynamicId).text(value["user_role"]);
             break;
            case "#user_status":
               dynamicId += element;
               dynamicId += userId;
               if (value["user_status"] == 0) {
                $(dynamicId).css("background-color", "gray");
               }else {
                $(dynamicId).css("background-color", "green");
               }  
               break;
             default: 
           }
        $('#insert_edit_modal').modal('hide');  
      })
     }
    })
  }


 $(document).ready( function (){
  $("#update_data").click(updateData)
})

 function fetchData() {
  let userId  = $(this).attr("popovertarget");
  console.log(userId)
   $(".btn-danger").val(userId)
   $.ajax({
    dataType: "json",
    method: "POST",
    url: "update.php",
    data: {
      "click_fetch_btn": true,
      "user_id": userId,
    },
    success: function(response) {
        const obj = JSON.parse(response);
        let value = obj["user"];
        if (!(obj["status"])) {
          showFetchDeleteModalError(obj["error"], "Update Action");
          return;
        }
        $("#firstname").val(value["username"]);
        $("#lastname").val(value["userfamilyname"]);
        if (value["user_role"] === "User") {
          $("#user_role").val("1")
        }else {
          $("#user_role").val("2")
        }   
        $("#user_status").val(value["user_status"]);
        if (value["user_status"] === 1) {
           $("#user_status").prop("checked", true);
        }else {
           $("#user_status").prop("checked", false);
        }
        $("#user_status").val(value["user_status"]); 
        document.getElementById("insert_update_data").value = "update";
        document.getElementById("main_title").innerHTML = "Update User";
        $('#insert_edit_modal').modal('show'); 
        
     }
    })
  }

// fetch data in update modal
$(document).ready( function (){
  $(".edit").click(fetchData)
})

</script>
</body>
</html>