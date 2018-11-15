function validateSignup()
{
    let error = 0;

    // Validar matricula
    let $id = $('#student-id');
    let $emptyId = $('#empty-id');
    let $wrongId = $('#wrong-id');

    console.log($id.val());
    if ($id.val() == "") {
        $emptyId.removeClass('hidden-element');
        $wrongId.addClass('hidden-element');
        error = 1;
    }
    else if (!validateId( $id.val() )) {
        $emptyId.addClass('hidden-element');
        $wrongId.removeClass('hidden-element');
        error = 1;
    }
    else {
        $emptyId.addClass('hidden-element');
        $wrongId.addClass('hidden-element');
    }

    // Validar contrasena
    let $password = $('#passwd');
    let $emptyPasswd = $('#empty-passwd');
    let $confirmPassword = $('#confirm-passwd');
    let $wrongConfirmPassword = $('#wrong-confirm-passwd');

    if ($password.val() == '') {
        $emptyPasswd.removeClass('hidden-element');
        error = 1;
    }
    else {
        $emptyPasswd.addClass('hidden-element');
        if ($confirmPassword.val() != $password.val() ) {
            $wrongConfirmPassword.removeClass('hidden-element');
            error = 1;
        }
        else {
            $wrongConfirmPassword.addClass('hidden-element');
        }
    }

    // Validar nombre
    let $name = $('#student-name');
    let $emptyName = $('#empty-name');

    if ($name.val() == ""){
        $emptyName.removeClass('hidden-element');
        error = 1;
    } else {
        $emptyName.addClass('hidden-element');
    }

    // Validar email
    let $email = $('#email');
    let $emptyEmail = $('#empty-email');
    let $wrongEmail = $('#wrong-email');

    if ($email.val() == ""){
        $emptyEmail.removeClass('hidden-element');
        $wrongEmail.addClass('hidden-element');
        error = 1;
    } else if (!validateEmail( $email.val() )) {
        $emptyEmail.addClass('hidden-element');
        $wrongEmail.removeClass('hidden-element');
        error = 1;
    } else {
        $emptyEmail.addClass('hidden-element');
        $wrongEmail.addClass('hidden-element');
    }

    // Validar telefono
    let $phone = $('#phone');
    let $emptyPhone = $('#empty-phone');
    let $wrongPhone = $('#wrong-phone');

    if ($phone.val() == ""){
        $emptyPhone.removeClass('hidden-element');
        $wrongPhone.addClass('hidden-element');
        error = 1;
    } else if (!validatePhone( $phone.val() )) {
        $emptyPhone.addClass('hidden-element');
        $wrongPhone.removeClass('hidden-element');
        error = 1;
    } else {
        $emptyPhone.addClass('hidden-element');
        $wrongPhone.addClass('hidden-element');
    }


    if(error == 1) {
        return false;
    }
    else {
        return true;
    }
}

function validateLogin() {
    let error = 0;

    // Validar matricula
    let $id = $('#student-id');
    let $emptyId = $('#empty-id');
    let $wrongId = $('#wrong-id');

    console.log($id.val());
    if ($id.val() == "") {
        $emptyId.removeClass('hidden-element');
        $wrongId.addClass('hidden-element');
        error = 1;
    }
    else if (!validateId( $id.val() )) {
        $emptyId.addClass('hidden-element');
        $wrongId.removeClass('hidden-element');
        error = 1;
    }
    else {
        $emptyId.addClass('hidden-element');
        $wrongId.addClass('hidden-element');
    }

    // Validar contrasena
    let $password = $('#passwd');
    let $emptyPasswd = $('#empty-passwd');

    if ($password.val() == '') {
        $emptyPasswd.removeClass('hidden-element');
        error = 1;
    }
    else {
        $emptyPasswd.addClass('hidden-element');
    }

    if(error == 1) {
        return false
    }
    else {
        return true;
    }
}

function validateId(id) {
    var idRegex = /[al]0[0-9]{7}/i;
    return idRegex.test(id);
}

function validateEmail(email) {
    var emailRegex = /\S+@\S+\.\S+/;
    return emailRegex.test(email);
}

function validatePhone(phone) {
    var phoneRegex = /[0-9]{10}/;
    return phoneRegex.test(phone);
}
