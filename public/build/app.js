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
/******/ 	deferredModules.push(["./assets/js/app.js","vendors~app~formArticle~formSignup~homepage~pagination","vendors~app"]);
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

/***/ "./assets/images/Logo.jpg":
/*!********************************!*\
  !*** ./assets/images/Logo.jpg ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/Logo.c78812cb.jpg";

/***/ }),

/***/ "./assets/images/TiphaineLe.jpg":
/*!**************************************!*\
  !*** ./assets/images/TiphaineLe.jpg ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/TiphaineLe.e418b3a7.jpg";

/***/ }),

/***/ "./assets/images/TiphaineSu.jpg":
/*!**************************************!*\
  !*** ./assets/images/TiphaineSu.jpg ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/TiphaineSu.7b2a3ff6.jpg";

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

/***/ "./assets/images/articlesFlag.jpg":
/*!****************************************!*\
  !*** ./assets/images/articlesFlag.jpg ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/articlesFlag.a012a5fc.jpg";

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

module.exports = "/build/images/decorations.9746c738.jpg";

/***/ }),

/***/ "./assets/images/defaultAvatar.jpg":
/*!*****************************************!*\
  !*** ./assets/images/defaultAvatar.jpg ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/defaultAvatar.5e30bbac.jpg";

/***/ }),

/***/ "./assets/images/favicon.ico":
/*!***********************************!*\
  !*** ./assets/images/favicon.ico ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/favicon.786d94a2.ico";

/***/ }),

/***/ "./assets/images/hygiene-corporelle.jpg":
/*!**********************************************!*\
  !*** ./assets/images/hygiene-corporelle.jpg ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/hygiene-corporelle.dd852fbc.jpg";

/***/ }),

/***/ "./assets/images/iconUser.png":
/*!************************************!*\
  !*** ./assets/images/iconUser.png ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/iconUser.91536e5e.png";

/***/ }),

/***/ "./assets/images/iconparam.png":
/*!*************************************!*\
  !*** ./assets/images/iconparam.png ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/iconparam.c3536ee1.png";

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

/***/ "./assets/images/logoLinkedin.jpg":
/*!****************************************!*\
  !*** ./assets/images/logoLinkedin.jpg ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/logoLinkedin.2be9782a.jpg";

/***/ }),

/***/ "./assets/images/lost_tree.png":
/*!*************************************!*\
  !*** ./assets/images/lost_tree.png ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/lost_tree.b93fb11f.png";

/***/ }),

/***/ "./assets/images/maeva.jpg":
/*!*********************************!*\
  !*** ./assets/images/maeva.jpg ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/maeva.b2f20d34.jpg";

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


__webpack_require__(/*! ../images/favicon.ico */ "./assets/images/favicon.ico");

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

__webpack_require__(/*! ../images/vetements.jpg */ "./assets/images/vetements.jpg");

__webpack_require__(/*! ../images/TiphaineSu.jpg */ "./assets/images/TiphaineSu.jpg");

__webpack_require__(/*! ../images/TiphaineLe.jpg */ "./assets/images/TiphaineLe.jpg");

__webpack_require__(/*! ../images/maeva.jpg */ "./assets/images/maeva.jpg");

__webpack_require__(/*! ../images/logoLinkedin.jpg */ "./assets/images/logoLinkedin.jpg");

__webpack_require__(/*! ../images/iconparam.png */ "./assets/images/iconparam.png");

__webpack_require__(/*! ../images/articlesFlag.jpg */ "./assets/images/articlesFlag.jpg");

__webpack_require__(/*! ../images/iconUser.png */ "./assets/images/iconUser.png");

__webpack_require__(/*! ../images/Logo.jpg */ "./assets/images/Logo.jpg");

__webpack_require__(/*! ../images/lost_tree.png */ "./assets/images/lost_tree.png");

__webpack_require__(/*! ../images/defaultAvatar.jpg */ "./assets/images/defaultAvatar.jpg"); // Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
//import $ from 'jquery';


var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

__webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.js");

var app = {
  init: function init() {
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

/******/ });
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2Nzcy9hcHAuc2NzcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL0xvZ28uanBnIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvVGlwaGFpbmVMZS5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9UaXBoYWluZVN1LmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL2FjY2Vzc29pcmVzLWJpam91eC5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9hbmltYXV4LmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL2FydGljbGVzRmxhZy5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9hcnRzLmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL2JyaWNvbGFnZS5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9jb3NtZXRpcXVlcy1iZWF1dGUtZXQtc29pbnMuanBnIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvZGVjb3JhdGlvbnMuanBnIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvZGVmYXVsdEF2YXRhci5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9mYXZpY29uLmljbyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL2h5Z2llbmUtY29ycG9yZWxsZS5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9pY29uVXNlci5wbmciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9pY29ucGFyYW0ucG5nIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvaW1hZ2VIb21lLmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL2phcmRpbi1qYXJkaW5hZ2UuanBnIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvamV1eC5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9saW5nZS1kZS1tYWlzb24uanBnIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvbG9nb0xpbmtlZGluLmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL2xvc3RfdHJlZS5wbmciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9tYWV2YS5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9tZW5hZ2UtaHlnaWVuZS1tYWlzb24uanBnIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvcmVjeWNsYWdlLmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL3ZldGVtZW50cy5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2FwcC5qcyJdLCJuYW1lcyI6WyJyZXF1aXJlIiwiJCIsImFwcCIsImluaXQiLCJkb2N1bWVudCIsInJlYWR5Iiwib24iLCJvcGVuU2lkZU5hdiIsImNsb3NlU2lkZU5hdiIsImdldEVsZW1lbnRCeUlkIiwic3R5bGUiLCJ3aWR0aCIsImRpc3BsYXkiXSwibWFwcGluZ3MiOiI7UUFBQTtRQUNBO1FBQ0E7UUFDQTtRQUNBOztRQUVBO1FBQ0E7UUFDQTtRQUNBLFFBQVEsb0JBQW9CO1FBQzVCO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTs7UUFFQTtRQUNBO1FBQ0E7O1FBRUE7UUFDQTs7UUFFQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0EsaUJBQWlCLDRCQUE0QjtRQUM3QztRQUNBO1FBQ0Esa0JBQWtCLDJCQUEyQjtRQUM3QztRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBOztRQUVBO1FBQ0E7O1FBRUE7UUFDQTs7UUFFQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7O1FBRUE7O1FBRUE7UUFDQTs7UUFFQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7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RUFBQyxnQkFDTDtBQUVJRixLQUFDLENBQUNHLFFBQUQsQ0FBRCxDQUFZQyxLQUFaLENBQWtCLFlBQ2xCO0FBQ0lKLE9BQUMsQ0FBQyxjQUFELENBQUQsQ0FBa0JLLEVBQWxCLENBQXFCLE9BQXJCLEVBQThCLFlBQVU7QUFDcENKLFdBQUcsQ0FBQ0ssV0FBSjtBQUNILE9BRkQ7QUFJQU4sT0FBQyxDQUFDLFdBQUQsQ0FBRCxDQUFlSyxFQUFmLENBQWtCLE9BQWxCLEVBQTJCLFlBQVU7QUFDakNKLFdBQUcsQ0FBQ00sWUFBSjtBQUNILE9BRkQ7QUFJSCxLQVZEO0FBV0gsR0FmSztBQWlCTkQsYUFBVyxFQUFDLHVCQUNaO0FBQ0FILFlBQVEsQ0FBQ0ssY0FBVCxDQUF3QixXQUF4QixFQUFxQ0MsS0FBckMsQ0FBMkNDLEtBQTNDLEdBQW1ELE9BQW5EO0FBQ0FQLFlBQVEsQ0FBQ0ssY0FBVCxDQUF3QixXQUF4QixFQUFxQ0MsS0FBckMsQ0FBMkNFLE9BQTNDLEdBQXFELFVBQXJEO0FBQ0FSLFlBQVEsQ0FBQ0ssY0FBVCxDQUF3QixTQUF4QixFQUFtQ0MsS0FBbkMsQ0FBeUNFLE9BQXpDLEdBQW1ELE9BQW5EO0FBQ0MsR0F0Qks7O0FBd0JOO0FBQ0FKLGNBQVksRUFBQyx3QkFDYjtBQUNBSixZQUFRLENBQUNLLGNBQVQsQ0FBd0IsV0FBeEIsRUFBcUNDLEtBQXJDLENBQTJDQyxLQUEzQyxHQUFtRCxHQUFuRDtBQUNBUCxZQUFRLENBQUNLLGNBQVQsQ0FBd0IsU0FBeEIsRUFBbUNDLEtBQW5DLENBQXlDRSxPQUF6QyxHQUFtRCxNQUFuRDtBQUNDO0FBN0JLLENBQVY7QUFrQ0FYLENBQUMsQ0FBQ0MsR0FBRyxDQUFDQyxJQUFMLENBQUQsQyIsImZpbGUiOiJhcHAuanMiLCJzb3VyY2VzQ29udGVudCI6WyIgXHQvLyBpbnN0YWxsIGEgSlNPTlAgY2FsbGJhY2sgZm9yIGNodW5rIGxvYWRpbmdcbiBcdGZ1bmN0aW9uIHdlYnBhY2tKc29ucENhbGxiYWNrKGRhdGEpIHtcbiBcdFx0dmFyIGNodW5rSWRzID0gZGF0YVswXTtcbiBcdFx0dmFyIG1vcmVNb2R1bGVzID0gZGF0YVsxXTtcbiBcdFx0dmFyIGV4ZWN1dGVNb2R1bGVzID0gZGF0YVsyXTtcblxuIFx0XHQvLyBhZGQgXCJtb3JlTW9kdWxlc1wiIHRvIHRoZSBtb2R1bGVzIG9iamVjdCxcbiBcdFx0Ly8gdGhlbiBmbGFnIGFsbCBcImNodW5rSWRzXCIgYXMgbG9hZGVkIGFuZCBmaXJlIGNhbGxiYWNrXG4gXHRcdHZhciBtb2R1bGVJZCwgY2h1bmtJZCwgaSA9IDAsIHJlc29sdmVzID0gW107XG4gXHRcdGZvcig7aSA8IGNodW5rSWRzLmxlbmd0aDsgaSsrKSB7XG4gXHRcdFx0Y2h1bmtJZCA9IGNodW5rSWRzW2ldO1xuIFx0XHRcdGlmKE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbChpbnN0YWxsZWRDaHVua3MsIGNodW5rSWQpICYmIGluc3RhbGxlZENodW5rc1tjaHVua0lkXSkge1xuIFx0XHRcdFx0cmVzb2x2ZXMucHVzaChpbnN0YWxsZWRDaHVua3NbY2h1bmtJZF1bMF0pO1xuIFx0XHRcdH1cbiBcdFx0XHRpbnN0YWxsZWRDaHVua3NbY2h1bmtJZF0gPSAwO1xuIFx0XHR9XG4gXHRcdGZvcihtb2R1bGVJZCBpbiBtb3JlTW9kdWxlcykge1xuIFx0XHRcdGlmKE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbChtb3JlTW9kdWxlcywgbW9kdWxlSWQpKSB7XG4gXHRcdFx0XHRtb2R1bGVzW21vZHVsZUlkXSA9IG1vcmVNb2R1bGVzW21vZHVsZUlkXTtcbiBcdFx0XHR9XG4gXHRcdH1cbiBcdFx0aWYocGFyZW50SnNvbnBGdW5jdGlvbikgcGFyZW50SnNvbnBGdW5jdGlvbihkYXRhKTtcblxuIFx0XHR3aGlsZShyZXNvbHZlcy5sZW5ndGgpIHtcbiBcdFx0XHRyZXNvbHZlcy5zaGlmdCgpKCk7XG4gXHRcdH1cblxuIFx0XHQvLyBhZGQgZW50cnkgbW9kdWxlcyBmcm9tIGxvYWRlZCBjaHVuayB0byBkZWZlcnJlZCBsaXN0XG4gXHRcdGRlZmVycmVkTW9kdWxlcy5wdXNoLmFwcGx5KGRlZmVycmVkTW9kdWxlcywgZXhlY3V0ZU1vZHVsZXMgfHwgW10pO1xuXG4gXHRcdC8vIHJ1biBkZWZlcnJlZCBtb2R1bGVzIHdoZW4gYWxsIGNodW5rcyByZWFkeVxuIFx0XHRyZXR1cm4gY2hlY2tEZWZlcnJlZE1vZHVsZXMoKTtcbiBcdH07XG4gXHRmdW5jdGlvbiBjaGVja0RlZmVycmVkTW9kdWxlcygpIHtcbiBcdFx0dmFyIHJlc3VsdDtcbiBcdFx0Zm9yKHZhciBpID0gMDsgaSA8IGRlZmVycmVkTW9kdWxlcy5sZW5ndGg7IGkrKykge1xuIFx0XHRcdHZhciBkZWZlcnJlZE1vZHVsZSA9IGRlZmVycmVkTW9kdWxlc1tpXTtcbiBcdFx0XHR2YXIgZnVsZmlsbGVkID0gdHJ1ZTtcbiBcdFx0XHRmb3IodmFyIGogPSAxOyBqIDwgZGVmZXJyZWRNb2R1bGUubGVuZ3RoOyBqKyspIHtcbiBcdFx0XHRcdHZhciBkZXBJZCA9IGRlZmVycmVkTW9kdWxlW2pdO1xuIFx0XHRcdFx0aWYoaW5zdGFsbGVkQ2h1bmtzW2RlcElkXSAhPT0gMCkgZnVsZmlsbGVkID0gZmFsc2U7XG4gXHRcdFx0fVxuIFx0XHRcdGlmKGZ1bGZpbGxlZCkge1xuIFx0XHRcdFx0ZGVmZXJyZWRNb2R1bGVzLnNwbGljZShpLS0sIDEpO1xuIFx0XHRcdFx0cmVzdWx0ID0gX193ZWJwYWNrX3JlcXVpcmVfXyhfX3dlYnBhY2tfcmVxdWlyZV9fLnMgPSBkZWZlcnJlZE1vZHVsZVswXSk7XG4gXHRcdFx0fVxuIFx0XHR9XG5cbiBcdFx0cmV0dXJuIHJlc3VsdDtcbiBcdH1cblxuIFx0Ly8gVGhlIG1vZHVsZSBjYWNoZVxuIFx0dmFyIGluc3RhbGxlZE1vZHVsZXMgPSB7fTtcblxuIFx0Ly8gb2JqZWN0IHRvIHN0b3JlIGxvYWRlZCBhbmQgbG9hZGluZyBjaHVua3NcbiBcdC8vIHVuZGVmaW5lZCA9IGNodW5rIG5vdCBsb2FkZWQsIG51bGwgPSBjaHVuayBwcmVsb2FkZWQvcHJlZmV0Y2hlZFxuIFx0Ly8gUHJvbWlzZSA9IGNodW5rIGxvYWRpbmcsIDAgPSBjaHVuayBsb2FkZWRcbiBcdHZhciBpbnN0YWxsZWRDaHVua3MgPSB7XG4gXHRcdFwiYXBwXCI6IDBcbiBcdH07XG5cbiBcdHZhciBkZWZlcnJlZE1vZHVsZXMgPSBbXTtcblxuIFx0Ly8gVGhlIHJlcXVpcmUgZnVuY3Rpb25cbiBcdGZ1bmN0aW9uIF9fd2VicGFja19yZXF1aXJlX18obW9kdWxlSWQpIHtcblxuIFx0XHQvLyBDaGVjayBpZiBtb2R1bGUgaXMgaW4gY2FjaGVcbiBcdFx0aWYoaW5zdGFsbGVkTW9kdWxlc1ttb2R1bGVJZF0pIHtcbiBcdFx0XHRyZXR1cm4gaW5zdGFsbGVkTW9kdWxlc1ttb2R1bGVJZF0uZXhwb3J0cztcbiBcdFx0fVxuIFx0XHQvLyBDcmVhdGUgYSBuZXcgbW9kdWxlIChhbmQgcHV0IGl0IGludG8gdGhlIGNhY2hlKVxuIFx0XHR2YXIgbW9kdWxlID0gaW5zdGFsbGVkTW9kdWxlc1ttb2R1bGVJZF0gPSB7XG4gXHRcdFx0aTogbW9kdWxlSWQsXG4gXHRcdFx0bDogZmFsc2UsXG4gXHRcdFx0ZXhwb3J0czoge31cbiBcdFx0fTtcblxuIFx0XHQvLyBFeGVjdXRlIHRoZSBtb2R1bGUgZnVuY3Rpb25cbiBcdFx0bW9kdWxlc1ttb2R1bGVJZF0uY2FsbChtb2R1bGUuZXhwb3J0cywgbW9kdWxlLCBtb2R1bGUuZXhwb3J0cywgX193ZWJwYWNrX3JlcXVpcmVfXyk7XG5cbiBcdFx0Ly8gRmxhZyB0aGUgbW9kdWxlIGFzIGxvYWRlZFxuIFx0XHRtb2R1bGUubCA9IHRydWU7XG5cbiBcdFx0Ly8gUmV0dXJuIHRoZSBleHBvcnRzIG9mIHRoZSBtb2R1bGVcbiBcdFx0cmV0dXJuIG1vZHVsZS5leHBvcnRzO1xuIFx0fVxuXG5cbiBcdC8vIGV4cG9zZSB0aGUgbW9kdWxlcyBvYmplY3QgKF9fd2VicGFja19tb2R1bGVzX18pXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm0gPSBtb2R1bGVzO1xuXG4gXHQvLyBleHBvc2UgdGhlIG1vZHVsZSBjYWNoZVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5jID0gaW5zdGFsbGVkTW9kdWxlcztcblxuIFx0Ly8gZGVmaW5lIGdldHRlciBmdW5jdGlvbiBmb3IgaGFybW9ueSBleHBvcnRzXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLmQgPSBmdW5jdGlvbihleHBvcnRzLCBuYW1lLCBnZXR0ZXIpIHtcbiBcdFx0aWYoIV9fd2VicGFja19yZXF1aXJlX18ubyhleHBvcnRzLCBuYW1lKSkge1xuIFx0XHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCBuYW1lLCB7IGVudW1lcmFibGU6IHRydWUsIGdldDogZ2V0dGVyIH0pO1xuIFx0XHR9XG4gXHR9O1xuXG4gXHQvLyBkZWZpbmUgX19lc01vZHVsZSBvbiBleHBvcnRzXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnIgPSBmdW5jdGlvbihleHBvcnRzKSB7XG4gXHRcdGlmKHR5cGVvZiBTeW1ib2wgIT09ICd1bmRlZmluZWQnICYmIFN5bWJvbC50b1N0cmluZ1RhZykge1xuIFx0XHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCBTeW1ib2wudG9TdHJpbmdUYWcsIHsgdmFsdWU6ICdNb2R1bGUnIH0pO1xuIFx0XHR9XG4gXHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCAnX19lc01vZHVsZScsIHsgdmFsdWU6IHRydWUgfSk7XG4gXHR9O1xuXG4gXHQvLyBjcmVhdGUgYSBmYWtlIG5hbWVzcGFjZSBvYmplY3RcbiBcdC8vIG1vZGUgJiAxOiB2YWx1ZSBpcyBhIG1vZHVsZSBpZCwgcmVxdWlyZSBpdFxuIFx0Ly8gbW9kZSAmIDI6IG1lcmdlIGFsbCBwcm9wZXJ0aWVzIG9mIHZhbHVlIGludG8gdGhlIG5zXG4gXHQvLyBtb2RlICYgNDogcmV0dXJuIHZhbHVlIHdoZW4gYWxyZWFkeSBucyBvYmplY3RcbiBcdC8vIG1vZGUgJiA4fDE6IGJlaGF2ZSBsaWtlIHJlcXVpcmVcbiBcdF9fd2VicGFja19yZXF1aXJlX18udCA9IGZ1bmN0aW9uKHZhbHVlLCBtb2RlKSB7XG4gXHRcdGlmKG1vZGUgJiAxKSB2YWx1ZSA9IF9fd2VicGFja19yZXF1aXJlX18odmFsdWUpO1xuIFx0XHRpZihtb2RlICYgOCkgcmV0dXJuIHZhbHVlO1xuIFx0XHRpZigobW9kZSAmIDQpICYmIHR5cGVvZiB2YWx1ZSA9PT0gJ29iamVjdCcgJiYgdmFsdWUgJiYgdmFsdWUuX19lc01vZHVsZSkgcmV0dXJuIHZhbHVlO1xuIFx0XHR2YXIgbnMgPSBPYmplY3QuY3JlYXRlKG51bGwpO1xuIFx0XHRfX3dlYnBhY2tfcmVxdWlyZV9fLnIobnMpO1xuIFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkobnMsICdkZWZhdWx0JywgeyBlbnVtZXJhYmxlOiB0cnVlLCB2YWx1ZTogdmFsdWUgfSk7XG4gXHRcdGlmKG1vZGUgJiAyICYmIHR5cGVvZiB2YWx1ZSAhPSAnc3RyaW5nJykgZm9yKHZhciBrZXkgaW4gdmFsdWUpIF9fd2VicGFja19yZXF1aXJlX18uZChucywga2V5LCBmdW5jdGlvbihrZXkpIHsgcmV0dXJuIHZhbHVlW2tleV07IH0uYmluZChudWxsLCBrZXkpKTtcbiBcdFx0cmV0dXJuIG5zO1xuIFx0fTtcblxuIFx0Ly8gZ2V0RGVmYXVsdEV4cG9ydCBmdW5jdGlvbiBmb3IgY29tcGF0aWJpbGl0eSB3aXRoIG5vbi1oYXJtb255IG1vZHVsZXNcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubiA9IGZ1bmN0aW9uKG1vZHVsZSkge1xuIFx0XHR2YXIgZ2V0dGVyID0gbW9kdWxlICYmIG1vZHVsZS5fX2VzTW9kdWxlID9cbiBcdFx0XHRmdW5jdGlvbiBnZXREZWZhdWx0KCkgeyByZXR1cm4gbW9kdWxlWydkZWZhdWx0J107IH0gOlxuIFx0XHRcdGZ1bmN0aW9uIGdldE1vZHVsZUV4cG9ydHMoKSB7IHJldHVybiBtb2R1bGU7IH07XG4gXHRcdF9fd2VicGFja19yZXF1aXJlX18uZChnZXR0ZXIsICdhJywgZ2V0dGVyKTtcbiBcdFx0cmV0dXJuIGdldHRlcjtcbiBcdH07XG5cbiBcdC8vIE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbFxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5vID0gZnVuY3Rpb24ob2JqZWN0LCBwcm9wZXJ0eSkgeyByZXR1cm4gT2JqZWN0LnByb3RvdHlwZS5oYXNPd25Qcm9wZXJ0eS5jYWxsKG9iamVjdCwgcHJvcGVydHkpOyB9O1xuXG4gXHQvLyBfX3dlYnBhY2tfcHVibGljX3BhdGhfX1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5wID0gXCIvYnVpbGQvXCI7XG5cbiBcdHZhciBqc29ucEFycmF5ID0gd2luZG93W1wid2VicGFja0pzb25wXCJdID0gd2luZG93W1wid2VicGFja0pzb25wXCJdIHx8IFtdO1xuIFx0dmFyIG9sZEpzb25wRnVuY3Rpb24gPSBqc29ucEFycmF5LnB1c2guYmluZChqc29ucEFycmF5KTtcbiBcdGpzb25wQXJyYXkucHVzaCA9IHdlYnBhY2tKc29ucENhbGxiYWNrO1xuIFx0anNvbnBBcnJheSA9IGpzb25wQXJyYXkuc2xpY2UoKTtcbiBcdGZvcih2YXIgaSA9IDA7IGkgPCBqc29ucEFycmF5Lmxlbmd0aDsgaSsrKSB3ZWJwYWNrSnNvbnBDYWxsYmFjayhqc29ucEFycmF5W2ldKTtcbiBcdHZhciBwYXJlbnRKc29ucEZ1bmN0aW9uID0gb2xkSnNvbnBGdW5jdGlvbjtcblxuXG4gXHQvLyBhZGQgZW50cnkgbW9kdWxlIHRvIGRlZmVycmVkIGxpc3RcbiBcdGRlZmVycmVkTW9kdWxlcy5wdXNoKFtcIi4vYXNzZXRzL2pzL2FwcC5qc1wiLFwidmVuZG9yc35hcHB+Zm9ybUFydGljbGV+Zm9ybVNpZ251cH5ob21lcGFnZX5wYWdpbmF0aW9uXCIsXCJ2ZW5kb3JzfmFwcFwiXSk7XG4gXHQvLyBydW4gZGVmZXJyZWQgbW9kdWxlcyB3aGVuIHJlYWR5XG4gXHRyZXR1cm4gY2hlY2tEZWZlcnJlZE1vZHVsZXMoKTtcbiIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpbiIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL0xvZ28uYzc4ODEyY2IuanBnXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvVGlwaGFpbmVMZS5lNDE4YjNhNy5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9UaXBoYWluZVN1LjdiMmEzZmY2LmpwZ1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL2FjY2Vzc29pcmVzLWJpam91eC4wNThkOGVmMC5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9hbmltYXV4LmExMjM0ZTU5LmpwZ1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL2FydGljbGVzRmxhZy5hMDEyYTVmYy5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9hcnRzLmU3M2VlOGQ4LmpwZ1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL2JyaWNvbGFnZS4zOGVjZjkwYS5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9jb3NtZXRpcXVlcy1iZWF1dGUtZXQtc29pbnMuMDRiZGFlODAuanBnXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvZGVjb3JhdGlvbnMuOTc0NmM3MzguanBnXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvZGVmYXVsdEF2YXRhci41ZTMwYmJhYy5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9mYXZpY29uLjc4NmQ5NGEyLmljb1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL2h5Z2llbmUtY29ycG9yZWxsZS5kZDg1MmZiYy5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9pY29uVXNlci45MTUzNmU1ZS5wbmdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9pY29ucGFyYW0uYzM1MzZlZTEucG5nXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvaW1hZ2VIb21lLmI4NDZhN2QyLmpwZ1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL2phcmRpbi1qYXJkaW5hZ2UuNWU4MjFiMmQuanBnXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvamV1eC5jZmMxOWIxNy5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9saW5nZS1kZS1tYWlzb24uMDIyZjI1MWQuanBnXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvbG9nb0xpbmtlZGluLjJiZTk3ODJhLmpwZ1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL2xvc3RfdHJlZS5iOTNmYjExZi5wbmdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9tYWV2YS5iMmYyMGQzNC5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9tZW5hZ2UtaHlnaWVuZS1tYWlzb24uNDA4NTk4MzkuanBnXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvcmVjeWNsYWdlLjVhMDlmNzExLmpwZ1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL3ZldGVtZW50cy5kYjQ1Njc5Ni5qcGdcIjsiLCIvKlxuICogV2VsY29tZSB0byB5b3VyIGFwcCdzIG1haW4gSmF2YVNjcmlwdCBmaWxlIVxuICpcbiAqIFdlIHJlY29tbWVuZCBpbmNsdWRpbmcgdGhlIGJ1aWx0IHZlcnNpb24gb2YgdGhpcyBKYXZhU2NyaXB0IGZpbGVcbiAqIChhbmQgaXRzIENTUyBmaWxlKSBpbiB5b3VyIGJhc2UgbGF5b3V0IChiYXNlLmh0bWwudHdpZykuXG4gKi9cblxuLy8gYW55IENTUyB5b3UgaW1wb3J0IHdpbGwgb3V0cHV0IGludG8gYSBzaW5nbGUgY3NzIGZpbGUgKGFwcC5jc3MgaW4gdGhpcyBjYXNlKVxuaW1wb3J0ICcuLi9jc3MvYXBwLnNjc3MnO1xuXG5yZXF1aXJlKCcuLi9pbWFnZXMvZmF2aWNvbi5pY28nKTtcbnJlcXVpcmUoJy4uL2ltYWdlcy9pbWFnZUhvbWUuanBnJyk7XG5yZXF1aXJlKCcuLi9pbWFnZXMvYWNjZXNzb2lyZXMtYmlqb3V4LmpwZycpO1xucmVxdWlyZSgnLi4vaW1hZ2VzL2FydHMuanBnJyk7XG5yZXF1aXJlKCcuLi9pbWFnZXMvYW5pbWF1eC5qcGcnKTtcbnJlcXVpcmUoJy4uL2ltYWdlcy9icmljb2xhZ2UuanBnJyk7XG5yZXF1aXJlKCcuLi9pbWFnZXMvY29zbWV0aXF1ZXMtYmVhdXRlLWV0LXNvaW5zLmpwZycpO1xucmVxdWlyZSgnLi4vaW1hZ2VzL2RlY29yYXRpb25zLmpwZycpO1xucmVxdWlyZSgnLi4vaW1hZ2VzL2h5Z2llbmUtY29ycG9yZWxsZS5qcGcnKTtcbnJlcXVpcmUoJy4uL2ltYWdlcy9qYXJkaW4tamFyZGluYWdlLmpwZycpO1xucmVxdWlyZSgnLi4vaW1hZ2VzL2pldXguanBnJyk7XG5yZXF1aXJlKCcuLi9pbWFnZXMvbGluZ2UtZGUtbWFpc29uLmpwZycpO1xucmVxdWlyZSgnLi4vaW1hZ2VzL21lbmFnZS1oeWdpZW5lLW1haXNvbi5qcGcnKTtcbnJlcXVpcmUoJy4uL2ltYWdlcy9yZWN5Y2xhZ2UuanBnJyk7XG5yZXF1aXJlKCcuLi9pbWFnZXMvdmV0ZW1lbnRzLmpwZycpO1xucmVxdWlyZSgnLi4vaW1hZ2VzL1RpcGhhaW5lU3UuanBnJyk7XG5yZXF1aXJlKCcuLi9pbWFnZXMvVGlwaGFpbmVMZS5qcGcnKTtcbnJlcXVpcmUoJy4uL2ltYWdlcy9tYWV2YS5qcGcnKTtcbnJlcXVpcmUoJy4uL2ltYWdlcy9sb2dvTGlua2VkaW4uanBnJyk7XG5yZXF1aXJlKCcuLi9pbWFnZXMvaWNvbnBhcmFtLnBuZycpO1xucmVxdWlyZSgnLi4vaW1hZ2VzL2FydGljbGVzRmxhZy5qcGcnKTtcbnJlcXVpcmUoJy4uL2ltYWdlcy9pY29uVXNlci5wbmcnKTtcbnJlcXVpcmUoJy4uL2ltYWdlcy9Mb2dvLmpwZycpO1xucmVxdWlyZSgnLi4vaW1hZ2VzL2xvc3RfdHJlZS5wbmcnKTtcbnJlcXVpcmUoJy4uL2ltYWdlcy9kZWZhdWx0QXZhdGFyLmpwZycpO1xuXG5cbi8vIE5lZWQgalF1ZXJ5PyBJbnN0YWxsIGl0IHdpdGggXCJ5YXJuIGFkZCBqcXVlcnlcIiwgdGhlbiB1bmNvbW1lbnQgdG8gaW1wb3J0IGl0LlxuLy9pbXBvcnQgJCBmcm9tICdqcXVlcnknO1xuXG52YXIgJCA9IHJlcXVpcmUoJ2pxdWVyeScpO1xucmVxdWlyZSgnYm9vdHN0cmFwJyk7IFxuXG5cblxuXG52YXIgYXBwID0ge1xuICAgIGluaXQ6ZnVuY3Rpb24oKSBcbiAgICB7XG5cbiAgICAgICAgJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKVxuICAgICAgICB7XG4gICAgICAgICAgICAkKFwiI3NpZGVPcGVuYnRuXCIpLm9uKFwiY2xpY2tcIiwgZnVuY3Rpb24oKXtcbiAgICAgICAgICAgICAgICBhcHAub3BlblNpZGVOYXYoKTsgXG4gICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgJChcIi5jbG9zZWJ0blwiKS5vbihcImNsaWNrXCIsIGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAgICAgYXBwLmNsb3NlU2lkZU5hdigpOyBcbiAgICAgICAgICAgIH0pO1xuXG4gICAgICAgIH0pXG4gICAgfSxcblxuICAgIG9wZW5TaWRlTmF2OmZ1bmN0aW9uKCkgXG4gICAge1xuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibXlTaWRlYmFyXCIpLnN0eWxlLndpZHRoID0gXCIyNTBweFwiO1xuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibXlTaWRlYmFyXCIpLnN0eWxlLmRpc3BsYXkgPSBcImFic29sdXRlXCI7XG4gICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJvdmVybGF5XCIpLnN0eWxlLmRpc3BsYXkgPSBcImJsb2NrXCI7XG4gICAgfSxcbiAgICAgICAgICAgIFxuICAgIC8qIFNldCB0aGUgd2lkdGggb2YgdGhlIHNpZGViYXIgdG8gMCBhbmQgdGhlIGxlZnQgbWFyZ2luIG9mIHRoZSBwYWdlIGNvbnRlbnQgdG8gMCAqL1xuICAgIGNsb3NlU2lkZU5hdjpmdW5jdGlvbigpIFxuICAgIHtcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm15U2lkZWJhclwiKS5zdHlsZS53aWR0aCA9IFwiMFwiO1xuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwib3ZlcmxheVwiKS5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XG4gICAgfSxcblxuICAgICAgICBcbn1cblxuJChhcHAuaW5pdCk7XG4iXSwic291cmNlUm9vdCI6IiJ9