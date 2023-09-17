"use strict";(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[9626],{3905:(e,t,r)=>{r.d(t,{Zo:()=>p,kt:()=>d});var a=r(7294);function n(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}function o(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,a)}return r}function i(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?o(Object(r),!0).forEach((function(t){n(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):o(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function l(e,t){if(null==e)return{};var r,a,n=function(e,t){if(null==e)return{};var r,a,n={},o=Object.keys(e);for(a=0;a<o.length;a++)r=o[a],t.indexOf(r)>=0||(n[r]=e[r]);return n}(e,t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);for(a=0;a<o.length;a++)r=o[a],t.indexOf(r)>=0||Object.prototype.propertyIsEnumerable.call(e,r)&&(n[r]=e[r])}return n}var m=a.createContext({}),c=function(e){var t=a.useContext(m),r=t;return e&&(r="function"==typeof e?e(t):i(i({},t),e)),r},p=function(e){var t=c(e.components);return a.createElement(m.Provider,{value:t},e.children)},s="mdxType",u={inlineCode:"code",wrapper:function(e){var t=e.children;return a.createElement(a.Fragment,{},t)}},g=a.forwardRef((function(e,t){var r=e.components,n=e.mdxType,o=e.originalType,m=e.parentName,p=l(e,["components","mdxType","originalType","parentName"]),s=c(r),g=n,d=s["".concat(m,".").concat(g)]||s[g]||u[g]||o;return r?a.createElement(d,i(i({ref:t},p),{},{components:r})):a.createElement(d,i({ref:t},p))}));function d(e,t){var r=arguments,n=t&&t.mdxType;if("string"==typeof e||n){var o=r.length,i=new Array(o);i[0]=g;var l={};for(var m in t)hasOwnProperty.call(t,m)&&(l[m]=t[m]);l.originalType=e,l[s]="string"==typeof e?e:n,i[1]=l;for(var c=2;c<o;c++)i[c]=r[c];return a.createElement.apply(null,i)}return a.createElement.apply(null,r)}g.displayName="MDXCreateElement"},33:(e,t,r)=>{r.r(t),r.d(t,{assets:()=>m,contentTitle:()=>i,default:()=>u,frontMatter:()=>o,metadata:()=>l,toc:()=>c});var a=r(7462),n=(r(7294),r(3905));const o={sidebar_position:24,_modified_:!1},i="gamma()",l={unversionedId:"alterations/gamma",id:"alterations/gamma",title:"gamma()",description:"Apply a gamma correction to the image.",source:"@site/docs/alterations/gamma.md",sourceDirName:"alterations",slug:"/alterations/gamma",permalink:"/imagezen/docs/alterations/gamma",draft:!1,editUrl:"https://github.com/sergix44/imagezen/tree/master/docs/docs/docs/alterations/gamma.md",tags:[],version:"current",sidebarPosition:24,frontMatter:{sidebar_position:24,_modified_:!1},sidebar:"tutorialSidebar",previous:{title:"flip()",permalink:"/imagezen/docs/alterations/flip"},next:{title:"greyscale()",permalink:"/imagezen/docs/alterations/greyscale"}},m={},c=[{value:"Parameters",id:"parameters",level:2},{value:"Returns",id:"returns",level:2},{value:"Example",id:"example",level:2}],p={toc:c},s="wrapper";function u(e){let{components:t,...r}=e;return(0,n.kt)(s,(0,a.Z)({},p,r,{components:t,mdxType:"MDXLayout"}),(0,n.kt)("h1",{id:"gamma"},(0,n.kt)("inlineCode",{parentName:"h1"},"gamma()")),(0,n.kt)("pre",null,(0,n.kt)("code",{parentName:"pre",className:"language-php"},"->gamma(float $correction): SergiX44\\ImageZen\\Image\n")),(0,n.kt)("p",null,"Apply a gamma correction to the image."),(0,n.kt)("h2",{id:"parameters"},"Parameters"),(0,n.kt)("ul",null,(0,n.kt)("li",{parentName:"ul"},(0,n.kt)("inlineCode",{parentName:"li"},"float $correction"),": The amount of gamma correction (0.1-9.99)")),(0,n.kt)("h2",{id:"returns"},"Returns"),(0,n.kt)("p",null,"Instance of ",(0,n.kt)("inlineCode",{parentName:"p"},"SergiX44\\ImageZen\\Image"),"."),(0,n.kt)("h2",{id:"example"},"Example"),(0,n.kt)("pre",null,(0,n.kt)("code",{parentName:"pre",className:"language-php"},"use SergiX44\\ImageZen\\Image;\n\n$image = Image::make('path/to/image.jpg')\n    ->gamma(float $correction);\n\n")))}u.isMDXComponent=!0}}]);