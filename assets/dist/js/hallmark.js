/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
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
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./assets/src/js/frontend/frontend.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/src/js/frontend/frontend.js":
/*!********************************************!*\
  !*** ./assets/src/js/frontend/frontend.js ***!
  \********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _sass_style_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../sass/style.scss */ \"./assets/src/sass/style.scss\");\n/* harmony import */ var _sass_style_scss__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_sass_style_scss__WEBPACK_IMPORTED_MODULE_0__);\n\n/*\r\n * Replace all SVG images with inline SVG so we can manipulate via CSS\r\n */\n\njQuery(function () {\n  jQuery(\"img.svg\").each(function () {\n    var $img = jQuery(this);\n    var imgID = $img.attr(\"id\");\n    var imgClass = $img.attr(\"class\");\n    var imgURL = $img.attr(\"src\");\n    jQuery.get(imgURL, function (data) {\n      // Get the SVG tag, ignore the rest\n      var $svg = jQuery(data).find(\"svg\"); // Add replaced image's ID to the new SVG\n\n      if (typeof imgID !== \"undefined\") {\n        $svg = $svg.attr(\"id\", imgID);\n      } // Add replaced image's classes to the new SVG\n\n\n      if (typeof imgClass !== \"undefined\") {\n        $svg = $svg.attr(\"class\", imgClass + \" replaced-svg\");\n      } // Remove any invalid XML tags as per http://validator.w3.org\n\n\n      $svg = $svg.removeAttr(\"xmlns:a\"); // Check if the viewport is set, else we gonna set it if we can.\n\n      if (!$svg.attr(\"viewBox\") && $svg.attr(\"height\") && $svg.attr(\"width\")) {\n        $svg.attr(\"viewBox\", \"0 0 \" + $svg.attr(\"height\") + \" \" + $svg.attr(\"width\"));\n      } // Replace image with new SVG\n\n\n      $img.replaceWith($svg);\n    }, \"xml\");\n  });\n  /*\r\n  * Style header on scroll\r\n  */\n\n  var $window = jQuery(window);\n  var nav = jQuery(\".header\");\n  $window.scroll(function () {\n    if ($window.scrollTop() >= 300) {\n      nav.addClass(\"scroll\");\n    } else {\n      nav.removeClass(\"scroll\");\n    }\n  });\n  /*\r\n  ** Hamburgers navigation\r\n  **/\n\n  var $hamburger = jQuery(\".hamburger\");\n  var $offCanvasMenu = jQuery(\"#off-canvas\");\n  var $offCanvasOverlay = jQuery(\".js-off-canvas-overlay\");\n  $hamburger.on(\"click\", function (e) {\n    $hamburger.toggleClass(\"is-active\");\n    $offCanvasMenu.toggleClass(\"is-open\");\n    $offCanvasOverlay.toggleClass(\"active\");\n  });\n  $offCanvasOverlay.on(\"click\", function (e) {\n    $hamburger.toggleClass(\"is-active\");\n    $offCanvasMenu.toggleClass(\"is-open\");\n    $offCanvasOverlay.toggleClass(\"active\");\n  });\n  /*\r\n  ** Timeline\r\n  **/\n\n  function isOnScreen(elem) {\n    // if the element doesn't exist, abort\n    if (elem.length == 0) {\n      return;\n    }\n\n    var $window = jQuery(window);\n    var viewport_top = $window.scrollTop();\n    var viewport_height = $window.height();\n    var viewport_bottom = viewport_top + viewport_height - 320;\n    var $elem = jQuery(elem);\n    var top = $elem.offset().top;\n    var height = $elem.height();\n    var bottom = top + height;\n    return top >= viewport_top && top < viewport_bottom || bottom > viewport_top && bottom <= viewport_bottom || height > viewport_height && top <= viewport_top && bottom >= viewport_bottom;\n  }\n\n  (function ($) {\n    $.fn.timeline = function () {\n      var selectors = {\n        id: $(this),\n        item: $(this).find(\".timeline-item\"),\n        activeClass: \"timeline-item--active\",\n        img: \".timeline__img\"\n      };\n      window.addEventListener(\"scroll\", function (e) {\n        selectors.item.each(function (i) {\n          if (isOnScreen(jQuery($(this)))) {\n            /* Pass element id/class you want to check */\n            $(this).addClass(selectors.activeClass);\n          } else {\n            $(this).removeClass(selectors.activeClass);\n          }\n        });\n      });\n    };\n  })(jQuery); //jQuery(\".timeline-container\").timeline();\n\n});\njQuery(document).ready(function () {\n  // Adds Flex Video to YouTube and Vimeo Embeds\n  jQuery('iframe[src*=\"youtube.com\"], iframe[src*=\"vimeo.com\"]').each(function () {\n    if (jQuery(this).innerWidth() / jQuery(this).innerHeight() > 1.5) {\n      jQuery(this).wrap(\"<div class='embed-responsive embed-responsive-16by9'/>\");\n    } else {\n      jQuery(this).wrap(\"<div class='embed-responsive'/>\");\n    }\n  });\n});\n\n//# sourceURL=webpack:///./assets/src/js/frontend/frontend.js?");

/***/ }),

/***/ "./assets/src/sass/style.scss":
/*!************************************!*\
  !*** ./assets/src/sass/style.scss ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("// extracted by mini-css-extract-plugin\n\n//# sourceURL=webpack:///./assets/src/sass/style.scss?");

/***/ })

/******/ });