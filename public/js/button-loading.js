"use strict";jQuery(document).ready(function(){let e=$("#saveBtn"),t=e.closest("form");e.on("click",function(a){a.preventDefault(),e.addClass("m-loader m-loader--light m-loader--right").attr("disabled",!0),setTimeout(function(){t.submit(),e.removeClass("m-loader m-loader--light m-loader--right").attr("disabled",!1)},800)})});
