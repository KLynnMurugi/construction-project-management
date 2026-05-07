<?php include '../includes/auth.php';
      include '../includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<style>
    #page-wrapper {
    background-color: rgb(241, 241, 241) !important;
}
</style>
<body style="background-color:rgba(241, 241, 241, 0.9) !important">

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href=""><b>Project Managent System</b></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                <?php echo $_SESSION['NAME']?>
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                   
                    <li>
                         <a href="#manage_account" data-toggle="modal" ><i class="fa fa-fw fa-pencil"></i>Account</a>
                    </li>
                   <li class="divider"></li>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
            <?php  include '../includes/sidebar.php'; ?>
            </div>
            <!-- /.navbar-collapse -->
        </nav>


        <div id="page-wrapper">

            <div class="container-fluid">

<?php
error_reporting(E_ALL ^ E_NOTICE);

$page = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : 'home';
$pages = array('home','position','employee','employee_profile','division','project_list','project_detail','progress','update_progress','user_list','attendance','project_team');
if (!empty($page)) {
    if(in_array($page,$pages)) {
        $page .= '.php';
        include($page);
    }
    else {
        echo 'Page not found. Return
        <a href="index.php?page=home">home</a>';
    }
}

?>

            </div>
        </div>
        </div>

        <div id="manage_account" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
               <div class="modal-content modal-md">  
             
                  <div class="modal-header"> 
                     <h4 class="modal-title" id='head'>
                     <i class=""></i> Manage Account
                     </h4> 
                     <div id="retCode10"></div>
                  </div> 
 <div class="modal-body">
  
    <div class="form-horizontal">

  <?php
    include '../includes/db.php';
   
      $query2=  mysqli_query($conn, "SELECT *,CONCAT(lastname,', ',firstname,' ',midname) as name,users.io as status FROM users natural join employee where uid = '".$_SESSION['UID']."' ");
       $row2 = mysqli_fetch_assoc($query2);  
    ?>
  <div id="retCode1"><div class="alert alert-success" id="msg20"><i class="fa fa-check"></i> Data successfully updated. </div></div>
  <div id="retCode1"><div class="alert alert-danger" id="msg21"><i class="fa fa-check"></i> Password is Incorrect. </div></div>
    <form id="update_user_form2" method="POST">
    <div class="form-group">
    
       <input type="hidden"  value="<?php echo $row2['uid'] ?>" name="uid">

    </div>
    </div>
<br>
<br>
     <div class="form-group">
    <div class="col-sm-4 text-right"><label for="us">Username:</label></div>
    <div class="col-sm-8">
   <input type="text" class="form-control input-sm" id="us" value="<?php echo $row2['username'] ?>" name="user">
    </div>
    </div>
<br>
<br>
    <div class="form-group">
    <div class="col-sm-4 text-right"><label for="npass">New Password:</label></div>
    <div class="col-sm-8">
   <input type="password" class="form-control input-sm" id="npass" name="npass">
    </div>
    </div>
<br>
<br>
    <div class="form-group">
    <div class="col-sm-4 text-right"><label for="cpass">Current Password:</label></div>
    <div class="col-sm-8">
   <input type="password" class="form-control input-sm" id="cpass"  name="current">
    </div>
    </div>
<br>



 
   </div>
          <div class="modal-footer">
               <button type="submit" class="btn btn-md btn-info" id="btn_sub"><i class="fa fa-save"></i> Save</button>
                <button data-dismiss="modal" class="btn btn-md btn-info"><i class="glyphicon glyphicon-close"></i>Close</button>
            </form>
                     </div>
                     </div> 
            </div>
          </div>
<div id="proj_list_report" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
               <div class="modal-content modal-sm">  
             
                  <div class="modal-header"> 
                     <h4 class="modal-title" id='head'>
                     <i class=""></i> Project List Report
                     </h4> 
                     <div id="retCode1"></div>
                  </div> 
                      
 <div class="modal-body">
  
  
   
    <div class="form-horizontal">
        
      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Status:</label>
          <div class="col-sm-8">
            <select class="form-control" style="text-transform:capitalize" id="stats" required>
            <option selected="" disabled=""></option>
            <option value="1">Ongoing Projects</option>
            <option value="2">Finished Projects</option>
            <option value="3">Cancelled Projects</option>
            </select>
          </div>
        </div>

    </div>
   </div>
          <div class="modal-footer">
               <button onclick="rep_proj_list()" class="btn btn-md btn-info" id="btn_sub"><i class="fa fa-eye"></i> View</button>
                <button data-dismiss="modal" class="btn btn-md btn-info"><i class="glyphicon glyphicon-close"></i>Close</button>
           
                     </div>
                     </div> 
            </div>
          </div>

  <div id="proj_prog_report" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
               <div class="modal-content modal-md">  
             
                  <div class="modal-header"> 
                     <h4 class="modal-title" id='head'>
                     <i class=""></i> Project Progress Report
                     </h4> 
                     <div id="retCode1"></div>
                  </div> 
                      
 <div class="modal-body">
  
  
   
    <div class="form-horizontal">
        
      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Project:</label>
          <div class="col-sm-8">
            <select class="form-control" style="text-transform:capitalize" id="pp" required>
            <option selected="" disabled=""></option>
           <?php
            $pp = mysqli_query($conn,"SELECT * FROM projects order by project ASC ");
            while($pp_row=mysqli_fetch_assoc($pp)){
            ?>
            <option value="<?php echo $pp_row['project_id'] ?>"><?php echo ucwords($pp_row['project']) ?></option>
            <?php } ?>
            </select>
          </div>
        </div>

    </div>
   </div>
          <div class="modal-footer">
               <button onclick="rep_proj_prog()" class="btn btn-md btn-info" id="btn_sub"><i class="fa fa-eye"></i> View</button>
                <button data-dismiss="modal" class="btn btn-md btn-info"><i class="glyphicon glyphicon-close"></i>Close</button>
           
                     </div>
                     </div> 
            </div>
          </div>

  <div id="foreman_portfolio_report" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
               <div class="modal-content modal-md">  
             
                  <div class="modal-header"> 
                     <h4 class="modal-title" id='head'>
                     <i class=""></i> Foreman Portfolio Records
                     </h4> 
                     <div id="retCode1"></div>
                  </div> 
                      
 <div class="modal-body">
  
  
   
    <div class="form-horizontal">
        
      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Foreman:</label>
          <div class="col-sm-8">
            <select class="form-control" style="text-transform:capitalize" id="reid" required>
            <option selected="" disabled=""></option>
           <?php
            $pp = mysqli_query($conn,"SELECT *,CONCAT(lastname,', ',firstname,' ',midname) as name FROM employee natural join position where position = 'foreman' ");
            while($pp_row=mysqli_fetch_assoc($pp)){
            ?>
            <option value="<?php echo $pp_row['eid'] ?>"><?php echo ucwords($pp_row['name']) ?></option>
            <?php } ?>
            </select>
          </div>
        </div>

    </div>
   </div>
          <div class="modal-footer">
               <button onclick="rep_portfolio()" class="btn btn-md btn-info" id="btn_sub"><i class="fa fa-eye"></i> View</button>
                <button data-dismiss="modal" class="btn btn-md btn-info"><i class="glyphicon glyphicon-close"></i>Close</button>
           
                     </div>
                     </div> 
            </div>
          </div>
  <div id="attendance_report" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog"> 
               <div class="modal-content modal-md">  
             
                  <div class="modal-header"> 
                     <h4 class="modal-title" id='head'>
                     <i class=""></i> Attendance Report
                     </h4> 
                     <div id="retCode1"></div>
                  </div> 
                      
 <div class="modal-body">
  
  
   
    <div class="form-horizontal">
        
      <div class="form-group" id="form-login">
          <label class="col-sm-4 control-label">Select Month:</label>
          <div class="col-sm-8">
            <input class="form-control" type="month" style="text-transform:capitalize" id="sm" required>
            
          </div>
        </div>

    </div>
   </div>
          <div class="modal-footer">
               <button onclick="rep_att()" class="btn btn-md btn-info" id="btn_sub"><i class="fa fa-eye"></i> View</button>
                <button data-dismiss="modal" class="btn btn-md btn-info"><i class="glyphicon glyphicon-close"></i>Close</button>
           
                     </div>
                     </div> 
            </div>
          </div>
          <div id="ai-chat-container" style="position: fixed; bottom: 25px; right: 25px; z-index: 10000; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    
    <div id="ai-welcome-bubble" style="position: absolute; bottom: 80px; right: 0; width: 240px; background: white; color: #333; padding: 15px; border-radius: 18px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); border-left: 6px solid #337ab7; font-size: 14px; line-height: 1.5; animation: fadeInUp 0.8s ease-out;">
        <button onclick="document.getElementById('ai-welcome-bubble').style.display='none'" style="position:absolute; top:5px; right:10px; background:none; border:none; color:#aaa; cursor:pointer;">&times;</button>
        <strong>Construction AI Assistant</strong> 👋 <br>
        Ask me about <b>Project Costs (Ksh)</b> or Staff!
        <div style="position: absolute; bottom: -10px; right: 25px; width: 0; height: 0; border-left: 10px solid transparent; border-right: 10px solid transparent; border-top: 10px solid white;"></div>
    </div>

    <div id="chat-window" style="display: none; width: 370px; height: 500px; background: white; border-radius: 20px; box-shadow: 0 15px 50px rgba(0,0,0,0.3); flex-direction: column; overflow: hidden; margin-bottom: 20px; border: 1px solid #eee;">
        <div style="background: #337ab7; color: white; padding: 18px; font-weight: bold; display: flex; justify-content: space-between; align-items: center;">
            <span><i class="fa fa-robot"></i> AI Project Manager</span>
            <button onclick="toggleChat()" style="background:none; border:none; color:white; cursor:pointer; font-size:24px;">&times;</button>
        </div>
        
        <div id="chat-content" style="flex: 1; padding: 15px; overflow-y: auto; background: #f9f9f9; display: flex; flex-direction: column; gap: 12px; font-size: 14px;">
            <div style="background: #eceff1; padding: 12px; border-radius: 15px 15px 15px 0px; align-self: flex-start; max-width: 85%; color: #444; border: 1px solid #e0e0e0;">
                Hello! I'm ready to help with your construction data. What would you like to know?
            </div>
        </div>

        <div style="padding: 15px; border-top: 1px solid #eee; display: flex; gap: 10px; background: white;">
            <input type="text" id="ai-input" placeholder="Ask a question..." style="flex: 1; border: 1px solid #ddd; padding: 12px 18px; border-radius: 30px; outline: none; font-size: 14px;">
            <button onclick="sendToAI()" id="send-btn" style="background: #337ab7; color: white; border: none; width: 45px; height: 45px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                <i class="fa fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <button onclick="toggleChat()" style="display: flex; align-items: center; background: #337ab7; color: white; border: none; padding: 12px 25px; border-radius: 35px; box-shadow: 0 6px 20px rgba(51, 122, 183, 0.4); cursor: pointer; font-weight: bold; font-size: 15px; transition: transform 0.2s;">
        <i class="fa fa-robot" style="margin-right: 10px; font-size: 18px;"></i>
        Ask AI Assistant
    </button>
</div>

<style>
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
function toggleChat() {
    const win = document.getElementById('chat-window');
    const welcome = document.getElementById('ai-welcome-bubble');
    if(welcome) welcome.style.display = 'none';
    win.style.display = (win.style.display === 'none' || win.style.display === '') ? 'flex' : 'none';
}

function sendToAI() {
    const input = document.getElementById('ai-input');
    const content = document.getElementById('chat-content');
    const btn = document.getElementById('send-btn');
    const msg = input.value.trim();
    if (!msg) return;

    content.innerHTML += `<div style="background: #337ab7; color: white; padding: 12px; border-radius: 15px 15px 0px 15px; align-self: flex-end; max-width: 85%;">${msg}</div>`;
    input.value = '';
    btn.disabled = true;
    content.scrollTop = content.scrollHeight;

    const typingId = "typing-" + Date.now();
    content.innerHTML += `<div id="${typingId}" style="color: #888; font-style: italic; font-size: 12px; margin-left: 5px;"><i class="fa fa-spinner fa-spin"></i> AI is thinking...</div>`;

    fetch('ai_handler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ message: msg })
    })
    .then(r => r.json())
    .then(data => {
        document.getElementById(typingId).remove();
        content.innerHTML += `<div style="background: #ffffff; color: #333; padding: 12px; border-radius: 15px 15px 15px 0px; align-self: flex-start; max-width: 85%; line-height: 1.5; border: 1px solid #eee;">${data.response}</div>`;
        content.scrollTop = content.scrollHeight;
        btn.disabled = false;
    })
    .catch(err => {
        document.getElementById(typingId).innerHTML = "Connection Error.";
        btn.disabled = false;
    });
}
document.getElementById('ai-input').addEventListener('keypress', (e) => { if(e.key === 'Enter') sendToAI(); });
</script>
</body>
<!--
<footer>
    <center>All rights reserved © 2018</center>
</footer>
-->
    <script src="assets/js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
 <script>
    $(document).ready(function(){
      $('#msg20').hide();
      $('#msg21').hide();
    });
     jQuery("#update_user_form2").submit(function(e){
                e.preventDefault();
                var formData = jQuery(this).serialize();
                $.ajax({
                  type: "POST",
                  url: "../forms/update_forms.php?action=user2",
                  data: formData,
                  success: function(html){
                    $('#retCode10').append(html);
                  }
                });
                  return false;
            });
     function rep_portfolio(){
      var eid = $('#reid').val();
      window.open('printable_portfolio.php?id='+eid);
      $('#foreman_portfolio_report').modal('close');
     }
     function rep_proj_list(){
      var stats = $('#stats').val();
      window.open('printable_project_report.php?status='+stats);
      $('#proj_list_report').modal('close');
     }
     function rep_proj_prog(){
      var pp = $('#pp').val();
      window.open('printable_progress_report.php?id='+pp);
      $('#proj_list_report').modal('close');
     }
      function rep_att(){
      var sm = $('#sm').val();
      window.open('printable_attendance.php?d='+sm);
      $('#proj_list_report').modal('close');
     }
  </script>

</html>
