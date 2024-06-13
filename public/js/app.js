function vlx_get_cookie(cookie_name) {
    return document.cookie.split(';').find(cookie => cookie.includes(cookie_name));
}

function vlx_get_cookie_val(cookie_name) {
    let cookie_val = document.cookie.split(';').find(cookie => cookie.includes(cookie_name));
    if (cookie_val) {
        return cookie_val.split('=')[1];
    }
    return '';
}
