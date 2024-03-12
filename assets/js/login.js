function validateform() {
    var username = document.loginform.username.value;
    var password = document.loginform.password.value;

    if (username == "" && password == "") {
        document.getElementById("userempty").innerHTML =
          "<div class='alert'>Staff ID or Matric ID field is required.</div>";
        document.getElementById("passempty").innerHTML =
          "<div class='alert'>Password field is required.</div>";
        return false;
    } else {
        if (username == null || username == "") {
          document.getElementById("userempty").innerHTML =
            "<div class='alert'>Staff ID or Matric ID field is required.</div>";
          return false;
        } else if (password == null || password == "") {
          document.getElementById("passempty").innerHTML =
            "<div class='alert'>Password field is required.</div>";
          return false;
        }
    }
}
