function setCookie(name, value) {
    var expDate = new Date();
    expDate.setTime(expDate.getTime() + (24*60*60*1000));
    var expires = "expires="+ expDate.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

function getCookie(name) {
    var nameString = name + "=";
    var decodedCookies = decodeURIComponent(document.cookie);
    var cookies = decodedCookies.split(';');
    for(var i = 0; i < cookies.length; i++) {
        var c = cookies[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(nameString) == 0) {
            return c.substring(nameString.length, c.length);
        }
    }
    return "";
}

function deleteCookie(name) {
    document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;' + ";path=/";
}

function getByteSize(s) {
    return encodeURIComponent('<q></q>' + s).length;
}
