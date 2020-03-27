(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["app"],{

/***/ "./assets/css/app.scss":
/*!*****************************!*\
  !*** ./assets/css/app.scss ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ "./assets/images/imageHome.jpg":
/*!*************************************!*\
  !*** ./assets/images/imageHome.jpg ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/imageHome.b846a7d2.jpg";

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


__webpack_require__(/*! ../images/imageHome.jpg */ "./assets/images/imageHome.jpg"); // Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY3NzL2FwcC5zY3NzIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvaW1hZ2VIb21lLmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvYXBwLmpzIl0sIm5hbWVzIjpbInJlcXVpcmUiLCIkIiwiY29uc29sZSIsImxvZyIsImFwcCIsImluaXQiLCJkb2N1bWVudCIsInJlYWR5Iiwib24iLCJvcGVuTmF2IiwiY2xvc2VOYXYiLCJnZXRFbGVtZW50QnlJZCIsInN0eWxlIiwid2lkdGgiLCJkaXNwbGF5Il0sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7QUFBQSx1Qzs7Ozs7Ozs7Ozs7QUNBQSx3RDs7Ozs7Ozs7Ozs7O0FDQUE7QUFBQTtBQUFBO0FBQUE7Ozs7OztBQU9BO0FBQ0E7O0FBRUFBLG1CQUFPLENBQUMsOERBQUQsQ0FBUCxDLENBRUE7QUFDQTs7O0FBRUEsSUFBSUMsQ0FBQyxHQUFHRCxtQkFBTyxDQUFDLG9EQUFELENBQWY7O0FBRUFFLE9BQU8sQ0FBQ0MsR0FBUixDQUFZLG1EQUFaO0FBR0EsSUFBSUMsR0FBRyxHQUFHO0FBQ05DLE1BQUksRUFBQyxnQkFDTDtBQUNJSCxXQUFPLENBQUNDLEdBQVIsQ0FBWSxNQUFaO0FBRUFGLEtBQUMsQ0FBQ0ssUUFBRCxDQUFELENBQVlDLEtBQVosQ0FBa0IsWUFDbEI7QUFDSU4sT0FBQyxDQUFDLGlCQUFELENBQUQsQ0FBcUJPLEVBQXJCLENBQXdCLE9BQXhCLEVBQWlDLFlBQVU7QUFDdkNKLFdBQUcsQ0FBQ0ssT0FBSjtBQUNILE9BRkQ7QUFJQVIsT0FBQyxDQUFDLFdBQUQsQ0FBRCxDQUFlTyxFQUFmLENBQWtCLE9BQWxCLEVBQTJCLFlBQVU7QUFDakNKLFdBQUcsQ0FBQ00sUUFBSjtBQUNILE9BRkQ7QUFHSCxLQVREO0FBVUgsR0FmSztBQWlCTkQsU0FBTyxFQUFDLG1CQUNSO0FBQ0FILFlBQVEsQ0FBQ0ssY0FBVCxDQUF3QixXQUF4QixFQUFxQ0MsS0FBckMsQ0FBMkNDLEtBQTNDLEdBQW1ELE9BQW5EO0FBQ0FQLFlBQVEsQ0FBQ0ssY0FBVCxDQUF3QixXQUF4QixFQUFxQ0MsS0FBckMsQ0FBMkNFLE9BQTNDLEdBQXFELFVBQXJEO0FBQ0MsR0FyQks7O0FBdUJOO0FBQ0FKLFVBQVEsRUFBQyxvQkFDVDtBQUNBSixZQUFRLENBQUNLLGNBQVQsQ0FBd0IsV0FBeEIsRUFBcUNDLEtBQXJDLENBQTJDQyxLQUEzQyxHQUFtRCxHQUFuRDtBQUNDO0FBM0JLLENBQVY7QUErQkFaLENBQUMsQ0FBQ0csR0FBRyxDQUFDQyxJQUFMLENBQUQsQyIsImZpbGUiOiJhcHAuanMiLCJzb3VyY2VzQ29udGVudCI6WyIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW4iLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9pbWFnZUhvbWUuYjg0NmE3ZDIuanBnXCI7IiwiLypcbiAqIFdlbGNvbWUgdG8geW91ciBhcHAncyBtYWluIEphdmFTY3JpcHQgZmlsZSFcbiAqXG4gKiBXZSByZWNvbW1lbmQgaW5jbHVkaW5nIHRoZSBidWlsdCB2ZXJzaW9uIG9mIHRoaXMgSmF2YVNjcmlwdCBmaWxlXG4gKiAoYW5kIGl0cyBDU1MgZmlsZSkgaW4geW91ciBiYXNlIGxheW91dCAoYmFzZS5odG1sLnR3aWcpLlxuICovXG5cbi8vIGFueSBDU1MgeW91IGltcG9ydCB3aWxsIG91dHB1dCBpbnRvIGEgc2luZ2xlIGNzcyBmaWxlIChhcHAuY3NzIGluIHRoaXMgY2FzZSlcbmltcG9ydCAnLi4vY3NzL2FwcC5zY3NzJztcblxucmVxdWlyZSgnLi4vaW1hZ2VzL2ltYWdlSG9tZS5qcGcnKTsgXG5cbi8vIE5lZWQgalF1ZXJ5PyBJbnN0YWxsIGl0IHdpdGggXCJ5YXJuIGFkZCBqcXVlcnlcIiwgdGhlbiB1bmNvbW1lbnQgdG8gaW1wb3J0IGl0LlxuLy9pbXBvcnQgJCBmcm9tICdqcXVlcnknO1xuXG52YXIgJCA9IHJlcXVpcmUoJ2pxdWVyeScpO1xuXG5jb25zb2xlLmxvZygnSGVsbG8gV2VicGFjayBFbmNvcmUhIEVkaXQgbWUgaW4gYXNzZXRzL2pzL2FwcC5qcycpO1xuXG5cbnZhciBhcHAgPSB7XG4gICAgaW5pdDpmdW5jdGlvbigpIFxuICAgIHtcbiAgICAgICAgY29uc29sZS5sb2coJ2luaXQnKTtcblxuICAgICAgICAkKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpXG4gICAgICAgIHtcbiAgICAgICAgICAgICQoXCIubmF2YmFyLXRvZ2dsZXJcIikub24oXCJjbGlja1wiLCBmdW5jdGlvbigpe1xuICAgICAgICAgICAgICAgIGFwcC5vcGVuTmF2KCk7IFxuICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgICQoXCIuY2xvc2VidG5cIikub24oXCJjbGlja1wiLCBmdW5jdGlvbigpe1xuICAgICAgICAgICAgICAgIGFwcC5jbG9zZU5hdigpOyBcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9KVxuICAgIH0sXG5cbiAgICBvcGVuTmF2OmZ1bmN0aW9uKCkgXG4gICAge1xuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibXlTaWRlYmFyXCIpLnN0eWxlLndpZHRoID0gXCIzMDBweFwiO1xuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibXlTaWRlYmFyXCIpLnN0eWxlLmRpc3BsYXkgPSBcImFic29sdXRlXCI7XG4gICAgfSxcbiAgICAgICAgICAgIFxuICAgIC8qIFNldCB0aGUgd2lkdGggb2YgdGhlIHNpZGViYXIgdG8gMCBhbmQgdGhlIGxlZnQgbWFyZ2luIG9mIHRoZSBwYWdlIGNvbnRlbnQgdG8gMCAqL1xuICAgIGNsb3NlTmF2OmZ1bmN0aW9uKCkgXG4gICAge1xuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibXlTaWRlYmFyXCIpLnN0eWxlLndpZHRoID0gXCIwXCI7XG4gICAgfVxuICAgICAgICBcbn1cblxuJChhcHAuaW5pdCk7XG4iXSwic291cmNlUm9vdCI6IiJ9