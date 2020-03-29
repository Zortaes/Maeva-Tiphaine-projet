/******/ (function(modules) { // webpackBootstrap
/******/ 	// install a JSONP callback for chunk loading
/******/ 	function webpackJsonpCallback(data) {
/******/ 		var chunkIds = data[0];
/******/ 		var moreModules = data[1];
/******/ 		var executeModules = data[2];
/******/
/******/ 		// add "moreModules" to the modules object,
/******/ 		// then flag all "chunkIds" as loaded and fire callback
/******/ 		var moduleId, chunkId, i = 0, resolves = [];
/******/ 		for(;i < chunkIds.length; i++) {
/******/ 			chunkId = chunkIds[i];
/******/ 			if(Object.prototype.hasOwnProperty.call(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 				resolves.push(installedChunks[chunkId][0]);
/******/ 			}
/******/ 			installedChunks[chunkId] = 0;
/******/ 		}
/******/ 		for(moduleId in moreModules) {
/******/ 			if(Object.prototype.hasOwnProperty.call(moreModules, moduleId)) {
/******/ 				modules[moduleId] = moreModules[moduleId];
/******/ 			}
/******/ 		}
/******/ 		if(parentJsonpFunction) parentJsonpFunction(data);
/******/
/******/ 		while(resolves.length) {
/******/ 			resolves.shift()();
/******/ 		}
/******/
/******/ 		// add entry modules from loaded chunk to deferred list
/******/ 		deferredModules.push.apply(deferredModules, executeModules || []);
/******/
/******/ 		// run deferred modules when all chunks ready
/******/ 		return checkDeferredModules();
/******/ 	};
/******/ 	function checkDeferredModules() {
/******/ 		var result;
/******/ 		for(var i = 0; i < deferredModules.length; i++) {
/******/ 			var deferredModule = deferredModules[i];
/******/ 			var fulfilled = true;
/******/ 			for(var j = 1; j < deferredModule.length; j++) {
/******/ 				var depId = deferredModule[j];
/******/ 				if(installedChunks[depId] !== 0) fulfilled = false;
/******/ 			}
/******/ 			if(fulfilled) {
/******/ 				deferredModules.splice(i--, 1);
/******/ 				result = __webpack_require__(__webpack_require__.s = deferredModule[0]);
/******/ 			}
/******/ 		}
/******/
/******/ 		return result;
/******/ 	}
/******/
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// object to store loaded and loading chunks
/******/ 	// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 	// Promise = chunk loading, 0 = chunk loaded
/******/ 	var installedChunks = {
/******/ 		"app": 0
/******/ 	};
/******/
/******/ 	var deferredModules = [];
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/build/";
/******/
/******/ 	var jsonpArray = window["webpackJsonp"] = window["webpackJsonp"] || [];
/******/ 	var oldJsonpFunction = jsonpArray.push.bind(jsonpArray);
/******/ 	jsonpArray.push = webpackJsonpCallback;
/******/ 	jsonpArray = jsonpArray.slice();
/******/ 	for(var i = 0; i < jsonpArray.length; i++) webpackJsonpCallback(jsonpArray[i]);
/******/ 	var parentJsonpFunction = oldJsonpFunction;
/******/
/******/
/******/ 	// add entry module to deferred list
/******/ 	deferredModules.push(["./assets/js/app.js","vendors~app"]);
/******/ 	// run deferred modules when ready
/******/ 	return checkDeferredModules();
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/css/app.scss":
/*!*****************************!*\
  !*** ./assets/css/app.scss ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ "./assets/images/accessoires-bijoux.jpg":
/*!**********************************************!*\
  !*** ./assets/images/accessoires-bijoux.jpg ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/accessoires-bijoux.058d8ef0.jpg";

/***/ }),

/***/ "./assets/images/animaux.jpg":
/*!***********************************!*\
  !*** ./assets/images/animaux.jpg ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/animaux.a1234e59.jpg";

/***/ }),

/***/ "./assets/images/arts.jpg":
/*!********************************!*\
  !*** ./assets/images/arts.jpg ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/arts.e73ee8d8.jpg";

/***/ }),

/***/ "./assets/images/bricolage.jpg":
/*!*************************************!*\
  !*** ./assets/images/bricolage.jpg ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/bricolage.38ecf90a.jpg";

/***/ }),

/***/ "./assets/images/cosmetiques-beaute-et-soins.jpg":
/*!*******************************************************!*\
  !*** ./assets/images/cosmetiques-beaute-et-soins.jpg ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/cosmetiques-beaute-et-soins.04bdae80.jpg";

/***/ }),

/***/ "./assets/images/decorations.jpg":
/*!***************************************!*\
  !*** ./assets/images/decorations.jpg ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/decorations.650b47db.jpg";

/***/ }),

/***/ "./assets/images/hygiene-corporelle.jpg":
/*!**********************************************!*\
  !*** ./assets/images/hygiene-corporelle.jpg ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/hygiene-corporelle.dd852fbc.jpg";

/***/ }),

/***/ "./assets/images/imageHome.jpg":
/*!*************************************!*\
  !*** ./assets/images/imageHome.jpg ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/imageHome.b846a7d2.jpg";

/***/ }),

/***/ "./assets/images/jardin-jardinage.jpg":
/*!********************************************!*\
  !*** ./assets/images/jardin-jardinage.jpg ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/jardin-jardinage.5e821b2d.jpg";

/***/ }),

/***/ "./assets/images/jeux.jpg":
/*!********************************!*\
  !*** ./assets/images/jeux.jpg ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/jeux.cfc19b17.jpg";

/***/ }),

/***/ "./assets/images/linge-de-maison.jpg":
/*!*******************************************!*\
  !*** ./assets/images/linge-de-maison.jpg ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/linge-de-maison.022f251d.jpg";

/***/ }),

/***/ "./assets/images/menage-hygiene-maison.jpg":
/*!*************************************************!*\
  !*** ./assets/images/menage-hygiene-maison.jpg ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/menage-hygiene-maison.40859839.jpg";

/***/ }),

/***/ "./assets/images/recyclage.jpg":
/*!*************************************!*\
  !*** ./assets/images/recyclage.jpg ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/recyclage.5a09f711.jpg";

/***/ }),

/***/ "./assets/images/vetements.jpg":
/*!*************************************!*\
  !*** ./assets/images/vetements.jpg ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/vetements.db456796.jpg";

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


__webpack_require__(/*! ../images/imageHome.jpg */ "./assets/images/imageHome.jpg");

__webpack_require__(/*! ../images/accessoires-bijoux.jpg */ "./assets/images/accessoires-bijoux.jpg");

__webpack_require__(/*! ../images/arts.jpg */ "./assets/images/arts.jpg");

__webpack_require__(/*! ../images/animaux.jpg */ "./assets/images/animaux.jpg");

__webpack_require__(/*! ../images/bricolage.jpg */ "./assets/images/bricolage.jpg");

__webpack_require__(/*! ../images/cosmetiques-beaute-et-soins.jpg */ "./assets/images/cosmetiques-beaute-et-soins.jpg");

__webpack_require__(/*! ../images/decorations.jpg */ "./assets/images/decorations.jpg");

__webpack_require__(/*! ../images/hygiene-corporelle.jpg */ "./assets/images/hygiene-corporelle.jpg");

__webpack_require__(/*! ../images/jardin-jardinage.jpg */ "./assets/images/jardin-jardinage.jpg");

__webpack_require__(/*! ../images/jeux.jpg */ "./assets/images/jeux.jpg");

__webpack_require__(/*! ../images/linge-de-maison.jpg */ "./assets/images/linge-de-maison.jpg");

__webpack_require__(/*! ../images/menage-hygiene-maison.jpg */ "./assets/images/menage-hygiene-maison.jpg");

__webpack_require__(/*! ../images/recyclage.jpg */ "./assets/images/recyclage.jpg");

__webpack_require__(/*! ../images/vetements.jpg */ "./assets/images/vetements.jpg"); // Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
//import $ from 'jquery';


var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

var app = {
  init: function init() {
    console.log('init');
    $(document).ready(function () {
      $("#sideOpenbtn").on("click", function () {
        app.openSideNav();
      });
      $(".closebtn").on("click", function () {
        app.closeSideNav();
      });
    });
  },
  openSideNav: function openSideNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("mySidebar").style.display = "absolute";
    document.getElementById("overlay").style.display = "block";
  },

  /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
  closeSideNav: function closeSideNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("overlay").style.display = "none";
  }
};
$(app.init);

/***/ })


},[["./assets/js/app.js","runtime","vendors~app"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY3NzL2FwcC5zY3NzIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvYWNjZXNzb2lyZXMtYmlqb3V4LmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL2FuaW1hdXguanBnIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvYXJ0cy5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9icmljb2xhZ2UuanBnIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvY29zbWV0aXF1ZXMtYmVhdXRlLWV0LXNvaW5zLmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL2RlY29yYXRpb25zLmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL2h5Z2llbmUtY29ycG9yZWxsZS5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9pbWFnZUhvbWUuanBnIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvamFyZGluLWphcmRpbmFnZS5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9qZXV4LmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL2xpbmdlLWRlLW1haXNvbi5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9tZW5hZ2UtaHlnaWVuZS1tYWlzb24uanBnIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvcmVjeWNsYWdlLmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL3ZldGVtZW50cy5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2FwcC5qcyJdLCJuYW1lcyI6WyJyZXF1aXJlIiwiJCIsImNvbnNvbGUiLCJsb2ciLCJhcHAiLCJpbml0IiwiZG9jdW1lbnQiLCJyZWFkeSIsIm9uIiwib3BlblNpZGVOYXYiLCJjbG9zZVNpZGVOYXYiLCJnZXRFbGVtZW50QnlJZCIsInN0eWxlIiwid2lkdGgiLCJkaXNwbGF5Il0sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7QUFBQSx1Qzs7Ozs7Ozs7Ozs7QUNBQSxpRTs7Ozs7Ozs7Ozs7QUNBQSxzRDs7Ozs7Ozs7Ozs7QUNBQSxtRDs7Ozs7Ozs7Ozs7QUNBQSx3RDs7Ozs7Ozs7Ozs7QUNBQSwwRTs7Ozs7Ozs7Ozs7QUNBQSwwRDs7Ozs7Ozs7Ozs7QUNBQSxpRTs7Ozs7Ozs7Ozs7QUNBQSx3RDs7Ozs7Ozs7Ozs7QUNBQSwrRDs7Ozs7Ozs7Ozs7QUNBQSxtRDs7Ozs7Ozs7Ozs7QUNBQSw4RDs7Ozs7Ozs7Ozs7QUNBQSxvRTs7Ozs7Ozs7Ozs7QUNBQSx3RDs7Ozs7Ozs7Ozs7QUNBQSx3RDs7Ozs7Ozs7Ozs7O0FDQUE7QUFBQTtBQUFBO0FBQUE7Ozs7OztBQU9BO0FBQ0E7O0FBRUFBLG1CQUFPLENBQUMsOERBQUQsQ0FBUDs7QUFDQUEsbUJBQU8sQ0FBQyxnRkFBRCxDQUFQOztBQUNBQSxtQkFBTyxDQUFDLG9EQUFELENBQVA7O0FBQ0FBLG1CQUFPLENBQUMsMERBQUQsQ0FBUDs7QUFDQUEsbUJBQU8sQ0FBQyw4REFBRCxDQUFQOztBQUNBQSxtQkFBTyxDQUFDLGtHQUFELENBQVA7O0FBQ0FBLG1CQUFPLENBQUMsa0VBQUQsQ0FBUDs7QUFDQUEsbUJBQU8sQ0FBQyxnRkFBRCxDQUFQOztBQUNBQSxtQkFBTyxDQUFDLDRFQUFELENBQVA7O0FBQ0FBLG1CQUFPLENBQUMsb0RBQUQsQ0FBUDs7QUFDQUEsbUJBQU8sQ0FBQywwRUFBRCxDQUFQOztBQUNBQSxtQkFBTyxDQUFDLHNGQUFELENBQVA7O0FBQ0FBLG1CQUFPLENBQUMsOERBQUQsQ0FBUDs7QUFDQUEsbUJBQU8sQ0FBQyw4REFBRCxDQUFQLEMsQ0FHQTtBQUNBOzs7QUFFQSxJQUFJQyxDQUFDLEdBQUdELG1CQUFPLENBQUMsb0RBQUQsQ0FBZjs7QUFFQUUsT0FBTyxDQUFDQyxHQUFSLENBQVksbURBQVo7QUFHQSxJQUFJQyxHQUFHLEdBQUc7QUFDTkMsTUFBSSxFQUFDLGdCQUNMO0FBQ0lILFdBQU8sQ0FBQ0MsR0FBUixDQUFZLE1BQVo7QUFFQUYsS0FBQyxDQUFDSyxRQUFELENBQUQsQ0FBWUMsS0FBWixDQUFrQixZQUNsQjtBQUNJTixPQUFDLENBQUMsY0FBRCxDQUFELENBQWtCTyxFQUFsQixDQUFxQixPQUFyQixFQUE4QixZQUFVO0FBQ3BDSixXQUFHLENBQUNLLFdBQUo7QUFDSCxPQUZEO0FBSUFSLE9BQUMsQ0FBQyxXQUFELENBQUQsQ0FBZU8sRUFBZixDQUFrQixPQUFsQixFQUEyQixZQUFVO0FBQ2pDSixXQUFHLENBQUNNLFlBQUo7QUFDSCxPQUZEO0FBSUgsS0FWRDtBQVdILEdBaEJLO0FBa0JORCxhQUFXLEVBQUMsdUJBQ1o7QUFDQUgsWUFBUSxDQUFDSyxjQUFULENBQXdCLFdBQXhCLEVBQXFDQyxLQUFyQyxDQUEyQ0MsS0FBM0MsR0FBbUQsT0FBbkQ7QUFDQVAsWUFBUSxDQUFDSyxjQUFULENBQXdCLFdBQXhCLEVBQXFDQyxLQUFyQyxDQUEyQ0UsT0FBM0MsR0FBcUQsVUFBckQ7QUFDQVIsWUFBUSxDQUFDSyxjQUFULENBQXdCLFNBQXhCLEVBQW1DQyxLQUFuQyxDQUF5Q0UsT0FBekMsR0FBbUQsT0FBbkQ7QUFDQyxHQXZCSzs7QUF5Qk47QUFDQUosY0FBWSxFQUFDLHdCQUNiO0FBQ0FKLFlBQVEsQ0FBQ0ssY0FBVCxDQUF3QixXQUF4QixFQUFxQ0MsS0FBckMsQ0FBMkNDLEtBQTNDLEdBQW1ELEdBQW5EO0FBQ0FQLFlBQVEsQ0FBQ0ssY0FBVCxDQUF3QixTQUF4QixFQUFtQ0MsS0FBbkMsQ0FBeUNFLE9BQXpDLEdBQW1ELE1BQW5EO0FBQ0M7QUE5QkssQ0FBVjtBQW1DQWIsQ0FBQyxDQUFDRyxHQUFHLENBQUNDLElBQUwsQ0FBRCxDIiwiZmlsZSI6ImFwcC5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpbiIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL2FjY2Vzc29pcmVzLWJpam91eC4wNThkOGVmMC5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9hbmltYXV4LmExMjM0ZTU5LmpwZ1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL2FydHMuZTczZWU4ZDguanBnXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvYnJpY29sYWdlLjM4ZWNmOTBhLmpwZ1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL2Nvc21ldGlxdWVzLWJlYXV0ZS1ldC1zb2lucy4wNGJkYWU4MC5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9kZWNvcmF0aW9ucy42NTBiNDdkYi5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9oeWdpZW5lLWNvcnBvcmVsbGUuZGQ4NTJmYmMuanBnXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvaW1hZ2VIb21lLmI4NDZhN2QyLmpwZ1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL2phcmRpbi1qYXJkaW5hZ2UuNWU4MjFiMmQuanBnXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvamV1eC5jZmMxOWIxNy5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9saW5nZS1kZS1tYWlzb24uMDIyZjI1MWQuanBnXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvbWVuYWdlLWh5Z2llbmUtbWFpc29uLjQwODU5ODM5LmpwZ1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL3JlY3ljbGFnZS41YTA5ZjcxMS5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy92ZXRlbWVudHMuZGI0NTY3OTYuanBnXCI7IiwiLypcclxuICogV2VsY29tZSB0byB5b3VyIGFwcCdzIG1haW4gSmF2YVNjcmlwdCBmaWxlIVxyXG4gKlxyXG4gKiBXZSByZWNvbW1lbmQgaW5jbHVkaW5nIHRoZSBidWlsdCB2ZXJzaW9uIG9mIHRoaXMgSmF2YVNjcmlwdCBmaWxlXHJcbiAqIChhbmQgaXRzIENTUyBmaWxlKSBpbiB5b3VyIGJhc2UgbGF5b3V0IChiYXNlLmh0bWwudHdpZykuXHJcbiAqL1xyXG5cclxuLy8gYW55IENTUyB5b3UgaW1wb3J0IHdpbGwgb3V0cHV0IGludG8gYSBzaW5nbGUgY3NzIGZpbGUgKGFwcC5jc3MgaW4gdGhpcyBjYXNlKVxyXG5pbXBvcnQgJy4uL2Nzcy9hcHAuc2Nzcyc7XHJcblxyXG5yZXF1aXJlKCcuLi9pbWFnZXMvaW1hZ2VIb21lLmpwZycpO1xyXG5yZXF1aXJlKCcuLi9pbWFnZXMvYWNjZXNzb2lyZXMtYmlqb3V4LmpwZycpO1xyXG5yZXF1aXJlKCcuLi9pbWFnZXMvYXJ0cy5qcGcnKTtcclxucmVxdWlyZSgnLi4vaW1hZ2VzL2FuaW1hdXguanBnJyk7XHJcbnJlcXVpcmUoJy4uL2ltYWdlcy9icmljb2xhZ2UuanBnJyk7XHJcbnJlcXVpcmUoJy4uL2ltYWdlcy9jb3NtZXRpcXVlcy1iZWF1dGUtZXQtc29pbnMuanBnJyk7XHJcbnJlcXVpcmUoJy4uL2ltYWdlcy9kZWNvcmF0aW9ucy5qcGcnKTtcclxucmVxdWlyZSgnLi4vaW1hZ2VzL2h5Z2llbmUtY29ycG9yZWxsZS5qcGcnKTtcclxucmVxdWlyZSgnLi4vaW1hZ2VzL2phcmRpbi1qYXJkaW5hZ2UuanBnJyk7XHJcbnJlcXVpcmUoJy4uL2ltYWdlcy9qZXV4LmpwZycpO1xyXG5yZXF1aXJlKCcuLi9pbWFnZXMvbGluZ2UtZGUtbWFpc29uLmpwZycpO1xyXG5yZXF1aXJlKCcuLi9pbWFnZXMvbWVuYWdlLWh5Z2llbmUtbWFpc29uLmpwZycpO1xyXG5yZXF1aXJlKCcuLi9pbWFnZXMvcmVjeWNsYWdlLmpwZycpO1xyXG5yZXF1aXJlKCcuLi9pbWFnZXMvdmV0ZW1lbnRzLmpwZycpO1xyXG5cclxuXHJcbi8vIE5lZWQgalF1ZXJ5PyBJbnN0YWxsIGl0IHdpdGggXCJ5YXJuIGFkZCBqcXVlcnlcIiwgdGhlbiB1bmNvbW1lbnQgdG8gaW1wb3J0IGl0LlxyXG4vL2ltcG9ydCAkIGZyb20gJ2pxdWVyeSc7XHJcblxyXG52YXIgJCA9IHJlcXVpcmUoJ2pxdWVyeScpO1xyXG5cclxuY29uc29sZS5sb2coJ0hlbGxvIFdlYnBhY2sgRW5jb3JlISBFZGl0IG1lIGluIGFzc2V0cy9qcy9hcHAuanMnKTtcclxuXHJcblxyXG52YXIgYXBwID0ge1xyXG4gICAgaW5pdDpmdW5jdGlvbigpIFxyXG4gICAge1xyXG4gICAgICAgIGNvbnNvbGUubG9nKCdpbml0Jyk7XHJcblxyXG4gICAgICAgICQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKClcclxuICAgICAgICB7XHJcbiAgICAgICAgICAgICQoXCIjc2lkZU9wZW5idG5cIikub24oXCJjbGlja1wiLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAgICAgYXBwLm9wZW5TaWRlTmF2KCk7IFxyXG4gICAgICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgICAgICQoXCIuY2xvc2VidG5cIikub24oXCJjbGlja1wiLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAgICAgYXBwLmNsb3NlU2lkZU5hdigpOyBcclxuICAgICAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIH0pXHJcbiAgICB9LFxyXG5cclxuICAgIG9wZW5TaWRlTmF2OmZ1bmN0aW9uKCkgXHJcbiAgICB7XHJcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm15U2lkZWJhclwiKS5zdHlsZS53aWR0aCA9IFwiMjUwcHhcIjtcclxuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibXlTaWRlYmFyXCIpLnN0eWxlLmRpc3BsYXkgPSBcImFic29sdXRlXCI7XHJcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm92ZXJsYXlcIikuc3R5bGUuZGlzcGxheSA9IFwiYmxvY2tcIjtcclxuICAgIH0sXHJcbiAgICAgICAgICAgIFxyXG4gICAgLyogU2V0IHRoZSB3aWR0aCBvZiB0aGUgc2lkZWJhciB0byAwIGFuZCB0aGUgbGVmdCBtYXJnaW4gb2YgdGhlIHBhZ2UgY29udGVudCB0byAwICovXHJcbiAgICBjbG9zZVNpZGVOYXY6ZnVuY3Rpb24oKSBcclxuICAgIHtcclxuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibXlTaWRlYmFyXCIpLnN0eWxlLndpZHRoID0gXCIwXCI7XHJcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm92ZXJsYXlcIikuc3R5bGUuZGlzcGxheSA9IFwibm9uZVwiO1xyXG4gICAgfSxcclxuXHJcbiAgICAgICAgXHJcbn1cclxuXHJcbiQoYXBwLmluaXQpO1xyXG4iXSwic291cmNlUm9vdCI6IiJ9

