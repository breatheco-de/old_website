/******/(function(t){// webpackBootstrap
/******/
// install a JSONP callback for chunk loading
/******/
var e=window["webpackJsonp"];/******/
window["webpackJsonp"]=function r(i,u,c){/******/
// add "moreModules" to the modules object,
/******/
// then flag all "chunkIds" as loaded and fire callback
/******/
var a,f,s=0,l=[],d;/******/
for(;s<i.length;s++){/******/
f=i[s];/******/
if(n[f]){/******/
l.push(n[f][0])}/******/
n[f]=0}/******/
for(a in u){/******/
if(Object.prototype.hasOwnProperty.call(u,a)){/******/
t[a]=u[a]}}/******/
if(e)e(i,u,c);/******/
while(l.length){/******/
l.shift()()}/******/
if(c){/******/
for(s=0;s<c.length;s++){/******/
d=o(o.s=c[s])}}/******/
return d};/******/
/******/
// The module cache
/******/
var r={};/******/
/******/
// objects to store loaded and loading chunks
/******/
var n={/******/
15:0};/******/
/******/
// The require function
/******/
function o(e){/******/
/******/
// Check if module is in cache
/******/
if(r[e]){/******/
return r[e].exports}/******/
// Create a new module (and put it into the cache)
/******/
var n=r[e]={/******/
i:e,/******/
l:false,/******/
exports:{}};/******/
/******/
// Execute the module function
/******/
t[e].call(n.exports,n,n.exports,o);/******/
/******/
// Flag the module as loaded
/******/
n.l=true;/******/
/******/
// Return the exports of the module
/******/
return n.exports}/******/
/******/
// This file contains only the entry chunk.
/******/
// The chunk loading function for additional chunks
/******/
o.e=function t(e){/******/
var r=n[e];/******/
if(r===0){/******/
return new Promise(function(t){t()})}/******/
/******/
// a Promise means "currently loading".
/******/
if(r){/******/
return r[2]}/******/
/******/
// setup Promise in chunk cache
/******/
var i=new Promise(function(t,o){/******/
r=n[e]=[t,o]});/******/
r[2]=i;/******/
/******/
// start chunk loading
/******/
var u=document.getElementsByTagName("head")[0];/******/
var c=document.createElement("script");/******/
c.type="text/javascript";/******/
c.charset="utf-8";/******/
c.async=true;/******/
c.timeout=12e4;/******/
/******/
if(o.nc){/******/
c.setAttribute("nonce",o.nc)}/******/
c.src=o.p+""+e+".js";/******/
var a=setTimeout(f,12e4);/******/
c.onerror=c.onload=f;/******/
function f(){/******/
// avoid mem leaks in IE.
/******/
c.onerror=c.onload=null;/******/
clearTimeout(a);/******/
var t=n[e];/******/
if(t!==0){/******/
if(t){/******/
t[1](new Error("Loading chunk "+e+" failed."))}/******/
n[e]=undefined}}/******/
u.appendChild(c);/******/
/******/
return i};/******/
/******/
// expose the modules object (__webpack_modules__)
/******/
o.m=t;/******/
/******/
// expose the module cache
/******/
o.c=r;/******/
/******/
// define getter function for harmony exports
/******/
o.d=function(t,e,r){/******/
if(!o.o(t,e)){/******/
Object.defineProperty(t,e,{/******/
configurable:false,/******/
enumerable:true,/******/
get:r})}};/******/
/******/
// getDefaultExport function for compatibility with non-harmony modules
/******/
o.n=function(t){/******/
var e=t&&t.__esModule?/******/
function e(){return t["default"]}:/******/
function e(){return t};/******/
o.d(e,"a",e);/******/
return e};/******/
/******/
// Object.prototype.hasOwnProperty.call
/******/
o.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)};/******/
/******/
// __webpack_public_path__
/******/
o.p="/wp-content/themes/thedocs-child/public/";/******/
/******/
// on error function for async loading
/******/
o.oe=function(t){console.error(t);throw t};/******/
/******/
// Load entry module and return exports
/******/
return o(o.s=33)})({/***/
1:/***/
function(t,e,r){"use strict";!function(t,e){"use strict";function r(t,e){for(var r=0,n=t.length;n>r;r++){a=t[r].querySelector("."+v),a.addEventListener(e,i,!1)}}function n(t){for(var e=0,r=t.length;r>e;e++){t[e].setAttribute(p,l),t[e].setAttribute(h,b)}}function o(t){return e.querySelectorAll("["+p+'="'+t+'"]')}function i(t){for(f=t.target;f&&!f.getAttribute(p);){if(f=f.parentNode,!f)return}s=f.getAttribute(h)===m?b:m,f.setAttribute(h,s)}var u,c,a,f,s,l="click",d="hover",p="data-mfb-toggle",h="data-mfb-state",m="open",b="closed",v="mfb-component__button--main";t.Modernizr&&Modernizr.touch&&(c=o(d),n(c)),u=o(l),r(u,"click")}(window,document)},/***/
33:/***/
function(t,e,r){t.exports=r(1)}});