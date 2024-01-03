


(function () {
    'use strict'

    // Fetch all elements with class name ".disabled"
    let $buttons = document.querySelectorAll('.disabled')

    // Loop over them and prevent submission
    Array.prototype.slice.call($buttons)
        .forEach(function ($button) {
            $button.setAttribute("disabled","disabled");
        })
    hljs.highlightAll();
})()
