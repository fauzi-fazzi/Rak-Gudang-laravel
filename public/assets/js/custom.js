/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

function showToast(title, message) {
    iziToast.success({
        title: title,
        message: message,
        position: "topRight",
    });
}
