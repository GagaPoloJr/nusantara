/*
Stimulsoft.Reports.JS
Version: 2022.1.1
Build date: 2021.12.07
License: https://www.stimulsoft.com/en/licensing/reports
*/
!function(f){"object"==typeof exports&&"undefined"!=typeof module?module.exports=f(require("./stimulsoft.viewer.pack").Stimulsoft):"function"==typeof define&&define.amd?define(["./stimulsoft.viewer.pack"],f):Object.assign(window,f(window.Stimulsoft))}(function(f){var b={Stimulsoft:f||{}};if(
,b.Stimulsoft.decodePackedData&&b.Stimulsoft.Viewer)for(const v of["designerScript","blocklyScript"])b.Stimulsoft[v]&&Object.assign(b,b.Stimulsoft.decodePackedData(b.Stimulsoft[v])(b.Stimulsoft)),delete b.Stimulsoft[v];return b});