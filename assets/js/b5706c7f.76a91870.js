"use strict";(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[4594],{3905:(e,t,n)=>{n.d(t,{Zo:()=>d,kt:()=>g});var a=n(7294);function r(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function i(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function o(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?i(Object(n),!0).forEach((function(t){r(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):i(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function l(e,t){if(null==e)return{};var n,a,r=function(e,t){if(null==e)return{};var n,a,r={},i=Object.keys(e);for(a=0;a<i.length;a++)n=i[a],t.indexOf(n)>=0||(r[n]=e[n]);return r}(e,t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);for(a=0;a<i.length;a++)n=i[a],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(r[n]=e[n])}return r}var m=a.createContext({}),p=function(e){var t=a.useContext(m),n=t;return e&&(n="function"==typeof e?e(t):o(o({},t),e)),n},d=function(e){var t=p(e.components);return a.createElement(m.Provider,{value:t},e.children)},s="mdxType",c={inlineCode:"code",wrapper:function(e){var t=e.children;return a.createElement(a.Fragment,{},t)}},u=a.forwardRef((function(e,t){var n=e.components,r=e.mdxType,i=e.originalType,m=e.parentName,d=l(e,["components","mdxType","originalType","parentName"]),s=p(n),u=r,g=s["".concat(m,".").concat(u)]||s[u]||c[u]||i;return n?a.createElement(g,o(o({ref:t},d),{},{components:n})):a.createElement(g,o({ref:t},d))}));function g(e,t){var n=arguments,r=t&&t.mdxType;if("string"==typeof e||r){var i=n.length,o=new Array(i);o[0]=u;var l={};for(var m in t)hasOwnProperty.call(t,m)&&(l[m]=t[m]);l.originalType=e,l[s]="string"==typeof e?e:r,o[1]=l;for(var p=2;p<i;p++)o[p]=n[p];return a.createElement.apply(null,o)}return a.createElement.apply(null,n)}u.displayName="MDXCreateElement"},1743:(e,t,n)=>{n.r(t),n.d(t,{assets:()=>m,contentTitle:()=>o,default:()=>c,frontMatter:()=>i,metadata:()=>l,toc:()=>p});var a=n(7462),r=(n(7294),n(3905));const i={sidebar_position:2},o="Supported Formats",l={unversionedId:"supported-formats",id:"supported-formats",title:"Supported Formats",description:"ImageZen supports two backends: GD and Imagick.",source:"@site/docs/supported-formats.md",sourceDirName:".",slug:"/supported-formats",permalink:"/imagezen/docs/supported-formats",draft:!1,editUrl:"https://github.com/sergix44/imagezen/tree/master/docs/docs/supported-formats.md",tags:[],version:"current",sidebarPosition:2,frontMatter:{sidebar_position:2},sidebar:"tutorialSidebar",previous:{title:"Getting Started",permalink:"/imagezen/docs/getting-started"},next:{title:"Extending",permalink:"/imagezen/docs/extend"}},m={},p=[{value:"Switching Backends on-the-fly",id:"switching-backends-on-the-fly",level:2},{value:"Supported Formats",id:"supported-formats-1",level:2}],d={toc:p},s="wrapper";function c(e){let{components:t,...n}=e;return(0,r.kt)(s,(0,a.Z)({},d,n,{components:t,mdxType:"MDXLayout"}),(0,r.kt)("h1",{id:"supported-formats"},"Supported Formats"),(0,r.kt)("p",null,"ImageZen supports two backends: GD and Imagick.\nThose are listed in the ",(0,r.kt)("inlineCode",{parentName:"p"},"SergiX44\\ImageZen\\Backend")," enum."),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},(0,r.kt)("inlineCode",{parentName:"li"},"Backend::GD")),(0,r.kt)("li",{parentName:"ul"},(0,r.kt)("inlineCode",{parentName:"li"},"Backend::IMAGICK"))),(0,r.kt)("p",null,"The default backend is ",(0,r.kt)("inlineCode",{parentName:"p"},"Backend::GD"),", but you can change it by setting the second parameter\nof the ",(0,r.kt)("inlineCode",{parentName:"p"},"Image::make()")," method or the ",(0,r.kt)("inlineCode",{parentName:"p"},"Image::canvas()")," method."),(0,r.kt)("pre",null,(0,r.kt)("code",{parentName:"pre",className:"language-php"},"use SergiX44\\ImageZen\\Image;\nuse SergiX44\\ImageZen\\Backend;\n\n// by default is GD\n$image = Image::make('path/to/image.jpg');\n$image = Image::canvas(300, 200);\n\n// -> same as\n$image = Image::make('path/to/image.jpg', Backend::GD);\n$image = Image::canvas(300, 200, Backend::GD);\n\n// for imagick\n$image = Image::make('path/to/image.jpg', Backend::IMAGICK);\n$image = Image::canvas(300, 200, Backend::IMAGICK);\n")),(0,r.kt)("h2",{id:"switching-backends-on-the-fly"},"Switching Backends on-the-fly"),(0,r.kt)("p",null,"You can convert an image from one backend to another by using the ",(0,r.kt)("inlineCode",{parentName:"p"},"switchTo()")," method."),(0,r.kt)("pre",null,(0,r.kt)("code",{parentName:"pre",className:"language-php"},"use SergiX44\\ImageZen\\Image;\nuse SergiX44\\ImageZen\\Backend;\n\n$image = Image::make('path/to/image.jpg', Backend::GD);\n\n// switch to imagick\n$image->switchTo(Backend::IMAGICK);\n\n// switch back to GD\n$image->switchTo(Backend::GD);\n")),(0,r.kt)("h2",{id:"supported-formats-1"},"Supported Formats"),(0,r.kt)("p",null,"All the available formats are listed in the ",(0,r.kt)("inlineCode",{parentName:"p"},"SergiX44\\ImageZen\\Format")," enum,\nhere is a list of them, and the supported backends:"),(0,r.kt)("table",null,(0,r.kt)("thead",{parentName:"table"},(0,r.kt)("tr",{parentName:"thead"},(0,r.kt)("th",{parentName:"tr",align:null},"Format"),(0,r.kt)("th",{parentName:"tr",align:null},"GD"),(0,r.kt)("th",{parentName:"tr",align:"center"},"Imagick"))),(0,r.kt)("tbody",{parentName:"table"},(0,r.kt)("tr",{parentName:"tbody"},(0,r.kt)("td",{parentName:"tr",align:null},(0,r.kt)("inlineCode",{parentName:"td"},"Format::PNG")),(0,r.kt)("td",{parentName:"tr",align:null},"\u2714"),(0,r.kt)("td",{parentName:"tr",align:"center"},"\u2714")),(0,r.kt)("tr",{parentName:"tbody"},(0,r.kt)("td",{parentName:"tr",align:null},(0,r.kt)("inlineCode",{parentName:"td"},"Format::JPEG")),(0,r.kt)("td",{parentName:"tr",align:null},"\u2714"),(0,r.kt)("td",{parentName:"tr",align:"center"},"\u2714")),(0,r.kt)("tr",{parentName:"tbody"},(0,r.kt)("td",{parentName:"tr",align:null},(0,r.kt)("inlineCode",{parentName:"td"},"Format::WEBP")),(0,r.kt)("td",{parentName:"tr",align:null},"\u2714"),(0,r.kt)("td",{parentName:"tr",align:"center"},"\u2714")),(0,r.kt)("tr",{parentName:"tbody"},(0,r.kt)("td",{parentName:"tr",align:null},(0,r.kt)("inlineCode",{parentName:"td"},"Format::GIF")),(0,r.kt)("td",{parentName:"tr",align:null},"\u2714"),(0,r.kt)("td",{parentName:"tr",align:"center"},"\u2714")),(0,r.kt)("tr",{parentName:"tbody"},(0,r.kt)("td",{parentName:"tr",align:null},(0,r.kt)("inlineCode",{parentName:"td"},"Format::BMP")),(0,r.kt)("td",{parentName:"tr",align:null},"\u2714"),(0,r.kt)("td",{parentName:"tr",align:"center"},"\u2714")),(0,r.kt)("tr",{parentName:"tbody"},(0,r.kt)("td",{parentName:"tr",align:null},(0,r.kt)("inlineCode",{parentName:"td"},"Format::TIFF")),(0,r.kt)("td",{parentName:"tr",align:null},"\u274c"),(0,r.kt)("td",{parentName:"tr",align:"center"},"\u2714")),(0,r.kt)("tr",{parentName:"tbody"},(0,r.kt)("td",{parentName:"tr",align:null},(0,r.kt)("inlineCode",{parentName:"td"},"Format::HEIC")),(0,r.kt)("td",{parentName:"tr",align:null},"\u2714"),(0,r.kt)("td",{parentName:"tr",align:"center"},"\u2714")),(0,r.kt)("tr",{parentName:"tbody"},(0,r.kt)("td",{parentName:"tr",align:null},(0,r.kt)("inlineCode",{parentName:"td"},"Format::AVIF")),(0,r.kt)("td",{parentName:"tr",align:null},"\u2714"),(0,r.kt)("td",{parentName:"tr",align:"center"},"\u2714")))),(0,r.kt)("p",null,"Imagick supports more formats than GD, but it's not available by default in most PHP installations.\nIt's also marginally faster than GD, but it's not noticeable in most cases."))}c.isMDXComponent=!0}}]);