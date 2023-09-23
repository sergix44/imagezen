"use strict";(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[7804],{3905:(e,t,a)=>{a.d(t,{Zo:()=>g,kt:()=>u});var r=a(7294);function n(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}function i(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,r)}return a}function o(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?i(Object(a),!0).forEach((function(t){n(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):i(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function s(e,t){if(null==e)return{};var a,r,n=function(e,t){if(null==e)return{};var a,r,n={},i=Object.keys(e);for(r=0;r<i.length;r++)a=i[r],t.indexOf(a)>=0||(n[a]=e[a]);return n}(e,t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);for(r=0;r<i.length;r++)a=i[r],t.indexOf(a)>=0||Object.prototype.propertyIsEnumerable.call(e,a)&&(n[a]=e[a])}return n}var l=r.createContext({}),m=function(e){var t=r.useContext(l),a=t;return e&&(a="function"==typeof e?e(t):o(o({},t),e)),a},g=function(e){var t=m(e.components);return r.createElement(l.Provider,{value:t},e.children)},c="mdxType",p={inlineCode:"code",wrapper:function(e){var t=e.children;return r.createElement(r.Fragment,{},t)}},h=r.forwardRef((function(e,t){var a=e.components,n=e.mdxType,i=e.originalType,l=e.parentName,g=s(e,["components","mdxType","originalType","parentName"]),c=m(a),h=n,u=c["".concat(l,".").concat(h)]||c[h]||p[h]||i;return a?r.createElement(u,o(o({ref:t},g),{},{components:a})):r.createElement(u,o({ref:t},g))}));function u(e,t){var a=arguments,n=t&&t.mdxType;if("string"==typeof e||n){var i=a.length,o=new Array(i);o[0]=h;var s={};for(var l in t)hasOwnProperty.call(t,l)&&(s[l]=t[l]);s.originalType=e,s[c]="string"==typeof e?e:n,o[1]=s;for(var m=2;m<i;m++)o[m]=a[m];return r.createElement.apply(null,o)}return r.createElement.apply(null,a)}h.displayName="MDXCreateElement"},8256:(e,t,a)=>{a.r(t),a.d(t,{assets:()=>l,contentTitle:()=>o,default:()=>p,frontMatter:()=>i,metadata:()=>s,toc:()=>m});var r=a(7462),n=(a(7294),a(3905));const i={sidebar_position:43,_modified_:!0},o="resizeCanvas()",s={unversionedId:"alterations/resizeCanvas",id:"alterations/resizeCanvas",title:"resizeCanvas()",description:"Resize the boundaries of the current image to given width and height. An anchor can be defined to determine from what point of the image the resizing is going to happen. Set the mode to relative to add or subtract the given width or height to the actual image dimensions. You can also pass a background color for the emerging area of the image.",source:"@site/docs/alterations/resizeCanvas.md",sourceDirName:"alterations",slug:"/alterations/resizeCanvas",permalink:"/imagezen/docs/alterations/resizeCanvas",draft:!1,editUrl:"https://github.com/sergix44/imagezen/tree/master/docs/docs/alterations/resizeCanvas.md",tags:[],version:"current",sidebarPosition:43,frontMatter:{sidebar_position:43,_modified_:!0},sidebar:"tutorialSidebar",previous:{title:"resize()",permalink:"/imagezen/docs/alterations/resize"},next:{title:"rotate()",permalink:"/imagezen/docs/alterations/rotate"}},l={},m=[{value:"Parameters",id:"parameters",level:2},{value:"Returns",id:"returns",level:2},{value:"Example",id:"example",level:2}],g={toc:m},c="wrapper";function p(e){let{components:t,...a}=e;return(0,n.kt)(c,(0,r.Z)({},g,a,{components:t,mdxType:"MDXLayout"}),(0,n.kt)("h1",{id:"resizecanvas"},(0,n.kt)("inlineCode",{parentName:"h1"},"resizeCanvas()")),(0,n.kt)("pre",null,(0,n.kt)("code",{parentName:"pre",className:"language-php"},"->resizeCanvas(?int $width, ?int $height, [SergiX44\\ImageZen\\Draws\\Position $anchor = SergiX44\\ImageZen\\Draws\\Position::CENTER], [bool $relative = false], [?SergiX44\\ImageZen\\Draws\\Color $background = null]): SergiX44\\ImageZen\\Image\n")),(0,n.kt)("p",null,"Resize the boundaries of the current image to given width and height. An anchor can be defined to determine from what point of the image the resizing is going to happen. Set the mode to relative to add or subtract the given width or height to the actual image dimensions. You can also pass a background color for the emerging area of the image."),(0,n.kt)("h2",{id:"parameters"},"Parameters"),(0,n.kt)("ul",null,(0,n.kt)("li",{parentName:"ul"},(0,n.kt)("inlineCode",{parentName:"li"},"?int $width"),": The width to resize the image to"),(0,n.kt)("li",{parentName:"ul"},(0,n.kt)("inlineCode",{parentName:"li"},"?int $height"),": The height to resize the image to"),(0,n.kt)("li",{parentName:"ul"},(0,n.kt)("inlineCode",{parentName:"li"},"SergiX44\\ImageZen\\Draws\\Position $anchor"),": The anchor point of the resize operation"),(0,n.kt)("li",{parentName:"ul"},(0,n.kt)("inlineCode",{parentName:"li"},"bool $relative"),": Whether to use relative dimensions or not"),(0,n.kt)("li",{parentName:"ul"},(0,n.kt)("inlineCode",{parentName:"li"},"?SergiX44\\ImageZen\\Draws\\Color $background"),": The background color to use for the uncovered area")),(0,n.kt)("h2",{id:"returns"},"Returns"),(0,n.kt)("p",null,"Instance of ",(0,n.kt)("inlineCode",{parentName:"p"},"SergiX44\\ImageZen\\Image"),"."),(0,n.kt)("h2",{id:"example"},"Example"),(0,n.kt)("pre",null,(0,n.kt)("code",{parentName:"pre",className:"language-php"},"use SergiX44\\ImageZen\\Image;\n\n$image = Image::make('path/to/image.jpg')\n    ->resizeCanvas(100, 100); // resize the image to 100x100 pixels without changing the aspect ratio\n\n$image = Image::make('path/to/image.jpg')\n    ->resizeCanvas(100, 100, \\SergiX44\\ImageZen\\Draws\\Position::CENTER); // resize the image to 100x100 pixels without changing the aspect ratio and center the image\n\n$image = Image::make('path/to/image.jpg')\n    ->resizeCanvas(100, 100, \\SergiX44\\ImageZen\\Draws\\Position::CENTER, true); // resize the image to 100x100 pixels without changing the aspect ratio and center the image, but only if it is larger than 100x100 pixels\n\n$image = Image::make('path/to/image.jpg')\n    ->resizeCanvas(100, 100, \\SergiX44\\ImageZen\\Draws\\Position::CENTER, true, \\SergiX44\\ImageZen\\Draws\\Color::red()); // resize the image to 100x100 pixels without changing the aspect ratio and center the image, but only if it is larger than 100x100 pixels and set the uncovered area to red\n\n\n")))}p.isMDXComponent=!0}}]);