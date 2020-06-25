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
/******/ 	deferredModules.push(["./assets/js/app.js","vendors~app~article_details~formArticle~formSignup~homepage~pagination~profil","vendors~app"]);
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

module.exports = "/build/images/defaultAvatar.b34077f4.jpg";

/***/ }),

/***/ "./assets/images/favicon.ico":
/*!***********************************!*\
  !*** ./assets/images/favicon.ico ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/favicon.01c61c7b.ico";

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
    var mql = window.matchMedia("(max-width: 960px)");
    $(document).ready(function () {
      $("#sideOpenbtn").on("click", function () {
        app.openSideNav();
      });
      $(".closebtn").on("click", function () {
        app.closeSideNav();
      });
    }); // call listener function explicitly at run time

    mediaqueryresponse(mql); // attach listener function to listen in on state changes

    mql.addListener(mediaqueryresponse);

    function mediaqueryresponse(mql) {
      /* if media query doesn't match */
      if (!mql.matches) {
        app.closeSideNav();
      }
    }
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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2Nzcy9hcHAuc2NzcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL0xvZ28uanBnIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvVGlwaGFpbmVMZS5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9UaXBoYWluZVN1LmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL2FjY2Vzc29pcmVzLWJpam91eC5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9hbmltYXV4LmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL2FydGljbGVzRmxhZy5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9hcnRzLmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL2JyaWNvbGFnZS5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9jb3NtZXRpcXVlcy1iZWF1dGUtZXQtc29pbnMuanBnIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvZGVjb3JhdGlvbnMuanBnIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvZGVmYXVsdEF2YXRhci5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9mYXZpY29uLmljbyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL2h5Z2llbmUtY29ycG9yZWxsZS5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9pY29uVXNlci5wbmciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9pY29ucGFyYW0ucG5nIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvaW1hZ2VIb21lLmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL2phcmRpbi1qYXJkaW5hZ2UuanBnIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvamV1eC5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9saW5nZS1kZS1tYWlzb24uanBnIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvbG9nb0xpbmtlZGluLmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL2xvc3RfdHJlZS5wbmciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9tYWV2YS5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ltYWdlcy9tZW5hZ2UtaHlnaWVuZS1tYWlzb24uanBnIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvcmVjeWNsYWdlLmpwZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL3ZldGVtZW50cy5qcGciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2FwcC5qcyJdLCJuYW1lcyI6WyJyZXF1aXJlIiwiJCIsImFwcCIsImluaXQiLCJtcWwiLCJ3aW5kb3ciLCJtYXRjaE1lZGlhIiwiZG9jdW1lbnQiLCJyZWFkeSIsIm9uIiwib3BlblNpZGVOYXYiLCJjbG9zZVNpZGVOYXYiLCJtZWRpYXF1ZXJ5cmVzcG9uc2UiLCJhZGRMaXN0ZW5lciIsIm1hdGNoZXMiLCJnZXRFbGVtZW50QnlJZCIsInN0eWxlIiwid2lkdGgiLCJkaXNwbGF5Il0sIm1hcHBpbmdzIjoiO1FBQUE7UUFDQTtRQUNBO1FBQ0E7UUFDQTs7UUFFQTtRQUNBO1FBQ0E7UUFDQSxRQUFRLG9CQUFvQjtRQUM1QjtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7O1FBRUE7UUFDQTtRQUNBOztRQUVBO1FBQ0E7O1FBRUE7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBLGlCQUFpQiw0QkFBNEI7UUFDN0M7UUFDQTtRQUNBLGtCQUFrQiwyQkFBMkI7UUFDN0M7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7O1FBRUE7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBOztRQUVBOztRQUVBO1FBQ0E7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Q0FBd0IsV0FBeEIsRUFBcUNDLEtBQXJDLENBQTJDQyxLQUEzQyxHQUFtRCxHQUFuRDtBQUNBVixZQUFRLENBQUNRLGNBQVQsQ0FBd0IsU0FBeEIsRUFBbUNDLEtBQW5DLENBQXlDRSxPQUF6QyxHQUFtRCxNQUFuRDtBQUNDO0FBL0NLLENBQVY7QUFtREFqQixDQUFDLENBQUNDLEdBQUcsQ0FBQ0MsSUFBTCxDQUFELEMiLCJmaWxlIjoiYXBwLmpzIiwic291cmNlc0NvbnRlbnQiOlsiIFx0Ly8gaW5zdGFsbCBhIEpTT05QIGNhbGxiYWNrIGZvciBjaHVuayBsb2FkaW5nXG4gXHRmdW5jdGlvbiB3ZWJwYWNrSnNvbnBDYWxsYmFjayhkYXRhKSB7XG4gXHRcdHZhciBjaHVua0lkcyA9IGRhdGFbMF07XG4gXHRcdHZhciBtb3JlTW9kdWxlcyA9IGRhdGFbMV07XG4gXHRcdHZhciBleGVjdXRlTW9kdWxlcyA9IGRhdGFbMl07XG5cbiBcdFx0Ly8gYWRkIFwibW9yZU1vZHVsZXNcIiB0byB0aGUgbW9kdWxlcyBvYmplY3QsXG4gXHRcdC8vIHRoZW4gZmxhZyBhbGwgXCJjaHVua0lkc1wiIGFzIGxvYWRlZCBhbmQgZmlyZSBjYWxsYmFja1xuIFx0XHR2YXIgbW9kdWxlSWQsIGNodW5rSWQsIGkgPSAwLCByZXNvbHZlcyA9IFtdO1xuIFx0XHRmb3IoO2kgPCBjaHVua0lkcy5sZW5ndGg7IGkrKykge1xuIFx0XHRcdGNodW5rSWQgPSBjaHVua0lkc1tpXTtcbiBcdFx0XHRpZihPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwoaW5zdGFsbGVkQ2h1bmtzLCBjaHVua0lkKSAmJiBpbnN0YWxsZWRDaHVua3NbY2h1bmtJZF0pIHtcbiBcdFx0XHRcdHJlc29sdmVzLnB1c2goaW5zdGFsbGVkQ2h1bmtzW2NodW5rSWRdWzBdKTtcbiBcdFx0XHR9XG4gXHRcdFx0aW5zdGFsbGVkQ2h1bmtzW2NodW5rSWRdID0gMDtcbiBcdFx0fVxuIFx0XHRmb3IobW9kdWxlSWQgaW4gbW9yZU1vZHVsZXMpIHtcbiBcdFx0XHRpZihPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwobW9yZU1vZHVsZXMsIG1vZHVsZUlkKSkge1xuIFx0XHRcdFx0bW9kdWxlc1ttb2R1bGVJZF0gPSBtb3JlTW9kdWxlc1ttb2R1bGVJZF07XG4gXHRcdFx0fVxuIFx0XHR9XG4gXHRcdGlmKHBhcmVudEpzb25wRnVuY3Rpb24pIHBhcmVudEpzb25wRnVuY3Rpb24oZGF0YSk7XG5cbiBcdFx0d2hpbGUocmVzb2x2ZXMubGVuZ3RoKSB7XG4gXHRcdFx0cmVzb2x2ZXMuc2hpZnQoKSgpO1xuIFx0XHR9XG5cbiBcdFx0Ly8gYWRkIGVudHJ5IG1vZHVsZXMgZnJvbSBsb2FkZWQgY2h1bmsgdG8gZGVmZXJyZWQgbGlzdFxuIFx0XHRkZWZlcnJlZE1vZHVsZXMucHVzaC5hcHBseShkZWZlcnJlZE1vZHVsZXMsIGV4ZWN1dGVNb2R1bGVzIHx8IFtdKTtcblxuIFx0XHQvLyBydW4gZGVmZXJyZWQgbW9kdWxlcyB3aGVuIGFsbCBjaHVua3MgcmVhZHlcbiBcdFx0cmV0dXJuIGNoZWNrRGVmZXJyZWRNb2R1bGVzKCk7XG4gXHR9O1xuIFx0ZnVuY3Rpb24gY2hlY2tEZWZlcnJlZE1vZHVsZXMoKSB7XG4gXHRcdHZhciByZXN1bHQ7XG4gXHRcdGZvcih2YXIgaSA9IDA7IGkgPCBkZWZlcnJlZE1vZHVsZXMubGVuZ3RoOyBpKyspIHtcbiBcdFx0XHR2YXIgZGVmZXJyZWRNb2R1bGUgPSBkZWZlcnJlZE1vZHVsZXNbaV07XG4gXHRcdFx0dmFyIGZ1bGZpbGxlZCA9IHRydWU7XG4gXHRcdFx0Zm9yKHZhciBqID0gMTsgaiA8IGRlZmVycmVkTW9kdWxlLmxlbmd0aDsgaisrKSB7XG4gXHRcdFx0XHR2YXIgZGVwSWQgPSBkZWZlcnJlZE1vZHVsZVtqXTtcbiBcdFx0XHRcdGlmKGluc3RhbGxlZENodW5rc1tkZXBJZF0gIT09IDApIGZ1bGZpbGxlZCA9IGZhbHNlO1xuIFx0XHRcdH1cbiBcdFx0XHRpZihmdWxmaWxsZWQpIHtcbiBcdFx0XHRcdGRlZmVycmVkTW9kdWxlcy5zcGxpY2UoaS0tLCAxKTtcbiBcdFx0XHRcdHJlc3VsdCA9IF9fd2VicGFja19yZXF1aXJlX18oX193ZWJwYWNrX3JlcXVpcmVfXy5zID0gZGVmZXJyZWRNb2R1bGVbMF0pO1xuIFx0XHRcdH1cbiBcdFx0fVxuXG4gXHRcdHJldHVybiByZXN1bHQ7XG4gXHR9XG5cbiBcdC8vIFRoZSBtb2R1bGUgY2FjaGVcbiBcdHZhciBpbnN0YWxsZWRNb2R1bGVzID0ge307XG5cbiBcdC8vIG9iamVjdCB0byBzdG9yZSBsb2FkZWQgYW5kIGxvYWRpbmcgY2h1bmtzXG4gXHQvLyB1bmRlZmluZWQgPSBjaHVuayBub3QgbG9hZGVkLCBudWxsID0gY2h1bmsgcHJlbG9hZGVkL3ByZWZldGNoZWRcbiBcdC8vIFByb21pc2UgPSBjaHVuayBsb2FkaW5nLCAwID0gY2h1bmsgbG9hZGVkXG4gXHR2YXIgaW5zdGFsbGVkQ2h1bmtzID0ge1xuIFx0XHRcImFwcFwiOiAwXG4gXHR9O1xuXG4gXHR2YXIgZGVmZXJyZWRNb2R1bGVzID0gW107XG5cbiBcdC8vIFRoZSByZXF1aXJlIGZ1bmN0aW9uXG4gXHRmdW5jdGlvbiBfX3dlYnBhY2tfcmVxdWlyZV9fKG1vZHVsZUlkKSB7XG5cbiBcdFx0Ly8gQ2hlY2sgaWYgbW9kdWxlIGlzIGluIGNhY2hlXG4gXHRcdGlmKGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdKSB7XG4gXHRcdFx0cmV0dXJuIGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdLmV4cG9ydHM7XG4gXHRcdH1cbiBcdFx0Ly8gQ3JlYXRlIGEgbmV3IG1vZHVsZSAoYW5kIHB1dCBpdCBpbnRvIHRoZSBjYWNoZSlcbiBcdFx0dmFyIG1vZHVsZSA9IGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdID0ge1xuIFx0XHRcdGk6IG1vZHVsZUlkLFxuIFx0XHRcdGw6IGZhbHNlLFxuIFx0XHRcdGV4cG9ydHM6IHt9XG4gXHRcdH07XG5cbiBcdFx0Ly8gRXhlY3V0ZSB0aGUgbW9kdWxlIGZ1bmN0aW9uXG4gXHRcdG1vZHVsZXNbbW9kdWxlSWRdLmNhbGwobW9kdWxlLmV4cG9ydHMsIG1vZHVsZSwgbW9kdWxlLmV4cG9ydHMsIF9fd2VicGFja19yZXF1aXJlX18pO1xuXG4gXHRcdC8vIEZsYWcgdGhlIG1vZHVsZSBhcyBsb2FkZWRcbiBcdFx0bW9kdWxlLmwgPSB0cnVlO1xuXG4gXHRcdC8vIFJldHVybiB0aGUgZXhwb3J0cyBvZiB0aGUgbW9kdWxlXG4gXHRcdHJldHVybiBtb2R1bGUuZXhwb3J0cztcbiBcdH1cblxuXG4gXHQvLyBleHBvc2UgdGhlIG1vZHVsZXMgb2JqZWN0IChfX3dlYnBhY2tfbW9kdWxlc19fKVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5tID0gbW9kdWxlcztcblxuIFx0Ly8gZXhwb3NlIHRoZSBtb2R1bGUgY2FjaGVcbiBcdF9fd2VicGFja19yZXF1aXJlX18uYyA9IGluc3RhbGxlZE1vZHVsZXM7XG5cbiBcdC8vIGRlZmluZSBnZXR0ZXIgZnVuY3Rpb24gZm9yIGhhcm1vbnkgZXhwb3J0c1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5kID0gZnVuY3Rpb24oZXhwb3J0cywgbmFtZSwgZ2V0dGVyKSB7XG4gXHRcdGlmKCFfX3dlYnBhY2tfcmVxdWlyZV9fLm8oZXhwb3J0cywgbmFtZSkpIHtcbiBcdFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgbmFtZSwgeyBlbnVtZXJhYmxlOiB0cnVlLCBnZXQ6IGdldHRlciB9KTtcbiBcdFx0fVxuIFx0fTtcblxuIFx0Ly8gZGVmaW5lIF9fZXNNb2R1bGUgb24gZXhwb3J0c1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5yID0gZnVuY3Rpb24oZXhwb3J0cykge1xuIFx0XHRpZih0eXBlb2YgU3ltYm9sICE9PSAndW5kZWZpbmVkJyAmJiBTeW1ib2wudG9TdHJpbmdUYWcpIHtcbiBcdFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgU3ltYm9sLnRvU3RyaW5nVGFnLCB7IHZhbHVlOiAnTW9kdWxlJyB9KTtcbiBcdFx0fVxuIFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgJ19fZXNNb2R1bGUnLCB7IHZhbHVlOiB0cnVlIH0pO1xuIFx0fTtcblxuIFx0Ly8gY3JlYXRlIGEgZmFrZSBuYW1lc3BhY2Ugb2JqZWN0XG4gXHQvLyBtb2RlICYgMTogdmFsdWUgaXMgYSBtb2R1bGUgaWQsIHJlcXVpcmUgaXRcbiBcdC8vIG1vZGUgJiAyOiBtZXJnZSBhbGwgcHJvcGVydGllcyBvZiB2YWx1ZSBpbnRvIHRoZSBuc1xuIFx0Ly8gbW9kZSAmIDQ6IHJldHVybiB2YWx1ZSB3aGVuIGFscmVhZHkgbnMgb2JqZWN0XG4gXHQvLyBtb2RlICYgOHwxOiBiZWhhdmUgbGlrZSByZXF1aXJlXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnQgPSBmdW5jdGlvbih2YWx1ZSwgbW9kZSkge1xuIFx0XHRpZihtb2RlICYgMSkgdmFsdWUgPSBfX3dlYnBhY2tfcmVxdWlyZV9fKHZhbHVlKTtcbiBcdFx0aWYobW9kZSAmIDgpIHJldHVybiB2YWx1ZTtcbiBcdFx0aWYoKG1vZGUgJiA0KSAmJiB0eXBlb2YgdmFsdWUgPT09ICdvYmplY3QnICYmIHZhbHVlICYmIHZhbHVlLl9fZXNNb2R1bGUpIHJldHVybiB2YWx1ZTtcbiBcdFx0dmFyIG5zID0gT2JqZWN0LmNyZWF0ZShudWxsKTtcbiBcdFx0X193ZWJwYWNrX3JlcXVpcmVfXy5yKG5zKTtcbiBcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KG5zLCAnZGVmYXVsdCcsIHsgZW51bWVyYWJsZTogdHJ1ZSwgdmFsdWU6IHZhbHVlIH0pO1xuIFx0XHRpZihtb2RlICYgMiAmJiB0eXBlb2YgdmFsdWUgIT0gJ3N0cmluZycpIGZvcih2YXIga2V5IGluIHZhbHVlKSBfX3dlYnBhY2tfcmVxdWlyZV9fLmQobnMsIGtleSwgZnVuY3Rpb24oa2V5KSB7IHJldHVybiB2YWx1ZVtrZXldOyB9LmJpbmQobnVsbCwga2V5KSk7XG4gXHRcdHJldHVybiBucztcbiBcdH07XG5cbiBcdC8vIGdldERlZmF1bHRFeHBvcnQgZnVuY3Rpb24gZm9yIGNvbXBhdGliaWxpdHkgd2l0aCBub24taGFybW9ueSBtb2R1bGVzXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm4gPSBmdW5jdGlvbihtb2R1bGUpIHtcbiBcdFx0dmFyIGdldHRlciA9IG1vZHVsZSAmJiBtb2R1bGUuX19lc01vZHVsZSA/XG4gXHRcdFx0ZnVuY3Rpb24gZ2V0RGVmYXVsdCgpIHsgcmV0dXJuIG1vZHVsZVsnZGVmYXVsdCddOyB9IDpcbiBcdFx0XHRmdW5jdGlvbiBnZXRNb2R1bGVFeHBvcnRzKCkgeyByZXR1cm4gbW9kdWxlOyB9O1xuIFx0XHRfX3dlYnBhY2tfcmVxdWlyZV9fLmQoZ2V0dGVyLCAnYScsIGdldHRlcik7XG4gXHRcdHJldHVybiBnZXR0ZXI7XG4gXHR9O1xuXG4gXHQvLyBPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGxcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubyA9IGZ1bmN0aW9uKG9iamVjdCwgcHJvcGVydHkpIHsgcmV0dXJuIE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbChvYmplY3QsIHByb3BlcnR5KTsgfTtcblxuIFx0Ly8gX193ZWJwYWNrX3B1YmxpY19wYXRoX19cbiBcdF9fd2VicGFja19yZXF1aXJlX18ucCA9IFwiL2J1aWxkL1wiO1xuXG4gXHR2YXIganNvbnBBcnJheSA9IHdpbmRvd1tcIndlYnBhY2tKc29ucFwiXSA9IHdpbmRvd1tcIndlYnBhY2tKc29ucFwiXSB8fCBbXTtcbiBcdHZhciBvbGRKc29ucEZ1bmN0aW9uID0ganNvbnBBcnJheS5wdXNoLmJpbmQoanNvbnBBcnJheSk7XG4gXHRqc29ucEFycmF5LnB1c2ggPSB3ZWJwYWNrSnNvbnBDYWxsYmFjaztcbiBcdGpzb25wQXJyYXkgPSBqc29ucEFycmF5LnNsaWNlKCk7XG4gXHRmb3IodmFyIGkgPSAwOyBpIDwganNvbnBBcnJheS5sZW5ndGg7IGkrKykgd2VicGFja0pzb25wQ2FsbGJhY2soanNvbnBBcnJheVtpXSk7XG4gXHR2YXIgcGFyZW50SnNvbnBGdW5jdGlvbiA9IG9sZEpzb25wRnVuY3Rpb247XG5cblxuIFx0Ly8gYWRkIGVudHJ5IG1vZHVsZSB0byBkZWZlcnJlZCBsaXN0XG4gXHRkZWZlcnJlZE1vZHVsZXMucHVzaChbXCIuL2Fzc2V0cy9qcy9hcHAuanNcIixcInZlbmRvcnN+YXBwfmFydGljbGVfZGV0YWlsc35mb3JtQXJ0aWNsZX5mb3JtU2lnbnVwfmhvbWVwYWdlfnBhZ2luYXRpb25+cHJvZmlsXCIsXCJ2ZW5kb3JzfmFwcFwiXSk7XG4gXHQvLyBydW4gZGVmZXJyZWQgbW9kdWxlcyB3aGVuIHJlYWR5XG4gXHRyZXR1cm4gY2hlY2tEZWZlcnJlZE1vZHVsZXMoKTtcbiIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpbiIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL0xvZ28uYzc4ODEyY2IuanBnXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvVGlwaGFpbmVMZS5lNDE4YjNhNy5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9UaXBoYWluZVN1LjdiMmEzZmY2LmpwZ1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL2FjY2Vzc29pcmVzLWJpam91eC4wNThkOGVmMC5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9hbmltYXV4LmExMjM0ZTU5LmpwZ1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL2FydGljbGVzRmxhZy5hMDEyYTVmYy5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9hcnRzLmU3M2VlOGQ4LmpwZ1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL2JyaWNvbGFnZS4zOGVjZjkwYS5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9jb3NtZXRpcXVlcy1iZWF1dGUtZXQtc29pbnMuMDRiZGFlODAuanBnXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvZGVjb3JhdGlvbnMuOTc0NmM3MzguanBnXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvZGVmYXVsdEF2YXRhci5iMzQwNzdmNC5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9mYXZpY29uLjAxYzYxYzdiLmljb1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL2h5Z2llbmUtY29ycG9yZWxsZS5kZDg1MmZiYy5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9pY29uVXNlci45MTUzNmU1ZS5wbmdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9pY29ucGFyYW0uYzM1MzZlZTEucG5nXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvaW1hZ2VIb21lLmI4NDZhN2QyLmpwZ1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL2phcmRpbi1qYXJkaW5hZ2UuNWU4MjFiMmQuanBnXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvamV1eC5jZmMxOWIxNy5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9saW5nZS1kZS1tYWlzb24uMDIyZjI1MWQuanBnXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvbG9nb0xpbmtlZGluLjJiZTk3ODJhLmpwZ1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL2xvc3RfdHJlZS5iOTNmYjExZi5wbmdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9tYWV2YS5iMmYyMGQzNC5qcGdcIjsiLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9tZW5hZ2UtaHlnaWVuZS1tYWlzb24uNDA4NTk4MzkuanBnXCI7IiwibW9kdWxlLmV4cG9ydHMgPSBcIi9idWlsZC9pbWFnZXMvcmVjeWNsYWdlLjVhMDlmNzExLmpwZ1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL3ZldGVtZW50cy5kYjQ1Njc5Ni5qcGdcIjsiLCIvKlxyXG4gKiBXZWxjb21lIHRvIHlvdXIgYXBwJ3MgbWFpbiBKYXZhU2NyaXB0IGZpbGUhXHJcbiAqXHJcbiAqIFdlIHJlY29tbWVuZCBpbmNsdWRpbmcgdGhlIGJ1aWx0IHZlcnNpb24gb2YgdGhpcyBKYXZhU2NyaXB0IGZpbGVcclxuICogKGFuZCBpdHMgQ1NTIGZpbGUpIGluIHlvdXIgYmFzZSBsYXlvdXQgKGJhc2UuaHRtbC50d2lnKS5cclxuICovXHJcblxyXG4vLyBhbnkgQ1NTIHlvdSBpbXBvcnQgd2lsbCBvdXRwdXQgaW50byBhIHNpbmdsZSBjc3MgZmlsZSAoYXBwLmNzcyBpbiB0aGlzIGNhc2UpXHJcbmltcG9ydCAnLi4vY3NzL2FwcC5zY3NzJztcclxuXHJcbnJlcXVpcmUoJy4uL2ltYWdlcy9mYXZpY29uLmljbycpO1xyXG5yZXF1aXJlKCcuLi9pbWFnZXMvaW1hZ2VIb21lLmpwZycpO1xyXG5yZXF1aXJlKCcuLi9pbWFnZXMvYWNjZXNzb2lyZXMtYmlqb3V4LmpwZycpO1xyXG5yZXF1aXJlKCcuLi9pbWFnZXMvYXJ0cy5qcGcnKTtcclxucmVxdWlyZSgnLi4vaW1hZ2VzL2FuaW1hdXguanBnJyk7XHJcbnJlcXVpcmUoJy4uL2ltYWdlcy9icmljb2xhZ2UuanBnJyk7XHJcbnJlcXVpcmUoJy4uL2ltYWdlcy9jb3NtZXRpcXVlcy1iZWF1dGUtZXQtc29pbnMuanBnJyk7XHJcbnJlcXVpcmUoJy4uL2ltYWdlcy9kZWNvcmF0aW9ucy5qcGcnKTtcclxucmVxdWlyZSgnLi4vaW1hZ2VzL2h5Z2llbmUtY29ycG9yZWxsZS5qcGcnKTtcclxucmVxdWlyZSgnLi4vaW1hZ2VzL2phcmRpbi1qYXJkaW5hZ2UuanBnJyk7XHJcbnJlcXVpcmUoJy4uL2ltYWdlcy9qZXV4LmpwZycpO1xyXG5yZXF1aXJlKCcuLi9pbWFnZXMvbGluZ2UtZGUtbWFpc29uLmpwZycpO1xyXG5yZXF1aXJlKCcuLi9pbWFnZXMvbWVuYWdlLWh5Z2llbmUtbWFpc29uLmpwZycpO1xyXG5yZXF1aXJlKCcuLi9pbWFnZXMvcmVjeWNsYWdlLmpwZycpO1xyXG5yZXF1aXJlKCcuLi9pbWFnZXMvdmV0ZW1lbnRzLmpwZycpO1xyXG5yZXF1aXJlKCcuLi9pbWFnZXMvVGlwaGFpbmVTdS5qcGcnKTtcclxucmVxdWlyZSgnLi4vaW1hZ2VzL1RpcGhhaW5lTGUuanBnJyk7XHJcbnJlcXVpcmUoJy4uL2ltYWdlcy9tYWV2YS5qcGcnKTtcclxucmVxdWlyZSgnLi4vaW1hZ2VzL2xvZ29MaW5rZWRpbi5qcGcnKTtcclxucmVxdWlyZSgnLi4vaW1hZ2VzL2ljb25wYXJhbS5wbmcnKTtcclxucmVxdWlyZSgnLi4vaW1hZ2VzL2FydGljbGVzRmxhZy5qcGcnKTtcclxucmVxdWlyZSgnLi4vaW1hZ2VzL2ljb25Vc2VyLnBuZycpO1xyXG5yZXF1aXJlKCcuLi9pbWFnZXMvTG9nby5qcGcnKTtcclxucmVxdWlyZSgnLi4vaW1hZ2VzL2xvc3RfdHJlZS5wbmcnKTtcclxucmVxdWlyZSgnLi4vaW1hZ2VzL2RlZmF1bHRBdmF0YXIuanBnJyk7XHJcblxyXG5cclxuLy8gTmVlZCBqUXVlcnk/IEluc3RhbGwgaXQgd2l0aCBcInlhcm4gYWRkIGpxdWVyeVwiLCB0aGVuIHVuY29tbWVudCB0byBpbXBvcnQgaXQuXHJcbi8vaW1wb3J0ICQgZnJvbSAnanF1ZXJ5JztcclxuXHJcbnZhciAkID0gcmVxdWlyZSgnanF1ZXJ5Jyk7XHJcbnJlcXVpcmUoJ2Jvb3RzdHJhcCcpOyBcclxuXHJcblxyXG5cclxuXHJcbnZhciBhcHAgPSB7XHJcbiAgICBpbml0OmZ1bmN0aW9uKCkgXHJcbiAgICB7XHJcbiAgICAgICAgdmFyIG1xbCA9IHdpbmRvdy5tYXRjaE1lZGlhKFwiKG1heC13aWR0aDogOTYwcHgpXCIpO1xyXG5cclxuICAgICAgICAkKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpXHJcbiAgICAgICAge1xyXG4gICAgICAgICAgICAkKFwiI3NpZGVPcGVuYnRuXCIpLm9uKFwiY2xpY2tcIiwgZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgICAgIGFwcC5vcGVuU2lkZU5hdigpOyBcclxuICAgICAgICAgICAgfSk7XHJcblxyXG4gICAgICAgICAgICAkKFwiLmNsb3NlYnRuXCIpLm9uKFwiY2xpY2tcIiwgZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgICAgIGFwcC5jbG9zZVNpZGVOYXYoKTsgXHJcbiAgICAgICAgICAgIH0pO1xyXG5cclxuICAgICAgICB9KVxyXG5cclxuICAgICAgICAgICAgLy8gY2FsbCBsaXN0ZW5lciBmdW5jdGlvbiBleHBsaWNpdGx5IGF0IHJ1biB0aW1lXHJcbiAgICAgICAgICAgIG1lZGlhcXVlcnlyZXNwb25zZShtcWwpO1xyXG5cclxuICAgICAgICAgICAgLy8gYXR0YWNoIGxpc3RlbmVyIGZ1bmN0aW9uIHRvIGxpc3RlbiBpbiBvbiBzdGF0ZSBjaGFuZ2VzXHJcbiAgICAgICAgICAgIG1xbC5hZGRMaXN0ZW5lcihtZWRpYXF1ZXJ5cmVzcG9uc2UpO1xyXG4gICAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgIGZ1bmN0aW9uIG1lZGlhcXVlcnlyZXNwb25zZShtcWwpXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAgIC8qIGlmIG1lZGlhIHF1ZXJ5IGRvZXNuJ3QgbWF0Y2ggKi9cclxuICAgICAgICAgICAgICAgIGlmICghbXFsLm1hdGNoZXMpXHJcbiAgICAgICAgICAgICAgICB7IFxyXG4gICAgICAgICAgICAgICAgICAgIGFwcC5jbG9zZVNpZGVOYXYoKTtcclxuICAgICAgICAgICAgICAgIH0gXHJcbiAgICAgICAgICAgIH1cclxuICAgICAgXHJcbiAgICB9LFxyXG5cclxuICAgIG9wZW5TaWRlTmF2OmZ1bmN0aW9uKCkgXHJcbiAgICB7XHJcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm15U2lkZWJhclwiKS5zdHlsZS53aWR0aCA9IFwiMjUwcHhcIjtcclxuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibXlTaWRlYmFyXCIpLnN0eWxlLmRpc3BsYXkgPSBcImFic29sdXRlXCI7XHJcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm92ZXJsYXlcIikuc3R5bGUuZGlzcGxheSA9IFwiYmxvY2tcIjtcclxuICAgIH0sXHJcbiAgICAgICAgICAgIFxyXG4gICAgLyogU2V0IHRoZSB3aWR0aCBvZiB0aGUgc2lkZWJhciB0byAwIGFuZCB0aGUgbGVmdCBtYXJnaW4gb2YgdGhlIHBhZ2UgY29udGVudCB0byAwICovXHJcbiAgICBjbG9zZVNpZGVOYXY6ZnVuY3Rpb24oKSBcclxuICAgIHtcclxuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibXlTaWRlYmFyXCIpLnN0eWxlLndpZHRoID0gXCIwXCI7XHJcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm92ZXJsYXlcIikuc3R5bGUuZGlzcGxheSA9IFwibm9uZVwiO1xyXG4gICAgfSxcclxuICAgICAgICBcclxufVxyXG5cclxuJChhcHAuaW5pdCk7XHJcbiJdLCJzb3VyY2VSb290IjoiIn0=