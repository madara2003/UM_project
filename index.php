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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>


<!-- Modal -->
<!-- Insert Modal -->
<div class="modal fade" id="insertmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="form_container">
       <form action="#" >
         <div class="form_inner_container">
          <div class="form_input_conteiner">
            <label class="form_label" for="firstname">First Name:</label>
            <input  id="firstname_insert" type="text" value="" name="first_name" placeholder = "User name" />
          </div>

          <div class="form_input_conteiner">
            <label class="form_label" for="name">Last Name:</label>
            <input  id="lastname_insert" class="form_input" type="text" name="last_name" placeholder = "User lastname" />
         </div>

        <div class="form_input_conteiner">
          <label class="form_label" for="user_role">Role</label>
          <select class="form_select"  id="user_role_insert" value="">
            <option value="User">User</option>
            <option value="Admin">Admin</option>
          </select>
        </div>
    <div>
    <label class="switch">
      <input id="user_status_insert" value="" type="checkbox">
      <span class="slider round"></span>
    </label>
    </div>
  </div>
  </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         <button type="submit" id="insert_data_user" name="update_data" class="btn btn-primary">Save changes</button>
       </div>
    </div>
  </div>
 </form>
</div>
</div>
<!-- Update modal -->
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="form_container">
       <form action="#" >
         <div class="form_inner_container">
          <div class="form_input_conteiner">
            <label class="form_label" for="firstname">First Name:</label>
            <input  id="firstname" type="text" value="" name="first_name" placeholder = "User name" />
          </div>

          <div class="form_input_conteiner">
            <label class="form_label" for="name">Last Name:</label>
            <input  id="lastname" class="form_input" type="text" name="last_name" placeholder = "User lastname" />
         </div>

        <div class="form_input_conteiner">
          <label class="form_label" for="user_role">Role</label>
          <select class="form_select" id="user_role" value="">
            <option value="User">User</option>
            <option value="Admin">Admin</option>
          </select>
        </div>
    <div>
    <label class="switch">
      <input id="user_status" value="" type="checkbox">
      <span class="slider round"></span>
    </label>
    </div>
  </div>
  </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         <button type="submit" id="update_data" name="update_data" class="btn btn-primary">Save changes</button>
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
        <h5 class="modal-title">Delete Alert</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
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
<div class="d-inline-flex gap-4">
  <div>
    <button type="button" id="insert_data" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertmodal">Add</button>
  </div>
  <div>
   <select class="form-select" >
     <option selected>-- Please Select --</option>
     <option value="1">Set Active</option>
     <option value="2">Set Not Active</option>
     <option value="3">Delete</option>
   </select>
   </div>
   </div>
     <button type="button" id="confirm_grouo_op" class="btn btn-primary" data-bs-dismiss="modal">Cofirm</button>
   </div>
</div>
<table class="content_table"> 
 <thead>
  <tr>
    <th> <input id="main_checkbox" type="checkbox"></th>
    <th>Name</th>
    <th>Role</th>
    <th>Status</th>
    <th>Action</th>
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
            <tr id="<?php echo $row["id"]; ?>">
              <th><input id="<?php echo $row["id"]; ?>" value="<?php echo $row["id"]; ?>" type="checkbox" name="type"></th>
              <td id="full_name<?php echo $row["id"]; ?>"><?php echo $row["username"]." ". $row["userfamilyname"]; ?></td>
              <td id="user_role<?php echo $row["id"]; ?>"><?php echo $row["user_role"]; ?></td>
              <td><div class="status_container"><div id="user_status<?php echo $row["id"]; ?>" style="background-color:<?php if($row["user_status"] > 0) { echo "green";}else {echo "gray";}?>" class="status"></div></div></td>
              <td>
               <div class="btn_group">
                  <button class="btn edit btn-primary" popovertarget="<?php echo $row["id"]?>" data-bs-toggle="modal" data-bs-target="#editmodal" type="submit">Edit</button>
                  <button class="btn delete btn-danger" popovertarget="<?php echo $row["id"]?>" data-bs-toggle="modal" data-bs-target="#deletemodal" value="<?php echo $row["id"]; ?>" type="submit">Delete</button>
               </div>
            </td>
          </tr>   
        
        <?php  } ?>
     <?php } ?>
  
  </tbody>
</table> 
<div>
<div class="d-inline-flex gap-4">
  <div>
    <button type="button" id="insert_data" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertmodal">Add</button>
  </div>
  <div>
   <select class="form-select" id="form-select-bottom" >
     <option selected>-- Please Select --</option>
     <option value="1">Set Active</option>
     <option value="2">Set Not Active</option>
     <option value="3">Delete</option>
   </select>
   </div>
   </div>
     <button type="button" id="confirm_grouo_op_bottom" class="btn btn-primary" data-bs-dismiss="modal">Cofirm</button>
   </div>
</div>
<script>
  
// Group Action 

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
  $("#confirm_grouo_op").click(function() {
    let selectorValue =  $(".form-select").val();
    groupAction(selectorValue)
  });
})
$(document).ready( function (){
  $("#confirm_grouo_op_bottom").click(function() {
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
    console.log(arrSelectedInputs);
    $.ajax({
    method: "POST",
    url: "groupAction.php",
    data: {
      "click_group_btn": selectorValue,
      "users_id": arrSelectedInputs,
    },
    success: function(response) {
      if(!response["status"]  || (response["error"] !== null)) {
        alert("Oops, something went wrong, please select action and users");
        return;
      }
      console.log(response)
      let elementsIdChange = response["ids"];
      elementsIdChange.forEach(id=> {
          let dynamicId = "#user_status"
          dynamicId += id
          console.log(dynamicId)

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
    success: function(response) {
      console.log(response);
      if (!response["status"]  || (response["error"] !== null)) {
        alert("Cant delete this user");
        return;
      }
       let id="#";
       id += response["id"];
       $(id).remove();
    }
   })
  })
})

$(document).ready( function (){
  $(".delete").click(showDeleteAlert)
})

function showDeleteAlert() {
    console.log("delete fetch");
    let userId = $(this).attr("popovertarget");
    $(".btn-danger").val(userId)
}

// Insert Data 

// Reset Insert modal
$(document).ready( function (){
  $("#insert_data").click( function(e) {
   $("#firstname_insert").val("");
   $("#lastname_insert").val("");
   $("#user_role_insert").val("User");
   $("#user_status_insert").val("0"); 
   $('#user_status_insert').prop('checked', false);
  })
})

// Insert User
$(document).ready( function (){
  $("#insert_data_user").click( function(e) {

   let isUserOnline = $('#user_status_insert').is(':checked');
   let data = {};
   data["first_name"] = $("#firstname_insert").val();
   data["last_name"] = $("#lastname_insert").val();
   data["user_role"] =  $("#user_role_insert").val();

   if (isUserOnline) {
     data["user_status"] = "1";
   } else {
     data["user_status"] = "0";
   }
   console.log(data)
   console.log(data["user_status"])
   e.preventDefault();
   let userId  = $(this).attr("popovertarget");
   console.log("madara")
   $.ajax({
    method: "POST",
    url: "insert.php",
    data: {
      "insert": true,
      "user_id": userId,
      "user_data": data
    },
    success: function(response) {
     console.log(response);
       if(!response["status"]  || (response["error"] !== null)) {
        alert("Oops, something went wrong");
        return;
       }
      $.each(response["data"], function (key, value) { 
       let fullName = value["username"] + " " + value["userfamilyname"];
       let userRole = value["user_role"];

       let table = document.getElementById("table");
   
        // Create row element
       let row = document.createElement("tr");
       row.id = value["id"];
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
      
       input.id = value["id"];
       if (isInputWillBeChecked){
        input.setAttribute("checked", true)
       }
       c1.appendChild(input)
      
       // secondCell populat
       c2.innerText = fullName
       c2.id = "full_name" + value["id"];

       // thirdCell populate
       c3.innerText = userRole
       c3.id = "user_role" + value["id"];

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
       const elem = document.getElementsByClassName("edit")
 
       let buttonDiv = document.createElement("div");
       let buttonsArr = ["Edit", "Delete"];
 
       buttonsArr.forEach(buttonText => {
         let btn = document.createElement("button");
         btn.setAttribute('popovertarget', value["id"]);
         if (buttonText === "Edit") {
           btn.setAttribute('data-bs-toggle', 'modal');
           btn.setAttribute('data-bs-target', '#editmodal');
           btn.textContent = buttonText;
           btn.className = "btn edit btn-primary";
           btn.onclick = fetchData;
         }else {
          btn.setAttribute('data-bs-toggle', 'modal');
          btn.setAttribute('data-bs-target', '#deletemodal')
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
       $('#insertmodal').modal('hide'); 
     }) 
    }
   })
  })
})

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
    method: "POST",
    url: "update.php",
    data: {
      "click_update_btn": true,
      "user_update_id": userId,
      "user_data": data
    },
    success: function(response) {
      console.log(response);
      if(!response["status"]  || (response["error"] !== null)) {
        alert("Oops, something went wrong");
        return;
      }

        let value = response["user"];
        console.log(value);
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

        console.log();
        $("#full_name").text(value["first_name"]);
        $("#user_role_text").text(value["user_role"])
        $('#editmodal').modal('hide');  
      })
     }
    })
  }
 $(document).ready( function (){
  $("#update_data").click(updateData)
})
 function fetchData() {
   let userId  = $(this).attr("popovertarget");
   $(".btn-danger").val(userId)
   $.ajax({
    method: "POST",
    url: "update.php",
    data: {
      "click_fetch_btn": true,
      "user_id": userId,
    },
    success: function(response) {
     $.each(response, function (key, value) {
             $("#firstname").val(value["username"]);
             $("#lastname").val(value["userfamilyname"]);
             $("#user_role").val(value["user_role"]);
             $("#user_status").val(value["user_status"]);
             if (value["user_status"] === 1) {
                 $("#user_status").prop("checked", true);
             }else {
              $("#user_status").prop("checked", false);
             }
             $("#user_status").val(value["user_status"]);    
      })
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