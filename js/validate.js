function validate(form) {
   fail = validateUsername(form.username.value);
   fail += validatePassword(form.password.value);
   fail += validateName(form.FirstName.value);
   fail += validateName(form.LastName.value);
   if (fail == "")   return true
   else {
      alert(fail);
      return false
   }
}

function validateName(field) {
   field == "" ? return "No Username was entered.\\n" : return ""
}

function validateUsername(field) {
   if (field == "")
      return "No Username was entered.\\n";
   else if (field.length < 5)
      return "Usernames must be at least 5 characters.\\n";
   else if (/[^a-zA-Z0-9_-]/.test(field))
      return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\\n";
   return "";
}

function validatePassword(field) {
   if (field == "")
      return "No Password was entered.\\n";
   else if (field.length < 6)
      return "Passwords must be at least 6 characters.\\n";
   else if (!/[a-z]/.test(field) || ! /[A-Z]/.test(field) || !/[0-9]/.test(field))
      return "Passwords require one each of a-z, A-Z and 0-9.\\n";
   return "";
}
