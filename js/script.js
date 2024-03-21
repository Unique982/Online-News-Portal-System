//*<--------------------------------! -------------------------------------------------------------------------->
                                   //* Menu Bar js code start here
//!<--------------------------------! -------------------------------------------------------------------------->

var header = document.querySelector("header");
var menuBtn = document.querySelector("#menu-btn");
var closeMenuBtn = document.querySelector("#close-menu-btn");

menuBtn.addEventListener("click", () => header.classList.toggle("show-menu"));
closeMenuBtn.addEventListener("click", () => menuBtn.click()); 

//!<--------------------------------! -------------------------------------------------------------------------->
                                  //*  Header Menu Bar Code End
//!<--------------------------------! -------------------------------------------------------------------------->

// ********************************** ********************************** ********************************** *****

//?<--------------------------------! -------------------------------------------------------------------------->
                                  //* Category Validation Code Start
//?<--------------------------------! -------------------------------------------------------------------------->

function validationCategory(){
    var category =document.cat.category.value.trim();
    // category 
    if(category==''){
        setErrorMsg(document.getElementById('category'),'Category Cannot be empty');
        return false;
    }
    else{
        setSuccessMsg(document.getElementById('category'));
    }
    return true;
}

//?<--------------------------------! -------------------------------------------------------------------------->
                                  //*  End Category Validation Code 
//?<--------------------------------! -------------------------------------------------------------------------->

// ********************************** ********************************** ********************************** *****

//?<--------------------------------! -------------------------------------------------------------------------->
                                  //*Post from validation code
//?<--------------------------------! -------------------------------------------------------------------------->

function validationPost(){
    var title = document.post.title.value.trim();
   var description = document.post.description.value.trim();
   var image = document.post.image.value.trim();
   // title 
   if(title ==''){
   setErrorMsg(document.getElementById('title'),'Title Cannot be empty');
    return false;
   }
   else if(title.length<10){
    setErrorMsg(document.getElementById('title'),'Title must be at least 10 words');
    return false;
   }
   else{
    setSuccessMsg(document.getElementById('title'));
   }
   // end title validation

   // description

   if(description == ''){
    setErrorMsg(document.getElementById('description'),'Description Cannot be empty');
 return false;
}
else if(description.length<30){
    setErrorMsg(document.getElementById('description'),'Discription requried more');
    return false;
   }
else{
    setSuccessMsg(document.getElementById('description'));
}
  
// end description 

   // category start 
//    if(category==''){
//     setErrorMsg(document.getElementById('category'),'Selected category');
//     return false;
//    }
//    else{
//     setSuccessMsg(document.getElementById('category'));
//    }
   // Image Start 
  if(image==''){
    setErrorMsg(document.getElementById('image'),'image cannot be empty!');
    return false;
  }
else{
  setSuccessMsg(document.getElementById('image'));

}
  

   return true;
}
//!<--------------------------------! -------------------------------------------------------------------------->
//  End Post validation code
//!<--------------------------------! -------------------------------------------------------------------------->

// new form validation 
function validationForm(){
    var username =  document.userdata.username.value.trim();
    var email =  document.userdata.email.value.trim();
    var address = document.userdata.address.value.trim();
    var phone =  document.userdata.phone.value.trim();
    var role = document.userdata.role.value.trim();
    var password=  document.userdata.password.value.trim();
  //   Start username validation
  if(username === ""){
    // setErrorMsg(username, 'Username cannot be blank');
    setErrorMsg(document.getElementById('username'),'Username Cannot be blank!');
      return false;
} 
if(!username.match(/^[A-Za-z]*\s{1}[A-Za-z]*$/)){
    setErrorMsg(document.getElementById('username'),'Write Full User Name');
return false;
}
// else if(username.length <=6){
//     // setErrorMsg(username, 'min 6 char');
//     setErrorMsg(document.getElementById('username'),"Username should be Minimin 6 char");
//  return false;
// }
else{
    setSuccessMsg(document.getElementById('username'));
}
// end user validation 
// start email validation

if(email ===""){
    setErrorMsg(document.getElementById('email'),'Email cannot be blank!');
    return false;
}
else if(!email.match(/^[a-z\._\-[0-9]*[@][a-z]*[\.][a-z]{2,4}$/)){
    setErrorMsg(document.getElementById('email'),'Enter valid email.');
    return false;
}
else{
    setSuccessMsg(document.getElementById('email'));
}
// end email validation

// Phone number validation

if(phone ===""){
    setErrorMsg(document.getElementById('phone'),'Phone cannot be blank!');
    return false;
}
else if(phone.length<10){
    setErrorMsg(document.getElementById('phone'),'Number must be 10 digits!');
    return false;
}
else if(!phone.match(/^([0-9]{10})$/)){
    setErrorMsg(document.getElementById('phone'),'Number must be number format.');
    return false;
}
else{
    setSuccessMsg(document.getElementById('phone'));
}
// end phone number validation

// address validation start
if(address === ""){
    // setErrorMsg(username, 'Username cannot be blank');
    setErrorMsg(document.getElementById('address'),'address Cannot be blank!');
      return false;
} 
else{
    setSuccessMsg(document.getElementById('address'));
} 
// end adddress validation code

// password validation code 
if(password ===""){
    setErrorMsg(document.getElementById('password'),'Enter Password');
    return false;
} 
else if(password.length<10){
    setErrorMsg(document.getElementById('password'),'password should strong!');
    return false;
}
else{
    setSuccessMsg(document.getElementById('password'));
}
// end password Validation

// User Roles validation code 

return true;
}

// second function created error msgs 
function  setErrorMsg(input, errorMsg){
    var formControl = input.parentElement;
    var small = formControl.querySelector('small');
    formControl.className = "input-box error";
    small.innerText = errorMsg; 


}
//  function 
function setSuccessMsg(input){
    var formContr = input.parentElement;
    formContr.className = "input-box success";
}

