/*
 * Color Picker
 */
(function ($) {
  "use strict";

  $(".colorpicker-element").each(function () {
    var input = $(this).find("input");

    input.parent().colorpicker();
  });
}.apply(this, [jQuery]));
