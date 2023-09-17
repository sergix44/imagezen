"use strict";(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[8860],{3905:(e,t,n)=>{n.d(t,{Zo:()=>p,kt:()=>g});var a=n(7294);function r(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function i(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function o(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?i(Object(n),!0).forEach((function(t){r(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):i(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function l(e,t){if(null==e)return{};var n,a,r=function(e,t){if(null==e)return{};var n,a,r={},i=Object.keys(e);for(a=0;a<i.length;a++)n=i[a],t.indexOf(n)>=0||(r[n]=e[n]);return r}(e,t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);for(a=0;a<i.length;a++)n=i[a],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(r[n]=e[n])}return r}var c=a.createContext({}),s=function(e){var t=a.useContext(c),n=t;return e&&(n="function"==typeof e?e(t):o(o({},t),e)),n},p=function(e){var t=s(e.components);return a.createElement(c.Provider,{value:t},e.children)},m="mdxType",u={inlineCode:"code",wrapper:function(e){var t=e.children;return a.createElement(a.Fragment,{},t)}},d=a.forwardRef((function(e,t){var n=e.components,r=e.mdxType,i=e.originalType,c=e.parentName,p=l(e,["components","mdxType","originalType","parentName"]),m=s(n),d=r,g=m["".concat(c,".").concat(d)]||m[d]||u[d]||i;return n?a.createElement(g,o(o({ref:t},p),{},{components:n})):a.createElement(g,o({ref:t},p))}));function g(e,t){var n=arguments,r=t&&t.mdxType;if("string"==typeof e||r){var i=n.length,o=new Array(i);o[0]=d;var l={};for(var c in t)hasOwnProperty.call(t,c)&&(l[c]=t[c]);l.originalType=e,l[m]="string"==typeof e?e:r,o[1]=l;for(var s=2;s<i;s++)o[s]=n[s];return a.createElement.apply(null,o)}return a.createElement.apply(null,n)}d.displayName="MDXCreateElement"},4425:(e,t,n)=>{n.r(t),n.d(t,{assets:()=>c,contentTitle:()=>o,default:()=>u,frontMatter:()=>i,metadata:()=>l,toc:()=>s});var a=n(7462),r=(n(7294),n(3905));const i={sidebar_position:1,_modified_:!1},o="canvas()",l={unversionedId:"alterations/canvas",id:"alterations/canvas",title:"canvas()",description:"Initialize an empty canvas.",source:"@site/docs/alterations/canvas.md",sourceDirName:"alterations",slug:"/alterations/canvas",permalink:"/imagezen/docs/alterations/canvas",draft:!1,editUrl:"https://github.com/sergix44/imagezen/tree/master/docs/docs/docs/alterations/canvas.md",tags:[],version:"current",sidebarPosition:1,frontMatter:{sidebar_position:1,_modified_:!1},sidebar:"tutorialSidebar",previous:{title:"make()",permalink:"/imagezen/docs/alterations/make"},next:{title:"basePath()",permalink:"/imagezen/docs/alterations/basePath"}},c={},s=[{value:"Parameters",id:"parameters",level:2},{value:"Returns",id:"returns",level:2},{value:"Example",id:"example",level:2}],p={toc:s},m="wrapper";function u(e){let{components:t,...n}=e;return(0,r.kt)(m,(0,a.Z)({},p,n,{components:t,mdxType:"MDXLayout"}),(0,r.kt)("h1",{id:"canvas"},(0,r.kt)("inlineCode",{parentName:"h1"},"canvas()")),(0,r.kt)("pre",null,(0,r.kt)("code",{parentName:"pre",className:"language-php"},"->canvas(int $width, int $height, [?SergiX44\\ImageZen\\Draws\\Color $color = null], [SergiX44\\ImageZen\\Backend $backend = SergiX44\\ImageZen\\Backend::GD]): self\n")),(0,r.kt)("p",null,"Initialize an empty canvas."),(0,r.kt)("h2",{id:"parameters"},"Parameters"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},(0,r.kt)("inlineCode",{parentName:"li"},"int $width"),": The image width."),(0,r.kt)("li",{parentName:"ul"},(0,r.kt)("inlineCode",{parentName:"li"},"int $height"),": The image height."),(0,r.kt)("li",{parentName:"ul"},(0,r.kt)("inlineCode",{parentName:"li"},"?SergiX44\\ImageZen\\Draws\\Color $color"),": The image background color."),(0,r.kt)("li",{parentName:"ul"},(0,r.kt)("inlineCode",{parentName:"li"},"SergiX44\\ImageZen\\Backend $backend"),": The backend to use, default is GD.")),(0,r.kt)("h2",{id:"returns"},"Returns"),(0,r.kt)("p",null,"Instance of ",(0,r.kt)("inlineCode",{parentName:"p"},"SergiX44\\ImageZen\\Image"),"."),(0,r.kt)("h2",{id:"example"},"Example"),(0,r.kt)("pre",null,(0,r.kt)("code",{parentName:"pre",className:"language-php"},"use SergiX44\\ImageZen\\Image;\n\n$image = Image::make('path/to/image.jpg')\n    ->canvas(int $width, int $height, [?SergiX44\\ImageZen\\Draws\\Color $color = null], [SergiX44\\ImageZen\\Backend $backend = SergiX44\\ImageZen\\Backend::GD]);\n\n")))}u.isMDXComponent=!0}}]);