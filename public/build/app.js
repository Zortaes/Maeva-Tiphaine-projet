(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["app"],{

/***/ "./assets/css/app.scss":
/*!*****************************!*\
  !*** ./assets/css/app.scss ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ "./assets/js/app.js":
/*!**************************!*\
  !*** ./assets/js/app.js ***!
  \**************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _css_app_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../css/app.scss */ "./assets/css/app.scss");
/* harmony import */ var _css_app_scss__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_css_app_scss__WEBPACK_IMPORTED_MODULE_0__);
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you import will output into a single css file (app.css in this case)
 // Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
//import $ from 'jquery';

var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
var app = {
  init: function init() {
    console.log('init');
    $(document).ready(function () {
      $(".navbar-toggler").on("click", function () {
        app.openNav();
      });
      $(".closebtn").on("click", function () {
        app.closeNav();
      });
    });
  },
  openNav: function openNav() {
    document.getElementById("mySidebar").style.width = "300px";
    document.getElementById("mySidebar").style.display = "absolute";
  },

  /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
  closeNav: function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
  }
};
$(app.init);

/***/ })

},[["./assets/js/app.js","runtime","vendors~app"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY3NzL2FwcC5zY3NzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9hcHAuanMiXSwibmFtZXMiOlsiJCIsInJlcXVpcmUiLCJjb25zb2xlIiwibG9nIiwiYXBwIiwiaW5pdCIsImRvY3VtZW50IiwicmVhZHkiLCJvbiIsIm9wZW5OYXYiLCJjbG9zZU5hdiIsImdldEVsZW1lbnRCeUlkIiwic3R5bGUiLCJ3aWR0aCIsImRpc3BsYXkiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7OztBQUFBLHVDOzs7Ozs7Ozs7Ozs7QUNBQTtBQUFBO0FBQUE7QUFBQTs7Ozs7O0FBT0E7Q0FHQTtBQUNBOztBQUVBLElBQUlBLENBQUMsR0FBR0MsbUJBQU8sQ0FBQyxvREFBRCxDQUFmOztBQUVBQyxPQUFPLENBQUNDLEdBQVIsQ0FBWSxtREFBWjtBQUdBLElBQUlDLEdBQUcsR0FBRztBQUNOQyxNQUFJLEVBQUMsZ0JBQ0w7QUFDSUgsV0FBTyxDQUFDQyxHQUFSLENBQVksTUFBWjtBQUVBSCxLQUFDLENBQUNNLFFBQUQsQ0FBRCxDQUFZQyxLQUFaLENBQWtCLFlBQ2xCO0FBQ0lQLE9BQUMsQ0FBQyxpQkFBRCxDQUFELENBQXFCUSxFQUFyQixDQUF3QixPQUF4QixFQUFpQyxZQUFVO0FBQ3ZDSixXQUFHLENBQUNLLE9BQUo7QUFDSCxPQUZEO0FBSUFULE9BQUMsQ0FBQyxXQUFELENBQUQsQ0FBZVEsRUFBZixDQUFrQixPQUFsQixFQUEyQixZQUFVO0FBQ2pDSixXQUFHLENBQUNNLFFBQUo7QUFDSCxPQUZEO0FBR0gsS0FURDtBQVVILEdBZks7QUFpQk5ELFNBQU8sRUFBQyxtQkFDUjtBQUNBSCxZQUFRLENBQUNLLGNBQVQsQ0FBd0IsV0FBeEIsRUFBcUNDLEtBQXJDLENBQTJDQyxLQUEzQyxHQUFtRCxPQUFuRDtBQUNBUCxZQUFRLENBQUNLLGNBQVQsQ0FBd0IsV0FBeEIsRUFBcUNDLEtBQXJDLENBQTJDRSxPQUEzQyxHQUFxRCxVQUFyRDtBQUNDLEdBckJLOztBQXVCTjtBQUNBSixVQUFRLEVBQUMsb0JBQ1Q7QUFDQUosWUFBUSxDQUFDSyxjQUFULENBQXdCLFdBQXhCLEVBQXFDQyxLQUFyQyxDQUEyQ0MsS0FBM0MsR0FBbUQsR0FBbkQ7QUFDQztBQTNCSyxDQUFWO0FBK0JBYixDQUFDLENBQUNJLEdBQUcsQ0FBQ0MsSUFBTCxDQUFELEMiLCJmaWxlIjoiYXBwLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luIiwiLypcclxuICogV2VsY29tZSB0byB5b3VyIGFwcCdzIG1haW4gSmF2YVNjcmlwdCBmaWxlIVxyXG4gKlxyXG4gKiBXZSByZWNvbW1lbmQgaW5jbHVkaW5nIHRoZSBidWlsdCB2ZXJzaW9uIG9mIHRoaXMgSmF2YVNjcmlwdCBmaWxlXHJcbiAqIChhbmQgaXRzIENTUyBmaWxlKSBpbiB5b3VyIGJhc2UgbGF5b3V0IChiYXNlLmh0bWwudHdpZykuXHJcbiAqL1xyXG5cclxuLy8gYW55IENTUyB5b3UgaW1wb3J0IHdpbGwgb3V0cHV0IGludG8gYSBzaW5nbGUgY3NzIGZpbGUgKGFwcC5jc3MgaW4gdGhpcyBjYXNlKVxyXG5pbXBvcnQgJy4uL2Nzcy9hcHAuc2Nzcyc7XHJcblxyXG4vLyBOZWVkIGpRdWVyeT8gSW5zdGFsbCBpdCB3aXRoIFwieWFybiBhZGQganF1ZXJ5XCIsIHRoZW4gdW5jb21tZW50IHRvIGltcG9ydCBpdC5cclxuLy9pbXBvcnQgJCBmcm9tICdqcXVlcnknO1xyXG5cclxudmFyICQgPSByZXF1aXJlKCdqcXVlcnknKTtcclxuXHJcbmNvbnNvbGUubG9nKCdIZWxsbyBXZWJwYWNrIEVuY29yZSEgRWRpdCBtZSBpbiBhc3NldHMvanMvYXBwLmpzJyk7XHJcblxyXG5cclxudmFyIGFwcCA9IHtcclxuICAgIGluaXQ6ZnVuY3Rpb24oKSBcclxuICAgIHtcclxuICAgICAgICBjb25zb2xlLmxvZygnaW5pdCcpO1xyXG5cclxuICAgICAgICAkKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpXHJcbiAgICAgICAge1xyXG4gICAgICAgICAgICAkKFwiLm5hdmJhci10b2dnbGVyXCIpLm9uKFwiY2xpY2tcIiwgZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgICAgIGFwcC5vcGVuTmF2KCk7IFxyXG4gICAgICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgICAgICQoXCIuY2xvc2VidG5cIikub24oXCJjbGlja1wiLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAgICAgYXBwLmNsb3NlTmF2KCk7IFxyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9KVxyXG4gICAgfSxcclxuXHJcbiAgICBvcGVuTmF2OmZ1bmN0aW9uKCkgXHJcbiAgICB7XHJcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm15U2lkZWJhclwiKS5zdHlsZS53aWR0aCA9IFwiMzAwcHhcIjtcclxuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibXlTaWRlYmFyXCIpLnN0eWxlLmRpc3BsYXkgPSBcImFic29sdXRlXCI7XHJcbiAgICB9LFxyXG4gICAgICAgICAgICBcclxuICAgIC8qIFNldCB0aGUgd2lkdGggb2YgdGhlIHNpZGViYXIgdG8gMCBhbmQgdGhlIGxlZnQgbWFyZ2luIG9mIHRoZSBwYWdlIGNvbnRlbnQgdG8gMCAqL1xyXG4gICAgY2xvc2VOYXY6ZnVuY3Rpb24oKSBcclxuICAgIHtcclxuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibXlTaWRlYmFyXCIpLnN0eWxlLndpZHRoID0gXCIwXCI7XHJcbiAgICB9XHJcbiAgICAgICAgXHJcbn1cclxuXHJcbiQoYXBwLmluaXQpO1xyXG4iXSwic291cmNlUm9vdCI6IiJ9