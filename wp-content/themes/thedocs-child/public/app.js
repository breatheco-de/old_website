webpackJsonp([13],[/* 0 */
/***/
function(e,t,n){var i,r;/*!
 * jQuery JavaScript Library v3.2.1
 * https://jquery.com/
 *
 * Includes Sizzle.js
 * https://sizzlejs.com/
 *
 * Copyright JS Foundation and other contributors
 * Released under the MIT license
 * https://jquery.org/license
 *
 * Date: 2017-03-20T18:59Z
 */
(function(t,n){"use strict";if(typeof e==="object"&&typeof e.exports==="object"){
// For CommonJS and CommonJS-like environments where a proper `window`
// is present, execute the factory and get jQuery.
// For environments that do not have a `window` with a `document`
// (such as Node.js), expose a factory as module.exports.
// This accentuates the need for the creation of a real `window`.
// e.g. var jQuery = require("jquery")(window);
// See ticket #14549 for more info.
e.exports=t.document?n(t,true):function(e){if(!e.document){throw new Error("jQuery requires a window with a document")}return n(e)}}else{n(t)}})(typeof window!=="undefined"?window:this,function(n,o){
// Edge <= 12 - 13+, Firefox <=18 - 45+, IE 10 - 11, Safari 5.1 - 9+, iOS 6 - 9.1
// throw exceptions when non-strict code (e.g., ASP.NET 4.5) accesses strict mode
// arguments.callee.caller (trac-13335). But as of jQuery 3.0 (2016), strict mode should be common
// enough that all such attempts are guarded in a try block.
"use strict";var s=[];var a=n.document;var l=Object.getPrototypeOf;var f=s.slice;var u=s.concat;var c=s.push;var d=s.indexOf;var p={};var h=p.toString;var g=p.hasOwnProperty;var m=g.toString;var v=m.call(Object);var y={};function b(e,t){t=t||a;var n=t.createElement("script");n.text=e;t.head.appendChild(n).parentNode.removeChild(n)}/* global Symbol */
// Defining this global in .eslintrc.json would create a danger of using the global
// unguarded in another place, it seems safer to define global only for this module
var w="3.2.1",
// Define a local copy of jQuery
x=function(e,t){
// The jQuery object is actually just the init constructor 'enhanced'
// Need init if jQuery is called (just allow error to be thrown if not included)
return new x.fn.init(e,t)},
// Support: Android <=4.0 only
// Make sure we trim BOM and NBSP
T=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
// Matches dashed string for camelizing
C=/^-ms-/,E=/-([a-z])/g,
// Used by jQuery.camelCase as callback to replace()
k=function(e,t){return t.toUpperCase()};x.fn=x.prototype={
// The current version of jQuery being used
jquery:w,constructor:x,
// The default length of a jQuery object is 0
length:0,toArray:function(){return f.call(this)},
// Get the Nth element in the matched element set OR
// Get the whole matched element set as a clean array
get:function(e){
// Return all the elements in a clean array
if(e==null){return f.call(this)}
// Return just the one element from the set
return e<0?this[e+this.length]:this[e]},
// Take an array of elements and push it onto the stack
// (returning the new matched element set)
pushStack:function(e){
// Build a new jQuery matched element set
var t=x.merge(this.constructor(),e);
// Add the old object onto the stack (as a reference)
t.prevObject=this;
// Return the newly-formed element set
return t},
// Execute a callback for every element in the matched set.
each:function(e){return x.each(this,e)},map:function(e){return this.pushStack(x.map(this,function(t,n){return e.call(t,n,t)}))},slice:function(){return this.pushStack(f.apply(this,arguments))},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},eq:function(e){var t=this.length,n=+e+(e<0?t:0);return this.pushStack(n>=0&&n<t?[this[n]]:[])},end:function(){return this.prevObject||this.constructor()},
// For internal use only.
// Behaves like an Array's method, not like a jQuery method.
push:c,sort:s.sort,splice:s.splice};x.extend=x.fn.extend=function(){var e,t,n,i,r,o,s=arguments[0]||{},a=1,l=arguments.length,f=false;
// Handle a deep copy situation
if(typeof s==="boolean"){f=s;
// Skip the boolean and the target
s=arguments[a]||{};a++}
// Handle case when target is a string or something (possible in deep copy)
if(typeof s!=="object"&&!x.isFunction(s)){s={}}
// Extend jQuery itself if only one argument is passed
if(a===l){s=this;a--}for(;a<l;a++){
// Only deal with non-null/undefined values
if((e=arguments[a])!=null){
// Extend the base object
for(t in e){n=s[t];i=e[t];
// Prevent never-ending loop
if(s===i){continue}
// Recurse if we're merging plain objects or arrays
if(f&&i&&(x.isPlainObject(i)||(r=Array.isArray(i)))){if(r){r=false;o=n&&Array.isArray(n)?n:[]}else{o=n&&x.isPlainObject(n)?n:{}}
// Never move original objects, clone them
s[t]=x.extend(f,o,i)}else if(i!==undefined){s[t]=i}}}}
// Return the modified object
return s};x.extend({
// Unique for each copy of jQuery on the page
expando:"jQuery"+(w+Math.random()).replace(/\D/g,""),
// Assume jQuery is ready without the ready module
isReady:true,error:function(e){throw new Error(e)},noop:function(){},isFunction:function(e){return x.type(e)==="function"},isWindow:function(e){return e!=null&&e===e.window},isNumeric:function(e){
// As of jQuery 3.0, isNumeric is limited to
// strings and numbers (primitives or objects)
// that can be coerced to finite numbers (gh-2662)
var t=x.type(e);
// parseFloat NaNs numeric-cast false positives ("")
// ...but misinterprets leading-number strings, particularly hex literals ("0x...")
// subtraction forces infinities to NaN
return(t==="number"||t==="string")&&!isNaN(e-parseFloat(e))},isPlainObject:function(e){var t,n;
// Detect obvious negatives
// Use toString instead of jQuery.type to catch host objects
if(!e||h.call(e)!=="[object Object]"){return false}t=l(e);
// Objects with no prototype (e.g., `Object.create( null )`) are plain
if(!t){return true}
// Objects with prototype are plain iff they were constructed by a global Object function
n=g.call(t,"constructor")&&t.constructor;return typeof n==="function"&&m.call(n)===v},isEmptyObject:function(e){/* eslint-disable no-unused-vars */
// See https://github.com/eslint/eslint/issues/6125
var t;for(t in e){return false}return true},type:function(e){if(e==null){return e+""}
// Support: Android <=2.3 only (functionish RegExp)
return typeof e==="object"||typeof e==="function"?p[h.call(e)]||"object":typeof e},
// Evaluates a script in a global context
globalEval:function(e){b(e)},
// Convert dashed to camelCase; used by the css and data modules
// Support: IE <=9 - 11, Edge 12 - 13
// Microsoft forgot to hump their vendor prefix (#9572)
camelCase:function(e){return e.replace(C,"ms-").replace(E,k)},each:function(e,t){var n,i=0;if(S(e)){n=e.length;for(;i<n;i++){if(t.call(e[i],i,e[i])===false){break}}}else{for(i in e){if(t.call(e[i],i,e[i])===false){break}}}return e},
// Support: Android <=4.0 only
trim:function(e){return e==null?"":(e+"").replace(T,"")},
// results is for internal usage only
makeArray:function(e,t){var n=t||[];if(e!=null){if(S(Object(e))){x.merge(n,typeof e==="string"?[e]:e)}else{c.call(n,e)}}return n},inArray:function(e,t,n){return t==null?-1:d.call(t,e,n)},
// Support: Android <=4.0 only, PhantomJS 1 only
// push.apply(_, arraylike) throws on ancient WebKit
merge:function(e,t){var n=+t.length,i=0,r=e.length;for(;i<n;i++){e[r++]=t[i]}e.length=r;return e},grep:function(e,t,n){var i,r=[],o=0,s=e.length,a=!n;
// Go through the array, only saving the items
// that pass the validator function
for(;o<s;o++){i=!t(e[o],o);if(i!==a){r.push(e[o])}}return r},
// arg is for internal usage only
map:function(e,t,n){var i,r,o=0,s=[];
// Go through the array, translating each of the items to their new values
if(S(e)){i=e.length;for(;o<i;o++){r=t(e[o],o,n);if(r!=null){s.push(r)}}}else{for(o in e){r=t(e[o],o,n);if(r!=null){s.push(r)}}}
// Flatten any nested arrays
return u.apply([],s)},
// A global GUID counter for objects
guid:1,
// Bind a function to a context, optionally partially applying any
// arguments.
proxy:function(e,t){var n,i,r;if(typeof t==="string"){n=e[t];t=e;e=n}
// Quick check to determine if target is callable, in the spec
// this throws a TypeError, but we will just return undefined.
if(!x.isFunction(e)){return undefined}
// Simulated bind
i=f.call(arguments,2);r=function(){return e.apply(t||this,i.concat(f.call(arguments)))};
// Set the guid of unique handler to the same of original handler, so it can be removed
r.guid=e.guid=e.guid||x.guid++;return r},now:Date.now,
// jQuery.support is not used in Core but other projects attach their
// properties to it so it needs to exist.
support:y});if(typeof Symbol==="function"){x.fn[Symbol.iterator]=s[Symbol.iterator]}
// Populate the class2type map
x.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "),function(e,t){p["[object "+t+"]"]=t.toLowerCase()});function S(e){
// Support: real iOS 8.2 only (not reproducible in simulator)
// `in` check used to prevent JIT error (gh-2145)
// hasOwn isn't used here due to false negatives
// regarding Nodelist length in IE
var t=!!e&&"length"in e&&e.length,n=x.type(e);if(n==="function"||x.isWindow(e)){return false}return n==="array"||t===0||typeof t==="number"&&t>0&&t-1 in e}var $=/*!
 * Sizzle CSS Selector Engine v2.3.3
 * https://sizzlejs.com/
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: 2016-08-08
 */
function(e){var t,n,i,r,o,s,a,l,f,u,c,
// Local document vars
d,p,h,g,m,v,y,b,
// Instance-specific data
w="sizzle"+1*new Date,x=e.document,T=0,C=0,E=se(),k=se(),S=se(),$=function(e,t){if(e===t){c=true}return 0},
// Instance methods
D={}.hasOwnProperty,A=[],N=A.pop,j=A.push,O=A.push,I=A.slice,
// Use a stripped-down indexOf as it's faster than native
// https://jsperf.com/thor-indexof-vs-for/5
L=function(e,t){var n=0,i=e.length;for(;n<i;n++){if(e[n]===t){return n}}return-1},R="checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
// Regular expressions
// http://www.w3.org/TR/css3-selectors/#whitespace
P="[\\x20\\t\\r\\n\\f]",
// http://www.w3.org/TR/CSS21/syndata.html#value-def-identifier
q="(?:\\\\.|[\\w-]|[^\0-\\xa0])+",
// Attribute selectors: http://www.w3.org/TR/selectors/#attribute-selectors
F="\\["+P+"*("+q+")(?:"+P+
// Operator (capture 2)
"*([*^$|!~]?=)"+P+
// "Attribute values must be CSS identifiers [capture 5] or strings [capture 3 or capture 4]"
"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|("+q+"))|)"+P+"*\\]",H=":("+q+")(?:\\(("+
// To reduce the number of selectors needing tokenize in the preFilter, prefer arguments:
// 1. quoted (capture 3; capture 4 or capture 5)
"('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|"+
// 2. simple (capture 6)
"((?:\\\\.|[^\\\\()[\\]]|"+F+")*)|"+
// 3. anything else (capture 2)
".*"+")\\)|)",
// Leading and non-escaped trailing whitespace, capturing some non-whitespace characters preceding the latter
B=new RegExp(P+"+","g"),W=new RegExp("^"+P+"+|((?:^|[^\\\\])(?:\\\\.)*)"+P+"+$","g"),M=new RegExp("^"+P+"*,"+P+"*"),_=new RegExp("^"+P+"*([>+~]|"+P+")"+P+"*"),U=new RegExp("="+P+"*([^\\]'\"]*?)"+P+"*\\]","g"),z=new RegExp(H),V=new RegExp("^"+q+"$"),X={ID:new RegExp("^#("+q+")"),CLASS:new RegExp("^\\.("+q+")"),TAG:new RegExp("^("+q+"|[*])"),ATTR:new RegExp("^"+F),PSEUDO:new RegExp("^"+H),CHILD:new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\("+P+"*(even|odd|(([+-]|)(\\d*)n|)"+P+"*(?:([+-]|)"+P+"*(\\d+)|))"+P+"*\\)|)","i"),bool:new RegExp("^(?:"+R+")$","i"),
// For use in libraries implementing .is()
// We use this for POS matching in `select`
needsContext:new RegExp("^"+P+"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\("+P+"*((?:-\\d)?\\d*)"+P+"*\\)|)(?=[^-]|$)","i")},G=/^(?:input|select|textarea|button)$/i,Y=/^h\d$/i,K=/^[^{]+\{\s*\[native \w/,
// Easily-parseable/retrievable ID or TAG or CLASS selectors
Q=/^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,J=/[+~]/,
// CSS escapes
// http://www.w3.org/TR/CSS21/syndata.html#escaped-characters
Z=new RegExp("\\\\([\\da-f]{1,6}"+P+"?|("+P+")|.)","ig"),ee=function(e,t,n){var i="0x"+t-65536;
// NaN means non-codepoint
// Support: Firefox<24
// Workaround erroneous numeric interpretation of +"0x"
// BMP codepoint
// Supplemental Plane codepoint (surrogate pair)
return i!==i||n?t:i<0?String.fromCharCode(i+65536):String.fromCharCode(i>>10|55296,i&1023|56320)},
// CSS string/identifier serialization
// https://drafts.csswg.org/cssom/#common-serializing-idioms
te=/([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,ne=function(e,t){if(t){
// U+0000 NULL becomes U+FFFD REPLACEMENT CHARACTER
if(e==="\0"){return"�"}
// Control characters and (dependent upon position) numbers get escaped as code points
return e.slice(0,-1)+"\\"+e.charCodeAt(e.length-1).toString(16)+" "}
// Other potentially-special ASCII characters get backslash-escaped
return"\\"+e},
// Used for iframes
// See setDocument()
// Removing the function wrapper causes a "Permission Denied"
// error in IE
ie=function(){d()},re=ye(function(e){return e.disabled===true&&("form"in e||"label"in e)},{dir:"parentNode",next:"legend"});
// Optimize for push.apply( _, NodeList )
try{O.apply(A=I.call(x.childNodes),x.childNodes);
// Support: Android<4.0
// Detect silently failing push.apply
A[x.childNodes.length].nodeType}catch(e){O={apply:A.length?
// Leverage slice if possible
function(e,t){j.apply(e,I.call(t))}:
// Support: IE<9
// Otherwise append directly
function(e,t){var n=e.length,i=0;
// Can't trust NodeList.length
while(e[n++]=t[i++]){}e.length=n-1}}}function oe(e,t,i,r){var o,a,f,u,c,h,v,y=t&&t.ownerDocument,
// nodeType defaults to 9, since context defaults to document
T=t?t.nodeType:9;i=i||[];
// Return early from calls with invalid selector or context
if(typeof e!=="string"||!e||T!==1&&T!==9&&T!==11){return i}
// Try to shortcut find operations (as opposed to filters) in HTML documents
if(!r){if((t?t.ownerDocument||t:x)!==p){d(t)}t=t||p;if(g){
// If the selector is sufficiently simple, try using a "get*By*" DOM method
// (excepting DocumentFragment context, where the methods don't exist)
if(T!==11&&(c=Q.exec(e))){
// ID selector
if(o=c[1]){
// Document context
if(T===9){if(f=t.getElementById(o)){
// Support: IE, Opera, Webkit
// TODO: identify versions
// getElementById can match elements by name instead of ID
if(f.id===o){i.push(f);return i}}else{return i}}else{
// Support: IE, Opera, Webkit
// TODO: identify versions
// getElementById can match elements by name instead of ID
if(y&&(f=y.getElementById(o))&&b(t,f)&&f.id===o){i.push(f);return i}}}else if(c[2]){O.apply(i,t.getElementsByTagName(e));return i}else if((o=c[3])&&n.getElementsByClassName&&t.getElementsByClassName){O.apply(i,t.getElementsByClassName(o));return i}}
// Take advantage of querySelectorAll
if(n.qsa&&!S[e+" "]&&(!m||!m.test(e))){if(T!==1){y=t;v=e}else if(t.nodeName.toLowerCase()!=="object"){
// Capture the context ID, setting it first if necessary
if(u=t.getAttribute("id")){u=u.replace(te,ne)}else{t.setAttribute("id",u=w)}
// Prefix every selector in the list
h=s(e);a=h.length;while(a--){h[a]="#"+u+" "+ve(h[a])}v=h.join(",");
// Expand context for sibling selectors
y=J.test(e)&&ge(t.parentNode)||t}if(v){try{O.apply(i,y.querySelectorAll(v));return i}catch(e){}finally{if(u===w){t.removeAttribute("id")}}}}}}
// All others
return l(e.replace(W,"$1"),t,i,r)}/**
 * Create key-value caches of limited size
 * @returns {function(string, object)} Returns the Object data after storing it on itself with
 *	property name the (space-suffixed) string and (if the cache is larger than Expr.cacheLength)
 *	deleting the oldest entry
 */
function se(){var e=[];function t(n,r){
// Use (key + " ") to avoid collision with native prototype properties (see Issue #157)
if(e.push(n+" ")>i.cacheLength){
// Only keep the most recent entries
delete t[e.shift()]}return t[n+" "]=r}return t}/**
 * Mark a function for special use by Sizzle
 * @param {Function} fn The function to mark
 */
function ae(e){e[w]=true;return e}/**
 * Support testing using an element
 * @param {Function} fn Passed the created element and returns a boolean result
 */
function le(e){var t=p.createElement("fieldset");try{return!!e(t)}catch(e){return false}finally{
// Remove from its parent by default
if(t.parentNode){t.parentNode.removeChild(t)}
// release memory in IE
t=null}}/**
 * Adds the same handler for all of the specified attrs
 * @param {String} attrs Pipe-separated list of attributes
 * @param {Function} handler The method that will be applied
 */
function fe(e,t){var n=e.split("|"),r=n.length;while(r--){i.attrHandle[n[r]]=t}}/**
 * Checks document order of two siblings
 * @param {Element} a
 * @param {Element} b
 * @returns {Number} Returns less than 0 if a precedes b, greater than 0 if a follows b
 */
function ue(e,t){var n=t&&e,i=n&&e.nodeType===1&&t.nodeType===1&&e.sourceIndex-t.sourceIndex;
// Use IE sourceIndex if available on both nodes
if(i){return i}
// Check if b follows a
if(n){while(n=n.nextSibling){if(n===t){return-1}}}return e?1:-1}/**
 * Returns a function to use in pseudos for input types
 * @param {String} type
 */
function ce(e){return function(t){var n=t.nodeName.toLowerCase();return n==="input"&&t.type===e}}/**
 * Returns a function to use in pseudos for buttons
 * @param {String} type
 */
function de(e){return function(t){var n=t.nodeName.toLowerCase();return(n==="input"||n==="button")&&t.type===e}}/**
 * Returns a function to use in pseudos for :enabled/:disabled
 * @param {Boolean} disabled true for :disabled; false for :enabled
 */
function pe(e){
// Known :disabled false positives: fieldset[disabled] > legend:nth-of-type(n+2) :can-disable
return function(t){
// Only certain elements can match :enabled or :disabled
// https://html.spec.whatwg.org/multipage/scripting.html#selector-enabled
// https://html.spec.whatwg.org/multipage/scripting.html#selector-disabled
if("form"in t){
// Check for inherited disabledness on relevant non-disabled elements:
// * listed form-associated elements in a disabled fieldset
//   https://html.spec.whatwg.org/multipage/forms.html#category-listed
//   https://html.spec.whatwg.org/multipage/forms.html#concept-fe-disabled
// * option elements in a disabled optgroup
//   https://html.spec.whatwg.org/multipage/forms.html#concept-option-disabled
// All such elements have a "form" property.
if(t.parentNode&&t.disabled===false){
// Option elements defer to a parent optgroup if present
if("label"in t){if("label"in t.parentNode){return t.parentNode.disabled===e}else{return t.disabled===e}}
// Support: IE 6 - 11
// Use the isDisabled shortcut property to check for disabled fieldset ancestors
// Where there is no isDisabled, check manually
/* jshint -W018 */
return t.isDisabled===e||t.isDisabled!==!e&&re(t)===e}return t.disabled===e}else if("label"in t){return t.disabled===e}
// Remaining elements are neither :enabled nor :disabled
return false}}/**
 * Returns a function to use in pseudos for positionals
 * @param {Function} fn
 */
function he(e){return ae(function(t){t=+t;return ae(function(n,i){var r,o=e([],n.length,t),s=o.length;
// Match elements found at the specified indexes
while(s--){if(n[r=o[s]]){n[r]=!(i[r]=n[r])}}})})}/**
 * Checks a node for validity as a Sizzle context
 * @param {Element|Object=} context
 * @returns {Element|Object|Boolean} The input node if acceptable, otherwise a falsy value
 */
function ge(e){return e&&typeof e.getElementsByTagName!=="undefined"&&e}
// Expose support vars for convenience
n=oe.support={};/**
 * Detects XML nodes
 * @param {Element|Object} elem An element or a document
 * @returns {Boolean} True iff elem is a non-HTML XML node
 */
o=oe.isXML=function(e){
// documentElement is verified for cases where it doesn't yet exist
// (such as loading iframes in IE - #4833)
var t=e&&(e.ownerDocument||e).documentElement;return t?t.nodeName!=="HTML":false};/**
 * Sets document-related variables once based on the current document
 * @param {Element|Object} [doc] An element or document object to use to set the document
 * @returns {Object} Returns the current document
 */
d=oe.setDocument=function(e){var t,r,s=e?e.ownerDocument||e:x;
// Return early if doc is invalid or already selected
if(s===p||s.nodeType!==9||!s.documentElement){return p}
// Update global variables
p=s;h=p.documentElement;g=!o(p);
// Support: IE 9-11, Edge
// Accessing iframe documents after unload throws "permission denied" errors (jQuery #13936)
if(x!==p&&(r=p.defaultView)&&r.top!==r){
// Support: IE 11, Edge
if(r.addEventListener){r.addEventListener("unload",ie,false)}else if(r.attachEvent){r.attachEvent("onunload",ie)}}/* Attributes
	---------------------------------------------------------------------- */
// Support: IE<8
// Verify that getAttribute really returns attributes and not properties
// (excepting IE8 booleans)
n.attributes=le(function(e){e.className="i";return!e.getAttribute("className")});/* getElement(s)By*
	---------------------------------------------------------------------- */
// Check if getElementsByTagName("*") returns only elements
n.getElementsByTagName=le(function(e){e.appendChild(p.createComment(""));return!e.getElementsByTagName("*").length});
// Support: IE<9
n.getElementsByClassName=K.test(p.getElementsByClassName);
// Support: IE<10
// Check if getElementById returns elements by name
// The broken getElementById methods don't pick up programmatically-set names,
// so use a roundabout getElementsByName test
n.getById=le(function(e){h.appendChild(e).id=w;return!p.getElementsByName||!p.getElementsByName(w).length});
// ID filter and find
if(n.getById){i.filter["ID"]=function(e){var t=e.replace(Z,ee);return function(e){return e.getAttribute("id")===t}};i.find["ID"]=function(e,t){if(typeof t.getElementById!=="undefined"&&g){var n=t.getElementById(e);return n?[n]:[]}}}else{i.filter["ID"]=function(e){var t=e.replace(Z,ee);return function(e){var n=typeof e.getAttributeNode!=="undefined"&&e.getAttributeNode("id");return n&&n.value===t}};
// Support: IE 6 - 7 only
// getElementById is not reliable as a find shortcut
i.find["ID"]=function(e,t){if(typeof t.getElementById!=="undefined"&&g){var n,i,r,o=t.getElementById(e);if(o){
// Verify the id attribute
n=o.getAttributeNode("id");if(n&&n.value===e){return[o]}
// Fall back on getElementsByName
r=t.getElementsByName(e);i=0;while(o=r[i++]){n=o.getAttributeNode("id");if(n&&n.value===e){return[o]}}}return[]}}}
// Tag
i.find["TAG"]=n.getElementsByTagName?function(e,t){if(typeof t.getElementsByTagName!=="undefined"){return t.getElementsByTagName(e)}else if(n.qsa){return t.querySelectorAll(e)}}:function(e,t){var n,i=[],r=0,
// By happy coincidence, a (broken) gEBTN appears on DocumentFragment nodes too
o=t.getElementsByTagName(e);
// Filter out possible comments
if(e==="*"){while(n=o[r++]){if(n.nodeType===1){i.push(n)}}return i}return o};
// Class
i.find["CLASS"]=n.getElementsByClassName&&function(e,t){if(typeof t.getElementsByClassName!=="undefined"&&g){return t.getElementsByClassName(e)}};/* QSA/matchesSelector
	---------------------------------------------------------------------- */
// QSA and matchesSelector support
// matchesSelector(:active) reports false when true (IE9/Opera 11.5)
v=[];
// qSa(:focus) reports false when true (Chrome 21)
// We allow this because of a bug in IE8/9 that throws an error
// whenever `document.activeElement` is accessed on an iframe
// So, we allow :focus to pass through QSA all the time to avoid the IE error
// See https://bugs.jquery.com/ticket/13378
m=[];if(n.qsa=K.test(p.querySelectorAll)){
// Build QSA regex
// Regex strategy adopted from Diego Perini
le(function(e){
// Select is set to empty string on purpose
// This is to test IE's treatment of not explicitly
// setting a boolean content attribute,
// since its presence should be enough
// https://bugs.jquery.com/ticket/12359
h.appendChild(e).innerHTML="<a id='"+w+"'></a>"+"<select id='"+w+"-\r\\' msallowcapture=''>"+"<option selected=''></option></select>";
// Support: IE8, Opera 11-12.16
// Nothing should be selected when empty strings follow ^= or $= or *=
// The test attribute must be unknown in Opera but "safe" for WinRT
// https://msdn.microsoft.com/en-us/library/ie/hh465388.aspx#attribute_section
if(e.querySelectorAll("[msallowcapture^='']").length){m.push("[*^$]="+P+"*(?:''|\"\")")}
// Support: IE8
// Boolean attributes and "value" are not treated correctly
if(!e.querySelectorAll("[selected]").length){m.push("\\["+P+"*(?:value|"+R+")")}
// Support: Chrome<29, Android<4.4, Safari<7.0+, iOS<7.0+, PhantomJS<1.9.8+
if(!e.querySelectorAll("[id~="+w+"-]").length){m.push("~=")}
// Webkit/Opera - :checked should return selected option elements
// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
// IE8 throws error here and will not see later tests
if(!e.querySelectorAll(":checked").length){m.push(":checked")}
// Support: Safari 8+, iOS 8+
// https://bugs.webkit.org/show_bug.cgi?id=136851
// In-page `selector#id sibling-combinator selector` fails
if(!e.querySelectorAll("a#"+w+"+*").length){m.push(".#.+[+~]")}});le(function(e){e.innerHTML="<a href='' disabled='disabled'></a>"+"<select disabled='disabled'><option/></select>";
// Support: Windows 8 Native Apps
// The type and name attributes are restricted during .innerHTML assignment
var t=p.createElement("input");t.setAttribute("type","hidden");e.appendChild(t).setAttribute("name","D");
// Support: IE8
// Enforce case-sensitivity of name attribute
if(e.querySelectorAll("[name=d]").length){m.push("name"+P+"*[*^$|!~]?=")}
// FF 3.5 - :enabled/:disabled and hidden elements (hidden elements are still enabled)
// IE8 throws error here and will not see later tests
if(e.querySelectorAll(":enabled").length!==2){m.push(":enabled",":disabled")}
// Support: IE9-11+
// IE's :disabled selector does not pick up the children of disabled fieldsets
h.appendChild(e).disabled=true;if(e.querySelectorAll(":disabled").length!==2){m.push(":enabled",":disabled")}
// Opera 10-11 does not throw on post-comma invalid pseudos
e.querySelectorAll("*,:x");m.push(",.*:")})}if(n.matchesSelector=K.test(y=h.matches||h.webkitMatchesSelector||h.mozMatchesSelector||h.oMatchesSelector||h.msMatchesSelector)){le(function(e){
// Check to see if it's possible to do matchesSelector
// on a disconnected node (IE 9)
n.disconnectedMatch=y.call(e,"*");
// This should fail with an exception
// Gecko does not error, returns false instead
y.call(e,"[s!='']:x");v.push("!=",H)})}m=m.length&&new RegExp(m.join("|"));v=v.length&&new RegExp(v.join("|"));/* Contains
	---------------------------------------------------------------------- */
t=K.test(h.compareDocumentPosition);
// Element contains another
// Purposefully self-exclusive
// As in, an element does not contain itself
b=t||K.test(h.contains)?function(e,t){var n=e.nodeType===9?e.documentElement:e,i=t&&t.parentNode;return e===i||!!(i&&i.nodeType===1&&(n.contains?n.contains(i):e.compareDocumentPosition&&e.compareDocumentPosition(i)&16))}:function(e,t){if(t){while(t=t.parentNode){if(t===e){return true}}}return false};/* Sorting
	---------------------------------------------------------------------- */
// Document order sorting
$=t?function(e,t){
// Flag for duplicate removal
if(e===t){c=true;return 0}
// Sort on method existence if only one input has compareDocumentPosition
var i=!e.compareDocumentPosition-!t.compareDocumentPosition;if(i){return i}
// Calculate position if both inputs belong to the same document
i=(e.ownerDocument||e)===(t.ownerDocument||t)?e.compareDocumentPosition(t):
// Otherwise we know they are disconnected
1;
// Disconnected nodes
if(i&1||!n.sortDetached&&t.compareDocumentPosition(e)===i){
// Choose the first element that is related to our preferred document
if(e===p||e.ownerDocument===x&&b(x,e)){return-1}if(t===p||t.ownerDocument===x&&b(x,t)){return 1}
// Maintain original order
return u?L(u,e)-L(u,t):0}return i&4?-1:1}:function(e,t){
// Exit early if the nodes are identical
if(e===t){c=true;return 0}var n,i=0,r=e.parentNode,o=t.parentNode,s=[e],a=[t];
// Parentless nodes are either documents or disconnected
if(!r||!o){return e===p?-1:t===p?1:r?-1:o?1:u?L(u,e)-L(u,t):0}else if(r===o){return ue(e,t)}
// Otherwise we need full lists of their ancestors for comparison
n=e;while(n=n.parentNode){s.unshift(n)}n=t;while(n=n.parentNode){a.unshift(n)}
// Walk down the tree looking for a discrepancy
while(s[i]===a[i]){i++}
// Do a sibling check if the nodes have a common ancestor
// Otherwise nodes in our document sort first
return i?ue(s[i],a[i]):s[i]===x?-1:a[i]===x?1:0};return p};oe.matches=function(e,t){return oe(e,null,null,t)};oe.matchesSelector=function(e,t){
// Set document vars if needed
if((e.ownerDocument||e)!==p){d(e)}
// Make sure that attribute selectors are quoted
t=t.replace(U,"='$1']");if(n.matchesSelector&&g&&!S[t+" "]&&(!v||!v.test(t))&&(!m||!m.test(t))){try{var i=y.call(e,t);
// IE 9's matchesSelector returns false on disconnected nodes
if(i||n.disconnectedMatch||
// As well, disconnected nodes are said to be in a document
// fragment in IE 9
e.document&&e.document.nodeType!==11){return i}}catch(e){}}return oe(t,p,null,[e]).length>0};oe.contains=function(e,t){
// Set document vars if needed
if((e.ownerDocument||e)!==p){d(e)}return b(e,t)};oe.attr=function(e,t){
// Set document vars if needed
if((e.ownerDocument||e)!==p){d(e)}var r=i.attrHandle[t.toLowerCase()],
// Don't get fooled by Object.prototype properties (jQuery #13807)
o=r&&D.call(i.attrHandle,t.toLowerCase())?r(e,t,!g):undefined;return o!==undefined?o:n.attributes||!g?e.getAttribute(t):(o=e.getAttributeNode(t))&&o.specified?o.value:null};oe.escape=function(e){return(e+"").replace(te,ne)};oe.error=function(e){throw new Error("Syntax error, unrecognized expression: "+e)};/**
 * Document sorting and removing duplicates
 * @param {ArrayLike} results
 */
oe.uniqueSort=function(e){var t,i=[],r=0,o=0;
// Unless we *know* we can detect duplicates, assume their presence
c=!n.detectDuplicates;u=!n.sortStable&&e.slice(0);e.sort($);if(c){while(t=e[o++]){if(t===e[o]){r=i.push(o)}}while(r--){e.splice(i[r],1)}}
// Clear input after sorting to release objects
// See https://github.com/jquery/sizzle/pull/225
u=null;return e};/**
 * Utility function for retrieving the text value of an array of DOM nodes
 * @param {Array|Element} elem
 */
r=oe.getText=function(e){var t,n="",i=0,o=e.nodeType;if(!o){
// If no nodeType, this is expected to be an array
while(t=e[i++]){
// Do not traverse comment nodes
n+=r(t)}}else if(o===1||o===9||o===11){
// Use textContent for elements
// innerText usage removed for consistency of new lines (jQuery #11153)
if(typeof e.textContent==="string"){return e.textContent}else{
// Traverse its children
for(e=e.firstChild;e;e=e.nextSibling){n+=r(e)}}}else if(o===3||o===4){return e.nodeValue}
// Do not include comment or processing instruction nodes
return n};i=oe.selectors={
// Can be adjusted by the user
cacheLength:50,createPseudo:ae,match:X,attrHandle:{},find:{},relative:{">":{dir:"parentNode",first:true}," ":{dir:"parentNode"},"+":{dir:"previousSibling",first:true},"~":{dir:"previousSibling"}},preFilter:{ATTR:function(e){e[1]=e[1].replace(Z,ee);
// Move the given value to match[3] whether quoted or unquoted
e[3]=(e[3]||e[4]||e[5]||"").replace(Z,ee);if(e[2]==="~="){e[3]=" "+e[3]+" "}return e.slice(0,4)},CHILD:function(e){/* matches from matchExpr["CHILD"]
				1 type (only|nth|...)
				2 what (child|of-type)
				3 argument (even|odd|\d*|\d*n([+-]\d+)?|...)
				4 xn-component of xn+y argument ([+-]?\d*n|)
				5 sign of xn-component
				6 x of xn-component
				7 sign of y-component
				8 y of y-component
			*/
e[1]=e[1].toLowerCase();if(e[1].slice(0,3)==="nth"){
// nth-* requires argument
if(!e[3]){oe.error(e[0])}
// numeric x and y parameters for Expr.filter.CHILD
// remember that false/true cast respectively to 0/1
e[4]=+(e[4]?e[5]+(e[6]||1):2*(e[3]==="even"||e[3]==="odd"));e[5]=+(e[7]+e[8]||e[3]==="odd")}else if(e[3]){oe.error(e[0])}return e},PSEUDO:function(e){var t,n=!e[6]&&e[2];if(X["CHILD"].test(e[0])){return null}
// Accept quoted arguments as-is
if(e[3]){e[2]=e[4]||e[5]||""}else if(n&&z.test(n)&&(
// Get excess from tokenize (recursively)
t=s(n,true))&&(
// advance to the next closing parenthesis
t=n.indexOf(")",n.length-t)-n.length)){
// excess is a negative index
e[0]=e[0].slice(0,t);e[2]=n.slice(0,t)}
// Return only captures needed by the pseudo filter method (type and argument)
return e.slice(0,3)}},filter:{TAG:function(e){var t=e.replace(Z,ee).toLowerCase();return e==="*"?function(){return true}:function(e){return e.nodeName&&e.nodeName.toLowerCase()===t}},CLASS:function(e){var t=E[e+" "];return t||(t=new RegExp("(^|"+P+")"+e+"("+P+"|$)"))&&E(e,function(e){return t.test(typeof e.className==="string"&&e.className||typeof e.getAttribute!=="undefined"&&e.getAttribute("class")||"")})},ATTR:function(e,t,n){return function(i){var r=oe.attr(i,e);if(r==null){return t==="!="}if(!t){return true}r+="";return t==="="?r===n:t==="!="?r!==n:t==="^="?n&&r.indexOf(n)===0:t==="*="?n&&r.indexOf(n)>-1:t==="$="?n&&r.slice(-n.length)===n:t==="~="?(" "+r.replace(B," ")+" ").indexOf(n)>-1:t==="|="?r===n||r.slice(0,n.length+1)===n+"-":false}},CHILD:function(e,t,n,i,r){var o=e.slice(0,3)!=="nth",s=e.slice(-4)!=="last",a=t==="of-type";
// Shortcut for :nth-*(n)
return i===1&&r===0?function(e){return!!e.parentNode}:function(t,n,l){var f,u,c,d,p,h,g=o!==s?"nextSibling":"previousSibling",m=t.parentNode,v=a&&t.nodeName.toLowerCase(),y=!l&&!a,b=false;if(m){
// :(first|last|only)-(child|of-type)
if(o){while(g){d=t;while(d=d[g]){if(a?d.nodeName.toLowerCase()===v:d.nodeType===1){return false}}
// Reverse direction for :only-* (if we haven't yet done so)
h=g=e==="only"&&!h&&"nextSibling"}return true}h=[s?m.firstChild:m.lastChild];
// non-xml :nth-child(...) stores cache data on `parent`
if(s&&y){
// Seek `elem` from a previously-cached index
// ...in a gzip-friendly way
d=m;c=d[w]||(d[w]={});
// Support: IE <9 only
// Defend against cloned attroperties (jQuery gh-1709)
u=c[d.uniqueID]||(c[d.uniqueID]={});f=u[e]||[];p=f[0]===T&&f[1];b=p&&f[2];d=p&&m.childNodes[p];while(d=++p&&d&&d[g]||(
// Fallback to seeking `elem` from the start
b=p=0)||h.pop()){
// When found, cache indexes on `parent` and break
if(d.nodeType===1&&++b&&d===t){u[e]=[T,p,b];break}}}else{
// Use previously-cached element index if available
if(y){
// ...in a gzip-friendly way
d=t;c=d[w]||(d[w]={});
// Support: IE <9 only
// Defend against cloned attroperties (jQuery gh-1709)
u=c[d.uniqueID]||(c[d.uniqueID]={});f=u[e]||[];p=f[0]===T&&f[1];b=p}
// xml :nth-child(...)
// or :nth-last-child(...) or :nth(-last)?-of-type(...)
if(b===false){
// Use the same loop as above to seek `elem` from the start
while(d=++p&&d&&d[g]||(b=p=0)||h.pop()){if((a?d.nodeName.toLowerCase()===v:d.nodeType===1)&&++b){
// Cache the index of each encountered element
if(y){c=d[w]||(d[w]={});
// Support: IE <9 only
// Defend against cloned attroperties (jQuery gh-1709)
u=c[d.uniqueID]||(c[d.uniqueID]={});u[e]=[T,b]}if(d===t){break}}}}}
// Incorporate the offset, then check against cycle size
b-=r;return b===i||b%i===0&&b/i>=0}}},PSEUDO:function(e,t){
// pseudo-class names are case-insensitive
// http://www.w3.org/TR/selectors/#pseudo-classes
// Prioritize by case sensitivity in case custom pseudos are added with uppercase letters
// Remember that setFilters inherits from pseudos
var n,r=i.pseudos[e]||i.setFilters[e.toLowerCase()]||oe.error("unsupported pseudo: "+e);
// The user may use createPseudo to indicate that
// arguments are needed to create the filter function
// just as Sizzle does
if(r[w]){return r(t)}
// But maintain support for old signatures
if(r.length>1){n=[e,e,"",t];return i.setFilters.hasOwnProperty(e.toLowerCase())?ae(function(e,n){var i,o=r(e,t),s=o.length;while(s--){i=L(e,o[s]);e[i]=!(n[i]=o[s])}}):function(e){return r(e,0,n)}}return r}},pseudos:{
// Potentially complex pseudos
not:ae(function(e){
// Trim the selector passed to compile
// to avoid treating leading and trailing
// spaces as combinators
var t=[],n=[],i=a(e.replace(W,"$1"));return i[w]?ae(function(e,t,n,r){var o,s=i(e,null,r,[]),a=e.length;
// Match elements unmatched by `matcher`
while(a--){if(o=s[a]){e[a]=!(t[a]=o)}}}):function(e,r,o){t[0]=e;i(t,null,o,n);
// Don't keep the element (issue #299)
t[0]=null;return!n.pop()}}),has:ae(function(e){return function(t){return oe(e,t).length>0}}),contains:ae(function(e){e=e.replace(Z,ee);return function(t){return(t.textContent||t.innerText||r(t)).indexOf(e)>-1}}),
// "Whether an element is represented by a :lang() selector
// is based solely on the element's language value
// being equal to the identifier C,
// or beginning with the identifier C immediately followed by "-".
// The matching of C against the element's language value is performed case-insensitively.
// The identifier C does not have to be a valid language name."
// http://www.w3.org/TR/selectors/#lang-pseudo
lang:ae(function(e){
// lang value must be a valid identifier
if(!V.test(e||"")){oe.error("unsupported lang: "+e)}e=e.replace(Z,ee).toLowerCase();return function(t){var n;do{if(n=g?t.lang:t.getAttribute("xml:lang")||t.getAttribute("lang")){n=n.toLowerCase();return n===e||n.indexOf(e+"-")===0}}while((t=t.parentNode)&&t.nodeType===1);return false}}),
// Miscellaneous
target:function(t){var n=e.location&&e.location.hash;return n&&n.slice(1)===t.id},root:function(e){return e===h},focus:function(e){return e===p.activeElement&&(!p.hasFocus||p.hasFocus())&&!!(e.type||e.href||~e.tabIndex)},
// Boolean properties
enabled:pe(false),disabled:pe(true),checked:function(e){
// In CSS3, :checked should return both checked and selected elements
// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
var t=e.nodeName.toLowerCase();return t==="input"&&!!e.checked||t==="option"&&!!e.selected},selected:function(e){
// Accessing this property makes selected-by-default
// options in Safari work properly
if(e.parentNode){e.parentNode.selectedIndex}return e.selected===true},
// Contents
empty:function(e){
// http://www.w3.org/TR/selectors/#empty-pseudo
// :empty is negated by element (1) or content nodes (text: 3; cdata: 4; entity ref: 5),
//   but not by others (comment: 8; processing instruction: 7; etc.)
// nodeType < 6 works because attributes (2) do not appear as children
for(e=e.firstChild;e;e=e.nextSibling){if(e.nodeType<6){return false}}return true},parent:function(e){return!i.pseudos["empty"](e)},
// Element/input types
header:function(e){return Y.test(e.nodeName)},input:function(e){return G.test(e.nodeName)},button:function(e){var t=e.nodeName.toLowerCase();return t==="input"&&e.type==="button"||t==="button"},text:function(e){var t;
// Support: IE<8
// New HTML5 attribute values (e.g., "search") appear with elem.type === "text"
return e.nodeName.toLowerCase()==="input"&&e.type==="text"&&((t=e.getAttribute("type"))==null||t.toLowerCase()==="text")},
// Position-in-collection
first:he(function(){return[0]}),last:he(function(e,t){return[t-1]}),eq:he(function(e,t,n){return[n<0?n+t:n]}),even:he(function(e,t){var n=0;for(;n<t;n+=2){e.push(n)}return e}),odd:he(function(e,t){var n=1;for(;n<t;n+=2){e.push(n)}return e}),lt:he(function(e,t,n){var i=n<0?n+t:n;for(;--i>=0;){e.push(i)}return e}),gt:he(function(e,t,n){var i=n<0?n+t:n;for(;++i<t;){e.push(i)}return e})}};i.pseudos["nth"]=i.pseudos["eq"];
// Add button/input type pseudos
for(t in{radio:true,checkbox:true,file:true,password:true,image:true}){i.pseudos[t]=ce(t)}for(t in{submit:true,reset:true}){i.pseudos[t]=de(t)}
// Easy API for creating new setFilters
function me(){}me.prototype=i.filters=i.pseudos;i.setFilters=new me;s=oe.tokenize=function(e,t){var n,r,o,s,a,l,f,u=k[e+" "];if(u){return t?0:u.slice(0)}a=e;l=[];f=i.preFilter;while(a){
// Comma and first run
if(!n||(r=M.exec(a))){if(r){
// Don't consume trailing commas as valid
a=a.slice(r[0].length)||a}l.push(o=[])}n=false;
// Combinators
if(r=_.exec(a)){n=r.shift();o.push({value:n,
// Cast descendant combinators to space
type:r[0].replace(W," ")});a=a.slice(n.length)}
// Filters
for(s in i.filter){if((r=X[s].exec(a))&&(!f[s]||(r=f[s](r)))){n=r.shift();o.push({value:n,type:s,matches:r});a=a.slice(n.length)}}if(!n){break}}
// Return the length of the invalid excess
// if we're just parsing
// Otherwise, throw an error or return tokens
// Cache the tokens
return t?a.length:a?oe.error(e):k(e,l).slice(0)};function ve(e){var t=0,n=e.length,i="";for(;t<n;t++){i+=e[t].value}return i}function ye(e,t,n){var i=t.dir,r=t.next,o=r||i,s=n&&o==="parentNode",a=C++;
// Check against closest ancestor/preceding element
// Check against all ancestor/preceding elements
return t.first?function(t,n,r){while(t=t[i]){if(t.nodeType===1||s){return e(t,n,r)}}return false}:function(t,n,l){var f,u,c,d=[T,a];
// We can't set arbitrary data on XML nodes, so they don't benefit from combinator caching
if(l){while(t=t[i]){if(t.nodeType===1||s){if(e(t,n,l)){return true}}}}else{while(t=t[i]){if(t.nodeType===1||s){c=t[w]||(t[w]={});
// Support: IE <9 only
// Defend against cloned attroperties (jQuery gh-1709)
u=c[t.uniqueID]||(c[t.uniqueID]={});if(r&&r===t.nodeName.toLowerCase()){t=t[i]||t}else if((f=u[o])&&f[0]===T&&f[1]===a){
// Assign to newCache so results back-propagate to previous elements
return d[2]=f[2]}else{
// Reuse newcache so results back-propagate to previous elements
u[o]=d;
// A match means we're done; a fail means we have to keep checking
if(d[2]=e(t,n,l)){return true}}}}}return false}}function be(e){return e.length>1?function(t,n,i){var r=e.length;while(r--){if(!e[r](t,n,i)){return false}}return true}:e[0]}function we(e,t,n){var i=0,r=t.length;for(;i<r;i++){oe(e,t[i],n)}return n}function xe(e,t,n,i,r){var o,s=[],a=0,l=e.length,f=t!=null;for(;a<l;a++){if(o=e[a]){if(!n||n(o,i,r)){s.push(o);if(f){t.push(a)}}}}return s}function Te(e,t,n,i,r,o){if(i&&!i[w]){i=Te(i)}if(r&&!r[w]){r=Te(r,o)}return ae(function(o,s,a,l){var f,u,c,d=[],p=[],h=s.length,
// Get initial elements from seed or context
g=o||we(t||"*",a.nodeType?[a]:a,[]),
// Prefilter to get matcher input, preserving a map for seed-results synchronization
m=e&&(o||!t)?xe(g,d,e,a,l):g,v=n?
// If we have a postFinder, or filtered seed, or non-seed postFilter or preexisting results,
r||(o?e:h||i)?
// ...intermediate processing is necessary
[]:
// ...otherwise use results directly
s:m;
// Find primary matches
if(n){n(m,v,a,l)}
// Apply postFilter
if(i){f=xe(v,p);i(f,[],a,l);
// Un-match failing elements by moving them back to matcherIn
u=f.length;while(u--){if(c=f[u]){v[p[u]]=!(m[p[u]]=c)}}}if(o){if(r||e){if(r){
// Get the final matcherOut by condensing this intermediate into postFinder contexts
f=[];u=v.length;while(u--){if(c=v[u]){
// Restore matcherIn since elem is not yet a final match
f.push(m[u]=c)}}r(null,v=[],f,l)}
// Move matched elements from seed to results to keep them synchronized
u=v.length;while(u--){if((c=v[u])&&(f=r?L(o,c):d[u])>-1){o[f]=!(s[f]=c)}}}}else{v=xe(v===s?v.splice(h,v.length):v);if(r){r(null,s,v,l)}else{O.apply(s,v)}}})}function Ce(e){var t,n,r,o=e.length,s=i.relative[e[0].type],a=s||i.relative[" "],l=s?1:0,
// The foundational matcher ensures that elements are reachable from top-level context(s)
u=ye(function(e){return e===t},a,true),c=ye(function(e){return L(t,e)>-1},a,true),d=[function(e,n,i){var r=!s&&(i||n!==f)||((t=n).nodeType?u(e,n,i):c(e,n,i));
// Avoid hanging onto element (issue #299)
t=null;return r}];for(;l<o;l++){if(n=i.relative[e[l].type]){d=[ye(be(d),n)]}else{n=i.filter[e[l].type].apply(null,e[l].matches);
// Return special upon seeing a positional matcher
if(n[w]){
// Find the next relative operator (if any) for proper handling
r=++l;for(;r<o;r++){if(i.relative[e[r].type]){break}}
// If the preceding token was a descendant combinator, insert an implicit any-element `*`
return Te(l>1&&be(d),l>1&&ve(e.slice(0,l-1).concat({value:e[l-2].type===" "?"*":""})).replace(W,"$1"),n,l<r&&Ce(e.slice(l,r)),r<o&&Ce(e=e.slice(r)),r<o&&ve(e))}d.push(n)}}return be(d)}function Ee(e,t){var n=t.length>0,r=e.length>0,o=function(o,s,a,l,u){var c,h,m,v=0,y="0",b=o&&[],w=[],x=f,
// We must always have either seed elements or outermost context
C=o||r&&i.find["TAG"]("*",u),
// Use integer dirruns iff this is the outermost matcher
E=T+=x==null?1:Math.random()||.1,k=C.length;if(u){f=s===p||s||u}
// Add elements passing elementMatchers directly to results
// Support: IE<9, Safari
// Tolerate NodeList properties (IE: "length"; Safari: <number>) matching elements by id
for(;y!==k&&(c=C[y])!=null;y++){if(r&&c){h=0;if(!s&&c.ownerDocument!==p){d(c);a=!g}while(m=e[h++]){if(m(c,s||p,a)){l.push(c);break}}if(u){T=E}}
// Track unmatched elements for set filters
if(n){
// They will have gone through all possible matchers
if(c=!m&&c){v--}
// Lengthen the array for every element, matched or not
if(o){b.push(c)}}}
// `i` is now the count of elements visited above, and adding it to `matchedCount`
// makes the latter nonnegative.
v+=y;
// Apply set filters to unmatched elements
// NOTE: This can be skipped if there are no unmatched elements (i.e., `matchedCount`
// equals `i`), unless we didn't visit _any_ elements in the above loop because we have
// no element matchers and no seed.
// Incrementing an initially-string "0" `i` allows `i` to remain a string only in that
// case, which will result in a "00" `matchedCount` that differs from `i` but is also
// numerically zero.
if(n&&y!==v){h=0;while(m=t[h++]){m(b,w,s,a)}if(o){
// Reintegrate element matches to eliminate the need for sorting
if(v>0){while(y--){if(!(b[y]||w[y])){w[y]=N.call(l)}}}
// Discard index placeholder values to get only actual matches
w=xe(w)}
// Add matches to results
O.apply(l,w);
// Seedless set matches succeeding multiple successful matchers stipulate sorting
if(u&&!o&&w.length>0&&v+t.length>1){oe.uniqueSort(l)}}
// Override manipulation of globals by nested matchers
if(u){T=E;f=x}return b};return n?ae(o):o}a=oe.compile=function(e,t){var n,i=[],r=[],o=S[e+" "];if(!o){
// Generate a function of recursive functions that can be used to check each element
if(!t){t=s(e)}n=t.length;while(n--){o=Ce(t[n]);if(o[w]){i.push(o)}else{r.push(o)}}
// Cache the compiled function
o=S(e,Ee(r,i));
// Save selector and tokenization
o.selector=e}return o};/**
 * A low-level selection function that works with Sizzle's compiled
 *  selector functions
 * @param {String|Function} selector A selector or a pre-compiled
 *  selector function built with Sizzle.compile
 * @param {Element} context
 * @param {Array} [results]
 * @param {Array} [seed] A set of elements to match against
 */
l=oe.select=function(e,t,n,r){var o,l,f,u,c,d=typeof e==="function"&&e,p=!r&&s(e=d.selector||e);n=n||[];
// Try to minimize operations if there is only one selector in the list and no seed
// (the latter of which guarantees us context)
if(p.length===1){
// Reduce context if the leading compound selector is an ID
l=p[0]=p[0].slice(0);if(l.length>2&&(f=l[0]).type==="ID"&&t.nodeType===9&&g&&i.relative[l[1].type]){t=(i.find["ID"](f.matches[0].replace(Z,ee),t)||[])[0];if(!t){return n}else if(d){t=t.parentNode}e=e.slice(l.shift().value.length)}
// Fetch a seed set for right-to-left matching
o=X["needsContext"].test(e)?0:l.length;while(o--){f=l[o];
// Abort if we hit a combinator
if(i.relative[u=f.type]){break}if(c=i.find[u]){
// Search, expanding context for leading sibling combinators
if(r=c(f.matches[0].replace(Z,ee),J.test(l[0].type)&&ge(t.parentNode)||t)){
// If seed is empty or no tokens remain, we can return early
l.splice(o,1);e=r.length&&ve(l);if(!e){O.apply(n,r);return n}break}}}}
// Compile and execute a filtering function if one is not provided
// Provide `match` to avoid retokenization if we modified the selector above
(d||a(e,p))(r,t,!g,n,!t||J.test(e)&&ge(t.parentNode)||t);return n};
// One-time assignments
// Sort stability
n.sortStable=w.split("").sort($).join("")===w;
// Support: Chrome 14-35+
// Always assume duplicates if they aren't passed to the comparison function
n.detectDuplicates=!!c;
// Initialize against the default document
d();
// Support: Webkit<537.32 - Safari 6.0.3/Chrome 25 (fixed in Chrome 27)
// Detached nodes confoundingly follow *each other*
n.sortDetached=le(function(e){
// Should return 1, but returns 4 (following)
return e.compareDocumentPosition(p.createElement("fieldset"))&1});
// Support: IE<8
// Prevent attribute/property "interpolation"
// https://msdn.microsoft.com/en-us/library/ms536429%28VS.85%29.aspx
if(!le(function(e){e.innerHTML="<a href='#'></a>";return e.firstChild.getAttribute("href")==="#"})){fe("type|href|height|width",function(e,t,n){if(!n){return e.getAttribute(t,t.toLowerCase()==="type"?1:2)}})}
// Support: IE<9
// Use defaultValue in place of getAttribute("value")
if(!n.attributes||!le(function(e){e.innerHTML="<input/>";e.firstChild.setAttribute("value","");return e.firstChild.getAttribute("value")===""})){fe("value",function(e,t,n){if(!n&&e.nodeName.toLowerCase()==="input"){return e.defaultValue}})}
// Support: IE<9
// Use getAttributeNode to fetch booleans when getAttribute lies
if(!le(function(e){return e.getAttribute("disabled")==null})){fe(R,function(e,t,n){var i;if(!n){return e[t]===true?t.toLowerCase():(i=e.getAttributeNode(t))&&i.specified?i.value:null}})}return oe}(n);x.find=$;x.expr=$.selectors;
// Deprecated
x.expr[":"]=x.expr.pseudos;x.uniqueSort=x.unique=$.uniqueSort;x.text=$.getText;x.isXMLDoc=$.isXML;x.contains=$.contains;x.escapeSelector=$.escape;var D=function(e,t,n){var i=[],r=n!==undefined;while((e=e[t])&&e.nodeType!==9){if(e.nodeType===1){if(r&&x(e).is(n)){break}i.push(e)}}return i};var A=function(e,t){var n=[];for(;e;e=e.nextSibling){if(e.nodeType===1&&e!==t){n.push(e)}}return n};var N=x.expr.match.needsContext;function j(e,t){return e.nodeName&&e.nodeName.toLowerCase()===t.toLowerCase()}var O=/^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i;var I=/^.[^:#\[\.,]*$/;
// Implement the identical functionality for filter and not
function L(e,t,n){if(x.isFunction(t)){return x.grep(e,function(e,i){return!!t.call(e,i,e)!==n})}
// Single element
if(t.nodeType){return x.grep(e,function(e){return e===t!==n})}
// Arraylike of elements (jQuery, arguments, Array)
if(typeof t!=="string"){return x.grep(e,function(e){return d.call(t,e)>-1!==n})}
// Simple selector that can be filtered directly, removing non-Elements
if(I.test(t)){return x.filter(t,e,n)}
// Complex selector, compare the two sets, removing non-Elements
t=x.filter(t,e);return x.grep(e,function(e){return d.call(t,e)>-1!==n&&e.nodeType===1})}x.filter=function(e,t,n){var i=t[0];if(n){e=":not("+e+")"}if(t.length===1&&i.nodeType===1){return x.find.matchesSelector(i,e)?[i]:[]}return x.find.matches(e,x.grep(t,function(e){return e.nodeType===1}))};x.fn.extend({find:function(e){var t,n,i=this.length,r=this;if(typeof e!=="string"){return this.pushStack(x(e).filter(function(){for(t=0;t<i;t++){if(x.contains(r[t],this)){return true}}}))}n=this.pushStack([]);for(t=0;t<i;t++){x.find(e,r[t],n)}return i>1?x.uniqueSort(n):n},filter:function(e){return this.pushStack(L(this,e||[],false))},not:function(e){return this.pushStack(L(this,e||[],true))},is:function(e){
// If this is a positional/relative selector, check membership in the returned set
// so $("p:first").is("p:last") won't return true for a doc with two "p".
return!!L(this,typeof e==="string"&&N.test(e)?x(e):e||[],false).length}});
// Initialize a jQuery object
// A central reference to the root jQuery(document)
var R,
// A simple way to check for HTML strings
// Prioritize #id over <tag> to avoid XSS via location.hash (#9521)
// Strict HTML recognition (#11290: must start with <)
// Shortcut simple #id case for speed
P=/^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/,q=x.fn.init=function(e,t,n){var i,r;
// HANDLE: $(""), $(null), $(undefined), $(false)
if(!e){return this}
// Method init() accepts an alternate rootjQuery
// so migrate can support jQuery.sub (gh-2101)
n=n||R;
// Handle HTML strings
if(typeof e==="string"){if(e[0]==="<"&&e[e.length-1]===">"&&e.length>=3){
// Assume that strings that start and end with <> are HTML and skip the regex check
i=[null,e,null]}else{i=P.exec(e)}
// Match html or make sure no context is specified for #id
if(i&&(i[1]||!t)){
// HANDLE: $(html) -> $(array)
if(i[1]){t=t instanceof x?t[0]:t;
// Option to run scripts is true for back-compat
// Intentionally let the error be thrown if parseHTML is not present
x.merge(this,x.parseHTML(i[1],t&&t.nodeType?t.ownerDocument||t:a,true));
// HANDLE: $(html, props)
if(O.test(i[1])&&x.isPlainObject(t)){for(i in t){
// Properties of context are called as methods if possible
if(x.isFunction(this[i])){this[i](t[i])}else{this.attr(i,t[i])}}}return this}else{r=a.getElementById(i[2]);if(r){
// Inject the element directly into the jQuery object
this[0]=r;this.length=1}return this}}else if(!t||t.jquery){return(t||n).find(e)}else{return this.constructor(t).find(e)}}else if(e.nodeType){this[0]=e;this.length=1;return this}else if(x.isFunction(e)){
// Execute immediately if ready is not present
return n.ready!==undefined?n.ready(e):e(x)}return x.makeArray(e,this)};
// Give the init function the jQuery prototype for later instantiation
q.prototype=x.fn;
// Initialize central reference
R=x(a);var F=/^(?:parents|prev(?:Until|All))/,
// Methods guaranteed to produce a unique set when starting from a unique set
H={children:true,contents:true,next:true,prev:true};x.fn.extend({has:function(e){var t=x(e,this),n=t.length;return this.filter(function(){var e=0;for(;e<n;e++){if(x.contains(this,t[e])){return true}}})},closest:function(e,t){var n,i=0,r=this.length,o=[],s=typeof e!=="string"&&x(e);
// Positional selectors never match, since there's no _selection_ context
if(!N.test(e)){for(;i<r;i++){for(n=this[i];n&&n!==t;n=n.parentNode){
// Always skip document fragments
if(n.nodeType<11&&(s?s.index(n)>-1:
// Don't pass non-elements to Sizzle
n.nodeType===1&&x.find.matchesSelector(n,e))){o.push(n);break}}}}return this.pushStack(o.length>1?x.uniqueSort(o):o)},
// Determine the position of an element within the set
index:function(e){
// No argument, return index in parent
if(!e){return this[0]&&this[0].parentNode?this.first().prevAll().length:-1}
// Index in selector
if(typeof e==="string"){return d.call(x(e),this[0])}
// Locate the position of the desired element
// If it receives a jQuery object, the first element is used
return d.call(this,e.jquery?e[0]:e)},add:function(e,t){return this.pushStack(x.uniqueSort(x.merge(this.get(),x(e,t))))},addBack:function(e){return this.add(e==null?this.prevObject:this.prevObject.filter(e))}});function B(e,t){while((e=e[t])&&e.nodeType!==1){}return e}x.each({parent:function(e){var t=e.parentNode;return t&&t.nodeType!==11?t:null},parents:function(e){return D(e,"parentNode")},parentsUntil:function(e,t,n){return D(e,"parentNode",n)},next:function(e){return B(e,"nextSibling")},prev:function(e){return B(e,"previousSibling")},nextAll:function(e){return D(e,"nextSibling")},prevAll:function(e){return D(e,"previousSibling")},nextUntil:function(e,t,n){return D(e,"nextSibling",n)},prevUntil:function(e,t,n){return D(e,"previousSibling",n)},siblings:function(e){return A((e.parentNode||{}).firstChild,e)},children:function(e){return A(e.firstChild)},contents:function(e){if(j(e,"iframe")){return e.contentDocument}
// Support: IE 9 - 11 only, iOS 7 only, Android Browser <=4.3 only
// Treat the template element as a regular one in browsers that
// don't support it.
if(j(e,"template")){e=e.content||e}return x.merge([],e.childNodes)}},function(e,t){x.fn[e]=function(n,i){var r=x.map(this,t,n);if(e.slice(-5)!=="Until"){i=n}if(i&&typeof i==="string"){r=x.filter(i,r)}if(this.length>1){
// Remove duplicates
if(!H[e]){x.uniqueSort(r)}
// Reverse order for parents* and prev-derivatives
if(F.test(e)){r.reverse()}}return this.pushStack(r)}});var W=/[^\x20\t\r\n\f]+/g;
// Convert String-formatted options into Object-formatted ones
function M(e){var t={};x.each(e.match(W)||[],function(e,n){t[n]=true});return t}/*
 * Create a callback list using the following parameters:
 *
 *	options: an optional list of space-separated options that will change how
 *			the callback list behaves or a more traditional option object
 *
 * By default a callback list will act like an event callback list and can be
 * "fired" multiple times.
 *
 * Possible options:
 *
 *	once:			will ensure the callback list can only be fired once (like a Deferred)
 *
 *	memory:			will keep track of previous values and will call any callback added
 *					after the list has been fired right away with the latest "memorized"
 *					values (like a Deferred)
 *
 *	unique:			will ensure a callback can only be added once (no duplicate in the list)
 *
 *	stopOnFalse:	interrupt callings when a callback returns false
 *
 */
x.Callbacks=function(e){
// Convert options from String-formatted to Object-formatted if needed
// (we check in cache first)
e=typeof e==="string"?M(e):x.extend({},e);var// Flag to know if list is currently firing
t,
// Last fire value for non-forgettable lists
n,
// Flag to know if list was already fired
i,
// Flag to prevent firing
r,
// Actual callback list
o=[],
// Queue of execution data for repeatable lists
s=[],
// Index of currently firing callback (modified by add/remove as needed)
a=-1,
// Fire callbacks
l=function(){
// Enforce single-firing
r=r||e.once;
// Execute callbacks for all pending executions,
// respecting firingIndex overrides and runtime changes
i=t=true;for(;s.length;a=-1){n=s.shift();while(++a<o.length){
// Run callback and check for early termination
if(o[a].apply(n[0],n[1])===false&&e.stopOnFalse){
// Jump to end and forget the data so .add doesn't re-fire
a=o.length;n=false}}}
// Forget the data if we're done with it
if(!e.memory){n=false}t=false;
// Clean up if we're done firing for good
if(r){
// Keep an empty list if we have data for future add calls
if(n){o=[]}else{o=""}}},
// Actual Callbacks object
f={
// Add a callback or a collection of callbacks to the list
add:function(){if(o){
// If we have memory from a past run, we should fire after adding
if(n&&!t){a=o.length-1;s.push(n)}(function t(n){x.each(n,function(n,i){if(x.isFunction(i)){if(!e.unique||!f.has(i)){o.push(i)}}else if(i&&i.length&&x.type(i)!=="string"){
// Inspect recursively
t(i)}})})(arguments);if(n&&!t){l()}}return this},
// Remove a callback from the list
remove:function(){x.each(arguments,function(e,t){var n;while((n=x.inArray(t,o,n))>-1){o.splice(n,1);
// Handle firing indexes
if(n<=a){a--}}});return this},
// Check if a given callback is in the list.
// If no argument is given, return whether or not list has callbacks attached.
has:function(e){return e?x.inArray(e,o)>-1:o.length>0},
// Remove all callbacks from the list
empty:function(){if(o){o=[]}return this},
// Disable .fire and .add
// Abort any current/pending executions
// Clear all callbacks and values
disable:function(){r=s=[];o=n="";return this},disabled:function(){return!o},
// Disable .fire
// Also disable .add unless we have memory (since it would have no effect)
// Abort any pending executions
lock:function(){r=s=[];if(!n&&!t){o=n=""}return this},locked:function(){return!!r},
// Call all callbacks with the given context and arguments
fireWith:function(e,n){if(!r){n=n||[];n=[e,n.slice?n.slice():n];s.push(n);if(!t){l()}}return this},
// Call all the callbacks with the given arguments
fire:function(){f.fireWith(this,arguments);return this},
// To know if the callbacks have already been called at least once
fired:function(){return!!i}};return f};function _(e){return e}function U(e){throw e}function z(e,t,n,i){var r;try{
// Check for promise aspect first to privilege synchronous behavior
if(e&&x.isFunction(r=e.promise)){r.call(e).done(t).fail(n)}else if(e&&x.isFunction(r=e.then)){r.call(e,t,n)}else{
// Control `resolve` arguments by letting Array#slice cast boolean `noValue` to integer:
// * false: [ value ].slice( 0 ) => resolve( value )
// * true: [ value ].slice( 1 ) => resolve()
t.apply(undefined,[e].slice(i))}}catch(e){
// Support: Android 4.0 only
// Strict mode functions invoked without .call/.apply get global-object context
n.apply(undefined,[e])}}x.extend({Deferred:function(e){var t=[
// action, add listener, callbacks,
// ... .then handlers, argument index, [final state]
["notify","progress",x.Callbacks("memory"),x.Callbacks("memory"),2],["resolve","done",x.Callbacks("once memory"),x.Callbacks("once memory"),0,"resolved"],["reject","fail",x.Callbacks("once memory"),x.Callbacks("once memory"),1,"rejected"]],i="pending",r={state:function(){return i},always:function(){o.done(arguments).fail(arguments);return this},catch:function(e){return r.then(null,e)},
// Keep pipe for back-compat
pipe:function(){var e=arguments;return x.Deferred(function(n){x.each(t,function(t,i){
// Map tuples (progress, done, fail) to arguments (done, fail, progress)
var r=x.isFunction(e[i[4]])&&e[i[4]];
// deferred.progress(function() { bind to newDefer or newDefer.notify })
// deferred.done(function() { bind to newDefer or newDefer.resolve })
// deferred.fail(function() { bind to newDefer or newDefer.reject })
o[i[1]](function(){var e=r&&r.apply(this,arguments);if(e&&x.isFunction(e.promise)){e.promise().progress(n.notify).done(n.resolve).fail(n.reject)}else{n[i[0]+"With"](this,r?[e]:arguments)}})});e=null}).promise()},then:function(e,i,r){var o=0;function s(e,t,i,r){return function(){var a=this,l=arguments,f=function(){var n,f;
// Support: Promises/A+ section 2.3.3.3.3
// https://promisesaplus.com/#point-59
// Ignore double-resolution attempts
if(e<o){return}n=i.apply(a,l);
// Support: Promises/A+ section 2.3.1
// https://promisesaplus.com/#point-48
if(n===t.promise()){throw new TypeError("Thenable self-resolution")}
// Support: Promises/A+ sections 2.3.3.1, 3.5
// https://promisesaplus.com/#point-54
// https://promisesaplus.com/#point-75
// Retrieve `then` only once
f=n&&(
// Support: Promises/A+ section 2.3.4
// https://promisesaplus.com/#point-64
// Only check objects and functions for thenability
typeof n==="object"||typeof n==="function")&&n.then;
// Handle a returned thenable
if(x.isFunction(f)){
// Special processors (notify) just wait for resolution
if(r){f.call(n,s(o,t,_,r),s(o,t,U,r))}else{
// ...and disregard older resolution values
o++;f.call(n,s(o,t,_,r),s(o,t,U,r),s(o,t,_,t.notifyWith))}}else{
// Only substitute handlers pass on context
// and multiple values (non-spec behavior)
if(i!==_){a=undefined;l=[n]}
// Process the value(s)
// Default process is resolve
(r||t.resolveWith)(a,l)}},
// Only normal processors (resolve) catch and reject exceptions
u=r?f:function(){try{f()}catch(n){if(x.Deferred.exceptionHook){x.Deferred.exceptionHook(n,u.stackTrace)}
// Support: Promises/A+ section 2.3.3.3.4.1
// https://promisesaplus.com/#point-61
// Ignore post-resolution exceptions
if(e+1>=o){
// Only substitute handlers pass on context
// and multiple values (non-spec behavior)
if(i!==U){a=undefined;l=[n]}t.rejectWith(a,l)}}};
// Support: Promises/A+ section 2.3.3.3.1
// https://promisesaplus.com/#point-57
// Re-resolve promises immediately to dodge false rejection from
// subsequent errors
if(e){u()}else{
// Call an optional hook to record the stack, in case of exception
// since it's otherwise lost when execution goes async
if(x.Deferred.getStackHook){u.stackTrace=x.Deferred.getStackHook()}n.setTimeout(u)}}}return x.Deferred(function(n){
// progress_handlers.add( ... )
t[0][3].add(s(0,n,x.isFunction(r)?r:_,n.notifyWith));
// fulfilled_handlers.add( ... )
t[1][3].add(s(0,n,x.isFunction(e)?e:_));
// rejected_handlers.add( ... )
t[2][3].add(s(0,n,x.isFunction(i)?i:U))}).promise()},
// Get a promise for this deferred
// If obj is provided, the promise aspect is added to the object
promise:function(e){return e!=null?x.extend(e,r):r}},o={};
// Add list-specific methods
x.each(t,function(e,n){var s=n[2],a=n[5];
// promise.progress = list.add
// promise.done = list.add
// promise.fail = list.add
r[n[1]]=s.add;
// Handle state
if(a){s.add(function(){
// state = "resolved" (i.e., fulfilled)
// state = "rejected"
i=a},
// rejected_callbacks.disable
// fulfilled_callbacks.disable
t[3-e][2].disable,
// progress_callbacks.lock
t[0][2].lock)}
// progress_handlers.fire
// fulfilled_handlers.fire
// rejected_handlers.fire
s.add(n[3].fire);
// deferred.notify = function() { deferred.notifyWith(...) }
// deferred.resolve = function() { deferred.resolveWith(...) }
// deferred.reject = function() { deferred.rejectWith(...) }
o[n[0]]=function(){o[n[0]+"With"](this===o?undefined:this,arguments);return this};
// deferred.notifyWith = list.fireWith
// deferred.resolveWith = list.fireWith
// deferred.rejectWith = list.fireWith
o[n[0]+"With"]=s.fireWith});
// Make the deferred a promise
r.promise(o);
// Call given func if any
if(e){e.call(o,o)}
// All done!
return o},
// Deferred helper
when:function(e){var
// count of uncompleted subordinates
t=arguments.length,
// count of unprocessed arguments
n=t,
// subordinate fulfillment data
i=Array(n),r=f.call(arguments),
// the master Deferred
o=x.Deferred(),
// subordinate callback factory
s=function(e){return function(n){i[e]=this;r[e]=arguments.length>1?f.call(arguments):n;if(!--t){o.resolveWith(i,r)}}};
// Single- and empty arguments are adopted like Promise.resolve
if(t<=1){z(e,o.done(s(n)).resolve,o.reject,!t);
// Use .then() to unwrap secondary thenables (cf. gh-3000)
if(o.state()==="pending"||x.isFunction(r[n]&&r[n].then)){return o.then()}}
// Multiple arguments are aggregated like Promise.all array elements
while(n--){z(r[n],s(n),o.reject)}return o.promise()}});
// These usually indicate a programmer mistake during development,
// warn about them ASAP rather than swallowing them by default.
var V=/^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;x.Deferred.exceptionHook=function(e,t){
// Support: IE 8 - 9 only
// Console exists when dev tools are open, which can happen at any time
if(n.console&&n.console.warn&&e&&V.test(e.name)){n.console.warn("jQuery.Deferred exception: "+e.message,e.stack,t)}};x.readyException=function(e){n.setTimeout(function(){throw e})};
// The deferred used on DOM ready
var X=x.Deferred();x.fn.ready=function(e){X.then(e).catch(function(e){x.readyException(e)});return this};x.extend({
// Is the DOM ready to be used? Set to true once it occurs.
isReady:false,
// A counter to track how many items to wait for before
// the ready event fires. See #6781
readyWait:1,
// Handle when the DOM is ready
ready:function(e){
// Abort if there are pending holds or we're already ready
if(e===true?--x.readyWait:x.isReady){return}
// Remember that the DOM is ready
x.isReady=true;
// If a normal DOM Ready event fired, decrement, and wait if need be
if(e!==true&&--x.readyWait>0){return}
// If there are functions bound, to execute
X.resolveWith(a,[x])}});x.ready.then=X.then;
// The ready event handler and self cleanup method
function G(){a.removeEventListener("DOMContentLoaded",G);n.removeEventListener("load",G);x.ready()}
// Catch cases where $(document).ready() is called
// after the browser event has already occurred.
// Support: IE <=9 - 10 only
// Older IE sometimes signals "interactive" too soon
if(a.readyState==="complete"||a.readyState!=="loading"&&!a.documentElement.doScroll){
// Handle it asynchronously to allow scripts the opportunity to delay ready
n.setTimeout(x.ready)}else{
// Use the handy event callback
a.addEventListener("DOMContentLoaded",G);
// A fallback to window.onload, that will always work
n.addEventListener("load",G)}
// Multifunctional method to get and set values of a collection
// The value/s can optionally be executed if it's a function
var Y=function(e,t,n,i,r,o,s){var a=0,l=e.length,f=n==null;
// Sets many values
if(x.type(n)==="object"){r=true;for(a in n){Y(e,t,a,n[a],true,o,s)}}else if(i!==undefined){r=true;if(!x.isFunction(i)){s=true}if(f){
// Bulk operations run against the entire set
if(s){t.call(e,i);t=null}else{f=t;t=function(e,t,n){return f.call(x(e),n)}}}if(t){for(;a<l;a++){t(e[a],n,s?i:i.call(e[a],a,t(e[a],n)))}}}if(r){return e}
// Gets
if(f){return t.call(e)}return l?t(e[0],n):o};var K=function(e){
// Accepts only:
//  - Node
//    - Node.ELEMENT_NODE
//    - Node.DOCUMENT_NODE
//  - Object
//    - Any
return e.nodeType===1||e.nodeType===9||!+e.nodeType};function Q(){this.expando=x.expando+Q.uid++}Q.uid=1;Q.prototype={cache:function(e){
// Check if the owner object already has a cache
var t=e[this.expando];
// If not, create one
if(!t){t={};
// We can accept data for non-element nodes in modern browsers,
// but we should not, see #8335.
// Always return an empty object.
if(K(e)){
// If it is a node unlikely to be stringify-ed or looped over
// use plain assignment
if(e.nodeType){e[this.expando]=t}else{Object.defineProperty(e,this.expando,{value:t,configurable:true})}}}return t},set:function(e,t,n){var i,r=this.cache(e);
// Handle: [ owner, key, value ] args
// Always use camelCase key (gh-2257)
if(typeof t==="string"){r[x.camelCase(t)]=n}else{
// Copy the properties one-by-one to the cache object
for(i in t){r[x.camelCase(i)]=t[i]}}return r},get:function(e,t){
// Always use camelCase key (gh-2257)
return t===undefined?this.cache(e):e[this.expando]&&e[this.expando][x.camelCase(t)]},access:function(e,t,n){
// In cases where either:
//
//   1. No key was specified
//   2. A string key was specified, but no value provided
//
// Take the "read" path and allow the get method to determine
// which value to return, respectively either:
//
//   1. The entire cache object
//   2. The data stored at the key
//
if(t===undefined||t&&typeof t==="string"&&n===undefined){return this.get(e,t)}
// When the key is not a string, or both a key and value
// are specified, set or extend (existing objects) with either:
//
//   1. An object of properties
//   2. A key and value
//
this.set(e,t,n);
// Since the "set" path can have two possible entry points
// return the expected data based on which path was taken[*]
return n!==undefined?n:t},remove:function(e,t){var n,i=e[this.expando];if(i===undefined){return}if(t!==undefined){
// Support array or space separated string of keys
if(Array.isArray(t)){
// If key is an array of keys...
// We always set camelCase keys, so remove that.
t=t.map(x.camelCase)}else{t=x.camelCase(t);
// If a key with the spaces exists, use it.
// Otherwise, create an array by matching non-whitespace
t=t in i?[t]:t.match(W)||[]}n=t.length;while(n--){delete i[t[n]]}}
// Remove the expando if there's no more data
if(t===undefined||x.isEmptyObject(i)){
// Support: Chrome <=35 - 45
// Webkit & Blink performance suffers when deleting properties
// from DOM nodes, so set to undefined instead
// https://bugs.chromium.org/p/chromium/issues/detail?id=378607 (bug restricted)
if(e.nodeType){e[this.expando]=undefined}else{delete e[this.expando]}}},hasData:function(e){var t=e[this.expando];return t!==undefined&&!x.isEmptyObject(t)}};var J=new Q;var Z=new Q;
//	Implementation Summary
//
//	1. Enforce API surface and semantic compatibility with 1.9.x branch
//	2. Improve the module's maintainability by reducing the storage
//		paths to a single mechanism.
//	3. Use the same single mechanism to support "private" and "user" data.
//	4. _Never_ expose "private" data to user code (TODO: Drop _data, _removeData)
//	5. Avoid exposing implementation details on user objects (eg. expando properties)
//	6. Provide a clear path for implementation upgrade to WeakMap in 2014
var ee=/^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,te=/[A-Z]/g;function ne(e){if(e==="true"){return true}if(e==="false"){return false}if(e==="null"){return null}
// Only convert to a number if it doesn't change the string
if(e===+e+""){return+e}if(ee.test(e)){return JSON.parse(e)}return e}function ie(e,t,n){var i;
// If nothing was found internally, try to fetch any
// data from the HTML5 data-* attribute
if(n===undefined&&e.nodeType===1){i="data-"+t.replace(te,"-$&").toLowerCase();n=e.getAttribute(i);if(typeof n==="string"){try{n=ne(n)}catch(e){}
// Make sure we set the data so it isn't changed later
Z.set(e,t,n)}else{n=undefined}}return n}x.extend({hasData:function(e){return Z.hasData(e)||J.hasData(e)},data:function(e,t,n){return Z.access(e,t,n)},removeData:function(e,t){Z.remove(e,t)},
// TODO: Now that all calls to _data and _removeData have been replaced
// with direct calls to dataPriv methods, these can be deprecated.
_data:function(e,t,n){return J.access(e,t,n)},_removeData:function(e,t){J.remove(e,t)}});x.fn.extend({data:function(e,t){var n,i,r,o=this[0],s=o&&o.attributes;
// Gets all values
if(e===undefined){if(this.length){r=Z.get(o);if(o.nodeType===1&&!J.get(o,"hasDataAttrs")){n=s.length;while(n--){
// Support: IE 11 only
// The attrs elements can be null (#14894)
if(s[n]){i=s[n].name;if(i.indexOf("data-")===0){i=x.camelCase(i.slice(5));ie(o,i,r[i])}}}J.set(o,"hasDataAttrs",true)}}return r}
// Sets multiple values
if(typeof e==="object"){return this.each(function(){Z.set(this,e)})}return Y(this,function(t){var n;
// The calling jQuery object (element matches) is not empty
// (and therefore has an element appears at this[ 0 ]) and the
// `value` parameter was not undefined. An empty jQuery object
// will result in `undefined` for elem = this[ 0 ] which will
// throw an exception if an attempt to read a data cache is made.
if(o&&t===undefined){
// Attempt to get data from the cache
// The key will always be camelCased in Data
n=Z.get(o,e);if(n!==undefined){return n}
// Attempt to "discover" the data in
// HTML5 custom data-* attrs
n=ie(o,e);if(n!==undefined){return n}
// We tried really hard, but the data doesn't exist.
return}
// Set the data...
this.each(function(){
// We always store the camelCased key
Z.set(this,e,t)})},null,t,arguments.length>1,null,true)},removeData:function(e){return this.each(function(){Z.remove(this,e)})}});x.extend({queue:function(e,t,n){var i;if(e){t=(t||"fx")+"queue";i=J.get(e,t);
// Speed up dequeue by getting out quickly if this is just a lookup
if(n){if(!i||Array.isArray(n)){i=J.access(e,t,x.makeArray(n))}else{i.push(n)}}return i||[]}},dequeue:function(e,t){t=t||"fx";var n=x.queue(e,t),i=n.length,r=n.shift(),o=x._queueHooks(e,t),s=function(){x.dequeue(e,t)};
// If the fx queue is dequeued, always remove the progress sentinel
if(r==="inprogress"){r=n.shift();i--}if(r){
// Add a progress sentinel to prevent the fx queue from being
// automatically dequeued
if(t==="fx"){n.unshift("inprogress")}
// Clear up the last queue stop function
delete o.stop;r.call(e,s,o)}if(!i&&o){o.empty.fire()}},
// Not public - generate a queueHooks object, or return the current one
_queueHooks:function(e,t){var n=t+"queueHooks";return J.get(e,n)||J.access(e,n,{empty:x.Callbacks("once memory").add(function(){J.remove(e,[t+"queue",n])})})}});x.fn.extend({queue:function(e,t){var n=2;if(typeof e!=="string"){t=e;e="fx";n--}if(arguments.length<n){return x.queue(this[0],e)}return t===undefined?this:this.each(function(){var n=x.queue(this,e,t);
// Ensure a hooks for this queue
x._queueHooks(this,e);if(e==="fx"&&n[0]!=="inprogress"){x.dequeue(this,e)}})},dequeue:function(e){return this.each(function(){x.dequeue(this,e)})},clearQueue:function(e){return this.queue(e||"fx",[])},
// Get a promise resolved when queues of a certain type
// are emptied (fx is the type by default)
promise:function(e,t){var n,i=1,r=x.Deferred(),o=this,s=this.length,a=function(){if(!--i){r.resolveWith(o,[o])}};if(typeof e!=="string"){t=e;e=undefined}e=e||"fx";while(s--){n=J.get(o[s],e+"queueHooks");if(n&&n.empty){i++;n.empty.add(a)}}a();return r.promise(t)}});var re=/[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source;var oe=new RegExp("^(?:([+-])=|)("+re+")([a-z%]*)$","i");var se=["Top","Right","Bottom","Left"];var ae=function(e,t){
// isHiddenWithinTree might be called from jQuery#filter function;
// in that case, element will be second argument
e=t||e;
// Inline style trumps all
// Otherwise, check computed style
// Support: Firefox <=43 - 45
// Disconnected elements can have computed display: none, so first confirm that elem is
// in the document.
return e.style.display==="none"||e.style.display===""&&x.contains(e.ownerDocument,e)&&x.css(e,"display")==="none"};var le=function(e,t,n,i){var r,o,s={};
// Remember the old values, and insert the new ones
for(o in t){s[o]=e.style[o];e.style[o]=t[o]}r=n.apply(e,i||[]);
// Revert the old values
for(o in t){e.style[o]=s[o]}return r};function fe(e,t,n,i){var r,o=1,s=20,a=i?function(){return i.cur()}:function(){return x.css(e,t,"")},l=a(),f=n&&n[3]||(x.cssNumber[t]?"":"px"),
// Starting value computation is required for potential unit mismatches
u=(x.cssNumber[t]||f!=="px"&&+l)&&oe.exec(x.css(e,t));if(u&&u[3]!==f){
// Trust units reported by jQuery.css
f=f||u[3];
// Make sure we update the tween properties later on
n=n||[];
// Iteratively approximate from a nonzero starting point
u=+l||1;do{
// If previous iteration zeroed out, double until we get *something*.
// Use string for doubling so we don't accidentally see scale as unchanged below
o=o||".5";
// Adjust and apply
u=u/o;x.style(e,t,u+f)}while(o!==(o=a()/l)&&o!==1&&--s)}if(n){u=+u||+l||0;
// Apply relative offset (+=/-=) if specified
r=n[1]?u+(n[1]+1)*n[2]:+n[2];if(i){i.unit=f;i.start=u;i.end=r}}return r}var ue={};function ce(e){var t,n=e.ownerDocument,i=e.nodeName,r=ue[i];if(r){return r}t=n.body.appendChild(n.createElement(i));r=x.css(t,"display");t.parentNode.removeChild(t);if(r==="none"){r="block"}ue[i]=r;return r}function de(e,t){var n,i,r=[],o=0,s=e.length;
// Determine new display value for elements that need to change
for(;o<s;o++){i=e[o];if(!i.style){continue}n=i.style.display;if(t){
// Since we force visibility upon cascade-hidden elements, an immediate (and slow)
// check is required in this first loop unless we have a nonempty display value (either
// inline or about-to-be-restored)
if(n==="none"){r[o]=J.get(i,"display")||null;if(!r[o]){i.style.display=""}}if(i.style.display===""&&ae(i)){r[o]=ce(i)}}else{if(n!=="none"){r[o]="none";
// Remember what we're overwriting
J.set(i,"display",n)}}}
// Set the display of the elements in a second loop to avoid constant reflow
for(o=0;o<s;o++){if(r[o]!=null){e[o].style.display=r[o]}}return e}x.fn.extend({show:function(){return de(this,true)},hide:function(){return de(this)},toggle:function(e){if(typeof e==="boolean"){return e?this.show():this.hide()}return this.each(function(){if(ae(this)){x(this).show()}else{x(this).hide()}})}});var pe=/^(?:checkbox|radio)$/i;var he=/<([a-z][^\/\0>\x20\t\r\n\f]+)/i;var ge=/^$|\/(?:java|ecma)script/i;
// We have to close these tags to support XHTML (#13200)
var me={
// Support: IE <=9 only
option:[1,"<select multiple='multiple'>","</select>"],
// XHTML parsers do not magically insert elements in the
// same way that tag soup parsers do. So we cannot shorten
// this by omitting <tbody> or other required elements.
thead:[1,"<table>","</table>"],col:[2,"<table><colgroup>","</colgroup></table>"],tr:[2,"<table><tbody>","</tbody></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],_default:[0,"",""]};
// Support: IE <=9 only
me.optgroup=me.option;me.tbody=me.tfoot=me.colgroup=me.caption=me.thead;me.th=me.td;function ve(e,t){
// Support: IE <=9 - 11 only
// Use typeof to avoid zero-argument method invocation on host objects (#15151)
var n;if(typeof e.getElementsByTagName!=="undefined"){n=e.getElementsByTagName(t||"*")}else if(typeof e.querySelectorAll!=="undefined"){n=e.querySelectorAll(t||"*")}else{n=[]}if(t===undefined||t&&j(e,t)){return x.merge([e],n)}return n}
// Mark scripts as having already been evaluated
function ye(e,t){var n=0,i=e.length;for(;n<i;n++){J.set(e[n],"globalEval",!t||J.get(t[n],"globalEval"))}}var be=/<|&#?\w+;/;function we(e,t,n,i,r){var o,s,a,l,f,u,c=t.createDocumentFragment(),d=[],p=0,h=e.length;for(;p<h;p++){o=e[p];if(o||o===0){
// Add nodes directly
if(x.type(o)==="object"){
// Support: Android <=4.0 only, PhantomJS 1 only
// push.apply(_, arraylike) throws on ancient WebKit
x.merge(d,o.nodeType?[o]:o)}else if(!be.test(o)){d.push(t.createTextNode(o))}else{s=s||c.appendChild(t.createElement("div"));
// Deserialize a standard representation
a=(he.exec(o)||["",""])[1].toLowerCase();l=me[a]||me._default;s.innerHTML=l[1]+x.htmlPrefilter(o)+l[2];
// Descend through wrappers to the right content
u=l[0];while(u--){s=s.lastChild}
// Support: Android <=4.0 only, PhantomJS 1 only
// push.apply(_, arraylike) throws on ancient WebKit
x.merge(d,s.childNodes);
// Remember the top-level container
s=c.firstChild;
// Ensure the created nodes are orphaned (#12392)
s.textContent=""}}}
// Remove wrapper from fragment
c.textContent="";p=0;while(o=d[p++]){
// Skip elements already in the context collection (trac-4087)
if(i&&x.inArray(o,i)>-1){if(r){r.push(o)}continue}f=x.contains(o.ownerDocument,o);
// Append to fragment
s=ve(c.appendChild(o),"script");
// Preserve script evaluation history
if(f){ye(s)}
// Capture executables
if(n){u=0;while(o=s[u++]){if(ge.test(o.type||"")){n.push(o)}}}}return c}(function(){var e=a.createDocumentFragment(),t=e.appendChild(a.createElement("div")),n=a.createElement("input");
// Support: Android 4.0 - 4.3 only
// Check state lost if the name is set (#11217)
// Support: Windows Web Apps (WWA)
// `name` and `type` must use .setAttribute for WWA (#14901)
n.setAttribute("type","radio");n.setAttribute("checked","checked");n.setAttribute("name","t");t.appendChild(n);
// Support: Android <=4.1 only
// Older WebKit doesn't clone checked state correctly in fragments
y.checkClone=t.cloneNode(true).cloneNode(true).lastChild.checked;
// Support: IE <=11 only
// Make sure textarea (and checkbox) defaultValue is properly cloned
t.innerHTML="<textarea>x</textarea>";y.noCloneChecked=!!t.cloneNode(true).lastChild.defaultValue})();var xe=a.documentElement;var Te=/^key/,Ce=/^(?:mouse|pointer|contextmenu|drag|drop)|click/,Ee=/^([^.]*)(?:\.(.+)|)/;function ke(){return true}function Se(){return false}
// Support: IE <=9 only
// See #13393 for more info
function $e(){try{return a.activeElement}catch(e){}}function De(e,t,n,i,r,o){var s,a;
// Types can be a map of types/handlers
if(typeof t==="object"){
// ( types-Object, selector, data )
if(typeof n!=="string"){
// ( types-Object, data )
i=i||n;n=undefined}for(a in t){De(e,a,n,i,t[a],o)}return e}if(i==null&&r==null){
// ( types, fn )
r=n;i=n=undefined}else if(r==null){if(typeof n==="string"){
// ( types, selector, fn )
r=i;i=undefined}else{
// ( types, data, fn )
r=i;i=n;n=undefined}}if(r===false){r=Se}else if(!r){return e}if(o===1){s=r;r=function(e){
// Can use an empty set, since event contains the info
x().off(e);return s.apply(this,arguments)};
// Use same guid so caller can remove using origFn
r.guid=s.guid||(s.guid=x.guid++)}return e.each(function(){x.event.add(this,t,r,i,n)})}/*
 * Helper functions for managing events -- not part of the public interface.
 * Props to Dean Edwards' addEvent library for many of the ideas.
 */
x.event={global:{},add:function(e,t,n,i,r){var o,s,a,l,f,u,c,d,p,h,g,m=J.get(e);
// Don't attach events to noData or text/comment nodes (but allow plain objects)
if(!m){return}
// Caller can pass in an object of custom data in lieu of the handler
if(n.handler){o=n;n=o.handler;r=o.selector}
// Ensure that invalid selectors throw exceptions at attach time
// Evaluate against documentElement in case elem is a non-element node (e.g., document)
if(r){x.find.matchesSelector(xe,r)}
// Make sure that the handler has a unique ID, used to find/remove it later
if(!n.guid){n.guid=x.guid++}
// Init the element's event structure and main handler, if this is the first
if(!(l=m.events)){l=m.events={}}if(!(s=m.handle)){s=m.handle=function(t){
// Discard the second event of a jQuery.event.trigger() and
// when an event is called after a page has unloaded
return typeof x!=="undefined"&&x.event.triggered!==t.type?x.event.dispatch.apply(e,arguments):undefined}}
// Handle multiple events separated by a space
t=(t||"").match(W)||[""];f=t.length;while(f--){a=Ee.exec(t[f])||[];p=g=a[1];h=(a[2]||"").split(".").sort();
// There *must* be a type, no attaching namespace-only handlers
if(!p){continue}
// If event changes its type, use the special event handlers for the changed type
c=x.event.special[p]||{};
// If selector defined, determine special event api type, otherwise given type
p=(r?c.delegateType:c.bindType)||p;
// Update special based on newly reset type
c=x.event.special[p]||{};
// handleObj is passed to all event handlers
u=x.extend({type:p,origType:g,data:i,handler:n,guid:n.guid,selector:r,needsContext:r&&x.expr.match.needsContext.test(r),namespace:h.join(".")},o);
// Init the event handler queue if we're the first
if(!(d=l[p])){d=l[p]=[];d.delegateCount=0;
// Only use addEventListener if the special events handler returns false
if(!c.setup||c.setup.call(e,i,h,s)===false){if(e.addEventListener){e.addEventListener(p,s)}}}if(c.add){c.add.call(e,u);if(!u.handler.guid){u.handler.guid=n.guid}}
// Add to the element's handler list, delegates in front
if(r){d.splice(d.delegateCount++,0,u)}else{d.push(u)}
// Keep track of which events have ever been used, for event optimization
x.event.global[p]=true}},
// Detach an event or set of events from an element
remove:function(e,t,n,i,r){var o,s,a,l,f,u,c,d,p,h,g,m=J.hasData(e)&&J.get(e);if(!m||!(l=m.events)){return}
// Once for each type.namespace in types; type may be omitted
t=(t||"").match(W)||[""];f=t.length;while(f--){a=Ee.exec(t[f])||[];p=g=a[1];h=(a[2]||"").split(".").sort();
// Unbind all events (on this namespace, if provided) for the element
if(!p){for(p in l){x.event.remove(e,p+t[f],n,i,true)}continue}c=x.event.special[p]||{};p=(i?c.delegateType:c.bindType)||p;d=l[p]||[];a=a[2]&&new RegExp("(^|\\.)"+h.join("\\.(?:.*\\.|)")+"(\\.|$)");
// Remove matching events
s=o=d.length;while(o--){u=d[o];if((r||g===u.origType)&&(!n||n.guid===u.guid)&&(!a||a.test(u.namespace))&&(!i||i===u.selector||i==="**"&&u.selector)){d.splice(o,1);if(u.selector){d.delegateCount--}if(c.remove){c.remove.call(e,u)}}}
// Remove generic event handler if we removed something and no more handlers exist
// (avoids potential for endless recursion during removal of special event handlers)
if(s&&!d.length){if(!c.teardown||c.teardown.call(e,h,m.handle)===false){x.removeEvent(e,p,m.handle)}delete l[p]}}
// Remove data and the expando if it's no longer used
if(x.isEmptyObject(l)){J.remove(e,"handle events")}},dispatch:function(e){
// Make a writable jQuery.Event from the native event object
var t=x.event.fix(e);var n,i,r,o,s,a,l=new Array(arguments.length),f=(J.get(this,"events")||{})[t.type]||[],u=x.event.special[t.type]||{};
// Use the fix-ed jQuery.Event rather than the (read-only) native event
l[0]=t;for(n=1;n<arguments.length;n++){l[n]=arguments[n]}t.delegateTarget=this;
// Call the preDispatch hook for the mapped type, and let it bail if desired
if(u.preDispatch&&u.preDispatch.call(this,t)===false){return}
// Determine handlers
a=x.event.handlers.call(this,t,f);
// Run delegates first; they may want to stop propagation beneath us
n=0;while((o=a[n++])&&!t.isPropagationStopped()){t.currentTarget=o.elem;i=0;while((s=o.handlers[i++])&&!t.isImmediatePropagationStopped()){
// Triggered event must either 1) have no namespace, or 2) have namespace(s)
// a subset or equal to those in the bound event (both can have no namespace).
if(!t.rnamespace||t.rnamespace.test(s.namespace)){t.handleObj=s;t.data=s.data;r=((x.event.special[s.origType]||{}).handle||s.handler).apply(o.elem,l);if(r!==undefined){if((t.result=r)===false){t.preventDefault();t.stopPropagation()}}}}}
// Call the postDispatch hook for the mapped type
if(u.postDispatch){u.postDispatch.call(this,t)}return t.result},handlers:function(e,t){var n,i,r,o,s,a=[],l=t.delegateCount,f=e.target;
// Find delegate handlers
if(l&&
// Support: IE <=9
// Black-hole SVG <use> instance trees (trac-13180)
f.nodeType&&
// Support: Firefox <=42
// Suppress spec-violating clicks indicating a non-primary pointer button (trac-3861)
// https://www.w3.org/TR/DOM-Level-3-Events/#event-type-click
// Support: IE 11 only
// ...but not arrow key "clicks" of radio inputs, which can have `button` -1 (gh-2343)
!(e.type==="click"&&e.button>=1)){for(;f!==this;f=f.parentNode||this){
// Don't check non-elements (#13208)
// Don't process clicks on disabled elements (#6911, #8165, #11382, #11764)
if(f.nodeType===1&&!(e.type==="click"&&f.disabled===true)){o=[];s={};for(n=0;n<l;n++){i=t[n];
// Don't conflict with Object.prototype properties (#13203)
r=i.selector+" ";if(s[r]===undefined){s[r]=i.needsContext?x(r,this).index(f)>-1:x.find(r,this,null,[f]).length}if(s[r]){o.push(i)}}if(o.length){a.push({elem:f,handlers:o})}}}}
// Add the remaining (directly-bound) handlers
f=this;if(l<t.length){a.push({elem:f,handlers:t.slice(l)})}return a},addProp:function(e,t){Object.defineProperty(x.Event.prototype,e,{enumerable:true,configurable:true,get:x.isFunction(t)?function(){if(this.originalEvent){return t(this.originalEvent)}}:function(){if(this.originalEvent){return this.originalEvent[e]}},set:function(t){Object.defineProperty(this,e,{enumerable:true,configurable:true,writable:true,value:t})}})},fix:function(e){return e[x.expando]?e:new x.Event(e)},special:{load:{
// Prevent triggered image.load events from bubbling to window.load
noBubble:true},focus:{
// Fire native event if possible so blur/focus sequence is correct
trigger:function(){if(this!==$e()&&this.focus){this.focus();return false}},delegateType:"focusin"},blur:{trigger:function(){if(this===$e()&&this.blur){this.blur();return false}},delegateType:"focusout"},click:{
// For checkbox, fire native event so checked state will be right
trigger:function(){if(this.type==="checkbox"&&this.click&&j(this,"input")){this.click();return false}},
// For cross-browser consistency, don't fire native .click() on links
_default:function(e){return j(e.target,"a")}},beforeunload:{postDispatch:function(e){
// Support: Firefox 20+
// Firefox doesn't alert if the returnValue field is not set.
if(e.result!==undefined&&e.originalEvent){e.originalEvent.returnValue=e.result}}}}};x.removeEvent=function(e,t,n){
// This "if" is needed for plain objects
if(e.removeEventListener){e.removeEventListener(t,n)}};x.Event=function(e,t){
// Allow instantiation without the 'new' keyword
if(!(this instanceof x.Event)){return new x.Event(e,t)}
// Event object
if(e&&e.type){this.originalEvent=e;this.type=e.type;
// Events bubbling up the document may have been marked as prevented
// by a handler lower down the tree; reflect the correct value.
this.isDefaultPrevented=e.defaultPrevented||e.defaultPrevented===undefined&&
// Support: Android <=2.3 only
e.returnValue===false?ke:Se;
// Create target properties
// Support: Safari <=6 - 7 only
// Target should not be a text node (#504, #13143)
this.target=e.target&&e.target.nodeType===3?e.target.parentNode:e.target;this.currentTarget=e.currentTarget;this.relatedTarget=e.relatedTarget}else{this.type=e}
// Put explicitly provided properties onto the event object
if(t){x.extend(this,t)}
// Create a timestamp if incoming event doesn't have one
this.timeStamp=e&&e.timeStamp||x.now();
// Mark it as fixed
this[x.expando]=true};
// jQuery.Event is based on DOM3 Events as specified by the ECMAScript Language Binding
// https://www.w3.org/TR/2003/WD-DOM-Level-3-Events-20030331/ecma-script-binding.html
x.Event.prototype={constructor:x.Event,isDefaultPrevented:Se,isPropagationStopped:Se,isImmediatePropagationStopped:Se,isSimulated:false,preventDefault:function(){var e=this.originalEvent;this.isDefaultPrevented=ke;if(e&&!this.isSimulated){e.preventDefault()}},stopPropagation:function(){var e=this.originalEvent;this.isPropagationStopped=ke;if(e&&!this.isSimulated){e.stopPropagation()}},stopImmediatePropagation:function(){var e=this.originalEvent;this.isImmediatePropagationStopped=ke;if(e&&!this.isSimulated){e.stopImmediatePropagation()}this.stopPropagation()}};
// Includes all common event props including KeyEvent and MouseEvent specific props
x.each({altKey:true,bubbles:true,cancelable:true,changedTouches:true,ctrlKey:true,detail:true,eventPhase:true,metaKey:true,pageX:true,pageY:true,shiftKey:true,view:true,char:true,charCode:true,key:true,keyCode:true,button:true,buttons:true,clientX:true,clientY:true,offsetX:true,offsetY:true,pointerId:true,pointerType:true,screenX:true,screenY:true,targetTouches:true,toElement:true,touches:true,which:function(e){var t=e.button;
// Add which for key events
if(e.which==null&&Te.test(e.type)){return e.charCode!=null?e.charCode:e.keyCode}
// Add which for click: 1 === left; 2 === middle; 3 === right
if(!e.which&&t!==undefined&&Ce.test(e.type)){if(t&1){return 1}if(t&2){return 3}if(t&4){return 2}return 0}return e.which}},x.event.addProp);
// Create mouseenter/leave events using mouseover/out and event-time checks
// so that event delegation works in jQuery.
// Do the same for pointerenter/pointerleave and pointerover/pointerout
//
// Support: Safari 7 only
// Safari sends mouseenter too often; see:
// https://bugs.chromium.org/p/chromium/issues/detail?id=470258
// for the description of the bug (it existed in older Chrome versions as well).
x.each({mouseenter:"mouseover",mouseleave:"mouseout",pointerenter:"pointerover",pointerleave:"pointerout"},function(e,t){x.event.special[e]={delegateType:t,bindType:t,handle:function(e){var n,i=this,r=e.relatedTarget,o=e.handleObj;
// For mouseenter/leave call the handler if related is outside the target.
// NB: No relatedTarget if the mouse left/entered the browser window
if(!r||r!==i&&!x.contains(i,r)){e.type=o.origType;n=o.handler.apply(this,arguments);e.type=t}return n}}});x.fn.extend({on:function(e,t,n,i){return De(this,e,t,n,i)},one:function(e,t,n,i){return De(this,e,t,n,i,1)},off:function(e,t,n){var i,r;if(e&&e.preventDefault&&e.handleObj){
// ( event )  dispatched jQuery.Event
i=e.handleObj;x(e.delegateTarget).off(i.namespace?i.origType+"."+i.namespace:i.origType,i.selector,i.handler);return this}if(typeof e==="object"){
// ( types-object [, selector] )
for(r in e){this.off(r,t,e[r])}return this}if(t===false||typeof t==="function"){
// ( types [, fn] )
n=t;t=undefined}if(n===false){n=Se}return this.each(function(){x.event.remove(this,e,n,t)})}});var/* eslint-disable max-len */
// See https://github.com/eslint/eslint/issues/3229
Ae=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi,/* eslint-enable */
// Support: IE <=10 - 11, Edge 12 - 13
// In IE/Edge using regex groups here causes severe slowdowns.
// See https://connect.microsoft.com/IE/feedback/details/1736512/
Ne=/<script|<style|<link/i,
// checked="checked" or checked
je=/checked\s*(?:[^=]|=\s*.checked.)/i,Oe=/^true\/(.*)/,Ie=/^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;
// Prefer a tbody over its parent table for containing new rows
function Le(e,t){if(j(e,"table")&&j(t.nodeType!==11?t:t.firstChild,"tr")){return x(">tbody",e)[0]||e}return e}
// Replace/restore the type attribute of script elements for safe DOM manipulation
function Re(e){e.type=(e.getAttribute("type")!==null)+"/"+e.type;return e}function Pe(e){var t=Oe.exec(e.type);if(t){e.type=t[1]}else{e.removeAttribute("type")}return e}function qe(e,t){var n,i,r,o,s,a,l,f;if(t.nodeType!==1){return}
// 1. Copy private data: events, handlers, etc.
if(J.hasData(e)){o=J.access(e);s=J.set(t,o);f=o.events;if(f){delete s.handle;s.events={};for(r in f){for(n=0,i=f[r].length;n<i;n++){x.event.add(t,r,f[r][n])}}}}
// 2. Copy user data
if(Z.hasData(e)){a=Z.access(e);l=x.extend({},a);Z.set(t,l)}}
// Fix IE bugs, see support tests
function Fe(e,t){var n=t.nodeName.toLowerCase();
// Fails to persist the checked state of a cloned checkbox or radio button.
if(n==="input"&&pe.test(e.type)){t.checked=e.checked}else if(n==="input"||n==="textarea"){t.defaultValue=e.defaultValue}}function He(e,t,n,i){
// Flatten any nested arrays
t=u.apply([],t);var r,o,s,a,l,f,c=0,d=e.length,p=d-1,h=t[0],g=x.isFunction(h);
// We can't cloneNode fragments that contain checked, in WebKit
if(g||d>1&&typeof h==="string"&&!y.checkClone&&je.test(h)){return e.each(function(r){var o=e.eq(r);if(g){t[0]=h.call(this,r,o.html())}He(o,t,n,i)})}if(d){r=we(t,e[0].ownerDocument,false,e,i);o=r.firstChild;if(r.childNodes.length===1){r=o}
// Require either new content or an interest in ignored elements to invoke the callback
if(o||i){s=x.map(ve(r,"script"),Re);a=s.length;
// Use the original fragment for the last item
// instead of the first because it can end up
// being emptied incorrectly in certain situations (#8070).
for(;c<d;c++){l=r;if(c!==p){l=x.clone(l,true,true);
// Keep references to cloned scripts for later restoration
if(a){
// Support: Android <=4.0 only, PhantomJS 1 only
// push.apply(_, arraylike) throws on ancient WebKit
x.merge(s,ve(l,"script"))}}n.call(e[c],l,c)}if(a){f=s[s.length-1].ownerDocument;
// Reenable scripts
x.map(s,Pe);
// Evaluate executable scripts on first document insertion
for(c=0;c<a;c++){l=s[c];if(ge.test(l.type||"")&&!J.access(l,"globalEval")&&x.contains(f,l)){if(l.src){
// Optional AJAX dependency, but won't run scripts if not present
if(x._evalUrl){x._evalUrl(l.src)}}else{b(l.textContent.replace(Ie,""),f)}}}}}}return e}function Be(e,t,n){var i,r=t?x.filter(t,e):e,o=0;for(;(i=r[o])!=null;o++){if(!n&&i.nodeType===1){x.cleanData(ve(i))}if(i.parentNode){if(n&&x.contains(i.ownerDocument,i)){ye(ve(i,"script"))}i.parentNode.removeChild(i)}}return e}x.extend({htmlPrefilter:function(e){return e.replace(Ae,"<$1></$2>")},clone:function(e,t,n){var i,r,o,s,a=e.cloneNode(true),l=x.contains(e.ownerDocument,e);
// Fix IE cloning issues
if(!y.noCloneChecked&&(e.nodeType===1||e.nodeType===11)&&!x.isXMLDoc(e)){
// We eschew Sizzle here for performance reasons: https://jsperf.com/getall-vs-sizzle/2
s=ve(a);o=ve(e);for(i=0,r=o.length;i<r;i++){Fe(o[i],s[i])}}
// Copy the events from the original to the clone
if(t){if(n){o=o||ve(e);s=s||ve(a);for(i=0,r=o.length;i<r;i++){qe(o[i],s[i])}}else{qe(e,a)}}
// Preserve script evaluation history
s=ve(a,"script");if(s.length>0){ye(s,!l&&ve(e,"script"))}
// Return the cloned set
return a},cleanData:function(e){var t,n,i,r=x.event.special,o=0;for(;(n=e[o])!==undefined;o++){if(K(n)){if(t=n[J.expando]){if(t.events){for(i in t.events){if(r[i]){x.event.remove(n,i)}else{x.removeEvent(n,i,t.handle)}}}
// Support: Chrome <=35 - 45+
// Assign undefined instead of using delete, see Data#remove
n[J.expando]=undefined}if(n[Z.expando]){
// Support: Chrome <=35 - 45+
// Assign undefined instead of using delete, see Data#remove
n[Z.expando]=undefined}}}}});x.fn.extend({detach:function(e){return Be(this,e,true)},remove:function(e){return Be(this,e)},text:function(e){return Y(this,function(e){return e===undefined?x.text(this):this.empty().each(function(){if(this.nodeType===1||this.nodeType===11||this.nodeType===9){this.textContent=e}})},null,e,arguments.length)},append:function(){return He(this,arguments,function(e){if(this.nodeType===1||this.nodeType===11||this.nodeType===9){var t=Le(this,e);t.appendChild(e)}})},prepend:function(){return He(this,arguments,function(e){if(this.nodeType===1||this.nodeType===11||this.nodeType===9){var t=Le(this,e);t.insertBefore(e,t.firstChild)}})},before:function(){return He(this,arguments,function(e){if(this.parentNode){this.parentNode.insertBefore(e,this)}})},after:function(){return He(this,arguments,function(e){if(this.parentNode){this.parentNode.insertBefore(e,this.nextSibling)}})},empty:function(){var e,t=0;for(;(e=this[t])!=null;t++){if(e.nodeType===1){
// Prevent memory leaks
x.cleanData(ve(e,false));
// Remove any remaining nodes
e.textContent=""}}return this},clone:function(e,t){e=e==null?false:e;t=t==null?e:t;return this.map(function(){return x.clone(this,e,t)})},html:function(e){return Y(this,function(e){var t=this[0]||{},n=0,i=this.length;if(e===undefined&&t.nodeType===1){return t.innerHTML}
// See if we can take a shortcut and just use innerHTML
if(typeof e==="string"&&!Ne.test(e)&&!me[(he.exec(e)||["",""])[1].toLowerCase()]){e=x.htmlPrefilter(e);try{for(;n<i;n++){t=this[n]||{};
// Remove element nodes and prevent memory leaks
if(t.nodeType===1){x.cleanData(ve(t,false));t.innerHTML=e}}t=0}catch(e){}}if(t){this.empty().append(e)}},null,e,arguments.length)},replaceWith:function(){var e=[];
// Make the changes, replacing each non-ignored context element with the new content
return He(this,arguments,function(t){var n=this.parentNode;if(x.inArray(this,e)<0){x.cleanData(ve(this));if(n){n.replaceChild(t,this)}}},e)}});x.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(e,t){x.fn[e]=function(e){var n,i=[],r=x(e),o=r.length-1,s=0;for(;s<=o;s++){n=s===o?this:this.clone(true);x(r[s])[t](n);
// Support: Android <=4.0 only, PhantomJS 1 only
// .get() because push.apply(_, arraylike) throws on ancient WebKit
c.apply(i,n.get())}return this.pushStack(i)}});var We=/^margin/;var Me=new RegExp("^("+re+")(?!px)[a-z%]+$","i");var _e=function(e){
// Support: IE <=11 only, Firefox <=30 (#15098, #14150)
// IE throws on elements created in popups
// FF meanwhile throws on frame elements through "defaultView.getComputedStyle"
var t=e.ownerDocument.defaultView;if(!t||!t.opener){t=n}return t.getComputedStyle(e)};(function(){
// Executing both pixelPosition & boxSizingReliable tests require only one layout
// so they're executed at the same time to save the second computation.
function e(){
// This is a singleton, we need to execute it only once
if(!l){return}l.style.cssText="box-sizing:border-box;"+"position:relative;display:block;"+"margin:auto;border:1px;padding:1px;"+"top:1%;width:50%";l.innerHTML="";xe.appendChild(s);var e=n.getComputedStyle(l);t=e.top!=="1%";
// Support: Android 4.0 - 4.3 only, Firefox <=3 - 44
o=e.marginLeft==="2px";i=e.width==="4px";
// Support: Android 4.0 - 4.3 only
// Some styles come back with percentage values, even though they shouldn't
l.style.marginRight="50%";r=e.marginRight==="4px";xe.removeChild(s);
// Nullify the div so it wouldn't be stored in the memory and
// it will also be a sign that checks already performed
l=null}var t,i,r,o,s=a.createElement("div"),l=a.createElement("div");
// Finish early in limited (non-browser) environments
if(!l.style){return}
// Support: IE <=9 - 11 only
// Style of cloned element affects source element cloned (#8908)
l.style.backgroundClip="content-box";l.cloneNode(true).style.backgroundClip="";y.clearCloneStyle=l.style.backgroundClip==="content-box";s.style.cssText="border:0;width:8px;height:0;top:0;left:-9999px;"+"padding:0;margin-top:1px;position:absolute";s.appendChild(l);x.extend(y,{pixelPosition:function(){e();return t},boxSizingReliable:function(){e();return i},pixelMarginRight:function(){e();return r},reliableMarginLeft:function(){e();return o}})})();function Ue(e,t,n){var i,r,o,s,
// Support: Firefox 51+
// Retrieving style before computed somehow
// fixes an issue with getting wrong values
// on detached elements
a=e.style;n=n||_e(e);
// getPropertyValue is needed for:
//   .css('filter') (IE 9 only, #12537)
//   .css('--customProperty) (#3144)
if(n){s=n.getPropertyValue(t)||n[t];if(s===""&&!x.contains(e.ownerDocument,e)){s=x.style(e,t)}
// A tribute to the "awesome hack by Dean Edwards"
// Android Browser returns percentage for some values,
// but width seems to be reliably pixels.
// This is against the CSSOM draft spec:
// https://drafts.csswg.org/cssom/#resolved-values
if(!y.pixelMarginRight()&&Me.test(s)&&We.test(t)){
// Remember the original values
i=a.width;r=a.minWidth;o=a.maxWidth;
// Put in the new values to get a computed value out
a.minWidth=a.maxWidth=a.width=s;s=n.width;
// Revert the changed values
a.width=i;a.minWidth=r;a.maxWidth=o}}
// Support: IE <=9 - 11 only
// IE returns zIndex value as an integer.
return s!==undefined?s+"":s}function ze(e,t){
// Define the hook, we'll check on the first run if it's really needed.
return{get:function(){if(e()){
// Hook not needed (or it's not possible to use it due
// to missing dependency), remove it.
delete this.get;return}
// Hook needed; redefine it so that the support test is not executed again.
return(this.get=t).apply(this,arguments)}}}var
// Swappable if display is none or starts with table
// except "table", "table-cell", or "table-caption"
// See here for display values: https://developer.mozilla.org/en-US/docs/CSS/display
Ve=/^(none|table(?!-c[ea]).+)/,Xe=/^--/,Ge={position:"absolute",visibility:"hidden",display:"block"},Ye={letterSpacing:"0",fontWeight:"400"},Ke=["Webkit","Moz","ms"],Qe=a.createElement("div").style;
// Return a css property mapped to a potentially vendor prefixed property
function Je(e){
// Shortcut for names that are not vendor prefixed
if(e in Qe){return e}
// Check for vendor prefixed names
var t=e[0].toUpperCase()+e.slice(1),n=Ke.length;while(n--){e=Ke[n]+t;if(e in Qe){return e}}}
// Return a property mapped along what jQuery.cssProps suggests or to
// a vendor prefixed property.
function Ze(e){var t=x.cssProps[e];if(!t){t=x.cssProps[e]=Je(e)||e}return t}function et(e,t,n){
// Any relative (+/-) values have already been
// normalized at this point
var i=oe.exec(t);
// Guard against undefined "subtract", e.g., when used as in cssHooks
return i?Math.max(0,i[2]-(n||0))+(i[3]||"px"):t}function tt(e,t,n,i,r){var o,s=0;
// If we already have the right measurement, avoid augmentation
if(n===(i?"border":"content")){o=4}else{o=t==="width"?1:0}for(;o<4;o+=2){
// Both box models exclude margin, so add it if we want it
if(n==="margin"){s+=x.css(e,n+se[o],true,r)}if(i){
// border-box includes padding, so remove it if we want content
if(n==="content"){s-=x.css(e,"padding"+se[o],true,r)}
// At this point, extra isn't border nor margin, so remove border
if(n!=="margin"){s-=x.css(e,"border"+se[o]+"Width",true,r)}}else{
// At this point, extra isn't content, so add padding
s+=x.css(e,"padding"+se[o],true,r);
// At this point, extra isn't content nor padding, so add border
if(n!=="padding"){s+=x.css(e,"border"+se[o]+"Width",true,r)}}}return s}function nt(e,t,n){
// Start with computed style
var i,r=_e(e),o=Ue(e,t,r),s=x.css(e,"boxSizing",false,r)==="border-box";
// Computed unit is not pixels. Stop here and return.
if(Me.test(o)){return o}
// Check for style in case a browser which returns unreliable values
// for getComputedStyle silently falls back to the reliable elem.style
i=s&&(y.boxSizingReliable()||o===e.style[t]);
// Fall back to offsetWidth/Height when value is "auto"
// This happens for inline elements with no explicit setting (gh-3571)
if(o==="auto"){o=e["offset"+t[0].toUpperCase()+t.slice(1)]}
// Normalize "", auto, and prepare for extra
o=parseFloat(o)||0;
// Use the active box-sizing model to add/subtract irrelevant styles
return o+tt(e,t,n||(s?"border":"content"),i,r)+"px"}x.extend({
// Add in style property hooks for overriding the default
// behavior of getting and setting a style property
cssHooks:{opacity:{get:function(e,t){if(t){
// We should always get a number back from opacity
var n=Ue(e,"opacity");return n===""?"1":n}}}},
// Don't automatically add "px" to these possibly-unitless properties
cssNumber:{animationIterationCount:true,columnCount:true,fillOpacity:true,flexGrow:true,flexShrink:true,fontWeight:true,lineHeight:true,opacity:true,order:true,orphans:true,widows:true,zIndex:true,zoom:true},
// Add in properties whose names you wish to fix before
// setting or getting the value
cssProps:{float:"cssFloat"},
// Get and set the style property on a DOM Node
style:function(e,t,n,i){
// Don't set styles on text and comment nodes
if(!e||e.nodeType===3||e.nodeType===8||!e.style){return}
// Make sure that we're working with the right name
var r,o,s,a=x.camelCase(t),l=Xe.test(t),f=e.style;
// Make sure that we're working with the right name. We don't
// want to query the value if it is a CSS custom property
// since they are user-defined.
if(!l){t=Ze(a)}
// Gets hook for the prefixed version, then unprefixed version
s=x.cssHooks[t]||x.cssHooks[a];
// Check if we're setting a value
if(n!==undefined){o=typeof n;
// Convert "+=" or "-=" to relative numbers (#7345)
if(o==="string"&&(r=oe.exec(n))&&r[1]){n=fe(e,t,r);
// Fixes bug #9237
o="number"}
// Make sure that null and NaN values aren't set (#7116)
if(n==null||n!==n){return}
// If a number was passed in, add the unit (except for certain CSS properties)
if(o==="number"){n+=r&&r[3]||(x.cssNumber[a]?"":"px")}
// background-* props affect original clone's values
if(!y.clearCloneStyle&&n===""&&t.indexOf("background")===0){f[t]="inherit"}
// If a hook was provided, use that value, otherwise just set the specified value
if(!s||!("set"in s)||(n=s.set(e,n,i))!==undefined){if(l){f.setProperty(t,n)}else{f[t]=n}}}else{
// If a hook was provided get the non-computed value from there
if(s&&"get"in s&&(r=s.get(e,false,i))!==undefined){return r}
// Otherwise just get the value from the style object
return f[t]}},css:function(e,t,n,i){var r,o,s,a=x.camelCase(t),l=Xe.test(t);
// Make sure that we're working with the right name. We don't
// want to modify the value if it is a CSS custom property
// since they are user-defined.
if(!l){t=Ze(a)}
// Try prefixed name followed by the unprefixed name
s=x.cssHooks[t]||x.cssHooks[a];
// If a hook was provided get the computed value from there
if(s&&"get"in s){r=s.get(e,true,n)}
// Otherwise, if a way to get the computed value exists, use that
if(r===undefined){r=Ue(e,t,i)}
// Convert "normal" to computed value
if(r==="normal"&&t in Ye){r=Ye[t]}
// Make numeric if forced or a qualifier was provided and val looks numeric
if(n===""||n){o=parseFloat(r);return n===true||isFinite(o)?o||0:r}return r}});x.each(["height","width"],function(e,t){x.cssHooks[t]={get:function(e,n,i){if(n){
// Certain elements can have dimension info if we invisibly show them
// but it must have a current display style that would benefit
// Support: Safari 8+
// Table columns in Safari have non-zero offsetWidth & zero
// getBoundingClientRect().width unless display is changed.
// Support: IE <=11 only
// Running getBoundingClientRect on a disconnected node
// in IE throws an error.
return Ve.test(x.css(e,"display"))&&(!e.getClientRects().length||!e.getBoundingClientRect().width)?le(e,Ge,function(){return nt(e,t,i)}):nt(e,t,i)}},set:function(e,n,i){var r,o=i&&_e(e),s=i&&tt(e,t,i,x.css(e,"boxSizing",false,o)==="border-box",o);
// Convert to pixels if value adjustment is needed
if(s&&(r=oe.exec(n))&&(r[3]||"px")!=="px"){e.style[t]=n;n=x.css(e,t)}return et(e,n,s)}}});x.cssHooks.marginLeft=ze(y.reliableMarginLeft,function(e,t){if(t){return(parseFloat(Ue(e,"marginLeft"))||e.getBoundingClientRect().left-le(e,{marginLeft:0},function(){return e.getBoundingClientRect().left}))+"px"}});
// These hooks are used by animate to expand properties
x.each({margin:"",padding:"",border:"Width"},function(e,t){x.cssHooks[e+t]={expand:function(n){var i=0,r={},
// Assumes a single number if not a string
o=typeof n==="string"?n.split(" "):[n];for(;i<4;i++){r[e+se[i]+t]=o[i]||o[i-2]||o[0]}return r}};if(!We.test(e)){x.cssHooks[e+t].set=et}});x.fn.extend({css:function(e,t){return Y(this,function(e,t,n){var i,r,o={},s=0;if(Array.isArray(t)){i=_e(e);r=t.length;for(;s<r;s++){o[t[s]]=x.css(e,t[s],false,i)}return o}return n!==undefined?x.style(e,t,n):x.css(e,t)},e,t,arguments.length>1)}});function it(e,t,n,i,r){return new it.prototype.init(e,t,n,i,r)}x.Tween=it;it.prototype={constructor:it,init:function(e,t,n,i,r,o){this.elem=e;this.prop=n;this.easing=r||x.easing._default;this.options=t;this.start=this.now=this.cur();this.end=i;this.unit=o||(x.cssNumber[n]?"":"px")},cur:function(){var e=it.propHooks[this.prop];return e&&e.get?e.get(this):it.propHooks._default.get(this)},run:function(e){var t,n=it.propHooks[this.prop];if(this.options.duration){this.pos=t=x.easing[this.easing](e,this.options.duration*e,0,1,this.options.duration)}else{this.pos=t=e}this.now=(this.end-this.start)*t+this.start;if(this.options.step){this.options.step.call(this.elem,this.now,this)}if(n&&n.set){n.set(this)}else{it.propHooks._default.set(this)}return this}};it.prototype.init.prototype=it.prototype;it.propHooks={_default:{get:function(e){var t;
// Use a property on the element directly when it is not a DOM element,
// or when there is no matching style property that exists.
if(e.elem.nodeType!==1||e.elem[e.prop]!=null&&e.elem.style[e.prop]==null){return e.elem[e.prop]}
// Passing an empty string as a 3rd parameter to .css will automatically
// attempt a parseFloat and fallback to a string if the parse fails.
// Simple values such as "10px" are parsed to Float;
// complex values such as "rotate(1rad)" are returned as-is.
t=x.css(e.elem,e.prop,"");
// Empty strings, null, undefined and "auto" are converted to 0.
return!t||t==="auto"?0:t},set:function(e){
// Use step hook for back compat.
// Use cssHook if its there.
// Use .style if available and use plain properties where available.
if(x.fx.step[e.prop]){x.fx.step[e.prop](e)}else if(e.elem.nodeType===1&&(e.elem.style[x.cssProps[e.prop]]!=null||x.cssHooks[e.prop])){x.style(e.elem,e.prop,e.now+e.unit)}else{e.elem[e.prop]=e.now}}}};
// Support: IE <=9 only
// Panic based approach to setting things on disconnected nodes
it.propHooks.scrollTop=it.propHooks.scrollLeft={set:function(e){if(e.elem.nodeType&&e.elem.parentNode){e.elem[e.prop]=e.now}}};x.easing={linear:function(e){return e},swing:function(e){return.5-Math.cos(e*Math.PI)/2},_default:"swing"};x.fx=it.prototype.init;
// Back compat <1.8 extension point
x.fx.step={};var rt,ot,st=/^(?:toggle|show|hide)$/,at=/queueHooks$/;function lt(){if(ot){if(a.hidden===false&&n.requestAnimationFrame){n.requestAnimationFrame(lt)}else{n.setTimeout(lt,x.fx.interval)}x.fx.tick()}}
// Animations created synchronously will run synchronously
function ft(){n.setTimeout(function(){rt=undefined});return rt=x.now()}
// Generate parameters to create a standard animation
function ut(e,t){var n,i=0,r={height:e};
// If we include width, step value is 1 to do all cssExpand values,
// otherwise step value is 2 to skip over Left and Right
t=t?1:0;for(;i<4;i+=2-t){n=se[i];r["margin"+n]=r["padding"+n]=e}if(t){r.opacity=r.width=e}return r}function ct(e,t,n){var i,r=(ht.tweeners[t]||[]).concat(ht.tweeners["*"]),o=0,s=r.length;for(;o<s;o++){if(i=r[o].call(n,t,e)){
// We're done with this property
return i}}}function dt(e,t,n){var i,r,o,s,a,l,f,u,c="width"in t||"height"in t,d=this,p={},h=e.style,g=e.nodeType&&ae(e),m=J.get(e,"fxshow");
// Queue-skipping animations hijack the fx hooks
if(!n.queue){s=x._queueHooks(e,"fx");if(s.unqueued==null){s.unqueued=0;a=s.empty.fire;s.empty.fire=function(){if(!s.unqueued){a()}}}s.unqueued++;d.always(function(){
// Ensure the complete handler is called before this completes
d.always(function(){s.unqueued--;if(!x.queue(e,"fx").length){s.empty.fire()}})})}
// Detect show/hide animations
for(i in t){r=t[i];if(st.test(r)){delete t[i];o=o||r==="toggle";if(r===(g?"hide":"show")){
// Pretend to be hidden if this is a "show" and
// there is still data from a stopped show/hide
if(r==="show"&&m&&m[i]!==undefined){g=true}else{continue}}p[i]=m&&m[i]||x.style(e,i)}}
// Bail out if this is a no-op like .hide().hide()
l=!x.isEmptyObject(t);if(!l&&x.isEmptyObject(p)){return}
// Restrict "overflow" and "display" styles during box animations
if(c&&e.nodeType===1){
// Support: IE <=9 - 11, Edge 12 - 13
// Record all 3 overflow attributes because IE does not infer the shorthand
// from identically-valued overflowX and overflowY
n.overflow=[h.overflow,h.overflowX,h.overflowY];
// Identify a display type, preferring old show/hide data over the CSS cascade
f=m&&m.display;if(f==null){f=J.get(e,"display")}u=x.css(e,"display");if(u==="none"){if(f){u=f}else{
// Get nonempty value(s) by temporarily forcing visibility
de([e],true);f=e.style.display||f;u=x.css(e,"display");de([e])}}
// Animate inline elements as inline-block
if(u==="inline"||u==="inline-block"&&f!=null){if(x.css(e,"float")==="none"){
// Restore the original display value at the end of pure show/hide animations
if(!l){d.done(function(){h.display=f});if(f==null){u=h.display;f=u==="none"?"":u}}h.display="inline-block"}}}if(n.overflow){h.overflow="hidden";d.always(function(){h.overflow=n.overflow[0];h.overflowX=n.overflow[1];h.overflowY=n.overflow[2]})}
// Implement show/hide animations
l=false;for(i in p){
// General show/hide setup for this element animation
if(!l){if(m){if("hidden"in m){g=m.hidden}}else{m=J.access(e,"fxshow",{display:f})}
// Store hidden/visible for toggle so `.stop().toggle()` "reverses"
if(o){m.hidden=!g}
// Show elements before animating them
if(g){de([e],true)}/* eslint-disable no-loop-func */
d.done(function(){/* eslint-enable no-loop-func */
// The final step of a "hide" animation is actually hiding the element
if(!g){de([e])}J.remove(e,"fxshow");for(i in p){x.style(e,i,p[i])}})}
// Per-property setup
l=ct(g?m[i]:0,i,d);if(!(i in m)){m[i]=l.start;if(g){l.end=l.start;l.start=0}}}}function pt(e,t){var n,i,r,o,s;
// camelCase, specialEasing and expand cssHook pass
for(n in e){i=x.camelCase(n);r=t[i];o=e[n];if(Array.isArray(o)){r=o[1];o=e[n]=o[0]}if(n!==i){e[i]=o;delete e[n]}s=x.cssHooks[i];if(s&&"expand"in s){o=s.expand(o);delete e[i];
// Not quite $.extend, this won't overwrite existing keys.
// Reusing 'index' because we have the correct "name"
for(n in o){if(!(n in e)){e[n]=o[n];t[n]=r}}}else{t[i]=r}}}function ht(e,t,n){var i,r,o=0,s=ht.prefilters.length,a=x.Deferred().always(function(){
// Don't match elem in the :animated selector
delete l.elem}),l=function(){if(r){return false}var t=rt||ft(),n=Math.max(0,f.startTime+f.duration-t),
// Support: Android 2.3 only
// Archaic crash bug won't allow us to use `1 - ( 0.5 || 0 )` (#12497)
i=n/f.duration||0,o=1-i,s=0,l=f.tweens.length;for(;s<l;s++){f.tweens[s].run(o)}a.notifyWith(e,[f,o,n]);
// If there's more to do, yield
if(o<1&&l){return n}
// If this was an empty animation, synthesize a final progress notification
if(!l){a.notifyWith(e,[f,1,0])}
// Resolve the animation and report its conclusion
a.resolveWith(e,[f]);return false},f=a.promise({elem:e,props:x.extend({},t),opts:x.extend(true,{specialEasing:{},easing:x.easing._default},n),originalProperties:t,originalOptions:n,startTime:rt||ft(),duration:n.duration,tweens:[],createTween:function(t,n){var i=x.Tween(e,f.opts,t,n,f.opts.specialEasing[t]||f.opts.easing);f.tweens.push(i);return i},stop:function(t){var n=0,
// If we are going to the end, we want to run all the tweens
// otherwise we skip this part
i=t?f.tweens.length:0;if(r){return this}r=true;for(;n<i;n++){f.tweens[n].run(1)}
// Resolve when we played the last frame; otherwise, reject
if(t){a.notifyWith(e,[f,1,0]);a.resolveWith(e,[f,t])}else{a.rejectWith(e,[f,t])}return this}}),u=f.props;pt(u,f.opts.specialEasing);for(;o<s;o++){i=ht.prefilters[o].call(f,e,u,f.opts);if(i){if(x.isFunction(i.stop)){x._queueHooks(f.elem,f.opts.queue).stop=x.proxy(i.stop,i)}return i}}x.map(u,ct,f);if(x.isFunction(f.opts.start)){f.opts.start.call(e,f)}
// Attach callbacks from options
f.progress(f.opts.progress).done(f.opts.done,f.opts.complete).fail(f.opts.fail).always(f.opts.always);x.fx.timer(x.extend(l,{elem:e,anim:f,queue:f.opts.queue}));return f}x.Animation=x.extend(ht,{tweeners:{"*":[function(e,t){var n=this.createTween(e,t);fe(n.elem,e,oe.exec(t),n);return n}]},tweener:function(e,t){if(x.isFunction(e)){t=e;e=["*"]}else{e=e.match(W)}var n,i=0,r=e.length;for(;i<r;i++){n=e[i];ht.tweeners[n]=ht.tweeners[n]||[];ht.tweeners[n].unshift(t)}},prefilters:[dt],prefilter:function(e,t){if(t){ht.prefilters.unshift(e)}else{ht.prefilters.push(e)}}});x.speed=function(e,t,n){var i=e&&typeof e==="object"?x.extend({},e):{complete:n||!n&&t||x.isFunction(e)&&e,duration:e,easing:n&&t||t&&!x.isFunction(t)&&t};
// Go to the end state if fx are off
if(x.fx.off){i.duration=0}else{if(typeof i.duration!=="number"){if(i.duration in x.fx.speeds){i.duration=x.fx.speeds[i.duration]}else{i.duration=x.fx.speeds._default}}}
// Normalize opt.queue - true/undefined/null -> "fx"
if(i.queue==null||i.queue===true){i.queue="fx"}
// Queueing
i.old=i.complete;i.complete=function(){if(x.isFunction(i.old)){i.old.call(this)}if(i.queue){x.dequeue(this,i.queue)}};return i};x.fn.extend({fadeTo:function(e,t,n,i){
// Show any hidden elements after setting opacity to 0
return this.filter(ae).css("opacity",0).show().end().animate({opacity:t},e,n,i)},animate:function(e,t,n,i){var r=x.isEmptyObject(e),o=x.speed(t,n,i),s=function(){
// Operate on a copy of prop so per-property easing won't be lost
var t=ht(this,x.extend({},e),o);
// Empty animations, or finishing resolves immediately
if(r||J.get(this,"finish")){t.stop(true)}};s.finish=s;return r||o.queue===false?this.each(s):this.queue(o.queue,s)},stop:function(e,t,n){var i=function(e){var t=e.stop;delete e.stop;t(n)};if(typeof e!=="string"){n=t;t=e;e=undefined}if(t&&e!==false){this.queue(e||"fx",[])}return this.each(function(){var t=true,r=e!=null&&e+"queueHooks",o=x.timers,s=J.get(this);if(r){if(s[r]&&s[r].stop){i(s[r])}}else{for(r in s){if(s[r]&&s[r].stop&&at.test(r)){i(s[r])}}}for(r=o.length;r--;){if(o[r].elem===this&&(e==null||o[r].queue===e)){o[r].anim.stop(n);t=false;o.splice(r,1)}}
// Start the next in the queue if the last step wasn't forced.
// Timers currently will call their complete callbacks, which
// will dequeue but only if they were gotoEnd.
if(t||!n){x.dequeue(this,e)}})},finish:function(e){if(e!==false){e=e||"fx"}return this.each(function(){var t,n=J.get(this),i=n[e+"queue"],r=n[e+"queueHooks"],o=x.timers,s=i?i.length:0;
// Enable finishing flag on private data
n.finish=true;
// Empty the queue first
x.queue(this,e,[]);if(r&&r.stop){r.stop.call(this,true)}
// Look for any active animations, and finish them
for(t=o.length;t--;){if(o[t].elem===this&&o[t].queue===e){o[t].anim.stop(true);o.splice(t,1)}}
// Look for any animations in the old queue and finish them
for(t=0;t<s;t++){if(i[t]&&i[t].finish){i[t].finish.call(this)}}
// Turn off finishing flag
delete n.finish})}});x.each(["toggle","show","hide"],function(e,t){var n=x.fn[t];x.fn[t]=function(e,i,r){return e==null||typeof e==="boolean"?n.apply(this,arguments):this.animate(ut(t,true),e,i,r)}});
// Generate shortcuts for custom animations
x.each({slideDown:ut("show"),slideUp:ut("hide"),slideToggle:ut("toggle"),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(e,t){x.fn[e]=function(e,n,i){return this.animate(t,e,n,i)}});x.timers=[];x.fx.tick=function(){var e,t=0,n=x.timers;rt=x.now();for(;t<n.length;t++){e=n[t];
// Run the timer and safely remove it when done (allowing for external removal)
if(!e()&&n[t]===e){n.splice(t--,1)}}if(!n.length){x.fx.stop()}rt=undefined};x.fx.timer=function(e){x.timers.push(e);x.fx.start()};x.fx.interval=13;x.fx.start=function(){if(ot){return}ot=true;lt()};x.fx.stop=function(){ot=null};x.fx.speeds={slow:600,fast:200,
// Default speed
_default:400};
// Based off of the plugin by Clint Helfers, with permission.
// https://web.archive.org/web/20100324014747/http://blindsignals.com/index.php/2009/07/jquery-delay/
x.fn.delay=function(e,t){e=x.fx?x.fx.speeds[e]||e:e;t=t||"fx";return this.queue(t,function(t,i){var r=n.setTimeout(t,e);i.stop=function(){n.clearTimeout(r)}})};(function(){var e=a.createElement("input"),t=a.createElement("select"),n=t.appendChild(a.createElement("option"));e.type="checkbox";
// Support: Android <=4.3 only
// Default value for a checkbox should be "on"
y.checkOn=e.value!=="";
// Support: IE <=11 only
// Must access selectedIndex to make default options select
y.optSelected=n.selected;
// Support: IE <=11 only
// An input loses its value after becoming a radio
e=a.createElement("input");e.value="t";e.type="radio";y.radioValue=e.value==="t"})();var gt,mt=x.expr.attrHandle;x.fn.extend({attr:function(e,t){return Y(this,x.attr,e,t,arguments.length>1)},removeAttr:function(e){return this.each(function(){x.removeAttr(this,e)})}});x.extend({attr:function(e,t,n){var i,r,o=e.nodeType;
// Don't get/set attributes on text, comment and attribute nodes
if(o===3||o===8||o===2){return}
// Fallback to prop when attributes are not supported
if(typeof e.getAttribute==="undefined"){return x.prop(e,t,n)}
// Attribute hooks are determined by the lowercase version
// Grab necessary hook if one is defined
if(o!==1||!x.isXMLDoc(e)){r=x.attrHooks[t.toLowerCase()]||(x.expr.match.bool.test(t)?gt:undefined)}if(n!==undefined){if(n===null){x.removeAttr(e,t);return}if(r&&"set"in r&&(i=r.set(e,n,t))!==undefined){return i}e.setAttribute(t,n+"");return n}if(r&&"get"in r&&(i=r.get(e,t))!==null){return i}i=x.find.attr(e,t);
// Non-existent attributes return null, we normalize to undefined
return i==null?undefined:i},attrHooks:{type:{set:function(e,t){if(!y.radioValue&&t==="radio"&&j(e,"input")){var n=e.value;e.setAttribute("type",t);if(n){e.value=n}return t}}}},removeAttr:function(e,t){var n,i=0,
// Attribute names can contain non-HTML whitespace characters
// https://html.spec.whatwg.org/multipage/syntax.html#attributes-2
r=t&&t.match(W);if(r&&e.nodeType===1){while(n=r[i++]){e.removeAttribute(n)}}}});
// Hooks for boolean attributes
gt={set:function(e,t,n){if(t===false){
// Remove boolean attributes when set to false
x.removeAttr(e,n)}else{e.setAttribute(n,n)}return n}};x.each(x.expr.match.bool.source.match(/\w+/g),function(e,t){var n=mt[t]||x.find.attr;mt[t]=function(e,t,i){var r,o,s=t.toLowerCase();if(!i){
// Avoid an infinite loop by temporarily removing this function from the getter
o=mt[s];mt[s]=r;r=n(e,t,i)!=null?s:null;mt[s]=o}return r}});var vt=/^(?:input|select|textarea|button)$/i,yt=/^(?:a|area)$/i;x.fn.extend({prop:function(e,t){return Y(this,x.prop,e,t,arguments.length>1)},removeProp:function(e){return this.each(function(){delete this[x.propFix[e]||e]})}});x.extend({prop:function(e,t,n){var i,r,o=e.nodeType;
// Don't get/set properties on text, comment and attribute nodes
if(o===3||o===8||o===2){return}if(o!==1||!x.isXMLDoc(e)){
// Fix name and attach hooks
t=x.propFix[t]||t;r=x.propHooks[t]}if(n!==undefined){if(r&&"set"in r&&(i=r.set(e,n,t))!==undefined){return i}return e[t]=n}if(r&&"get"in r&&(i=r.get(e,t))!==null){return i}return e[t]},propHooks:{tabIndex:{get:function(e){
// Support: IE <=9 - 11 only
// elem.tabIndex doesn't always return the
// correct value when it hasn't been explicitly set
// https://web.archive.org/web/20141116233347/http://fluidproject.org/blog/2008/01/09/getting-setting-and-removing-tabindex-values-with-javascript/
// Use proper attribute retrieval(#12072)
var t=x.find.attr(e,"tabindex");if(t){return parseInt(t,10)}if(vt.test(e.nodeName)||yt.test(e.nodeName)&&e.href){return 0}return-1}}},propFix:{for:"htmlFor",class:"className"}});
// Support: IE <=11 only
// Accessing the selectedIndex property
// forces the browser to respect setting selected
// on the option
// The getter ensures a default option is selected
// when in an optgroup
// eslint rule "no-unused-expressions" is disabled for this code
// since it considers such accessions noop
if(!y.optSelected){x.propHooks.selected={get:function(e){/* eslint no-unused-expressions: "off" */
var t=e.parentNode;if(t&&t.parentNode){t.parentNode.selectedIndex}return null},set:function(e){/* eslint no-unused-expressions: "off" */
var t=e.parentNode;if(t){t.selectedIndex;if(t.parentNode){t.parentNode.selectedIndex}}}}}x.each(["tabIndex","readOnly","maxLength","cellSpacing","cellPadding","rowSpan","colSpan","useMap","frameBorder","contentEditable"],function(){x.propFix[this.toLowerCase()]=this});
// Strip and collapse whitespace according to HTML spec
// https://html.spec.whatwg.org/multipage/infrastructure.html#strip-and-collapse-whitespace
function bt(e){var t=e.match(W)||[];return t.join(" ")}function wt(e){return e.getAttribute&&e.getAttribute("class")||""}x.fn.extend({addClass:function(e){var t,n,i,r,o,s,a,l=0;if(x.isFunction(e)){return this.each(function(t){x(this).addClass(e.call(this,t,wt(this)))})}if(typeof e==="string"&&e){t=e.match(W)||[];while(n=this[l++]){r=wt(n);i=n.nodeType===1&&" "+bt(r)+" ";if(i){s=0;while(o=t[s++]){if(i.indexOf(" "+o+" ")<0){i+=o+" "}}
// Only assign if different to avoid unneeded rendering.
a=bt(i);if(r!==a){n.setAttribute("class",a)}}}}return this},removeClass:function(e){var t,n,i,r,o,s,a,l=0;if(x.isFunction(e)){return this.each(function(t){x(this).removeClass(e.call(this,t,wt(this)))})}if(!arguments.length){return this.attr("class","")}if(typeof e==="string"&&e){t=e.match(W)||[];while(n=this[l++]){r=wt(n);
// This expression is here for better compressibility (see addClass)
i=n.nodeType===1&&" "+bt(r)+" ";if(i){s=0;while(o=t[s++]){
// Remove *all* instances
while(i.indexOf(" "+o+" ")>-1){i=i.replace(" "+o+" "," ")}}
// Only assign if different to avoid unneeded rendering.
a=bt(i);if(r!==a){n.setAttribute("class",a)}}}}return this},toggleClass:function(e,t){var n=typeof e;if(typeof t==="boolean"&&n==="string"){return t?this.addClass(e):this.removeClass(e)}if(x.isFunction(e)){return this.each(function(n){x(this).toggleClass(e.call(this,n,wt(this),t),t)})}return this.each(function(){var t,i,r,o;if(n==="string"){
// Toggle individual class names
i=0;r=x(this);o=e.match(W)||[];while(t=o[i++]){
// Check each className given, space separated list
if(r.hasClass(t)){r.removeClass(t)}else{r.addClass(t)}}}else if(e===undefined||n==="boolean"){t=wt(this);if(t){
// Store className if set
J.set(this,"__className__",t)}
// If the element has a class name or if we're passed `false`,
// then remove the whole classname (if there was one, the above saved it).
// Otherwise bring back whatever was previously saved (if anything),
// falling back to the empty string if nothing was stored.
if(this.setAttribute){this.setAttribute("class",t||e===false?"":J.get(this,"__className__")||"")}}})},hasClass:function(e){var t,n,i=0;t=" "+e+" ";while(n=this[i++]){if(n.nodeType===1&&(" "+bt(wt(n))+" ").indexOf(t)>-1){return true}}return false}});var xt=/\r/g;x.fn.extend({val:function(e){var t,n,i,r=this[0];if(!arguments.length){if(r){t=x.valHooks[r.type]||x.valHooks[r.nodeName.toLowerCase()];if(t&&"get"in t&&(n=t.get(r,"value"))!==undefined){return n}n=r.value;
// Handle most common string cases
if(typeof n==="string"){return n.replace(xt,"")}
// Handle cases where value is null/undef or number
return n==null?"":n}return}i=x.isFunction(e);return this.each(function(n){var r;if(this.nodeType!==1){return}if(i){r=e.call(this,n,x(this).val())}else{r=e}
// Treat null/undefined as ""; convert numbers to string
if(r==null){r=""}else if(typeof r==="number"){r+=""}else if(Array.isArray(r)){r=x.map(r,function(e){return e==null?"":e+""})}t=x.valHooks[this.type]||x.valHooks[this.nodeName.toLowerCase()];
// If set returns undefined, fall back to normal setting
if(!t||!("set"in t)||t.set(this,r,"value")===undefined){this.value=r}})}});x.extend({valHooks:{option:{get:function(e){var t=x.find.attr(e,"value");
// Support: IE <=10 - 11 only
// option.text throws exceptions (#14686, #14858)
// Strip and collapse whitespace
// https://html.spec.whatwg.org/#strip-and-collapse-whitespace
return t!=null?t:bt(x.text(e))}},select:{get:function(e){var t,n,i,r=e.options,o=e.selectedIndex,s=e.type==="select-one",a=s?null:[],l=s?o+1:r.length;if(o<0){i=l}else{i=s?o:0}
// Loop through all the selected options
for(;i<l;i++){n=r[i];
// Support: IE <=9 only
// IE8-9 doesn't update selected after form reset (#2551)
if((n.selected||i===o)&&
// Don't return options that are disabled or in a disabled optgroup
!n.disabled&&(!n.parentNode.disabled||!j(n.parentNode,"optgroup"))){
// Get the specific value for the option
t=x(n).val();
// We don't need an array for one selects
if(s){return t}
// Multi-Selects return an array
a.push(t)}}return a},set:function(e,t){var n,i,r=e.options,o=x.makeArray(t),s=r.length;while(s--){i=r[s];/* eslint-disable no-cond-assign */
if(i.selected=x.inArray(x.valHooks.option.get(i),o)>-1){n=true}}
// Force browsers to behave consistently when non-matching value is set
if(!n){e.selectedIndex=-1}return o}}}});
// Radios and checkboxes getter/setter
x.each(["radio","checkbox"],function(){x.valHooks[this]={set:function(e,t){if(Array.isArray(t)){return e.checked=x.inArray(x(e).val(),t)>-1}}};if(!y.checkOn){x.valHooks[this].get=function(e){return e.getAttribute("value")===null?"on":e.value}}});
// Return jQuery for attributes-only inclusion
var Tt=/^(?:focusinfocus|focusoutblur)$/;x.extend(x.event,{trigger:function(e,t,i,r){var o,s,l,f,u,c,d,p=[i||a],h=g.call(e,"type")?e.type:e,m=g.call(e,"namespace")?e.namespace.split("."):[];s=l=i=i||a;
// Don't do events on text and comment nodes
if(i.nodeType===3||i.nodeType===8){return}
// focus/blur morphs to focusin/out; ensure we're not firing them right now
if(Tt.test(h+x.event.triggered)){return}if(h.indexOf(".")>-1){
// Namespaced trigger; create a regexp to match event type in handle()
m=h.split(".");h=m.shift();m.sort()}u=h.indexOf(":")<0&&"on"+h;
// Caller can pass in a jQuery.Event object, Object, or just an event type string
e=e[x.expando]?e:new x.Event(h,typeof e==="object"&&e);
// Trigger bitmask: & 1 for native handlers; & 2 for jQuery (always true)
e.isTrigger=r?2:3;e.namespace=m.join(".");e.rnamespace=e.namespace?new RegExp("(^|\\.)"+m.join("\\.(?:.*\\.|)")+"(\\.|$)"):null;
// Clean up the event in case it is being reused
e.result=undefined;if(!e.target){e.target=i}
// Clone any incoming data and prepend the event, creating the handler arg list
t=t==null?[e]:x.makeArray(t,[e]);
// Allow special events to draw outside the lines
d=x.event.special[h]||{};if(!r&&d.trigger&&d.trigger.apply(i,t)===false){return}
// Determine event propagation path in advance, per W3C events spec (#9951)
// Bubble up to document, then to window; watch for a global ownerDocument var (#9724)
if(!r&&!d.noBubble&&!x.isWindow(i)){f=d.delegateType||h;if(!Tt.test(f+h)){s=s.parentNode}for(;s;s=s.parentNode){p.push(s);l=s}
// Only add window if we got to document (e.g., not plain obj or detached DOM)
if(l===(i.ownerDocument||a)){p.push(l.defaultView||l.parentWindow||n)}}
// Fire handlers on the event path
o=0;while((s=p[o++])&&!e.isPropagationStopped()){e.type=o>1?f:d.bindType||h;
// jQuery handler
c=(J.get(s,"events")||{})[e.type]&&J.get(s,"handle");if(c){c.apply(s,t)}
// Native handler
c=u&&s[u];if(c&&c.apply&&K(s)){e.result=c.apply(s,t);if(e.result===false){e.preventDefault()}}}e.type=h;
// If nobody prevented the default action, do it now
if(!r&&!e.isDefaultPrevented()){if((!d._default||d._default.apply(p.pop(),t)===false)&&K(i)){
// Call a native DOM method on the target with the same name as the event.
// Don't do default actions on window, that's where global variables be (#6170)
if(u&&x.isFunction(i[h])&&!x.isWindow(i)){
// Don't re-trigger an onFOO event when we call its FOO() method
l=i[u];if(l){i[u]=null}
// Prevent re-triggering of the same event, since we already bubbled it above
x.event.triggered=h;i[h]();x.event.triggered=undefined;if(l){i[u]=l}}}}return e.result},
// Piggyback on a donor event to simulate a different one
// Used only for `focus(in | out)` events
simulate:function(e,t,n){var i=x.extend(new x.Event,n,{type:e,isSimulated:true});x.event.trigger(i,null,t)}});x.fn.extend({trigger:function(e,t){return this.each(function(){x.event.trigger(e,t,this)})},triggerHandler:function(e,t){var n=this[0];if(n){return x.event.trigger(e,t,n,true)}}});x.each(("blur focus focusin focusout resize scroll click dblclick "+"mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave "+"change select submit keydown keypress keyup contextmenu").split(" "),function(e,t){
// Handle event binding
x.fn[t]=function(e,n){return arguments.length>0?this.on(t,null,e,n):this.trigger(t)}});x.fn.extend({hover:function(e,t){return this.mouseenter(e).mouseleave(t||e)}});y.focusin="onfocusin"in n;
// Support: Firefox <=44
// Firefox doesn't have focus(in | out) events
// Related ticket - https://bugzilla.mozilla.org/show_bug.cgi?id=687787
//
// Support: Chrome <=48 - 49, Safari <=9.0 - 9.1
// focus(in | out) events fire after focus & blur events,
// which is spec violation - http://www.w3.org/TR/DOM-Level-3-Events/#events-focusevent-event-order
// Related ticket - https://bugs.chromium.org/p/chromium/issues/detail?id=449857
if(!y.focusin){x.each({focus:"focusin",blur:"focusout"},function(e,t){
// Attach a single capturing handler on the document while someone wants focusin/focusout
var n=function(e){x.event.simulate(t,e.target,x.event.fix(e))};x.event.special[t]={setup:function(){var i=this.ownerDocument||this,r=J.access(i,t);if(!r){i.addEventListener(e,n,true)}J.access(i,t,(r||0)+1)},teardown:function(){var i=this.ownerDocument||this,r=J.access(i,t)-1;if(!r){i.removeEventListener(e,n,true);J.remove(i,t)}else{J.access(i,t,r)}}}})}var Ct=n.location;var Et=x.now();var kt=/\?/;
// Cross-browser xml parsing
x.parseXML=function(e){var t;if(!e||typeof e!=="string"){return null}
// Support: IE 9 - 11 only
// IE throws on parseFromString with invalid input.
try{t=(new n.DOMParser).parseFromString(e,"text/xml")}catch(e){t=undefined}if(!t||t.getElementsByTagName("parsererror").length){x.error("Invalid XML: "+e)}return t};var St=/\[\]$/,$t=/\r?\n/g,Dt=/^(?:submit|button|image|reset|file)$/i,At=/^(?:input|select|textarea|keygen)/i;function Nt(e,t,n,i){var r;if(Array.isArray(t)){
// Serialize array item.
x.each(t,function(t,r){if(n||St.test(e)){
// Treat each array item as a scalar.
i(e,r)}else{
// Item is non-scalar (array or object), encode its numeric index.
Nt(e+"["+(typeof r==="object"&&r!=null?t:"")+"]",r,n,i)}})}else if(!n&&x.type(t)==="object"){
// Serialize object item.
for(r in t){Nt(e+"["+r+"]",t[r],n,i)}}else{
// Serialize scalar item.
i(e,t)}}
// Serialize an array of form elements or a set of
// key/values into a query string
x.param=function(e,t){var n,i=[],r=function(e,t){
// If value is a function, invoke it and use its return value
var n=x.isFunction(t)?t():t;i[i.length]=encodeURIComponent(e)+"="+encodeURIComponent(n==null?"":n)};
// If an array was passed in, assume that it is an array of form elements.
if(Array.isArray(e)||e.jquery&&!x.isPlainObject(e)){
// Serialize the form elements
x.each(e,function(){r(this.name,this.value)})}else{
// If traditional, encode the "old" way (the way 1.3.2 or older
// did it), otherwise encode params recursively.
for(n in e){Nt(n,e[n],t,r)}}
// Return the resulting serialization
return i.join("&")};x.fn.extend({serialize:function(){return x.param(this.serializeArray())},serializeArray:function(){return this.map(function(){
// Can add propHook for "elements" to filter or add form elements
var e=x.prop(this,"elements");return e?x.makeArray(e):this}).filter(function(){var e=this.type;
// Use .is( ":disabled" ) so that fieldset[disabled] works
return this.name&&!x(this).is(":disabled")&&At.test(this.nodeName)&&!Dt.test(e)&&(this.checked||!pe.test(e))}).map(function(e,t){var n=x(this).val();if(n==null){return null}if(Array.isArray(n)){return x.map(n,function(e){return{name:t.name,value:e.replace($t,"\r\n")}})}return{name:t.name,value:n.replace($t,"\r\n")}}).get()}});var jt=/%20/g,Ot=/#.*$/,It=/([?&])_=[^&]*/,Lt=/^(.*?):[ \t]*([^\r\n]*)$/gm,
// #7653, #8125, #8152: local protocol detection
Rt=/^(?:about|app|app-storage|.+-extension|file|res|widget):$/,Pt=/^(?:GET|HEAD)$/,qt=/^\/\//,/* Prefilters
	 * 1) They are useful to introduce custom dataTypes (see ajax/jsonp.js for an example)
	 * 2) These are called:
	 *    - BEFORE asking for a transport
	 *    - AFTER param serialization (s.data is a string if s.processData is true)
	 * 3) key is the dataType
	 * 4) the catchall symbol "*" can be used
	 * 5) execution will start with transport dataType and THEN continue down to "*" if needed
	 */
Ft={},/* Transports bindings
	 * 1) key is the dataType
	 * 2) the catchall symbol "*" can be used
	 * 3) selection will start with transport dataType and THEN go to "*" if needed
	 */
Ht={},
// Avoid comment-prolog char sequence (#10098); must appease lint and evade compression
Bt="*/".concat("*"),
// Anchor tag for parsing the document origin
Wt=a.createElement("a");Wt.href=Ct.href;
// Base "constructor" for jQuery.ajaxPrefilter and jQuery.ajaxTransport
function Mt(e){
// dataTypeExpression is optional and defaults to "*"
return function(t,n){if(typeof t!=="string"){n=t;t="*"}var i,r=0,o=t.toLowerCase().match(W)||[];if(x.isFunction(n)){
// For each dataType in the dataTypeExpression
while(i=o[r++]){
// Prepend if requested
if(i[0]==="+"){i=i.slice(1)||"*";(e[i]=e[i]||[]).unshift(n)}else{(e[i]=e[i]||[]).push(n)}}}}}
// Base inspection function for prefilters and transports
function _t(e,t,n,i){var r={},o=e===Ht;function s(a){var l;r[a]=true;x.each(e[a]||[],function(e,a){var f=a(t,n,i);if(typeof f==="string"&&!o&&!r[f]){t.dataTypes.unshift(f);s(f);return false}else if(o){return!(l=f)}});return l}return s(t.dataTypes[0])||!r["*"]&&s("*")}
// A special extend for ajax options
// that takes "flat" options (not to be deep extended)
// Fixes #9887
function Ut(e,t){var n,i,r=x.ajaxSettings.flatOptions||{};for(n in t){if(t[n]!==undefined){(r[n]?e:i||(i={}))[n]=t[n]}}if(i){x.extend(true,e,i)}return e}/* Handles responses to an ajax request:
 * - finds the right dataType (mediates between content-type and expected dataType)
 * - returns the corresponding response
 */
function zt(e,t,n){var i,r,o,s,a=e.contents,l=e.dataTypes;
// Remove auto dataType and get content-type in the process
while(l[0]==="*"){l.shift();if(i===undefined){i=e.mimeType||t.getResponseHeader("Content-Type")}}
// Check if we're dealing with a known content-type
if(i){for(r in a){if(a[r]&&a[r].test(i)){l.unshift(r);break}}}
// Check to see if we have a response for the expected dataType
if(l[0]in n){o=l[0]}else{
// Try convertible dataTypes
for(r in n){if(!l[0]||e.converters[r+" "+l[0]]){o=r;break}if(!s){s=r}}
// Or just use first one
o=o||s}
// If we found a dataType
// We add the dataType to the list if needed
// and return the corresponding response
if(o){if(o!==l[0]){l.unshift(o)}return n[o]}}/* Chain conversions given the request and the original response
 * Also sets the responseXXX fields on the jqXHR instance
 */
function Vt(e,t,n,i){var r,o,s,a,l,f={},
// Work with a copy of dataTypes in case we need to modify it for conversion
u=e.dataTypes.slice();
// Create converters map with lowercased keys
if(u[1]){for(s in e.converters){f[s.toLowerCase()]=e.converters[s]}}o=u.shift();
// Convert to each sequential dataType
while(o){if(e.responseFields[o]){n[e.responseFields[o]]=t}
// Apply the dataFilter if provided
if(!l&&i&&e.dataFilter){t=e.dataFilter(t,e.dataType)}l=o;o=u.shift();if(o){
// There's only work to do if current dataType is non-auto
if(o==="*"){o=l}else if(l!=="*"&&l!==o){
// Seek a direct converter
s=f[l+" "+o]||f["* "+o];
// If none found, seek a pair
if(!s){for(r in f){
// If conv2 outputs current
a=r.split(" ");if(a[1]===o){
// If prev can be converted to accepted input
s=f[l+" "+a[0]]||f["* "+a[0]];if(s){
// Condense equivalence converters
if(s===true){s=f[r]}else if(f[r]!==true){o=a[0];u.unshift(a[1])}break}}}}
// Apply converter (if not an equivalence)
if(s!==true){
// Unless errors are allowed to bubble, catch and return them
if(s&&e.throws){t=s(t)}else{try{t=s(t)}catch(e){return{state:"parsererror",error:s?e:"No conversion from "+l+" to "+o}}}}}}}return{state:"success",data:t}}x.extend({
// Counter for holding the number of active queries
active:0,
// Last-Modified header cache for next request
lastModified:{},etag:{},ajaxSettings:{url:Ct.href,type:"GET",isLocal:Rt.test(Ct.protocol),global:true,processData:true,async:true,contentType:"application/x-www-form-urlencoded; charset=UTF-8",/*
		timeout: 0,
		data: null,
		dataType: null,
		username: null,
		password: null,
		cache: null,
		throws: false,
		traditional: false,
		headers: {},
		*/
accepts:{"*":Bt,text:"text/plain",html:"text/html",xml:"application/xml, text/xml",json:"application/json, text/javascript"},contents:{xml:/\bxml\b/,html:/\bhtml/,json:/\bjson\b/},responseFields:{xml:"responseXML",text:"responseText",json:"responseJSON"},
// Data converters
// Keys separate source (or catchall "*") and destination types with a single space
converters:{
// Convert anything to text
"* text":String,
// Text to html (true = no transformation)
"text html":true,
// Evaluate text as a json expression
"text json":JSON.parse,
// Parse text as xml
"text xml":x.parseXML},
// For options that shouldn't be deep extended:
// you can add your own custom options here if
// and when you create one that shouldn't be
// deep extended (see ajaxExtend)
flatOptions:{url:true,context:true}},
// Creates a full fledged settings object into target
// with both ajaxSettings and settings fields.
// If target is omitted, writes into ajaxSettings.
ajaxSetup:function(e,t){
// Building a settings object
// Extending ajaxSettings
return t?Ut(Ut(e,x.ajaxSettings),t):Ut(x.ajaxSettings,e)},ajaxPrefilter:Mt(Ft),ajaxTransport:Mt(Ht),
// Main method
ajax:function(e,t){
// If url is an object, simulate pre-1.5 signature
if(typeof e==="object"){t=e;e=undefined}
// Force options to be an object
t=t||{};var i,
// URL without anti-cache param
r,
// Response headers
o,s,
// timeout handle
l,
// Url cleanup var
f,
// Request state (becomes false upon send and true upon completion)
u,
// To know if global events are to be dispatched
c,
// Loop variable
d,
// uncached part of the url
p,
// Create the final options object
h=x.ajaxSetup({},t),
// Callbacks context
g=h.context||h,
// Context for global events is callbackContext if it is a DOM node or jQuery collection
m=h.context&&(g.nodeType||g.jquery)?x(g):x.event,
// Deferreds
v=x.Deferred(),y=x.Callbacks("once memory"),
// Status-dependent callbacks
b=h.statusCode||{},
// Headers (they are sent all at once)
w={},T={},
// Default abort message
C="canceled",
// Fake xhr
E={readyState:0,
// Builds headers hashtable if needed
getResponseHeader:function(e){var t;if(u){if(!s){s={};while(t=Lt.exec(o)){s[t[1].toLowerCase()]=t[2]}}t=s[e.toLowerCase()]}return t==null?null:t},
// Raw string
getAllResponseHeaders:function(){return u?o:null},
// Caches the header
setRequestHeader:function(e,t){if(u==null){e=T[e.toLowerCase()]=T[e.toLowerCase()]||e;w[e]=t}return this},
// Overrides response content-type header
overrideMimeType:function(e){if(u==null){h.mimeType=e}return this},
// Status-dependent callbacks
statusCode:function(e){var t;if(e){if(u){
// Execute the appropriate callbacks
E.always(e[E.status])}else{
// Lazy-add the new callbacks in a way that preserves old ones
for(t in e){b[t]=[b[t],e[t]]}}}return this},
// Cancel the request
abort:function(e){var t=e||C;if(i){i.abort(t)}k(0,t);return this}};
// Attach deferreds
v.promise(E);
// Add protocol if not provided (prefilters might expect it)
// Handle falsy url in the settings object (#10093: consistency with old signature)
// We also use the url parameter if available
h.url=((e||h.url||Ct.href)+"").replace(qt,Ct.protocol+"//");
// Alias method option to type as per ticket #12004
h.type=t.method||t.type||h.method||h.type;
// Extract dataTypes list
h.dataTypes=(h.dataType||"*").toLowerCase().match(W)||[""];
// A cross-domain request is in order when the origin doesn't match the current origin.
if(h.crossDomain==null){f=a.createElement("a");
// Support: IE <=8 - 11, Edge 12 - 13
// IE throws exception on accessing the href property if url is malformed,
// e.g. http://example.com:80x/
try{f.href=h.url;
// Support: IE <=8 - 11 only
// Anchor's host property isn't correctly set when s.url is relative
f.href=f.href;h.crossDomain=Wt.protocol+"//"+Wt.host!==f.protocol+"//"+f.host}catch(e){
// If there is an error parsing the URL, assume it is crossDomain,
// it can be rejected by the transport if it is invalid
h.crossDomain=true}}
// Convert data if not already a string
if(h.data&&h.processData&&typeof h.data!=="string"){h.data=x.param(h.data,h.traditional)}
// Apply prefilters
_t(Ft,h,t,E);
// If request was aborted inside a prefilter, stop there
if(u){return E}
// We can fire global events as of now if asked to
// Don't fire events if jQuery.event is undefined in an AMD-usage scenario (#15118)
c=x.event&&h.global;
// Watch for a new set of requests
if(c&&x.active++===0){x.event.trigger("ajaxStart")}
// Uppercase the type
h.type=h.type.toUpperCase();
// Determine if request has content
h.hasContent=!Pt.test(h.type);
// Save the URL in case we're toying with the If-Modified-Since
// and/or If-None-Match header later on
// Remove hash to simplify url manipulation
r=h.url.replace(Ot,"");
// More options handling for requests with no content
if(!h.hasContent){
// Remember the hash so we can put it back
p=h.url.slice(r.length);
// If data is available, append data to url
if(h.data){r+=(kt.test(r)?"&":"?")+h.data;
// #9682: remove data so that it's not used in an eventual retry
delete h.data}
// Add or update anti-cache param if needed
if(h.cache===false){r=r.replace(It,"$1");p=(kt.test(r)?"&":"?")+"_="+Et+++p}
// Put hash and anti-cache on the URL that will be requested (gh-1732)
h.url=r+p}else if(h.data&&h.processData&&(h.contentType||"").indexOf("application/x-www-form-urlencoded")===0){h.data=h.data.replace(jt,"+")}
// Set the If-Modified-Since and/or If-None-Match header, if in ifModified mode.
if(h.ifModified){if(x.lastModified[r]){E.setRequestHeader("If-Modified-Since",x.lastModified[r])}if(x.etag[r]){E.setRequestHeader("If-None-Match",x.etag[r])}}
// Set the correct header, if data is being sent
if(h.data&&h.hasContent&&h.contentType!==false||t.contentType){E.setRequestHeader("Content-Type",h.contentType)}
// Set the Accepts header for the server, depending on the dataType
E.setRequestHeader("Accept",h.dataTypes[0]&&h.accepts[h.dataTypes[0]]?h.accepts[h.dataTypes[0]]+(h.dataTypes[0]!=="*"?", "+Bt+"; q=0.01":""):h.accepts["*"]);
// Check for headers option
for(d in h.headers){E.setRequestHeader(d,h.headers[d])}
// Allow custom headers/mimetypes and early abort
if(h.beforeSend&&(h.beforeSend.call(g,E,h)===false||u)){
// Abort if not done already and return
return E.abort()}
// Aborting is no longer a cancellation
C="abort";
// Install callbacks on deferreds
y.add(h.complete);E.done(h.success);E.fail(h.error);
// Get transport
i=_t(Ht,h,t,E);
// If no transport, we auto-abort
if(!i){k(-1,"No Transport")}else{E.readyState=1;
// Send global event
if(c){m.trigger("ajaxSend",[E,h])}
// If request was aborted inside ajaxSend, stop there
if(u){return E}
// Timeout
if(h.async&&h.timeout>0){l=n.setTimeout(function(){E.abort("timeout")},h.timeout)}try{u=false;i.send(w,k)}catch(e){
// Rethrow post-completion exceptions
if(u){throw e}
// Propagate others as results
k(-1,e)}}
// Callback for when everything is done
function k(e,t,s,a){var f,d,p,w,T,C=t;
// Ignore repeat invocations
if(u){return}u=true;
// Clear timeout if it exists
if(l){n.clearTimeout(l)}
// Dereference transport for early garbage collection
// (no matter how long the jqXHR object will be used)
i=undefined;
// Cache response headers
o=a||"";
// Set readyState
E.readyState=e>0?4:0;
// Determine if successful
f=e>=200&&e<300||e===304;
// Get response data
if(s){w=zt(h,E,s)}
// Convert no matter what (that way responseXXX fields are always set)
w=Vt(h,w,E,f);
// If successful, handle type chaining
if(f){
// Set the If-Modified-Since and/or If-None-Match header, if in ifModified mode.
if(h.ifModified){T=E.getResponseHeader("Last-Modified");if(T){x.lastModified[r]=T}T=E.getResponseHeader("etag");if(T){x.etag[r]=T}}
// if no content
if(e===204||h.type==="HEAD"){C="nocontent"}else if(e===304){C="notmodified"}else{C=w.state;d=w.data;p=w.error;f=!p}}else{
// Extract error from statusText and normalize for non-aborts
p=C;if(e||!C){C="error";if(e<0){e=0}}}
// Set data for the fake xhr object
E.status=e;E.statusText=(t||C)+"";
// Success/Error
if(f){v.resolveWith(g,[d,C,E])}else{v.rejectWith(g,[E,C,p])}
// Status-dependent callbacks
E.statusCode(b);b=undefined;if(c){m.trigger(f?"ajaxSuccess":"ajaxError",[E,h,f?d:p])}
// Complete
y.fireWith(g,[E,C]);if(c){m.trigger("ajaxComplete",[E,h]);
// Handle the global AJAX counter
if(!--x.active){x.event.trigger("ajaxStop")}}}return E},getJSON:function(e,t,n){return x.get(e,t,n,"json")},getScript:function(e,t){return x.get(e,undefined,t,"script")}});x.each(["get","post"],function(e,t){x[t]=function(e,n,i,r){
// Shift arguments if data argument was omitted
if(x.isFunction(n)){r=r||i;i=n;n=undefined}
// The url can be an options object (which then must have .url)
return x.ajax(x.extend({url:e,type:t,dataType:r,data:n,success:i},x.isPlainObject(e)&&e))}});x._evalUrl=function(e){return x.ajax({url:e,
// Make this explicit, since user can override this through ajaxSetup (#11264)
type:"GET",dataType:"script",cache:true,async:false,global:false,throws:true})};x.fn.extend({wrapAll:function(e){var t;if(this[0]){if(x.isFunction(e)){e=e.call(this[0])}
// The elements to wrap the target around
t=x(e,this[0].ownerDocument).eq(0).clone(true);if(this[0].parentNode){t.insertBefore(this[0])}t.map(function(){var e=this;while(e.firstElementChild){e=e.firstElementChild}return e}).append(this)}return this},wrapInner:function(e){if(x.isFunction(e)){return this.each(function(t){x(this).wrapInner(e.call(this,t))})}return this.each(function(){var t=x(this),n=t.contents();if(n.length){n.wrapAll(e)}else{t.append(e)}})},wrap:function(e){var t=x.isFunction(e);return this.each(function(n){x(this).wrapAll(t?e.call(this,n):e)})},unwrap:function(e){this.parent(e).not("body").each(function(){x(this).replaceWith(this.childNodes)});return this}});x.expr.pseudos.hidden=function(e){return!x.expr.pseudos.visible(e)};x.expr.pseudos.visible=function(e){return!!(e.offsetWidth||e.offsetHeight||e.getClientRects().length)};x.ajaxSettings.xhr=function(){try{return new n.XMLHttpRequest}catch(e){}};var Xt={
// File protocol always yields status code 0, assume 200
0:200,
// Support: IE <=9 only
// #1450: sometimes IE returns 1223 when it should be 204
1223:204},Gt=x.ajaxSettings.xhr();y.cors=!!Gt&&"withCredentials"in Gt;y.ajax=Gt=!!Gt;x.ajaxTransport(function(e){var t,i;
// Cross domain only allowed if supported through XMLHttpRequest
if(y.cors||Gt&&!e.crossDomain){return{send:function(r,o){var s,a=e.xhr();a.open(e.type,e.url,e.async,e.username,e.password);
// Apply custom fields if provided
if(e.xhrFields){for(s in e.xhrFields){a[s]=e.xhrFields[s]}}
// Override mime type if needed
if(e.mimeType&&a.overrideMimeType){a.overrideMimeType(e.mimeType)}
// X-Requested-With header
// For cross-domain requests, seeing as conditions for a preflight are
// akin to a jigsaw puzzle, we simply never set it to be sure.
// (it can always be set on a per-request basis or even using ajaxSetup)
// For same-domain requests, won't change header if already provided.
if(!e.crossDomain&&!r["X-Requested-With"]){r["X-Requested-With"]="XMLHttpRequest"}
// Set headers
for(s in r){a.setRequestHeader(s,r[s])}
// Callback
t=function(e){return function(){if(t){t=i=a.onload=a.onerror=a.onabort=a.onreadystatechange=null;if(e==="abort"){a.abort()}else if(e==="error"){
// Support: IE <=9 only
// On a manual native abort, IE9 throws
// errors on any property access that is not readyState
if(typeof a.status!=="number"){o(0,"error")}else{o(
// File: protocol always yields status 0; see #8605, #14207
a.status,a.statusText)}}else{o(Xt[a.status]||a.status,a.statusText,
// Support: IE <=9 only
// IE9 has no XHR2 but throws on binary (trac-11426)
// For XHR2 non-text, let the caller handle it (gh-2498)
(a.responseType||"text")!=="text"||typeof a.responseText!=="string"?{binary:a.response}:{text:a.responseText},a.getAllResponseHeaders())}}}};
// Listen to events
a.onload=t();i=a.onerror=t("error");
// Support: IE 9 only
// Use onreadystatechange to replace onabort
// to handle uncaught aborts
if(a.onabort!==undefined){a.onabort=i}else{a.onreadystatechange=function(){
// Check readyState before timeout as it changes
if(a.readyState===4){
// Allow onerror to be called first,
// but that will not handle a native abort
// Also, save errorCallback to a variable
// as xhr.onerror cannot be accessed
n.setTimeout(function(){if(t){i()}})}}}
// Create the abort callback
t=t("abort");try{
// Do send the request (this may raise an exception)
a.send(e.hasContent&&e.data||null)}catch(e){
// #14683: Only rethrow if this hasn't been notified as an error yet
if(t){throw e}}},abort:function(){if(t){t()}}}}});
// Prevent auto-execution of scripts when no explicit dataType was provided (See gh-2432)
x.ajaxPrefilter(function(e){if(e.crossDomain){e.contents.script=false}});
// Install script dataType
x.ajaxSetup({accepts:{script:"text/javascript, application/javascript, "+"application/ecmascript, application/x-ecmascript"},contents:{script:/\b(?:java|ecma)script\b/},converters:{"text script":function(e){x.globalEval(e);return e}}});
// Handle cache's special case and crossDomain
x.ajaxPrefilter("script",function(e){if(e.cache===undefined){e.cache=false}if(e.crossDomain){e.type="GET"}});
// Bind script tag hack transport
x.ajaxTransport("script",function(e){
// This transport only deals with cross domain requests
if(e.crossDomain){var t,n;return{send:function(i,r){t=x("<script>").prop({charset:e.scriptCharset,src:e.url}).on("load error",n=function(e){t.remove();n=null;if(e){r(e.type==="error"?404:200,e.type)}});
// Use native DOM manipulation to avoid our domManip AJAX trickery
a.head.appendChild(t[0])},abort:function(){if(n){n()}}}}});var Yt=[],Kt=/(=)\?(?=&|$)|\?\?/;
// Default jsonp settings
x.ajaxSetup({jsonp:"callback",jsonpCallback:function(){var e=Yt.pop()||x.expando+"_"+Et++;this[e]=true;return e}});
// Detect, normalize options and install callbacks for jsonp requests
x.ajaxPrefilter("json jsonp",function(e,t,i){var r,o,s,a=e.jsonp!==false&&(Kt.test(e.url)?"url":typeof e.data==="string"&&(e.contentType||"").indexOf("application/x-www-form-urlencoded")===0&&Kt.test(e.data)&&"data");
// Handle iff the expected data type is "jsonp" or we have a parameter to set
if(a||e.dataTypes[0]==="jsonp"){
// Get callback name, remembering preexisting value associated with it
r=e.jsonpCallback=x.isFunction(e.jsonpCallback)?e.jsonpCallback():e.jsonpCallback;
// Insert callback into url or form data
if(a){e[a]=e[a].replace(Kt,"$1"+r)}else if(e.jsonp!==false){e.url+=(kt.test(e.url)?"&":"?")+e.jsonp+"="+r}
// Use data converter to retrieve json after script execution
e.converters["script json"]=function(){if(!s){x.error(r+" was not called")}return s[0]};
// Force json dataType
e.dataTypes[0]="json";
// Install callback
o=n[r];n[r]=function(){s=arguments};
// Clean-up function (fires after converters)
i.always(function(){
// If previous value didn't exist - remove it
if(o===undefined){x(n).removeProp(r)}else{n[r]=o}
// Save back as free
if(e[r]){
// Make sure that re-using the options doesn't screw things around
e.jsonpCallback=t.jsonpCallback;
// Save the callback name for future use
Yt.push(r)}
// Call if it was a function and we have a response
if(s&&x.isFunction(o)){o(s[0])}s=o=undefined});
// Delegate to script
return"script"}});
// Support: Safari 8 only
// In Safari 8 documents created via document.implementation.createHTMLDocument
// collapse sibling forms: the second one becomes a child of the first one.
// Because of that, this security measure has to be disabled in Safari 8.
// https://bugs.webkit.org/show_bug.cgi?id=137337
y.createHTMLDocument=function(){var e=a.implementation.createHTMLDocument("").body;e.innerHTML="<form></form><form></form>";return e.childNodes.length===2}();
// Argument "data" should be string of html
// context (optional): If specified, the fragment will be created in this context,
// defaults to document
// keepScripts (optional): If true, will include scripts passed in the html string
x.parseHTML=function(e,t,n){if(typeof e!=="string"){return[]}if(typeof t==="boolean"){n=t;t=false}var i,r,o;if(!t){
// Stop scripts or inline event handlers from being executed immediately
// by using document.implementation
if(y.createHTMLDocument){t=a.implementation.createHTMLDocument("");
// Set the base href for the created document
// so any parsed elements with URLs
// are based on the document's URL (gh-2965)
i=t.createElement("base");i.href=a.location.href;t.head.appendChild(i)}else{t=a}}r=O.exec(e);o=!n&&[];
// Single tag
if(r){return[t.createElement(r[1])]}r=we([e],t,o);if(o&&o.length){x(o).remove()}return x.merge([],r.childNodes)};/**
 * Load a url into a page
 */
x.fn.load=function(e,t,n){var i,r,o,s=this,a=e.indexOf(" ");if(a>-1){i=bt(e.slice(a));e=e.slice(0,a)}
// If it's a function
if(x.isFunction(t)){
// We assume that it's the callback
n=t;t=undefined}else if(t&&typeof t==="object"){r="POST"}
// If we have elements to modify, make the request
if(s.length>0){x.ajax({url:e,
// If "type" variable is undefined, then "GET" method will be used.
// Make value of this field explicit since
// user can override it through ajaxSetup method
type:r||"GET",dataType:"html",data:t}).done(function(e){
// Save response for use in complete callback
o=arguments;s.html(i?
// If a selector was specified, locate the right elements in a dummy div
// Exclude scripts to avoid IE 'Permission Denied' errors
x("<div>").append(x.parseHTML(e)).find(i):
// Otherwise use the full result
e)}).always(n&&function(e,t){s.each(function(){n.apply(this,o||[e.responseText,t,e])})})}return this};
// Attach a bunch of functions for handling common AJAX events
x.each(["ajaxStart","ajaxStop","ajaxComplete","ajaxError","ajaxSuccess","ajaxSend"],function(e,t){x.fn[t]=function(e){return this.on(t,e)}});x.expr.pseudos.animated=function(e){return x.grep(x.timers,function(t){return e===t.elem}).length};x.offset={setOffset:function(e,t,n){var i,r,o,s,a,l,f,u=x.css(e,"position"),c=x(e),d={};
// Set position first, in-case top/left are set even on static elem
if(u==="static"){e.style.position="relative"}a=c.offset();o=x.css(e,"top");l=x.css(e,"left");f=(u==="absolute"||u==="fixed")&&(o+l).indexOf("auto")>-1;
// Need to be able to calculate position if either
// top or left is auto and position is either absolute or fixed
if(f){i=c.position();s=i.top;r=i.left}else{s=parseFloat(o)||0;r=parseFloat(l)||0}if(x.isFunction(t)){
// Use jQuery.extend here to allow modification of coordinates argument (gh-1848)
t=t.call(e,n,x.extend({},a))}if(t.top!=null){d.top=t.top-a.top+s}if(t.left!=null){d.left=t.left-a.left+r}if("using"in t){t.using.call(e,d)}else{c.css(d)}}};x.fn.extend({offset:function(e){
// Preserve chaining for setter
if(arguments.length){return e===undefined?this:this.each(function(t){x.offset.setOffset(this,e,t)})}var t,n,i,r,o=this[0];if(!o){return}
// Return zeros for disconnected and hidden (display: none) elements (gh-2310)
// Support: IE <=11 only
// Running getBoundingClientRect on a
// disconnected node in IE throws an error
if(!o.getClientRects().length){return{top:0,left:0}}i=o.getBoundingClientRect();t=o.ownerDocument;n=t.documentElement;r=t.defaultView;return{top:i.top+r.pageYOffset-n.clientTop,left:i.left+r.pageXOffset-n.clientLeft}},position:function(){if(!this[0]){return}var e,t,n=this[0],i={top:0,left:0};
// Fixed elements are offset from window (parentOffset = {top:0, left: 0},
// because it is its only offset parent
if(x.css(n,"position")==="fixed"){
// Assume getBoundingClientRect is there when computed position is fixed
t=n.getBoundingClientRect()}else{
// Get *real* offsetParent
e=this.offsetParent();
// Get correct offsets
t=this.offset();if(!j(e[0],"html")){i=e.offset()}
// Add offsetParent borders
i={top:i.top+x.css(e[0],"borderTopWidth",true),left:i.left+x.css(e[0],"borderLeftWidth",true)}}
// Subtract parent offsets and element margins
return{top:t.top-i.top-x.css(n,"marginTop",true),left:t.left-i.left-x.css(n,"marginLeft",true)}},
// This method will return documentElement in the following cases:
// 1) For the element inside the iframe without offsetParent, this method will return
//    documentElement of the parent window
// 2) For the hidden or detached element
// 3) For body or html element, i.e. in case of the html node - it will return itself
//
// but those exceptions were never presented as a real life use-cases
// and might be considered as more preferable results.
//
// This logic, however, is not guaranteed and can change at any point in the future
offsetParent:function(){return this.map(function(){var e=this.offsetParent;while(e&&x.css(e,"position")==="static"){e=e.offsetParent}return e||xe})}});
// Create scrollLeft and scrollTop methods
x.each({scrollLeft:"pageXOffset",scrollTop:"pageYOffset"},function(e,t){var n="pageYOffset"===t;x.fn[e]=function(i){return Y(this,function(e,i,r){
// Coalesce documents and windows
var o;if(x.isWindow(e)){o=e}else if(e.nodeType===9){o=e.defaultView}if(r===undefined){return o?o[t]:e[i]}if(o){o.scrollTo(!n?r:o.pageXOffset,n?r:o.pageYOffset)}else{e[i]=r}},e,i,arguments.length)}});
// Support: Safari <=7 - 9.1, Chrome <=37 - 49
// Add the top/left cssHooks using jQuery.fn.position
// Webkit bug: https://bugs.webkit.org/show_bug.cgi?id=29084
// Blink bug: https://bugs.chromium.org/p/chromium/issues/detail?id=589347
// getComputedStyle returns percent when specified for top/left/bottom/right;
// rather than make the css module depend on the offset module, just check for it here
x.each(["top","left"],function(e,t){x.cssHooks[t]=ze(y.pixelPosition,function(e,n){if(n){n=Ue(e,t);
// If curCSS returns percentage, fallback to offset
return Me.test(n)?x(e).position()[t]+"px":n}})});
// Create innerHeight, innerWidth, height, width, outerHeight and outerWidth methods
x.each({Height:"height",Width:"width"},function(e,t){x.each({padding:"inner"+e,content:t,"":"outer"+e},function(n,i){
// Margin is only for outerHeight, outerWidth
x.fn[i]=function(r,o){var s=arguments.length&&(n||typeof r!=="boolean"),a=n||(r===true||o===true?"margin":"border");return Y(this,function(t,n,r){var o;if(x.isWindow(t)){
// $( window ).outerWidth/Height return w/h including scrollbars (gh-1729)
return i.indexOf("outer")===0?t["inner"+e]:t.document.documentElement["client"+e]}
// Get document width or height
if(t.nodeType===9){o=t.documentElement;
// Either scroll[Width/Height] or offset[Width/Height] or client[Width/Height],
// whichever is greatest
return Math.max(t.body["scroll"+e],o["scroll"+e],t.body["offset"+e],o["offset"+e],o["client"+e])}
// Get width or height on the element, requesting but not forcing parseFloat
// Set width or height on the element
return r===undefined?x.css(t,n,a):x.style(t,n,r,a)},t,s?r:undefined,s)}})});x.fn.extend({bind:function(e,t,n){return this.on(e,null,t,n)},unbind:function(e,t){return this.off(e,null,t)},delegate:function(e,t,n,i){return this.on(t,e,n,i)},undelegate:function(e,t,n){
// ( namespace ) or ( selector, types [, fn] )
return arguments.length===1?this.off(e,"**"):this.off(t,e||"**",n)}});x.holdReady=function(e){if(e){x.readyWait++}else{x.ready(true)}};x.isArray=Array.isArray;x.parseJSON=JSON.parse;x.nodeName=j;
// Register as a named AMD module, since jQuery can be concatenated with other
// files that may use define, but not via a proper concatenation script that
// understands anonymous AMD modules. A named AMD is safest and most robust
// way to register. Lowercase jquery is used because AMD module names are
// derived from file names, and jQuery is normally delivered in a lowercase
// file name. Do this after creating the global so that if an AMD module wants
// to call noConflict to hide this version of jQuery, it will work.
// Note that for maximum portability, libraries that are not jQuery should
// declare themselves as anonymous modules, and avoid setting a global if an
// AMD loader is present. jQuery is a special case. For more information, see
// https://github.com/jrburke/requirejs/wiki/Updating-existing-libraries#wiki-anon
if(true){!(i=[],r=function(){return x}.apply(t,i),r!==undefined&&(e.exports=r))}var
// Map over jQuery in case of overwrite
Qt=n.jQuery,
// Map over the $ in case of overwrite
Jt=n.$;x.noConflict=function(e){if(n.$===x){n.$=Jt}if(e&&n.jQuery===x){n.jQuery=Qt}return x};
// Expose jQuery and $ identifiers, even in AMD
// (#7102#comment:10, https://github.com/jquery/jquery/pull/557)
// and CommonJS for browser emulators (#13566)
if(!o){n.jQuery=n.$=x}return x})},/* 1 */
,/* 2 */
,/* 3 */
,/* 4 */
,/* 5 */
,/* 6 */
,/* 7 */
,/* 8 */
,/* 9 */
,/* 10 */
,/* 11 */
,/* 12 */
,/* 13 */
,/* 14 */
,/* 15 */
/***/
function(e,t,n){"use strict";/* WEBPACK VAR INJECTION */
(function(e,t){var i=n(16);window.$=window.jQuery=n(0);n(17);n(1);
//Require the styles of the app
n(30);e(document).ready(function(){t('[data-toggle="tooltip"]').tooltip();t("#menu-toggle").click(function(e){e.preventDefault();t(".sidebar-boxed").toggleClass("toggled")});t(".confirm").confirm();if(typeof browserChecker!=="undefined"){browserChecker.init({browsers:["chrome"]})}console.log(WPAS_APP.controller);if(typeof WPAS_APP!=="undefined"&&WPAS_APP.controller){n(31)("./"+WPAS_APP.controller.toLowerCase()).then(function(e){var t=new e.default;t.init()},function(e){alert(e.name+": "+e.message)})}})}).call(t,n(0),n(0))},/* 16 */
/***/
function(e,t,n){/* WEBPACK VAR INJECTION */
(function(e){/*!
 * jquery.confirm
 *
 * @version 2.7.0
 *
 * @author My C-Labs
 * @author Matthieu Napoli <matthieu@mnapoli.fr>
 * @author Russel Vela
 * @author Marcus Schwarz <msspamfang@gmx.de>
 *
 * @license MIT
 * @url https://myclabs.github.io/jquery.confirm/
 */
(function(e){/**
     * Confirm a link or a button
     * @param [options] {{title, text, confirm, cancel, confirmButton, cancelButton, post, submitForm, confirmButtonClass, modalOptionsBackdrop, modalOptionsKeyboard}}
     */
e.fn.confirm=function(t){if(typeof t==="undefined"){t={}}this.click(function(n){n.preventDefault();var i=e.extend({button:e(this)},t);e.confirm(i,n)});return this};/**
     * Show a confirmation dialog
     * @param [options] {{title, text, confirm, cancel, confirmButton, cancelButton, post, submitForm, confirmButtonClass, modalOptionsBackdrop, modalOptionsKeyboard}}
     * @param [e] {Event}
     */
e.confirm=function(t,n){
// Log error and exit when no options.
if(typeof t=="undefined"){console.error("No options given.");return}
// Do nothing when active confirm modal.
if(e(".confirmation-modal").length>0)return;
// Parse options defined with "data-" attributes
var i={};if(t.button){var r={title:"title",text:"text","confirm-button":"confirmButton","submit-form":"submitForm","cancel-button":"cancelButton","confirm-button-class":"confirmButtonClass","cancel-button-class":"cancelButtonClass","dialog-class":"dialogClass","modal-options-backdrop":"modalOptionsBackdrop","modal-options-keyboard":"modalOptionsKeyboard"};e.each(r,function(e,n){var r=t.button.data(e);if(typeof r!="undefined"){i[n]=r}})}
// Default options
var o=e.extend({},e.confirm.options,{confirm:function(){if(i.submitForm||typeof i.submitForm=="undefined"&&t.submitForm||typeof i.submitForm=="undefined"&&typeof t.submitForm=="undefined"&&e.confirm.options.submitForm){n.target.closest("form").submit()}else{var r=n&&("string"===typeof n&&n||n.currentTarget&&n.currentTarget.attributes["href"].value);if(r){if(t.post){var o=e('<form method="post" class="hide" action="'+r+'"></form>');e("body").append(o);o.submit()}else{window.location=r}}}},cancel:function(e){},button:null},t,i);
// Modal
var s="";if(o.title!==""){s='<div class="modal-header">'+'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+'<h4 class="modal-title">'+o.title+"</h4>"+"</div>"}var a="";if(o.cancelButton){a='<button class="cancel btn '+o.cancelButtonClass+'" type="button" data-dismiss="modal">'+o.cancelButton+"</button>"}var l='<div class="confirmation-modal modal fade" tabindex="-1" role="dialog">'+'<div class="'+o.dialogClass+'">'+'<div class="modal-content">'+s+'<div class="modal-body">'+o.text+"</div>"+'<div class="modal-footer">'+'<button class="confirm btn '+o.confirmButtonClass+'" type="button" data-dismiss="modal">'+o.confirmButton+"</button>"+a+"</div>"+"</div>"+"</div>"+"</div>";var f=e(l);
// Apply modal options
if(typeof o.modalOptionsBackdrop!="undefined"||typeof o.modalOptionsKeyboard!="undefined"){f.modal({backdrop:o.modalOptionsBackdrop,keyboard:o.modalOptionsKeyboard})}f.on("shown.bs.modal",function(){f.find(".btn-primary:first").focus()});f.on("hidden.bs.modal",function(){f.remove()});f.find(".confirm").click(function(){o.confirm(o.button)});f.find(".cancel").click(function(){o.cancel(o.button)});
// Show the modal
e("body").append(f);f.modal("show")};/**
     * Globally definable rules
     */
e.confirm.options={text:"Are you sure?",title:"",confirmButton:"Yes",cancelButton:"Cancel",post:false,submitForm:false,confirmButtonClass:"btn-primary",cancelButtonClass:"btn-default",dialogClass:"modal-dialog",modalOptionsBackdrop:true,modalOptionsKeyboard:true}})(e)}).call(t,n(0))},/* 17 */
/***/
function(e,t,n){
// This file is autogenerated via the `commonjs` Grunt task. You can require() this file in a CommonJS environment.
n(18);n(19);n(20);n(21);n(22);n(23);n(24);n(25);n(26);n(27);n(28);n(29)},/* 18 */
/***/
function(e,t,n){/* WEBPACK VAR INJECTION */
(function(e){/* ========================================================================
 * Bootstrap: transition.js v3.3.7
 * http://getbootstrap.com/javascript/#transitions
 * ========================================================================
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */
+function(e){"use strict";
// CSS TRANSITION SUPPORT (Shoutout: http://www.modernizr.com/)
// ============================================================
function t(){var e=document.createElement("bootstrap");var t={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var n in t){if(e.style[n]!==undefined){return{end:t[n]}}}return false}
// http://blog.alexmaccaw.com/css-transitions
e.fn.emulateTransitionEnd=function(t){var n=false;var i=this;e(this).one("bsTransitionEnd",function(){n=true});var r=function(){if(!n)e(i).trigger(e.support.transition.end)};setTimeout(r,t);return this};e(function(){e.support.transition=t();if(!e.support.transition)return;e.event.special.bsTransitionEnd={bindType:e.support.transition.end,delegateType:e.support.transition.end,handle:function(t){if(e(t.target).is(this))return t.handleObj.handler.apply(this,arguments)}}})}(e)}).call(t,n(0))},/* 19 */
/***/
function(e,t,n){/* WEBPACK VAR INJECTION */
(function(e){/* ========================================================================
 * Bootstrap: alert.js v3.3.7
 * http://getbootstrap.com/javascript/#alerts
 * ========================================================================
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */
+function(e){"use strict";
// ALERT CLASS DEFINITION
// ======================
var t='[data-dismiss="alert"]';var n=function(n){e(n).on("click",t,this.close)};n.VERSION="3.3.7";n.TRANSITION_DURATION=150;n.prototype.close=function(t){var i=e(this);var r=i.attr("data-target");if(!r){r=i.attr("href");r=r&&r.replace(/.*(?=#[^\s]*$)/,"")}var o=e(r==="#"?[]:r);if(t)t.preventDefault();if(!o.length){o=i.closest(".alert")}o.trigger(t=e.Event("close.bs.alert"));if(t.isDefaultPrevented())return;o.removeClass("in");function s(){
// detach from parent, fire event then clean up data
o.detach().trigger("closed.bs.alert").remove()}e.support.transition&&o.hasClass("fade")?o.one("bsTransitionEnd",s).emulateTransitionEnd(n.TRANSITION_DURATION):s()};
// ALERT PLUGIN DEFINITION
// =======================
function i(t){return this.each(function(){var i=e(this);var r=i.data("bs.alert");if(!r)i.data("bs.alert",r=new n(this));if(typeof t=="string")r[t].call(i)})}var r=e.fn.alert;e.fn.alert=i;e.fn.alert.Constructor=n;
// ALERT NO CONFLICT
// =================
e.fn.alert.noConflict=function(){e.fn.alert=r;return this};
// ALERT DATA-API
// ==============
e(document).on("click.bs.alert.data-api",t,n.prototype.close)}(e)}).call(t,n(0))},/* 20 */
/***/
function(e,t,n){/* WEBPACK VAR INJECTION */
(function(e){/* ========================================================================
 * Bootstrap: button.js v3.3.7
 * http://getbootstrap.com/javascript/#buttons
 * ========================================================================
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */
+function(e){"use strict";
// BUTTON PUBLIC CLASS DEFINITION
// ==============================
var t=function(n,i){this.$element=e(n);this.options=e.extend({},t.DEFAULTS,i);this.isLoading=false};t.VERSION="3.3.7";t.DEFAULTS={loadingText:"loading..."};t.prototype.setState=function(t){var n="disabled";var i=this.$element;var r=i.is("input")?"val":"html";var o=i.data();t+="Text";if(o.resetText==null)i.data("resetText",i[r]());
// push to event loop to allow forms to submit
setTimeout(e.proxy(function(){i[r](o[t]==null?this.options[t]:o[t]);if(t=="loadingText"){this.isLoading=true;i.addClass(n).attr(n,n).prop(n,true)}else if(this.isLoading){this.isLoading=false;i.removeClass(n).removeAttr(n).prop(n,false)}},this),0)};t.prototype.toggle=function(){var e=true;var t=this.$element.closest('[data-toggle="buttons"]');if(t.length){var n=this.$element.find("input");if(n.prop("type")=="radio"){if(n.prop("checked"))e=false;t.find(".active").removeClass("active");this.$element.addClass("active")}else if(n.prop("type")=="checkbox"){if(n.prop("checked")!==this.$element.hasClass("active"))e=false;this.$element.toggleClass("active")}n.prop("checked",this.$element.hasClass("active"));if(e)n.trigger("change")}else{this.$element.attr("aria-pressed",!this.$element.hasClass("active"));this.$element.toggleClass("active")}};
// BUTTON PLUGIN DEFINITION
// ========================
function n(n){return this.each(function(){var i=e(this);var r=i.data("bs.button");var o=typeof n=="object"&&n;if(!r)i.data("bs.button",r=new t(this,o));if(n=="toggle")r.toggle();else if(n)r.setState(n)})}var i=e.fn.button;e.fn.button=n;e.fn.button.Constructor=t;
// BUTTON NO CONFLICT
// ==================
e.fn.button.noConflict=function(){e.fn.button=i;return this};
// BUTTON DATA-API
// ===============
e(document).on("click.bs.button.data-api",'[data-toggle^="button"]',function(t){var i=e(t.target).closest(".btn");n.call(i,"toggle");if(!e(t.target).is('input[type="radio"], input[type="checkbox"]')){
// Prevent double click on radios, and the double selections (so cancellation) on checkboxes
t.preventDefault();
// The target component still receive the focus
if(i.is("input,button"))i.trigger("focus");else i.find("input:visible,button:visible").first().trigger("focus")}}).on("focus.bs.button.data-api blur.bs.button.data-api",'[data-toggle^="button"]',function(t){e(t.target).closest(".btn").toggleClass("focus",/^focus(in)?$/.test(t.type))})}(e)}).call(t,n(0))},/* 21 */
/***/
function(e,t,n){/* WEBPACK VAR INJECTION */
(function(e){/* ========================================================================
 * Bootstrap: carousel.js v3.3.7
 * http://getbootstrap.com/javascript/#carousel
 * ========================================================================
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */
+function(e){"use strict";
// CAROUSEL CLASS DEFINITION
// =========================
var t=function(t,n){this.$element=e(t);this.$indicators=this.$element.find(".carousel-indicators");this.options=n;this.paused=null;this.sliding=null;this.interval=null;this.$active=null;this.$items=null;this.options.keyboard&&this.$element.on("keydown.bs.carousel",e.proxy(this.keydown,this));this.options.pause=="hover"&&!("ontouchstart"in document.documentElement)&&this.$element.on("mouseenter.bs.carousel",e.proxy(this.pause,this)).on("mouseleave.bs.carousel",e.proxy(this.cycle,this))};t.VERSION="3.3.7";t.TRANSITION_DURATION=600;t.DEFAULTS={interval:5e3,pause:"hover",wrap:true,keyboard:true};t.prototype.keydown=function(e){if(/input|textarea/i.test(e.target.tagName))return;switch(e.which){case 37:this.prev();break;case 39:this.next();break;default:return}e.preventDefault()};t.prototype.cycle=function(t){t||(this.paused=false);this.interval&&clearInterval(this.interval);this.options.interval&&!this.paused&&(this.interval=setInterval(e.proxy(this.next,this),this.options.interval));return this};t.prototype.getItemIndex=function(e){this.$items=e.parent().children(".item");return this.$items.index(e||this.$active)};t.prototype.getItemForDirection=function(e,t){var n=this.getItemIndex(t);var i=e=="prev"&&n===0||e=="next"&&n==this.$items.length-1;if(i&&!this.options.wrap)return t;var r=e=="prev"?-1:1;var o=(n+r)%this.$items.length;return this.$items.eq(o)};t.prototype.to=function(e){var t=this;var n=this.getItemIndex(this.$active=this.$element.find(".item.active"));if(e>this.$items.length-1||e<0)return;if(this.sliding)return this.$element.one("slid.bs.carousel",function(){t.to(e)});// yes, "slid"
if(n==e)return this.pause().cycle();return this.slide(e>n?"next":"prev",this.$items.eq(e))};t.prototype.pause=function(t){t||(this.paused=true);if(this.$element.find(".next, .prev").length&&e.support.transition){this.$element.trigger(e.support.transition.end);this.cycle(true)}this.interval=clearInterval(this.interval);return this};t.prototype.next=function(){if(this.sliding)return;return this.slide("next")};t.prototype.prev=function(){if(this.sliding)return;return this.slide("prev")};t.prototype.slide=function(n,i){var r=this.$element.find(".item.active");var o=i||this.getItemForDirection(n,r);var s=this.interval;var a=n=="next"?"left":"right";var l=this;if(o.hasClass("active"))return this.sliding=false;var f=o[0];var u=e.Event("slide.bs.carousel",{relatedTarget:f,direction:a});this.$element.trigger(u);if(u.isDefaultPrevented())return;this.sliding=true;s&&this.pause();if(this.$indicators.length){this.$indicators.find(".active").removeClass("active");var c=e(this.$indicators.children()[this.getItemIndex(o)]);c&&c.addClass("active")}var d=e.Event("slid.bs.carousel",{relatedTarget:f,direction:a});// yes, "slid"
if(e.support.transition&&this.$element.hasClass("slide")){o.addClass(n);o[0].offsetWidth;// force reflow
r.addClass(a);o.addClass(a);r.one("bsTransitionEnd",function(){o.removeClass([n,a].join(" ")).addClass("active");r.removeClass(["active",a].join(" "));l.sliding=false;setTimeout(function(){l.$element.trigger(d)},0)}).emulateTransitionEnd(t.TRANSITION_DURATION)}else{r.removeClass("active");o.addClass("active");this.sliding=false;this.$element.trigger(d)}s&&this.cycle();return this};
// CAROUSEL PLUGIN DEFINITION
// ==========================
function n(n){return this.each(function(){var i=e(this);var r=i.data("bs.carousel");var o=e.extend({},t.DEFAULTS,i.data(),typeof n=="object"&&n);var s=typeof n=="string"?n:o.slide;if(!r)i.data("bs.carousel",r=new t(this,o));if(typeof n=="number")r.to(n);else if(s)r[s]();else if(o.interval)r.pause().cycle()})}var i=e.fn.carousel;e.fn.carousel=n;e.fn.carousel.Constructor=t;
// CAROUSEL NO CONFLICT
// ====================
e.fn.carousel.noConflict=function(){e.fn.carousel=i;return this};
// CAROUSEL DATA-API
// =================
var r=function(t){var i;var r=e(this);var o=e(r.attr("data-target")||(i=r.attr("href"))&&i.replace(/.*(?=#[^\s]+$)/,""));// strip for ie7
if(!o.hasClass("carousel"))return;var s=e.extend({},o.data(),r.data());var a=r.attr("data-slide-to");if(a)s.interval=false;n.call(o,s);if(a){o.data("bs.carousel").to(a)}t.preventDefault()};e(document).on("click.bs.carousel.data-api","[data-slide]",r).on("click.bs.carousel.data-api","[data-slide-to]",r);e(window).on("load",function(){e('[data-ride="carousel"]').each(function(){var t=e(this);n.call(t,t.data())})})}(e)}).call(t,n(0))},/* 22 */
/***/
function(e,t,n){/* WEBPACK VAR INJECTION */
(function(e){/* ========================================================================
 * Bootstrap: collapse.js v3.3.7
 * http://getbootstrap.com/javascript/#collapse
 * ========================================================================
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */
/* jshint latedef: false */
+function(e){"use strict";
// COLLAPSE PUBLIC CLASS DEFINITION
// ================================
var t=function(n,i){this.$element=e(n);this.options=e.extend({},t.DEFAULTS,i);this.$trigger=e('[data-toggle="collapse"][href="#'+n.id+'"],'+'[data-toggle="collapse"][data-target="#'+n.id+'"]');this.transitioning=null;if(this.options.parent){this.$parent=this.getParent()}else{this.addAriaAndCollapsedClass(this.$element,this.$trigger)}if(this.options.toggle)this.toggle()};t.VERSION="3.3.7";t.TRANSITION_DURATION=350;t.DEFAULTS={toggle:true};t.prototype.dimension=function(){var e=this.$element.hasClass("width");return e?"width":"height"};t.prototype.show=function(){if(this.transitioning||this.$element.hasClass("in"))return;var n;var r=this.$parent&&this.$parent.children(".panel").children(".in, .collapsing");if(r&&r.length){n=r.data("bs.collapse");if(n&&n.transitioning)return}var o=e.Event("show.bs.collapse");this.$element.trigger(o);if(o.isDefaultPrevented())return;if(r&&r.length){i.call(r,"hide");n||r.data("bs.collapse",null)}var s=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[s](0).attr("aria-expanded",true);this.$trigger.removeClass("collapsed").attr("aria-expanded",true);this.transitioning=1;var a=function(){this.$element.removeClass("collapsing").addClass("collapse in")[s]("");this.transitioning=0;this.$element.trigger("shown.bs.collapse")};if(!e.support.transition)return a.call(this);var l=e.camelCase(["scroll",s].join("-"));this.$element.one("bsTransitionEnd",e.proxy(a,this)).emulateTransitionEnd(t.TRANSITION_DURATION)[s](this.$element[0][l])};t.prototype.hide=function(){if(this.transitioning||!this.$element.hasClass("in"))return;var n=e.Event("hide.bs.collapse");this.$element.trigger(n);if(n.isDefaultPrevented())return;var i=this.dimension();this.$element[i](this.$element[i]())[0].offsetHeight;this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded",false);this.$trigger.addClass("collapsed").attr("aria-expanded",false);this.transitioning=1;var r=function(){this.transitioning=0;this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")};if(!e.support.transition)return r.call(this);this.$element[i](0).one("bsTransitionEnd",e.proxy(r,this)).emulateTransitionEnd(t.TRANSITION_DURATION)};t.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()};t.prototype.getParent=function(){return e(this.options.parent).find('[data-toggle="collapse"][data-parent="'+this.options.parent+'"]').each(e.proxy(function(t,i){var r=e(i);this.addAriaAndCollapsedClass(n(r),r)},this)).end()};t.prototype.addAriaAndCollapsedClass=function(e,t){var n=e.hasClass("in");e.attr("aria-expanded",n);t.toggleClass("collapsed",!n).attr("aria-expanded",n)};function n(t){var n;var i=t.attr("data-target")||(n=t.attr("href"))&&n.replace(/.*(?=#[^\s]+$)/,"");// strip for ie7
return e(i)}
// COLLAPSE PLUGIN DEFINITION
// ==========================
function i(n){return this.each(function(){var i=e(this);var r=i.data("bs.collapse");var o=e.extend({},t.DEFAULTS,i.data(),typeof n=="object"&&n);if(!r&&o.toggle&&/show|hide/.test(n))o.toggle=false;if(!r)i.data("bs.collapse",r=new t(this,o));if(typeof n=="string")r[n]()})}var r=e.fn.collapse;e.fn.collapse=i;e.fn.collapse.Constructor=t;
// COLLAPSE NO CONFLICT
// ====================
e.fn.collapse.noConflict=function(){e.fn.collapse=r;return this};
// COLLAPSE DATA-API
// =================
e(document).on("click.bs.collapse.data-api",'[data-toggle="collapse"]',function(t){var r=e(this);if(!r.attr("data-target"))t.preventDefault();var o=n(r);var s=o.data("bs.collapse");var a=s?"toggle":r.data();i.call(o,a)})}(e)}).call(t,n(0))},/* 23 */
/***/
function(e,t,n){/* WEBPACK VAR INJECTION */
(function(e){/* ========================================================================
 * Bootstrap: dropdown.js v3.3.7
 * http://getbootstrap.com/javascript/#dropdowns
 * ========================================================================
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */
+function(e){"use strict";
// DROPDOWN CLASS DEFINITION
// =========================
var t=".dropdown-backdrop";var n='[data-toggle="dropdown"]';var i=function(t){e(t).on("click.bs.dropdown",this.toggle)};i.VERSION="3.3.7";function r(t){var n=t.attr("data-target");if(!n){n=t.attr("href");n=n&&/#[A-Za-z]/.test(n)&&n.replace(/.*(?=#[^\s]*$)/,"")}var i=n&&e(n);return i&&i.length?i:t.parent()}function o(i){if(i&&i.which===3)return;e(t).remove();e(n).each(function(){var t=e(this);var n=r(t);var o={relatedTarget:this};if(!n.hasClass("open"))return;if(i&&i.type=="click"&&/input|textarea/i.test(i.target.tagName)&&e.contains(n[0],i.target))return;n.trigger(i=e.Event("hide.bs.dropdown",o));if(i.isDefaultPrevented())return;t.attr("aria-expanded","false");n.removeClass("open").trigger(e.Event("hidden.bs.dropdown",o))})}i.prototype.toggle=function(t){var n=e(this);if(n.is(".disabled, :disabled"))return;var i=r(n);var s=i.hasClass("open");o();if(!s){if("ontouchstart"in document.documentElement&&!i.closest(".navbar-nav").length){
// if mobile we use a backdrop because click events don't delegate
e(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(e(this)).on("click",o)}var a={relatedTarget:this};i.trigger(t=e.Event("show.bs.dropdown",a));if(t.isDefaultPrevented())return;n.trigger("focus").attr("aria-expanded","true");i.toggleClass("open").trigger(e.Event("shown.bs.dropdown",a))}return false};i.prototype.keydown=function(t){if(!/(38|40|27|32)/.test(t.which)||/input|textarea/i.test(t.target.tagName))return;var i=e(this);t.preventDefault();t.stopPropagation();if(i.is(".disabled, :disabled"))return;var o=r(i);var s=o.hasClass("open");if(!s&&t.which!=27||s&&t.which==27){if(t.which==27)o.find(n).trigger("focus");return i.trigger("click")}var a=" li:not(.disabled):visible a";var l=o.find(".dropdown-menu"+a);if(!l.length)return;var f=l.index(t.target);if(t.which==38&&f>0)f--;// up
if(t.which==40&&f<l.length-1)f++;// down
if(!~f)f=0;l.eq(f).trigger("focus")};
// DROPDOWN PLUGIN DEFINITION
// ==========================
function s(t){return this.each(function(){var n=e(this);var r=n.data("bs.dropdown");if(!r)n.data("bs.dropdown",r=new i(this));if(typeof t=="string")r[t].call(n)})}var a=e.fn.dropdown;e.fn.dropdown=s;e.fn.dropdown.Constructor=i;
// DROPDOWN NO CONFLICT
// ====================
e.fn.dropdown.noConflict=function(){e.fn.dropdown=a;return this};
// APPLY TO STANDARD DROPDOWN ELEMENTS
// ===================================
e(document).on("click.bs.dropdown.data-api",o).on("click.bs.dropdown.data-api",".dropdown form",function(e){e.stopPropagation()}).on("click.bs.dropdown.data-api",n,i.prototype.toggle).on("keydown.bs.dropdown.data-api",n,i.prototype.keydown).on("keydown.bs.dropdown.data-api",".dropdown-menu",i.prototype.keydown)}(e)}).call(t,n(0))},/* 24 */
/***/
function(e,t,n){/* WEBPACK VAR INJECTION */
(function(e){/* ========================================================================
 * Bootstrap: modal.js v3.3.7
 * http://getbootstrap.com/javascript/#modals
 * ========================================================================
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */
+function(e){"use strict";
// MODAL CLASS DEFINITION
// ======================
var t=function(t,n){this.options=n;this.$body=e(document.body);this.$element=e(t);this.$dialog=this.$element.find(".modal-dialog");this.$backdrop=null;this.isShown=null;this.originalBodyPad=null;this.scrollbarWidth=0;this.ignoreBackdropClick=false;if(this.options.remote){this.$element.find(".modal-content").load(this.options.remote,e.proxy(function(){this.$element.trigger("loaded.bs.modal")},this))}};t.VERSION="3.3.7";t.TRANSITION_DURATION=300;t.BACKDROP_TRANSITION_DURATION=150;t.DEFAULTS={backdrop:true,keyboard:true,show:true};t.prototype.toggle=function(e){return this.isShown?this.hide():this.show(e)};t.prototype.show=function(n){var i=this;var r=e.Event("show.bs.modal",{relatedTarget:n});this.$element.trigger(r);if(this.isShown||r.isDefaultPrevented())return;this.isShown=true;this.checkScrollbar();this.setScrollbar();this.$body.addClass("modal-open");this.escape();this.resize();this.$element.on("click.dismiss.bs.modal",'[data-dismiss="modal"]',e.proxy(this.hide,this));this.$dialog.on("mousedown.dismiss.bs.modal",function(){i.$element.one("mouseup.dismiss.bs.modal",function(t){if(e(t.target).is(i.$element))i.ignoreBackdropClick=true})});this.backdrop(function(){var r=e.support.transition&&i.$element.hasClass("fade");if(!i.$element.parent().length){i.$element.appendTo(i.$body)}i.$element.show().scrollTop(0);i.adjustDialog();if(r){i.$element[0].offsetWidth}i.$element.addClass("in");i.enforceFocus();var o=e.Event("shown.bs.modal",{relatedTarget:n});r?i.$dialog.one("bsTransitionEnd",function(){i.$element.trigger("focus").trigger(o)}).emulateTransitionEnd(t.TRANSITION_DURATION):i.$element.trigger("focus").trigger(o)})};t.prototype.hide=function(n){if(n)n.preventDefault();n=e.Event("hide.bs.modal");this.$element.trigger(n);if(!this.isShown||n.isDefaultPrevented())return;this.isShown=false;this.escape();this.resize();e(document).off("focusin.bs.modal");this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal");this.$dialog.off("mousedown.dismiss.bs.modal");e.support.transition&&this.$element.hasClass("fade")?this.$element.one("bsTransitionEnd",e.proxy(this.hideModal,this)).emulateTransitionEnd(t.TRANSITION_DURATION):this.hideModal()};t.prototype.enforceFocus=function(){e(document).off("focusin.bs.modal").on("focusin.bs.modal",e.proxy(function(e){if(document!==e.target&&this.$element[0]!==e.target&&!this.$element.has(e.target).length){this.$element.trigger("focus")}},this))};t.prototype.escape=function(){if(this.isShown&&this.options.keyboard){this.$element.on("keydown.dismiss.bs.modal",e.proxy(function(e){e.which==27&&this.hide()},this))}else if(!this.isShown){this.$element.off("keydown.dismiss.bs.modal")}};t.prototype.resize=function(){if(this.isShown){e(window).on("resize.bs.modal",e.proxy(this.handleUpdate,this))}else{e(window).off("resize.bs.modal")}};t.prototype.hideModal=function(){var e=this;this.$element.hide();this.backdrop(function(){e.$body.removeClass("modal-open");e.resetAdjustments();e.resetScrollbar();e.$element.trigger("hidden.bs.modal")})};t.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove();this.$backdrop=null};t.prototype.backdrop=function(n){var i=this;var r=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var o=e.support.transition&&r;this.$backdrop=e(document.createElement("div")).addClass("modal-backdrop "+r).appendTo(this.$body);this.$element.on("click.dismiss.bs.modal",e.proxy(function(e){if(this.ignoreBackdropClick){this.ignoreBackdropClick=false;return}if(e.target!==e.currentTarget)return;this.options.backdrop=="static"?this.$element[0].focus():this.hide()},this));if(o)this.$backdrop[0].offsetWidth;// force reflow
this.$backdrop.addClass("in");if(!n)return;o?this.$backdrop.one("bsTransitionEnd",n).emulateTransitionEnd(t.BACKDROP_TRANSITION_DURATION):n()}else if(!this.isShown&&this.$backdrop){this.$backdrop.removeClass("in");var s=function(){i.removeBackdrop();n&&n()};e.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one("bsTransitionEnd",s).emulateTransitionEnd(t.BACKDROP_TRANSITION_DURATION):s()}else if(n){n()}};
// these following methods are used to handle overflowing modals
t.prototype.handleUpdate=function(){this.adjustDialog()};t.prototype.adjustDialog=function(){var e=this.$element[0].scrollHeight>document.documentElement.clientHeight;this.$element.css({paddingLeft:!this.bodyIsOverflowing&&e?this.scrollbarWidth:"",paddingRight:this.bodyIsOverflowing&&!e?this.scrollbarWidth:""})};t.prototype.resetAdjustments=function(){this.$element.css({paddingLeft:"",paddingRight:""})};t.prototype.checkScrollbar=function(){var e=window.innerWidth;if(!e){// workaround for missing window.innerWidth in IE8
var t=document.documentElement.getBoundingClientRect();e=t.right-Math.abs(t.left)}this.bodyIsOverflowing=document.body.clientWidth<e;this.scrollbarWidth=this.measureScrollbar()};t.prototype.setScrollbar=function(){var e=parseInt(this.$body.css("padding-right")||0,10);this.originalBodyPad=document.body.style.paddingRight||"";if(this.bodyIsOverflowing)this.$body.css("padding-right",e+this.scrollbarWidth)};t.prototype.resetScrollbar=function(){this.$body.css("padding-right",this.originalBodyPad)};t.prototype.measureScrollbar=function(){// thx walsh
var e=document.createElement("div");e.className="modal-scrollbar-measure";this.$body.append(e);var t=e.offsetWidth-e.clientWidth;this.$body[0].removeChild(e);return t};
// MODAL PLUGIN DEFINITION
// =======================
function n(n,i){return this.each(function(){var r=e(this);var o=r.data("bs.modal");var s=e.extend({},t.DEFAULTS,r.data(),typeof n=="object"&&n);if(!o)r.data("bs.modal",o=new t(this,s));if(typeof n=="string")o[n](i);else if(s.show)o.show(i)})}var i=e.fn.modal;e.fn.modal=n;e.fn.modal.Constructor=t;
// MODAL NO CONFLICT
// =================
e.fn.modal.noConflict=function(){e.fn.modal=i;return this};
// MODAL DATA-API
// ==============
e(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(t){var i=e(this);var r=i.attr("href");var o=e(i.attr("data-target")||r&&r.replace(/.*(?=#[^\s]+$)/,""));// strip for ie7
var s=o.data("bs.modal")?"toggle":e.extend({remote:!/#/.test(r)&&r},o.data(),i.data());if(i.is("a"))t.preventDefault();o.one("show.bs.modal",function(e){if(e.isDefaultPrevented())return;// only register focus restorer if modal will actually get shown
o.one("hidden.bs.modal",function(){i.is(":visible")&&i.trigger("focus")})});n.call(o,s,this)})}(e)}).call(t,n(0))},/* 25 */
/***/
function(e,t,n){/* WEBPACK VAR INJECTION */
(function(e){/* ========================================================================
 * Bootstrap: tooltip.js v3.3.7
 * http://getbootstrap.com/javascript/#tooltip
 * Inspired by the original jQuery.tipsy by Jason Frame
 * ========================================================================
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */
+function(e){"use strict";
// TOOLTIP PUBLIC CLASS DEFINITION
// ===============================
var t=function(e,t){this.type=null;this.options=null;this.enabled=null;this.timeout=null;this.hoverState=null;this.$element=null;this.inState=null;this.init("tooltip",e,t)};t.VERSION="3.3.7";t.TRANSITION_DURATION=150;t.DEFAULTS={animation:true,placement:"top",selector:false,template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:false,container:false,viewport:{selector:"body",padding:0}};t.prototype.init=function(t,n,i){this.enabled=true;this.type=t;this.$element=e(n);this.options=this.getOptions(i);this.$viewport=this.options.viewport&&e(e.isFunction(this.options.viewport)?this.options.viewport.call(this,this.$element):this.options.viewport.selector||this.options.viewport);this.inState={click:false,hover:false,focus:false};if(this.$element[0]instanceof document.constructor&&!this.options.selector){throw new Error("`selector` option must be specified when initializing "+this.type+" on the window.document object!")}var r=this.options.trigger.split(" ");for(var o=r.length;o--;){var s=r[o];if(s=="click"){this.$element.on("click."+this.type,this.options.selector,e.proxy(this.toggle,this))}else if(s!="manual"){var a=s=="hover"?"mouseenter":"focusin";var l=s=="hover"?"mouseleave":"focusout";this.$element.on(a+"."+this.type,this.options.selector,e.proxy(this.enter,this));this.$element.on(l+"."+this.type,this.options.selector,e.proxy(this.leave,this))}}this.options.selector?this._options=e.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()};t.prototype.getDefaults=function(){return t.DEFAULTS};t.prototype.getOptions=function(t){t=e.extend({},this.getDefaults(),this.$element.data(),t);if(t.delay&&typeof t.delay=="number"){t.delay={show:t.delay,hide:t.delay}}return t};t.prototype.getDelegateOptions=function(){var t={};var n=this.getDefaults();this._options&&e.each(this._options,function(e,i){if(n[e]!=i)t[e]=i});return t};t.prototype.enter=function(t){var n=t instanceof this.constructor?t:e(t.currentTarget).data("bs."+this.type);if(!n){n=new this.constructor(t.currentTarget,this.getDelegateOptions());e(t.currentTarget).data("bs."+this.type,n)}if(t instanceof e.Event){n.inState[t.type=="focusin"?"focus":"hover"]=true}if(n.tip().hasClass("in")||n.hoverState=="in"){n.hoverState="in";return}clearTimeout(n.timeout);n.hoverState="in";if(!n.options.delay||!n.options.delay.show)return n.show();n.timeout=setTimeout(function(){if(n.hoverState=="in")n.show()},n.options.delay.show)};t.prototype.isInStateTrue=function(){for(var e in this.inState){if(this.inState[e])return true}return false};t.prototype.leave=function(t){var n=t instanceof this.constructor?t:e(t.currentTarget).data("bs."+this.type);if(!n){n=new this.constructor(t.currentTarget,this.getDelegateOptions());e(t.currentTarget).data("bs."+this.type,n)}if(t instanceof e.Event){n.inState[t.type=="focusout"?"focus":"hover"]=false}if(n.isInStateTrue())return;clearTimeout(n.timeout);n.hoverState="out";if(!n.options.delay||!n.options.delay.hide)return n.hide();n.timeout=setTimeout(function(){if(n.hoverState=="out")n.hide()},n.options.delay.hide)};t.prototype.show=function(){var n=e.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){this.$element.trigger(n);var i=e.contains(this.$element[0].ownerDocument.documentElement,this.$element[0]);if(n.isDefaultPrevented()||!i)return;var r=this;var o=this.tip();var s=this.getUID(this.type);this.setContent();o.attr("id",s);this.$element.attr("aria-describedby",s);if(this.options.animation)o.addClass("fade");var a=typeof this.options.placement=="function"?this.options.placement.call(this,o[0],this.$element[0]):this.options.placement;var l=/\s?auto?\s?/i;var f=l.test(a);if(f)a=a.replace(l,"")||"top";o.detach().css({top:0,left:0,display:"block"}).addClass(a).data("bs."+this.type,this);this.options.container?o.appendTo(this.options.container):o.insertAfter(this.$element);this.$element.trigger("inserted.bs."+this.type);var u=this.getPosition();var c=o[0].offsetWidth;var d=o[0].offsetHeight;if(f){var p=a;var h=this.getPosition(this.$viewport);a=a=="bottom"&&u.bottom+d>h.bottom?"top":a=="top"&&u.top-d<h.top?"bottom":a=="right"&&u.right+c>h.width?"left":a=="left"&&u.left-c<h.left?"right":a;o.removeClass(p).addClass(a)}var g=this.getCalculatedOffset(a,u,c,d);this.applyPlacement(g,a);var m=function(){var e=r.hoverState;r.$element.trigger("shown.bs."+r.type);r.hoverState=null;if(e=="out")r.leave(r)};e.support.transition&&this.$tip.hasClass("fade")?o.one("bsTransitionEnd",m).emulateTransitionEnd(t.TRANSITION_DURATION):m()}};t.prototype.applyPlacement=function(t,n){var i=this.tip();var r=i[0].offsetWidth;var o=i[0].offsetHeight;
// manually read margins because getBoundingClientRect includes difference
var s=parseInt(i.css("margin-top"),10);var a=parseInt(i.css("margin-left"),10);
// we must check for NaN for ie 8/9
if(isNaN(s))s=0;if(isNaN(a))a=0;t.top+=s;t.left+=a;
// $.fn.offset doesn't round pixel values
// so we use setOffset directly with our own function B-0
e.offset.setOffset(i[0],e.extend({using:function(e){i.css({top:Math.round(e.top),left:Math.round(e.left)})}},t),0);i.addClass("in");
// check to see if placing tip in new offset caused the tip to resize itself
var l=i[0].offsetWidth;var f=i[0].offsetHeight;if(n=="top"&&f!=o){t.top=t.top+o-f}var u=this.getViewportAdjustedDelta(n,t,l,f);if(u.left)t.left+=u.left;else t.top+=u.top;var c=/top|bottom/.test(n);var d=c?u.left*2-r+l:u.top*2-o+f;var p=c?"offsetWidth":"offsetHeight";i.offset(t);this.replaceArrow(d,i[0][p],c)};t.prototype.replaceArrow=function(e,t,n){this.arrow().css(n?"left":"top",50*(1-e/t)+"%").css(n?"top":"left","")};t.prototype.setContent=function(){var e=this.tip();var t=this.getTitle();e.find(".tooltip-inner")[this.options.html?"html":"text"](t);e.removeClass("fade in top bottom left right")};t.prototype.hide=function(n){var i=this;var r=e(this.$tip);var o=e.Event("hide.bs."+this.type);function s(){if(i.hoverState!="in")r.detach();if(i.$element){// TODO: Check whether guarding this code with this `if` is really necessary.
i.$element.removeAttr("aria-describedby").trigger("hidden.bs."+i.type)}n&&n()}this.$element.trigger(o);if(o.isDefaultPrevented())return;r.removeClass("in");e.support.transition&&r.hasClass("fade")?r.one("bsTransitionEnd",s).emulateTransitionEnd(t.TRANSITION_DURATION):s();this.hoverState=null;return this};t.prototype.fixTitle=function(){var e=this.$element;if(e.attr("title")||typeof e.attr("data-original-title")!="string"){e.attr("data-original-title",e.attr("title")||"").attr("title","")}};t.prototype.hasContent=function(){return this.getTitle()};t.prototype.getPosition=function(t){t=t||this.$element;var n=t[0];var i=n.tagName=="BODY";var r=n.getBoundingClientRect();if(r.width==null){
// width and height are missing in IE8, so compute them manually; see https://github.com/twbs/bootstrap/issues/14093
r=e.extend({},r,{width:r.right-r.left,height:r.bottom-r.top})}var o=window.SVGElement&&n instanceof window.SVGElement;
// Avoid using $.offset() on SVGs since it gives incorrect results in jQuery 3.
// See https://github.com/twbs/bootstrap/issues/20280
var s=i?{top:0,left:0}:o?null:t.offset();var a={scroll:i?document.documentElement.scrollTop||document.body.scrollTop:t.scrollTop()};var l=i?{width:e(window).width(),height:e(window).height()}:null;return e.extend({},r,a,l,s)};t.prototype.getCalculatedOffset=function(e,t,n,i){/* placement == 'right' */
return e=="bottom"?{top:t.top+t.height,left:t.left+t.width/2-n/2}:e=="top"?{top:t.top-i,left:t.left+t.width/2-n/2}:e=="left"?{top:t.top+t.height/2-i/2,left:t.left-n}:{top:t.top+t.height/2-i/2,left:t.left+t.width}};t.prototype.getViewportAdjustedDelta=function(e,t,n,i){var r={top:0,left:0};if(!this.$viewport)return r;var o=this.options.viewport&&this.options.viewport.padding||0;var s=this.getPosition(this.$viewport);if(/right|left/.test(e)){var a=t.top-o-s.scroll;var l=t.top+o-s.scroll+i;if(a<s.top){// top overflow
r.top=s.top-a}else if(l>s.top+s.height){// bottom overflow
r.top=s.top+s.height-l}}else{var f=t.left-o;var u=t.left+o+n;if(f<s.left){// left overflow
r.left=s.left-f}else if(u>s.right){// right overflow
r.left=s.left+s.width-u}}return r};t.prototype.getTitle=function(){var e;var t=this.$element;var n=this.options;e=t.attr("data-original-title")||(typeof n.title=="function"?n.title.call(t[0]):n.title);return e};t.prototype.getUID=function(e){do{e+=~~(Math.random()*1e6)}while(document.getElementById(e));return e};t.prototype.tip=function(){if(!this.$tip){this.$tip=e(this.options.template);if(this.$tip.length!=1){throw new Error(this.type+" `template` option must consist of exactly 1 top-level element!")}}return this.$tip};t.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")};t.prototype.enable=function(){this.enabled=true};t.prototype.disable=function(){this.enabled=false};t.prototype.toggleEnabled=function(){this.enabled=!this.enabled};t.prototype.toggle=function(t){var n=this;if(t){n=e(t.currentTarget).data("bs."+this.type);if(!n){n=new this.constructor(t.currentTarget,this.getDelegateOptions());e(t.currentTarget).data("bs."+this.type,n)}}if(t){n.inState.click=!n.inState.click;if(n.isInStateTrue())n.enter(n);else n.leave(n)}else{n.tip().hasClass("in")?n.leave(n):n.enter(n)}};t.prototype.destroy=function(){var e=this;clearTimeout(this.timeout);this.hide(function(){e.$element.off("."+e.type).removeData("bs."+e.type);if(e.$tip){e.$tip.detach()}e.$tip=null;e.$arrow=null;e.$viewport=null;e.$element=null})};
// TOOLTIP PLUGIN DEFINITION
// =========================
function n(n){return this.each(function(){var i=e(this);var r=i.data("bs.tooltip");var o=typeof n=="object"&&n;if(!r&&/destroy|hide/.test(n))return;if(!r)i.data("bs.tooltip",r=new t(this,o));if(typeof n=="string")r[n]()})}var i=e.fn.tooltip;e.fn.tooltip=n;e.fn.tooltip.Constructor=t;
// TOOLTIP NO CONFLICT
// ===================
e.fn.tooltip.noConflict=function(){e.fn.tooltip=i;return this}}(e)}).call(t,n(0))},/* 26 */
/***/
function(e,t,n){/* WEBPACK VAR INJECTION */
(function(e){/* ========================================================================
 * Bootstrap: popover.js v3.3.7
 * http://getbootstrap.com/javascript/#popovers
 * ========================================================================
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */
+function(e){"use strict";
// POPOVER PUBLIC CLASS DEFINITION
// ===============================
var t=function(e,t){this.init("popover",e,t)};if(!e.fn.tooltip)throw new Error("Popover requires tooltip.js");t.VERSION="3.3.7";t.DEFAULTS=e.extend({},e.fn.tooltip.Constructor.DEFAULTS,{placement:"right",trigger:"click",content:"",template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'});
// NOTE: POPOVER EXTENDS tooltip.js
// ================================
t.prototype=e.extend({},e.fn.tooltip.Constructor.prototype);t.prototype.constructor=t;t.prototype.getDefaults=function(){return t.DEFAULTS};t.prototype.setContent=function(){var e=this.tip();var t=this.getTitle();var n=this.getContent();e.find(".popover-title")[this.options.html?"html":"text"](t);e.find(".popover-content").children().detach().end()[// we use append for html objects to maintain js events
this.options.html?typeof n=="string"?"html":"append":"text"](n);e.removeClass("fade top bottom left right in");
// IE8 doesn't accept hiding via the `:empty` pseudo selector, we have to do
// this manually by checking the contents.
if(!e.find(".popover-title").html())e.find(".popover-title").hide()};t.prototype.hasContent=function(){return this.getTitle()||this.getContent()};t.prototype.getContent=function(){var e=this.$element;var t=this.options;return e.attr("data-content")||(typeof t.content=="function"?t.content.call(e[0]):t.content)};t.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".arrow")};
// POPOVER PLUGIN DEFINITION
// =========================
function n(n){return this.each(function(){var i=e(this);var r=i.data("bs.popover");var o=typeof n=="object"&&n;if(!r&&/destroy|hide/.test(n))return;if(!r)i.data("bs.popover",r=new t(this,o));if(typeof n=="string")r[n]()})}var i=e.fn.popover;e.fn.popover=n;e.fn.popover.Constructor=t;
// POPOVER NO CONFLICT
// ===================
e.fn.popover.noConflict=function(){e.fn.popover=i;return this}}(e)}).call(t,n(0))},/* 27 */
/***/
function(e,t,n){/* WEBPACK VAR INJECTION */
(function(e){/* ========================================================================
 * Bootstrap: scrollspy.js v3.3.7
 * http://getbootstrap.com/javascript/#scrollspy
 * ========================================================================
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */
+function(e){"use strict";
// SCROLLSPY CLASS DEFINITION
// ==========================
function t(n,i){this.$body=e(document.body);this.$scrollElement=e(n).is(document.body)?e(window):e(n);this.options=e.extend({},t.DEFAULTS,i);this.selector=(this.options.target||"")+" .nav li > a";this.offsets=[];this.targets=[];this.activeTarget=null;this.scrollHeight=0;this.$scrollElement.on("scroll.bs.scrollspy",e.proxy(this.process,this));this.refresh();this.process()}t.VERSION="3.3.7";t.DEFAULTS={offset:10};t.prototype.getScrollHeight=function(){return this.$scrollElement[0].scrollHeight||Math.max(this.$body[0].scrollHeight,document.documentElement.scrollHeight)};t.prototype.refresh=function(){var t=this;var n="offset";var i=0;this.offsets=[];this.targets=[];this.scrollHeight=this.getScrollHeight();if(!e.isWindow(this.$scrollElement[0])){n="position";i=this.$scrollElement.scrollTop()}this.$body.find(this.selector).map(function(){var t=e(this);var r=t.data("target")||t.attr("href");var o=/^#./.test(r)&&e(r);return o&&o.length&&o.is(":visible")&&[[o[n]().top+i,r]]||null}).sort(function(e,t){return e[0]-t[0]}).each(function(){t.offsets.push(this[0]);t.targets.push(this[1])})};t.prototype.process=function(){var e=this.$scrollElement.scrollTop()+this.options.offset;var t=this.getScrollHeight();var n=this.options.offset+t-this.$scrollElement.height();var i=this.offsets;var r=this.targets;var o=this.activeTarget;var s;if(this.scrollHeight!=t){this.refresh()}if(e>=n){return o!=(s=r[r.length-1])&&this.activate(s)}if(o&&e<i[0]){this.activeTarget=null;return this.clear()}for(s=i.length;s--;){o!=r[s]&&e>=i[s]&&(i[s+1]===undefined||e<i[s+1])&&this.activate(r[s])}};t.prototype.activate=function(t){this.activeTarget=t;this.clear();var n=this.selector+'[data-target="'+t+'"],'+this.selector+'[href="'+t+'"]';var i=e(n).parents("li").addClass("active");if(i.parent(".dropdown-menu").length){i=i.closest("li.dropdown").addClass("active")}i.trigger("activate.bs.scrollspy")};t.prototype.clear=function(){e(this.selector).parentsUntil(this.options.target,".active").removeClass("active")};
// SCROLLSPY PLUGIN DEFINITION
// ===========================
function n(n){return this.each(function(){var i=e(this);var r=i.data("bs.scrollspy");var o=typeof n=="object"&&n;if(!r)i.data("bs.scrollspy",r=new t(this,o));if(typeof n=="string")r[n]()})}var i=e.fn.scrollspy;e.fn.scrollspy=n;e.fn.scrollspy.Constructor=t;
// SCROLLSPY NO CONFLICT
// =====================
e.fn.scrollspy.noConflict=function(){e.fn.scrollspy=i;return this};
// SCROLLSPY DATA-API
// ==================
e(window).on("load.bs.scrollspy.data-api",function(){e('[data-spy="scroll"]').each(function(){var t=e(this);n.call(t,t.data())})})}(e)}).call(t,n(0))},/* 28 */
/***/
function(e,t,n){/* WEBPACK VAR INJECTION */
(function(e){/* ========================================================================
 * Bootstrap: tab.js v3.3.7
 * http://getbootstrap.com/javascript/#tabs
 * ========================================================================
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */
+function(e){"use strict";
// TAB CLASS DEFINITION
// ====================
var t=function(t){
// jscs:disable requireDollarBeforejQueryAssignment
this.element=e(t)};t.VERSION="3.3.7";t.TRANSITION_DURATION=150;t.prototype.show=function(){var t=this.element;var n=t.closest("ul:not(.dropdown-menu)");var i=t.data("target");if(!i){i=t.attr("href");i=i&&i.replace(/.*(?=#[^\s]*$)/,"")}if(t.parent("li").hasClass("active"))return;var r=n.find(".active:last a");var o=e.Event("hide.bs.tab",{relatedTarget:t[0]});var s=e.Event("show.bs.tab",{relatedTarget:r[0]});r.trigger(o);t.trigger(s);if(s.isDefaultPrevented()||o.isDefaultPrevented())return;var a=e(i);this.activate(t.closest("li"),n);this.activate(a,a.parent(),function(){r.trigger({type:"hidden.bs.tab",relatedTarget:t[0]});t.trigger({type:"shown.bs.tab",relatedTarget:r[0]})})};t.prototype.activate=function(n,i,r){var o=i.find("> .active");var s=r&&e.support.transition&&(o.length&&o.hasClass("fade")||!!i.find("> .fade").length);function a(){o.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",false);n.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded",true);if(s){n[0].offsetWidth;// reflow for transition
n.addClass("in")}else{n.removeClass("fade")}if(n.parent(".dropdown-menu").length){n.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",true)}r&&r()}o.length&&s?o.one("bsTransitionEnd",a).emulateTransitionEnd(t.TRANSITION_DURATION):a();o.removeClass("in")};
// TAB PLUGIN DEFINITION
// =====================
function n(n){return this.each(function(){var i=e(this);var r=i.data("bs.tab");if(!r)i.data("bs.tab",r=new t(this));if(typeof n=="string")r[n]()})}var i=e.fn.tab;e.fn.tab=n;e.fn.tab.Constructor=t;
// TAB NO CONFLICT
// ===============
e.fn.tab.noConflict=function(){e.fn.tab=i;return this};
// TAB DATA-API
// ============
var r=function(t){t.preventDefault();n.call(e(this),"show")};e(document).on("click.bs.tab.data-api",'[data-toggle="tab"]',r).on("click.bs.tab.data-api",'[data-toggle="pill"]',r)}(e)}).call(t,n(0))},/* 29 */
/***/
function(e,t,n){/* WEBPACK VAR INJECTION */
(function(e){/* ========================================================================
 * Bootstrap: affix.js v3.3.7
 * http://getbootstrap.com/javascript/#affix
 * ========================================================================
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */
+function(e){"use strict";
// AFFIX CLASS DEFINITION
// ======================
var t=function(n,i){this.options=e.extend({},t.DEFAULTS,i);this.$target=e(this.options.target).on("scroll.bs.affix.data-api",e.proxy(this.checkPosition,this)).on("click.bs.affix.data-api",e.proxy(this.checkPositionWithEventLoop,this));this.$element=e(n);this.affixed=null;this.unpin=null;this.pinnedOffset=null;this.checkPosition()};t.VERSION="3.3.7";t.RESET="affix affix-top affix-bottom";t.DEFAULTS={offset:0,target:window};t.prototype.getState=function(e,t,n,i){var r=this.$target.scrollTop();var o=this.$element.offset();var s=this.$target.height();if(n!=null&&this.affixed=="top")return r<n?"top":false;if(this.affixed=="bottom"){if(n!=null)return r+this.unpin<=o.top?false:"bottom";return r+s<=e-i?false:"bottom"}var a=this.affixed==null;var l=a?r:o.top;var f=a?s:t;if(n!=null&&r<=n)return"top";if(i!=null&&l+f>=e-i)return"bottom";return false};t.prototype.getPinnedOffset=function(){if(this.pinnedOffset)return this.pinnedOffset;this.$element.removeClass(t.RESET).addClass("affix");var e=this.$target.scrollTop();var n=this.$element.offset();return this.pinnedOffset=n.top-e};t.prototype.checkPositionWithEventLoop=function(){setTimeout(e.proxy(this.checkPosition,this),1)};t.prototype.checkPosition=function(){if(!this.$element.is(":visible"))return;var n=this.$element.height();var i=this.options.offset;var r=i.top;var o=i.bottom;var s=Math.max(e(document).height(),e(document.body).height());if(typeof i!="object")o=r=i;if(typeof r=="function")r=i.top(this.$element);if(typeof o=="function")o=i.bottom(this.$element);var a=this.getState(s,n,r,o);if(this.affixed!=a){if(this.unpin!=null)this.$element.css("top","");var l="affix"+(a?"-"+a:"");var f=e.Event(l+".bs.affix");this.$element.trigger(f);if(f.isDefaultPrevented())return;this.affixed=a;this.unpin=a=="bottom"?this.getPinnedOffset():null;this.$element.removeClass(t.RESET).addClass(l).trigger(l.replace("affix","affixed")+".bs.affix")}if(a=="bottom"){this.$element.offset({top:s-n-o})}};
// AFFIX PLUGIN DEFINITION
// =======================
function n(n){return this.each(function(){var i=e(this);var r=i.data("bs.affix");var o=typeof n=="object"&&n;if(!r)i.data("bs.affix",r=new t(this,o));if(typeof n=="string")r[n]()})}var i=e.fn.affix;e.fn.affix=n;e.fn.affix.Constructor=t;
// AFFIX NO CONFLICT
// =================
e.fn.affix.noConflict=function(){e.fn.affix=i;return this};
// AFFIX DATA-API
// ==============
e(window).on("load",function(){e('[data-spy="affix"]').each(function(){var t=e(this);var i=t.data();i.offset=i.offset||{};if(i.offsetBottom!=null)i.offset.bottom=i.offsetBottom;if(i.offsetTop!=null)i.offset.top=i.offsetTop;n.call(t,i)})})}(e)}).call(t,n(0))},/* 30 */
/***/
function(e,t){},/* 31 */
/***/
function(e,t,n){var i={"./admin":[2,12],"./admin.js":[2,12],"./assets":[3,6],"./assets.js":[3,6],"./bclogin":[4,11],"./bclogin.js":[4,11],"./lesson":[5,2],"./lesson.js":[5,2],"./myassignments":[6,1],"./myassignments.js":[6,1],"./profile":[7,4],"./profile.js":[7,4],"./project":[8,10],"./project.js":[8,10],"./projects":[9,9],"./projects.js":[9,9],"./quiz":[10,3],"./quiz.js":[10,3],"./reviewassignments":[11,8],"./reviewassignments.js":[11,8],"./search":[12,5],"./search.js":[12,5],"./studentprofile":[13,0],"./studentprofile.js":[13,0],"./usercohort":[14,7],"./usercohort.js":[14,7]};function r(e){var t=i[e];if(!t)return Promise.reject(new Error("Cannot find module '"+e+"'."));return n.e(t[1]).then(function(){return n(t[0])})}r.keys=function e(){return Object.keys(i)};e.exports=r;r.id=31}],[15]);