function employee_validation(){


    var name            =   $("#name").val().trim(); 
    var name_pattern    =   /^[a-zA-Z ]{2,30}$/;
    var email           =   $("#email").val().trim(); 
    var email_pattern   =   /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
    var phone           =   $("#phone").val().trim(); 
    var phone_pattern   =   /^\d{10}$/;
    var button          =   $("#button").val().trim();  
  
    if(name=="")
    {
       $("#nameErr").fadeIn().html("<small>Name Required</small>");
       setTimeout(function(){ $("#nameErr").fadeOut(); }, 3000);
       $("#name").focus();
       return false; 
    }
    else if(!name_pattern.test(name))
    {
       $("#nameErr").fadeIn().html("<small>Invalid Name</small>");
       setTimeout(function(){ $("#nameErr").fadeOut(); }, 3000);
       $("#name").focus();
       return false;       
    }
   
    if(email=="")
    {
      $("#emailErr").fadeIn().html("<small>Email Required</small>");
      setTimeout(function(){ $("#emailErr").fadeOut(); }, 3000);
      $("#email").focus();
      return false; 
     } 
    else if(!email_pattern.test(email))
    {
       $("#emailErr").fadeIn().html("<small>Invalid Email</small>");
       setTimeout(function(){ $("#emailErr").fadeOut(); }, 3000);
       $("#email").focus();
       return false;       
    }

    if(phone=="")
    {
      $("#phoneErr").fadeIn().html("<small>Phone No. Required</small>");
      setTimeout(function(){ $("#phoneErr").fadeOut(); }, 3000);
      $("#phone").focus();
      return false; 
     } 
    else if(!phone_pattern.test(phone))
    {
       $("#phoneErr").fadeIn().html("<small>Invalid Email</small>");
       setTimeout(function(){ $("#phoneErr").fadeOut(); }, 3000);
       $("#phone").focus();
       return false;       
    }

    

   $(".saveBtn").click();
    
}



