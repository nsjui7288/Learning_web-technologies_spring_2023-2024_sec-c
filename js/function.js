function ajax(){
    let firstname = document.getElementById("firstname").value;
    let lastname = document.getElementById("lastname").value;
    let email = document.getElementById("email").value;
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let confirm_password = document.getElementById("confirm_password").value;
    let  account_type = document.getElementById("account_type").value;
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'signup.php', true);
    xhttp.send('firstname='+firstname);
    xhttp.send('lastname='+lastname);
    xhttp.send('email='+email);
    xhttp.send('username='+username);
    xhttp.send('password='+password);
    xhttp.send('confirm_password='+confirm_password);
    xhttp.send('account_type='+account_type);
    xhttp.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
          document.getElementsByTagName('h1')[0].innerHTML = this.responseText;
      }
    }
  
  }