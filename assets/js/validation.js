function setErrorFor(input, message) {
    var formGroup = input.parentElement; // .form-group
    var small = formGroup.querySelector('small');

    //add error message inside small
    small.innerText = message;
    formGroup.classList.remove("success");
    //add error class
    formGroup.classList.add("error");
}

function setSuccessFor(input) {
    var formGroup = input.parentElement; // .form-group
    formGroup.classList.remove("error");
    //add success class
    formGroup.classList.add("success");
}

function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

function checkAdmin() {
    //get the values from the inputs
    var pass = true;
    var userid = document.getElementById('userid');
    var namee = document.getElementById('name');
    var email = document.getElementById('email');
    var phone = document.getElementById('phone');
    var ic = document.getElementById('ic');
    var passport = document.getElementById('passport');
    var sex = document.getElementById('sex');
    var race = document.getElementById('race');
    var religion = document.getElementById('religion');
    var country = document.getElementById('country');
    var nationality = document.getElementById('nationality');
    var statuss = document.getElementById('status');
    var password = document.getElementById('password');
    var useridValue = userid.value.trim();
    var nameValue = namee.value.trim();
    var emailValue = email.value.trim();
    var phoneValue = phone.value.trim();
    var icValue = ic.value.trim();
    var passportValue = passport.value.trim();
    var sexValue = sex.value.trim();
    var raceValue = race.value.trim();
    var religionValue = religion.value.trim();
    var countryValue = country.value.trim();
    var nationalityValue = nationality.value.trim();
    var statusValue = statuss.value.trim();
    var passwordValue = password.value.trim();

    //Check User ID
    if (useridValue === '') {
        //show error
        //add error class
        setErrorFor(userid, 'User ID cannot be blank');
        pass = false;
    } else {
        //add success class
        setSuccessFor(userid);
    }

    //Check Name
    if (nameValue === '') {
        //show error
        //add error class
        setErrorFor(namee, 'Name cannot be blank');
        pass = false;
    } else {
        //add success class
        setSuccessFor(namee);
    }

    //Check Email
    if (emailValue === '') {
        setErrorFor(email, 'Email cannot be blank');
        pass = false;
    } else if (!isEmail(emailValue)) {
        setErrorFor(email, 'Email is not valid');
        pass = false;
    } else {
        setSuccessFor(email);
    }

    //Check Phone
    if (phoneValue === '') {
        setErrorFor(phone, 'Phone cannot be blank');
        pass = false;
    } else {
        setSuccessFor(phone);
    }

    //Check IC or Passport 
    if (icValue === '' && passportValue === '') {
        setErrorFor(ic, 'Fill in IC or Passport');
        setErrorFor(passport, 'Fill in Passport or IC');
        pass = false;
    } else {
        setSuccessFor(ic);
        setSuccessFor(passport);
    }

    //Check Sex
    if (sexValue === '') {
        setErrorFor(sex, 'Sex cannot be blank');
        pass = false;
    } else {
        setSuccessFor(sex);
    }

    //Check Race
    if (raceValue === '') {
        setErrorFor(race, 'Race cannot be blank');
        pass = false;
    } else {
        setSuccessFor(race);
    }

    //Check Religion
    if (religionValue === '') {
        setErrorFor(religion, 'Religion cannot be blank');
        pass = false;
    } else {
        setSuccessFor(religion);
    }

    //Check Country
    if (countryValue === '') {
        setErrorFor(country, 'Country cannot be blank');
        pass = false;
    } else {
        setSuccessFor(country);
    }

    //Check Nationality
    if (nationalityValue === '') {
        setErrorFor(nationality, 'Nationality cannot be blank');
        pass = false;
    } else {
        setSuccessFor(nationality);
    }

    //Check Status
    if (statusValue === '') {
        setErrorFor(statuss, 'Status cannot be blank');
        pass = false;
    } else {
        setSuccessFor(statuss);
    }

    //Check Password
    if (passwordValue === '') {
        setErrorFor(password, 'Password cannot be blank');
        pass = false;
    } else {
        setSuccessFor(password);
    }
    return pass;
}

function checkEditAdmin() {
    var pass = true;
    var namee = document.getElementById('edit_name');
    var email = document.getElementById('edit_email');
    var phone = document.getElementById('edit_phone');
    var ic = document.getElementById('edit_ic');
    var passport = document.getElementById('edit_passport');
    var sex = document.getElementById('edit_sex');
    var race = document.getElementById('edit_race');
    var religion = document.getElementById('edit_religion');
    var country = document.getElementById('edit_country');
    var nationality = document.getElementById('edit_nationality');
    var statuss = document.getElementById('edit_status');
    var nameValue = namee.value.trim();
    var emailValue = email.value.trim();
    var phoneValue = phone.value.trim();
    var icValue = ic.value.trim();
    var passportValue = passport.value.trim();
    var sexValue = sex.value.trim();
    var raceValue = race.value.trim();
    var religionValue = religion.value.trim();
    var countryValue = country.value.trim();
    var nationalityValue = nationality.value.trim();
    var statusValue = statuss.value.trim();

    //Check Name
    if (nameValue === '') {
        //show error
        //add error class
        setErrorFor(namee, 'Name cannot be blank');
        pass = false;
    } else {
        //add success class
        setSuccessFor(namee);
    }

    //Check Email
    if (emailValue === '') {
        setErrorFor(email, 'Email cannot be blank');
        pass = false;
    } else if (!isEmail(emailValue)) {
        setErrorFor(email, 'Email is not valid');
        pass = false;
    } else {
        setSuccessFor(email);
    }

    //Check Phone
    if (phoneValue === '') {
        setErrorFor(phone, 'Phone cannot be blank');
        pass = false;
    } else {
        setSuccessFor(phone);
    }

    //Check IC or Passport 
    if (icValue === '' && passportValue === '') {
        setErrorFor(ic, 'Fill in IC or Passport');
        setErrorFor(passport, 'Fill in Passport or IC');
        pass = false;
    } else {
        setSuccessFor(ic);
        setSuccessFor(passport);
    }

    //Check Sex
    if (sexValue === '') {
        setErrorFor(sex, 'Sex cannot be blank');
        pass = false;
    } else {
        setSuccessFor(sex);
    }

    //Check Race
    if (raceValue === '') {
        setErrorFor(race, 'Race cannot be blank');
        pass = false;
    } else {
        setSuccessFor(race);
    }

    //Check Religion
    if (religionValue === '') {
        setErrorFor(religion, 'Religion cannot be blank');
        pass = false;
    } else {
        setSuccessFor(religion);
    }

    //Check Country
    if (countryValue === '') {
        setErrorFor(country, 'Country cannot be blank');
        pass = false;
    } else {
        setSuccessFor(country);
    }

    //Check Nationality
    if (nationalityValue === '') {
        setErrorFor(nationality, 'Nationality cannot be blank');
        pass = false;
    } else {
        setSuccessFor(nationality);
    }

    //Check Status
    if (statusValue === '') {
        setErrorFor(statuss, 'Status cannot be blank');
        pass = false;
    } else {
        setSuccessFor(statuss);
    }

    return pass;
}

function checkStaff() {
    var userid = document.getElementById('userid');
    var namee = document.getElementById('name');
    var email = document.getElementById('email');
    var phone = document.getElementById('phone');
    var ic = document.getElementById('ic');
    var passport = document.getElementById('passport');
    var sex = document.getElementById('sex');
    var race = document.getElementById('race');
    var religion = document.getElementById('religion');
    var country = document.getElementById('country');
    var nationality = document.getElementById('nationality');
    var statuss = document.getElementById('status');
    var password = document.getElementById('password');
    var faculty = document.getElementById('faculty');
    var designation = document.getElementById('designation');
    var field_category = document.getElementById('field_category');
    var field = document.getElementById('field');
    var useridValue = userid.value.trim();
    var nameValue = namee.value.trim();
    var emailValue = email.value.trim();
    var phoneValue = phone.value.trim();
    var icValue = ic.value.trim();
    var passportValue = passport.value.trim();
    var sexValue = sex.value.trim();
    var raceValue = race.value.trim();
    var religionValue = religion.value.trim();
    var countryValue = country.value.trim();
    var nationalityValue = nationality.value.trim();
    var statusValue = statuss.value.trim();
    var passwordValue = password.value.trim();
    var facultyValue = faculty.value.trim();
    var designationValue = designation.value.trim();
    var field_categoryValue = field_category.value.trim();
    var fieldValue = field.value.trim();
    var pass = true;

    //Check User ID
    if (useridValue === '') {
        setErrorFor(userid, 'User ID cannot be blank');
        pass = false;
    } else {
        setSuccessFor(userid);
    }

    //Check Name
    if (nameValue === '') {
        setErrorFor(namee, 'Name cannot be blank');
        pass = false;
    } else {
        setSuccessFor(namee);
    }

    //Check Email
    if (emailValue === '') {
        setErrorFor(email, 'Email cannot be blank');
        pass = false;
    } else if (!isEmail(emailValue)) {
        setErrorFor(email, 'Email is not valid');
        pass = false;
    } else {
        setSuccessFor(email);
    }

    //Check Phone
    if (phoneValue === '') {
        setErrorFor(phone, 'Phone cannot be blank');
        pass = false;
    } else {
        setSuccessFor(phone);
    }

    //Check IC or Passport 
    if (icValue === '' && passportValue === '') {
        setErrorFor(ic, 'Fill in IC or Passport');
        setErrorFor(passport, 'Fill in Passport or IC');
        pass = false;
    } else {
        setSuccessFor(ic);
        setSuccessFor(passport);
    }

    //Check Sex
    if (sexValue === '') {
        setErrorFor(sex, 'Sex cannot be blank');
        pass = false;
    } else {
        setSuccessFor(sex);
    }

    //Check Race
    if (raceValue === '') {
        setErrorFor(race, 'Race cannot be blank');
        pass = false;
    } else {
        setSuccessFor(race);
    }

    //Check Religion
    if (religionValue === '') {
        setErrorFor(religion, 'Religion cannot be blank');
        pass = false;
    } else {
        setSuccessFor(religion);
    }

    //Check Country
    if (countryValue === '') {
        setErrorFor(country, 'Country cannot be blank');
        pass = false;
    } else {
        setSuccessFor(country);
    }

    //Check Nationality
    if (nationalityValue === '') {
        setErrorFor(nationality, 'Nationality cannot be blank');
        pass = false;
    } else {
        setSuccessFor(nationality);
    }

    //Check Status
    if (statusValue === '') {
        setErrorFor(statuss, 'Status cannot be blank');
        pass = false;
    } else {
        setSuccessFor(statuss);
    }

    //Check Password
    if (passwordValue === '') {
        setErrorFor(password, 'Password cannot be blank');
        pass = false;
    } else {
        setSuccessFor(password);
    }

    //Check Faculty
    if (facultyValue === '') {
        setErrorFor(faculty, 'Faculty cannot be blank');
        pass = false;
    } else {
        setSuccessFor(faculty);
    }

    //Check Designation
    if (designationValue === '') {
        setErrorFor(designation, 'Designation cannot be blank');
        pass = false;
    } else {
        setSuccessFor(designation);
    }

    //Check Field Category
    if (field_categoryValue === '') {
        setErrorFor(field_category, 'Field Category cannot be blank');
        pass = false;
    } else {
        setSuccessFor(field_category);
    }

    //Check Field 
    if (fieldValue === '') {
        setErrorFor(field, 'Field cannot be blank');
        pass = false;
    } else {
        setSuccessFor(field);
    }
    return pass;
}

function checkEditStaff() {
    var pass = true;
    var namee = document.getElementById('edit_name');
    var email = document.getElementById('edit_email');
    var phone = document.getElementById('edit_phone');
    var ic = document.getElementById('edit_ic');
    var passport = document.getElementById('edit_passport');
    var sex = document.getElementById('edit_sex');
    var race = document.getElementById('edit_race');
    var religion = document.getElementById('edit_religion');
    var country = document.getElementById('edit_country');
    var nationality = document.getElementById('edit_nationality');
    var statuss = document.getElementById('edit_status');
    var faculty = document.getElementById('edit_faculty');
    var designation = document.getElementById('edit_designation');
    var field_category = document.getElementById('edit_field_category');
    var field = document.getElementById('edit_field');
    var nameValue = namee.value.trim();
    var emailValue = email.value.trim();
    var phoneValue = phone.value.trim();
    var icValue = ic.value.trim();
    var passportValue = passport.value.trim();
    var sexValue = sex.value.trim();
    var raceValue = race.value.trim();
    var religionValue = religion.value.trim();
    var countryValue = country.value.trim();
    var nationalityValue = nationality.value.trim();
    var statusValue = statuss.value.trim();
    var facultyValue = faculty.value.trim();
    var designationValue = designation.value.trim();
    var field_categoryValue = field_category.value.trim();
    var fieldValue = field.value.trim();

    //Check Name
    if (nameValue === '') {
        //show error
        //add error class
        setErrorFor(namee, 'Name cannot be blank');
        pass = false;
    } else {
        //add success class
        setSuccessFor(namee);
    }

    //Check Email
    if (emailValue === '') {
        setErrorFor(email, 'Email cannot be blank');
        pass = false;
    } else if (!isEmail(emailValue)) {
        setErrorFor(email, 'Email is not valid');
        pass = false;
    } else {
        setSuccessFor(email);
    }

    //Check Phone
    if (phoneValue === '') {
        setErrorFor(phone, 'Phone cannot be blank');
        pass = false;
    } else {
        setSuccessFor(phone);
    }

    //Check IC or Passport 
    if (icValue === '' && passportValue === '') {
        setErrorFor(ic, 'Fill in IC or Passport');
        setErrorFor(passport, 'Fill in Passport or IC');
        pass = false;
    } else {
        setSuccessFor(ic);
        setSuccessFor(passport);
    }

    //Check Sex
    if (sexValue === '') {
        setErrorFor(sex, 'Sex cannot be blank');
        pass = false;
    } else {
        setSuccessFor(sex);
    }

    //Check Race
    if (raceValue === '') {
        setErrorFor(race, 'Race cannot be blank');
        pass = false;
    } else {
        setSuccessFor(race);
    }

    //Check Religion
    if (religionValue === '') {
        setErrorFor(religion, 'Religion cannot be blank');
        pass = false;
    } else {
        setSuccessFor(religion);
    }

    //Check Country
    if (countryValue === '') {
        setErrorFor(country, 'Country cannot be blank');
        pass = false;
    } else {
        setSuccessFor(country);
    }

    //Check Nationality
    if (nationalityValue === '') {
        setErrorFor(nationality, 'Nationality cannot be blank');
        pass = false;
    } else {
        setSuccessFor(nationality);
    }

    //Check Status
    if (statusValue === '') {
        setErrorFor(statuss, 'Status cannot be blank');
        pass = false;
    } else {
        setSuccessFor(statuss);
    }

     //Check Faculty
     if (facultyValue === '') {
        setErrorFor(faculty, 'Faculty cannot be blank');
        pass = false;
    } else {
        setSuccessFor(faculty);
    }

    //Check Designation
    if (designationValue === '') {
        setErrorFor(designation, 'Designation cannot be blank');
        pass = false;
    } else {
        setSuccessFor(designation);
    }

    //Check Field Category
    if (field_categoryValue === '') {
        setErrorFor(field_category, 'Field Category cannot be blank');
        pass = false;
    } else {
        setSuccessFor(field_category);
    }

    //Check Field 
    if (fieldValue === '') {
        setErrorFor(field, 'Field cannot be blank');
        pass = false;
    } else {
        setSuccessFor(field);
    }

    return pass;
}

function checkStudent() {
    var userid = document.getElementById('userid');
    var namee = document.getElementById('name');
    var email = document.getElementById('email');
    var phone = document.getElementById('phone');
    var ic = document.getElementById('ic');
    var passport = document.getElementById('passport');
    var sex = document.getElementById('sex');
    var race = document.getElementById('race');
    var religion = document.getElementById('religion');
    var country = document.getElementById('country');
    var nationality = document.getElementById('nationality');
    var statuss = document.getElementById('status');
    var password = document.getElementById('password');
    var faculty1 = document.getElementById('faculty');
    var levelofstudy = document.getElementById('levelofstudy');
    var programme = document.getElementById('programme');
    var research_title = document.getElementById('research_title');
    var supervisor = document.getElementById('supervisor');
    var useridValue = userid.value.trim();
    var nameValue = namee.value.trim();
    var emailValue = email.value.trim();
    var phoneValue = phone.value.trim();
    var icValue = ic.value.trim();
    var passportValue = passport.value.trim();
    var sexValue = sex.value.trim();
    var raceValue = race.value.trim();
    var religionValue = religion.value.trim();
    var countryValue = country.value.trim();
    var nationalityValue = nationality.value.trim();
    var statusValue = statuss.value.trim();
    var passwordValue = password.value.trim();
    var faculty1Value = faculty1.value.trim();
    var levelofstudyValue = levelofstudy.value.trim();
    var programmeValue = programme.value.trim();
    var research_titleValue = research_title.value.trim();
    var supervisorValue = supervisor.value.trim();
    var pass = true;

    //Check User ID
    if (useridValue === '') {
        setErrorFor(userid, 'User ID cannot be blank');
        pass = false;
    } else {
        setSuccessFor(userid);
    }

    //Check Name
    if (nameValue === '') {
        setErrorFor(namee, 'Name cannot be blank');
        pass = false;
    } else {
        setSuccessFor(namee);
    }

    //Check Email
    if (emailValue === '') {
        setErrorFor(email, 'Email cannot be blank');
        pass = false;
    } else if (!isEmail(emailValue)) {
        setErrorFor(email, 'Email is not valid');
        pass = false;
    } else {
        setSuccessFor(email);
    }

    //Check Phone
    if (phoneValue === '') {
        setErrorFor(phone, 'Phone cannot be blank');
        pass = false;
    } else {
        setSuccessFor(phone);
    }

    //Check IC or Passport 
    if (icValue === '' && passportValue === '') {
        setErrorFor(ic, 'Fill in IC or Passport');
        setErrorFor(passport, 'Fill in Passport or IC');
        pass = false;
    } else {
        setSuccessFor(ic);
        setSuccessFor(passport);
    }

    //Check Sex
    if (sexValue === '') {
        setErrorFor(sex, 'Sex cannot be blank');
        pass = false;
    } else {
        setSuccessFor(sex);
    }

    //Check Race
    if (raceValue === '') {
        setErrorFor(race, 'Race cannot be blank');
        pass = false;
    } else {
        setSuccessFor(race);
    }

    //Check Religion
    if (religionValue === '') {
        setErrorFor(religion, 'Religion cannot be blank');
        pass = false;
    } else {
        setSuccessFor(religion);
    }

    //Check Country
    if (countryValue === '') {
        setErrorFor(country, 'Country cannot be blank');
        pass = false;
    } else {
        setSuccessFor(country);
    }

    //Check Nationality
    if (nationalityValue === '') {
        setErrorFor(nationality, 'Nationality cannot be blank');
        pass = false;
    } else {
        setSuccessFor(nationality);
    }

    //Check Status
    if (statusValue === '') {
        setErrorFor(statuss, 'Status cannot be blank');
        pass = false;
    } else {
        setSuccessFor(statuss);
    }

    //Check Password
    if (passwordValue === '') {
        setErrorFor(password, 'Password cannot be blank');
        pass = false;
    } else {
        setSuccessFor(password);
    }

    //Check Faculty
    if (faculty1Value === '') {
        setErrorFor(faculty1, 'Faculty cannot be blank');
        pass = false;
    } else {
        setSuccessFor(faculty1);
    }

    //Check Level of study
    if (levelofstudyValue === '') {
        setErrorFor(levelofstudy, 'Level of Study cannot be blank');
        pass = false;
    } else {
        setSuccessFor(levelofstudy);
    }

    //Check Programme
    if (programmeValue === '') {
        setErrorFor(programme, 'Programme cannot be blank');
        pass = false;
    } else {
        setSuccessFor(programme);
    }

    //Check Research Title 
    if (research_titleValue === '') {
        setErrorFor(research_title, 'Research Title cannot be blank');
        pass = false;
    } else {
        setSuccessFor(research_title);
    }

    //Check Supervisor 
    if (supervisorValue === '') {
        setErrorFor(supervisor, 'Choose one supervisor');
        pass = false;
    } else {
        setSuccessFor(supervisor);
    }
    return pass;
}

function checkEditStudent() {
    var userid = document.getElementById('edit_userid');
    var namee = document.getElementById('edit_name');
    var email = document.getElementById('edit_email');
    var phone = document.getElementById('edit_phone');
    var ic = document.getElementById('edit_ic');
    var passport = document.getElementById('edit_passport');
    var sex = document.getElementById('edit_sex');
    var race = document.getElementById('edit_race');
    var religion = document.getElementById('edit_religion');
    var country = document.getElementById('edit_country');
    var nationality = document.getElementById('edit_nationality');
    var statuss = document.getElementById('edit_status');
    var faculty1 = document.getElementById('edit_faculty');
    var levelofstudy = document.getElementById('edit_levelofstudy');
    var programme = document.getElementById('edit_programme');
    var research_title = document.getElementById('edit_research_title');
    var supervisor = document.getElementById('edit_supervisor');
    var useridValue = userid.value.trim();
    var nameValue = namee.value.trim();
    var emailValue = email.value.trim();
    var phoneValue = phone.value.trim();
    var icValue = ic.value.trim();
    var passportValue = passport.value.trim();
    var sexValue = sex.value.trim();
    var raceValue = race.value.trim();
    var religionValue = religion.value.trim();
    var countryValue = country.value.trim();
    var nationalityValue = nationality.value.trim();
    var statusValue = statuss.value.trim();
    var faculty1Value = faculty1.value.trim();
    var levelofstudyValue = levelofstudy.value.trim();
    var programmeValue = programme.value.trim();
    var research_titleValue = research_title.value.trim();
    var supervisorValue = supervisor.value.trim();
    var pass = true;

    //Check User ID
    if (useridValue === '') {
        setErrorFor(userid, 'User ID cannot be blank');
        pass = false;
    } else {
        setSuccessFor(userid);
    }

    //Check Name
    if (nameValue === '') {
        setErrorFor(namee, 'Name cannot be blank');
        pass = false;
    } else {
        setSuccessFor(namee);
    }

    //Check Email
    if (emailValue === '') {
        setErrorFor(email, 'Email cannot be blank');
        pass = false;
    } else if (!isEmail(emailValue)) {
        setErrorFor(email, 'Email is not valid');
        pass = false;
    } else {
        setSuccessFor(email);
    }

    //Check Phone
    if (phoneValue === '') {
        setErrorFor(phone, 'Phone cannot be blank');
        pass = false;
    } else {
        setSuccessFor(phone);
    }

    //Check IC or Passport 
    if (icValue === '' && passportValue === '') {
        setErrorFor(ic, 'Fill in IC or Passport');
        setErrorFor(passport, 'Fill in Passport or IC');
        pass = false;
    } else {
        setSuccessFor(ic);
        setSuccessFor(passport);
    }

    //Check Sex
    if (sexValue === '') {
        setErrorFor(sex, 'Sex cannot be blank');
        pass = false;
    } else {
        setSuccessFor(sex);
    }

    //Check Race
    if (raceValue === '') {
        setErrorFor(race, 'Race cannot be blank');
        pass = false;
    } else {
        setSuccessFor(race);
    }

    //Check Religion
    if (religionValue === '') {
        setErrorFor(religion, 'Religion cannot be blank');
        pass = false;
    } else {
        setSuccessFor(religion);
    }

    //Check Country
    if (countryValue === '') {
        setErrorFor(country, 'Country cannot be blank');
        pass = false;
    } else {
        setSuccessFor(country);
    }

    //Check Nationality
    if (nationalityValue === '') {
        setErrorFor(nationality, 'Nationality cannot be blank');
        pass = false;
    } else {
        setSuccessFor(nationality);
    }

    //Check Status
    if (statusValue === '') {
        setErrorFor(statuss, 'Status cannot be blank');
        pass = false;
    } else {
        setSuccessFor(statuss);
    }

    //Check Faculty
    if (faculty1Value === '') {
        setErrorFor(faculty1, 'Faculty cannot be blank');
        pass = false;
    } else {
        setSuccessFor(faculty1);
    }

    //Check Level of study
    if (levelofstudyValue === '') {
        setErrorFor(levelofstudy, 'Level of Study cannot be blank');
        pass = false;
    } else {
        setSuccessFor(levelofstudy);
    }

    //Check Programme
    if (programmeValue === '') {
        setErrorFor(programme, 'Programme cannot be blank');
        pass = false;
    } else {
        setSuccessFor(programme);
    }

    //Check Research Title 
    if (research_titleValue === '') {
        setErrorFor(research_title, 'Research Title cannot be blank');
        pass = false;
    } else {
        setSuccessFor(research_title);
    }

    //Check Supervisor 
    if (supervisorValue === '') {
        setErrorFor(supervisor, 'Choose one supervisor');
        pass = false;
    } else {
        setSuccessFor(supervisor);
    }
    return pass;
}


function checkSupervisorRemark() {
    var remark = document.getElementById('supervisor_remark');
    var remarkValue = remark.value.trim();
    var pass = true;

    //Check Remark
    if (remarkValue === '') {
        setErrorFor(remark, 'Please provide your reasons!');
        pass = false;
    } else {
        setSuccessFor(remark);
    }
    return pass;
}

function checkExaminerRemark() {
    var remark = document.getElementById('examiner_remark');
    var remarkValue = remark.value.trim();
    var pass = true;

    //Check Remark
    if (remarkValue === '') {
        setErrorFor(remark, 'Please provide your reasons!');
        pass = false;
    } else {
        setSuccessFor(remark);
    }
    return pass;
}

function checkPassword(){
    var pass = true;
    var oldpass = document.getElementById('oldpass');
    var newpass = document.getElementById('newpass');
    var confirmpass = document.getElementById('confirmpass');
    var oldpassValue = oldpass.value.trim();
    var newpassValue = newpass.value.trim();
    var confirmpassValue = confirmpass.value.trim();

    if(oldpassValue === ''){
        setErrorFor(oldpass, 'Old password cannot be blank');
        pass = false;
    } 
    else{
        setSuccessFor(oldpass);
    }

    if(newpassValue === ''){
        setErrorFor(newpass, 'New password cannot be blank');
        pass = false;
    } 
    else{
        setSuccessFor(newpass);
    }

    if(confirmpassValue === ''){
        setErrorFor(confirmpass, 'Confirm password cannot be blank');
        pass = false;
    } 
    else{
        setSuccessFor(confirmpass);
    }


    if(newpassValue != '' && confirmpassValue != ''){
        if(newpassValue != confirmpassValue){
                setErrorFor(newpass, '');
                setErrorFor(confirmpass, 'Confirm password is not matched!');
                pass = false;
        }
        else{
            setSuccessFor(newpass);
            setSuccessFor(confirmpass);
        }
    }
    
    return pass;
}