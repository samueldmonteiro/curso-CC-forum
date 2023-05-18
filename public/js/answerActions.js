/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/alert.js":
/*!*******************************!*\
  !*** ./resources/js/alert.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ alert)
/* harmony export */ });
function alert(content, type) {
  if (type == 'error') type = 'danger';
  var message = document.createElement('div');
  var style = "alert-".concat(type);
  message.classList.add('alert', 'text-center', style);
  message.innerText = content;
  return message;
}

/***/ }),

/***/ "./resources/js/utils.js":
/*!*******************************!*\
  !*** ./resources/js/utils.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "qs": () => (/* binding */ qs),
/* harmony export */   "qsAll": () => (/* binding */ qsAll)
/* harmony export */ });
function qs(e) {
  return document.querySelector(e);
}
function qsAll(e) {
  return document.querySelectorAll(e);
}

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!***************************************!*\
  !*** ./resources/js/answerActions.js ***!
  \***************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _utils__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./utils */ "./resources/js/utils.js");
/* harmony import */ var _alert__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./alert */ "./resources/js/alert.js");


(0,_utils__WEBPACK_IMPORTED_MODULE_0__.qs)("#answer").addEventListener('click', function (_) {
  var writeAnswerArea = (0,_utils__WEBPACK_IMPORTED_MODULE_0__.qs)(".write-answer");
  writeAnswerArea.classList.toggle('hide-write-answer');
  writeAnswerArea.classList.toggle('show-write-answer');
});

/**qs('#sendAnswerBtn').addEventListener('click', _ => {

    if (tinyMCE.get('answerContent').getContent() == "") {
        const errorMessage = alert('Escreva algo na sua resposta!', 'error');
        if (!qs('.answer-topic').querySelector('.alert')) qs('.answer-topic').prepend(errorMessage);
    }
});
**/
if ((0,_utils__WEBPACK_IMPORTED_MODULE_0__.qs)(".answer-item")) {
  (0,_utils__WEBPACK_IMPORTED_MODULE_0__.qsAll)(".answer-item").forEach(function (answerItem) {
    var buttonDeleteAnswer = answerItem.querySelector("#button-delete-answer");
    if (buttonDeleteAnswer) {
      buttonDeleteAnswer.addEventListener("click", buildAnswerDeletetion);
    }
  });
}
function buildAnswerDeletetion(e) {
  modalDeleteAnswer = (0,_utils__WEBPACK_IMPORTED_MODULE_0__.qs)("#modalDeleteAnswer");
  answerId = e.currentTarget.closest(".answer-item").dataset.id;
  modalDeleteAnswer.dataset.id = answerId;
}
if ((0,_utils__WEBPACK_IMPORTED_MODULE_0__.qs)(".delete-ok")) {
  (0,_utils__WEBPACK_IMPORTED_MODULE_0__.qs)(".delete-ok").addEventListener("click", confirmAnswerDeletetion);
}
function confirmAnswerDeletetion(e) {
  idAnswer = e.currentTarget.closest("#modalDeleteAnswer").dataset.id;
  form = new FormData();
  form.append("id_answer", idAnswer);
  fetch("answer_delete_action.php", {
    method: "POST",
    body: form
  }).then(function () {
    window.location.reload();
  });
}
if ((0,_utils__WEBPACK_IMPORTED_MODULE_0__.qs)("#like-answer")) {
  (0,_utils__WEBPACK_IMPORTED_MODULE_0__.qsAll)("#like-answer").forEach(function (buttonLike) {
    buttonLike.addEventListener("click", likeAnswer);
  });
}
function likeAnswer(e) {
  iconLike = e.currentTarget.querySelector('i');
  countLike = e.currentTarget.querySelector(".count-like");
  answerId = e.currentTarget.closest(".answer-item").dataset.id;
  if (iconLike.classList.contains('bi-heart')) {
    iconLike.classList.remove('bi-heart');
    iconLike.classList.add('bi-heart-fill');
    countLike.innerHTML = parseInt(countLike.innerHTML) + 1;
  } else {
    iconLike.classList.add('bi-heart');
    iconLike.classList.remove('bi-heart-fill');
    countLike.innerHTML = parseInt(countLike.innerHTML) - 1;
  }
  form = new FormData();
  form.append("id_answer", answerId);
  fetch("answer_like_action.php", {
    method: "POST",
    body: form
  });
}

//114
})();

/******/ })()
;