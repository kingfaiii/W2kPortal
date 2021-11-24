require("./bootstrap");

import $ from "jquery";
window.$ = window.jQuery = $;

import "jquery-ui/ui/widgets/datepicker.js";
var dateToday = new Date();
$(".datepicker").datepicker({
    minDate: dateToday,
});
