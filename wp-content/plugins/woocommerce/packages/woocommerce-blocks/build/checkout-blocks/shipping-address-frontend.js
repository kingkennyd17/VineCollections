(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[44],{442:function(e,t,i){"use strict";i.r(t);var s=i(0),n=i(4),o=i.n(n),l=i(119),c=i(298),d=i(36),r=i(339),a=i(1),p=i(396),h=i(59),b=i(29),u=i(10),g=i(340),m=i(341),w=e=>{let{showCompanyField:t=!1,showApartmentField:i=!1,showPhoneField:n=!1,requireCompanyField:o=!1,requirePhoneField:l=!1}=e;const{defaultAddressFields:c,setShippingAddress:d,setBillingAddress:w,shippingAddress:j,setShippingPhone:O,useShippingAsBilling:F,setUseShippingAsBilling:f}=Object(r.a)(),{dispatchCheckoutEvent:k}=Object(h.a)(),{isEditor:y}=Object(b.a)(),[C,E]=Object(s.useState)(!1);Object(s.useEffect)(()=>{n||O("")},[n,O]),Object(s.useEffect)(()=>{C||(F&&w(j),E(!0))},[w,j,F]);const _=Object(s.useMemo)(()=>({company:{hidden:!t,required:o},address_2:{hidden:!i}}),[t,o,i]),A=y?g.a:s.Fragment;return Object(s.createElement)(s.Fragment,null,Object(s.createElement)(A,null,Object(s.createElement)(p.a,{id:"shipping",type:"shipping",onChange:e=>{d(e),F&&w(e),k("set-shipping-address")},values:j,fields:Object.keys(c),fieldConfig:_}),n&&Object(s.createElement)(m.a,{id:"shipping-phone",isRequired:l,value:j.phone,onChange:e=>{O(e),k("set-phone-number",{step:"shipping"})}})),Object(s.createElement)(u.CheckboxControl,{className:"wc-block-checkout__use-address-for-billing",label:Object(a.__)("Use same address for billing","woocommerce"),checked:F,onChange:e=>{f(e),e&&w(j)}}))},j=i(279),O={...Object(j.a)({defaultTitle:Object(a.__)("Shipping address","woocommerce"),defaultDescription:Object(a.__)("Enter the address where you want your order delivered.","woocommerce")}),className:{type:"string",default:""},lock:{type:"object",default:{move:!0,remove:!0}}},F=i(139);t.default=Object(l.withFilteredAttributes)(O)(e=>{let{title:t,description:i,showStepNumber:n,children:l,className:a}=e;const{isProcessing:p}=Object(d.b)(),{showShippingFields:h}=Object(r.a)(),{requireCompanyField:b,requirePhoneField:u,showApartmentField:g,showCompanyField:m,showPhoneField:j}=Object(F.b)();return h?Object(s.createElement)(c.a,{id:"shipping-fields",disabled:p,className:o()("wc-block-checkout__shipping-fields",a),title:t,description:i,showStepNumber:n},Object(s.createElement)(w,{requireCompanyField:b,requirePhoneField:u,showApartmentField:g,showCompanyField:m,showPhoneField:j}),l):null})}}]);