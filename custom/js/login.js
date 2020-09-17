setTimeout(function(){ $(".flash").fadeOut(); }, 2000);

function login_validation(){

    var email           =   $("#email").val().trim(); 
    var email_pattern   =   /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
    var password        =   $("#password").val().trim(); 

    if(email=="")
    {
       $("#emailErr").fadeIn().html("Email Required");
       setTimeout(function(){ $("#emailErr").fadeOut(); }, 3000);
       $("#email").focus();
       return false; 
    } 
    else if(!email_pattern.test(email))
    {
       $("#emailErr").fadeIn().html("Invalid Email");
       setTimeout(function(){ $("#emailErr").fadeOut(); }, 3000);
       $("#email").focus();
       return false;       
    }
    if(password=="")
    {
     $("#passwordErr").fadeIn().html("Password Required");
     setTimeout(function(){ $("#passwordErr").fadeOut(); }, 3000);
     $("#password").focus();
     return false; 
     } 

   $(".saveBtn").click();
    
}

function forgot_password_validation() {


   var email           =   $("#email").val().trim(); 
   var email_pattern   =   /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;

    if(email=="")
    {
       $(".valerr").fadeIn().html("Email Required");
       setTimeout(function(){ $(".valerr").fadeOut(); }, 3000);
       $("#email").focus();
       return false; 
    } 
    else if(!email_pattern.test(email))
    {
       $(".valerr").fadeIn().html("Invalid Email");
       setTimeout(function(){ $(".valerr").fadeOut(); }, 3000);
       $("#email").focus();
       return false;       
    } 

    $(".saveBtn").click();
}

function validations_reset_password() {
  
    var password        =   $("#password").val().trim(); 
    var confirm_password=   $("#confirm_password").val().trim(); 
    if(password=="")
    {
       $(".valerr").fadeIn().html("Password Required");
       setTimeout(function(){ $(".valerr").fadeOut(); }, 3000);
       $("#password").focus();
       return false; 
     } 
     else if(password.length < 4 || password.length > 12 ){
       $(".valerr").fadeIn().html("4 to 12 characters are allowed in password");
       setTimeout(function(){ $(".valerr").fadeOut(); }, 3000);
       $("#password").focus();
       return false; 
     }

    if(confirm_password==""){
        $(".valerr").fadeIn().html("Confirm Password Required");
        setTimeout(function(){ $(".valerr").fadeOut(); }, 3000);
        $("#confirm_password").focus();
        return false; 
    } 

    if(password != confirm_password ){
         $(".valerr").fadeIn().html("Confirm Password does not match with password");
         setTimeout(function(){ $(".valerr").fadeOut(); }, 3000);
         $("#confirm_password").focus();
         return false; 
    }
    $(".saveBtn").click();
}




